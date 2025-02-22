<?php
session_start();

// Database connection
$host = "localhost";  
$user = "root";       
$pass = "";           
$dbname = "easy_trip"; 

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $destination = trim($_POST["destination"]);
    $location = trim($_POST["location"]);
    $language = trim($_POST["language"]);
    $tour_type = trim($_POST["tour_type"]);
    $price_range = trim($_POST["price_range"]);

    $package_type = "Custom"; 
    $total_price = 0; 
    $payment_status = "Pending";
    $status = "Processing";

    if (empty($username) || empty($destination) || empty($location)) {
        echo "<script>alert('Error: Username, destination, and location are required!'); window.history.back();</script>";
        exit();
    }

    preg_match('/\d+/', $price_range, $matches);
    if (!empty($matches[0])) {
        $total_price = (int)$matches[0];
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO bookings (username, destination, location, language, tour_type, price_range, package_type, total_price, payment_status, status) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssdss", $username, $destination, $location, $language, $tour_type, $price_range, $package_type, $total_price, $payment_status, $status);

    if ($stmt->execute()) {
        // Redirect to success page with destination parameter
        header("Location: booking_success.php?destination=" . urlencode($destination));
        exit();
    } else {
        echo "<script>alert('Booking failed, please try again!'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
