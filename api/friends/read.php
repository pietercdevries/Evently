<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/Database.php';
include_once '../../models/Friend.php';

// instantiate database and friend object
$database = new Database();
$db = $database->getConnection();

// initialize object
$friend = new Friend($db);

// query friends
$stmt = $friend->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0)
{
    // friends array
    $friend_arr=array();
    $friend_arr["friends"]=array();

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
            "createdOn" => $createdOn
        );

        array_push($friend_arr["friends"], $friend_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show friends data in json format
    echo json_encode($friend_arr);
}
else
{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no friends found
    echo json_encode(
        array("message" => "No friends found.")
    );
}