<?php

function getTyped(mysqli $mysqli, $username){
    $query = $mysqli->prepare("SELECT firstname, lastname, usertype FROM dorm WHERE username = ?");
    if ($query) {
        $query->bind_param("s", $username);
        if ($query->execute()) {
            $query->store_result();
            if ($query->num_rows === 1){
                $query->bind_result($firstname,$lastname,$usertype);
                $query->fetch();
                $typeInformation = ['first'=>$firstname,'last'=>$lastname,'type'=>$usertype];
                $query->close();
                return $typeInformation;
            }
        }
    }
}

?>