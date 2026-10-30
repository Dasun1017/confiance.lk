'use strict';
// Local integration tests: email is captured by an SMTP server on 127.0.0.1, never sent externally.
const assert = require('node:assert/strict');
const fs = require('node:fs');
const net = require('node:net');
const os = require('node:os');
const path = require('node:path');
const { spawn } = require('node:child_process');
const root = path.resolve(__dirname, '..');
const php = process.env.CAREERS_PHP || 'C:/xampp/php/php.exe';
const artifacts = fs.mkdtempSync(path.join(os.tmpdir(), 'confiance-careers-endpoint-'));
const pdf = '%PDF-1.4\n1 0 obj\n<< /Type /Catalog >>\nendobj\ntrailer\n<< /Root 1 0 R >>\n%%EOF\n';
const messages = [];
const smtpTranscript = [];
const children = [];
let smtp;
let smtpPort;
const delay = ms => new Promise(resolve => setTimeout(resolve, ms));
const baseFields = { full_name: 'Test Applicant', email: 'applicant@example.test', phone: '+94 77 123 4567', role: 'japanese-teacher', message: 'Automated local test. Not a real application.', consent: '1', company_website: '' };
async function listen(server) { await new Promise(resolve => server.listen(0, '127.0.0.1', resolve)); return server.address().port; }
async function startSMTP() {
    smtp = net.createServer(socket => {
        socket.setEncoding('utf8');
        socket.write('220 local-test SMTP\r\n');
        let buffer = '', dataMode = false, body = [], recipients = [];
        socket.on('data', chunk => {
            buffer += chunk;
            let index;
            while ((index = buffer.indexOf('\n')) >= 0) {
                const line = buffer.slice(0, index).replace(/\r$/, '');
                if (!dataMode) smtpTranscript.push(line);
                buffer = buffer.slice(index + 1);
                if (dataMode) {
                    if (line === '.') {
                        messages.push({ recipients: recipients.slice(), body: body.join('\r\n') });
                        dataMode = false; body = [];
                        socket.write('250 captured locally\r\n');
                    } else body.push(line.startsWith('..') ? line.slice(1) : line);
                } else if (/^(EHLO|HELO)\b/i.test(line)) socket.write('250 localhost\r\n');
                else if (/^MAIL FROM:/i.test(line)) { recipients = []; socket.write('250 OK\r\n'); }
                else if (/^RCPT TO:/i.test(line)) { recipients.push(line); socket.write('250 OK\r\n'); }
                else if (/^DATA$/i.test(line)) { dataMode = true; socket.write('354 End with dot\r\n'); }
                else if (/^QUIT$/i.test(line)) { socket.end('221 Bye\r\n'); }
                else socket.write('250 OK\r\n');
            }
        });
        socket.on('error', () => {});
    });
    smtpPort = await listen(smtp);
}
async function startPHP(name, preview = false) {
    const directory = path.join(artifacts, name);
    for (const sub of ['sessions', 'uploads']) fs.mkdirSync(path.join(directory, sub), { recursive: true });
    const reserve = net.createServer();
    const port = await listen(reserve);
    await new Promise(resolve => reserve.close(resolve));
    const args = [
        '-n', '-d', 'extension_dir=' + JSON.stringify(path.join(path.dirname(php), 'ext').replaceAll(String.fromCharCode(92), '/')), '-d', 'extension=fileinfo', '-d', 'display_errors=0', '-d', 'log_errors=1', '-d', 'error_log=' + JSON.stringify(path.join(directory, 'php.log').replaceAll(String.fromCharCode(92), '/')),
        '-d', 'open_basedir=', '-d', 'session.save_path=' + JSON.stringify(path.join(directory, 'sessions').replaceAll(String.fromCharCode(92), '/')),
        '-d', 'upload_tmp_dir=' + JSON.stringify(path.join(directory, 'uploads').replaceAll(String.fromCharCode(92), '/')), '-d', 'sys_temp_dir=' + JSON.stringify(directory.replaceAll(String.fromCharCode(92), '/')),
        '-d', 'upload_max_filesize=5M', '-d', 'post_max_size=6M',
        '-d', 'SMTP=127.0.0.1', '-d', 'smtp_port=' + smtpPort,
        '-d', 'sendmail_from=no-reply@confiance.lk',
        '-S', '127.0.0.1:' + port, '-t', root
    ];
    const child = spawn(php, args, { cwd: root, windowsHide: true, env: { ...process.env, CAREERS_PREVIEW: preview ? '1' : '0' }, stdio: ['ignore', 'ignore', 'pipe'] });
    children.push(child);
    let logs = '';
    child.stderr.on('data', chunk => { logs = (logs + chunk).slice(-3000); fs.appendFileSync(path.join(directory, 'server.log'), chunk); });
    const url = 'http://127.0.0.1:' + port;
    for (let i = 0; i < 80; i++) {
        if (child.exitCode !== null) throw new Error('PHP failed: ' + logs);
        try {
            const response = await fetch(url + '/career-application.php');
            const body = await response.json();
            if (body.success && body.csrfToken) return { url, cookie: response.headers.get('set-cookie').split(';')[0], token: body.csrfToken, maxBytes: body.maxBytes, mode: body.mode, directory };
        } catch {}
        await delay(100);
    }
    throw new Error('PHP server did not start: ' + logs);
}
async function post(session, changes = {}, options = {}) {
    const fields = { ...baseFields, csrf_token: session.token, ...changes };
    const data = new FormData();
    for (const [key, value] of Object.entries(fields)) if (value !== null) data.append(key, value);
    if (options.file !== null) data.append('cv', new Blob([options.file === undefined ? pdf : options.file], { type: options.type || 'application/pdf' }), options.filename || 'CV.pdf');
    const response = await fetch(session.url + '/career-application.php', { method: 'POST', headers: { Cookie: session.cookie, Origin: options.origin || session.url }, body: data });
    return { response, body: await response.json() };
}
async function main() {
    assert(fs.existsSync(php), 'Set CAREERS_PHP to a PHP executable with fileinfo and session support.');
    await startSMTP();
    const session = await startPHP('success');
    assert.equal(session.maxBytes, 5 * 1024 * 1024);
    const early = await post(session);
    assert.equal(early.response.status, 429, 'Automatic submissions before form review are rejected');
    const csrf = await post(session, { csrf_token: 'invalid' });
    assert.equal(csrf.response.status, 403, 'Invalid CSRF is rejected');
    const origin = await post(session, {}, { origin: 'https://different.example' });
    assert.equal(origin.response.status, 403, 'Cross-origin submission is rejected');
    await delay(3200);
    const cases = [
        ['missing name', { full_name: '' }, {}, 422],
        ['invalid email', { email: 'not-an-email' }, {}, 422],
        ['header injection', { email: 'valid@example.test\r\nBcc: attacker@example.test' }, {}, 422],
        ['invalid phone', { phone: 'not-a-number' }, {}, 422],
        ['unknown vacancy', { role: 'unapproved-position' }, {}, 422],
        ['missing consent', { consent: null }, {}, 422],
        ['honeypot', { company_website: 'spam.example' }, {}, 422],
        ['missing CV', {}, { file: null }, 422],
        ['fake PDF', {}, { file: 'This is not a PDF.' }, 422],
        ['wrong extension', {}, { filename: 'CV.php' }, 422],
        ['oversize PDF', {}, { file: pdf + 'x'.repeat(5 * 1024 * 1024) }, 413],
    ];
    for (const [label, changes, options, status] of cases) {
        const result = await post(session, changes, options);
        assert.equal(result.response.status, status, label + ': ' + JSON.stringify(result.body));
        assert.equal(result.body.success, false, label + ': never reports success');
    }
    assert.equal(messages.length, 0, 'Invalid submissions send no email');
    const valid = await post(session);
    assert.equal(valid.response.status, 200, JSON.stringify({ body: valid.body, smtp: smtpTranscript, artifacts }));
    assert.equal(valid.body.success, true);
    assert.equal(messages.length, 1, 'One valid application is captured: ' + JSON.stringify(smtpTranscript));
    const captured = messages[0];
    assert.match(captured.recipients.join(' '), /lkconfiance@gmail\.com/i);
    assert.match(captured.body, /Reply-To: applicant@example\.test/i);
    assert.match(captured.body, /Content-Type: application\/pdf/i);
    assert.match(captured.body, /Content-Disposition: attachment; filename="CV\.pdf"/i);
    const normalizedMessage = captured.body.replace(/\s/g, '');
    assert(normalizedMessage.includes(Buffer.from(pdf).toString('base64')), 'CV PDF bytes are attached without alteration');
    const textPart = captured.body.match(/Content-Type: text\/plain; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n([\s\S]*?)\r\n--/i);
    assert(textPart, 'Readable text section exists');
    const decodedText = Buffer.from(textPart[1].replace(/\s/g, ''), 'base64').toString('utf8');
    assert.match(decodedText, /Japanese Language Teacher/);
    assert.match(decodedText, /Test Applicant/);
    const duplicate = await post(session);
    assert.equal(duplicate.response.status, 403, 'Used form token cannot submit again');
    const fresh = await fetch(session.url + '/career-application.php', { headers: { Cookie: session.cookie } });
    session.token = (await fresh.json()).csrfToken;
    await delay(3200);
    const limited = await post(session);
    assert.equal(limited.response.status, 429, 'Rate limit rejects repeat applications even with a fresh token');
    assert.equal(messages.length, 1, 'Duplicate submission sends no extra email');
    const previewSession = await startPHP('local-preview', true);
    assert.equal(previewSession.mode, 'preview');
    const previewResult = await post(previewSession);
    assert.equal(previewResult.response.status, 200, JSON.stringify(previewResult.body));
    assert.equal(previewResult.body.preview, true);
    assert.match(previewResult.body.message, /No email was sent/);
    assert.equal(messages.length, 1, 'Local preview never calls the email transport');
    const captureDirectory=path.join(previewSession.directory,'confiance-careers-preview');
    const capturedFiles=fs.readdirSync(captureDirectory).filter(name=>name.endsWith('.eml'));
    assert.equal(capturedFiles.length,1,'One local preview capture is saved');
    const previewMessage=fs.readFileSync(path.join(captureDirectory,capturedFiles[0]),'utf8');
    assert.match(previewMessage,/To: lkconfiance@gmail\.com/);
    assert(previewMessage.replace(/\s/g,'').includes(Buffer.from(pdf).toString('base64')),'Local capture contains the actual PDF attachment');
    assert.equal(fs.readdirSync(path.join(previewSession.directory,'uploads')).length,0,'Temporary uploaded CV is cleaned after the request');
    await new Promise(resolve => smtp.close(resolve));
    smtp = null;
    const failing = await startPHP('mail-unavailable');
    await delay(3200);
    const failed = await post(failing);
    assert.equal(failed.response.status, 503, 'Mail transport failure is reported');
    assert.equal(failed.body.success, false, 'Mail failure never displays a success result');
    assert.match(failed.body.message, /lkconfiance@gmail\.com/);
    console.log('PASS: CV validation, CSRF, origin checks, consent, attachment content, recipient routing, duplicate prevention and honest mail-failure handling.');
    console.log('No external email was sent. SMTP capture and PHP logs: ' + artifacts);
}
main().catch(error => { console.error(error.stack); process.exitCode = 1; }).finally(() => {
    for (const child of children) child.kill();
    if (smtp) smtp.close();
});
