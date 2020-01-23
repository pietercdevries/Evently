<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../../config/Database.php';

// instantiate event object
include_once '../../models/Event.php';

$database = new Database();
$db = $database->getConnection();

$event = new Event($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (
    isset($data->eventImageUrl) &&
    isset($data->evenTitle) &&
    isset($data->eventTime) &&
    isset($data->eventDate) &&
    isset($data->eventDescription) &&
    isset($data->eventAddress) &&
    isset($data->eventCreatorProfileId) &&
    isset($data->weather)
) {
    // set event property values
    $event->eventImageUrl = $data->eventImageUrl;
    $event->evenTitle = $data->evenTitle;
    $event->eventTime = $data->eventTime;
    $event->eventDate = $data->eventDate;
    $event->eventDescription = $data->eventDescription;
    $event->eventDistance = $data->eventDistance;
    $event->eventCategories = $data->eventCategories;
    $event->eventLikeCounter = $data->eventLikeCounter;
    $event->eventCommentCounter = $data->eventCommentCounter;
    $event->eventWebsite = $data->eventWebsite;
    $event->eventAddress = $data->eventAddress;
    $event->eventPhoneNumber = $data->eventPhoneNumber;
    $event->eventLiked = $data->eventLiked;
    $event->commentedOn = $data->commentedOn;
    $event->eventCreatorProfileId = $data->eventCreatorProfileId;
    $event->weather = $data->weather;

    // create the event

    $eventId = $event->create();

    if ($eventId) {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo $eventId;
    } // if unable to create the event, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create event."));
    }
} // tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create event. Data is incomplete."));
}
