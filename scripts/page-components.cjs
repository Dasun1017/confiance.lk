const fs = require('fs');
const path = require('path');

const indexHtml = fs.readFileSync(path.join(__dirname, '..', 'index.html'), 'utf8');

// Extract header
const headerStart = indexHtml.indexOf('<header class="header-area site-header">');
const headerEnd = indexHtml.indexOf('</header>') + 9;
const sharedHeader = indexHtml.substring(headerStart, headerEnd);

// Extract footer
const footerStart = indexHtml.indexOf('<footer class="site-footer">');
const footerEnd = indexHtml.indexOf('</footer>') + 9;
const sharedFooter = indexHtml.substring(footerStart, footerEnd);

// Extract scripts
const scriptsStart = indexHtml.indexOf('<a href="https://wa.me/94760407677" id="whatsappFloat"');
const scriptsEnd = indexHtml.indexOf('</body>');
const sharedScripts = indexHtml.substring(scriptsStart, scriptsEnd);

module.exports = { sharedHeader, sharedFooter, sharedScripts };
