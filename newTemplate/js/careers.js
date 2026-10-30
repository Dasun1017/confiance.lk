(function () {
    'use strict';
    var form = document.getElementById('career-application-form');
    if (!form) return;
    var fields = document.getElementById('career-application-fields');
    var status = document.getElementById('application-status');
    var submit = document.getElementById('career-submit');
    var token = document.getElementById('career-csrf-token');
    var role = document.getElementById('career-role');
    var cv = document.getElementById('career-cv');
    var zone = document.getElementById('career-upload-zone');
    var uploadTitle = document.getElementById('career-upload-title');
    var remove = document.getElementById('career-remove-file');
    var maxBytes = 5 * 1024 * 1024;
    var busy = false;
    var submitted = false;
    var backendReady = false;
    var deliveryMode = location.protocol === 'file:' ? 'local-preview' : 'loading';
    var testCompleted = false;
    var formPreparation = null;

    var applicationDialog = document.getElementById('application-dialog');
    if (!applicationDialog) return;
    var closeApplicationButton = applicationDialog.querySelector('[data-close-application]');
    var applicationTrigger = null;

    function closeApplication() {
        if (!busy && applicationDialog.open) applicationDialog.close();
    }
    function openApplication(roleId, trigger) {
        if (busy) return;
        if (!submitted) role.value = roleId;
        applicationTrigger = trigger;
        if (!applicationDialog.open) {
            applicationDialog.showModal();
            document.body.classList.add('application-open');
        }
        applicationDialog.scrollTop = 0;
        requestAnimationFrame(function () {
            if (!applicationDialog.open) return;
            if (submitted) status.focus({ preventScroll: true });
            else if (!fields.disabled) document.getElementById('career-name').focus({ preventScroll: true });
            else closeApplicationButton.focus({ preventScroll: true });
        });
    }
    closeApplicationButton.addEventListener('click', closeApplication);
    applicationDialog.addEventListener('cancel', function (event) {
        if (busy) event.preventDefault();
    });
    applicationDialog.addEventListener('close', function () {
        document.body.classList.remove('application-open');
        if (applicationTrigger && applicationTrigger.isConnected) applicationTrigger.focus({ preventScroll: true });
    });
    applicationDialog.addEventListener('click', function (event) {
        if (event.target !== applicationDialog || busy) return;
        var bounds = applicationDialog.getBoundingClientRect();
        if (event.clientX < bounds.left || event.clientX > bounds.right ||
            event.clientY < bounds.top || event.clientY > bounds.bottom) closeApplication();
    });


    function showStatus(message, state) {
        status.textContent = message;
        status.dataset.state = state || 'info';
        status.hidden = !message;
    }
    function displayLimit() {
        var megabytes = Math.floor(maxBytes / 1048576 * 10) / 10;
        document.querySelectorAll('[data-cv-limit]').forEach(function (element) {
            element.textContent = megabytes + ' MB';
        });
    }
    function updateFile() {
        var file = cv.files[0];
        remove.hidden = !file;
        if (!file) {
            uploadTitle.textContent = 'Choose your CV or drop it here';
            cv.setCustomValidity('');
            return;
        }
        uploadTitle.textContent = file.name + ' (' + Math.ceil(file.size / 1024) + ' KB)';
        var error = !/\.pdf$/i.test(file.name) ? 'Please select a PDF document.' :
            file.size > maxBytes ? 'Your CV exceeds the displayed file-size limit.' : '';
        cv.setCustomValidity(error);
        if (error) showStatus(error, 'error');
    }
    async function request(url, options, timeout) {
        var controller = new AbortController();
        var timer = setTimeout(function () { controller.abort(); }, timeout);
        try {
            var response = await fetch(url, Object.assign({ credentials: 'same-origin', cache: 'no-store', signal: controller.signal }, options));
            var data;
            try { data = await response.json(); } catch (error) {
                throw new Error('Online applications are temporarily unavailable. Please email your CV to lkconfiance@gmail.com.');
            }
            return { response: response, data: data };
        } finally { clearTimeout(timer); }
    }
    function idleSubmitLabel() {
        if (deliveryMode === 'local-preview' || deliveryMode === 'server-preview') {
            return testCompleted ? 'Run test again' : 'Test Application';
        }
        return 'Submit Application';
    }
    async function prepareForm(options) {
        options = options || {};
        fields.disabled = false;
        if (location.protocol === 'file:') {
            deliveryMode = 'local-preview';
            submit.textContent = idleSubmitLabel();
            showStatus('Local preview: fill in this form and test your PDF. No application or email will be sent.', 'preview');
            return true;
        }
        try {
            var result = await request(form.getAttribute('action'), { method: 'GET' }, 10000);
            if (!result.response.ok || !result.data.success || typeof result.data.csrfToken !== 'string') {
                throw new Error(result.data.message || 'Submission unavailable.');
            }
            token.value = result.data.csrfToken;
            backendReady = true;
            deliveryMode = result.data.mode === 'preview' ? 'server-preview' : 'live';
            if (Number.isFinite(result.data.maxBytes) && result.data.maxBytes > 0) maxBytes = result.data.maxBytes;
            displayLimit();
            if (!options.keepStatus) {
                showStatus(deliveryMode === 'server-preview'
                    ? 'Local test mode: your application and PDF will be saved on this computer. No email will be sent.'
                    : '', deliveryMode === 'server-preview' ? 'preview' : 'info');
            }
            if (!busy) submit.textContent = idleSubmitLabel();
            if (applicationDialog.open && document.activeElement === closeApplicationButton) document.getElementById('career-name').focus({ preventScroll: true });
            return true;
        } catch (error) {
            backendReady = false;
            deliveryMode = 'unavailable';
            showStatus('You can fill in this form, but online submission is currently unavailable. Try submitting again, or email your CV to lkconfiance@gmail.com.', 'error');
            return false;
        }
    }

    document.querySelectorAll('[data-apply-role]').forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            openApplication(link.dataset.applyRole, link);
        });
    });
    var selectedRole = new URLSearchParams(location.search).get('role');
    if (selectedRole && Array.from(role.options).some(function (option) { return option.value === selectedRole; })) role.value = selectedRole;
    cv.addEventListener('change', updateFile);
    remove.addEventListener('click', function () { cv.value = ''; updateFile(); });
    ['dragenter', 'dragover'].forEach(function (name) {
        zone.addEventListener(name, function (event) {
            event.preventDefault();
            if (!fields.disabled) zone.classList.add('is-dragging');
        });
    });
    ['dragleave', 'drop'].forEach(function (name) {
        zone.addEventListener(name, function (event) { event.preventDefault(); zone.classList.remove('is-dragging'); });
    });
    zone.addEventListener('drop', function (event) {
        if (fields.disabled) return;
        if (!event.dataTransfer || event.dataTransfer.files.length !== 1) {
            showStatus('Please choose one PDF CV.', 'error');
            return;
        }
        cv.files = event.dataTransfer.files;
        updateFile();
    });
    form.addEventListener('submit', async function (event) {
        event.preventDefault();
        if (busy || submitted || fields.disabled) return;
        updateFile();
        if (!form.reportValidity()) return;
        busy = true;
        closeApplicationButton.disabled = true;
        submit.disabled = true;
        var testing = deliveryMode === 'local-preview' || deliveryMode === 'server-preview';
        submit.textContent = testing ? 'Testing your application...' : 'Sending your application...';
        showStatus(testing ? 'Checking your details and PDF...' : 'Sending your CV securely. Please keep this page open.', 'info');
        try {
            var file = cv.files[0];
            if (!file || await file.slice(0, 5).text() !== '%PDF-') {
                showStatus('Please select a valid PDF document.', 'error');
                return;
            }
            if (deliveryMode === 'local-preview') {
                testCompleted = true;
                showStatus('Test passed: your form details and PDF are valid. No application or email was sent.', 'preview');
                status.focus({ preventScroll: true });
                return;
            }
            if (!backendReady) {
                if (formPreparation) await formPreparation;
                if (!backendReady) {
                    formPreparation = prepareForm();
                    if (!(await formPreparation)) return;
                }
            }
            var result = await request(form.getAttribute('action'), { method: 'POST', body: new FormData(form) }, 30000);
            if (!result.response.ok || result.data.success !== true) {
                showStatus(result.data.message || 'Your application could not be submitted. Please email your CV to lkconfiance@gmail.com.', 'error');
                return;
            }
            if (result.data.preview === true) {
                deliveryMode = 'server-preview';
                testCompleted = true;
                if (typeof result.data.csrfToken === 'string') token.value = result.data.csrfToken;
                showStatus(result.data.message, 'preview');
                status.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }
            submitted = true;
            form.reset();
            updateFile();
            fields.disabled = true;
            showStatus(result.data.message, 'success');
            status.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } catch (error) {
            showStatus(error.name === 'AbortError'
                ? 'We could not confirm submission in time. Please wait a moment before retrying, or email your CV to lkconfiance@gmail.com.'
                : 'Your application could not be sent. Please try again or email your CV to lkconfiance@gmail.com.', 'error');
        } finally {
            busy = false;
            closeApplicationButton.disabled = false;
            submit.disabled = submitted;
            submit.textContent = submitted ? 'Application submitted' : idleSubmitLabel();
        }
    });
    displayLimit();
    fields.disabled = false;
    formPreparation = prepareForm();
})();
