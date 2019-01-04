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
$eventName = $json_obj['event_name'];
$eventName = mysql_real_escape_string($eventName);
$year = (float) $json_obj['year'];
$month = (float) $json_obj['month'];
$day = (float) $json_obj['day'];
$hour = (float)$json_obj['hour'];
$minute = (float) $json_obj['minute'];
$apm = (float) $json_obj['apm'];
$end_hour = (float) $json_obj['end_hour'];
$end_minute = (float) $json_obj['end_minute'];
$end_apm = (float) $json_obj['end_apm'];

$tag = $json_obj['tag'];
$tag = mysql_real_escape_string($tag);

$share = $json_obj['share'];
$invite = (float) $json_obj['invite'];

$token = $json_obj['token'];
//
if(!hash_equals($_SESSION['token'], $token)){
	die("Request forgery detected");
}




$stmt = $mysqli->prepare("insert into events (user, share_user, invite, event_name, date_year, date_month, date_day, time_hour, time_minute, apm, end_hour, end_minute, end_apm, tag) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


$stmt->bind_param('ssisiiiiiiiiis', $user, $share, $invite, $eventName, $year, $month, $day, $hour, $minute, $apm, $end_hour, $end_minute, $end_apm, $tag);

$stmt->execute();

$stmt->close();

echo json_encode(array(
	"success" => true,
	"message" => "Cannot display events"
));

exit;


?>