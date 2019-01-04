<?php
ini_set("session.cookie_httponly", 1);
session_start();
require 'require.php';

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);


// $username = $_POST['username'];
$username = $json_obj['username'];
$username = mysql_real_escape_string($username);
$password = password_hash($json_obj['password'], PASSWORD_BCRYPT);


$stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");

$error = "success";
if(!$stmt){
	//printf("Query Prep Failed: %s\n", $mysqli->error);

	
	//echo json_encode(array(
	//	"success" => false,
	//	"message" => "Incorrect Username or Password"
	//));
	$error = "fail";
	exit;
}

$stmt->bind_param('ss', $username, $password);

$stmt->execute();

$stmt->close();

$_SESSION['user_id'] = $username;
$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));

	echo json_encode(array(
		"success" => $error,
		"token" => $_SESSION['token'],
		"message" => "You were not registered"
	));

exit;


?>