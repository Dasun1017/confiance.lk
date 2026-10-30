const fs = require("fs");
const path = require("path");

const root = path.resolve(".");
const files = fs.readdirSync(root).filter(f => f.endsWith(".html") && f !== "404.html" && f !== "502.html");

const targetDisabled = /<li>\s*<a\s+role="link"\s+aria-disabled="true">\s*Visa Consultation\s*<\/a>\s*<\/li>/g;
const replacement = '<li><a href="visa-consultation.html">Visa Consultation</a></li>';

let totalReplaced = 0;

for (const file of files) {
    if (file === "visa-consultation.html") continue;
    let content = fs.readFileSync(path.join(root, file), "utf8");
    const matches = content.match(targetDisabled);
    if (matches && matches.length > 0) {
        content = content.replace(targetDisabled, replacement);
        fs.writeFileSync(path.join(root, file), content, "utf8");
        console.log(`Updated ${file}: replaced ${matches.length} occurrences`);
        totalReplaced += matches.length;
    } else {
        console.log(`No matches in ${file}`);
    }
}

console.log(`Done! Total replaced: ${totalReplaced}`);

