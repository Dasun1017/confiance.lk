const fs = require('fs');
const path = require('path');
const { sharedHeader, sharedFooter, sharedScripts } = require('./page-components.cjs');

const rootDir = path.join(__dirname, '..');

function renderPage({
    title,
    description,
    canonical,
    themeClass,
    content
}) {
    return `<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>${title}</title>
    <meta name="description" content="${description}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="newTemplate/images/new_confiance_logo.png">

    <link rel="stylesheet" href="newTemplate/css/bootstrap.min.css">
    <link rel="stylesheet" href="newTemplate/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="newTemplate/css/default.css">
    <link rel="stylesheet" href="newTemplate/css/style.css">
    <link rel="stylesheet" href="newTemplate/css/responsive.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="newTemplate/css/frontend.css">
    <link rel="stylesheet" href="newTemplate/css/languages.css">
</head>

<body id="page-top" class="lang-page ${themeClass}">
    <a class="skip-link" href="#main-content">Skip to content</a>

    ${sharedHeader}

    <main id="main-content">
        ${content}
    </main>

    ${sharedFooter}

    ${sharedScripts}
</body>

</html>
`;
}

// --------------------------------------------------------------------------
// 1. Overview Page: language-programs.html
// --------------------------------------------------------------------------
const overviewContent = `
    <!-- Hero Section -->
    <section class="lp-hero" aria-labelledby="lp-main-title">
        <div class="lp-container">
            <nav class="lp-breadcrumbs" aria-label="Breadcrumb">
                <a href="index.html">Home</a>
                <span class="separator"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                <span class="current">Language Programs</span>
            </nav>

            <div class="lp-hero-grid">
                <div>
                    <span class="lp-eyebrow"><i class="fas fa-globe" aria-hidden="true"></i> CONFIANCE LANGUAGE ACADEMY</span>
                    <h1 id="lp-main-title">Master Global Languages for <span class="highlight">Study &amp; Careers</span></h1>
                    <p class="lp-hero-lead">
                        Structured foreign language education engineered for international communication, study visas, and overseas career readiness. Learn in our modern Negombo academy or join live interactive online sessions from anywhere.
                    </p>
                    <div class="lp-hero-actions">
                        <a href="#programs-grid" class="lp-btn-primary">Explore 4 Languages <i class="fas fa-arrow-down" aria-hidden="true"></i></a>
                        <a href="#admissions-enquiry" class="lp-btn-secondary">Enquire About Admissions <i class="fas fa-paper-plane" aria-hidden="true"></i></a>
                    </div>
                    <div class="lp-hero-badges">
                        <span><i class="fas fa-check-circle" aria-hidden="true"></i> In-Person &amp; Live Online</span>
                        <span><i class="fas fa-certificate" aria-hidden="true"></i> JLPT, DELF &amp; TOPIK Prep</span>
                        <span><i class="fas fa-user-check" aria-hidden="true"></i> Certified Lecturers</span>
                    </div>
                </div>

                <div class="lp-hero-card">
                    <img src="newTemplate/images/1st_home.png" alt="Students engaged in language learning at Confiance Negombo" class="lp-hero-card-img" width="600" height="360">
                    <div class="lp-hero-card-meta">
                        <div class="lp-meta-box">
                            <strong>Languages Offered</strong>
                            <span>4 Destination Tracks</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Class Formats</strong>
                            <span>Negombo Campus &amp; Online</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Class Size</strong>
                            <span>12 - 18 Students Max</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Intakes</strong>
                            <span>Monthly Batches</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Overview 4-Card Grid Section -->
    <section class="lp-section" id="programs-grid" aria-labelledby="programs-grid-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-compass" aria-hidden="true"></i> FOUR PATHWAY OPTIONS</span>
                <h2 id="programs-grid-heading">Choose Your Target Language</h2>
                <p>Select your destination language to explore curriculum modules, intake schedules, exam support, and enrollment requirements.</p>
            </div>

            <div class="lp-overview-grid">
                <!-- Japanese Card -->
                <article class="lp-overview-card">
                    <div class="lp-overview-flag"><img src="newTemplate/images/flags/japan.svg" alt="Flag of Japan" width="52" height="35" class="lp-card-flag"></div>
                    <h3>Japanese Language</h3>
                    <p class="lp-overview-desc">Language training for communication, study and Japan-oriented work preparation.</p>
                    <div class="lp-overview-tags">
                        <span>JLPT N5 / N4 / N3</span>
                        <span>JFT-Basic</span>
                        <span>SSW &amp; TITP Ready</span>
                    </div>
                    <a href="japanese-language.html" class="lp-overview-cta">View Program <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </article>

                <!-- Italian Card -->
                <article class="lp-overview-card">
                    <div class="lp-overview-flag"><img src="newTemplate/images/flags/italy.svg" alt="Flag of Italy" width="52" height="35" class="lp-card-flag"></div>
                    <h3>Italian Language</h3>
                    <p class="lp-overview-desc">Italian language and cultural communication for learners exploring Italy-related opportunities.</p>
                    <div class="lp-overview-tags">
                        <span>CEFR A1 / A2</span>
                        <span>Conversational Drill</span>
                        <span>Hospitality &amp; Care</span>
                    </div>
                    <a href="italian-language.html" class="lp-overview-cta">View Program <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </article>

                <!-- French Card -->
                <article class="lp-overview-card">
                    <div class="lp-overview-flag"><img src="newTemplate/images/flags/france.svg" alt="Flag of France" width="52" height="35" class="lp-card-flag"></div>
                    <h3>French Language</h3>
                    <p class="lp-overview-desc">Foundation in French communication for study, daily life and career preparation.</p>
                    <div class="lp-overview-tags">
                        <span>DELF A1 / A2 Scope</span>
                        <span>Phonetics &amp; Grammar</span>
                        <span>Quebec &amp; France</span>
                    </div>
                    <a href="french-language.html" class="lp-overview-cta">View Program <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </article>

                <!-- Korean Card -->
                <article class="lp-overview-card">
                    <div class="lp-overview-flag"><img src="newTemplate/images/flags/korea.svg" alt="Flag of South Korea" width="52" height="35" class="lp-card-flag"></div>
                    <h3>Korean Language</h3>
                    <p class="lp-overview-desc">Korean language fundamentals and practical communication for relevant study or work goals.</p>
                    <div class="lp-overview-tags">
                        <span>Hangul Mastery</span>
                        <span>EPS-TOPIK Special</span>
                        <span>TOPIK I Track</span>
                    </div>
                    <a href="korean-language.html" class="lp-overview-cta">View Program <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </article>
            </div>
        </div>
    </section>

    <!-- Why Study Languages with Confiance -->
    <section class="lp-section lp-section-alt" aria-labelledby="lp-pillars-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-award" aria-hidden="true"></i> WHY CONFIANCE</span>
                <h2 id="lp-pillars-heading">Engineered for Rapid Speaking &amp; Exam Readiness</h2>
                <p>We blend structured international frameworks with intensive practical speaking drills so students gain genuine confidence.</p>
            </div>

            <div class="lp-features-grid">
                <div class="lp-feature-card">
                    <div class="lp-feature-icon"><i class="fas fa-users" aria-hidden="true"></i></div>
                    <h3>Small Class Sizes</h3>
                    <p>Every batch is strictly capped at 12 to 18 students, ensuring every learner receives personal pronunciation coaching and active speaking time.</p>
                </div>
                <div class="lp-feature-card">
                    <div class="lp-feature-icon"><i class="fas fa-laptop" aria-hidden="true"></i></div>
                    <h3>Physical &amp; Online Delivery</h3>
                    <p>Study in our modern air-conditioned Negombo campus or attend real-time interactive virtual classrooms with HD screen sharing and recorded revision backups.</p>
                </div>
                <div class="lp-feature-card">
                    <div class="lp-feature-icon"><i class="fas fa-file-alt" aria-hidden="true"></i></div>
                    <h3>Targeted Exam Prep</h3>
                    <p>Rigorous mock exams and timed question papers tailored for JLPT, JFT, DELF, and EPS-TOPIK qualification benchmarks.</p>
                </div>
                <div class="lp-feature-card">
                    <div class="lp-feature-icon"><i class="fas fa-briefcase" aria-hidden="true"></i></div>
                    <h3>Workplace &amp; Culture Focus</h3>
                    <p>Beyond textbook grammar, learn etiquette, workplace terminology, customer service phrases, and visa interview communication skills.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Delivery Modes & Campus Life -->
    <section class="lp-section" aria-labelledby="modes-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-school" aria-hidden="true"></i> STUDY YOUR WAY</span>
                <h2 id="modes-heading">Dual Delivery Options Designed for Your Schedule</h2>
                <p>Choose the format that fits your lifestyle, employment, and travel availability.</p>
            </div>

            <div class="lp-details-grid">
                <div class="lp-detail-box">
                    <h3><i class="fas fa-building" aria-hidden="true"></i> In-Person Physical Training (Negombo)</h3>
                    <p>Experience immersive face-to-face instruction at our centrally located training center in Negombo, Sri Lanka.</p>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Modern air-conditioned classrooms with multimedia audio systems.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Face-to-face dialogue drills, pair work, and interactive role-playing.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> In-person access to teachers, study materials, and library resources.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Quiet study hall and weekend discussion circles.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-video" aria-hidden="true"></i> Interactive Live Online Classes</h3>
                    <p>Connect to live, instructor-led sessions from anywhere across Sri Lanka or overseas without compromising quality.</p>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Real-time audio and video sessions with live teacher interaction.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Breakout rooms for small-group conversation practice.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Cloud-based digital workbooks, audio files, and homework reviews.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Recorded class archives accessible for revision throughout the course.</li>
                    </ul>
                </div>
            </div>

            <!-- Classroom Photos -->
            <div style="margin-top: 40px;">
                <div class="lp-gallery-grid">
                    <img src="newTemplate/images/1st_home.png" alt="Confiance classroom interactive language session" width="680" height="380">
                    <img src="newTemplate/images/3rd_home.png" alt="Students practicing communication drills in modern lecture hall" width="480" height="380">
                </div>
            </div>

            <!-- Disclaimer -->
            <div class="lp-disclaimer-banner" role="note">
                <i class="fas fa-info-circle" aria-hidden="true"></i>
                <div>
                    <strong>Academic &amp; Examination Disclaimer:</strong>
                    <p>Preparation support is different from an official examination centre. Confiance conducts exam-oriented preparatory training, syllabus coaching, and mock testing to help students qualify for examinations administered by authorized national bodies (e.g., Japan Foundation, Institut Français, HRD Korea, Italian testing institutions). We do not claim official examination centre affiliation or issue pass guarantees.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- General FAQ Section -->
    <section class="lp-section lp-section-alt" aria-labelledby="lp-faq-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-question-circle" aria-hidden="true"></i> FREQUENTLY ASKED QUESTIONS</span>
                <h2 id="lp-faq-heading">Frequently Asked Questions</h2>
                <p>Everything you need to know about our language courses, schedules, and admissions.</p>
            </div>

            <div class="lp-faq-list">
                <details class="lp-faq-item">
                    <summary>Do I need any previous knowledge of the language before joining? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        No previous knowledge is required for our beginner levels (Japanese N5, Italian A1, French A1, Korean Hangul). We start from alphabet writing, pronunciation, phonetics, and basic conversation from ground zero.
                    </div>
                </details>

                <details class="lp-faq-item">
                    <summary>Can I attend physical classes in Negombo or only online? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        Both options are actively available! You can enroll in our weekday or weekend physical classes at our Negombo training academy, or join our live interactive online classes via Zoom.
                    </div>
                </details>

                <details class="lp-faq-item">
                    <summary>Do you provide certificates upon course completion? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        Yes. Students who maintain at least 80% attendance and achieve passing scores on our internal assessments receive an official Certificate of Completion detailing their course hours and achieved CEFR / preparatory proficiency level.
                    </div>
                </details>

                <details class="lp-faq-item">
                    <summary>Can I pay the course fee in instalments? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        Yes, Confiance offers flexible instalment payment plans for all language programs. You can pay an initial registration fee to secure your seat and settle the balance across two convenient monthly instalments.
                    </div>
                </details>

                <details class="lp-faq-item">
                    <summary>How do these language programs help with overseas job visas? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        Most foreign work pathways (such as Japan SSW/TITP, Korea EPS, and European hospitality roles) mandate formal language proficiency benchmarks. Our curriculum is aligned with these official exam requirements and includes workplace vocabulary to prepare you for employer interviews.
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- Admissions Enquiry Form Section -->
    <section class="lp-section" id="admissions-enquiry" aria-labelledby="lp-enquiry-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-paper-plane" aria-hidden="true"></i> ADMISSIONS &amp; GUIDANCE</span>
                <h2 id="lp-enquiry-heading">Register or Ask About Our Courses</h2>
                <p>Submit your details below and an academic advisor from Confiance will contact you within 24 hours with class schedules and fee structures.</p>
            </div>

            <div class="lp-enquiry-card">
                <form class="lp-enquiry-form" action="contact.html" method="get">
                    <div class="lp-enquiry-field">
                        <label for="student-name">Full Name *</label>
                        <input type="text" id="student-name" name="name" placeholder="e.g. Kasun Perera" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="student-phone">Phone / WhatsApp Number *</label>
                        <input type="tel" id="student-phone" name="phone" placeholder="e.g. +94 77 123 4567" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="student-email">Email Address *</label>
                        <input type="email" id="student-email" name="email" placeholder="e.g. kasun@example.com" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="student-language">Target Language Program *</label>
                        <select id="student-language" name="language" required>
                            <option value="">-- Select Language --</option>
                            <option value="Japanese">Japanese Language (JLPT / JFT)</option>
                            <option value="Italian">Italian Language (CEFR A1 / A2)</option>
                            <option value="French">French Language (DELF A1 / A2)</option>
                            <option value="Korean">Korean Language (EPS-TOPIK / TOPIK I)</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="student-mode">Preferred Learning Mode *</label>
                        <select id="student-mode" name="mode" required>
                            <option value="Physical Negombo">In-Person (Negombo Campus)</option>
                            <option value="Interactive Online">Live Interactive Online (Zoom)</option>
                            <option value="Either">Open to Either Option</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="student-intake">Preferred Intake Window</label>
                        <select id="student-intake" name="intake">
                            <option value="Next Upcoming Batch">Next Upcoming Batch (Within 2 Weeks)</option>
                            <option value="Next Month">Next Month Batch</option>
                            <option value="Weekend Only">Weekend Classes Only</option>
                            <option value="Weekday Evenings">Weekday Evenings Only</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field lp-enquiry-full">
                        <label for="student-notes">Your Goals or Questions</label>
                        <textarea id="student-notes" name="notes" placeholder="Tell us about your goals (e.g. Japan SSW Caregiver visa, study in Italy, EPS-TOPIK exam)..."></textarea>
                    </div>

                    <div class="lp-form-actions">
                        <span style="font-size: 12px; color: #76879a;">
                            <i class="fas fa-shield-alt" aria-hidden="true"></i> Your information is kept strictly private.
                        </span>
                        <button type="submit" class="lp-btn-primary">
                            Submit Course Enquiry <i class="fas fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
`;

