// validations.js

// Validate email
function validateEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regex.test(email);
}

// Validate password match
function validatePasswordMatch(password, confirmPassword) {
    return password === confirmPassword;
}

// Validate not empty
function validateNotEmpty(value) {
    return value.trim() !== '';
}

// Validate password strength (at least 6 characters)
function validatePasswordStrength(password) {
    return password.length >= 6;
}

// Function to handle form submission
function validateForm(formId) {
    let isValid = true;

    const form = document.getElementById(formId);

    // Get all input elements in the form
    const inputs = form.querySelectorAll('input');

    inputs.forEach(input => {
        if (input.type === 'email') {
            if (!validateEmail(input.value)) {
                alert('Invalid email format');
                isValid = false;
            }
        }

        if (input.type === 'password') {
            const confirmPassword = form.querySelector('#confirmPassword');
            if (confirmPassword && input.value !== confirmPassword.value) {
                alert('Passwords do not match');
                isValid = false;
            }

            if (!validatePasswordStrength(input.value)) {
                alert('Password must be at least 6 characters');
                isValid = false;
            }
        }

        if (input.value.trim() === '') {
            alert('All fields are required');
            isValid = false;
        }
    });

    return isValid;
}

// Event listener for form submission to validate before submit
document.getElementById("registerForm").addEventListener("submit", function(event) {
    if (!validateForm("registerForm")) {
        event.preventDefault(); // Prevent form submission
    }
});
