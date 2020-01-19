<?php


class Friend
{
    // database connection and table name
    private $conn;
    private $table_name = "friend";

    public $friendId;
    public $friendProfileImage;
    public $friendFirstName;
    public $friendLastName;
    public $createdOn;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read friends
    function read(){

        // select all query
        $query = "SELECT
                friendId,
                friendProfileImage,
                friendFirstName,
                friendLastName,
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

    public function getFriendId (){
        return $this->friendId;
    }

    public function setFriendId($friendId){
        $this->friendId = $friendId;
    }

    public function getFriendProfileImage (){
        return $this->friendProfileImage;
    }

    public function setFriendProfileImage($friendProfileImage){
        $this-> friendProfileImage= $friendProfileImage;
    }

    public function getFriendFirstName(){
        return $this->friendFirstName;
    }

    public function setFriendFirstName($friendFirstName){
        $this->friendFirstName = $friendFirstName;
    }

    public function getFriendLastName(){
        return $this->friendLastName;
    }

    public function setFriendLastName($friendLastName){
        $this->friendLastName = $friendLastName;
    }

    public function getCreatedOn(){
        return $this->createdOn;
    }

    public function setCreatedOn($createdOn){
        $this->createdOn = $createdOn;
    }
}