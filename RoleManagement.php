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

<img src="img\closeButton.png" alt="Close Button" id="close">
<img src="img\profile.svg" alt="profile pic" id="profile">
<p><?=$firstname . " " . $lastname?></p>
<?php if($usertype=="resident"): ?>
    <div class="sideLinks"><a href="MachineBooking.php">Reservation Schedule</a></div>
    <div class="sideLinks"><a href="WaitlistDisplay.php">Waitlist</a></div>
    <div class="sideLinks"><a href="TicketGenerator.php">Ticket View</a></div>
    <div class="sideLinks"><a href="MaintenanceRequest.php">Maintenance Request</a></div>
    <div class="sideLinks"><a href="BookingCancellation.php">Cancel Reservation</a></div>
<?php elseif($usertype=="staff"):?>
    <div class="sideLinks"><a href="TicketGenerator.php">Ticket Overview</a></div>
    <div class="sideLinks"><a href="adminM.php">Maintenance Report</a></div>
<?php else:?>
    <div class="sideLinks"><a href="MachineRequest.php">Request Overview</a></div>
    <div class="sideLinks"><a href="MachineStatusUpdate.php">Machine Statuses</a></div>
<?php endif;?>
