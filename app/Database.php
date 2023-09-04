<?php

class Database {

    public function connectDb()
    {
        $connection = new mysqli('mysql', 'user', 'password', 'test_project_db') or die ("not connected");

        return $connection;
    }
}