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
    await cdp('Page.navigate', { url: 'http://127.0.0.1:' + port + '/about.html' });
    await new Promise(r => setTimeout(r, 1500));

    // Full page screenshot
    const metrics = await cdp('Page.getLayoutMetrics');
    const height = Math.ceil(metrics.cssContentSize.height);
    const fullShot = await cdp('Page.captureScreenshot', { format: 'png', captureBeyondViewport: true, clip: { x: 0, y: 0, width: 1440, height: height, scale: 1 } });
    fs.writeFileSync('C:/Users/Confiance_LK/.gemini/antigravity/brain/0a85308b-7cb9-4584-af8f-883c2aa82b66/about-full-1440.png', Buffer.from(fullShot.data, 'base64'));

    // Founder section screenshot
    const founderClip = await cdp('Runtime.evaluate', {
        expression: `({
            x: Math.floor(document.getElementById('founder-message').getBoundingClientRect().left),
            y: Math.ceil(document.getElementById('founder-message').getBoundingClientRect().top + scrollY),
            width: Math.floor(document.getElementById('founder-message').getBoundingClientRect().width),
            height: Math.ceil(document.getElementById('founder-message').getBoundingClientRect().height),
            scale: 1
        })`,
        returnByValue: true
    });
    const founderShot = await cdp('Page.captureScreenshot', { format: 'png', captureBeyondViewport: true, clip: founderClip.result.value });
    fs.writeFileSync('C:/Users/Confiance_LK/.gemini/antigravity/brain/0a85308b-7cb9-4584-af8f-883c2aa82b66/about-founder-message.png', Buffer.from(founderShot.data, 'base64'));

    // What makes us different screenshot
    const diffClip = await cdp('Runtime.evaluate', {
        expression: `({
            x: Math.floor(document.getElementById('what-makes-us-different').getBoundingClientRect().left),
            y: Math.ceil(document.getElementById('what-makes-us-different').getBoundingClientRect().top + scrollY),
            width: Math.floor(document.getElementById('what-makes-us-different').getBoundingClientRect().width),
            height: Math.ceil(document.getElementById('what-makes-us-different').getBoundingClientRect().height),
            scale: 1
        })`,
        returnByValue: true
    });
    const diffShot = await cdp('Page.captureScreenshot', { format: 'png', captureBeyondViewport: true, clip: diffClip.result.value });
    fs.writeFileSync('C:/Users/Confiance_LK/.gemini/antigravity/brain/0a85308b-7cb9-4584-af8f-883c2aa82b66/about-what-makes-us-different.png', Buffer.from(diffShot.data, 'base64'));

    console.log('Saved all screenshots! Full height:', height);
    browser.kill();
    server.close();
    process.exit(0);
});

