<?php
function getFromSession($par){
    if(isset($_SESSION[$par]))
        return $_SESSION[$par];
    else
        return "";
}
function getFromPost($param){
    if(isset($_POST[$param]) && !empty($_POST[$param]))
        return htmlspecialchars($_POST[$param]);
    else
        return "";
}
function getFromGet($param){
    if(isset($_GET[$param]) && !empty($_GET[$param]))
        return htmlspecialchars($_GET[$param]);
    else
        return "";
}
function errPage($err){
    header("Location: /err.php?msg=$err");
}
?>

