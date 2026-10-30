(function () {
    'use strict';
    var form = document.getElementById('quick-program-finder');
    if (!form) return;
    var country = document.getElementById('finder-country');
    var age = document.getElementById('finder-age');
    var grade = document.getElementById('finder-grade');
    var gender = document.getElementById('finder-gender');
    var results = document.getElementById('finder-results');
    var profile = document.getElementById('finder-profile');
    var status = document.getElementById('finder-status');
    var countryButtons = document.querySelectorAll('[data-finder-country]');
    var destinations = ['Japan', 'Italy', 'Romania', 'Canada', 'France'];

    var pathwayData = {
        'Japan': {
            pathway: 'Caregiver / Nursing Assistant',
            offer: 'Japanese Language Program + Caregiver / Nursing Assistant Training',
            cards: [
                {
                    bestMatch: true,
                    title: 'Caregiver / Nursing Assistant',
                    subtitle: 'Caregiver job pathway preparation',
                    offer: 'Japanese Language Program + Caregiver / Nursing Assistant Training',
                    includes: 'JLPT/JFT guidance, workplace Japanese, interview training, and cultural orientation'
                },
                {
                    bestMatch: false,
                    title: 'Airport Ground Handling',
                    subtitle: 'Airport ground staff pathway preparation',
                    offer: 'Japanese Language Program + Airport Ground Handling Training',
                    includes: 'Passenger handling vocabulary, customer service practice, and interview readiness'
                },
                {
                    bestMatch: false,
                    title: 'Agriculture / Food Processing',
                    subtitle: 'Agriculture and food processing pathway preparation',
                    offer: 'Japanese Language Program + Agriculture / Manufacturing Readiness',
                    includes: 'Workplace Japanese, safety orientation, and employer interview coaching'
                }
            ]
        },
        'Italy': {
            pathway: 'Hospitality & Culinary Arts',
            offer: 'Italian Language Program + Hospitality Training',
            cards: [
                {
                    bestMatch: true,
                    title: 'Hospitality & Culinary Arts',
                    subtitle: 'Hospitality and food service pathway preparation',
                    offer: 'Italian Language Program + Hospitality Training',
                    includes: 'Italian for hospitality, customer service standards, and visa interview coaching'
                },
                {
                    bestMatch: false,
                    title: 'Elder Care & Caregiver',
                    subtitle: 'Healthcare support pathway preparation',
                    offer: 'Italian Language Program + Caregiver Foundation',
                    includes: 'Workplace Italian, healthcare terminology, and patient assistance practice'
                },
                {
                    bestMatch: false,
                    title: 'Agriculture & Greenhouse',
                    subtitle: 'Agricultural sector pathway preparation',
                    offer: 'Italian Language Program + Agricultural Readiness',
                    includes: 'Practical workplace language, equipment safety, and documentation support'
                }
            ]
        },
        'Romania': {
            pathway: 'Construction & Technical Trades',
            offer: 'Workplace Communication + Technical Trade Readiness',
            cards: [
                {
                    bestMatch: true,
                    title: 'Construction & Technical Trades',
                    subtitle: 'Skilled trades and site worker preparation',
                    offer: 'Workplace Communication + Technical Trade Readiness',
                    includes: 'Site safety communication, tools orientation, and contract briefing'
                },
                {
                    bestMatch: false,
                    title: 'Warehouse & Logistics',
                    subtitle: 'Logistics and distribution operations preparation',
                    offer: 'Workplace Communication + Warehouse Readiness',
                    includes: 'Inventory handling terms, packing safety, and workplace orientation'
                },
                {
                    bestMatch: false,
                    title: 'Hospitality & Food Service',
                    subtitle: 'Restaurant and hotel service preparation',
                    offer: 'Hospitality Communication + Service Practice',
                    includes: 'Guest communication practice, food hygiene standards, and interview readiness'
                }
            ]
        },
        'Canada': {
            pathway: 'Healthcare Support & Caregiving',
            offer: 'IELTS / English Preparation + Healthcare Support Readiness',
            cards: [
                {
                    bestMatch: true,
                    title: 'Healthcare Support & Caregiving',
                    subtitle: 'Healthcare support worker pathway preparation',
                    offer: 'IELTS / English Program + Caregiver Foundation',
                    includes: 'English proficiency coaching, patient care documentation, and credential guidance'
                },
                {
                    bestMatch: false,
                    title: 'Hospitality & Customer Service',
                    subtitle: 'Hotel and service industry preparation',
                    offer: 'Professional English + Hospitality Training',
                    includes: 'Workplace communication, service etiquette, and employer interview practice'
                },
                {
                    bestMatch: false,
                    title: 'Skilled Trades & Technical',
                    subtitle: 'Trades and technical sector preparation',
                    offer: 'Workplace English + Trades Orientation',
                    includes: 'Technical vocabulary, Canadian workplace standards, and CV preparation'
                }
            ]
        },
        'France': {
            pathway: 'Culinary & Hospitality Arts',
            offer: 'French Language Program (DELF) + Hospitality Training',
            cards: [
                {
                    bestMatch: true,
                    title: 'Culinary & Hospitality Arts',
                    subtitle: 'French gastronomy and service pathway preparation',
                    offer: 'French Language Program (DELF) + Hospitality Training',
                    includes: 'French culinary vocabulary, service standards, and cultural integration'
                },
                {
                    bestMatch: false,
                    title: 'Logistics & Warehousing',
                    subtitle: 'Supply chain and logistics preparation',
                    offer: 'Workplace French + Logistics Readiness',
                    includes: 'Basic French communication, warehouse safety, and interview coaching'
                },
                {
                    bestMatch: false,
                    title: 'Agriculture & Viticulture',
                    subtitle: 'Agricultural and vineyard operations preparation',
                    offer: 'French Language Program + Agricultural Readiness',
                    includes: 'Workplace terminology, seasonal orientation, and visa guidance'
                }
            ]
        }
    };

    function motion() {
        return window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth';
    }

    function updateControls() {
        countryButtons.forEach(function (button) {
            button.setAttribute('aria-pressed', String(button.dataset.finderCountry === country.value));
        });
        document.querySelectorAll('[data-age-step]').forEach(function (button) {
            var direction = Number(button.dataset.ageStep);
            button.disabled = age.value !== '' && (direction < 0 ? Number(age.value) <= Number(age.min) : Number(age.value) >= Number(age.max));
        });
    }

    function renderPathway(dest, userAge, userGender) {
        var data = pathwayData[dest] || pathwayData['Japan'];
        var currentAge = userAge || (age.value ? age.value : '25');
        var currentGender = userGender || (gender.value ? gender.value : 'Female');

        var pathwayTitle = data.pathway;
        var pathwayOffer = data.offer;
        var cardsList = data.cards;

        // Customization: In France, male candidates receive the Butcher / Meat Processing pathway
        if (dest === 'France' && String(currentGender).toLowerCase() === 'male') {
            pathwayTitle = 'Butcher / Meat Processing';
            pathwayOffer = 'French Language Program (DELF) + Professional Butchery Training';
            cardsList = [
                {
                    bestMatch: true,
                    title: 'Butcher / Meat Processing',
                    subtitle: 'French butchery & meat processing pathway preparation',
                    offer: 'French Language Program (DELF) + Professional Butchery Training',
                    includes: 'French cutting techniques, food hygiene & safety standards, workplace French, and interview coaching'
                },
                {
                    bestMatch: false,
                    title: 'Culinary & Hospitality Arts',
                    subtitle: 'French gastronomy and service pathway preparation',
                    offer: 'French Language Program (DELF) + Hospitality Training',
                    includes: 'French culinary vocabulary, service standards, and cultural integration'
                },
                {
                    bestMatch: false,
                    title: 'Logistics & Warehousing',
                    subtitle: 'Supply chain and logistics preparation',
                    offer: 'Workplace French + Logistics Readiness',
                    includes: 'Basic French communication, warehouse safety, and interview coaching'
                }
            ];
        }

        var hlCountry = document.getElementById('finder-hl-country');
        var hlAge = document.getElementById('finder-hl-age');
        var hlGender = document.getElementById('finder-hl-gender');
        var hlPathway = document.getElementById('finder-hl-pathway');
        var hlOffer = document.getElementById('finder-hl-offer');

        if (hlCountry) hlCountry.textContent = dest;
        if (hlAge) hlAge.textContent = currentAge;
        if (hlGender) hlGender.textContent = currentGender;
        if (hlPathway) hlPathway.textContent = pathwayTitle;
        if (hlOffer) hlOffer.textContent = pathwayOffer;

        var btnView = document.getElementById('finder-view-pathway');
        if (btnView) {
            btnView.textContent = 'View ' + dest + ' Pathway';
            var msgPathway = 'Hello CONFIANCE, I would like to learn more about the recommended pathway for ' + dest + ' (' + pathwayTitle + ').';
            btnView.href = 'https://wa.me/94760407677?text=' + encodeURIComponent(msgPathway);
        }
        var btnCounselor = document.getElementById('finder-talk-counselor');
        if (btnCounselor) {
            var msgCounselor = 'Hello CONFIANCE, I am looking for guidance on pathways to ' + dest + ' (Age: ' + currentAge + ', Gender: ' + currentGender + '). Could I talk to a counselor?';
            btnCounselor.href = 'https://wa.me/94760407677?text=' + encodeURIComponent(msgCounselor);
        }

        var cardsContainer = document.getElementById('finder-cards-container');
        if (cardsContainer) {
            cardsContainer.replaceChildren();
            cardsList.forEach(function (c) {
                var cardEl = document.createElement('article');
                cardEl.className = 'hp-pathway-card';

                if (c.bestMatch) {
                    var badgeWrap = document.createElement('div');
                    badgeWrap.className = 'hp-pathway-badge-wrap';
                    var badge = document.createElement('span');
                    badge.className = 'hp-pathway-badge';
                    badge.textContent = 'Best match';
                    badgeWrap.appendChild(badge);
                    cardEl.appendChild(badgeWrap);
                }

                var title = document.createElement('h3');
                title.className = 'hp-pathway-title';
                title.textContent = c.title;
                cardEl.appendChild(title);

                var subtitle = document.createElement('p');
                subtitle.className = 'hp-pathway-subtitle';
                subtitle.textContent = c.subtitle;
                cardEl.appendChild(subtitle);

                var secOffer = document.createElement('div');
                secOffer.className = 'hp-pathway-section';
                var lblOffer = document.createElement('span');
                lblOffer.className = 'hp-pathway-label';
                lblOffer.textContent = 'CONFIANCE CAN OFFER';
                var txtOffer = document.createElement('p');
                txtOffer.className = 'hp-pathway-offer';
                txtOffer.textContent = c.offer;
                secOffer.appendChild(lblOffer);
                secOffer.appendChild(txtOffer);
                cardEl.appendChild(secOffer);

                var secInc = document.createElement('div');
                secInc.className = 'hp-pathway-section';
                var lblInc = document.createElement('span');
                lblInc.className = 'hp-pathway-label';
                lblInc.textContent = 'PREPARATION INCLUDES';
                var txtInc = document.createElement('p');
                txtInc.className = 'hp-pathway-includes';
                txtInc.textContent = c.includes;
                secInc.appendChild(lblInc);
                secInc.appendChild(txtInc);
                cardEl.appendChild(secInc);

                var actions = document.createElement('div');
                actions.className = 'hp-pathway-actions';

                var btnTraining = document.createElement('a');
                btnTraining.className = 'hp-btn-teal hp-pathway-btn';
                btnTraining.target = '_blank';
                btnTraining.rel = 'noopener noreferrer';
                btnTraining.textContent = 'View Training';
                var msgTrain = 'Hello CONFIANCE, I am interested in training for ' + c.title + ' in ' + dest + '. Please share training schedules and details.';
                btnTraining.href = 'https://wa.me/94760407677?text=' + encodeURIComponent(msgTrain);

                var btnConsult = document.createElement('a');
                btnConsult.className = 'hp-btn-outline hp-pathway-btn';
                btnConsult.target = '_blank';
                btnConsult.rel = 'noopener noreferrer';
                btnConsult.textContent = 'Book Consultation';
                var msgConsult = 'Hello CONFIANCE, I would like to book a consultation regarding ' + c.title + ' in ' + dest + '.';
                btnConsult.href = 'https://wa.me/94760407677?text=' + encodeURIComponent(msgConsult);

                actions.appendChild(btnTraining);
                actions.appendChild(btnConsult);
                cardEl.appendChild(actions);

                cardsContainer.appendChild(cardEl);
            });
        }

        var titleEl = document.getElementById('finder-result-title');
        if (titleEl) titleEl.textContent = 'Explore your pathway to ' + dest;

        if (profile) {
            profile.replaceChildren();
            [
                dest,
                currentAge + ' years',
                (grade && grade.value) || 'Education qualification',
                currentGender || 'Gender not specified'
            ].forEach(function (value) {
                var chip = document.createElement('span');
                chip.textContent = value;
                profile.appendChild(chip);
            });
        }

        var fullEnquiry = [
            'Hello CONFIANCE, I would like to discuss programs and current opportunities for my profile.',
            'Country: ' + dest,
            'Age: ' + currentAge
        ];
        if (grade && grade.value) fullEnquiry.push('Education: ' + grade.value);
        if (currentGender) fullEnquiry.push('Gender: ' + currentGender);
        fullEnquiry.push('Recommended Pathway: ' + pathwayTitle);
        fullEnquiry.push('Please advise on suitable preparation and the next steps.');

        var message = fullEnquiry.join('\n');
        var whatsappEl = document.getElementById('finder-whatsapp');
        if (whatsappEl) whatsappEl.href = 'https://wa.me/94760407677?text=' + encodeURIComponent(message);
        var emailEl = document.getElementById('finder-email');
        if (emailEl) emailEl.href = 'mailto:info@confiance.lk?subject=' + encodeURIComponent('Pathway enquiry - ' + dest) + '&body=' + encodeURIComponent(message);
    }

    document.querySelectorAll('[data-age-step]').forEach(function (button) {
        button.addEventListener('click', function () {
            if (age.value === '') age.value = '25';
            else {
                var next = Number(age.value) + Number(button.dataset.ageStep);
                age.value = String(Math.max(Number(age.min || 1), Math.min(Number(age.max || 100), next)));
            }
            age.dispatchEvent(new Event('input', { bubbles: true }));
        });
    });

    countryButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            country.value = button.dataset.finderCountry;
            country.dispatchEvent(new Event('change', { bubbles: true }));
            if (!age.value) age.value = '25';
            renderPathway(country.value, age.value, gender.value);
            results.hidden = false;
            updateControls();
            status.textContent = country.value + ' selected. Showing matching pathways.';
            results.scrollIntoView({ behavior: motion(), block: 'start' });
        });
    });

    form.addEventListener('input', updateControls);
    form.addEventListener('change', function () {
        if (country.value) {
            renderPathway(country.value, age.value, gender.value);
            updateControls();
        }
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        if (!country.value || !age.value) {
            results.hidden = true;
            if (form.reportValidity) form.reportValidity();
            return;
        }
        if (!destinations.includes(country.value)) {
            status.textContent = 'Please choose one of the listed destinations.';
            results.hidden = true;
            return;
        }

        renderPathway(country.value, age.value, gender.value);
        results.hidden = false;
        updateControls();
        status.textContent = 'Pathway recommendations for ' + country.value + ' are ready.';
        results.scrollIntoView({ behavior: motion(), block: 'start' });
        results.focus({ preventScroll: true });
    });

    document.getElementById('reset-program-finder').addEventListener('click', function () {
        form.reset();
        country.value = '';
        age.value = '';
        if (profile) profile.replaceChildren();
        results.hidden = true;
        updateControls();
        status.textContent = 'Selections cleared. Choose a destination to start again.';
        country.focus({ preventScroll: true });
        form.scrollIntoView({ behavior: motion(), block: 'center' });
    });

    document.querySelectorAll('.hp-faq-item').forEach(function (item) {
        item.addEventListener('toggle', function () {
            if (!item.open) return;
            document.querySelectorAll('.hp-faq-item').forEach(function (other) {
                if (other !== item) other.open = false;
            });
        });
    });

    var backtop = document.getElementById('scrollUp');
    if (backtop) {
        function updateBacktop() { backtop.hidden = window.scrollY < 500; }
        window.addEventListener('scroll', updateBacktop, { passive: true });
        backtop.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: motion() }); });
        updateBacktop();
    }

    // Initialize with Japan pathway so it renders the exact content from the start
    if (country && country.value) {
        renderPathway(country.value, age.value, gender.value);
    }
    updateControls();
})();