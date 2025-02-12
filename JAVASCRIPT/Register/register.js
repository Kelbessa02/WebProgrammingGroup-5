function validateForm() {

    document.getElementById('fullname');
    document.getElementById('email');
    document.getElementById('password');
    document.getElementById('phone');
    document.getElementById('terms');

    let valid = true;

    // Validate Full Name
    const fullname = document.getElementById('fullname').value;
    if (fullname.trim() === '') {
        document.getElementById('fullnameError').innerHTML = 'Full Name is required.';
        valid = false;
    }

    // Validate Email
    const email = document.getElementById('email').value;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        document.getElementById('emailError').innerHTML = 'Please enter a valid email.';
        valid = false;
    }

    // Validate Password
    const password = document.getElementById('password').value;
    if (password.length < 6) {
        document.getElementById('passwordError').innerHTML = 'Password must be at least 6 characters long.';
        valid = false;
    }