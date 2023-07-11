<?php
// Database configuration
$host = '127.0.0.1';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'login';

// Create database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
   // echo "Connected to the database successfully!";
}
?>
