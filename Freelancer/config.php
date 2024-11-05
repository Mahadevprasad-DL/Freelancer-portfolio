<?php
ob_start(); // Turns on output buffering 

// Set the default timezone
$timezone = date_default_timezone_set("Europe/London");

// Database connection parameters
$host = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password (if any)
$database = "feedback_engine"; // Updated to use the new database

// Establish the database connection
$con = mysqli_connect($host, $username, $password, $database);

// Check for connection errors
if (mysqli_connect_errno()) {
    echo "Failed to connect: " . mysqli_connect_error(); // Updated to use mysqli_connect_error for more detail
}
?>
