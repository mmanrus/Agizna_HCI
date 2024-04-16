function login() {
    var enteredUsername = document.getElementById('login-user').value;
    var enteredPassword = document.getElementById('login-password').value;
    var flag = 0;

    // Check if entered credentials match admin credentials
    if (enteredUsername === 'admin' && enteredPassword === 'admin') {
        window.location.href = "admin/pages/index.html";
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

document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('#login-btn').onclick = login;
    document.getElementById('login-password').addEventListener('keyup', function(event) {
        if (event.key === 'Enter') {
            login();
        }
    })
});