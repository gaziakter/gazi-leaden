// assets/js/gazi-leaden-form.js
jQuery(document).ready(function ($) {
    $('form').on('submit', function (event) {
        let valid = true;

        const name = $('#gazi_name');
        const email = $('#gazi_email');
        const whatsapp = $('#gazi_whatsapp');
        const website = $('#gazi_website');

        // Clear previous error messages
        $('.error-message').remove();

        if ($.trim(name.val()) === '') {
            showError(name, 'Name is required.');
            valid = false;
        }

        if (!validateEmail(email.val())) {
            showError(email, 'Invalid email address.');
            valid = false;
        }

        if ($.trim(whatsapp.val()) === '' || isNaN(whatsapp.val()) || whatsapp.val().length < 10) {
            showError(whatsapp, 'Invalid WhatsApp number.');
            valid = false;
        }

        if ($.trim(website.val()) === '' || !validateURL(website.val())) {
            showError(website, 'Invalid website URL.');
            valid = false;
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    function showError(element, message) {
        const error = $('<div class="error-message" style="color:red;"></div>').text(message);
        element.parent().append(error);
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }

    function validateURL(url) {
        const re = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/;
        return re.test(String(url).toLowerCase());
    }
});
