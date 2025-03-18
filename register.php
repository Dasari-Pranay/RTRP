<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Update if different
$password = ""; // Update if your MySQL has a password
$dbname = "easy_trip"; // Ensure this database exists

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $user_name = isset($_POST['username']) ? trim($_POST['username']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $password = isset($_POST['password']) ? trim($_POST['password']) : "";
    $confirm_password = isset($_POST['confirmpassword']) ? trim($_POST['confirmpassword']) : "";

    // Check if all fields are filled
    if (empty($user_name) || empty($email) || empty($password) || empty($confirm_password)) {
        die("All fields are required.");
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $check_email = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Email is already registered.");
    }
    $stmt->close();

    // Insert user into database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user_name, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful! <a href='login.html'>Login here</a>";
        // Redirect to login page after 3 seconds (optional)
        header("refresh:3;url=login.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
