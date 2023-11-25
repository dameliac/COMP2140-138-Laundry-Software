<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "138users");



if ($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
}

$reservations = array();
if (isset($_POST['timeslot'])){
    $timeslot12 = $_POST['timeslot'];
    $machinery = $_POST['machine']; 
    $timestamp = strtotime($timeslot12);
    $timeslot24 = date('H:i:s',$timestamp);
    
    
    $query = $mysqli->prepare("SELECT user_name FROM reservations WHERE timeslot = ? AND machine = ?");
    $query->bind_param("ss",$timeslot24,$machinery);
    if ($query->execute()) {
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        $query->close();
        if ($row != null && $row["user_name"] == null){
            $username = $_SESSION['userName'];
            if(checkLimit($username)){
                $updateQuery = $mysqli->prepare("UPDATE reservations SET user_name = ? WHERE machine = ? AND timeslot = ?");
                $updateQuery->bind_param("sss",$username,$machinery,$timeslot24);
                
                if ($updateQuery->execute()){
                    echo "success";
                }
                else{
                    echo "failure";
                }
                $updateQuery->close();
            }
            else{
                echo "limited";
            }
        }
        else{
            echo "unavailable";
        }
    }
}


function checkLimit($user){
    global $mysqli;
    $limitQuery = $mysqli->prepare("SELECT assignments FROM dorm WHERE username=?");
    if ($limitQuery->bind_param("s",$user)){
        if ($limitQuery->execute()){
            $results = $limitQuery->get_result();
            $rows = $results->fetch_assoc();
            if($rows["assignments"] < 2){

                $updateLimitQuery = $mysqli->prepare("UPDATE dorm SET assignments = assignments + 1 WHERE username=?");
                if ($updateLimitQuery->bind_param("s", $user)) {
                    if ($updateLimitQuery->execute()) {
                        $limitQuery->close();
                        $updateLimitQuery->close();
                        return true;
                    }
                }
            }
            else{
                return false;
            }
        }
    }    
}
$mysqli->close();
?>