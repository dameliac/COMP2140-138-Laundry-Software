<?php

$mysqli = new mysqli("localhost", "root", "", "138users");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['submit'])) {
    $username = isset($_POST['userName']) ? $mysqli->real_escape_string($_POST['userName']) : '';
    $password = $_POST['password'];


    $query = $mysqli->prepare("SELECT password FROM dorm WHERE username = ?");
    //if the query used was valid
    if ($query) {
        //bind the username to the previous query
        $query->bind_param("s", $username);
        //execute the query
        if ($query->execute()) {
            //store results to query variable
            $query->store_result();
            //if number of rows received from the database is 1 then the username is registered to the app
            if ($query->num_rows === 1){
                //bind the result that will be fetched to stored password variable
                $query->bind_result($storedPassword);
                $query->fetch();
                //verify password entered to password stored -_-
                if (password_verify($password,$storedPassword)){
                    session_start();
                    $_SESSION['userName'] = $username; 
                    header("Location: base.html");
                    exit();
                }
                else{
                    session_start();
                    $_SESSION['passwordWrongs'] =  true;
                    header("Location: index.php");
                    exit();
                }
            }
            else{
                session_start();
                $_SESSION['userWrongs'] =  true;
                header("Location: index.php");
                exit();
            }
            
            exit();
        } else {
            echo "Error: " . $query->error;
        }

        $query->close();
    } else {
        echo "Error: " . $mysqli->error;
    }

    $mysqli->close();
}

?>