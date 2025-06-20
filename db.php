<?php
$host = '127.0.0.1';        // Use localhost or 127.0.0.1
$port = 3307;               // Your custom MySQL port
$dbname = 'urbiztondo_db'; // Replace with your actual DB name
$username = 'root';         // Default XAMPP MySQL user
$password = '';             // Default XAMPP password (usually empty)

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection successful"; // Uncomment for debugging
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>