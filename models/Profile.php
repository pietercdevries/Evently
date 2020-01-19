<?php


class Profile
{
    // database connection and table name
    private $conn;
    private $table_name = "profile";

    public $profileId;
    public $profileImage;
    public $profileFirstName;
    public $profileLastName;
    public $createdOn;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function getProfileId (){
        return $this->profileId;
    }

    public function setProfileId($profileId){
        $this->profileId = $profileId;
    }

    public function getProfileImage (){
        return $this->profileImage;
    }

    public function setProfileImage($profileImage){
        $this->profileImage = $profileImage;
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