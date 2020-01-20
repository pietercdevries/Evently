<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/Database.php';
include_once '../../models/Comment.php';

// instantiate database and comment object
$database = new Database();
$db = $database->getConnection();

// initialize object
$comment = new Comment($db);

// Get event Id
$eventId = htmlspecialchars($_GET["eventId"]);

// query comments
$stmt = $comment->read($eventId);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0)
{
    // comments array
    $comment_arr=array();
    $comment_arr["comments"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $friend_item=array(
            "friendId" => $friendId,
            "friendProfileImageUrl" => html_entity_decode($friendProfileImageUrl),
            "friendFirstName" => html_entity_decode($friendFirstName),
            "friendLastName" => html_entity_decode($friendLastName),
            "createdOn" => $friendCreatedOn
        );

        $profile_item=array(
            "profileId" => $profileId,
            "profileImageUrl" => html_entity_decode($profileImageUrl),
            "profileFirstName" => html_entity_decode($profileFirstName),
            "profileLastName" => html_entity_decode($profileLastName),
            "createdOn" => $profileCreatedOn
        );

        $event_item=array(
            "eventId" => $eventId,
            "eventImageUrl" => html_entity_decode($eventImageUrl),
            "evenTitle" => html_entity_decode($evenTitle),
            "eventTime" => html_entity_decode($eventTime),
            "eventDate" => html_entity_decode($eventDate),
            "eventDescription" => html_entity_decode($eventDescription),
            "eventDistance" => html_entity_decode($eventDistance),
            "eventCategories" => html_entity_decode($eventCategories),
            "eventLikeCounter" => $eventLikeCounter,
            "eventCommentCounter" => $eventCommentCounter,
            "eventWebsite" => html_entity_decode($eventWebsite),
            "eventAddress" => html_entity_decode($eventAddress),
            "eventPhoneNumber" => html_entity_decode($eventPhoneNumber),
            "eventLiked" => $eventLiked,
            "commentedOn" => $commentedOn,
            "eventCreator" => $profile_item,
            "weather" => html_entity_decode($weather),
            "createdOn" => $eventCreatedOn
        );

        $comment_item=array(
            "commentId" => $commentId,
            "friend" => $friend_item,
            "message" => html_entity_decode($message),
            "createdOn" => $commentCreatedOn,
            "event" => $event_item
        );

        array_push($comment_arr["comments"], $comment_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show comments data in json format
    echo json_encode($comment_arr);
}
else
{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no comments found
    echo json_encode(
        array("message" => "No comments found.")
    );
}