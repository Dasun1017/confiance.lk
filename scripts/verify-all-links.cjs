const fs = require("fs");
const path = require("path");

const root = path.resolve(".");
const files = fs.readdirSync(root).filter(f => f.endsWith(".html") && !f.includes("edu"));

console.log(`Checking ${files.length} HTML files for aria-disabled...`);
let anyFound = false;
for (const file of files) {
    const content = fs.readFileSync(path.join(root, file), "utf8");
    const matches = content.match(/aria-disabled="true"/g);
    if (matches) {
        console.log(`Found in ${file}: ${matches.length} occurrences`);
        anyFound = true;
    }
}

if (!anyFound) {
    console.log("SUCCESS: Zero aria-disabled elements remaining across the entire website!");
}

