<?php
include 'db.php'; // Include your database connection file

// Query to fetch data from the projects table
$query = "SELECT * FROM projects";

// Perform the query
$result = mysqli_query($connection, $query);

// Check for errors
if (!$result) {
    die('Query failed: ' . mysqli_error($connection));
}

// Fetch data and store in an array
$projects = [];
while ($row = mysqli_fetch_assoc($result)) {
    $projects[] = $row;
}

// Close connection
mysqli_close($connection);

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode(['projects' => $projects]);
?>
