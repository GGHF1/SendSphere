const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');

togglePassword.src = '/images/view.png';
togglePassword.addEventListener('click', function () {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    if (type === 'password') {
        togglePassword.src = '/images/view.png'; // closed eye icon
    } else {
        togglePassword.src = '/images/hide.png'; // opened eye icon
    }
});

const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
const password_confirmation = document.querySelector('#password_confirmation');

togglePasswordConfirm.src = '/images/view.png';
togglePasswordConfirm.addEventListener('click', function () {
    const type = password_confirmation.getAttribute('type') === 'password' ? 'text' : 'password';
    password_confirmation.setAttribute('type', type);

    if (type === 'password') {
        togglePasswordConfirm.src = '/images/view.png'; // closed eye icon
    } else {
        togglePasswordConfirm.src = '/images/hide.png'; // opened eye icon
    }
});