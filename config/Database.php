<?php


class Database
{

    // Specify your own database credentials.
    private $host = "localhost";
    private $db_name = "evently";
    private $username = "pieter";
    private $password = "c@0Lt3mysql";
    public $conn;

    // Get the database connection.
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
