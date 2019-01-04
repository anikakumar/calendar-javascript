<?php
$mysqli = new mysqli('localhost', 'todd', 'todd_pass', 'module5');

if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>