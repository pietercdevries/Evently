<?php


class User
{
    // database connection and table name
    private $conn;
    private $table_name = "user";

    public $userId;
    public $userEmail;
    public $userPasswordHash;
    public $userProfileImage;
    public $createdOn;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
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

    public function getUserProfileImage (){
        return $this->userProfileImage;
    }

    public function setUserProfileImage($userProfileImage){
        $this->userProfileImage = $userProfileImage;
    }

    public function getCreatedOn (){
        return $this->createdOn;
    }

    public function setCreatedOn($createdOn){
        $this->createdOn= $createdOn;
    }
}