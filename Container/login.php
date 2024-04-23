<?php
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

    // Prepare a SQL statement to check if the username and password exist in the database
    $stmt = $conn->prepare("SELECT * FROM login WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is a row with matching username and password
    if ($result->num_rows > 0) {
        // Redirect to the myprojects.html page if login is successful
        header("Location: myprojects.html");
        exit();
    } else {
        // If no matching username and password found, create a JavaScript function to display the error message and redirect
        echo "<script>
                function showError() {
                    alert('Invalid username or password');
                    window.location.href = 'login.html';
                }
                window.onload = showError;
              </script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
