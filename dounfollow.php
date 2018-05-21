<?php
require("utils.php");
session_start();
if($uid = getFromSession('uid')){
    $oid = getFromGet('uname');
    $sql = "DELETE FROM follow WHERE follower=$uid AND followed=$oid";
    $db = new mysqli("localhost", "mason", "lKJ87s75GoqoPrNd", "west");
    $db->query($sql);
    if($db->errno){
        $err = htmlspecialchars($db->err);
        header("Location: /err.php?msg=$err");
    }
}
?>