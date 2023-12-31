<?php
session_start();
include_once "RoleManagementData.php";
$mysqli = new mysqli("localhost", "root", "", "138users");


if ($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
}

$username = $_SESSION['userName'];
//get the usertype as well as firstname and lastname of current user

$userInfo = getTyped($mysqli,$username);

$mysqli->close();
?>

<!--based on usertype the menu is loaded with different functions to be used by each user-->
<img src="img\closeButton.png" alt="Close Button" id="close">
<img src="img\profile.svg" alt="profile pic" id="profile">
<p><?=$userInfo['first'] . " " . $userInfo['last']?></p>
<?php if($userInfo['type']=="resident"): ?>
    <div class="sideLinks"><a href="MachineBooking.php">Reservation Schedule</a></div>
    <div class="sideLinks"><a href="WaitlistDisplay.php">Waitlist</a></div>
    <div class="sideLinks"><a href="TicketGenerator.php">Ticket View</a></div>
    <div class="sideLinks"><a href="MaintenanceRequest.php">Maintenance Request</a></div>
    <div class="sideLinks"><a href="BookingCancellation.php">Cancel Reservation</a></div>
<?php elseif($userInfo['type']=="staff"):?>
    <div class="sideLinks"><a href="TicketGenerator.php">Ticket Overview</a></div>
    <div class="sideLinks"><a href="adminM.php">Maintenance Report</a></div>
<?php else:?>
    <div class="sideLinks"><a href="MachineRequest.php">Request Overview</a></div>
    <div class="sideLinks"><a href="MachineStatusUpdate.php">Machine Statuses</a></div>
<?php endif;?>
