<?php

require_once('Database.php');

$database = new Database();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $mysqli = $database->connectDb();

    $sql = "SELECT * FROM users WHERE username = '$username'";

    // Validate the input
    if (empty($username) || empty($password) || empty($confirm_password)) {
        echo "All fields are required.";
        echo "<br><br><a href='login.php'>Login</a><br>
        <a href='registration.php'>Registration</a>";
    } elseif ($password !== $confirm_password) {
        echo "Passwords do not match.";
        echo "<br><br><a href='login.php'>Login</a><br>
        <a href='registration.php'>Registration</a>";
    } elseif (mysqli_query($mysqli, $sql)->num_rows > 0) {
        echo "Current username registered";
        echo "<br><br><a href='login.php'>Login</a><br>
        <a href='registration.php'>Registration</a>";
    } else {
        // Insert the user data into the database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if (mysqli_query($mysqli, $sql)) {
            echo "New record created successfully";
            echo "<br><br><a href='login.php'>Login</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
            echo "<br><br><a href='login.php'>Login</a><br>
            <a href='registration.php'>Registration</a>";
        }

        $mysqli->close();
    }
}
?>