// --------------------------------------------------------------------------
// 2. Japanese Language Page: japanese-language.html
// --------------------------------------------------------------------------
const japaneseContent = `
    <!-- Hero Section -->
    <section class="lp-hero" aria-labelledby="jp-hero-title">
        <div class="lp-container">
            <nav class="lp-breadcrumbs" aria-label="Breadcrumb">
                <a href="index.html">Home</a>
                <span class="separator"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                <a href="language-programs.html">Language Programs</a>
                <span class="separator"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                <span class="current">Japanese Language</span>
            </nav>

            <div class="lp-hero-grid">
                <div>
                    <span class="lp-eyebrow"><img src="newTemplate/images/flags/japan.svg" alt="" width="18" height="12" class="eyebrow-flag-img"> JAPANESE LANGUAGE PROGRAM</span>
                    <h1 id="jp-hero-title">Japanese Language Program for <span class="highlight">Study &amp; Work in Japan</span></h1>
                    <p class="lp-hero-lead">
                        Language training for communication, study and Japan-oriented work preparation. Master Japanese conversation, reading, and writing with certified native and Sri Lankan lecturers for JLPT N5-N3 and JFT-Basic examinations.
                    </p>
                    <div class="lp-hero-actions">
                        <a href="#class-schedule" class="lp-btn-primary">View Class Schedule <i class="fas fa-calendar-alt" aria-hidden="true"></i></a>
                        <a href="#enquiry-form" class="lp-btn-secondary">Enquire About Admissions <i class="fas fa-paper-plane" aria-hidden="true"></i></a>
                    </div>
                    <div class="lp-hero-badges">
                        <span><i class="fas fa-check-circle" aria-hidden="true"></i> JLPT N5 / N4 / N3 &amp; JFT</span>
                        <span><i class="fas fa-hospital-user" aria-hidden="true"></i> SSW Caregiver &amp; Airport Prep</span>
                        <span><i class="fas fa-chalkboard-teacher" aria-hidden="true"></i> N1/N2 Qualified Lecturers</span>
                    </div>
                </div>

                <div class="lp-hero-card">
                    <img src="newTemplate/images/hero-japan-landscape.jpg" alt="Tokyo cityscape and Mount Fuji landscape in Japan" class="lp-hero-card-img" width="600" height="360">
                    <div class="lp-hero-card-meta">
                        <div class="lp-meta-box">
                            <strong>Target Levels</strong>
                            <span>JLPT N5, N4, N3 / JFT</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Modes Offered</strong>
                            <span>Negombo &amp; Live Online</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Course Duration</strong>
                            <span>3 to 5 Months / Level</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Batch Limit</strong>
                            <span>15 Students Maximum</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Overview & Objectives -->
    <section class="lp-section" aria-labelledby="jp-intro-heading">
        <div class="lp-container">
            <div class="lp-section-head lp-section-head-left">
                <span class="lp-eyebrow"><i class="fas fa-bullseye" aria-hidden="true"></i> COURSE PURPOSE &amp; OUTCOMES</span>
                <h2 id="jp-intro-heading">Designed for Candidates Pursuing Higher Studies &amp; Japan Work Visas</h2>
                <p>
                    Whether your goal is securing a student visa for Japanese language institutes, qualifying for Specified Skilled Worker (SSW) categories (Caregiver, Airport Ground Handling, Agriculture, Food Service), or Technical Intern Training (TITP), our program prepares you with practical fluency and exam competence.
                </p>
            </div>

            <div class="lp-details-grid">
                <div class="lp-detail-box">
                    <h3><i class="fas fa-user-graduate" aria-hidden="true"></i> Who This Course is For</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Candidates preparing for Japan student visa applications requiring 150+ verified study hours.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Job seekers aiming for SSW Specified Skilled Worker visas (Caregiver, Airport, Food Processing).</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> TITP technical intern candidates needing workplace safety and conversational Japanese.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Professionals and language enthusiasts looking to build authentic Japanese speaking fluency.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-star" aria-hidden="true"></i> Key Learning Outcomes</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Complete mastery of Hiragana, Katakana, and required Kanji for each target level.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Confident everyday conversation: self-introductions, shopping, healthcare, and directions.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Japanese workplace etiquette (Keigo polite forms, bowing, business greetings, punctuality).</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Comprehensive exam paper technique for JLPT listening, grammar, and reading sections.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Curriculum & Levels -->
    <section class="lp-section lp-section-alt" id="curriculum" aria-labelledby="jp-curriculum-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-layer-group" aria-hidden="true"></i> LEVEL PATHWAYS</span>
                <h2 id="jp-curriculum-heading">Course Levels, Syllabus &amp; Modules</h2>
                <p>Follow a progressive curriculum based on Minna no Nihongo and Marugoto international standards.</p>
            </div>

            <div class="lp-curriculum-grid">
                <!-- N5 Card -->
                <div class="lp-level-card">
                    <span class="lp-level-badge">FOUNDATION LEVEL</span>
                    <h3>JLPT N5 &amp; JFT-Basic A1</h3>
                    <p>Ideal for complete beginners with zero background. Covers writing systems and essential survival conversation.</p>
                    <ul class="lp-level-list">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Hiragana &amp; Katakana writing &amp; stroke orders</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> 100+ basic Kanji and 800+ vocabulary words</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Basic sentence patterns (A wa B desu, verb conjugations)</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Daily life dialogues: time, prices, travel, weather</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> 5 JLPT N5 timed mock examination drills</li>
                    </ul>
                    <div class="lp-level-meta">
                        <span><strong>Duration:</strong> 12 Weeks</span>
                        <span><strong>Hours:</strong> 150 Hours</span>
                    </div>
                </div>

                <!-- N4 Card -->
                <div class="lp-level-card">
                    <span class="lp-level-badge">PRE-INTERMEDIATE</span>
                    <h3>JLPT N4 &amp; SSW Workplace</h3>
                    <p>Required standard for SSW work visas. Expands compound grammar, workplace Japanese, and reading speed.</p>
                    <ul class="lp-level-list">
                        <li><i class="fas fa-check" aria-hidden="true"></i> 300+ Kanji and 1,500+ practical workplace terms</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Conditional, potential, passive, and causative verb forms</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Caregiver, airport, and customer service vocabulary</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Workplace culture, safety signs, and reporting (Horenso)</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> 6 JLPT N4 full-length practice tests with review</li>
                    </ul>
                    <div class="lp-level-meta">
                        <span><strong>Duration:</strong> 16 Weeks</span>
                        <span><strong>Hours:</strong> 160 Hours</span>
                    </div>
                </div>

                <!-- N3 Card -->
                <div class="lp-level-card">
                    <span class="lp-level-badge">INTERMEDIATE FLUENCY</span>
                    <h3>JLPT N3 Academic &amp; Career</h3>
                    <p>Bridging to professional fluency. Read newspaper summaries, understand natural speed audio, and engage in debates.</p>
                    <ul class="lp-level-list">
                        <li><i class="fas fa-check" aria-hidden="true"></i> 650+ Kanji and 3,500+ intermediate vocabulary terms</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Complex grammar structures and formal Keigo nuances</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Business email writing and job interview role-plays</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Listening comprehension at natural Japanese speech tempo</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Comprehensive N3 examination simulation papers</li>
                    </ul>
                    <div class="lp-level-meta">
                        <span><strong>Duration:</strong> 18 Weeks</span>
                        <span><strong>Hours:</strong> 180 Hours</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Delivery, Teaching & Admin Details -->
    <section class="lp-section" aria-labelledby="jp-admin-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-graduation-cap" aria-hidden="true"></i> COURSE DETAILS</span>
                <h2 id="jp-admin-heading">Delivery, Faculty, Assessment &amp; Policies</h2>
                <p>Transparent standards so you can enroll with complete clarity and confidence.</p>
            </div>

            <div class="lp-details-grid">
                <div class="lp-detail-box">
                    <h3><i class="fas fa-chalkboard-teacher" aria-hidden="true"></i> Delivery Options &amp; Faculty</h3>
                    <p>We provide two active learning modes tailored for local and distant students:</p>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>In-Person (Negombo):</strong> Fully air-conditioned multimedia center at Joseph Mawatha, Negombo.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Live Online (Zoom):</strong> Real-time interactive lectures with digital whiteboards and recorded video replays.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Faculty:</strong> JLPT N1 &amp; N2 certified Sri Lankan lecturers with Japan study/work experience, supported by native Japanese guest conversationalists.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-clipboard-check" aria-hidden="true"></i> Assessment &amp; Certification</h3>
                    <p>Continuous evaluation ensures steady progress toward your examination goals:</p>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Weekly Checks:</strong> Weekly Kanji and vocabulary quizzes plus bi-weekly speaking assessments.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Mock Exams:</strong> 3 timed mock exams matching official JLPT/JFT time constraints.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Certificate Wording:</strong> Students meeting 80% attendance receive an official <em>"Certificate of Completion in Japanese Language Studies (JLPT N5/N4 Preparatory Standard)"</em> indicating completed study hours.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-coins" aria-hidden="true"></i> Fee &amp; Payment Policy</h3>
                    <p>Affordable, transparent fee structures with zero hidden surprises:</p>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Module-based fee includes textbooks, flashcards, digital audio files, and mock papers.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Instalment Plans:</strong> Pay an initial registration deposit to confirm your seat, followed by 2 equal monthly instalments.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Special discounts available for students combining language with Caregiver or Ground Handling vocational training.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-user-plus" aria-hidden="true"></i> Entry Requirements</h3>
                    <p>Straightforward eligibility criteria designed to help passionate learners:</p>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Age Requirement:</strong> Minimum 16 years of age (no upper age limit).</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Prior Language:</strong> No prior Japanese required for JLPT N5 Beginner level.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>For N4 / N3:</strong> Prior completion of JLPT N5 or successful passing of our free internal placement assessment.</li>
                    </ul>
                </div>
            </div>

            <!-- Japanese Heritage & Study Environment Gallery -->
            <div class="lp-photo-showcase" style="margin-top: 44px;">
                <div class="lp-section-head lp-section-head-left" style="margin-bottom: 22px;">
                    <span class="lp-eyebrow"><i class="fas fa-torii-gate" aria-hidden="true"></i> LIFE &amp; CULTURE IN JAPAN</span>
                    <h3 style="font-size: 22px; font-weight: 700; color: #1e334a; margin: 4px 0 8px;">Experience the Culture Behind the Language</h3>
                    <p style="font-size: 13.5px; color: #64778d; margin: 0;">From iconic seasonal cherry blossoms to historic cultural landmarks, our curriculum integrates authentic cultural understanding into every lesson.</p>
                </div>
                <div class="lp-gallery-grid-4">
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/japan-fuji-pagoda.jpg" alt="Mount Fuji and Chureito Pagoda in springtime cherry blossoms" width="450" height="600" loading="lazy">
                        <figcaption>Mount Fuji &amp; Chureito Pagoda</figcaption>
                    </figure>
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/japan-temple-garden.jpg" alt="Traditional five-story pagoda and garden pond" width="450" height="600" loading="lazy">
                        <figcaption>Traditional Temple Gardens</figcaption>
                    </figure>
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/japan-himeji-castle.jpg" alt="Himeji Castle surrounded by blooming sakura" width="450" height="600" loading="lazy">
                        <figcaption>Himeji Castle &amp; Sakura</figcaption>
                    </figure>
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/japan-autumn-shrine.jpg" alt="Japanese shrine surrounded by autumn maple leaves" width="450" height="600" loading="lazy">
                        <figcaption>Autumn Shrine &amp; Heritage</figcaption>
                    </figure>
                </div>
            </div>

            <!-- Schedule Table -->
            <div id="class-schedule" style="margin-top: 50px;">
                <div class="lp-section-head lp-section-head-left" style="margin-bottom: 24px;">
                    <span class="lp-eyebrow"><i class="fas fa-calendar" aria-hidden="true"></i> UPCOMING INTAKES</span>
                    <h2>Japanese Batch Timetable &amp; Schedule</h2>
                    <p>Reserve your seat early. Classes are strictly capped at 15 learners.</p>
                </div>

                <div class="lp-table-wrap">
                    <table style="width: 100%; border-collapse: collapse; font-size: 13.5px; text-align: left;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 1px solid #dde6f0; color: #1e334a;">
                                <th style="padding: 14px 18px;">Batch Code</th>
                                <th style="padding: 14px 18px;">Target Level</th>
                                <th style="padding: 14px 18px;">Days &amp; Time</th>
                                <th style="padding: 14px 18px;">Delivery Mode</th>
                                <th style="padding: 14px 18px;">Intake Date</th>
                                <th style="padding: 14px 18px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 14px 18px; font-weight: 700; color: #bc002d;">JP-N5-WD01</td>
                                <td style="padding: 14px 18px;">JLPT N5 / JFT Beginner</td>
                                <td style="padding: 14px 18px;">Tue &amp; Thu: 9:00 AM - 1:00 PM</td>
                                <td style="padding: 14px 18px;">In-Person (Negombo)</td>
                                <td style="padding: 14px 18px;">1st Monday of Next Month</td>
                                <td style="padding: 14px 18px;"><span style="color: #008744; font-weight: 700;">Enrolling Now</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 14px 18px; font-weight: 700; color: #bc002d;">JP-N5-WE02</td>
                                <td style="padding: 14px 18px;">JLPT N5 / JFT Beginner</td>
                                <td style="padding: 14px 18px;">Saturday: 8:30 AM - 4:30 PM</td>
                                <td style="padding: 14px 18px;">In-Person (Negombo)</td>
                                <td style="padding: 14px 18px;">Upcoming Weekend</td>
                                <td style="padding: 14px 18px;"><span style="color: #008744; font-weight: 700;">Enrolling Now</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 14px 18px; font-weight: 700; color: #bc002d;">JP-N5-ON03</td>
                                <td style="padding: 14px 18px;">JLPT N5 Interactive</td>
                                <td style="padding: 14px 18px;">Mon, Wed, Fri: 6:30 PM - 8:30 PM</td>
                                <td style="padding: 14px 18px;">Live Online (Zoom)</td>
                                <td style="padding: 14px 18px;">15th of Next Month</td>
                                <td style="padding: 14px 18px;"><span style="color: #008744; font-weight: 700;">Enrolling Now</span></td>
                            </tr>
                            <tr>
                                <td style="padding: 14px 18px; font-weight: 700; color: #bc002d;">JP-N4-SSW01</td>
                                <td style="padding: 14px 18px;">JLPT N4 + SSW Specialized</td>
                                <td style="padding: 14px 18px;">Sunday: 8:30 AM - 4:30 PM</td>
                                <td style="padding: 14px 18px;">In-Person &amp; Online Hybrid</td>
                                <td style="padding: 14px 18px;">Upcoming Month</td>
                                <td style="padding: 14px 18px;"><span style="color: #bc002d; font-weight: 700;">Few Seats Left</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Disclaimer Banner -->
            <div class="lp-disclaimer-banner" role="note">
                <i class="fas fa-info-circle" aria-hidden="true"></i>
                <div>
                    <strong>Official Exam Distinction Notice:</strong>
                    <p>Confiance is an academic preparatory training institute and is distinct from an official examination centre. Official JLPT tests in Sri Lanka are organized by the Japan Foundation and the Japanese Language Education Association (JATAL). Official JFT-Basic tests are administered via Prometric. We provide preparatory training, past paper coaching, and mock assessments; we do not claim official exam-center status or provide unauthorized pass guarantees.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Japanese FAQs -->
    <section class="lp-section lp-section-alt" aria-labelledby="jp-faq-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-question-circle" aria-hidden="true"></i> JAPANESE FAQS</span>
                <h2 id="jp-faq-heading">Frequently Asked Questions: Japanese Program</h2>
                <p>Answers to common queries regarding JLPT exams, SSW pathways, and study materials.</p>
            </div>

            <div class="lp-faq-list">
                <details class="lp-faq-item">
                    <summary>How many hours of study are needed to pass JLPT N5? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        According to Japan Foundation benchmarks, zero-level learners typically require 150 hours of structured classroom coaching plus home revision. Our N5 program delivers 150 instructional hours with continuous Kanji quizzes and vocabulary retention drills.
                    </div>
                </details>

                <details class="lp-faq-item">
                    <summary>What is the difference between JLPT and JFT-Basic? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        JLPT is the traditional paper-based exam held twice a year (July and December). JFT-Basic is a computer-based test (CBT) held multiple times throughout the year specifically accepted for SSW (Specified Skilled Worker) visas in Japan. Confiance trains you for both formats.
                    </div>
                </details>

                <details class="lp-faq-item">
                    <summary>Are study books and audio recordings provided? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        Yes! Every enrolled student receives standard course materials (including Minna no Nihongo practice sheets, Kanji flashcard printouts, and listening audio files) at no extra charge.
                    </div>
                </details>

                <details class="lp-faq-item">
                    <summary>Can I combine Japanese Language with Caregiver or Airport Ground Handling training? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        Yes! Confiance specializes in dual-track preparation where you learn Japanese alongside vocational skills (Caregiver / Nursing Assistant, Airport Passenger Handling, or Agriculture), ensuring you meet both language and skills test criteria for Japanese employers.
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- Enquiry / Registration Form -->
    <section class="lp-section" id="enquiry-form" aria-labelledby="jp-reg-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-paper-plane" aria-hidden="true"></i> REGISTER NOW</span>
                <h2 id="jp-reg-heading">Register or Ask About Japanese Classes</h2>
                <p>Fill out the form below and our Japanese academic coordinator will get in touch with intake details and syllabus guidelines.</p>
            </div>

            <div class="lp-enquiry-card">
                <form class="lp-enquiry-form" action="contact.html" method="get">
                    <input type="hidden" name="course" value="Japanese Language Program">
                    
                    <div class="lp-enquiry-field">
                        <label for="jp-name">Full Name *</label>
                        <input type="text" id="jp-name" name="name" placeholder="e.g. Nimalka Fernando" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="jp-phone">Phone / WhatsApp *</label>
                        <input type="tel" id="jp-phone" name="phone" placeholder="e.g. +94 77 123 4567" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="jp-email">Email Address *</label>
                        <input type="email" id="jp-email" name="email" placeholder="e.g. nimalka@example.com" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="jp-level">Target Level *</label>
                        <select id="jp-level" name="level" required>
                            <option value="JLPT N5 (Beginner)">JLPT N5 / JFT-Basic (Complete Beginner)</option>
                            <option value="JLPT N4 (Pre-Intermediate)">JLPT N4 / SSW Track</option>
                            <option value="JLPT N3 (Intermediate)">JLPT N3 (Intermediate Fluency)</option>
                            <option value="Conversational Only">Conversational Japanese Only</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="jp-mode">Delivery Option *</label>
                        <select id="jp-mode" name="mode" required>
                            <option value="In-Person Negombo">In-Person (Negombo Campus)</option>
                            <option value="Live Online Zoom">Live Interactive Online (Zoom)</option>
                            <option value="Weekend In-Person">Weekend In-Person (Saturday/Sunday)</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="jp-goal">Your Ultimate Goal in Japan</label>
                        <select id="jp-goal" name="goal">
                            <option value="SSW Caregiver">Specified Skilled Worker (Caregiver)</option>
                            <option value="SSW Airport Ground Handling">SSW Airport Ground Handling</option>
                            <option value="SSW Agriculture / Food">SSW Agriculture / Food Processing</option>
                            <option value="Student Visa">Student Visa (Language School / University)</option>
                            <option value="TITP Trainee">Technical Intern (TITP)</option>
                            <option value="Personal Interest">Personal Fluency / Business</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field lp-enquiry-full">
                        <label for="jp-message">Questions or Comments</label>
                        <textarea id="jp-message" name="message" placeholder="Ask about fees, upcoming batch dates, or scholarship options..."></textarea>
                    </div>

                    <div class="lp-form-actions">
                        <span style="font-size: 12px; color: #76879a;">
                            <i class="fas fa-lock" aria-hidden="true"></i> No spam. We only contact you regarding your course enquiry.
                        </span>
                        <button type="submit" class="lp-btn-primary">
                            Enquire About Admissions <i class="fas fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
`;

