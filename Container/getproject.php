<?php
include 'db.php';

if (isset($_GET['id'])) {
    $projectId = $_GET['id'];

    // Query to retrieve specific project
    $sql = "SELECT * FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $project = $result->fetch_assoc();
        // Convert tasks JSON string to array
        $project['tasks'] = json_decode($project['tasks'], true);

        // Add sample activities for demonstration
        $project['activities'] = array('Activity 1', 'Activity 2', 'Activity 3'); // Replace with actual activity data

        echo json_encode($project);
    } else {
        echo "Project not found";
    }

    $stmt->close();
} else {
    // If no ID is provided, return all projects
    $sql = "SELECT * FROM projects";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $projects = array();
        while($row = $result->fetch_assoc()) {
            // Convert tasks JSON string to array
            $row['tasks'] = json_decode($row['tasks'], true);
            $projects[] = $row;
        }
        echo json_encode($projects);
    } else {
        echo "0 results";
    }
}

$conn->close();
?>