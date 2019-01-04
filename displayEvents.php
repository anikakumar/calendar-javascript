<?php
ini_set("session.cookie_httponly", 1);
session_start();
require 'require.php';

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

$username = $_SESSION['user_id'];


$stmt = $mysqli->prepare("select * from events where (user like '$username') OR (share_user like '$username' AND invite like '0')"); 
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$name = array();
$ids = array();
$years = array();
$months = array();
$days = array();
$hours = array();
$minutes = array();
$apms = array();
$end_hours = array();
$end_minutes = array();
$end_apms = array();
$tags = array();
$shares = array();
$invites = array();

$stmt->execute();

$stmt->bind_result($user, $share, $invite, $eventID, $year, $eventName, $month, $day, $hour, $minute, $apm, $end_hour, $end_minute, $end_apm, $tag);
$eventName = $json_obj['eventName'];
$eventID = $json_obj['eventID'];
$user = $json_obj['user'];
$year = $json_obj['date_year'];
$month = $json_obj['date_month'];
$day = $json_obj['date_day'];
$hour = $json_obj['time_hour'];
$minute = $json_obj['time_minute'];
$apm = $json_obj['apm'];
$end_hour = $json_obj['end_hour'];
$end_minute = $json_obj['end_minute'];
$end_apm = $json_obj['end_apm'];
$tag = $json_obj['tag'];
$share = $json_obj['share'];
$invite = $json_obj['invite'];



$temp = 0;
while($stmt->fetch()) {
	$name[$temp] = addslashes(htmlentities($eventName));
	$ids[$temp] = $eventID;
	$years[$temp] = $year;
	$months[$temp] = $month;
	$days[$temp] = $day;
	$hours[$temp] = $hour;
	$minutes[$temp] = $minute;
	$apms[$temp] = $apm;
	$end_hours[$temp] = $end_hour;
	$end_minutes[$temp] = $end_minute;
	$end_apms[$temp] = $end_apm;
	$tags[$temp] = addslashes(htmlentities($tag));
	$shares[$temp] = addslashes(htmlentities($share));
	$invites[$temp] = $invite;
	
	$temp = $temp + 1;
}

$stmt->close();

	echo json_encode(array(
		"multiple" => $name,
		"ids" => $ids,
		"years" => $years,
		"months" => $months,
		"days" => $days,
		"hours" => $hours,
		"minutes" => $minutes,
		"apms" => $apms,
		"end_hours" => $end_hours,
		"end_minutes" => $end_minutes,
		"end_apms" => $end_apms,
		"tags" => $tags,
		"shares" => $shares,
		"invites" => $invites,
		"success" => true,
		"eventName" => $eventName,
		"message" => "You were not registered"
	));

//	echo $eventName;
//	echo "<br>";
//}


//while($data = mysql_fetch_array($stm)){
//	$arr[$data['name']] = $data[$eventName];
//}
//
//echo json_encode($arr);

//echo json_encode(array(
//	$eventName
//));






?>