// --------------------------------------------------------------------------
// 3. Italian Language Page: italian-language.html
// --------------------------------------------------------------------------
const italianContent = `
    <!-- Hero Section -->
    <section class="lp-hero" aria-labelledby="it-hero-title">
        <div class="lp-container">
            <nav class="lp-breadcrumbs" aria-label="Breadcrumb">
                <a href="index.html">Home</a>
                <span class="separator"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                <a href="language-programs.html">Language Programs</a>
                <span class="separator"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                <span class="current">Italian Language</span>
            </nav>

            <div class="lp-hero-grid">
                <div>
                    <span class="lp-eyebrow"><img src="newTemplate/images/flags/italy.svg" alt="" width="18" height="12" class="eyebrow-flag-img"> ITALIAN LANGUAGE PROGRAM</span>
                    <h1 id="it-hero-title">Italian Language Program for <span class="highlight">Life &amp; Work in Italy</span></h1>
                    <p class="lp-hero-lead">
                        Italian language and cultural communication for learners exploring Italy-related opportunities. Build confident speaking, listening, and reading skills under the CEFR A1 &amp; A2 framework for family reunification, employment, and study.
                    </p>
                    <div class="lp-hero-actions">
                        <a href="#class-schedule" class="lp-btn-primary">View Class Schedule <i class="fas fa-calendar-alt" aria-hidden="true"></i></a>
                        <a href="#enquiry-form" class="lp-btn-secondary">Enquire About Admissions <i class="fas fa-paper-plane" aria-hidden="true"></i></a>
                    </div>
                    <div class="lp-hero-badges">
                        <span><i class="fas fa-check-circle" aria-hidden="true"></i> CEFR A1 &amp; A2 Standards</span>
                        <span><i class="fas fa-comments" aria-hidden="true"></i> Spoken Italian Drill Focus</span>
                        <span><i class="fas fa-utensils" aria-hidden="true"></i> Hospitality &amp; Care Terminology</span>
                    </div>
                </div>

                <div class="lp-hero-card">
                    <img src="newTemplate/images/hero-italy-landscape.jpg" alt="Venice Grand Canal with gondolas and historic Venetian architecture at sunset" class="lp-hero-card-img" width="600" height="360">
                    <div class="lp-hero-card-meta">
                        <div class="lp-meta-box">
                            <strong>CEFR Levels</strong>
                            <span>A1 Beginner &amp; A2 Elementary</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Study Formats</strong>
                            <span>Negombo Campus &amp; Online</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Course Hours</strong>
                            <span>100 to 140 Hours / Level</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Batch Limit</strong>
                            <span>12 - 16 Students Max</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Intro & Target Audience -->
    <section class="lp-section" aria-labelledby="it-intro-heading">
        <div class="lp-container">
            <div class="lp-section-head lp-section-head-left">
                <span class="lp-eyebrow"><i class="fas fa-bullseye" aria-hidden="true"></i> WHO THIS COURSE IS FOR</span>
                <h2 id="it-intro-heading">Practical Italian for Everyday Life, Hospitality &amp; Migration</h2>
                <p>
                    Our Italian curriculum emphasizes practical communication over dry memorization. We train learners to speak natural Italian with proper accent, authentic rhythm, and cultural confidence.
                </p>
            </div>

            <div class="lp-details-grid">
                <div class="lp-detail-box">
                    <h3><i class="fas fa-user-friends" aria-hidden="true"></i> Who Should Enroll</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Individuals joining family members in Italy (family reunification visa requirements).</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Candidates seeking hospitality, culinary, caregiver, and seasonal work opportunities in Italy.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Students preparing for Italian higher education institutions and polytechnics.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Anyone passionate about Italian culture, culinary arts, fashion, and history.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-award" aria-hidden="true"></i> Core Learning Objectives</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Clear Italian phonetics, double consonants, and natural vowel articulation.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Essential daily dialogues: greetings, cafe ordering, market shopping, asking directions.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Mastery of regular and irregular verbs in present, past (passato prossimo), and future tenses.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Workplace communication for domestic assistance, caregiving, restaurants, and retail.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Levels & Curriculum -->
    <section class="lp-section lp-section-alt" id="curriculum" aria-labelledby="it-curriculum-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-layer-group" aria-hidden="true"></i> CEFR TRACKS</span>
                <h2 id="it-curriculum-heading">Italian Course Levels, Syllabus &amp; Modules</h2>
                <p>Structured progression following the Common European Framework of Reference for Languages (CEFR).</p>
            </div>

            <div class="lp-curriculum-grid">
                <!-- Level A1 -->
                <div class="lp-level-card">
                    <span class="lp-level-badge">LEVEL A1</span>
                    <h3>Italian CEFR A1 (Breakthrough)</h3>
                    <p>Designed for absolute beginners. Establishes essential vocabulary, correct pronunciation, and basic sentence construction.</p>
                    <ul class="lp-level-list">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Italian alphabet, phonetics, and pronunciation rules</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Articles, gender of nouns, and adjectives agreement</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Present tense regular verbs (-are, -ere, -ire) &amp; auxiliary essere/avere</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Numbers, days of the week, time, and family members</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Real-life role plays: at the restaurant, supermarket, and train station</li>
                    </ul>
                    <div class="lp-level-meta">
                        <span><strong>Duration:</strong> 10 Weeks</span>
                        <span><strong>Hours:</strong> 100 Hours</span>
                    </div>
                </div>

                <!-- Level A2 -->
                <div class="lp-level-card">
                    <span class="lp-level-badge">LEVEL A2</span>
                    <h3>Italian CEFR A2 (Elementary)</h3>
                    <p>Expands conversational range to past memories, future plans, personal stories, and professional daily life.</p>
                    <ul class="lp-level-list">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Past tense (Passato Prossimo with auxiliary selection)</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Reflexive verbs, modal verbs (potere, volere, dovere), and direct pronouns</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Describing housing, health problems, and doctor consultations</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Writing simple letters, emails, and filled administrative forms</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Listening comprehension with native Italian audio materials</li>
                    </ul>
                    <div class="lp-level-meta">
                        <span><strong>Duration:</strong> 14 Weeks</span>
                        <span><strong>Hours:</strong> 140 Hours</span>
                    </div>
                </div>

                <!-- Hospitality & Workplace Track -->
                <div class="lp-level-card">
                    <span class="lp-level-badge">WORKPLACE SPECIAL</span>
                    <h3>Hospitality &amp; Caregiver Italian</h3>
                    <p>Practical add-on module for learners planning to work in Italian hotels, restaurants, elderly care, or home assistance.</p>
                    <ul class="lp-level-list">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Caregiving terminology: medications, daily assistance, hygiene</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Culinary &amp; food service terms: kitchen utensils, ingredients, recipes</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Telephone handling, taking reservations, and welcoming guests</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Italian cultural expectations and household workplace norms</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Mock job interview practice with common employer questions</li>
                    </ul>
                    <div class="lp-level-meta">
                        <span><strong>Duration:</strong> 8 Weeks</span>
                        <span><strong>Hours:</strong> 80 Hours</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Delivery, Teaching & Admin Details -->
    <section class="lp-section" aria-labelledby="it-admin-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-university" aria-hidden="true"></i> ADMINISTRATION &amp; DETAILS</span>
                <h2 id="it-admin-heading">Delivery, Teacher Support, Assessment &amp; Entry</h2>
                <p>Learn about course logistics, faculty qualifications, and certification terms.</p>
            </div>

            <div class="lp-details-grid">
                <div class="lp-detail-box">
                    <h3><i class="fas fa-user-tie" aria-hidden="true"></i> Delivery Options &amp; Faculty</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Physical Classes (Negombo):</strong> Conveniently held at our modern training campus in Negombo.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Live Online (Zoom):</strong> High-definition interactive classes with native audio clips and digital worksheets.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Faculty:</strong> Experienced Italian language educators with European language qualifications and long-term residency in Italy.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-tasks" aria-hidden="true"></i> Assessment &amp; Certificate</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Continuous oral presentation evaluations, listening comprehension tests, and vocabulary quizzes.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> End-of-course internal examination covering all four macro-skills (Reading, Writing, Listening, Speaking).</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Official Certificate of Completion issued: <em>"Certificate of Proficiency in Italian Language (CEFR A1 / A2 Preparatory Level)"</em>.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-credit-card" aria-hidden="true"></i> Fees &amp; Payment Options</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Affordable all-inclusive course fee covering all study books and workbook materials.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Flexible payment plans: 50% upon registration, remainder in two monthly installments.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Zero hidden registration or exam coaching surcharges.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-id-card" aria-hidden="true"></i> Entry Requirements</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Minimum age: 16 years.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> No prior Italian background required for Level A1.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> For Level A2: Completion of Level A1 or passing of a simple placement interview.</li>
                    </ul>
                </div>
            </div>

            <!-- Italian Heritage & Study Environment Gallery -->
            <div class="lp-photo-showcase" style="margin-top: 44px;">
                <div class="lp-section-head lp-section-head-left" style="margin-bottom: 22px;">
                    <span class="lp-eyebrow"><i class="fas fa-landmark" aria-hidden="true"></i> LIFE &amp; CULTURE IN ITALY</span>
                    <h3 style="font-size: 22px; font-weight: 700; color: #1e334a; margin: 4px 0 8px;">Experience the Culture Behind the Language</h3>
                    <p style="font-size: 13.5px; color: #64778d; margin: 0;">From ancient Roman monuments to scenic Mediterranean coastlines, explore the cultural beauty that enriches your Italian fluency.</p>
                </div>
                <div class="lp-gallery-grid-4">
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/italy-rome-colosseum.jpg" alt="Colosseum in Rome at golden hour" width="450" height="600" loading="lazy">
                        <figcaption>Colosseum &amp; Ancient Rome</figcaption>
                    </figure>
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/italy-venice-canal.jpg" alt="Gondolas along Venice Grand Canal" width="450" height="600" loading="lazy">
                        <figcaption>Venice Grand Canal</figcaption>
                    </figure>
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/italy-amalfi-positano.jpg" alt="Positano cliffside village on Amalfi Coast" width="450" height="600" loading="lazy">
                        <figcaption>Amalfi Coast &amp; Positano</figcaption>
                    </figure>
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/italy-tuscany-landscape.jpg" alt="Rolling green hills of Tuscany with cypress trees" width="450" height="600" loading="lazy">
                        <figcaption>Tuscan Countryside</figcaption>
                    </figure>
                </div>
            </div>

            <!-- Schedule Table -->
            <div id="class-schedule" style="margin-top: 50px;">
                <div class="lp-section-head lp-section-head-left" style="margin-bottom: 24px;">
                    <span class="lp-eyebrow"><i class="fas fa-clock" aria-hidden="true"></i> CLASS SCHEDULE</span>
                    <h2>Italian Language Timetable &amp; Batches</h2>
                    <p>Select the batch schedule that matches your availability.</p>
                </div>

                <div class="lp-table-wrap">
                    <table style="width: 100%; border-collapse: collapse; font-size: 13.5px; text-align: left;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 1px solid #dde6f0; color: #1e334a;">
                                <th style="padding: 14px 18px;">Batch Code</th>
                                <th style="padding: 14px 18px;">Track / Level</th>
                                <th style="padding: 14px 18px;">Days &amp; Time</th>
                                <th style="padding: 14px 18px;">Format</th>
                                <th style="padding: 14px 18px;">Next Intake</th>
                                <th style="padding: 14px 18px;">Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 14px 18px; font-weight: 700; color: #008744;">IT-A1-WD01</td>
                                <td style="padding: 14px 18px;">Italian CEFR A1 Beginner</td>
                                <td style="padding: 14px 18px;">Mon &amp; Wed: 9:30 AM - 1:00 PM</td>
                                <td style="padding: 14px 18px;">In-Person (Negombo)</td>
                                <td style="padding: 14px 18px;">1st Monday of Next Month</td>
                                <td style="padding: 14px 18px;"><span style="color: #008744; font-weight: 700;">Open for Registration</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 14px 18px; font-weight: 700; color: #008744;">IT-A1-WE02</td>
                                <td style="padding: 14px 18px;">Italian CEFR A1 Beginner</td>
                                <td style="padding: 14px 18px;">Saturday: 8:30 AM - 4:00 PM</td>
                                <td style="padding: 14px 18px;">In-Person (Negombo)</td>
                                <td style="padding: 14px 18px;">2nd Saturday of Next Month</td>
                                <td style="padding: 14px 18px;"><span style="color: #008744; font-weight: 700;">Open for Registration</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 14px 18px; font-weight: 700; color: #008744;">IT-A1-ON03</td>
                                <td style="padding: 14px 18px;">Italian CEFR A1 Online</td>
                                <td style="padding: 14px 18px;">Tue &amp; Thu: 7:00 PM - 9:30 PM</td>
                                <td style="padding: 14px 18px;">Live Online (Zoom)</td>
                                <td style="padding: 14px 18px;">15th of Next Month</td>
                                <td style="padding: 14px 18px;"><span style="color: #008744; font-weight: 700;">Open for Registration</span></td>
                            </tr>
                            <tr>
                                <td style="padding: 14px 18px; font-weight: 700; color: #008744;">IT-A2-PRO01</td>
                                <td style="padding: 14px 18px;">Italian CEFR A2 + Workplace</td>
                                <td style="padding: 14px 18px;">Sunday: 8:30 AM - 4:00 PM</td>
                                <td style="padding: 14px 18px;">In-Person &amp; Online Hybrid</td>
                                <td style="padding: 14px 18px;">Upcoming Month</td>
                                <td style="padding: 14px 18px;"><span style="color: #c84127; font-weight: 700;">Seats Limited</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Disclaimer Banner -->
            <div class="lp-disclaimer-banner" role="note">
                <i class="fas fa-info-circle" aria-hidden="true"></i>
                <div>
                    <strong>Exam Distinction Notice:</strong>
                    <p>Confiance is an independent educational training provider offering preparatory courses aligned with CEFR standards (such as CILS, CELI, or PLIDA exam frameworks). Official Italian proficiency examinations are conducted by authorized testing centers (e.g., University for Foreigners of Siena, University for Foreigners of Perugia, Dante Alighieri Society). We provide preparatory training, grammar drills, and mock tests; we do not claim official testing center affiliation or guarantee exam results.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Italian FAQs -->
    <section class="lp-section lp-section-alt" aria-labelledby="it-faq-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-question-circle" aria-hidden="true"></i> ITALIAN FAQS</span>
                <h2 id="it-faq-heading">Frequently Asked Questions: Italian Program</h2>
                <p>Common questions about learning Italian at Confiance.</p>
            </div>

            <div class="lp-faq-list">
                <details class="lp-faq-item">
                    <summary>Is Italian difficult to learn for Sri Lankan learners? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        Italian is phonetic (it is pronounced almost exactly as it is written), making it one of the most accessible European languages for Sinhala and Tamil speakers. With our systematic phonetics coaching, most learners start reading sentences comfortably within the first two weeks.
                    </div>
                </details>

                <details class="lp-faq-item">
                    <summary>Does this course help with Italian family reunion visa interviews? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        Yes! Our A1 course covers all standard personal introductory questions, family descriptions, everyday routines, and document explanations frequently required for visa procedures and embassy interviews.
                    </div>
                </details>

                <details class="lp-faq-item">
                    <summary>What materials will I receive upon joining? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        You receive our customized Italian course workbook, verb conjugation reference charts, audio dialogue tracks, and weekly vocabulary flashcards.
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- Enquiry / Registration Form -->
    <section class="lp-section" id="enquiry-form" aria-labelledby="it-reg-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-paper-plane" aria-hidden="true"></i> REGISTER NOW</span>
                <h2 id="it-reg-heading">Enquire About Italian Language Classes</h2>
                <p>Submit your details to receive full syllabus schedules and enrolment information.</p>
            </div>

            <div class="lp-enquiry-card">
                <form class="lp-enquiry-form" action="contact.html" method="get">
                    <input type="hidden" name="course" value="Italian Language Program">
                    
                    <div class="lp-enquiry-field">
                        <label for="it-name">Full Name *</label>
                        <input type="text" id="it-name" name="name" placeholder="e.g. Ruwan Silva" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="it-phone">Phone / WhatsApp *</label>
                        <input type="tel" id="it-phone" name="phone" placeholder="e.g. +94 77 123 4567" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="it-email">Email Address *</label>
                        <input type="email" id="it-email" name="email" placeholder="e.g. ruwan@example.com" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="it-level">Level of Interest *</label>
                        <select id="it-level" name="level" required>
                            <option value="Italian A1 Beginner">Italian CEFR A1 (Beginner)</option>
                            <option value="Italian A2 Elementary">Italian CEFR A2 (Elementary)</option>
                            <option value="Hospitality & Caregiver Italian">Workplace / Caregiver Track</option>
                            <option value="Conversational Practice">Conversational Italian Drill</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="it-mode">Learning Format *</label>
                        <select id="it-mode" name="mode" required>
                            <option value="In-Person Negombo">In-Person (Negombo Campus)</option>
                            <option value="Live Online Zoom">Live Online (Zoom)</option>
                            <option value="Weekend Batch">Weekend Intensive</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="it-goal">Purpose of Study</label>
                        <select id="it-goal" name="goal">
                            <option value="Employment in Italy">Employment / Job Search in Italy</option>
                            <option value="Family Reunification">Family Reunification / Spouse Visa</option>
                            <option value="Higher Education in Italy">Higher Education / University</option>
                            <option value="General Fluency">General Fluency &amp; Interest</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field lp-enquiry-full">
                        <label for="it-message">Your Inquiries or Specific Goals</label>
                        <textarea id="it-message" name="message" placeholder="Ask about fees, upcoming batch dates, or scholarship options..."></textarea>
                    </div>

                    <div class="lp-form-actions">
                        <span style="font-size: 12px; color: #76879a;">
                            <i class="fas fa-lock" aria-hidden="true"></i> Your privacy is respected at all times.
                        </span>
                        <button type="submit" class="lp-btn-primary">
                            Enquire About Admissions <i class="fas fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
`;

