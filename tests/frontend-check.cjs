
'use strict';
// Run with Node 22+ and a locally installed Chrome/Edge. No npm packages required.
const assert = require('node:assert/strict');
const fs = require('node:fs');
const http = require('node:http');
const os = require('node:os');
const path = require('node:path');
const { spawn } = require('node:child_process');
const vm = require('node:vm');
const root = path.resolve(__dirname, '..');
const allPages = [
    'index.html', 'index2.html', 'about.html', 'contact.html', 'teachers.html', 'careers.html',
    'partnerships.html', 'career-pathway.html', 'gallery.html', 'language-programs.html',
    'japanese-language.html', 'italian-language.html', 'french-language.html', 'korean-language.html',
    'vocational-training.html', 'truck-driving-training.html', 'butchery-training.html',
    'airport-ground-handling.html', 'caregiver-training.html', 'hospitality-training.html',
    'agriculture-training.html', 'visa-consultation.html',
    '404.html', '502.html'
];
const careersOnly = process.argv.includes('--careers-only');
const homeOnly = process.argv.includes('--home-only');
const langOnly = process.argv.includes('--lang-only');
const partnersOnly = process.argv.includes('--partners-only');
const pathwayOnly = process.argv.includes('--pathway-only');
const aboutOnly = process.argv.includes('--about-only');
const galleryOnly = process.argv.includes('--gallery-only');
const contactOnly = process.argv.includes('--contact-only');
const teamOnly = process.argv.includes('--team-only');
const visaOnly = process.argv.includes('--visa-only');
const vocationalOnly = process.argv.includes('--vocational-only');
const pages = visaOnly ? ['visa-consultation.html'] : teamOnly ? ['teachers.html'] : vocationalOnly ? [
    'vocational-training.html', 'truck-driving-training.html', 'butchery-training.html',
    'airport-ground-handling.html', 'caregiver-training.html', 'hospitality-training.html',
    'agriculture-training.html'
] : contactOnly ? ['contact.html'] : galleryOnly ? ['gallery.html'] : aboutOnly ? ['about.html'] : pathwayOnly ? ['career-pathway.html'] : partnersOnly ? ['partnerships.html'] : careersOnly ? ['careers.html'] : homeOnly ? ['index.html','index2.html'] : langOnly ? ['language-programs.html', 'japanese-language.html', 'italian-language.html', 'french-language.html', 'korean-language.html'] : allPages;
const artifacts = fs.mkdtempSync(path.join(os.tmpdir(), 'confiance-frontend-'));
function localFile(url) {
    const relative = decodeURIComponent(url.split(/[?#]/)[0]).replace(/^\/+/, '');
    const target = path.resolve(root, relative || 'index.html');
    assert(target.startsWith(root + path.sep));
    return target;
}
for (const file of pages) {
    const source = fs.readFileSync(path.join(root, file), 'utf8');
    assert.match(source, /<html[^>]*lang="en"/, file + ': document language');
    assert.equal((source.match(/<h1\b/g) || []).length, 1, file + ': one page heading');
    assert.equal((source.match(/<main\b/g) || []).length, 1, file + ': main landmark');
    const ids = [...source.matchAll(/\bid="([^"]+)"/g)].map(match => match[1]);
    assert.equal(new Set(ids).size, ids.length, file + ': unique IDs');
    for (const match of source.matchAll(/(?:src|href)=["']([^"']+)["']/g)) {
        const value = match[1];
        if (/^(https?:|\/\/|#|mailto:|tel:|data:)/i.test(value)) continue;
        assert(fs.existsSync(localFile(value)), file + ': local file ' + value);
    }
    for (const match of source.matchAll(/<script\b([^>]*)>([\s\S]*?)<\/script>/g)) {
        if (!match[1].includes('src=')) new vm.Script(match[2], { filename: file });
    }
}
new vm.Script(fs.readFileSync(path.join(root, 'newTemplate/js/frontend.js'), 'utf8'));
const iconCSS = path.join(root, 'newTemplate/fontawesome-free/css/all.min.css');
for (const match of fs.readFileSync(iconCSS, 'utf8').matchAll(/url\(([^)]+)\)/g)) {
    assert(fs.existsSync(path.resolve(path.dirname(iconCSS), match[1])), 'Icon font exists: ' + match[1]);
}
let applicationFixtureMode = 'unavailable';
let applicationPreparationAvailable = true;
let applicationFixturePreview = false;
const fixtureApplications = [];
const server = http.createServer((request, response) => {
    const url = request.url.split(/[?#]/)[0];
    // UI-only fixture. The real PHP handler is tested against a local SMTP capture server.
    if (url === '/career-application.php') {
        response.setHeader('Content-Type', 'application/json');
        if (request.method === 'GET') {
            if (!applicationPreparationAvailable) { response.statusCode=503;response.end(JSON.stringify({success:false,message:'Submission unavailable.'}));return; }
            response.end(JSON.stringify({ success: true, csrfToken: 'ui-test-token', maxBytes: 5 * 1024 * 1024, mode: applicationFixturePreview ? 'preview' : 'live' })); return;
        }
        const chunks = [];
        request.on('data', chunk => chunks.push(chunk));
        request.on('end', () => {
            fixtureApplications.push(Buffer.concat(chunks).toString('utf8'));
            if (applicationFixtureMode === 'success') response.end(JSON.stringify(applicationFixturePreview ? {success:true,preview:true,csrfToken:'next-ui-test-token',message:'Local test complete. No email was sent.'} : { success: true, message: 'Test application accepted.' }));
            else { response.statusCode = 503; response.end(JSON.stringify({ success: false, message: 'Email service unavailable. Please email your CV to lkconfiance@gmail.com.' })); }
        });
        return;
    }
    let file;
    let status = 200;
    if (url === '/__test/gateway') { file = path.join(root, '502.html'); status = 502; }
    else {
        try { file = localFile(url); } catch { response.writeHead(403).end(); return; }
        if (!allPages.includes(path.relative(root, file)) && !file.startsWith(path.join(root, 'newTemplate') + path.sep)) {
            file = path.join(root, '404.html'); status = 404;
        }
        if (!fs.existsSync(file) || !fs.statSync(file).isFile()) { file = path.join(root, '404.html'); status = 404; }
    }
    const types = { '.html': 'text/html; charset=utf-8', '.css': 'text/css', '.js': 'text/javascript', '.png': 'image/png', '.jpg': 'image/jpeg', '.jpeg': 'image/jpeg', '.svg': 'image/svg+xml', '.woff': 'font/woff', '.woff2': 'font/woff2', '.ttf': 'font/ttf' };
    response.writeHead(status, { 'Content-Type': types[path.extname(file)] || 'application/octet-stream' });
    fs.createReadStream(file).pipe(response);
});
let browser;
let ws;
let nextID = 0;
let sessionID;
const pending = new Map();
const exceptions = [];
const failures = [];
const widgetRequests = [];
const reportedDebugMessages = [];
function cdp(method, params = {}, browserLevel = false) {
    return new Promise((resolve, reject) => {
        const id = ++nextID;
        const timeout = setTimeout(() => { pending.delete(id); reject(new Error('CDP timeout: ' + method)); }, 15000);
        pending.set(id, { resolve, reject, timeout });
        ws.send(JSON.stringify({ id, method, params, ...(sessionID && !browserLevel ? { sessionId: sessionID } : {}) }));
    });
}
async function evaluate(expression) {
    const result = await cdp('Runtime.evaluate', { expression, returnByValue: true, awaitPromise: true });
    if (result.exceptionDetails) throw new Error(JSON.stringify(result.exceptionDetails));
    return result.result.value;
}
async function settle(ms = 100) {
    return evaluate('new Promise(resolve => setTimeout(resolve, ' + ms + '))');
}
async function navigate(url) {
    await cdp('Page.navigate', { url });
    for (let i = 0; i < 100; i++) {
        if (await evaluate('document.readyState === "complete" && location.href === ' + JSON.stringify(url))) break;
        await settle(50);
    }
    await settle(100);
    // Load deferred images for asset checks and full-page snapshots only.
    await evaluate("Promise.all(Array.from(document.images).map(image => { if (image.loading === \'lazy\') image.loading = \'eager\'; return image.decode().catch(() => {}); }))");
}
async function main() {
    await new Promise(resolve => server.listen(0, '127.0.0.1', resolve));
    const base = 'http://127.0.0.1:' + server.address().port;
    const executable = process.env.FRONTEND_BROWSER || [
        'C:/Program Files/Google/Chrome/Application/chrome.exe',
        'C:/Program Files (x86)/Microsoft/Edge/Application/msedge.exe'
    ].find(file => fs.existsSync(file));
    assert(executable, 'Install Chrome/Edge or set FRONTEND_BROWSER to its executable');
    browser = spawn(executable, ['--headless=new', '--disable-gpu', '--no-first-run', '--no-default-browser-check', '--disable-extensions', '--disable-background-networking', '--remote-debugging-port=0', '--user-data-dir=' + path.join(artifacts, 'profile'), 'about:blank'], { windowsHide: true, stdio: ['ignore', 'ignore', 'pipe'] });
    const debuggerURL = await new Promise((resolve, reject) => {
        let output = '';
        const timeout = setTimeout(() => reject(new Error('Chrome did not expose a debugger endpoint')), 20000);
        browser.stderr.on('data', chunk => {
            output += chunk.toString();
            const match = output.match(/DevTools listening on (ws:\/\/[^\s]+)/);
            if (match) { clearTimeout(timeout); resolve(match[1]); }
        });
        browser.on('error', reject);
    });
    ws = new WebSocket(debuggerURL);
    await new Promise((resolve, reject) => { ws.onopen = resolve; ws.onerror = reject; });
    ws.onmessage = event => {
        const message = JSON.parse(event.data);
        if (message.id) {
            const item = pending.get(message.id);
            if (item) { clearTimeout(item.timeout); pending.delete(message.id); message.error ? item.reject(new Error(JSON.stringify(message.error))) : item.resolve(message.result); }
        } else if (message.method === 'Runtime.exceptionThrown') exceptions.push(message.params.exceptionDetails);
        else if (message.method === 'Network.requestWillBeSent' && /elfsight|eapps/i.test(message.params.request.url)) widgetRequests.push(message.params.request.url);
        else if (message.method === 'Runtime.consoleAPICalled') {
            const line = message.params.args.map(arg => String(arg.value || arg.description || '')).join(' ');
            if (/APP_VIEWS_LIMIT_REACHED|Search endpoint requested!/i.test(line)) reportedDebugMessages.push(line);
        }
        else if (message.method === 'Network.responseReceived') {
            const response = message.params.response;
            if (response.status >= 400 && response.url.startsWith(base) && !response.url.includes('/__test/') && !response.url.endsWith('/favicon.ico') && !response.url.endsWith('/career-application.php')) failures.push({ status: response.status, url: response.url });
        }
    };
    const target = await cdp('Target.createTarget', { url: 'about:blank' }, true);
    const session = await cdp('Target.attachToTarget', { targetId: target.targetId, flatten: true }, true);
    sessionID = session.sessionId;
    await cdp('Page.enable');
    await cdp('Runtime.enable');
    await cdp('Network.enable');
    // Verify the public site still functions without third-party trackers, widgets or CDNs.
    await cdp('Network.setBlockedURLs', { urls: ['https://*'] });
    let checks = 0;
    for (const width of ((careersOnly || homeOnly) ? [390, 1440] : [320, 390, 768, 991, 992, 1024, 1279, 1280, 1366, 1440, 1920])) {
        await cdp('Emulation.setDeviceMetricsOverride', { width, height: 900, deviceScaleFactor: 1, mobile: false });
        for (const file of pages) {
            await navigate(base + '/' + file);
            const state = await evaluate(String.raw`JSON.stringify({
                width: innerWidth,
                scrollWidth: document.documentElement.scrollWidth,
                brokenImages: [...document.images].filter(image => !image.complete || !image.naturalWidth).map(image => image.getAttribute('src')),
                emptyLinks: [...document.querySelectorAll('a[href]')].filter(a => a.getAttribute('href') === '#').map(a => a.textContent.trim()),
                headings: document.querySelectorAll('h1').length,
                main: document.querySelectorAll('main').length,
                trigger: !!document.querySelector('.mobile-menu-trigger') && getComputedStyle(document.querySelector('.mobile-menu-trigger')).display !== 'none',
                navHidden: document.querySelector('.mobile-nav')?.hidden
            })`);
            const result = JSON.parse(state);
            assert(result.scrollWidth <= width + 1, file + ' at ' + width + ': horizontal overflow ' + JSON.stringify(result));
            assert.deepEqual(result.brokenImages, [], file + ': images load');
            assert.deepEqual(result.emptyLinks, [], file + ': no dead placeholder links');
            assert.equal(result.headings, 1);
            assert.equal(result.main, 1);
            if (!file.match(/^(404|502)/)) {
                assert.equal(result.trigger, width <= 1279, file + ': correct menu breakpoint');
                const menuLabels = ["Home","Language Programs","Vocational Training","Career Pathway","Visa Consultation","Partnerships","About Us","Our Team","Gallery","Contact Us"];
                for (const selector of ['.site-desktop-nav', '.mobile-nav']) {
                    assert.deepEqual(await evaluate("Array.from(document.querySelectorAll(\'" + selector + " ul > li > a\'), a => a.textContent.trim())"), menuLabels, file + ": requested navigation order");
                    assert.equal(await evaluate("document.querySelectorAll(\'" + selector + " a[aria-disabled=true]:not([href])\').length"), 0, file + ": all navigation sections point to live pages");
                }
                assert.equal(await evaluate("document.querySelector(\'.site-header-actions .site-contact-button\').textContent === \'Inquire Now\' && document.querySelector(\'.site-header-actions .site-contact-button\').getAttribute(\'href\') === \'contact.html\'"), true, file + ": inquiry action restored");
                assert.equal(await evaluate("document.querySelectorAll(\'[class*=elfsight], script[src*=elfsight]\').length"), 0, file + ": expired widget removed");
                if (width >= 1280) {
                    assert.equal(await evaluate("document.querySelector(\'.site-brand\').getBoundingClientRect().right <= document.querySelector(\'.site-desktop-nav\').getBoundingClientRect().left && document.querySelector(\'.site-desktop-nav\').getBoundingClientRect().right <= document.querySelector(\'.site-header-actions\').getBoundingClientRect().left"), true, file + ": navigation and restored actions do not overlap");
                }
                assert.equal(await evaluate("document.querySelector(\'.site-mobile-inquiry\').textContent"), "Inquire Now", file + ": inquiry action available in mobile drawer");
                assert.equal(await evaluate("document.querySelector('.site-header-actions .site-portal-button').getAttribute('href') === 'https://edu.confiance.lk' && document.querySelector('.site-header-actions .site-portal-button').getBoundingClientRect().width > 0"), true, file + ': visible portal button on every screen size');
                assert.equal(await evaluate("document.querySelector('header').scrollWidth <= innerWidth"), true, file + ': header fits viewport');
                assert.equal(await evaluate("document.querySelector(\'footer.site-footer\').scrollWidth <= innerWidth && getComputedStyle(document.querySelector(\'footer\')).position !== \'absolute\'"), true, file + ": footer stays within the page layout");
                assert.equal(await evaluate("!!document.querySelector(\'footer a[href=\\\"mailto:info@confiance.lk\\\"]\') && !!document.querySelector(\'footer a[href=\\\"tel:+94740633337\\\"]\')"), true, file + ": footer contact links work");
                assert.equal(await evaluate("document.querySelector(\'footer [data-current-year]\').textContent"), String(new Date().getFullYear()), file + ": footer copyright year is current");
                if (width <= 1279) {
                    assert.equal(result.navHidden, true);
                    await evaluate("document.querySelector('.mobile-menu-trigger').click()");
                    assert.equal(await evaluate("!document.querySelector('.mobile-nav').hidden && document.body.classList.contains('menu-open') && document.activeElement.classList.contains('mobile-nav-close')"), true, file + ': open drawer and focus');
                    await cdp('Input.dispatchKeyEvent', { type: 'rawKeyDown', key: 'Tab', code: 'Tab', windowsVirtualKeyCode: 9, nativeVirtualKeyCode: 9, modifiers: 8 });
                    assert.equal(await evaluate("document.activeElement === [...document.querySelectorAll('.mobile-nav a')].at(-1)"), true, file + ': keyboard focus wraps');
                    await cdp('Input.dispatchKeyEvent', { type: 'rawKeyDown', key: 'Escape', code: 'Escape', windowsVirtualKeyCode: 27, nativeVirtualKeyCode: 27 });
                    assert.equal(await evaluate("document.querySelector('.mobile-nav').hidden && !document.body.classList.contains('menu-open') && !document.querySelector('main').inert"), true, file + ': Escape restores page');
                    await evaluate("document.querySelector('.mobile-menu-trigger').click(); document.querySelector('.mobile-nav-overlay').click()");
                    assert.equal(await evaluate("document.querySelector('.mobile-nav').hidden"), true, file + ': overlay closes drawer');
                }
                if (file.startsWith('index') && [390, 1440].includes(width)) {
                    assert.deepEqual(await evaluate("Array.from(document.querySelectorAll('main > section'), section => section.id)"), ['home','program-finder','about-confiance','core-services','student-journey','partnerships','faq'], 'Homepage sections follow the requested order');
                    assert.match(await evaluate("document.querySelector('h1').textContent"), /Welcome to\s+Confiance/);
                    assert.equal(await evaluate("document.getElementById('home-title').getBoundingClientRect().height > 0 && getComputedStyle(document.querySelector('.hp-hero-copy')).opacity === '1'"), true, 'Welcome details are visible immediately');
                    assert.equal(await evaluate("document.querySelectorAll('.hp-service-card').length"), 6, 'Six core services are displayed');
                    assert.equal(await evaluate("document.querySelectorAll('.hp-journey-list > li').length"), 7, 'Seven student journey steps are displayed');
                    assert.equal(await evaluate("document.querySelectorAll('.hp-partner-card').length"), 3, 'All three requested partners are displayed');
                    assert.deepEqual(await evaluate("Array.from(document.getElementById('finder-country').options).map(option=>option.value).filter(Boolean)"), ['Japan','Italy','Romania','Canada','France'], 'Finder includes the requested countries');
                    await evaluate("document.getElementById('quick-program-finder').requestSubmit()");
                    assert.equal(await evaluate("document.getElementById('finder-results').hidden"), true, 'Incomplete finder details do not produce an enquiry');

                    await evaluate("document.getElementById('finder-age').value='25';document.getElementById('finder-age').dispatchEvent(new Event('input',{bubbles:true}));document.querySelector('[data-age-step=\"1\"]').click()");
                    assert.equal(await evaluate("document.getElementById('finder-age').value"), '26', 'Increase age works');
                    await evaluate("document.querySelector('[data-age-step=\"-1\"]').click()");
                    assert.equal(await evaluate("document.getElementById('finder-age').value"), '25', 'Decrease age works');
                    await evaluate("document.getElementById('finder-age').value='1';document.getElementById('finder-age').dispatchEvent(new Event('input',{bubbles:true}))");
                    assert.equal(await evaluate("document.querySelector('[data-age-step=\"-1\"]').disabled"), true, 'Age stepper respects its lower input bound');
                    await evaluate("document.getElementById('finder-age').value='100';document.getElementById('finder-age').dispatchEvent(new Event('input',{bubbles:true}))");
                    assert.equal(await evaluate("document.querySelector('[data-age-step=\"1\"]').disabled"), true, 'Age stepper respects its upper input bound');
                    await evaluate("document.getElementById('finder-age').value='25';document.getElementById('finder-grade').value='G.C.E. O/L';document.getElementById('finder-gender').value='Male';document.querySelector('[data-finder-country=France]').click();document.getElementById('quick-program-finder').requestSubmit()");
                    assert.equal(await evaluate("document.getElementById('finder-results').hidden"), false, 'Finder produces a usable pathway enquiry');
                    assert.match(await evaluate("document.getElementById('finder-result-title').textContent"), /France/);
                    assert.match(await evaluate("document.querySelector('.hp-pathway-title').textContent"), /Butcher/, 'France for male candidates recommends Butcher');
                    assert.match(await evaluate("document.getElementById('finder-summary-statement').textContent"), /Butcher/);
                    assert.match(await evaluate("document.querySelector('.hp-results-notice').textContent"), /No published job matches/);
                    const guidance = await evaluate("document.getElementById('finder-guidance').textContent");
                    await evaluate("document.getElementById('finder-gender').value='Female';document.getElementById('quick-program-finder').requestSubmit()");
                    assert.equal(await evaluate("document.getElementById('finder-guidance').textContent"), guidance, 'Gender does not exclude people or change pathway guidance');
                    const enquiry = await evaluate("new URL(document.getElementById('finder-whatsapp').href).searchParams.get('text')");
                    assert.match(enquiry, /Country: France/);
                    assert.match(enquiry, /Age: 25/);
                    assert.match(enquiry, /Education: G.C.E. O\/L/);
                    assert.match(enquiry, /Gender: Female/);
                    assert.equal(await evaluate("new URL(document.getElementById('finder-whatsapp').href).hostname"), 'wa.me');
                    assert.match(await evaluate("document.getElementById('finder-email').href"), /^mailto:info@confiance\.lk/);
                    for (const destination of ['Japan','Italy','Romania','Canada','France']) {
                        await evaluate("document.getElementById('finder-country').value="+JSON.stringify(destination)+";document.getElementById('quick-program-finder').requestSubmit()");
                        assert.match(await evaluate("document.getElementById('finder-result-title').textContent"), new RegExp(destination), 'Finder supports '+destination);
                    }
                    await evaluate("document.getElementById('reset-program-finder').click()");
                    assert.equal(await evaluate("document.getElementById('finder-results').hidden && document.getElementById('finder-country').value === '' && document.getElementById('finder-age').value === ''"), true, 'Start again clears the finder');

                    for (let i = 1; i <= 6; i++) {
                        if (await evaluate("document.getElementById('home-faq-"+i+"').open")) {
                            await evaluate("document.querySelector('#home-faq-"+i+" summary').click()");
                            await settle(50);
                        }
                        await evaluate("document.querySelector('#home-faq-"+i+" summary').click()");
                        await settle(50);
                        assert.equal(await evaluate("document.getElementById('home-faq-"+i+"').open"), true, file+': FAQ '+i+' opens');
                        assert.equal(await evaluate("document.querySelectorAll('.hp-faq-item[open]').length"), 1, 'FAQ keeps one answer open at a time');
                    }
                    await navigate(base + '/' + file);
                    console.log('PASS: homepage finder, age controls, enquiry links, seven journey steps and FAQ at '+width+'px');
                }

            }
            if (file === 'careers.html' && [390, 1440].includes(width)) {
                for (let attempt = 0; attempt < 40 && !(await evaluate("!document.getElementById('career-application-fields').disabled")); attempt++) await settle(50);
                assert.equal(await evaluate("!document.getElementById('career-application-fields').disabled"), true, 'Application form becomes available after CSRF preparation');
                assert.equal(await evaluate("document.getElementById('application-dialog').open"), false, 'Application form is hidden until Apply is selected');
                assert.equal(await evaluate("document.querySelector('.careers-vacancy-post').getBoundingClientRect().width >= document.querySelector('.careers-opportunities .careers-container').getBoundingClientRect().width - 2"), true, 'Vacancy post spans the full content width');
                assert.equal(await evaluate("document.querySelector('.careers-poster-link img').naturalWidth > 0"), true, 'Hiring poster loads');
                await evaluate("window.scrollTo({ top: document.querySelector('.careers-vacancy-post').getBoundingClientRect().top + scrollY - 140, behavior: 'instant' })");
                await evaluate("document.querySelector('.careers-role-details summary').click()");
                assert.equal(await evaluate("document.querySelector('.careers-role-details').open"), true, 'Role details expand accessibly');
                await evaluate("document.querySelector('[data-apply-role=general]').click()");
                assert.equal(await evaluate("document.getElementById('career-role').value"), 'general', 'General application selects the intended role');
                assert.equal(await evaluate("document.getElementById('application-dialog').open && document.body.classList.contains('application-open')"), true, 'General application opens a modal and locks background scrolling');
                await settle(60);
                assert.equal(await evaluate("document.activeElement.id"), 'career-name', 'Popup focuses the name field');
                await evaluate("document.querySelector('[data-close-application]').focus()");
                await cdp('Input.dispatchKeyEvent', { type: 'rawKeyDown', key: 'Tab', code: 'Tab', windowsVirtualKeyCode: 9, nativeVirtualKeyCode: 9, modifiers: 8 });
                assert.equal(await evaluate("document.getElementById('application-dialog').contains(document.activeElement)"), true, 'Keyboard navigation stays within the modal: ' + await evaluate("document.activeElement.outerHTML.slice(0,220)"));
                await cdp('Input.dispatchKeyEvent', { type: 'rawKeyDown', key: 'Escape', code: 'Escape', windowsVirtualKeyCode: 27, nativeVirtualKeyCode: 27 });
                await settle(60);
                assert.equal(await evaluate("!document.getElementById('application-dialog').open && !document.body.classList.contains('application-open') && document.activeElement.dataset.applyRole === 'general'"), true, 'Escape closes the popup and restores focus: ' + await evaluate("JSON.stringify({open:document.getElementById('application-dialog').open, locked:document.body.classList.contains('application-open'),active:document.activeElement.outerHTML.slice(0,180)})"));
                await evaluate("document.querySelector('[data-apply-role=japanese-teacher]').click()");
                assert.equal(await evaluate("document.getElementById('career-role').value"), 'japanese-teacher', 'Apply button selects Japanese Teacher');
                assert.equal(await evaluate("document.getElementById('application-dialog').open"), true, 'Role Apply opens the application popup');
                await evaluate("document.getElementById('career-name').value='Draft Applicant'; document.querySelector('[data-close-application]').click()");
                await settle(60);
                assert.equal(await evaluate("!document.getElementById('application-dialog').open"), true, 'Close button closes the application popup');
                await evaluate("document.querySelector('[data-apply-role=japanese-teacher]').click()");
                assert.equal(await evaluate("document.getElementById('career-name').value"), 'Draft Applicant', 'Closing and reopening preserves an application draft');
                await cdp('Input.dispatchMouseEvent', { type: 'mousePressed', x: 2, y: 2, button: 'left', clickCount: 1 });
                await cdp('Input.dispatchMouseEvent', { type: 'mouseReleased', x: 2, y: 2, button: 'left', clickCount: 1 });
                await settle(60);
                assert.equal(await evaluate("!document.getElementById('application-dialog').open"), true, 'Clicking the backdrop closes the popup');
                await evaluate("document.querySelector('[data-apply-role=japanese-teacher]').click()");
                await settle(120);
                const popupImage = await cdp('Page.captureScreenshot', { format: 'png' });
                fs.writeFileSync(path.join(artifacts, 'careers-application-' + width + '.png'), Buffer.from(popupImage.data, 'base64'));
                await evaluate("document.getElementById('career-name').value='Browser Test'; document.getElementById('career-email').value='applicant@example.test'; document.getElementById('career-phone').value='+94 77 123 4567'; document.querySelector('[name=consent]').checked=true;");
                const requestCount = fixtureApplications.length;
                await evaluate("var files=new DataTransfer(); files.items.add(new File(['not a PDF'], 'fake.pdf', {type:'application/pdf'})); var input=document.getElementById('career-cv'); input.files=files.files; input.dispatchEvent(new Event('change',{bubbles:true})); document.getElementById('career-application-form').requestSubmit();");
                await settle(200);
                assert.equal(fixtureApplications.length, requestCount, 'A fake PDF is not uploaded');
                assert.equal(await evaluate("document.getElementById('application-status').dataset.state"), 'error', 'Invalid PDF is explained');
                await evaluate("var files=new DataTransfer(); files.items.add(new File(['%PDF-1.4\\n%%EOF'], 'candidate.pdf', {type:'application/pdf'})); var input=document.getElementById('career-cv'); input.files=files.files; input.dispatchEvent(new Event('change',{bubbles:true}));");
                applicationFixtureMode = 'unavailable';
                await evaluate("document.getElementById('career-application-form').requestSubmit()");
                for (let attempt = 0; attempt < 40 && fixtureApplications.length === requestCount; attempt++) await settle(50);
                await settle(100);
                assert.equal(await evaluate("document.getElementById('application-status').dataset.state"), 'error', 'Server mail failure never displays success');
                assert.equal(await evaluate("document.getElementById('career-cv').files.length === 1 && document.getElementById('career-name').value === 'Browser Test'"), true, 'Failure keeps application details for retry');
                applicationFixtureMode = 'success';
                await evaluate("document.getElementById('career-application-form').requestSubmit()");
                for (let attempt = 0; attempt < 40 && !(await evaluate("document.getElementById('application-status').dataset.state === 'success'")); attempt++) await settle(50);
                assert.equal(await evaluate("document.getElementById('application-status').dataset.state"), 'success', 'Accepted applications show confirmation');
                assert.equal(await evaluate("document.getElementById('career-application-fields').disabled"), true, 'Accepted applications cannot be submitted twice');
                assert.match(fixtureApplications.at(-1), /filename="candidate\.pdf"/);
                assert.match(fixtureApplications.at(-1), /japanese-teacher/);
                await cdp('Input.dispatchKeyEvent', { type: 'rawKeyDown', key: 'Escape', code: 'Escape', windowsVirtualKeyCode: 27, nativeVirtualKeyCode: 27 });
                await settle(60);
                await evaluate("document.querySelector('[data-apply-role=japanese-teacher]').click()");
                assert.equal(await evaluate("document.getElementById('application-dialog').open && document.getElementById('application-status').dataset.state === 'success'"), true, 'Reopening after submission keeps the confirmation visible');
                await evaluate("document.querySelector('[data-close-application]').click()");
                await settle(60);
                applicationFixtureMode = 'unavailable';
                await navigate(base + '/careers.html');
                console.log('PASS: Careers role selection, PDF upload, honest failure, retry and confirmation at ' + width + 'px');
            }
            if ([390, 1440, 1920].includes(width) && file !== 'index2.html') {
                await evaluate('document.fonts.ready');
                await settle(1200);
                const screenshot = await cdp('Page.captureScreenshot', { format: 'png', captureBeyondViewport: false });
                fs.writeFileSync(path.join(artifacts, file.replace('.html', '') + '-' + width + '.png'), Buffer.from(screenshot.data, 'base64'));
                if (file === 'index.html') {
                    const metrics = await cdp('Page.getLayoutMetrics');
                    const pageHeight = Math.ceil(metrics.cssContentSize.height);
                    const pageImage = await cdp('Page.captureScreenshot', {format:'png',captureBeyondViewport:true,clip:{x:0,y:0,width,height:pageHeight,scale:1}});
                    fs.writeFileSync(path.join(artifacts,'homepage-full-'+width+'.png'),Buffer.from(pageImage.data,'base64'));
                    await evaluate("document.querySelector('[data-finder-country=Japan]').click();document.getElementById('finder-age').value='25';document.getElementById('finder-gender').value='Female';document.getElementById('quick-program-finder').requestSubmit()");
                    await settle(150);
                    await evaluate("window.scrollTo({top:document.getElementById('program-finder').getBoundingClientRect().top+scrollY-140,behavior:'instant'})");
                    await settle(100);
                    const finderClip=await evaluate("({x:Math.floor(document.querySelector('.hp-finder-card').getBoundingClientRect().left),y:Math.ceil(document.querySelector('.hp-finder-card').getBoundingClientRect().top+scrollY),width:Math.floor(document.querySelector('.hp-finder-card').getBoundingClientRect().width),height:Math.ceil(document.querySelector('.hp-finder-card').getBoundingClientRect().height),scale:1})");
                    const finderImage=await cdp('Page.captureScreenshot',{format:'png',captureBeyondViewport:true,clip:finderClip});
                    fs.writeFileSync(path.join(artifacts,'homepage-finder-'+width+'.png'),Buffer.from(finderImage.data,'base64'));
                    await evaluate("window.scrollTo({top:0,behavior:'instant'})");
                    await settle(100);
                }

                if (file === 'careers.html') {
                    await evaluate("window.scrollTo({ top: document.querySelector('.careers-vacancy-post').getBoundingClientRect().top + scrollY - 140, behavior: 'instant' })");
                    await settle(150);
                    const postClip = await evaluate("({ x: Math.floor(document.querySelector('.careers-vacancy-post').getBoundingClientRect().left), y: Math.ceil(document.querySelector('.careers-vacancy-post').getBoundingClientRect().top + scrollY), width: Math.floor(document.querySelector('.careers-vacancy-post').getBoundingClientRect().width), height: Math.ceil(document.querySelector('.careers-vacancy-post').getBoundingClientRect().height), scale: 1 })");
                    const postImage = await cdp('Page.captureScreenshot', { format: 'png', captureBeyondViewport: true, clip: postClip });
                    fs.writeFileSync(path.join(artifacts, 'careers-post-' + width + '.png'), Buffer.from(postImage.data, 'base64'));
                    await evaluate("window.scrollTo({top:0,behavior:'instant'})");
                }
                if (file === 'index.html') {
                    const height = await evaluate("Math.ceil(document.querySelector('header').getBoundingClientRect().height) + 12");
                    const headerImage = await cdp('Page.captureScreenshot', { format: 'png', clip: { x: 0, y: 0, width, height, scale: 1 } });
                    fs.writeFileSync(path.join(artifacts, 'header-' + width + '.png'), Buffer.from(headerImage.data, 'base64'));
                    await evaluate("window.scrollTo({ top: document.querySelector(\'footer\').getBoundingClientRect().top + scrollY - 160, behavior: 'instant' })");
                    await settle(200);
                    const footerClip = await evaluate("({ x: 0, y: Math.ceil(document.querySelector(\'footer\').getBoundingClientRect().top + scrollY), width: innerWidth, height: Math.ceil(document.querySelector(\'footer\').getBoundingClientRect().height), scale: 1 })");
                    assert.equal(await evaluate("(function () { var chat = document.getElementById('whatsappFloat'); var top = document.getElementById('scrollUp'); if (!chat || !top || getComputedStyle(top).display === 'none') return true; var a = chat.getBoundingClientRect(), b = top.getBoundingClientRect(); return a.right <= b.left || b.right <= a.left || a.bottom <= b.top || b.bottom <= a.top; })()"), true, 'Floating chat and scroll controls do not overlap');
                    const footerImage = await cdp('Page.captureScreenshot', { format: 'png', captureBeyondViewport: true, clip: footerClip });
                    fs.writeFileSync(path.join(artifacts, 'footer-' + width + '.png'), Buffer.from(footerImage.data, 'base64'));
                    await evaluate("document.querySelector(\'.site-footer-backtop\').click()");
                    await settle(200);
                    for (let frame = 0; frame < 30 && !(await evaluate("scrollY <= 1")); frame++) await settle(100);
                    assert.equal(await evaluate("scrollY <= 1"), true, "Footer back-to-top link returns to the page start; scrollY=" + await evaluate("scrollY"));
                }
            }
            checks++;
        }
        if (width === 1440 && pages.includes('index.html')) {
            await navigate(base + '/index.html');
            await evaluate('window.scrollTo(0, 700)');
            await settle(100);
            assert.equal(await evaluate("Math.abs(document.querySelector('.site-header-main').getBoundingClientRect().top) <= 1"), true, 'Navigation stays at the top while scrolling');
            await evaluate('window.scrollTo(0, 0)');
        }
        console.log('PASS: all ' + pages.length + ' pages at ' + width + 'px');
    }
    await navigate(base + '/__test/missing/deep/page');
    assert.equal(await evaluate("document.querySelector('.actions a.primary').getAttribute('href')"), '/', '404 home link works from nested paths');
    await navigate(base + '/__test/gateway');
    assert.equal(await evaluate("document.querySelector('h1').textContent"), 'We are temporarily unavailable');
    await evaluate("document.querySelector('button').click()");
    await settle(300);
    assert.equal(await evaluate('location.pathname'), '/__test/gateway', '502 retries the original requested URL');

    if (pages.includes('careers.html')) {
        const fileURL = require('node:url').pathToFileURL(path.join(root, 'careers.html')).href;
        const countBeforeLocal = fixtureApplications.length;
        await navigate(fileURL);
        assert.equal(await evaluate("document.getElementById('career-application-fields').disabled"), false, 'File preview fields are editable');
        await evaluate("document.querySelector('[data-apply-role=japanese-teacher]').click()");
        await settle(100);
        await cdp('Input.insertText', { text: 'Local Preview Applicant' });
        assert.equal(await evaluate("document.getElementById('career-name').value"), 'Local Preview Applicant', 'Native typing works in the file preview');
        await evaluate("document.getElementById('career-email').value='preview@example.test';document.getElementById('career-phone').value='+94 77 123 4567';document.querySelector('[name=consent]').checked=true;var files=new DataTransfer();files.items.add(new File(['%PDF-1.4\\n%%EOF'],'preview.pdf',{type:'application/pdf'}));var input=document.getElementById('career-cv');input.files=files.files;input.dispatchEvent(new Event('change',{bubbles:true}));document.getElementById('career-application-form').requestSubmit();");
        for (let attempt = 0; attempt < 30 && !(await evaluate("document.getElementById('application-status').textContent.includes('Test passed')")); attempt++) await settle(50);
        assert.equal(await evaluate("document.getElementById('application-status').dataset.state"), 'preview', 'File preview displays a test result, not a real-submission confirmation');
        assert.match(await evaluate("document.getElementById('application-status').textContent"), /No application or email was sent/);
        assert.equal(await evaluate("!document.getElementById('career-application-fields').disabled && !document.getElementById('career-submit').disabled"), true, 'Local test can be edited and repeated');
        assert.equal(fixtureApplications.length, countBeforeLocal, 'File preview does not submit an application');
        const localImage = await cdp('Page.captureScreenshot', { format: 'png' });
        fs.writeFileSync(path.join(artifacts, 'careers-local-test.png'), Buffer.from(localImage.data, 'base64'));

        applicationPreparationAvailable = false;
        await navigate(base + '/careers.html');
        for (let attempt = 0; attempt < 30 && !(await evaluate("document.getElementById('application-status').dataset.state === 'error'")); attempt++) await settle(50);
        await evaluate("document.querySelector('[data-apply-role=japanese-teacher]').click()");
        await settle(100);
        await cdp('Input.insertText', { text: 'Offline Applicant' });
        assert.equal(await evaluate("document.getElementById('career-name').value"), 'Offline Applicant', 'Typing still works when the backend is unavailable');
        assert.equal(await evaluate("document.getElementById('career-application-fields').disabled"), false);
        assert.equal(await evaluate("document.getElementById('application-status').dataset.state"), 'error', 'Unavailable submission is reported honestly');
        applicationPreparationAvailable = true;

        applicationFixturePreview = true;
        await navigate(base + '/careers.html');
        await evaluate("document.querySelector('[data-apply-role=japanese-teacher]').click()");
        await settle(100);
        await evaluate("document.getElementById('career-name').value='PHP Preview Applicant';document.getElementById('career-email').value='preview@example.test';document.getElementById('career-phone').value='+94 77 123 4567';document.querySelector('[name=consent]').checked=true;var files=new DataTransfer();files.items.add(new File(['%PDF-1.4\\n%%EOF'],'preview.pdf',{type:'application/pdf'}));var input=document.getElementById('career-cv');input.files=files.files;input.dispatchEvent(new Event('change',{bubbles:true}));");
        applicationFixtureMode = 'success';
        await evaluate("document.getElementById('career-application-form').requestSubmit()");
        for (let attempt = 0; attempt < 40 && !(await evaluate("document.getElementById('application-status').textContent.includes('Local test complete')")); attempt++) await settle(50);
        assert.equal(await evaluate("document.getElementById('application-status').dataset.state"), 'preview', 'Server preview result is distinct from live submission');
        assert.equal(await evaluate("document.getElementById('career-csrf-token').value"), 'next-ui-test-token', 'Server preview refreshes the form token for retesting');
        assert.equal(await evaluate("document.getElementById('career-name').value === 'PHP Preview Applicant' && !document.getElementById('career-application-fields').disabled"), true, 'Server preview preserves editable test details');
        applicationFixturePreview = false;
        applicationFixtureMode = 'unavailable';
        console.log('PASS: file preview typing, local PDF checks, offline form editing and server-preview retesting.');
    }

    if (process.argv.includes('--external-smoke')) {
        await cdp('Network.setBlockedURLs', { urls: [] });
        for (const file of pages.filter(file => !/^(404|502)/.test(file))) {
            await navigate(base + '/' + file);
            await settle(1200);
            assert.equal(await evaluate("document.querySelectorAll('script[src*=elfsight], [class*=elfsight]').length"), 0, file + ': no widget loader with external resources enabled');
        }
        console.log('PASS: external-resource smoke checks on all 5 public pages.');
    }
    assert.deepEqual(widgetRequests, [], 'No expired widget requests');
    assert.deepEqual(reportedDebugMessages, [], 'Reported widget/search console messages are absent');
    assert.deepEqual(exceptions, [], 'No uncaught browser JavaScript errors');
    assert.deepEqual([...new Set(failures.map(item => item.url))], [], 'No failed local resource requests');
    console.log('PASS: ' + checks + ' page/viewport combinations, navigation keyboard controls, application dialogs, FAQ/hero interactions, error recovery, and local assets.');
    console.log('Screenshots: ' + artifacts);
}
main().catch(error => { console.error(error.stack); process.exitCode = 1; }).finally(async () => {
    if (ws && ws.readyState === WebSocket.OPEN) {
        try { await cdp('Browser.close', {}, true); } catch {}
        ws.close();
    }
    if (browser) browser.kill();
    server.close();
});
