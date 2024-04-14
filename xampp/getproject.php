<?php
// Include database connection
include 'db.php';

// Query to retrieve all projects
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    $projects = array();
    while($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
    // Convert projects array to JSON and output
    echo json_encode($projects);
} else {
    echo "0 results";
}

// Close database connection
$conn->close();
?>
