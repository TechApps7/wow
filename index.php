<HTML>
    <head>
        <title>MyPHP</title>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <div class="wrapper">
            <?php
            $arr = array("Apple", "Bananas", "Pears", "Peaches");
            sort($arr);
            foreach($arr as $x){
                echo "<div class='box'><span>${x}</span></div>";
            }
            ?>
        </div>
    </body>
</HTML>