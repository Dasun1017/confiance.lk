const fs = require("fs");
const path = require("path");

const root = path.resolve(".");
const files = fs.readdirSync(root).filter(f => f.endsWith(".html"));

console.log("Found " + files.length + " HTML files in root:");
for (const file of files) {
    const content = fs.readFileSync(path.join(root, file), "utf8");
    const hasDisabledVoc = content.includes('aria-disabled="true">Vocational Training');
    const hasActiveVoc = content.includes('href="vocational-training.html"');
    const hasVocDropdown = content.includes('caregiver-training.html');
    console.log(`${file.padEnd(30)}: disabled=${hasDisabledVoc ? 'YES' : 'NO '}, activeHref=${hasActiveVoc ? 'YES' : 'NO '}, dropdown=${hasVocDropdown ? 'YES' : 'NO '}`);
}

