<?php
require_once('Database.php');

$database = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $title = $_POST['title'];
    $release_year = $_POST['year'];
    $format = $_POST['format'];
    $stars = $_POST['stars'];

    // Create a database connection
    $mysqli = $database->connectDb();

    $sql = "INSERT INTO films (title, release_year, format, stars) VALUES ('$title', '$release_year', '$format', '$stars')";

    if (mysqli_query($mysqli, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}
?>
