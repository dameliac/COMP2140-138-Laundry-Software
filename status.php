<?php
// Retrive the session variables set at login
session_start();

//access database 
$mysqli = new mysqli("localhost", "root", "", "138users");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

//function that reduces the assignment of all users assigned to the machine thats out of service 
function reduceAssignment($failMachine) {
    global $mysqli;
    // get all users assigned to the specified machine
    $usersQuery = $mysqli->prepare("SELECT username FROM dorm WHERE assignments > 0 AND username IN (SELECT user_name FROM reservations WHERE machine = ?)");
    $usersQuery->bind_param("s", $failMachine);

    if ($usersQuery->execute()) {
        $result = $usersQuery->get_result();
        //var_dump($result);
        // Iterate through users and reduce their assignments
        while ($row = $result->fetch_assoc()) {
            $user = $row['username'];
            var_dump($user);
            var_dump($row['username']);
            $NegativeQuery = $mysqli->prepare("UPDATE dorm SET assignments = assignments - 1 WHERE username = ?");
            $NegativeQuery->bind_param("s", $user);
            $NegativeQuery->execute();
        }
    }
}

if (isset($_POST['machine'])){
    $machine = $_POST['machine'];
    $statusQuery = $mysqli->prepare("SELECT machineStatus FROM `machine status` WHERE machineName=?");
    $statusQuery->bind_param("s",$machine);

    if ($statusQuery->execute()){
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
                    reduceAssignment($machine);
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