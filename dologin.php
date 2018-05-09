<?php
function getFromPost($param){
    if(isset($_POST[$param]) && !empty($_POST[$param]))
        return htmlspecialchars($_POST[$param]);
    else
        return "";
}
$fields = array("uname" => "", "pass" => "");
$filledOut = true;
foreach($fields as $k => $v){
    $fields[$k] = getFromPost($k);
    if(!$fields[$k])
        $filledOut = false;
}
if($filledOut){
    $db = new mysqli("localhost", "mason", "lKJ87s75GoqoPrNd", "west");
    if($db->connect_errno){
        echo "<h1>Could not connect</h1>";
    }
    else{
        $sql = "SELECT Password, UserId FROM user WHERE UserName=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $fields['uname']);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if(isset($result['Password']) && password_verify($fields['pass'], $result['Password'])){
            session_start();
            $_SESSION['uid'] = $result['UserId'];
            header("Location: /home.php");
        }
        else{
            if(!isset($result["Password"]))
                $c="s";
            else
                $c="p";
            header("Location: /login.php?err=p&cause=$c");
        }
    }
}
?>