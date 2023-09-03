<?php

class Database {

    public function connectDb () {
        $connection = new mysqli('mysql', 'user', 'password', 'test_project_db') or die ("not connected");

        return $connection;
    }

    public function checkDbNotExist ($db_name) {
        // SQL query to check if the table exists
        $sql = "SHOW TABLES LIKE '$db_name'";

        // Execute the query
        $result = $this->connectDb()->query($sql);

        // Check if the table exists
        if ($result->num_rows > 0) {
            return false;
        }

        return true;
    }
    public function createUsersTable() {
        // Check if the table exists
        if ($this->checkDbNotExist('users')) {
            $sql = "CREATE TABLE users (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL)";

            mysqli_query($this->connectDb(), $sql);
        }
    }

    public function createFilmsTable() {
        // Check if the table exists
        if ($this->checkDbNotExist('films')) {
            $sql = "CREATE TABLE films (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            release_year INT NOT NULL,
            format VARCHAR(255) NOT NULL,
            stars VARCHAR(255) NOT NULL)";

            mysqli_query($this->connectDb(), $sql);
        }
    }}