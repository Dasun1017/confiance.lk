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
    await cdp('Page.navigate', { url: 'http://127.0.0.1:' + port + '/gallery.html' });
    await new Promise(r => setTimeout(r, 1500));

    // 1. Gallery Grid Viewport Screenshot
    const shot = await cdp('Page.captureScreenshot', { format: 'png' });
    fs.writeFileSync('C:/Users/Confiance_LK/.gemini/antigravity/brain/0a85308b-7cb9-4584-af8f-883c2aa82b66/gallery-overview-1440.png', Buffer.from(shot.data, 'base64'));

    // 2. Open Lightbox on first photo
    await cdp('Runtime.evaluate', { expression: 'document.querySelector(".gl-item").click()' });
    await new Promise(r => setTimeout(r, 600));
    const lbShot = await cdp('Page.captureScreenshot', { format: 'png' });
    fs.writeFileSync('C:/Users/Confiance_LK/.gemini/antigravity/brain/0a85308b-7cb9-4584-af8f-883c2aa82b66/gallery-lightbox-modal.png', Buffer.from(lbShot.data, 'base64'));

    // 3. Close Lightbox & Click a filter tab (Vocational Practice)
    await cdp('Runtime.evaluate', { expression: 'document.querySelector(".gl-lb-close-btn").click()' });
    await new Promise(r => setTimeout(r, 400));
    await cdp('Runtime.evaluate', { expression: 'document.querySelector("[data-filter=\\"vocational-practice\\"]").click()' });
    await new Promise(r => setTimeout(r, 400));
    const filterShot = await cdp('Page.captureScreenshot', { format: 'png' });
    fs.writeFileSync('C:/Users/Confiance_LK/.gemini/antigravity/brain/0a85308b-7cb9-4584-af8f-883c2aa82b66/gallery-filter-vocational.png', Buffer.from(filterShot.data, 'base64'));

    console.log('Saved gallery screenshots successfully!');
    browser.kill();
    server.close();
    process.exit(0);
});

