<?php
$servername = "localhost"; // Server name (usually localhost)
$username = "root";        // MySQL username (default is root)
$password = "";            // MySQL password (default is empty for XAMPP)
$database = "used_books";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
