<?php
header("Content-Type: application/json");

// Database connection
$host = "localhost";  
$user = "root";       
$pass = "";           
$dbname = "easy_trip"; // Ensure this database exists in your MySQL

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit;
}

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (empty($data["username"]) || empty($data["password"])) {
    echo json_encode(["success" => false, "message" => "Username and password required"]);
    exit;
}

$username = trim($data["username"]);
$password = trim($data["password"]);

// Check if user exists
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user["password"])) {
    echo json_encode(["success" => true, "message" => "Login successful"]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid username or password"]);
}

$stmt->close();
$conn->close();
?>
