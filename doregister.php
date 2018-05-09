<?php
//Setup php
$filledOut = true;

function getFromGet($param){
    if(isset($_GET[$param]) && !empty($_GET[$param]))
        return htmlspecialchars($_GET[$param]);
    else
        return "";
}
function getFromPost($param){
    if(isset($_POST[$param]) && !empty($_POST[$param]))
        return htmlspecialchars($_POST[$param]);
    else
        return "";
}
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
    INSERT INTO user (UserName, FirstName, LastName, Password, Email) 
    VALUES(?, ?, ?, ?, ?);
    ";
        
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssss", $fields['uname'], $fields['fname'], $fields['lname'], $epword, $fields['email']);
        $stmt->execute();

        if($db->errno){
            echo "<h1>Error putting data into table</h1>";
        }
        else{
            header("Location: /confirmation.php");
        }
    }

}
else{
    header("Location: /register.php");
}
?>