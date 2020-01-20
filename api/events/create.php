<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../../config/database.php';

// instantiate event object
include_once '../../models/event.php';

$database = new Database();
$db = $database->getConnection();

$event = new Event($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (
    !empty($data->eventImageUrl) &&
    !empty($data->evenTitle) &&
    !empty($data->eventTime) &&
    !empty($data->eventDate) &&
    !empty($data->eventDescription) &&
    !empty($data->eventDistance) &&
    !empty($data->eventCategories) &&
    !empty($data->eventLikeCounter) &&
    !empty($data->eventCommentCounter) &&
    !empty($data->eventWebsite) &&
    !empty($data->eventAddress) &&
    !empty($data->eventPhoneNumber) &&
    !empty($data->eventLiked) &&
    !empty($data->commentedOn) &&
    !empty($data->eventCreatorProfileId) &&
    !empty($data->weather)
) {
    // set event property values
    $event->name = $data->name;
    $event->price = $data->price;
    $event->description = $data->description;
    $event->category_id = $data->category_id;
    $event->created = date('Y-m-d H:i:s');

    $event->eventImageUrl = $data->eventImageUrl;
    $event->evenTitle = $data->evenTitle;
    $event->eventTime = date('HH:mm:ss', $data->eventTime);
    $event->eventDate = date('yyyy-mm-dd', $data->eventDate);
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
    if ($event->create()) {

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "event was created."));
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
