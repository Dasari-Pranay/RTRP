document.getElementById('login-btn').addEventListener('click', function(event) {
    event.preventDefault();

    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;

    if(username && password) {
        alert('Login Successful');
    } else {
        alert('Please fill in both fields');
    }
});