<?php
session_start();
$user = $_SESSION['userName'];

$mysqli = new mysqli("localhost", "root", "", "138users");


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query = mysql->prepare("SELECT id, machine, day FROM reservations WHERE user_name=?");

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
            <tbody id="serving"></tbody>
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
            <tbody id="Waitlist"></tbody>
        </table>

    </div>

   
</body>
</html>