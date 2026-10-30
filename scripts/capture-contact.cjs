const fs = require('fs');
const http = require('http');
const path = require('path');
const { spawn } = require('child_process');

const root = path.resolve('.');
const server = http.createServer((req, res) => {
    let p = path.join(root, decodeURIComponent(req.url.split('?')[0]).replace(/^\/+/, '') || 'index.html');
    if (!fs.existsSync(p)) { res.writeHead(404); return res.end('Not found'); }
    res.writeHead(200);
    fs.createReadStream(p).pipe(res);
});

server.listen(0, async () => {
    const port = server.address().port;
    const chrome = 'C:/Program Files/Google/Chrome/Application/chrome.exe';
    const browser = spawn(chrome, ['--headless=new', '--disable-gpu', '--remote-debugging-port=0'], { windowsHide: true });
    let wsUrl = '';
    browser.stderr.on('data', d => {
        const m = d.toString().match(/DevTools listening on (ws:\/\/[^\s]+)/);
        if (m) wsUrl = m[1];
    });
    while (!wsUrl) await new Promise(r => setTimeout(r, 50));
    const ws = new WebSocket(wsUrl);
    await new Promise(r => ws.onopen = r);
    let id = 1;
    function send(method, params = {}) {
        return new Promise((resolve) => {
            const curId = id++;
            const handler = (evt) => {
                const msg = JSON.parse(evt.data);
                if (msg.id === curId) {
                    ws.removeEventListener('message', handler);
                    resolve(msg.result);
                }
            };
            ws.addEventListener('message', handler);
            ws.send(JSON.stringify({ id: curId, method, params }));
        });
    }

    const { targetId } = await send('Target.createTarget', { url: 'about:blank' });
    const { sessionId } = await send('Target.attachToTarget', { targetId, flatten: true });

    function cdp(method, params = {}) {
        return new Promise((resolve) => {
            const curId = id++;
            const handler = (evt) => {
                const msg = JSON.parse(evt.data);
                if (msg.id === curId) {
                    ws.removeEventListener('message', handler);
                    resolve(msg.result);
                }
            };
            ws.addEventListener('message', handler);
            ws.send(JSON.stringify({ id: curId, sessionId, method, params }));
        });
    }

    await cdp('Page.enable');
    await cdp('Emulation.setDeviceMetricsOverride', { width: 1440, height: 900, deviceScaleFactor: 1, mobile: false });
    await cdp('Page.navigate', { url: 'http://127.0.0.1:' + port + '/contact.html' });
    await new Promise(r => setTimeout(r, 1500));

    // Full page screenshot
    const metrics = await cdp('Page.getLayoutMetrics');
    const height = Math.ceil(metrics.cssContentSize.height);
    const fullShot = await cdp('Page.captureScreenshot', { format: 'png', captureBeyondViewport: true, clip: { x: 0, y: 0, width: 1440, height: height, scale: 1 } });
    fs.writeFileSync('C:/Users/Confiance_LK/.gemini/antigravity/brain/0a85308b-7cb9-4584-af8f-883c2aa82b66/contact-full-1440.png', Buffer.from(fullShot.data, 'base64'));

    // Main Form Section Screenshot
    const formClip = await cdp('Runtime.evaluate', {
        expression: `({
            x: Math.floor(document.querySelector('.ct-main-section').getBoundingClientRect().left),
            y: Math.ceil(document.querySelector('.ct-main-section').getBoundingClientRect().top + scrollY),
            width: Math.floor(document.querySelector('.ct-main-section').getBoundingClientRect().width),
            height: Math.ceil(document.querySelector('.ct-main-section').getBoundingClientRect().height),
            scale: 1
        })`,
        returnByValue: true
    });
    const formShot = await cdp('Page.captureScreenshot', { format: 'png', captureBeyondViewport: true, clip: formClip.result.value });
    fs.writeFileSync('C:/Users/Confiance_LK/.gemini/antigravity/brain/0a85308b-7cb9-4584-af8f-883c2aa82b66/contact-form-section.png', Buffer.from(formShot.data, 'base64'));

    // Map Section Screenshot
    const mapClip = await cdp('Runtime.evaluate', {
        expression: `({
            x: Math.floor(document.querySelector('.ct-map-section').getBoundingClientRect().left),
            y: Math.ceil(document.querySelector('.ct-map-section').getBoundingClientRect().top + scrollY),
            width: Math.floor(document.querySelector('.ct-map-section').getBoundingClientRect().width),
            height: Math.ceil(document.querySelector('.ct-map-section').getBoundingClientRect().height),
            scale: 1
        })`,
        returnByValue: true
    });
    const mapShot = await cdp('Page.captureScreenshot', { format: 'png', captureBeyondViewport: true, clip: mapClip.result.value });
    fs.writeFileSync('C:/Users/Confiance_LK/.gemini/antigravity/brain/0a85308b-7cb9-4584-af8f-883c2aa82b66/contact-map-section.png', Buffer.from(mapShot.data, 'base64'));

    console.log('Saved contact screenshots! Full height:', height);
    browser.kill();
    server.close();
    process.exit(0);
});

