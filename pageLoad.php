<?php
ini_set("session.cookie_httponly", 1);
session_start();
require 'require.php';
// Content of database.php

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json


//if(isset($_SESSION['user_id']) && isset($_SESSION['token'])){
if(isset($_SESSION['user_id'])){
    echo json_encode(array(
		"success" => true,
        "token" => $_SESSION['token'],
        "id" => $_SESSION['user_id'],
		"message" => "same user"
	));
} else {
    echo json_encode(array(
		"success" => false,
		"message" => "failure"
	));
}

?>
