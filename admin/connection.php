<?php
// Database connection file for Azzaro Admin Panel

$servername = "srv1740.hstgr.io";  // Change this if the database is hosted externally
$username = "u725408698_azzaro";
$password = "iK=8=bcYV7";
$database = "u725408698_azzaro";

// Establish connection using MySQLi
$conn = new mysqli($servername, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Set character encoding to UTF-8
$conn->set_charset("utf8");

// Optional: Uncomment to debug connection issues
// echo "Database connected successfully!";

?>
