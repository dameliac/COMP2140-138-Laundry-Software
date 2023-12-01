<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "138users");



if ($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
}

$reservations = array();
//get current day as a number
$selectedDay = date("w");

//check if data was posted
if (isset($_POST['selectedDay'])) {
    $selectedDay = $_POST['selectedDay'];
}
//assign data that was posted to the handler to variables
if (isset($_POST['timeslot'])){
    $timeslot12 = $_POST['timeslot'];
    $machinery = $_POST['machine']; 
    $timestamp = strtotime($timeslot12);
    $timeslot24 = date('H:i:s',$timestamp);
    
    //get username assigned to selected timeslot from the week and if its null let the person selecting 
    $query = $mysqli->prepare("SELECT user_name FROM reservations WHERE timeslot = ? AND machine = ? AND day = ?");
    $query->bind_param("sss",$timeslot24,$machinery,$selectedDay);

    if ($query->execute()) {
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        $query->close();

        if ($row != null && $row["user_name"] == null){
            $username = $_SESSION['userName'];
            //check the assignment limit of the user and if below limit assign the selected timeslot
            if(checkLimit($username)){
                $updateQuery = $mysqli->prepare("UPDATE reservations SET user_name = ? WHERE machine = ? AND timeslot = ? AND day = ?");
                $updateQuery->bind_param("ssss",$username,$machinery,$timeslot24,$selectedDay);
                
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

//queries the database for the number of timeslots the user has assigned itself to for the week
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