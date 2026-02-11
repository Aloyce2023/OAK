document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('registerForm');
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');

    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            let isValid = true;
            let errors = [];

            // Reset previous error styles if any (not implemented in PHP version but good for future)
            // For now, we'll just use alerts as per the original style or basic browser validation 
            // coupled with custom checks.

            // Username validation
            if (usernameInput.value.trim().length < 3) {
                isValid = false;
                errors.push("Username must be at least 3 characters long.");
            }

            // Email validation (basic check, browser handles most)
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(emailInput.value.trim())) {
                isValid = false;
                errors.push("Please enter a valid email address.");
            }

            // Password validation
            if (passwordInput.value.length < 6) {
                isValid = false;
                errors.push("Password must be at least 6 characters long.");
            }

            // Confirm Password validation
            if (passwordInput.value !== confirmPasswordInput.value) {
                isValid = false;
                errors.push("Passwords do not match.");
            }

            if (!isValid) {
                e.preventDefault(); // Stop form submission
                alert(errors.join("\n")); // Show all errors
            }
        });
    }
});
