<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once('Database.php');

$database = new Database();

?>

<!DOCTYPE html>
<html  lang="uk">
<head>
    <script src="script.js"></script>
    <title>Film Database</title>
</head>
<body>
<h2>Welcome, <?php echo $_SESSION['username']; ?></h2>

<!-- Add a search input field -->
<input type="text" id="titleInput" onkeyup="searchTableByTitle()" placeholder="Search by Title">
<input type="text" id="starsInput" onkeyup="searchTableByStars()" placeholder="Search by Stars">

<!-- Display the table of films -->
<table border="1" id="table" >
    <thead>
    <tr>
        <th>Title</th>
        <th>Release Year</th>
        <th>Format</th>
        <th>Stars</th>
        <th>Remove</th>
    </tr>
    </thead>
    <?php
    // Create a database connection
    $mysqli = $database->connectDb();

    $sql = "SELECT id, title, release_year, format, stars FROM films";

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['release_year']}</td>";
            echo "<td>{$row['format']}</td>";
            echo "<td>{$row['stars']}</td>";
            echo "<td><a href='remove_film.php?film_id={$row['id']}'>Remove</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No films found.</td></tr>";
    }
    ?>
</table>

<h2>Add a Film</h2>
<form action="add_film.php" method="post">
    <label for="title">Title:</label>
    <input type="text" name="title" pattern="^[а-яА-Яa-zA-ZґҐЁёІіЇїЄє0-9][а-яА-Яa-zA-Z0-9ґҐЁёІіЇїЄє'’ʼ\s:,\-]+" required><br>

    <label for="year">Release Year:</label>
    <input type="number" name="year" required min="1895"><br>
    <label for="format">Format:</label>
    <select name="format">
        <option value="VHS" selected>VHS</option>
        <option value="DVD">DVD</option>
        <option value="Blu-Ray">Blu-Ray</option>
    </select><br>

    <label for="stars">Stars:</label>
    <input type="text" name="stars" pattern="^[а-яА-Яa-zA-ZґҐЁёІіЇїЄє][а-яА-Яa-zA-ZґҐЁёІіЇїЄє'’ʼ\s,\-]+" required><br>

    <input type="submit" value="Add Film">
</form>

<!-- Add a file upload form for data import -->
<h2>Import Films</h2>
<form action="import_data.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file_to_import" accept=".txt">
    <input type="submit" value="Import Data">
</form><br>

<a href="logout.php">Logout</a>
</body>
</html>
