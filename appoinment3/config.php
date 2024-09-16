<?php
$servername = "localhost";
$username = "root";
$password = ""; // Adjust according to your setup
$dbname = "doctor_appointments";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
