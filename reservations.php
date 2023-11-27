<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "138users");


if ($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
}

date_default_timezone_set('America/New_York');

$query = $mysqli->prepare("SELECT machine, timeslot, user_name, day FROM reservations WHERE day = ?");

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

function removeUnavailable($machine, $timeslot, $day) {
    global $mysqli;
    $updateQuery = $mysqli->prepare("UPDATE reservations SET user_name = NULL WHERE machine = ? AND timeslot = ? and day = ?");
    $updateQuery->bind_param("sss", $machine, $timeslot,$day);
    return $updateQuery->execute();
}

?>

<div id="daySelector">
    <?php
        $daysofweek = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
        foreach($daysofweek as $index => $day):
            $isSelectable = ($index==$selectedDay); 
    ?>
    <div class="days<?=$isSelectable ? ' selected' : ''?>">
            <?= $day ?>
    </div>
    <?php endforeach;?>
</div>

<div id="gridWork">
<?php for($machine = 1; $machine <= 10; $machine++):?>
    <div class="machine">
        <img src="washing.png" alt="Laundry washing" id="machine">
        <span>Machine <?=$machine;?></span>
    </div>
    <?php for($hour = 8; $hour <= 20; $hour++):?>
        <?php
        $timeslot = sprintf('%02d:00:00', $hour);
        $machineKey = "Machine $machine";
        $isSelected = isset($reservations[$machineKey][$selectedDay][$timeslot]);
        $currentTime = date('H:00:00');
        $isUnavailable = (($timeslot < $currentTime && $selectedDay == date("w")) || ($hour == date('H') && $selectedDay == date("w")) || $selectedDay < date("w"));
        ?>
        <!-- Set selected if userID is set in the database and add class for unavailable timeslots if current time passes it-->
        <div class="timeSlot<?= $isSelected ? ' selected' : '' ?><?= $isUnavailable ? ' unavailable' : '' ?>">
            <?= $hour % 12 ?: 12 ?>:00 <?= $hour < 12 ? 'AM' : 'PM' ?>
        </div>
        <?php

        if ($isUnavailable && $isSelected) {
            removeUnavailable($machineKey, $timeslot,$selectedDay);
        }
        
        ?>
    <?php endfor; ?>
<?php endfor; ?>
</div>
