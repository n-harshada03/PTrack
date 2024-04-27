<?php
include 'db.php'; // Assuming this file contains database connection code

// Fetch data from the database
$sql = "SELECT * FROM projects WHERE id = 1"; // Assuming you want to fetch a specific project, change '1' as needed
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Assuming you want to fetch only one project, change '1' to the required number of projects
    $row = mysqli_fetch_assoc($result);
    $project = array(
        'title' => $row['title'],
        'start_date' => $row['start_date'],
        'guide' => $row['guide'],
        'leader' => $row['leader'],
        'progress' => $row['progress'],
        'description' => $row['description'],
        'member1' => $row['member1'],
        'member2' => $row['member2'],
        'member3' => $row['member3'],
        'member4' => $row['member4'],
        'member5' => $row['member5'],
        'deadline' => $row['deadline'],
        'tasks' => $row['tasks']
    );

    // Returning the project data as JSON
    echo json_encode(array('project' => $project));
} else {
    echo json_encode(array('error' => 'No project found'));
}
?>
