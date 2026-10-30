const fs = require('fs');
const files = fs.readdirSync('.').filter(f => f.endsWith('.html') && f !== 'gallery.html');
const target = '<li><a role="link" aria-disabled="true">Gallery</a></li>';
const replacement = '<li><a href="gallery.html">Gallery</a></li>';

files.forEach(f => {
    let content = fs.readFileSync(f, 'utf8');
    if (content.includes(target)) {
        const count = content.split(target).length - 1;
        content = content.replaceAll(target, replacement);
        fs.writeFileSync(f, content, 'utf8');
        console.log(`${f}: replaced ${count} occurrences`);
    }
});

