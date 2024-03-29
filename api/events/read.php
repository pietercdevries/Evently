<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/Database.php';
include_once '../../models/Event.php';

// instantiate database and event object
$database = new Database();
$db = $database->getConnection();

// initialize object
$event = new Event($db);

// Get event Id
$eventId = null;
$eventId = htmlspecialchars($_GET["eventId"]);

// query events
$stmt = $event->read($eventId);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0)
{
    // events array
    $event_arr=array();
    $event_arr["events"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $profile_item=array(
            "profileId" => $profileId,
            "profileImageUrl" => html_entity_decode($profileImageUrl),
            "profileFirstName" => html_entity_decode($profileFirstName),
            "profileLastName" => html_entity_decode($profileLastName),
            "createdOn" => $profileCreatedOn
        );

        // Get attending members
        $attending_friends_arr=array();
        $attendingStmt = $event->getAttendingEventsByEventId($eventId);

        while ($attendingRow = $attendingStmt->fetch(PDO::FETCH_ASSOC))
        {
            $attending_friend=array(
                "friendId" => $attendingRow['friendId'],
                "friendProfileImageUrl" => $attendingRow['friendProfileImageUrl'],
                "friendFirstName" => $attendingRow['friendFirstName'],
                "friendLastName" => $attendingRow['friendLastName']
            );

            array_push($attending_friends_arr, $attending_friend);
        }

        $event_item=array(
            "eventId" => $eventId,
            "eventImageUrl" => html_entity_decode($eventImageUrl),
            "evenTitle" => html_entity_decode($evenTitle),
            "eventTime" => html_entity_decode($eventTime),
            "eventEndTime" => html_entity_decode($eventEndTime),
            "eventDate" => html_entity_decode($eventDate),
            "eventDescription" => html_entity_decode($eventDescription),
            "eventDistance" => html_entity_decode($eventDistance),
            "eventCategories" => html_entity_decode($eventCategories),
            "eventLikeCounter" => $eventLikeCounter,
            "eventCommentCounter" => $eventCommentCounter,
            "eventWebsite" => html_entity_decode($eventWebsite),
            "eventAddress" => html_entity_decode($eventAddress),
            "eventPlace" => html_entity_decode($eventPlace),
            "eventPhoneNumber" => html_entity_decode($eventPhoneNumber),
            "eventLiked" => $eventLiked,
            "commentedOn" => $commentedOn,
            "eventCreator" => $profile_item,
            "weather" => html_entity_decode($weather),
            "attendingFriends" => $attending_friends_arr,
            "createdOn" => $eventCreatedOn
        );

        array_push($event_arr["events"], $event_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show events data in json format
    echo json_encode($event_arr);
}
else
{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no events found
    echo json_encode(
        array("message" => "No events found.")
    );
}