// --------------------------------------------------------------------------
// 4. French Language Page: french-language.html
// --------------------------------------------------------------------------
const frenchContent = `
    <!-- Hero Section -->
    <section class="lp-hero" aria-labelledby="fr-hero-title">
        <div class="lp-container">
            <nav class="lp-breadcrumbs" aria-label="Breadcrumb">
                <a href="index.html">Home</a>
                <span class="separator"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                <a href="language-programs.html">Language Programs</a>
                <span class="separator"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                <span class="current">French Language</span>
            </nav>

            <div class="lp-hero-grid">
                <div>
                    <span class="lp-eyebrow"><img src="newTemplate/images/flags/france.svg" alt="" width="18" height="12" class="eyebrow-flag-img"> FRENCH LANGUAGE PROGRAM</span>
                    <h1 id="fr-hero-title">French Language Program for <span class="highlight">Global Communication &amp; Careers</span></h1>
                    <p class="lp-hero-lead">
                        Foundation in French communication for study, daily life and career preparation. Master French phonetics, practical conversation, and everyday vocabulary with curriculum mapped to DELF A1 and A2 international qualification benchmarks.
                    </p>
                    <div class="lp-hero-actions">
                        <a href="#class-schedule" class="lp-btn-primary">View Class Schedule <i class="fas fa-calendar-alt" aria-hidden="true"></i></a>
                        <a href="#enquiry-form" class="lp-btn-secondary">Enquire About Admissions <i class="fas fa-paper-plane" aria-hidden="true"></i></a>
                    </div>
                    <div class="lp-hero-badges">
                        <span><i class="fas fa-check-circle" aria-hidden="true"></i> DELF A1 &amp; A2 Scope</span>
                        <span><i class="fas fa-plane" aria-hidden="true"></i> France &amp; Canada Pathways</span>
                        <span><i class="fas fa-microphone" aria-hidden="true"></i> Phonetics &amp; Oral Coaching</span>
                    </div>
                </div>

                <div class="lp-hero-card">
                    <img src="newTemplate/images/hero-france-landscape.jpg" alt="Paris Eiffel Tower and Seine river panoramic landscape at golden hour" class="lp-hero-card-img" width="600" height="360">
                    <div class="lp-hero-card-meta">
                        <div class="lp-meta-box">
                            <strong>DELF Standard</strong>
                            <span>A1 Discovery &amp; A2 Survival</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Delivery Modes</strong>
                            <span>Negombo Campus &amp; Online</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Course Hours</strong>
                            <span>120 to 140 Hours / Level</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Batch Limit</strong>
                            <span>12 - 16 Students Max</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Intro & Target Audience -->
    <section class="lp-section" aria-labelledby="fr-intro-heading">
        <div class="lp-container">
            <div class="lp-section-head lp-section-head-left">
                <span class="lp-eyebrow"><i class="fas fa-bullseye" aria-hidden="true"></i> PURPOSE &amp; SCOPE</span>
                <h2 id="fr-intro-heading">Build Authentic French Fluency for Study, Daily Life &amp; Employment</h2>
                <p>
                    French is an official language across 29 countries and international diplomatic institutions. Our program is tailored to give you genuine oral spontaneity, accurate pronunciation, and the structural grounding needed to thrive in Francophone destinations.
                </p>
            </div>

            <div class="lp-details-grid">
                <div class="lp-detail-box">
                    <h3><i class="fas fa-users" aria-hidden="true"></i> Target Audience</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Students preparing for undergraduate or postgraduate studies in France, Belgium, or Switzerland.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Skilled professionals targeting Canadian permanent residency (Quebec / Express Entry Francophone bonus points).</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Candidates seeking employment in France, international hospitality, or global aviation sectors.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Beginners eager to speak one of the world's most influential cultural languages.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-award" aria-hidden="true"></i> Practical Learning Outcomes</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Solid foundation in French phonetics, silent letters, and liaisons for clear articulation.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Everyday conversation: introductions, polite requests, dining out, directions, and shopping.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Essential grammar: present tense regular and irregular verbs, passé composé, and near future (futur proche).</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Preparation for DELF exam components: listening comprehension, reading, written expression, and oral interview.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Levels & Curriculum -->
    <section class="lp-section lp-section-alt" id="curriculum" aria-labelledby="fr-curriculum-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-layer-group" aria-hidden="true"></i> DELF CURRICULUM</span>
                <h2 id="fr-curriculum-heading">Course Scope, Modules &amp; Learning Track</h2>
                <p>Structured around official Centre international d'études pédagogiques (CIEP) DELF guidelines.</p>
            </div>

            <div class="lp-curriculum-grid">
                <!-- DELF A1 -->
                <div class="lp-level-card">
                    <span class="lp-level-badge">DELF A1</span>
                    <h3>French DELF A1 (Discovery)</h3>
                    <p>Complete beginner track. Learn French pronunciation, basic vocabulary, and survive routine everyday situations.</p>
                    <ul class="lp-level-list">
                        <li><i class="fas fa-check" aria-hidden="true"></i> French sounds, vowels (nasal sounds), and liaison rules</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Noun genders (masculin/féminin), definite and indefinite articles</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Key verbs: être, avoir, aller, faire, and regular -er verbs</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Introducing oneself, family, hobbies, and simple daily routine</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> DELF A1 model listening and speaking mock interviews</li>
                    </ul>
                    <div class="lp-level-meta">
                        <span><strong>Duration:</strong> 12 Weeks</span>
                        <span><strong>Hours:</strong> 120 Hours</span>
                    </div>
                </div>

                <!-- DELF A2 -->
                <div class="lp-level-card">
                    <span class="lp-level-badge">DELF A2</span>
                    <h3>French DELF A2 (Survival)</h3>
                    <p>Pre-intermediate level. Build independence in conversational exchanges, narrative writing, and practical tasks.</p>
                    <ul class="lp-level-list">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Past tense (Passé Composé with avoir &amp; être agreements)</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Introduction to Imparfait and future tenses</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Expressing agreement, disagreement, obligations, and polite advice</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Writing informal emails, letters of invitation, and booking inquiries</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Intensive past-paper simulations for DELF A2 examination</li>
                    </ul>
                    <div class="lp-level-meta">
                        <span><strong>Duration:</strong> 14 Weeks</span>
                        <span><strong>Hours:</strong> 140 Hours</span>
                    </div>
                </div>

                <!-- Migration & Professional Track -->
                <div class="lp-level-card">
                    <span class="lp-level-badge">CAREER TRACK</span>
                    <h3>Workplace &amp; Canada Migration Track</h3>
                    <p>Targeted for candidates aiming for French work settings or TEF / TCF Canada preparation benchmarks.</p>
                    <ul class="lp-level-list">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Professional workplace greetings, phone etiquette, and email correspondence</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Industry vocabulary: culinary, hotel operations, and retail customer service</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> TEF / TCF examination format breakdown and scoring techniques</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Formal French job interview role-playing and CV drafting</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Cultural orientation for working in France and Quebec</li>
                    </ul>
                    <div class="lp-level-meta">
                        <span><strong>Duration:</strong> 10 Weeks</span>
                        <span><strong>Hours:</strong> 100 Hours</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Delivery, Teaching & Admin Details -->
    <section class="lp-section" aria-labelledby="fr-admin-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-graduation-cap" aria-hidden="true"></i> COURSE DETAILS</span>
                <h2 id="fr-admin-heading">Delivery, Faculty, Assessment &amp; Policies</h2>
                <p>Everything you need to know about class modes, examinations, and fee policies.</p>
            </div>

            <div class="lp-details-grid">
                <div class="lp-detail-box">
                    <h3><i class="fas fa-chalkboard-teacher" aria-hidden="true"></i> Delivery Options &amp; Faculty</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Physical Classes (Negombo):</strong> Modern air-conditioned classroom environment in Negombo.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Live Online (Zoom):</strong> Live interactive sessions with recorded archives for revision.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Faculty:</strong> Qualified French educators with university language degrees and DELF/DALF C1 certification.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-certificate" aria-hidden="true"></i> Assessment &amp; Certificate</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Weekly oral quizzes, grammar checkpoint tests, and pronunciation clinics.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> 2 complete DELF-style mock examinations under timed conditions.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Course Certificate issued: <em>"Certificate of Completion in French Language (DELF A1 / A2 Preparatory Level)"</em>.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-money-bill-wave" aria-hidden="true"></i> Fee &amp; Payment Policy</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Transparent fee structure with no hidden charges. All course workbooks and audio materials included.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Flexible 2-part instalment plan available for all students.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Group and early registration discounts available for upcoming intakes.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-user-check" aria-hidden="true"></i> Entry Requirements</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Minimum 16 years of age.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> No prior French knowledge required for DELF A1 Beginner course.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> For DELF A2: Proof of A1 completion or simple diagnostic test.</li>
                    </ul>
                </div>
            </div>

            <!-- French Heritage & Study Environment Gallery -->
            <div class="lp-photo-showcase" style="margin-top: 44px;">
                <div class="lp-section-head lp-section-head-left" style="margin-bottom: 22px;">
                    <span class="lp-eyebrow"><i class="fas fa-monument" aria-hidden="true"></i> LIFE &amp; CULTURE IN FRANCE</span>
                    <h3 style="font-size: 22px; font-weight: 700; color: #1e334a; margin: 4px 0 8px;">Experience the Culture Behind the Language</h3>
                    <p style="font-size: 13.5px; color: #64778d; margin: 0;">Immerse yourself in world-renowned French architectural heritage, Parisian charm, and the idyllic landscapes of Provence.</p>
                </div>
                <div class="lp-gallery-grid-4">
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/france-paris-eiffel.jpg" alt="Eiffel Tower in Paris with blue sky and gardens" width="450" height="600" loading="lazy">
                        <figcaption>Eiffel Tower, Paris</figcaption>
                    </figure>
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/france-louvre-museum.jpg" alt="Louvre Museum glass pyramid at twilight" width="450" height="600" loading="lazy">
                        <figcaption>The Louvre &amp; Pyramide</figcaption>
                    </figure>
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/france-mont-saint-michel.jpg" alt="Mont Saint-Michel tidal fortress in Normandy" width="450" height="600" loading="lazy">
                        <figcaption>Mont Saint-Michel</figcaption>
                    </figure>
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/france-provence-lavender.jpg" alt="Blooming lavender field in Provence France" width="450" height="600" loading="lazy">
                        <figcaption>Provence Lavender Fields</figcaption>
                    </figure>
                </div>
            </div>

            <!-- Schedule Table -->
            <div id="class-schedule" style="margin-top: 50px;">
                <div class="lp-section-head lp-section-head-left" style="margin-bottom: 24px;">
                    <span class="lp-eyebrow"><i class="fas fa-calendar-alt" aria-hidden="true"></i> BATCH SCHEDULE</span>
                    <h2>French Language Timetable &amp; Upcoming Intakes</h2>
                    <p>Classes are limited to 15 students to guarantee individual pronunciation feedback.</p>
                </div>

                <div class="lp-table-wrap">
                    <table style="width: 100%; border-collapse: collapse; font-size: 13.5px; text-align: left;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 1px solid #dde6f0; color: #1e334a;">
                                <th style="padding: 14px 18px;">Batch Code</th>
                                <th style="padding: 14px 18px;">Curriculum Track</th>
                                <th style="padding: 14px 18px;">Days &amp; Time</th>
                                <th style="padding: 14px 18px;">Mode</th>
                                <th style="padding: 14px 18px;">Intake Date</th>
                                <th style="padding: 14px 18px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 14px 18px; font-weight: 700; color: #0055a5;">FR-A1-WD01</td>
                                <td style="padding: 14px 18px;">French DELF A1 Beginner</td>
                                <td style="padding: 14px 18px;">Tue &amp; Thu: 9:00 AM - 1:00 PM</td>
                                <td style="padding: 14px 18px;">In-Person (Negombo)</td>
                                <td style="padding: 14px 18px;">1st Week of Next Month</td>
                                <td style="padding: 14px 18px;"><span style="color: #008744; font-weight: 700;">Enrolling Now</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 14px 18px; font-weight: 700; color: #0055a5;">FR-A1-WE02</td>
                                <td style="padding: 14px 18px;">French DELF A1 Weekend</td>
                                <td style="padding: 14px 18px;">Saturday: 8:30 AM - 4:30 PM</td>
                                <td style="padding: 14px 18px;">In-Person (Negombo)</td>
                                <td style="padding: 14px 18px;">Upcoming Weekend</td>
                                <td style="padding: 14px 18px;"><span style="color: #008744; font-weight: 700;">Enrolling Now</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 14px 18px; font-weight: 700; color: #0055a5;">FR-A1-ON03</td>
                                <td style="padding: 14px 18px;">French DELF A1 Online</td>
                                <td style="padding: 14px 18px;">Mon &amp; Wed: 7:00 PM - 9:30 PM</td>
                                <td style="padding: 14px 18px;">Live Online (Zoom)</td>
                                <td style="padding: 14px 18px;">15th of Next Month</td>
                                <td style="padding: 14px 18px;"><span style="color: #008744; font-weight: 700;">Enrolling Now</span></td>
                            </tr>
                            <tr>
                                <td style="padding: 14px 18px; font-weight: 700; color: #0055a5;">FR-A2-CAN01</td>
                                <td style="padding: 14px 18px;">DELF A2 &amp; Canada Migration</td>
                                <td style="padding: 14px 18px;">Sunday: 8:30 AM - 4:30 PM</td>
                                <td style="padding: 14px 18px;">In-Person &amp; Online Hybrid</td>
                                <td style="padding: 14px 18px;">Upcoming Month</td>
                                <td style="padding: 14px 18px;"><span style="color: #e02f3c; font-weight: 700;">Few Seats Left</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Disclaimer Banner -->
            <div class="lp-disclaimer-banner" role="note">
                <i class="fas fa-info-circle" aria-hidden="true"></i>
                <div>
                    <strong>Official Examination Disclaimer:</strong>
                    <p>Confiance provides preparation support and syllabus coaching; it is distinct from an official examination centre. Official DELF examinations in Sri Lanka are administered by the Alliance Française and certified by France Éducation international. We provide syllabus instruction, vocabulary coaching, and mock test papers; we do not claim official exam-center status or provide official exam-pass guarantees.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- French FAQs -->
    <section class="lp-section lp-section-alt" aria-labelledby="fr-faq-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-question-circle" aria-hidden="true"></i> FRENCH FAQS</span>
                <h2 id="fr-faq-heading">Frequently Asked Questions: French Program</h2>
                <p>Useful insights about studying French at Confiance.</p>
            </div>

            <div class="lp-faq-list">
                <details class="lp-faq-item">
                    <summary>Is French pronunciation difficult to master? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        French pronunciation has specific silent letters and nasal vowels that can feel unfamiliar initially. However, French spelling rules are very regular. Our specialized phonetic modules break down the mouth positions and liaison patterns step by step, allowing students to speak with confidence.
                    </div>
                </details>

                <details class="lp-faq-item">
                    <summary>Does this program help with Canadian immigration points? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        Yes! Demonstrating French language proficiency through exams like TEF Canada or TCF Canada can grant significant additional CRS points in Canada's Express Entry and is a primary requirement for Quebec immigration tracks.
                    </div>
                </details>

                <details class="lp-faq-item">
                    <summary>Are mock DELF examinations included? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        Yes. Each level includes at least two full mock tests replicating the exact time limits, listening tracks, and scoring criteria used in official DELF exams.
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- Enquiry / Registration Form -->
    <section class="lp-section" id="enquiry-form" aria-labelledby="fr-reg-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-paper-plane" aria-hidden="true"></i> REGISTER NOW</span>
                <h2 id="fr-reg-heading">Enquire About French Language Classes</h2>
                <p>Register your interest today to reserve your seat in our upcoming batch.</p>
            </div>

            <div class="lp-enquiry-card">
                <form class="lp-enquiry-form" action="contact.html" method="get">
                    <input type="hidden" name="course" value="French Language Program">
                    
                    <div class="lp-enquiry-field">
                        <label for="fr-name">Full Name *</label>
                        <input type="text" id="fr-name" name="name" placeholder="e.g. Dilini Wickramasinghe" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="fr-phone">Phone / WhatsApp *</label>
                        <input type="tel" id="fr-phone" name="phone" placeholder="e.g. +94 77 123 4567" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="fr-email">Email Address *</label>
                        <input type="email" id="fr-email" name="email" placeholder="e.g. dilini@example.com" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="fr-level">Course Track *</label>
                        <select id="fr-level" name="level" required>
                            <option value="DELF A1 Beginner">French DELF A1 (Beginner Track)</option>
                            <option value="DELF A2 Survival">French DELF A2 (Survival Track)</option>
                            <option value="Canada Migration & TEF">Canada Migration &amp; TEF Prep</option>
                            <option value="Conversational French">Conversational French</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="fr-mode">Delivery Format *</label>
                        <select id="fr-mode" name="mode" required>
                            <option value="In-Person Negombo">In-Person (Negombo Campus)</option>
                            <option value="Live Online Zoom">Live Online (Zoom)</option>
                            <option value="Weekend In-Person">Weekend In-Person Batch</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="fr-goal">Study Objective</label>
                        <select id="fr-goal" name="goal">
                            <option value="Study in France / Europe">Higher Education in France / Europe</option>
                            <option value="Canada Immigration">Canada Immigration (Quebec / Express Entry)</option>
                            <option value="Employment Abroad">Employment / International Hospitality</option>
                            <option value="Personal Interest">Personal Fluency &amp; Travel</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field lp-enquiry-full">
                        <label for="fr-message">Your Inquiries or Specific Goals</label>
                        <textarea id="fr-message" name="message" placeholder="Ask about batch start dates, course fees, or payment options..."></textarea>
                    </div>

                    <div class="lp-form-actions">
                        <span style="font-size: 12px; color: #76879a;">
                            <i class="fas fa-lock" aria-hidden="true"></i> We respect your privacy and will never share your information.
                        </span>
                        <button type="submit" class="lp-btn-primary">
                            Enquire About Admissions <i class="fas fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
`;

