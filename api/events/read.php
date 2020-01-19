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

// query events
$stmt = $event->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0)
{
    // events array
    $event_arr=array();
    $event_arr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $event_item=array(
            "eventId" => $eventId,
            "eventImage" => html_entity_decode($eventImage),
            "evenTitle" => html_entity_decode($evenTitle),
            "eventTime" => html_entity_decode($eventTime),
            "eventDate" => html_entity_decode($eventDate),
            "eventDescription" => html_entity_decode($eventDescription),
            "eventDistance" => html_entity_decode($eventDistance),
            "eventCategories" => $eventCategories,
            "eventLikeCounter" => $eventLikeCounter,
            "eventCommentCounter" => $eventCommentCounter,
            "eventWebsite" => html_entity_decode($eventWebsite),
            "eventAddress" => html_entity_decode($eventAddress),
            "eventPhoneNumber" => html_entity_decode($eventPhoneNumber),
            "eventLiked" => $eventLiked,
            "eventAttendingMembers" => $eventAttendingMembers,
            "commentedOn" => $commentedOn,
            "eventCreator" => $eventCreator,
            "weather" => html_entity_decode($weather),
            "createdOn" => $createdOn
        );

        array_push($event_arr["records"], $event_item);
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

