<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters for INSERT statement
    $stmt = $conn->prepare("INSERT INTO projects (title, start_date, guide, leader, description, member1, member2, member3, member4, member5, deadline, tasks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssiss", $title, $start_date, $guide, $leader, $description, $member1, $member2, $member3, $member4, $member5, $deadline, $tasksJson);

    // Prepare and bind parameters for checking duplicate titles
    $checkTitleSql = "SELECT id FROM projects WHERE title = ?";
    $checkTitleStmt = $conn->prepare($checkTitleSql);
    $checkTitleStmt->bind_param("s", $title);

    // Set parameters from form data
    $title = $_POST['project-title'];
    $start_date = $_POST['project-Startdate'];
    $guide = $_POST['project-guide'];
    $leader = $_POST['project-leader'];
    $description = $_POST['project-description'];
    $member1 = $_POST['member1'];
    $member2 = $_POST['member2'];
    $member3 = $_POST['member3'];
    $member4 = $_POST['member4'];
    $member5 = $_POST['member5'];
    $deadline = $_POST['deadline'];
    $tasks = isset($_POST['tasks']) ? $_POST['tasks'] : array(); // Handle potential empty tasks array
    $tasksJson = json_encode($tasks); // Encode tasks array as JSON 

    // Check for duplicate title
    $checkTitleStmt->execute();
    $checkTitleResult = $checkTitleStmt->get_result();

    if ($checkTitleResult->num_rows > 0) {
        // Duplicate title found
        echo json_encode(array("error" => "Project with this title already exists."));
    } else {
        // No duplicate title, proceed with insert
        if ($stmt->execute()) {
            // Get the ID of the inserted record
            $inserted_id = $conn->insert_id;
            // Return the ID as JSON response
            echo json_encode(array("id" => $inserted_id)); 
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close statements
    $checkTitleStmt->close();
    $stmt->close();
}

$conn->close();
?>