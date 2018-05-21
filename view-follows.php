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
        <link rel="stylesheet" type="text/css" href="styles/view-follows.css">
    </head>
    <body>
        <div id="header">
            <img src="img/kanye-face.png" id="kleft">
            <img src="img/kanye-face.png" id="kright">
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
            <div class="centered">
                <div id="feed">
                    <?php
                    foreach($feed as $user){
                        if(getFromSession('uname') != $user['uname']){
                            echo "<div class='card'>";
                            echo "<a class='name' href='view-user.php?uname=${user['uname']}'>${user['uname']}</a>";
                            echo "<a class='uf' href='about:blank'>Unfollow</a>";
                            echo "</div>";
                        }

                    }
                    ?>
                </div>
            </div>

        </div>
        <div id="footer">
        </div>
    </body>
</HTML>