
document.getElementById('toggle-password').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const eyeIcon = this.querySelector('.eye-icon');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.textContent = '🙈';
    } else {
        passwordField.type = 'password';
        eyeIcon.textContent = '👁️';
    }
});

document.getElementById('toggle-password-confirm').addEventListener('click', function () {
    const passwordField = document.getElementById('confirm_password');
    const eyeIcon = this.querySelector('.eye-icon');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.textContent = '🙈';
    } else {
        passwordField.type = 'password';
        eyeIcon.textContent = '👁️';
    }
});