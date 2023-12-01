<?php
    function getUserInfo(mysqli $mysqli, $username){
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
                    //bind the result that will be fetched to stored password variable -_-
                    $query->bind_result($storedPassword);
                    $query->fetch();
                    $query->close();
                    return $storedPassword;
                }
                else{
                    return "userWrongs";
                }
                
            }
        }
        return false;
    }
?>