<?php
session_start();

require_once('Database.php');

$database = new Database();

// Create a database connection
$mysqli = $database->connectDb();

// Get user input
$username = $_POST['username'];
$password = $_POST['password'];

// Query the database to check if the user exists
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

if (mysqli_query($mysqli, $sql)->num_rows == 1) {
    // Authentication successful
    $_SESSION['username'] = $username;
    header("Location: index.php");
} else {
    // Authentication failed
    echo "Invalid username or password.";
    echo "<br><br><a href='login.php'>Login</a><br>
        <a href='registration.php'>Registration</a>";
}

$mysqli->close();
?>
