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
    }

}


$machineQuery = $mysqli->prepare("SELECT id, machine, timeslot, day, user_name FROM reservations WHERE machine = ? AND day = ? ORDER BY ABS(TIMESTAMPDIFF(MINUTE, timeslot, ?))");
$currentHourRef = &$currentHour; 
$machineQuery->bind_param("sss", $row["machine"], $currentDay, $currentHourRef);

if ($machineQuery->execute()) {
    $result = $machineQuery->get_result();
    $waitlist = array();
    $nowServing = array();
    while ($rows = $result->fetch_assoc()) {
        $status = ($rows['user_name'] === $user) ? "Now Serving" : "In Waiting";
        $entry = array(
            'ticketNumber' => $rows['id'],
            'name' => $rows['user_name'],
            'machine' => $rows['machine'],
            'status' => $status,
        );

        if ($status === "Now Serving") {
            $nowServing[] = $entry;
        } else {
            $waitlist[] = $entry;
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
    <script src="script.js"></script>
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
                <?php foreach ($nowServing as $entry):?>
                    <tr>
                        <td><?=$entry['ticketNumber']?></td>
                        <td><?=$entry['name']?></td>
                        <td><?=$entry['machine']?></td>
                        <td><?=$entry['status']?></td>
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
                <?php foreach($waitlist as $entry):?>
                    <tr>
                        <td><?=$entry['ticketNumber']?></td>
                        <td><?=$entry['name']?></td>
                        <td><?=$entry['machine']?></td>
                        <td><?=$entry['status']?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
</html>
