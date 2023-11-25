<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "138users");


if ($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
}

$query = $mysqli->prepare("SELECT machine, timeslot, user_name FROM reservations");


if ($query->execute()) {
    $result = $query->get_result();
    $reservations = array();
    while ($row = $result->fetch_assoc()) {
        $reservations[$row['machine']][$row['timeslot']] = $row['user_name'];
    }
}


?>

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
        $isSelected = isset($reservations[$machineKey][$timeslot]);
        ?>
        <!--Set selected if userID is set in database and convert 24 hour time to 12 hour -->
        <div class="timeSlot<?=$isSelected ? ' selected' : ''?>">
            <?=$hour % 12 ?: 12?>:00 <?=$hour < 12 ? 'AM' : 'PM'?>
        </div>
    <?php endfor; ?>
<?php endfor; ?>
</div>