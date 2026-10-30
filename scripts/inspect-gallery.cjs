const fs = require("fs");

const content = fs.readFileSync("gallery.html", "utf8");
const regex = /<article class="gl-item"[\s\S]*?<\/article>/g;
const matches = content.match(regex) || [];

console.log("Total gallery items:", matches.length);
matches.forEach((item, idx) => {
    const catMatch = item.match(/data-category="([^"]+)"/);
    const titleMatch = item.match(/<h2 class="gl-item-title">([\s\S]*?)<\/h2>/);
    const srcMatch = item.match(/src="([^"]+)"/);
    const category = catMatch ? catMatch[1] : "unknown";
    const title = titleMatch ? titleMatch[1].trim() : "no title";
    const src = srcMatch ? srcMatch[1] : "no src";
    console.log(`${(idx + 1).toString().padStart(2, '0')}: [${category.padEnd(20)}] ${title.padEnd(50)} -> ${src}`);
});

