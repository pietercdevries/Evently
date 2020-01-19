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

// query comments
$stmt = $comment->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0)
{
    // comments array
    $comment_arr=array();
    $comment_arr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $comment_item=array(
            "commentId" => commentId,
            "friendId" => $friendId,
            "message" => html_entity_decode($message),
            "createdOn" => $createdOn,
            "eventId" => $eventId
        );

        array_push($comment_arr["records"], $comment_item);
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