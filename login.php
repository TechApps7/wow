<?php
session_start();
if(isset($_SESSION['uid'])){
    header("Location: /home.php");
}
?>
<HTML>
    <head>
        <title>Login</title>
        <link type="text/css" rel="stylesheet" href="styles/main.css">
        <link type="text/css" rel="stylesheet" href="styles/login.css">
    </head>
    <body>
        <div id="header">
            <h1>Log In</h1>
        </div>

        <div id="container">
            <form id="logform" action="dologin.php" method="post">
                <div>
                    <label for="uname">User Name: </label>
                    <input type="text" name="uname" id="uname">
                </div>
                <div>
                    <label for="pass">Password:</label>
                    <input type="password" name="pass" id="pass">
                </div>
                <div>
                    <div class="err">
                        <?php if(isset($_GET['err']) && $_GET['err'] = 'p') echo "Incorrect username or password";?>
                    </div>
                    <input type="submit">
                </div>
            </form>
            <div>
                Don't have an account? <a href="register.php">Make an account</a>
            </div>
        </div>

        <div id="footer">
        </div>
    </body>
</HTML>