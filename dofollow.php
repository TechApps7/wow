<?php
require("utils.php");
session_start();
if($uid = getFromSession('uid')){
    if($uname = getFromPost('uname')){
        $db = new mysqli("localhost", "mason", "lKJ87s75GoqoPrNd", "west");
        $sql = "
    INSERT INTO follow (Follower, Followed)
    SELECT $uid AS FUID, UserId FROM user WHERE UserName=?;";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        if($db->errno){
            $err = $db->error;
            header("Location: /err.php?msg=$err");
        }
        else{
            header("Location: /home.php");
        }
    }
    else{
        
    }
}
else{
    header("Location: /login.php");
}
?>