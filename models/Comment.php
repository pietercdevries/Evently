<?php


class Comment
{
    // database connection and table name
    private $conn;
    private $table_name = "comment";

    public $commentId;
    public $friendId;
    public $message;
    public $createdOn;
    public $eventId;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read comments
    function read(){

        // select all query
        $query = "SELECT
                comment.commentId,
                comment.friendId,
                comment.message,
                comment.createdOn,
                comment.eventId,
                friend.friendId,
                friend.friendProfileImageUrl,
                friend.friendFirstName,
                friend.friendLastName,
                friend.createdOn
            FROM
                comment as comment
            JOIN
                friend as friend on friend.friendId = comment.friendId
            ORDER BY
                comment.createdOn DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    public function getCommentId (){
        return $this->commentId;
    }

    public function setCommentId($commentId){
        $this->commentId = $commentId;
    }

    public function getFriendId(){
        return $this->friendId;
    }

    public function setFriendId($friendId){
        $this->friendId = $friendId;
    }

    public function getMessage (){
        return $this->message;
    }

    public function setMessage($message){
        $this->message = $message;
    }

    public function getCreatedOn (){
        return $this->createdOn;
    }

    public function setCreatedOn($createdOn){
        $this->createdOn = $createdOn;
    }

    public function getEvent (){
        return $this->eventId;
    }

    public function setEvent($eventId){
        $this->eventId = $eventId;
    }
}