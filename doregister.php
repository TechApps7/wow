<?php

//Setup php
require("utils.php");
$filledOut = true;

$fields = array("fname" => "", "lname" => "", "email" => "", "uname" => "", "pass" => "");

foreach($fields as $k => $v){
    $fields[$k] = getFromPost($k);
    if(!$fields[$k])
        $filledOut = false;
}
if($filledOut){
    $epword = password_hash($fields['pass'], PASSWORD_DEFAULT);
    $db = new mysqli("localhost", "mason", "lKJ87s75GoqoPrNd", "west");
    if($db->connect_errno){
        echo "<h1>Could not connect</h1>";
    }
    else{
        $sql ="
    INSERT IGNORE INTO user (UserName, FirstName, LastName, Password, Email) 
    VALUES(?, ?, ?, ?, ?);
    ";
        
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssss", $fields['uname'], $fields['fname'], $fields['lname'], $epword, $fields['email']);
        $stmt->execute();

        if($db->errno){
            $err = $db->error;
            header("Location: /err.php?msg=${err}");
        }
        else{
            $sql = "
            INSERT INTO follow (Follower, Followed)
            SELECT UserId, UserId FROM user WHERE UserName=?;
            ";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $fields['uname']);
            $stmt->execute();
            if($db->errno){
                $err = $db->error;
                header("Location: /err.php?msg=${err}");
            }
            else{
                header("Location: /confirmation.php");
            }
           
        }
    }

}
else{
    header("Location: /register.php");
}
?>