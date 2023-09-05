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
    $check_title = "SELECT * FROM films WHERE title = '$title'";
    $check_title_result = $mysqli->query($check_title)->num_rows;
    $mysqli->close();

    if ($check_title_result >= 1) {
        echo "Film with current title created";
        echo "<br><br><a href='index.php'>Back</a><br>";
        exit();
    }

    $check_year = date("Y");
    if ($release_year > $check_year) {
        echo "Film release year more then current year";
        echo "<br><br><a href='index.php'>Back</a><br>";
        exit();
    }

    $mysqli = $database->connectDb();
    $sql = "INSERT INTO films (title, release_year, format, stars) VALUES ('$title', '$release_year', '$format', '$stars')";

    if ($mysqli->query($sql)) {
        header("Location: index.php");
        exit();
    }
    else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}
?>
