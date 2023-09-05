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

            // Read and import data from the text file into your database
            $lines = file($temp_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if ($lines) {
                foreach ($lines as $line) {
                    $replace_array = ["Title: ", "Release Year: ", "Format: ", "Stars: "];
                    $trim_line = str_replace($replace_array, "", $line);

                    $record[] = trim($trim_line);
                    if (count($record) === 4) {
                        list($title, $release_year, $format, $stars) = $record;

                        $mysqli = $database->connectDb();
                        $sql = "SELECT * FROM films WHERE title = '$title'";
                        $result = $mysqli->query($sql)->num_rows;
                        $mysqli->close();

                        if ($result <= 0) {
                            preg_match("/^[а-яА-Яa-zA-ZґҐЁёІіЇїЄє0-9][а-яА-Яa-zA-Z0-9ґҐЁёІіЇїЄє'’ʼ\s:,\-]+/", $title, $title_matches);
                            if (empty($title_matches) || strlen($title) != strlen($title_matches[0])) {
                                echo "$title not corected film name check your file, import stop";
                                echo "<br><br><a href='index.php'>Back</a><br>";
                                exit();
                            }

                            $check_year = date("Y");
                            if ($release_year > $check_year) {
                                echo "$title release year more then current year check your file, import stop";
                                echo "<br><br><a href='index.php'>Back</a><br>";
                                exit();
                            }

                            preg_match("/^[а-яА-Яa-zA-ZґҐЁёІіЇїЄє][а-яА-Яa-zA-ZґҐЁёІіЇїЄє'’ʼ\s,\-]+/", $stars, $stars_matches);
                            if (empty($stars_matches) || strlen($stars) != strlen($stars_matches[0])) {
                                echo "$stars for film $title not corected, check your file, import stop";
                                echo "<br><br><a href='index.php'>Back</a><br>";
                                exit();
                            }

                            $mysqli = $database->connectDb();
                            $sql = "INSERT INTO films (title, release_year, format, stars) VALUES ('$title', '$release_year', '$format', '$stars')";
                            $result = $mysqli->query($sql);
                            $mysqli->close();
                        }
                        $record = [];
                    }
                }
            }
            else {
                echo "File empty";
                echo "<br><br><a href='index.php'>Back</a><br>";
                exit();
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

