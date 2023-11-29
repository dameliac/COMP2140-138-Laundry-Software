<?php
session_start();
$user = $_SESSION['userName'];
$mysqli = new mysqli("localhost", "root", "", "138users");
$daysOfWeek = [
    "Sunday"=> 0,
    "Monday"=> 1,
    "Tuesday"=> 2,
    "Wednesday"=> 3,
    "Thursday"=> 4,
    "Friday"=> 5,
    "Saturday"=> 6
];
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$time = $_POST['time'];
$machine = $_POST['machine'];
$day = $_POST['day'];
$updateQuery = $mysqli->prepare("UPDATE reservations SET user_name=null WHERE machine=? AND day= ? AND timeslot=?");
$updateQuery->bind_param("sss", $machine, $daysOfWeek[$day], $time);

if ($updateQuery->execute()) {

    $mysqli->query("UPDATE dorm SET assignments = assignments - 1 WHERE username = '$user'");
    echo "success";
}
else{
    echo "failure";
}
?>