const fs = require("fs");
const path = require("path");

const root = path.resolve(".");

const newDesktopDropdown = `                            <div class="site-nav-dropdown" aria-label="Vocational training submenu">
                                <a href="truck-driving-training.html"><i class="fas fa-truck" aria-hidden="true"></i> Truck Driving / Logistics</a>
                                <a href="butchery-training.html"><i class="fas fa-drumstick-bite" aria-hidden="true"></i> Butchery / Meat Processing</a>
                                <a href="airport-ground-handling.html"><i class="fas fa-plane-departure" aria-hidden="true"></i> Airport Ground Handling</a>
                                <a href="caregiver-training.html"><i class="fas fa-user-doctor" aria-hidden="true"></i> Caregiving / Elder Care</a>
                                <a href="hospitality-training.html"><i class="fas fa-utensils" aria-hidden="true"></i> Hospitality &amp; Food Services</a>
                                <a href="agriculture-training.html"><i class="fas fa-seedling" aria-hidden="true"></i> Agriculture &amp; Greenhouse</a>
                            </div>`;

const newMobileSubNav = `                    <div class="mobile-sub-nav" aria-label="Vocational training">
                        <a href="truck-driving-training.html"><i class="fas fa-truck" aria-hidden="true"></i> Truck Driving / Logistics</a>
                        <a href="butchery-training.html"><i class="fas fa-drumstick-bite" aria-hidden="true"></i> Butchery / Meat Processing</a>
                        <a href="airport-ground-handling.html"><i class="fas fa-plane-departure" aria-hidden="true"></i> Airport Ground Handling</a>
                        <a href="caregiver-training.html"><i class="fas fa-user-doctor" aria-hidden="true"></i> Caregiving / Elder Care</a>
                        <a href="hospitality-training.html"><i class="fas fa-utensils" aria-hidden="true"></i> Hospitality &amp; Food Services</a>
                        <a href="agriculture-training.html"><i class="fas fa-seedling" aria-hidden="true"></i> Agriculture &amp; Greenhouse</a>
                    </div>`;

// 1. Process all html files in root
const files = fs.readdirSync(root).filter(f => f.endsWith(".html") && f !== "404.html" && f !== "502.html");

for (const file of files) {
    let content = fs.readFileSync(path.join(root, file), "utf8");

    // Replace desktop vocational dropdown
    content = content.replace(
        /<div class="site-nav-dropdown" aria-label="Vocational training submenu">[\s\S]*?<\/div>/,
        newDesktopDropdown.trim()
    );

    // Replace mobile vocational sub nav
    content = content.replace(
        /<div class="mobile-sub-nav" aria-label="Vocational training">[\s\S]*?<\/div>/,
        newMobileSubNav.trim()
    );

    fs.writeFileSync(path.join(root, file), content, "utf8");
    console.log(`Updated dropdown in ${file}`);
}