// --------------------------------------------------------------------------
// 5. Korean Language Page: korean-language.html
// --------------------------------------------------------------------------
const koreanContent = `
    <!-- Hero Section -->
    <section class="lp-hero" aria-labelledby="kr-hero-title">
        <div class="lp-container">
            <nav class="lp-breadcrumbs" aria-label="Breadcrumb">
                <a href="index.html">Home</a>
                <span class="separator"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                <a href="language-programs.html">Language Programs</a>
                <span class="separator"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                <span class="current">Korean Language</span>
            </nav>

            <div class="lp-hero-grid">
                <div>
                    <span class="lp-eyebrow"><img src="newTemplate/images/flags/korea.svg" alt="" width="18" height="12" class="eyebrow-flag-img"> KOREAN LANGUAGE PROGRAM</span>
                    <h1 id="kr-hero-title">Korean Language Program for <span class="highlight">EPS-TOPIK &amp; Study in Korea</span></h1>
                    <p class="lp-hero-lead">
                        Korean language fundamentals and practical communication for relevant study or work goals. Rapid Hangul mastery, speaking, reading, and listening coaching designed for EPS-TOPIK employment aspirants and TOPIK I academic qualifications.
                    </p>
                    <div class="lp-hero-actions">
                        <a href="#class-schedule" class="lp-btn-primary">View Class Schedule <i class="fas fa-calendar-alt" aria-hidden="true"></i></a>
                        <a href="#enquiry-form" class="lp-btn-secondary">Enquire About Admissions <i class="fas fa-paper-plane" aria-hidden="true"></i></a>
                    </div>
                    <div class="lp-hero-badges">
                        <span><i class="fas fa-check-circle" aria-hidden="true"></i> EPS-TOPIK Point System Prep</span>
                        <span><i class="fas fa-keyboard" aria-hidden="true"></i> Computer-Based Test (CBT) Drills</span>
                        <span><i class="fas fa-user-graduate" aria-hidden="true"></i> TOPIK I Level 1 &amp; 2 Standards</span>
                    </div>
                </div>

                <div class="lp-hero-card">
                    <img src="newTemplate/images/hero-korea-landscape.jpg" alt="Gyeongbokgung Royal Palace in Seoul with majestic mountain backdrop" class="lp-hero-card-img" width="600" height="360">
                    <div class="lp-hero-card-meta">
                        <div class="lp-meta-box">
                            <strong>Tracks Offered</strong>
                            <span>EPS-TOPIK &amp; TOPIK I</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Class Modes</strong>
                            <span>Negombo Campus &amp; Online</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Course Hours</strong>
                            <span>120 to 160 Hours / Level</span>
                        </div>
                        <div class="lp-meta-box">
                            <strong>Batch Limit</strong>
                            <span>15 Students Maximum</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Intro & Target Audience -->
    <section class="lp-section" aria-labelledby="kr-intro-heading">
        <div class="lp-container">
            <div class="lp-section-head lp-section-head-left">
                <span class="lp-eyebrow"><i class="fas fa-bullseye" aria-hidden="true"></i> COURSE FOCUS</span>
                <h2 id="kr-intro-heading">Master Hangul, Workplace Safety &amp; EPS Examination Skills</h2>
                <p>
                    Whether your goal is qualifying for employment in South Korea under the government-to-government EPS (Employment Permit System) or enrolling in Korean vocational academies and universities, our training delivers intensive linguistic readiness.
                </p>
            </div>

            <div class="lp-details-grid">
                <div class="lp-detail-box">
                    <h3><i class="fas fa-hard-hat" aria-hidden="true"></i> Who This Course is For</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Candidates preparing for the EPS-TOPIK examination for employment in Korean manufacturing, agriculture, or construction.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Students preparing for TOPIK I (Levels 1 &amp; 2) for admission into Korean universities and colleges (D-2 / D-4 visas).</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Professionals and travelers seeking practical Korean conversational ability.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> K-culture and language enthusiasts seeking structured Hangul literacy.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-trophy" aria-hidden="true"></i> Key Learning Outcomes</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Rapid mastery of Hangul (consonants, vowels, batchim final consonants, and phonological rules).</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Industrial terminology: machinery operations, safety warnings, tools, and work instructions.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Accurate listening comprehension of standard Korean audio clips at testing speed.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> CBT computer-based testing techniques for the EPS-TOPIK point system.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Levels & Curriculum -->
    <section class="lp-section lp-section-alt" id="curriculum" aria-labelledby="kr-curriculum-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-layer-group" aria-hidden="true"></i> CURRICULUM LEVELS</span>
                <h2 id="kr-curriculum-heading">Course Modules &amp; Examination Preparation Tracks</h2>
                <p>Curriculum aligned with the National Institute for International Education (NIIED) and HRD Korea standards.</p>
            </div>

            <div class="lp-curriculum-grid">
                <!-- Level 1: Hangul & Basics -->
                <div class="lp-level-card">
                    <span class="lp-level-badge">FOUNDATION</span>
                    <h3>Hangul Literacy &amp; Basic Korean</h3>
                    <p>Designed for complete beginners. Learn to read, write, and pronounce Hangul with absolute confidence within 2 weeks.</p>
                    <ul class="lp-level-list">
                        <li><i class="fas fa-check" aria-hidden="true"></i> 14 basic &amp; 5 double consonants, 10 basic &amp; 11 compound vowels</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Batchim final consonant sound-change rules and liaison</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Sino-Korean and Native Korean number systems with counters</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Basic sentence patterns, subject/object particles (이/가, 은/는, 을/를)</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Introductions, ordering food, asking prices, and basic greetings</li>
                    </ul>
                    <div class="lp-level-meta">
                        <span><strong>Duration:</strong> 8 Weeks</span>
                        <span><strong>Hours:</strong> 80 Hours</span>
                    </div>
                </div>

                <!-- Level 2: EPS-TOPIK Intensive -->
                <div class="lp-level-card">
                    <span class="lp-level-badge">EPS-TOPIK SPECIAL</span>
                    <h3>EPS-TOPIK Examination Track</h3>
                    <p>Specialized track based on HRD Korea official textbooks. Focused on question-paper patterns and computer testing drills.</p>
                    <ul class="lp-level-list">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Complete coverage of Standard HRD Korea Textbooks 1 &amp; 2</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Workplace safety regulations, factory tools, and instructions</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Reading comprehension question types (graphs, signs, short passages)</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Listening comprehension audio drills and keyword recognition</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> 10 full-length CBT computer simulation mock tests</li>
                    </ul>
                    <div class="lp-level-meta">
                        <span><strong>Duration:</strong> 16 Weeks</span>
                        <span><strong>Hours:</strong> 160 Hours</span>
                    </div>
                </div>

                <!-- Level 3: TOPIK I Academic -->
                <div class="lp-level-card">
                    <span class="lp-level-badge">TOPIK I ACADEMIC</span>
                    <h3>TOPIK I (Level 1 &amp; Level 2)</h3>
                    <p>Ideal for learners planning to study in South Korea. Covers extended grammatical forms and academic comprehension.</p>
                    <ul class="lp-level-list">
                        <li><i class="fas fa-check" aria-hidden="true"></i> 1,500+ standard Korean vocabulary terms across social topics</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Compound grammar forms (-고 싶다, -ㄹ 수 있다, -아/어서)</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Reading short letters, invitations, and advertisements</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Natural speed dialogue comprehension and inference skills</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Official TOPIK past-paper drills with performance analysis</li>
                    </ul>
                    <div class="lp-level-meta">
                        <span><strong>Duration:</strong> 14 Weeks</span>
                        <span><strong>Hours:</strong> 140 Hours</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Delivery, Teaching & Admin Details -->
    <section class="lp-section" aria-labelledby="kr-admin-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-graduation-cap" aria-hidden="true"></i> COURSE DETAILS</span>
                <h2 id="kr-admin-heading">Delivery, Faculty, Assessment &amp; Policies</h2>
                <p>Everything you need to know about our Korean language program operations.</p>
            </div>

            <div class="lp-details-grid">
                <div class="lp-detail-box">
                    <h3><i class="fas fa-chalkboard-teacher" aria-hidden="true"></i> Delivery Options &amp; Faculty</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Physical Classes (Negombo):</strong> Fully equipped training center with audio-listening workstations.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Live Online (Zoom):</strong> Interactive classes with digital whiteboards and recorded video replays.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> <strong>Faculty:</strong> Experienced Korean educators with TOPIK Level 5/6 certification and extensive teaching background in EPS-TOPIK curricula.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-tasks" aria-hidden="true"></i> Assessment &amp; Certification</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Bi-weekly vocabulary speed-tests and listening comprehension checks.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Computer-based mock simulations replicating the EPS-TOPIK examination environment.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Certificate awarded: <em>"Certificate of Completion in Korean Language Studies (EPS-TOPIK / TOPIK I Preparatory Course)"</em>.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-receipt" aria-hidden="true"></i> Fee &amp; Payment Policy</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Straightforward course fees including official HRD Korea workbooks and question banks.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Instalment payment plan: 50% deposit upon registration, balance payable in 2 monthly installments.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Free access to our computer lab for CBT practice tests.</li>
                    </ul>
                </div>

                <div class="lp-detail-box">
                    <h3><i class="fas fa-user-plus" aria-hidden="true"></i> Entry Requirements</h3>
                    <ul class="lp-detail-points">
                        <li><i class="fas fa-check" aria-hidden="true"></i> Minimum 18 years of age for EPS-TOPIK track (in line with Sri Lanka Bureau of Foreign Employment and HRD Korea guidelines).</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> Minimum 16 years of age for academic / general Korean tracks.</li>
                        <li><i class="fas fa-check" aria-hidden="true"></i> No prior Korean knowledge required for beginner courses.</li>
                    </ul>
                </div>
            </div>

            <!-- Korean Heritage & Study Environment Gallery -->
            <div class="lp-photo-showcase" style="margin-top: 44px;">
                <div class="lp-section-head lp-section-head-left" style="margin-bottom: 22px;">
                    <span class="lp-eyebrow"><i class="fas fa-archway" aria-hidden="true"></i> LIFE &amp; CULTURE IN SOUTH KOREA</span>
                    <h3 style="font-size: 22px; font-weight: 700; color: #1e334a; margin: 4px 0 8px;">Experience the Culture Behind the Language</h3>
                    <p style="font-size: 13.5px; color: #64778d; margin: 0;">From historic royal palaces and traditional Hanok villages to vibrant modern Seoul, discover the rich tapestry of Korea.</p>
                </div>
                <div class="lp-gallery-grid-4">
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/korea-gyeongbokgung-palace.jpg" alt="Gyeongbokgung Palace royal pavilion and mountain backdrop" width="450" height="600" loading="lazy">
                        <figcaption>Gyeongbokgung Palace</figcaption>
                    </figure>
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/korea-seoul-cityscape.jpg" alt="N Seoul Tower overlooking the Seoul metropolis" width="450" height="600" loading="lazy">
                        <figcaption>N Seoul Tower &amp; Cityscape</figcaption>
                    </figure>
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/korea-bukchon-hanok.jpg" alt="Bukchon Hanok traditional village in Seoul" width="450" height="600" loading="lazy">
                        <figcaption>Bukchon Hanok Village</figcaption>
                    </figure>
                    <figure class="lp-photo-card">
                        <img src="newTemplate/images/korea-night-skyline.jpg" alt="Seoul city bridges and Han river skyline at dusk" width="450" height="600" loading="lazy">
                        <figcaption>Seoul Skyline &amp; Han River</figcaption>
                    </figure>
                </div>
            </div>

            <!-- Schedule Table -->
            <div id="class-schedule" style="margin-top: 50px;">
                <div class="lp-section-head lp-section-head-left" style="margin-bottom: 24px;">
                    <span class="lp-eyebrow"><i class="fas fa-calendar" aria-hidden="true"></i> BATCH SCHEDULE</span>
                    <h2>Korean Language Timetable &amp; Intakes</h2>
                    <p>Register early to secure your computer workstation seat.</p>
                </div>

                <div class="lp-table-wrap">
                    <table style="width: 100%; border-collapse: collapse; font-size: 13.5px; text-align: left;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 1px solid #dde6f0; color: #1e334a;">
                                <th style="padding: 14px 18px;">Batch Code</th>
                                <th style="padding: 14px 18px;">Target Curriculum</th>
                                <th style="padding: 14px 18px;">Days &amp; Time</th>
                                <th style="padding: 14px 18px;">Delivery Mode</th>
                                <th style="padding: 14px 18px;">Intake Date</th>
                                <th style="padding: 14px 18px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 14px 18px; font-weight: 700; color: #0047a0;">KR-EPS-WD01</td>
                                <td style="padding: 14px 18px;">EPS-TOPIK Intensive Track</td>
                                <td style="padding: 14px 18px;">Mon to Fri: 9:00 AM - 1:00 PM</td>
                                <td style="padding: 14px 18px;">In-Person (Negombo)</td>
                                <td style="padding: 14px 18px;">1st Monday of Next Month</td>
                                <td style="padding: 14px 18px;"><span style="color: #008744; font-weight: 700;">Enrolling Now</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 14px 18px; font-weight: 700; color: #0047a0;">KR-EPS-WE02</td>
                                <td style="padding: 14px 18px;">EPS-TOPIK Weekend Batch</td>
                                <td style="padding: 14px 18px;">Saturday: 8:30 AM - 4:30 PM</td>
                                <td style="padding: 14px 18px;">In-Person (Negombo)</td>
                                <td style="padding: 14px 18px;">Upcoming Weekend</td>
                                <td style="padding: 14px 18px;"><span style="color: #008744; font-weight: 700;">Enrolling Now</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid #edf2f7;">
                                <td style="padding: 14px 18px; font-weight: 700; color: #0047a0;">KR-TOP-ON03</td>
                                <td style="padding: 14px 18px;">TOPIK I Academic Track</td>
                                <td style="padding: 14px 18px;">Tue &amp; Thu: 7:00 PM - 9:30 PM</td>
                                <td style="padding: 14px 18px;">Live Online (Zoom)</td>
                                <td style="padding: 14px 18px;">15th of Next Month</td>
                                <td style="padding: 14px 18px;"><span style="color: #008744; font-weight: 700;">Enrolling Now</span></td>
                            </tr>
                            <tr>
                                <td style="padding: 14px 18px; font-weight: 700; color: #0047a0;">KR-HAN-FAST</td>
                                <td style="padding: 14px 18px;">Hangul Crash Course (4 Weeks)</td>
                                <td style="padding: 14px 18px;">Sunday: 9:00 AM - 1:00 PM</td>
                                <td style="padding: 14px 18px;">In-Person &amp; Online Hybrid</td>
                                <td style="padding: 14px 18px;">Upcoming Month</td>
                                <td style="padding: 14px 18px;"><span style="color: #c60c30; font-weight: 700;">Limited Seats</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Disclaimer Banner -->
            <div class="lp-disclaimer-banner" role="note">
                <i class="fas fa-info-circle" aria-hidden="true"></i>
                <div>
                    <strong>Official Examination Disclaimer:</strong>
                    <p>Confiance is an independent educational training academy offering preparatory coaching; it is distinct from an official examination centre. Official EPS-TOPIK examinations in Sri Lanka are administered directly by the Sri Lanka Bureau of Foreign Employment (SLBFE) in coordination with HRD Korea. Official TOPIK exams are administered by the National Institute for International Education (NIIED). We provide syllabus coaching, CBT computer mock exams, and past paper drills; we do not claim official examination center status or guarantee exam passes or job placements.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Korean FAQs -->
    <section class="lp-section lp-section-alt" aria-labelledby="kr-faq-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-question-circle" aria-hidden="true"></i> KOREAN FAQS</span>
                <h2 id="kr-faq-heading">Frequently Asked Questions: Korean Program</h2>
                <p>Answers to common questions regarding EPS-TOPIK and Hangul study.</p>
            </div>

            <div class="lp-faq-list">
                <details class="lp-faq-item">
                    <summary>How long does it take to learn the Korean alphabet (Hangul)? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        Hangul is one of the most scientifically designed alphabets in the world. With our systematic guidance, students typically master reading and writing all consonants and vowels within 1 to 2 weeks.
                    </div>
                </details>

                <details class="lp-faq-item">
                    <summary>Do you provide Computer-Based Test (CBT) mock testing? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        Yes! Our Negombo training center is equipped with computer stations where students practice real CBT simulation software matching the official HRD Korea interface and time limits.
                    </div>
                </details>

                <details class="lp-faq-item">
                    <summary>What is the difference between EPS-TOPIK and TOPIK? <i class="fas fa-plus" aria-hidden="true"></i></summary>
                    <div class="lp-faq-answer">
                        EPS-TOPIK is specifically geared towards employment in Korea under the Employment Permit System and focuses on industrial and workplace communication. General TOPIK (Test of Proficiency in Korean) is academic and used for university admissions and professional visas. Confiance offers distinct preparation pathways for both.
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- Enquiry / Registration Form -->
    <section class="lp-section" id="enquiry-form" aria-labelledby="kr-reg-heading">
        <div class="lp-container">
            <div class="lp-section-head">
                <span class="lp-eyebrow"><i class="fas fa-paper-plane" aria-hidden="true"></i> REGISTER NOW</span>
                <h2 id="kr-reg-heading">Enquire About Korean Language Classes</h2>
                <p>Submit the form below and an academic advisor will reach out with intake details and syllabus guidelines.</p>
            </div>

            <div class="lp-enquiry-card">
                <form class="lp-enquiry-form" action="contact.html" method="get">
                    <input type="hidden" name="course" value="Korean Language Program">
                    
                    <div class="lp-enquiry-field">
                        <label for="kr-name">Full Name *</label>
                        <input type="text" id="kr-name" name="name" placeholder="e.g. Chaminda Rathnayake" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="kr-phone">Phone / WhatsApp *</label>
                        <input type="tel" id="kr-phone" name="phone" placeholder="e.g. +94 77 123 4567" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="kr-email">Email Address *</label>
                        <input type="email" id="kr-email" name="email" placeholder="e.g. chaminda@example.com" required>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="kr-level">Target Track *</label>
                        <select id="kr-level" name="level" required>
                            <option value="EPS-TOPIK Intensive">EPS-TOPIK Track (Job Pathway)</option>
                            <option value="Hangul & Basic Korean">Hangul &amp; Beginner Communication</option>
                            <option value="TOPIK I Academic">TOPIK I (Study Pathway)</option>
                            <option value="Weekend Special">Weekend Special Batch</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="kr-mode">Delivery Format *</label>
                        <select id="kr-mode" name="mode" required>
                            <option value="In-Person Negombo">In-Person (Negombo Campus)</option>
                            <option value="Live Online Zoom">Live Online (Zoom)</option>
                            <option value="Weekend Intensive">Weekend Intensive</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field">
                        <label for="kr-goal">Primary Goal</label>
                        <select id="kr-goal" name="goal">
                            <option value="Korea EPS Employment">EPS Employment in Korea</option>
                            <option value="Study in Korean University">Study in Korea (University / College)</option>
                            <option value="Personal Interest">Personal Interest &amp; K-Culture</option>
                            <option value="General Fluency">General Fluency</option>
                        </select>
                    </div>

                    <div class="lp-enquiry-field lp-enquiry-full">
                        <label for="kr-message">Your Questions or Comments</label>
                        <textarea id="kr-message" name="message" placeholder="Ask about fees, upcoming batch dates, or study materials..."></textarea>
                    </div>

                    <div class="lp-form-actions">
                        <span style="font-size: 12px; color: #76879a;">
                            <i class="fas fa-lock" aria-hidden="true"></i> Your details are strictly confidential.
                        </span>
                        <button type="submit" class="lp-btn-primary">
                            Enquire About Admissions <i class="fas fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
`;

