const fs = require('fs');
const path = require('path');

// Extract footer from index.html
const indexContent = fs.readFileSync('index.html', 'utf8');
const footerMatch = indexContent.match(/<footer class="site-footer">[\s\S]*?<\/footer>/i);

if (!footerMatch) {
    console.error('Could not find footer in index.html');
    process.exit(1);
}

const targetFooter = footerMatch[0];
console.log('Target footer extracted, length:', targetFooter.length);

const whatsappFloatHtml = `
    <a href="https://wa.me/94760407677" id="whatsappFloat" target="_blank" rel="noopener noreferrer"
        title="Chat on WhatsApp" style=" position: fixed;
            height: 45px;
            width: 45px;
            right: 50px;
            bottom: 132px;
            background: #25d366;
            color: #fff;
            font-size: 22px;
            text-align: center;
            border-radius: 50%;
            line-height: 45px;
            transition: .3s;
            z-index: 999;
            box-shadow: 0 2px 6px rgba(0,0,0,.2);"><i class="fab fa-whatsapp"></i></a>`;

const targetFiles = [
    'index2.html',
    'about.html',
    'teachers.html',
    'careers.html',
    'partnerships.html',
    'career-pathway.html',
    'gallery.html',
    'language-programs.html',
    'japanese-language.html',
    'italian-language.html',
    'french-language.html',
    'korean-language.html',
    'contact.html'
];

targetFiles.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');
    const existingFooter = content.match(/<footer[\s\S]*?<\/footer>/i);
    
    if (existingFooter) {
        content = content.replace(existingFooter[0], targetFooter);
        
        // Ensure whatsappFloat is present after footer if missing
        if (!content.includes('id="whatsappFloat"') && !content.includes("id='whatsappFloat'")) {
            content = content.replace('</footer>', '</footer>\n' + whatsappFloatHtml);
        }
        
        fs.writeFileSync(file, content, 'utf8');
        console.log(`Updated footer in ${file}`);
    } else {
        console.warn(`No footer found in ${file}`);
    }
});

console.log('Footer synchronization complete across all pages!');

