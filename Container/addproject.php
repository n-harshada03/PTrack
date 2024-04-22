<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO projects (title, start_date, num_members, guide, leader, description, tasks) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissss", $title, $start_date, $num_members, $guide, $leader, $description, $tasks);

    // Set parameters
    $title = $_POST['project-title'];
    $start_date = $_POST['project-Startdate'];
    $num_members = $_POST['num-members'];
    $guide = $_POST['project-guide'];
    $leader = $_POST['project-leader'];
    $description = $_POST['project-description'];
    $tasks = isset($_POST['tasks']) ? implode(',', $_POST['tasks']) : ''; // Assuming tasks are submitted as an array

    // Execute statement
    if ($stmt->execute()) {
        // Get the ID of the inserted record
        $inserted_id = $conn->insert_id;
        // Return the ID as JSON response
        echo json_encode(array("id" => $inserted_id));
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}
$conn->close();
?>