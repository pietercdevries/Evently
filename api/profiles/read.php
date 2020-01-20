<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/Database.php';
include_once '../../models/Profile.php';

// instantiate database and profile object
$database = new Database();
$db = $database->getConnection();

// initialize object
$profile = new Profile($db);

// query profiles
$stmt = $profile->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0)
{
    // profiles array
    $profile_arr=array();
    $profile_arr["profiles"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $profile_item=array(
            "profileId" => $profileId,
            "profileProfileImage" => $profileProfileImage,
            "profileFirstName" => html_entity_decode($profileFirstName),
            "profileLastName" => html_entity_decode($profileLastName),
            "createdOn" => $createdOn
        );

        array_push($profile_arr["records"], $profile_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show profiles data in json format
    echo json_encode($profile_arr);
}
else
{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no profiles found
    echo json_encode(
        array("message" => "No profiles found.")
    );
}