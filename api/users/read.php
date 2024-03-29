<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/Database.php';
include_once '../../models/User.php';

// instantiate database and user object
$database = new Database();
$db = $database->getConnection();

// initialize object
$user = new User($db);

// query users
$stmt = $user->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0)
{
    // users array
    $user_arr=array();
    $user_arr["users"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $user_item=array(
            "userId" => $userId,
            "userEmail" => html_entity_decode($userEmail),
            "userPasswordHash" => $userPasswordHash,
            "userProfileImageUrl" => html_entity_decode($userProfileImageUrl),
            "createdOn" => $createdOn
        );

        array_push($user_arr["users"], $user_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show users data in json format
    echo json_encode($user_arr);
}
else
{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no users found
    echo json_encode(
        array("message" => "No users found.")
    );
}
