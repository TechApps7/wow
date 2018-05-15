<?php
require("utils.php");
session_start();
if($uid = getFromSession('uid')){
    $name = getFromSession('uname');
    $db = new mysqli("localhost", "mason", "lKJ87s75GoqoPrNd", "west");
    if($db->connect_errno){
        $err = $db->connect_error;
        errPage($err);
    }
    else{
        $sql = "SELECT u.UserName AS uname FROM user AS u, follow AS f WHERE f.Follower=${uid} AND f.Followed=u.UserId";
        $result = $db->query($sql);
        
        $feed = array();
        while($tmp = $result->fetch_assoc()){
            $feed[] = $tmp;
        }
    }
}
?>
<HTML>
    <head>
        <title><?php echo $name; ?>'s Follows</title>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
    </head>
    <body>
        <div id="header">
            <h1><?php echo $name; ?>'s Follows</h1>
        </div>
        <div id="toolbar">
            <p><?php echo "Logged in as $name";?></p>
            <a href="home.php">Home</a>
            <a href="newwis.php">Write Some Wisdom</a>
            <a href="follow.php">Follow a User</a>
            <a href="logout.php">Log Out</a>
        </div>
        <div id="container">
            <?php
            foreach($feed as $user){
                echo "<a href='view-user.php?uname=${user['uname']}'>${user['uname']}</a>";
            }
            ?>
        </div>
        <div id="footer">
        </div>
    </body>
</HTML>