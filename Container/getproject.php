<?php
session_start();
include 'db.php';

// Check if the user is logged in
if(isset($_SESSION['logged_in_user'])) {
    $logged_in_user = $_SESSION['logged_in_user'];

    // Query to retrieve projects where the student is a member
    $sql = "SELECT * FROM projects WHERE member1 = ? OR member2 = ? OR member3 = ? OR member4 = ? OR member5 = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $logged_in_user, $logged_in_user, $logged_in_user, $logged_in_user, $logged_in_user);
    $stmt->execute();
    $result = $stmt->get_result();

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

    $stmt->close();
} else {
    echo "User not logged in";
}

$conn->close();
?>
