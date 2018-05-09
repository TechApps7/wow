<?php
session_start();
if(isset($_SESSION['uid'])){
    $db = new mysqli("localhost", "mason", "lKJ87s75GoqoPrNd", "west");
    $result = $db->query("SELECT FirstName FROM user WHERE UserId=${_SESSION['uid']}");
    $name = $result->fetch_assoc()['FirstName'];
}
else{
    header("Location: /login.php");
}
?>

<HTML>
    <head>
        <title>Homepage - West of West</title>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
    </head>
    <body>
        <div id="header">
            <h1>West of West</h1>
            <a href="logout.php">Log Out</a>
        </div>

        <div id="container">
            <h3>
                <?php
                    echo "Welcome ${name}!";
                ?>
            </h3>
        </div>

        <div id="footer">
        </div>
    </body>
</HTML>