<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once('Database.php');

$database = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file_to_import"])) {
        $file = $_FILES["file_to_import"];

        // Check if the file is a text file
        $file_extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        if ($file_extension === "txt") {
            // Process the uploaded text file
            $temp_file = $file["tmp_name"];

            $database->createFilmsTable();

            // Read and import data from the text file into your database
            $lines = file($temp_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $replace_array = ["Title: ", "Release Year: ", "Format: ", "Stars: "];
                $trim_line = str_replace($replace_array, "", $line);

                $record[] = trim($trim_line);
                if (count($record) === 4) {
                    list($title, $release_year, $format, $stars) = $record;

                    $mysqli = $database->connectDb();
                    $sql = "INSERT INTO films (title, release_year, format, stars) VALUES ('$title', '$release_year', '$format', '$stars')";
                    $result = $mysqli->query($sql);

                    $mysqli->close();
                    $record = [];
                }
            }

            // Redirect back to the main page after importing
            header("Location: index.php");
            exit();
        } else {
            echo "Please upload a valid text file (.txt).";
        }
    } else {
        echo "No file uploaded.";
    }
}

