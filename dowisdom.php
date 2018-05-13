<?php
require("utils.php");
session_start();
if($uid = getFromSession('uid')){ //ASSIGNMENT NOT COMPARISON!!
    $wisdom = getFromPost('wisdom');
    $db = new mysqli("localhost", "mason", "lKJ87s75GoqoPrNd", "west");
    $sql = "INSERT INTO wisdom (WisdomText, UserId) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("si", $wisdom, $uid);
    $stmt->execute();
    if($db->errno){
        $err = $db->error;
        header("Location: /err.php?msg=${err}");
    }
    else{
        header("Location: /home.php");
    }
}
else{
    header("Location: /login.php");
}
?>