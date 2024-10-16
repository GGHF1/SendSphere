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