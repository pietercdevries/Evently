<?php


class Event
{
    // database connection and table name
    private $conn;
    private $table_name = "event";

    public $eventId;
    public $eventImageUrl;
    public $evenTitle;
    public $eventTime;
    public $eventDate;
    public $eventDescription;
    public $eventDistance;
    public $eventCategories;
    public $eventLikeCounter;
    public $eventCommentCounter;
    public $eventWebsite;
    public $eventAddress;
    public $eventPhoneNumber;
    public $eventLiked;
    public $commentedOn;
    public $eventCreatorProfileId;
    public $weather;
    public $createdOn;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read events
    function read($eventId){

        if($eventId != null && $eventId != "")
        {
            return $this->readByEventId($eventId);
        }
        else
        {
            return $this->readEvents();
        }
    }

    // read events
    function readEvents(){

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
                pro.createdOn as profileCreatedOn
            FROM
                " . $this->table_name . " as evt
            JOIN 
                profile as pro on pro.profileId = evt.eventCreatorProfileId
            ORDER BY
                evt.createdOn DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read events
    function readByEventId($eventId){

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
                pro.createdOn as profileCreatedOn
            FROM
                " . $this->table_name . " as evt
            JOIN 
                profile as pro on pro.profileId = evt.eventCreatorProfileId
            WHERE
                evt.eventId = :eventId
            ORDER BY
                evt.createdOn DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":eventId", $eventId);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function getEventId (){
        return $this->eventId;
    }

    function setEventId($eventId){
        $this->eventId = $eventId;
    }

    function getEventImageUrl (){
        return $this->eventImageUrl;
    }

    function setEventImageUrl($eventImageUrl){
        $this->eventImageUrl = $eventImageUrl;
    }

    function getEvenTitle (){
        return $this->evenTitle;
    }

    function setEvenTitle($evenTitle){
        $this->evenTitle = $evenTitle;
    }

    function getEventTime(){
        return $this->eventTime;
    }

    function setEventTime($eventTime){
        $this->eventTime = $eventTime;
    }

    function getEventDate (){
        return $this->eventDate;
    }

    function setEventDate($eventDate){
        $this->eventDate = $eventDate;
    }

    function getEventDescription (){
        return $this->eventDescription;
    }

    function setEventDescription($eventDescription){
        $this->eventDescription = $eventDescription;
    }

    function getEventDistance (){
        return $this->eventDistance;
    }

    function setEventDistance($eventDistance){
        $this->eventDistance = $eventDistance;
    }

    function getEventCategories (){
        return $this->eventCategories;
    }

    function setEventCategories($eventCategories){
        $this->eventCategories = $eventCategories;
    }

    function getEventLikeCounter (){
        return $this->eventLikeCounter;
    }

    function setEventLikeCounter($eventLikeCounter){
        $this->eventLikeCounter = $eventLikeCounter;
    }

    function getEventCommentCounter (){
        return $this->eventCommentCounter;
    }

    function setEventCommentCounter($eventCommentCounter){
        $this->eventCommentCounter = $eventCommentCounter;
    }

    function getEventWebsite (){
        return $this->eventWebsite;
    }

    function setEventWebsite($eventWebsite){
        $this->eventWebsite = $eventWebsite;
    }

    function getEventAddress (){
        return $this->eventAddress;
    }

    function setEventAddress($eventAddress){
        $this->eventAddress = $eventAddress;
    }

    function getEventPhoneNumber (){
        return $this->eventPhoneNumber;
    }

    function setEventPhoneNumber($eventPhoneNumber){
        $this->eventPhoneNumber = $eventPhoneNumber;
    }

    function getEventLiked (){
        return $this->eventLiked;
    }

    function setEventLiked($eventLiked){
        $this->eventLiked = $eventLiked;
    }

    function getEventAttendingMembers (){
        return $this->eventAttendingMembers;
    }

    function setEventAttendingMembers($eventAttendingMembers){
        $this->eventAttendingMembers = $eventAttendingMembers;
    }

    function getCommentedOn (){
        return $this->commentedOn;
    }

    function setCommentedOn($commentedOn){
        $this->commentedOn = $commentedOn;
    }

    function getEventCreatorProfileId (){
        return $this->eventCreatorProfileId;
    }

    function setEventCreatorProfileId($eventCreatorProfileId){
        $this->eventCreatorProfileId = $eventCreatorProfileId;
    }

    function getWeather (){
        return $this->weather;
    }

    function setWeather($weather){
        $this->weather = $weather;
    }

    function getCreatedOn (){
        return $this->createdOn;
    }

    function setCreatedOn($createdOn){
        $this->createdOn = $createdOn;
    }
}