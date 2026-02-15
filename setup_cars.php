<?php
require 'database.php';

// Disable foreign key checks to allow clearing tables
$conn->query("SET FOREIGN_KEY_CHECKS = 0");

// Truncate tables to reset data
$conn->query("TRUNCATE TABLE orders");
$conn->query("TRUNCATE TABLE cars");

// Re-enable foreign key checks
$conn->query("SET FOREIGN_KEY_CHECKS = 1");

echo "Tables cleared.<br>";

// Prepare insert statement
$stmt = $conn->prepare("INSERT INTO cars (name, brand, price, image, description) VALUES (?, ?, ?, ?, ?)");

// Data from galley.views.php
// Note: Descriptions are generic "Imported from Japan" for now as galley didn't have specific text.
$cars = [
    ['Dualis', 'Toyota', 721, 'image/duali.jpg', 'Compact SUV, efficient and reliable.'],
    ['Harier', 'Toyota', 560, 'image/harier3.jpg', 'Luxury SUV with premium interior.'],
    ['Aventador', 'Lamborghini', 271000, 'image/harier1.jpg', 'High performance sports car.'], // Fixing likely price typo/image mismatch from source, assuming premium
    ['Huracan', 'Lamborghini', 14000, 'image/lambugin.webp', 'Iconic design and speed.'],
    ['Land Cruiser', 'Toyota', 40000, 'image/w6.jpg', 'The ultimate off-road vehicle.'],
    ['Suzuki', 'Toyota', 820, 'image/mouse2.jpg', 'Compact and fuel efficient.'], // Suzuki is a brand, but keeping source naming "Toyota Suzuki" logic
    ['Pajero', 'Mitsubishi', 900, 'image/mouse1.jpg', 'Rugged 4x4 capability.'], // Pajero is Mitsubishi
    ['Benz', 'Mercedes', 10000, 'image/w2.jpg', 'Luxury sedan.'], // "Toyota Benzi" -> Mercedes Benz
    ['Gallardo', 'Lamborghini', 12000, 'image/mouse3.jpg', 'Sporty and agile.']
];

foreach ($cars as $car) {
    // Determine brand if not explicitly set in my array above based on source string
    // But I cleaned them up above:
    // "TOYOTA DUALIS" -> Brand: Toyota, Name: Dualis
    // "TOYOTA HARIER" -> Brand: Toyota, Name: Harier
    // "LAMBUGIN" -> Brand: Lamborghini, Name: ...
    
    $stmt->bind_param("ssdss", $car[0], $car[1], $car[2], $car[3], $car[4]);
    
    if ($stmt->execute()) {
        echo "Inserted: " . $car[1] . " " . $car[0] . "<br>";
    } else {
        echo "Error inserting " . $car[0] . ": " . $stmt->error . "<br>";
    }
}

echo "<br><strong style='color: green;'>✓ Database updated with Gallery cars!</strong><br>";
echo "<a href='Dashbord.php'>Go back to Dashboard</a>";

$conn->close();
?>
