const fs = require("fs");
const path = require("path");

const files = [
  'about.html', 'career-pathway.html', 'careers.html', 'contact.html',
  'french-language.html', 'gallery.html', 'index.html', 'index2.html',
  'italian-language.html', 'japanese-language.html', 'korean-language.html',
  'language-programs.html', 'partnerships.html', 'teachers.html'
];

const desktopNavReplacement = `                        <li class="has-dropdown">
                            <a href="vocational-training.html">Vocational Training</a>
                            <div class="site-nav-dropdown" aria-label="Vocational training submenu">
                                <a href="caregiver-training.html"><i class="fas fa-user-doctor" aria-hidden="true"></i> Caregiving / Elder Care</a>
                                <a href="butchery-training.html"><i class="fas fa-drumstick-bite" aria-hidden="true"></i> Butchery / Meat Processing</a>
                                <a href="airport-ground-handling.html"><i class="fas fa-plane-departure" aria-hidden="true"></i> Airport Ground Handling</a>
                                <a href="hospitality-training.html"><i class="fas fa-utensils" aria-hidden="true"></i> Hospitality &amp; Food Services</a>
                                <a href="agriculture-training.html"><i class="fas fa-seedling" aria-hidden="true"></i> Agriculture &amp; Greenhouse</a>
                                <a href="manufacturing-training.html"><i class="fas fa-industry" aria-hidden="true"></i> Factory &amp; Manufacturing</a>
                            </div>
                        </li>`;

const mobileNavReplacement = `                <li class="has-dropdown mobile-has-dropdown">
                    <a href="vocational-training.html">Vocational Training</a>
                    <div class="mobile-sub-nav" aria-label="Vocational training">
                        <a href="caregiver-training.html"><i class="fas fa-user-doctor" aria-hidden="true"></i> Caregiving / Elder Care</a>
                        <a href="butchery-training.html"><i class="fas fa-drumstick-bite" aria-hidden="true"></i> Butchery / Meat Processing</a>
                        <a href="airport-ground-handling.html"><i class="fas fa-plane-departure" aria-hidden="true"></i> Airport Ground Handling</a>
                        <a href="hospitality-training.html"><i class="fas fa-utensils" aria-hidden="true"></i> Hospitality &amp; Food Services</a>
                        <a href="agriculture-training.html"><i class="fas fa-seedling" aria-hidden="true"></i> Agriculture &amp; Greenhouse</a>
                        <a href="manufacturing-training.html"><i class="fas fa-industry" aria-hidden="true"></i> Factory &amp; Manufacturing</a>
                    </div>
                </li>`;

const footerReplacement = `                        <li><a href="vocational-training.html">Vocational Training</a></li>`;

for (const f of files) {
    let content = fs.readFileSync(f, "utf8");
    
    // 1. Locate desktop nav
    const desktopNavStart = content.indexOf('<nav class="site-desktop-nav"');
    const desktopNavEnd = content.indexOf('</nav>', desktopNavStart);
    if (desktopNavStart !== -1 && desktopNavEnd !== -1) {
        let navSlice = content.slice(desktopNavStart, desktopNavEnd);
        navSlice = navSlice.replace(/<li>\s*<a role="link" aria-disabled="true">\s*Vocational Training\s*<\/a>\s*<\/li>/, desktopNavReplacement);
        content = content.slice(0, desktopNavStart) + navSlice + content.slice(desktopNavEnd);
    }

    // 2. Locate mobile nav
    const mobileNavStart = content.indexOf('<nav class="mobile-nav"');
    const mobileNavEnd = content.indexOf('</nav>', mobileNavStart);
    if (mobileNavStart !== -1 && mobileNavEnd !== -1) {
        let navSlice = content.slice(mobileNavStart, mobileNavEnd);
        navSlice = navSlice.replace(/<li>\s*<a role="link" aria-disabled="true">\s*Vocational Training\s*<\/a>\s*<\/li>/, mobileNavReplacement);
        content = content.slice(0, mobileNavStart) + navSlice + content.slice(mobileNavEnd);
    }

    // 3. Locate footer
    const footerStart = content.indexOf('<footer class="site-footer"');
    if (footerStart !== -1) {
        let footerSlice = content.slice(footerStart);
        footerSlice = footerSlice.replace(/<li>\s*<a role="link" aria-disabled="true">\s*Vocational Training\s*<\/a>\s*<\/li>/, footerReplacement);
        content = content.slice(0, footerStart) + footerSlice;
    }

    // In index.html, update the Vocational Training service card CTA link
    if (f === 'index.html') {
        content = content.replace(
            `<h3>Vocational Training</h3>\n                        <p>Build hands-on foundations and workplace readiness through guided vocational preparation and\n                            practical learning.</p><a href="contact.html">Ask about training <i`,
            `<h3>Vocational Training</h3>\n                        <p>Build hands-on foundations and workplace readiness through guided vocational preparation and\n                            practical learning.</p><a href="vocational-training.html">Explore vocational training <i`
        );
    }

    fs.writeFileSync(f, content, "utf8");
    console.log(`Updated ${f}`);
}

