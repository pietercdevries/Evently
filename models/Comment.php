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
    function read($eventId){

        // select all query
        $query = "SELECT
                evt.eventId,
                evt.eventImageUrl,
                evt.evenTitle,
                evt.eventTime,
                evt.eventDate,
                evt.eventDescription,
                evt.eventDistance,
                evt.eventCategories,
                evt.eventLikeCounter,
                evt.eventCommentCounter,
                evt.eventWebsite,
                evt.eventAddress,
                evt.eventPhoneNumber,
                evt.eventLiked,
                evt.commentedOn,
                evt.weather,
                evt.createdOn as eventCreatedOn,
                pro.profileId,
                pro.profileImageUrl,
                pro.profileFirstName,
                pro.profileLastName,
                pro.createdOn as profileCreatedOn,
                comment.commentId,
                comment.friendId,
                comment.message,
                comment.createdOn as commentCreatedOn,
                comment.eventId,
                friend.friendId,
                friend.friendProfileImageUrl,
                friend.friendFirstName,
                friend.friendLastName,
                friend.createdOn as friendCreatedOn
            FROM
                 " . $this->table_name . " as comment
            JOIN 
                event as evt on evt.eventId = comment.eventId
            JOIN 
                profile as pro on pro.profileId = evt.eventCreatorProfileId
            JOIN
                friend as friend on friend.friendId = comment.friendId
            WHERE
                comment.eventId = :eventId
            ORDER BY
                comment.createdOn DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":eventId", $eventId);

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