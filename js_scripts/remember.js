const rememberCheckbox = document.querySelector('.check_box');
const usernameField = document.querySelector('input[name="username_l"]');
let _passwordField = document.getElementById('password_l');

// Load the saved username and password from the cookie (if it exists)
const savedCredentials = getCookie('rememberCredentials');
if (savedCredentials) {
    const [username, password] = savedCredentials.split(':');
    usernameField.value = username;
    _passwordField.value = password;
    rememberCheckbox.checked = true;
}

// Save the username and password in a cookie when the user logs in and the "remember me" checkbox is checked
document.addEventListener('DOMContentLoaded', function() {
document.getElementById('login').addEventListener('submit', function(event) {
    if (rememberCheckbox.checked) {
        const credentials = `${usernameField.value}:${_passwordField.value}`;
        setCookie('rememberCredentials', credentials, 365);
    } else {
        deleteCookie('rememberCredentials');
    }
});});

// Function to create a new cookie
function setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
}

// Function to get the value of a cookie
function getCookie(name) {
    const cookieMatch = document.cookie.match(`(^|;)\\s*${name}=([^;]*)`);
    return cookieMatch ? cookieMatch[2] : null;
}

// Function to delete a cookie
function deleteCookie(name) {
    document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/`;
}