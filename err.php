<?php
    require("utils.php");
?>
<HTML>
    <head>
        <title>OOPSIE WOOPSIE</title>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
    </head>
    <body>
        <div id="header">
            <h1>ERROR</h1>
        </div>
        
        <div id="container">
            <h3>oopsie whoopsie! uwu we made a fucky wucky!!1 a wittle fucko boingo! the code monkies at our headquarters are working VEWY HAWD to fix this!</h3>
            <div id="errbox">
                <?php 
                echo getFromGet("msg");
                ?>
            </div>
        </div>
        
        <div id="footer">
        </div>
    </body>
</HTML>