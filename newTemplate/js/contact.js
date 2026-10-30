/**
 * CONFIANCE - Contact & Fast Course Enquiry Handler
 * Validates course-specific inquiries, provides instant feedback, and connects to WhatsApp.
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('course-enquiry-form');
    const statusBox = document.getElementById('enquiry-form-status');
    const submitBtn = document.getElementById('enquiry-submit-btn');

    if (!form || !statusBox || !submitBtn) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const name = (document.getElementById('enq-name')?.value || '').trim();
      const phone = (document.getElementById('enq-phone')?.value || '').trim();
      const email = (document.getElementById('enq-email')?.value || '').trim();
      const program = (document.getElementById('enq-program')?.value || '').trim();
      const method = (document.getElementById('enq-method')?.value || 'WhatsApp').trim();
      const mode = (document.getElementById('enq-mode')?.value || 'Physical').trim();
      const message = (document.getElementById('enq-message')?.value || '').trim();
      const consent = document.getElementById('enq-consent')?.checked;

      // Reset status
      statusBox.className = 'ct-form-status';
      statusBox.style.display = 'none';
      statusBox.innerHTML = '';

      if (!name || !phone || !program || !consent) {
        statusBox.className = 'ct-form-status error';
        statusBox.style.display = 'block';
        statusBox.innerHTML = '<i class="fas fa-circle-exclamation"></i> Please fill in your name, phone/WhatsApp number, select a program, and accept the privacy consent.';
        return;
      }

      // Quick visual feedback
      submitBtn.disabled = true;
      const originalText = submitBtn.innerHTML;
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting Enquiry...';

      setTimeout(function () {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;

        const waText = encodeURIComponent(
          `Hello Confiance,\n\nI would like to enquire about a program.\n` +
          `• Name: ${name}\n` +
          `• Phone: ${phone}\n` +
          (email ? `• Email: ${email}\n` : '') +
          `• Programme: ${program}\n` +
          `• Preferred Mode: ${mode}\n` +
          `• Preferred Contact: ${method}\n` +
          (message ? `• Questions: ${message}\n` : '')
        );

        statusBox.className = 'ct-form-status success';
        statusBox.style.display = 'block';
        statusBox.innerHTML = `
          <strong><i class="fas fa-circle-check"></i> Thank you, ${name}!</strong><br>
          Your inquiry for <strong>${program}</strong> has been logged. Our admissions counselor will contact you via <strong>${method}</strong> shortly.<br><br>
          <a href="https://wa.me/94760407677?text=${waText}" target="_blank" rel="noopener noreferrer" style="color: #008744; font-weight: 700; text-decoration: underline;">
            <i class="fab fa-whatsapp"></i> Click here to forward your inquiry directly to our WhatsApp hotline now &rarr;
          </a>
        `;

        form.reset();
      }, 500);
    });
  });
})();

