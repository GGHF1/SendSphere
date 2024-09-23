document.addEventListener("DOMContentLoaded", function() {
    const nextButton = document.getElementById('next-button');
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    
    const emailInput = document.getElementById('email');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    const emailError = document.getElementById('emailError');
    const usernameError = document.getElementById('usernameError');
    const passwordError = document.getElementById('passwordError');

    const usernamePattern = /^[a-zA-Z0-9]+$/; 
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    emailInput.addEventListener('input', validateEmail);
    usernameInput.addEventListener('input', validateUsername);
    passwordInput.addEventListener('input', validatePassword);

    function validateEmail() {
        if (!emailPattern.test(emailInput.value)) {
            emailInput.classList.add('is-invalid');
            emailError.textContent = "Enter a valid email address.";
        } else {
            emailInput.classList.remove('is-invalid');
            emailError.textContent = "";
        }
        checkFormValidity();
    }

    function validateUsername() {
        if (!usernamePattern.test(usernameInput.value)) {
            usernameInput.classList.add('is-invalid');
            usernameError.textContent = "Username must contain only English letters and digits.";
        } else if (usernameInput.value.length < 4 || usernameInput.value.length > 20) {
            usernameInput.classList.add('is-invalid');
            usernameError.textContent = "Username must be between 4 and 20 characters.";
        } else {
            usernameInput.classList.remove('is-invalid');
            usernameError.textContent = "";
        }
        checkFormValidity();
    }

    function validatePassword() {
        if (!passwordPattern.test(passwordInput.value)) {
            passwordInput.classList.add('is-invalid');
            passwordError.textContent = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
        } else {
            passwordInput.classList.remove('is-invalid');
            passwordError.textContent = "";
        }
        checkFormValidity();
    }

    function checkFormValidity() {
        const isEmailValid = !emailInput.classList.contains('is-invalid') && emailInput.value !== "";
        const isUsernameValid = !usernameInput.classList.contains('is-invalid') && usernameInput.value !== "";
        const isPasswordValid = !passwordInput.classList.contains('is-invalid') && passwordInput.value !== "";

        nextButton.disabled = !(isEmailValid && isUsernameValid && isPasswordValid);
    }

    nextButton.addEventListener('click', function() {
        if (!nextButton.disabled) {
            step1.style.display = 'none';
            step2.style.display = 'block';
        }
    });
});
