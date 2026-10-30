'use strict';
// Local PHP preview. Valid applications are captured outside the website; no mail is sent.
const fs = require('node:fs');
const path = require('node:path');
const os = require('node:os');
const net = require('node:net');
const { spawn } = require('node:child_process');
const root = path.resolve(__dirname, '..');
const php = process.env.CAREERS_PHP || (fs.existsSync('C:/xampp/php/php.exe') ? 'C:/xampp/php/php.exe' : 'php');
const portArgument = process.argv.find(value => value.startsWith('--port='));
const port = portArgument ? Number(portArgument.split('=')[1]) : 8080;
if (!Number.isInteger(port) || port < 1024 || port > 65535) throw new Error('Use a port between 1024 and 65535.');
const base = 'http://127.0.0.1:' + port;
let child;
async function main() {
    try {
        const response = await fetch(base + '/career-application.php', { signal: AbortSignal.timeout(1000) });
        const data = await response.json();
        if (data.mode === 'preview') {
            console.log('Careers preview is already running: ' + base + '/careers.html');
            return;
        }
        throw new Error('Port ' + port + ' is already in use. Run with --port=8081.');
    } catch (error) {
        if (error.message.includes('already in use')) throw error;
    }
    const check = net.createServer();
    await new Promise((resolve, reject) => { check.once('error', reject); check.listen(port, '127.0.0.1', resolve); });
    await new Promise(resolve => check.close(resolve));
    const directory = fs.mkdtempSync(path.join(os.tmpdir(), 'confiance-careers-preview-'));
    for (const sub of ['sessions', 'uploads']) fs.mkdirSync(path.join(directory, sub), { recursive: true });
    const setting = (name, value) => ['-d', name + '=' + JSON.stringify(String(value).replaceAll(String.fromCharCode(92), '/'))];
    const args = ['-n'];
    if (process.platform === 'win32') args.push(...setting('extension_dir', path.join(path.dirname(php), 'ext')), '-d', 'extension=fileinfo');
    else args.push('-d', 'extension=fileinfo');
    args.push(
        ...setting('display_errors', '0'), ...setting('log_errors', '1'),
        ...setting('error_log', path.join(directory, 'php.log')),
        ...setting('session.save_path', path.join(directory, 'sessions')),
        ...setting('upload_tmp_dir', path.join(directory, 'uploads')),
        ...setting('sys_temp_dir', directory),
        ...setting('upload_max_filesize', '5M'), ...setting('post_max_size', '6M'),
        '-S', '127.0.0.1:' + port, '-t', root
    );
    child = spawn(php, args, { cwd: root, windowsHide: true, env: { ...process.env, CAREERS_PREVIEW: '1' }, stdio: ['ignore', 'pipe', 'pipe'] });
    child.on('error', error => { console.error('Could not start PHP: ' + error.message); process.exitCode = 1; });
    child.stdout.on('data', chunk => fs.appendFileSync(path.join(directory, 'server.log'), chunk));
    child.stderr.on('data', chunk => fs.appendFileSync(path.join(directory, 'server.log'), chunk));
    child.on('exit', code => { if (code) { console.error('PHP stopped with code ' + code + '. See ' + path.join(directory, 'server.log')); process.exitCode = 1; } });
    for (let attempt = 0; attempt < 50; attempt++) {
        if (child.exitCode !== null) throw new Error('PHP could not start. See ' + path.join(directory, 'server.log'));
        try {
            const response = await fetch(base + '/career-application.php', { signal: AbortSignal.timeout(1000) });
            const data = await response.json();
            if (data.success && data.mode === 'preview') {
                console.log('Careers test preview: ' + base + '/careers.html');
                console.log('Test mode: no email is sent.');
                console.log('Captured test applications: ' + path.join(directory, 'confiance-careers-preview'));
                console.log('Press Ctrl+C to stop this preview when running in a terminal.');
                return;
            }
        } catch {}
        await new Promise(resolve => setTimeout(resolve, 100));
    }
    throw new Error('The preview did not become ready. See ' + path.join(directory, 'server.log'));
}
function stop() { if (child) child.kill(); }
process.on('SIGINT', () => { stop(); process.exit(); });
process.on('SIGTERM', () => { stop(); process.exit(); });
process.on('exit', stop);
main().catch(error => { console.error(error.message); stop(); process.exitCode = 1; });
