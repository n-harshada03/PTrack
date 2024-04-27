<?php
include 'db.php';

if (isset($_GET['id'])) {
    $projectId = $_GET['id'];
    
    // Prepare and bind parameters for DELETE statement
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $projectId);

    if ($stmt->execute()) {
        echo "Project deleted successfully";
    } else {
        echo "Error deleting project: " . $stmt->error;
    }

    $stmt->close();
} 

$conn->close(); 
?>