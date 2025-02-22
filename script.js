document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("login-btn").addEventListener("click", function (event) {
        event.preventDefault(); // Prevent form submission

        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;

        fetch("login.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert("Login successful!").then(() => {
                        window.location.href = "home.php"; // Redirect to home page
                    });
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error:", error));
    });
});
