document.getElementById('registration-form').addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent form submission

    // Clear previous errors
    document.getElementById('username-error').classList.add('hidden');
    document.getElementById('email-error').classList.add('hidden');
    document.getElementById('password-error').classList.add('hidden');
    document.getElementById('confirm-password-error').classList.add('hidden');
    
    let valid = true;

    // Username validation
    const username = document.getElementById('username').value;
    if (!username) {
      document.getElementById('username-error').classList.remove('hidden');
      valid = false;
    }

    // Email validation
    const email = document.getElementById('email').value;
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!email || !emailRegex.test(email)) {
      document.getElementById('email-error').classList.remove('hidden');
      valid = false;
    }

    // Password validation
    const password = document.getElementById('password').value;
    if (!password) {
      document.getElementById('password-error').classList.remove('hidden');
      valid = false;
    }

    // Confirm Password validation
    const confirmPassword = document.getElementById('confirm-password').value;
    if (confirmPassword !== password) {
      document.getElementById('confirm-password-error').classList.remove('hidden');
      valid = false;
    }

    if (valid) {
      alert("Form submitted successfully!");
    }
  });