<?php
require 'require.php';
ini_set("session.cookie_httponly", 1);
session_start();


header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

$user = $_SESSION['user_id'];
$eventID = (float) $json_obj['eventID'];

$iserror = true;

$stmt = $mysqli->prepare("update events set invite = '0' where (event_id like '$eventID' AND share_user like '$user')");
if(!$stmt){
	//printf("Query Prep Failed: %s\n", $mysqli->error);
	//exit;
    $iserror = false;
}


$stmt->bind_param('i', $id);

$stmt->execute();

$stmt->close();

	echo json_encode(array(
		"accepted" => $iserror,
		"success" => true,
		"message" => "Cannot display events"
	));

exit;


?>