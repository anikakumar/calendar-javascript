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


$stmt = $mysqli->prepare("select user, event_id, event_name, date_month, date_day from events where (share_user like '$username' AND invite like '1')"); 
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$inviters = array();
$names = array();
$ids = array();
$months = array();
$days = array();


$stmt->execute();

$stmt->bind_result($inviter, $id, $name, $month, $day);
$inviter = $json_obj['inviter'];
$id = $json_obj['id'];
$name = $json_obj['name'];
$month = $json_obj['month'];
$day = $json_obj['day'];



$temp = 0;
while($stmt->fetch()) {
    $inviters[$temp] = $inviter;
    $names[$temp] = $name;
    $ids[$temp] = $id;
    $months[$temp] = $month;
    $days[$temp] = $day;
	
	$temp = $temp + 1;
}

$stmt->close();

	echo json_encode(array(
        "inviters" => $inviters,
        "names" => $names,
        "ids" => $ids,
        "months" => $months,
        "days" => $days,
		"success" => true,
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