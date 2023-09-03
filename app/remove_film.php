<?php
session_start();

require_once('Database.php');

$database = new Database();

// Check if the user is authenticated
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve the film ID from the form
    $film_id = $_GET['film_id'];

    // Create a database connection
    $mysqli = $database->connectDb();

    $database->createFilmsTable();

    $sql = "DELETE FROM films WHERE id='$film_id'";

    if (mysqli_query($mysqli, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}
?>
