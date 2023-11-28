<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "138users");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['machine'])){
    $machine = $_POST['machine'];
    $statusQuery = $mysqli->prepare("SELECT machineStatus FROM `machine status` WHERE machineName=?");
    $statusQuery->bind_param("s",$machine);

    if ($statusQuery->execute()){
        var_dump($machine);
        $result = $statusQuery->get_result();
        $row = $result->fetch_assoc();
        $status = $row["machineStatus"];

        if ($status==0){
            $updateStatus = 1;
            $updateQuery = $mysqli->prepare("UPDATE `machine status` SET machineStatus = ? WHERE machineName = ?");
            $updateQuery->bind_param("ss", $updateStatus, $machine);
            if ($updateQuery->execute()){
                echo "green";
            }
            else{
                echo "fail";
            }
            }
            else{
                $updateStatus = 0;
                $updateQuery = $mysqli->prepare("UPDATE `machine status` SET machineStatus = ? WHERE machineName = ?");
                $updateQuery->bind_param("ss", $updateStatus, $machine);
                if ($updateQuery->execute()) {
                    echo "red";
                }
                else echo "fail";
            } 
    } else {
        echo "Failed to update machine status.";
    }

    $updateQuery->close();
} else {
    echo "Invalid request.";
}

$mysqli->close();
?>