<?php
require 'database.php';

$result = $conn->query("SHOW TABLES");
if ($result) {
    echo "Tables in database '" . DB_NAME . "':\n";
    while ($row = $result->fetch_row()) {
        echo "- " . $row[0] . "\n";
    }
} else {
    echo "Error showing tables: " . $conn->error . "\n";
}
$conn->close();
?>
