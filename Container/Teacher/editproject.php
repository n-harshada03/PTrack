<?php
include 'db.php';

// Assuming data is sent as JSON
$data = json_decode(file_get_contents('php://input'), true);

// Extract data from JSON
$projectId = $data['projectId'];
$title = $data['project-title'];
$description = $data['project-description'];
$startDate = $data['project-Startdate'];
$guide = $data['project-guide'];
$leader = $data['project-leader'];
$progress = $data['project-progress'];
$deadline = $data['deadline'];
$member1 = $data['member1'];
$member2 = $data['member2'];
$member3 = $data['member3'];
$member4 = $data['member4'];
$member5 = $data['member5'];
$tasks = json_encode($data['tasks']); // Convert tasks array to JSON string

// Prepare and bind parameters for UPDATE statement
$stmt = $conn->prepare("UPDATE projects SET title = ?, description = ?, start_date = ?, guide = ?, leader = ?, progress = ?, deadline = ?, member1 = ?, member2 = ?, member3 = ?, member4 = ?, member5 = ?, tasks = ? WHERE id = ?");
$stmt->bind_param("sssssssssssssi", $title, $description, $startDate, $guide, $leader, $progress, $deadline, $member1, $member2, $member3, $member4, $member5, $tasks, $projectId);

if ($stmt->execute()) {
    echo json_encode(array("message" => "Project updated successfully"));
} else {
    echo json_encode(array("error" => "Error updating project: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>