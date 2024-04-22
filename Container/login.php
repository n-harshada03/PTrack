<?php
include 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a SQL query to check if the username and password match
    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username and password match, redirect to the login page
        header("Location: login.html");
        exit;
    } else {
        // Username and password don't match, show error message
        echo "Invalid username or password";
    }
}
?>
