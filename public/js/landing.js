// Landing page JS moved from Blade to a static file
(function () {
    'use strict';

    function showToast(msg) {
        const toast = document.getElementById('toast');
        if (!toast) return;
        toast.textContent = msg;
        toast.style.display = 'block';
        setTimeout(() => (toast.style.display = 'none'), 3500);
    }

    function csrf() {
        const m = document.querySelector('meta[name="csrf-token"]');
        return m ? m.getAttribute('content') : '';
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('contact-form');
        const submit = document.getElementById('contact-submit');

        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const nameEl = document.getElementById('contact-name');
            const emailEl = document.getElementById('contact-email');
            const messageEl = document.getElementById('contact-message');

            const name = (nameEl && nameEl.value || '').trim();
            const email = (emailEl && emailEl.value || '').trim();
            const message = (messageEl && messageEl.value || '').trim();

            if (!email || !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) {
                showToast('Please provide a valid email');
                return;
            }

            submit.disabled = true;
            const priorText = submit.textContent;
            submit.textContent = 'Sending...';

            fetch(window.contactEndpoint || '/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf(),
                },
                body: JSON.stringify({ name, email, message }),
            })
                .then((r) => r.json())
                .then((data) => {
                    submit.disabled = false;
                    submit.textContent = priorText;
                    if (data && data.ok) {
                        showToast('Message sent — thank you!');
                        if (nameEl) nameEl.value = '';
                        if (emailEl) emailEl.value = '';
                        if (messageEl) messageEl.value = '';
                    } else {
                        showToast((data && data.message) ? data.message : 'Could not send message');
                    }
                })
                .catch((err) => {
                    submit.disabled = false;
                    submit.textContent = priorText;
                    // eslint-disable-next-line no-console
                    console.error(err);
                    showToast('Network error — please try later');
                });
        });
    });
})();
