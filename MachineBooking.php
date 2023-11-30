<?php
//get session variables from initial login
session_start();
$mysqli = new mysqli("localhost", "root", "", "138users");


if ($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
}
//set date function to local time
date_default_timezone_set('America/New_York');

$query = $mysqli->prepare("SELECT machine, timeslot, user_name, day FROM reservations WHERE day = ?");

//get current day in 0-6 form where sunday is 0.
$selectedDay = date("w");

if (isset($_POST['selectedDay'])){
    $selectedDay = $_POST['selectedDay'];
}

$query->bind_param("s",$selectedDay);

if ($query->execute()) {
    $result = $query->get_result();
    $reservations = array();
    while ($row = $result->fetch_assoc()) {
        $reservations[$row['machine']][$row['day']][$row['timeslot']] = $row['user_name'];
    }
}
//remove users from timeslots assigned in database
function removeUnavailable($machine, $timeslot, $day) {
    global $mysqli;
    $updateQuery = $mysqli->prepare("UPDATE reservations SET user_name = NULL WHERE machine = ? AND timeslot = ? and day = ?");
    $updateQuery->bind_param("sss", $machine, $timeslot,$day);
    return $updateQuery->execute();
}
//get the machine status of all 10 machines and assigns them to whatever variable is calling it.
function getMachineStatus($machine) {
    global $mysqli;
    $statusQuery = $mysqli->prepare("SELECT machineStatus FROM `machine status` WHERE machineName = ?");
    $statusQuery->bind_param("s", $machine);
    if ($statusQuery->execute()) {
        $statusResult = $statusQuery->get_result();
        $row = $statusResult->fetch_assoc();
        return $row['machineStatus'];
    }
}



?>
<!--Sets Up the days of the week in reservation schedule using an array and checking which day is selected to assign selected class to it-->
<div id="daySelector">
    <?php
        $dayz = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
        foreach($dayz as $index => $day):
            $isSelectable = ($index==$selectedDay); 
    ?>
    <div class="days<?=$isSelectable ? ' selected' : ''?>">
            <?= $day ?>
    </div>
    <?php endforeach;?>
</div>
<!--Sets up the reservation schedule timeslots checking for if a slot is selected from database and if its time is passed and displaying it to the user -->
<div id="gridWork">
<?php for($machine = 1; $machine <= 10; $machine++):?>
    <div class="machine">
        <?php $isAvailable = (getMachineStatus("Machine $machine")==1)?>
        <img src="<?=$isAvailable ? "img\washing.png" : "img\washingred.png"?>" alt="Laundry washing" id="machine">
        <span>Machine <?=$machine;?></span>
    </div>
    <?php for($hour = 8; $hour <= 20; $hour++):?>
        <?php
        $timeslot = sprintf('%02d:00:00', $hour);
        $machineKey = "Machine $machine";
        $isSelected = isset($reservations[$machineKey][$selectedDay][$timeslot]);
        $currentTime = date('H:00:00');
        $isUnavailable = (($timeslot < $currentTime && $selectedDay == date("w")) || ($hour == date('H') && $selectedDay == date("w")) || $selectedDay < date("w") || (getMachineStatus($machineKey)== 0));
        ?>
        <!-- Set selected if userID is set in the database and add class for unavailable timeslots if current time passes it-->
        <div class="timeSlot<?= $isSelected ? ' selected' : '' ?><?= $isUnavailable ? ' unavailable' : '' ?>">
            <?= $hour % 12 ?: 12 ?>:00 <?= $hour < 12 ? 'AM' : 'PM' ?>
        </div>
        <?php

        if ($isUnavailable && $isSelected && $hour != date('H')) {
            removeUnavailable($machineKey, $timeslot,$selectedDay);
        }
        
        ?>
    <?php endfor; ?>
<?php endfor; ?>
</div>
