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

// Use a prepared statement
$stmt = $mysqli->prepare("SELECT COUNT(*), username, password FROM users WHERE username=?");

// Bind the parameter
$stmt->bind_param('s', $user);
// $user = $_POST['username'];
$user = $json_obj['username'];
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $user_id, $pwd_hash);
$stmt->fetch();

//$pwd_guess = $_POST['password'];
$pwd_guess = $json_obj['password'];
// Compare the submitted password to the actual password hash

if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
	// Login succeeded!
    
	$_SESSION['user_id'] = $user_id;
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
	echo json_encode(array(
		"success" => true,
		"token" => $_SESSION['token']
	));
    //header("Location: main.php");
    exit;
	// Redirect to your target page
} else{
    // header("Location: homepage.html");
	echo json_encode(array(
		"success" => false,
		"message" => "Incorrect Username or Password"
	));
    exit;
	// Login failed; redirect back to the login screen
}

?>