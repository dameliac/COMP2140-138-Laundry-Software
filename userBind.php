<?php

session_start();
$mysqli = new mysqli("localhost", "root", "", "138users");


if ($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
}

$username = $_SESSION['userName'];

$query = $mysqli->prepare("SELECT firstname, lastname, usertype FROM dorm WHERE username = ?");
if ($query) {
    $query->bind_param("s", $username);
    if ($query->execute()) {
        $query->store_result();
        if ($query->num_rows === 1){
            $query->bind_result($firstname,$lastname,$usertype);
            $query->fetch();
        }
    }
}
$mysqli->close();
?>

<img src="closeButton.png" alt="Close Button" id="close">
<img src="profile.svg" alt="profile pic" id="profile">
<p><?=$firstname . " " . $lastname?></p>
<?php if($usertype=="resident"): ?>
    <div class="sideLinks"><a href="base.html">Reservation Schedule</a></div>
    <div class="sideLinks"><a href="waitlist.html">Waitlist</a></div>
    <div class="sideLinks"><a href="ticket.html">Ticket View</a></div>
    <div class="sideLinks"><a href="maintenance.html">Maintenance Request</a></div>
    <div class="sideLinks"><a href="bookingcancellation.php">Cancel Reservation</a></div>
<?php elseif($usertype=="staff"):?>
    <div class="sideLinks"><a href="inventory.html">Inventory Management</a></div>
    <div class="sideLinks"><a href="adminM.php">Maintenance Report</a></div>
    <div class="sideLinks"><a href="ticket.html">Ticket Overview</a></div>
<?php else:?>
    <div class="sideLinks"><a href="Request.html">Request Overview</a></div>
    <div class="sideLinks"><a href="machineStatus.php">Machine Statuses</a></div>
<?php endif;?>
