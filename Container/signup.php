<?php
include 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST['username'];
    $firstName = $_POST['fullName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $securityQuestion = $_POST['securityQuestion'];
    $department = $_POST['department'];

    // SQL query to insert data into users table
    $sql = "INSERT INTO users (username, firstName, lastName, email, password, securityQuestion, department) VALUES ('$username', '$firstName', '$lastName', '$email', '$password', '$securityQuestion', '$department')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}