<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
</head>
<body>

    <h2>Login Form</h2>
    
    <?php
    session_start();

    if (isset($_SESSION['username'])) {
        echo "<p>Welcome, " . $_SESSION['username'] . "!</p>";
        echo "<p><a href='logout.php'>Logout</a></p>";
    } else {
        include('login_form.php');
    }
    ?>

</body>
</html>
