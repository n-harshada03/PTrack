<?php
session_start();

$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "users"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a SQL statement to check if the username and password exist in the users table
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is a row with matching username and password in the users table
    if ($result->num_rows > 0) {
        // Store the username in a session variable
        $_SESSION['logged_in_user'] = $username;

        // Redirect to the appropriate student dashboard page if login is successful
        header("Location: myprojects.html");
        exit();
    } else {
        // If no matching username and password found in the users table, check in the projects table
        $stmt = $conn->prepare("SELECT * FROM projects WHERE member1=? OR member2=? OR member3=? OR member4=? OR member5=?");
        $stmt->bind_param("sssss", $username, $username, $username, $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there is a row with matching username in any of the member fields in the projects table
        if ($result->num_rows > 0) {
            // Store the username in a session variable
            $_SESSION['logged_in_user'] = $username;

            // Redirect to the appropriate student dashboard page if login is successful
            header("Location: myprojects.html");
            exit();
        } else {
            // If no matching username found in both tables, create a JavaScript function to display the error message and redirect
            echo "<script>
                    function showError() {
                        alert('Invalid username or password');
                        window.location.href = 'login.html';
                    }
                    window.onload = showError;
                  </script>";
        }
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
