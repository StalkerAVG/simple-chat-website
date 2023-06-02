const togglePassword = document.querySelector('.fa-eye');

togglePassword.addEventListener('click', function() {
    let _passwordField = document.getElementById('password_l');
    const type = _passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    _passwordField.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});