window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token.content,
        }
    });
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}