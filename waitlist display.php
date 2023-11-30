<?php
session_start();
$user = $_SESSION['userName'];

$mysqli = new mysqli("localhost", "root", "", "138users");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$currentDay = date('w');
$currentHour = date('H');


$query = $mysqli->prepare("SELECT id, machine, timeslot, user_name FROM reservations WHERE user_name = ? AND day = ?");
$query->bind_param("ss", $user, $currentDay);

if ($query->execute()) {
    $result = $query->get_result();
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $ticketNumber = $row["id"];
    }
    else{
        $ticketNumber = null;
    }

}

$nameQuery = $mysqli->query("SELECT firstname, lastname, username FROM dorm");

if ($nameQuery){
    $usernames = array();

    while ($rower = $nameQuery->fetch_assoc()) {
        $username = $rower['username'];
        $firstname = $rower['firstname'];
        $lastname = $rower['lastname'];
        $usernames[$username] = array('firstname' => $firstname, 'lastname' => $lastname);
    }
}

$machineQuery = $mysqli->prepare("SELECT id, machine, timeslot, day, user_name FROM reservations WHERE machine = ? AND day = ? AND user_name IS NOT NULL");

$machineQuery->bind_param("ss", $row["machine"], $currentDay);

if ($machineQuery->execute()) {
    $result = $machineQuery->get_result();
    $waitlist = array();
    $nowServing = array();
    while ($rows = $result->fetch_assoc()) {
        $status = ($rows['timeslot'] === $currentHour) ? "Now Serving" : "In Waiting";
        $personWaiting = array(
            'ticketNumber' => $rows['id'],
            'name' => $usernames[$rows['user_name']]['firstname'] . " " . $usernames[$rows['user_name']]['lastname'],
            'machine' => $rows['machine'],
            'status' => $status,
        );

        if ($status === "Now Serving") {
            $nowServing[] = $personWaiting;
        } else {
            $waitlist[] = $personWaiting;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waitlist Display</title>
    <link rel="icon" type="image/logo" href="laundry logo.png">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div id="waitlist-container">
        <h1>138 Dormitory Laundry</h1>
        <h2>Queue Display</h2>
        <h3>NOW SERVING</h3>
        <table id="nowserving-table">
            <thead>
                <tr>
                    <th>Ticket #</th>
                    <th>Name</th>
                    <th>Machine </th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="serving">
                <?php foreach ($nowServing as $personWaiting):?>
                    <tr>
                        <td><?=$personWaiting['ticketNumber']?></td>
                        <td><?=$personWaiting['name']?></td>
                        <td><?=$personWaiting['machine']?></td>
                        <td><?=$personWaiting['status']?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
       
        <h3>IN - WAITING</h3>
        <table id="waitlist-table">
            <thead>
                <tr>
                    <th>Ticket #</th>
                    <th>Name</th>
                    <th>Machine</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="Waitlist">
                <?php foreach($waitlist as $personWaiting):?>
                    <tr>
                        <td><?=$personWaiting['ticketNumber']?></td>
                        <td><?=$personWaiting['name']?></td>
                        <td><?=$personWaiting['machine']?></td>
                        <td><?=$personWaiting['status']?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
</html>