// --------------------------------------------------------------------------
// Write all 5 pages
// --------------------------------------------------------------------------
const pagesToBuild = [
    {
        filename: 'language-programs.html',
        title: 'Language Programs | Japanese, Italian, French, Korean | CONFIANCE',
        description: 'Explore accredited language programs at CONFIANCE Language School in Negombo & Online. Intensive training in Japanese (JLPT), Italian, French (DELF), and Korean (EPS-TOPIK).',
        themeClass: 'theme-overview',
        content: overviewContent
    },
    {
        filename: 'japanese-language.html',
        title: 'Japanese Language Program | JLPT N5, N4, N3 & JFT | CONFIANCE',
        description: 'Comprehensive Japanese language training for study and work in Japan. JLPT N5, N4, N3 and JFT-Basic preparation at CONFIANCE in Negombo and live online.',
        themeClass: 'theme-japanese',
        content: japaneseContent
    },
    {
        filename: 'italian-language.html',
        title: 'Italian Language Program | CEFR A1 & A2 | CONFIANCE',
        description: 'Practical Italian language training for communication, life and work in Italy. CEFR A1 and A2 courses with experienced lecturers at CONFIANCE Negombo and online.',
        themeClass: 'theme-italian',
        content: italianContent
    },
    {
        filename: 'french-language.html',
        title: 'French Language Program | DELF A1 & A2 | CONFIANCE',
        description: 'Foundation in French communication for study, daily life and global careers. DELF A1 and A2 syllabus training at CONFIANCE in Negombo and live online.',
        themeClass: 'theme-french',
        content: frenchContent
    },
    {
        filename: 'korean-language.html',
        title: 'Korean Language Program | EPS-TOPIK & TOPIK I | CONFIANCE',
        description: 'Korean language fundamentals and practical communication for employment and study. Rapid Hangul mastery and EPS-TOPIK CBT mock training at CONFIANCE.',
        themeClass: 'theme-korean',
        content: koreanContent
    }
];

for (const p of pagesToBuild) {
    fs.writeFileSync(
        path.join(rootDir, p.filename),
        renderPage(p),
        'utf8'
    );
    console.log('Created ' + p.filename);
}
