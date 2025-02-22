<?php
session_start();

// Database connection (Update credentials if needed)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "easy_trip"; // Ensure this database exists in your MySQL

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $user_name = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if user exists
    $sql = "SELECT * FROM users WHERE username = '$user_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $user_name;
            echo json_encode(["status" => "success", "message" => "Login successful.", "redirect" => "index.html"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid username or password."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid username or password."]);
    }
}

// Close connection
$conn->close();
?>
