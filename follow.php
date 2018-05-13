<?php
require("utils.php");
session_start();
$name = getFromSession('uname');
?>
<HTML>
    <head>
        <title>Follow Another User</title>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
    </head>
    <body>
    <div id="header">
            <h1>West of West</h1>
        </div>
        <div id="toolbar">
            <p><?php echo "Logged in as $name";?></p>
            <a href="logout.php">Log Out</a>
            <a href="newwis.php">Write Some Wisdom</a>

        </div>
        <div id="container">
            <div class="centered">
                <label for="uname">User's Username:</label>
                <form action="dofollow.php" method="post" id="follow-form">
                    <input type="text" maxlength="255" id="uname" name="uname">
                </form>
                <button value="Submit" form="follow-form">Follow</button>
            </div>
        </div>

        <div id="footer">
        </div>
    </body>
</HTML>