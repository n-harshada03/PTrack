<?php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = "55555555"; // Your MySQL password
$dbname = "user"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
