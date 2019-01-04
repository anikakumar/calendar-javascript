<?php
ini_set("session.cookie_httponly", 1);
session_start();
require 'require.php';
// Content of database.php

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);



session_destroy();

echo json_encode(array(
		"success" => true,
		"message" => "You were logged out"
	));

	exit;

?>
