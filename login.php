<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mock database connection details
    $servername = "your_database_server";
    $username = "your_database_username";
    $password = "your_database_password";
    $dbname = "your_database_name";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve username and password from the form
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Example query to validate the user (replace with your actual query)
    $sql = "SELECT * FROM users WHERE username='$input_username' AND password='$input_password'";
    $result = $conn->query($sql);

    // Check if the user is found in the database
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $input_username;
        header("Location: index.php");
    } else {
        echo "Invalid username or password.";
    }

    // Close the database connection
    $conn->close();
}
?>
