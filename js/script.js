/**
 * js/script.js – Santipur Rash
 * Vanilla JavaScript. All features are progressive enhancements.
 */
(function () {
    'use strict';

    /* ---------------------------------------------------------------
       1. Mobile navigation toggle + accessibility
       --------------------------------------------------------------- */
    function initNavigation() {
        var toggle = document.querySelector('.nav-toggle');
        var nav = document.getElementById('primary-nav');
        if (!toggle || !nav) { return; }

        function setOpen(open) {
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            nav.classList.toggle('is-open', open);
        }

        toggle.addEventListener('click', function () {
            setOpen(toggle.getAttribute('aria-expanded') !== 'true');
        });

        // Escape closes the menu and returns focus to the button
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
                setOpen(false);
                toggle.focus();
            }
        });

        // Click outside closes the menu
        document.addEventListener('click', function (event) {
            if (!nav.contains(event.target) && !toggle.contains(event.target)) {
                setOpen(false);
            }
        });

        // Close after choosing a link
        nav.addEventListener('click', function (event) {
            if (event.target.closest('a')) { setOpen(false); }
        });

        // Reset state when resizing to desktop width
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1100) { setOpen(false); }
        });
    }

    /* ---------------------------------------------------------------
       2. Smooth scrolling for in-page anchors (moves focus, too)
       --------------------------------------------------------------- */
    function initSmoothScroll() {
        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        document.querySelectorAll('a[href^="#"]').forEach(function (link) {
            link.addEventListener('click', function (event) {
                var id = link.getAttribute('href');
                if (id.length < 2) { return; }
                var target = document.querySelector(id);
                if (!target) { return; }

                event.preventDefault();
                target.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' });
                if (!target.hasAttribute('tabindex')) { target.setAttribute('tabindex', '-1'); }
                target.focus({ preventScroll: true });
            });
        });
    }

    /* ---------------------------------------------------------------
       3. Feedback form: rating label, counter, client-side validation
       --------------------------------------------------------------- */
    var EMAIL_PATTERN = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    var PHONE_PATTERN = /^[0-9+\-\s()]{7,20}$/;

    function getErrorElement(field) {
        var group = field.closest('.form-group, .rating');
        return group ? group.querySelector('.field-error') : null;
    }

    function setFieldError(field, message) {
        var errorEl = getErrorElement(field);
        if (errorEl) { errorEl.textContent = message; }
        if (field.type !== 'radio') {
            field.setAttribute('aria-invalid', message ? 'true' : 'false');
        }
    }

    function validateField(field) {
        var value = field.value.trim();
        var message = '';

        if (field.type === 'radio') {
            var checked = field.form.querySelector('input[name="' + field.name + '"]:checked');
            if (!checked && field.required) { message = 'Please select a rating.'; }
        } else if (field.required && value === '') {
            message = 'This field is required.';
        } else if (field.name === 'email' && value !== '' && !EMAIL_PATTERN.test(value)) {
            message = 'Please enter a valid email address.';
        } else if (field.name === 'phone' && value !== '' && !PHONE_PATTERN.test(value)) {
            message = 'Phone may contain digits, spaces, +, - and brackets (7–20 characters).';
        } else if (field.name === 'visitor_name' && value !== '' && value.length < 2) {
            message = 'Name must be at least 2 characters.';
        } else if (field.name === 'message' && value !== '' && value.length < 10) {
            message = 'Please write at least 10 characters.';
        }

        setFieldError(field, message);
        return message === '';
    }

    function initFeedbackForm() {
        var form = document.querySelector('form[data-validate]');
        if (!form) { return; }

        form.setAttribute('novalidate', 'novalidate'); // we show our own messages

        var fields = form.querySelectorAll('input:not([type="hidden"]):not([name="website"]), select, textarea');

        fields.forEach(function (field) {
            var evt = (field.type === 'radio' || field.tagName === 'SELECT') ? 'change' : 'blur';
            field.addEventListener(evt, function () { validateField(field); });
            if (field.getAttribute('aria-invalid') === 'true') {
                field.addEventListener('input', function () { validateField(field); });
            }
        });

        form.addEventListener('submit', function (event) {
            var firstInvalid = null;
            var checkedRadioGroups = {};

            fields.forEach(function (field) {
                if (field.type === 'radio') {
                    if (checkedRadioGroups[field.name]) { return; }
                    checkedRadioGroups[field.name] = true;
                }
                if (!validateField(field) && !firstInvalid) { firstInvalid = field; }
            });

            if (firstInvalid) {
                event.preventDefault();
                firstInvalid.focus();
            }
        });

        // Rating text (e.g. "4 / 5")
        var ratingText = form.querySelector('.rating__text');
        var ratingLabels = { 1: 'Poor', 2: 'Fair', 3: 'Good', 4: 'Very good', 5: 'Excellent' };
        form.querySelectorAll('input[name="rating"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                if (ratingText) { ratingText.textContent = radio.value + ' / 5 – ' + ratingLabels[radio.value]; }
            });
        });
        var preChecked = form.querySelector('input[name="rating"]:checked');
        if (preChecked && ratingText) {
            ratingText.textContent = preChecked.value + ' / 5 – ' + ratingLabels[preChecked.value];
        }

        // Message character counter
        var messageField = form.querySelector('textarea[name="message"]');
        var counter = form.querySelector('.char-count');
        if (messageField && counter) {
            var max = parseInt(messageField.getAttribute('maxlength'), 10) || 2000;
            var update = function () { counter.textContent = messageField.value.length + ' / ' + max; };
            messageField.addEventListener('input', update);
            update();
        }
    }

    /* ---------------------------------------------------------------
       4. Gallery lightbox (images with data-lightbox inside .gallery)
       --------------------------------------------------------------- */
    function initLightbox() {
        var images = document.querySelectorAll('.gallery img');
        if (!images.length || typeof HTMLDialogElement === 'undefined') { return; }

        var dialog = document.createElement('dialog');
        dialog.className = 'lightbox';
        dialog.setAttribute('aria-label', 'Image viewer');
        dialog.innerHTML =
            '<button type="button" class="lightbox__close" aria-label="Close image">&times;</button>' +
            '<img src="" alt="">' +
            '<p class="lightbox__caption"></p>';
        document.body.appendChild(dialog);

        var bigImage = dialog.querySelector('img');
        var caption = dialog.querySelector('.lightbox__caption');

        images.forEach(function (img) {
            img.setAttribute('tabindex', '0');
            var open = function () {
                bigImage.src = img.currentSrc || img.src;
                bigImage.alt = img.alt;
                var fig = img.closest('figure');
                caption.textContent = fig && fig.querySelector('figcaption') ? fig.querySelector('figcaption').textContent : '';
                dialog.showModal();
            };
            img.addEventListener('click', open);
            img.addEventListener('keydown', function (event) {
                if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); open(); }
            });
        });

        dialog.querySelector('.lightbox__close').addEventListener('click', function () { dialog.close(); });
        dialog.addEventListener('click', function (event) { if (event.target === dialog) { dialog.close(); } });
    }

    /* ---------------------------------------------------------------
       Init
       --------------------------------------------------------------- */
    document.addEventListener('DOMContentLoaded', function () {
        initNavigation();
        initSmoothScroll();
        initFeedbackForm();
        initLightbox();
    });
})();