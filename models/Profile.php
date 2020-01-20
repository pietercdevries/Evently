<?php


class Profile
{
    // database connection and table name
    private $conn;
    private $table_name = "profile";

    public $profileId;
    public $profileImageUrl;
    public $profileFirstName;
    public $profileLastName;
    public $createdOn;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read profiles
    function read(){

        // select all query
        $query = "SELECT
                profileId,
                profileImageUrl,
                profileFirstName,
                profileLastName,
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

    public function getProfileId (){
        return $this->profileId;
    }

    public function setProfileId($profileId){
        $this->profileId = $profileId;
    }

    public function getProfileImageUrl (){
        return $this->profileImageUrl;
    }

    public function setProfileImageUrl($profileImageUrl){
        $this->profileImageUrl = $profileImageUrl;
    }

    public function getProfileFirstName (){
        return $this->profileFirstName;
    }

    public function setProfileFirstName($profileFirstName){
        $this->profileFirstName = $profileFirstName;
    }

    public function getProfileLastName (){
        return $this->profileLastName;
    }

    public function setProfileLastName($profileLastName){
        $this->profileLastName = $profileLastName;
    }

    public function getCreatedOn (){
        return $this->createdOn;
    }

    public function setCreatedOn($createdOn){
        $this->createdOn= $createdOn;
    }
}