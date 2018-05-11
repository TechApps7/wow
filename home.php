<?php
require("utils.php");
session_start();
if($uid = getFromSession('uid')){
    $db = new mysqli("localhost", "mason", "lKJ87s75GoqoPrNd", "west");
    $result = $db->query("SELECT FirstName FROM user WHERE UserId=${uid}");
    $name = $result->fetch_assoc()['FirstName'];
    $result = $db->query("SELECT w.WisdomText AS Text FROM wisdom AS w, follow AS f WHERE f.Follower=${uid} AND f.Followed=w.UserId ORDER BY w.WisdomId DESC LIMIT 20");
    if(!$result){
        echo $db->error;
    }
    $feed = array();
    foreach($result->fetch_assoc() as $tmp){
        $feed[] = $tmp;
    }
}
else{
    header("Location: /login.php");
}
?>

<HTML>
    <head>
        <title>Homepage - West of West</title>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
        <link rel="stylesheet" type="text/css" href="styles/home.css">
    </head>
    <body>
        <div id="header">
            <h1>West of West</h1>
        </div>
        <div id="toolbar">
            <a href="logout.php">Log Out</a>
            <a href="newwis.php">Write Some Wisdom</a>
        </div>
        <div id="container">
            <div id="feed" class="centered">
                <h3>Your feed:  </h3>
                <?php
                foreach($feed as $card){
                    echo "<div class='card'>${card}</div>";
                }
                ?>
            </div>
        </div>

        <div id="footer">
        </div>
    </body>
</HTML>