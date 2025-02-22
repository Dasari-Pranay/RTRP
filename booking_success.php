<?php
// Get destination from URL
$destination = isset($_GET['destination']) ? $_GET['destination'] : 'Unknown';

// Define tourist spots for each destination
$touristSpots = [
    "Delhi" => ["Red Fort", "India Gate", "Lotus Temple"],
    "Agra" => ["Taj Mahal", "Agra Fort", "Mehtab Bagh"],
    "Jaipur" => ["Hawa Mahal", "Amber Fort", "City Palace"],
    "Mumbai" => ["Gateway of India", "Marine Drive", "Elephanta Caves"],
    "Goa" => ["Baga Beach", "Dudhsagar Falls", "Fort Aguada"],
    "Varanasi" => ["Kashi Vishwanath Temple", "Ganga Ghats", "Sarnath"],
    "Kerala" => ["Alleppey Backwaters", "Munnar Tea Gardens", "Periyar Wildlife Sanctuary"]
];

// Get spots based on destination
$spots = isset($touristSpots[$destination]) ? $touristSpots[$destination] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Successful</title>
    <link rel="stylesheet" href="./bookingsuccessfull.css">
</head>
<body>
    <div class="success-container">
        <h2>🎉 Booking Successful! Thank you for booking your trip to <?php echo htmlspecialchars($destination); ?>! ✈️🌍</h2>
        
        <?php if (!empty($spots)): ?>
            <h3>Top Places to Visit in <?php echo htmlspecialchars($destination); ?>:</h3>
            <ul>
                <?php foreach ($spots as $spot): ?>
                    <li><?php echo htmlspecialchars($spot); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No tourist spots found for this destination.</p>
        <?php endif; ?>

        <a href="index.html" class="btn">Back to Home</a>
    </div>
</body>
</html>
