<?php
include 'db.php';

if (isset($_GET['id'])) {
    $projectId = $_GET['id'];

    // Query to retrieve all columns for a specific project
    $sql = "SELECT * FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $project = $result->fetch_assoc();

        // Convert tasks JSON string to array (if necessary)
        $project['tasks'] = json_decode($project['tasks'], true);

        // Add sample activities for demonstration (replace with actual data)
        $project['activities'] = array('Activity 1', 'Activity 2', 'Activity 3'); 

        echo json_encode($project);
    } else {
        echo "Project not found";
    }

    $stmt->close();
} else {
    // If no ID is provided, return all projects with all columns
    $sql = "SELECT * FROM projects WHERE guide = 'sss'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $projects = array();
        while($row = $result->fetch_assoc()) {
            // Convert tasks JSON string to array (if necessary)
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
