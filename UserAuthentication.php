<?php

$mysqli = new mysqli("localhost", "root", "", "138users");

require 'UserAuthenticationData.php'; 



if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['submit'])) {
    $username = isset($_POST['userName']) ? $mysqli->real_escape_string($_POST['userName']) : '';
    $password = $_POST['password'];

    $storedPassword = getUserInfo($mysqli,$username);
    if (password_verify($password,$storedPassword)){
        session_start();
        $_SESSION['userName'] = $username; 
        header("Location: base.html");
        exit();
    }
    else if($storedPassword.include("userWrongs")){
        session_start();
        $_SESSION['userWrongs'] =  true;
        header("Location: index.php");
        exit();
    }
    else{
        session_start();
        $_SESSION['passwordWrongs'] =  true;
        header("Location: index.php");
        exit();
    }
    $mysqli->close();
}

?>