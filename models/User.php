<?php


class User
{
    // database connection and table name
    private $conn;
    private $table_name = "user";

    public $userId;
    public $userEmail;
    public $userPasswordHash;
    public $userProfileImageUrl;
    public $createdOn;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read users
    function read(){

        // select all query
        $query = "SELECT
                userId,
                userEmail,
                userPasswordHash,
                userProfileImageUrl,
                createdOn
            FROM
                " . $this->table_name . " p
            ORDER BY
                createdOn DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    public function getUserId (){
        return $this->userId;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

    public function getUserEmail (){
        return $this->userEmail;
    }

    public function setUserEmail($userEmail){
        $this->userEmail = $userEmail;
    }

    public function getUserPasswordHash (){
        return $this->userPasswordHash;
    }

    public function setUserPasswordHash($userPasswordHash){
        $this->userPasswordHash = $userPasswordHash;
    }

    public function getUserProfileImageUrl (){
        return $this->userProfileImageUrl;
    }

    public function setUserProfileImageUrl($userProfileImageUrl){
        $this->userProfileImageUrl = $userProfileImageUrl;
    }

    public function getCreatedOn (){
        return $this->createdOn;
    }

    public function setCreatedOn($createdOn){
        $this->createdOn= $createdOn;
    }
}