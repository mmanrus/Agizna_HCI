// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
  
        form.classList.add('was-validated')
      }, false)
    })
  })()

// Initialize users array with admin user
var users = [
    {
        username: 'admin',
        password: 'admin',
        email: 'admin@admin.com'
    }
];

// Function to handle user login
function login() {
    var enteredUsername = document.getElementById('login-user').value;
    var enteredPassword = document.getElementById('login-password').value;
    var flag = 0;

    // Check if entered credentials match admin credentials
    if (enteredUsername === 'admin' && enteredPassword === 'admin') {
        alert('Admin Login Successful');
        return;
    }

    // Your login authentication logic for registered users should go here
    var storedUsers = JSON.parse(localStorage.getItem('users'));
    if (storedUsers) {
        for (var i = 0; i < storedUsers.length; i++) {
            if ((enteredUsername === storedUsers[i].username || enteredUsername === storedUsers[i].email) && enteredPassword === storedUsers[i].password) {
                alert('Login Successful');
                flag = 1;
                break;
            }
        }
    }
    if (flag === 0) {
        alert(`Invalid ${enteredUsername} or Password`);
    }
}

// Function to handle user registration
function register() {
    var username = document.getElementById('register-username').value;
    var password = document.getElementById('register-password').value;
    var confirm = document.getElementById('confirm-password').value;
    var email = document.getElementById('register-email').value;
    var pattern = /\S+@\S+\.\S+/;

    // Your registration logic should go here
    if (!username) {
        alert('Username is required');
    } else if (!email) {
        alert('Email is Empty');
    } else if (!pattern.test(email)) {
        alert('Please Enter a valid email');
    } else if (!password) {
        alert('Password is required');
    } else if (!confirm) {
        alert('Confirm Password is required');
    } else if (username.length <= 8) {
        alert('Username must be greater than eight characters.');
    } else if (password !== confirm) {
        alert('Passwords do not match');
    } else {
        // add data structure like a class USER 
        alert('Registration successful!');
        var newUser = {
            username: username,
            password: password,
            email: email
        };
        var storedUsers = JSON.parse(localStorage.getItem('users')) || [];
        storedUsers.push(newUser);
        localStorage.setItem('users', JSON.stringify(storedUsers));
        console.log('Redirecting to login page');
        window.location.href = 'login.html';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.querySelector('.needs-validation');

    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            register(); // Call the register function
        });
    }

    // Add event listener to login password input for Enter key
    
});


// Get the login form and attach the login function to its submit event
document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            register(); // Call the register function
        });
    }
});
