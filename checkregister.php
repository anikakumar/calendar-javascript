<?php
require 'require.php';

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);


$stmt = $mysqli->prepare("select username from users");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$users = array();
//if(!$stmt){
	//printf("Query Prep Failed: %s\n", $mysqli->error);

	
	//echo json_encode(array(
	//	"success" => false,
	//	"message" => "Incorrect Username or Password"
	//));
//		exit;
//}

$stmt->execute();

$stmt->bind_result($user);
$user = $json_obj['user'];

$temp = 0;
while($stmt->fetch()) {
	$users[$temp] = $user;
	
	$temp = $temp + 1;
}

echo json_encode(array(
    "users" => $users,
    "success" => true,
    "message" => "You were not registered"
));
    
$stmt->close();



?>