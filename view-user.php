<?php
require("utils.php");

session_start();
$name = getFromSession('uname');

if($name){
    $uid = getFromSession('uid');
    $offset = getFromGet('offset');
    $offset = $offset ? $offset : '0'; //Should work. Look here if things break :/
    $uname = getFromGet("uname");
    
    $db = new mysqli("localhost", "mason", "lKJ87s75GoqoPrNd", "west");
    $sql = "SELECT w.WisdomText AS Text, u.UserName AS Name 
    FROM user AS u, wisdom AS w
    WHERE u.UserName=? AND w.UserId=u.UserId
    ORDER BY w.WisdomId DESC LIMIT ?,20";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("si", $uname, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if(!$result){
        $err = $db->error;
        header("Location: /err.php?msg=$err");
    }
    
    $feed = array();
    while($tmp = $result->fetch_assoc()){
        $feed[] = $tmp;
    }
    
}
else{
    $name = "NOT LOGGED IN";
}

?>
<HTML>
    <head>
        <title><?php echo $uname; ?>'s Wisdom</title>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
        <link rel="stylesheet" type="text/css" href="styles/view-user.css">
        <script>
            function cardClick(target){
                let cards = document.getElementsByClassName("card");
                const state = target.getAttribute('focused') === 'true';
                
                target.setAttribute('focused', String(!state));
                
                for(let i = 0; i < cards.length; i++){
                    if(cards[i] != target){
                        let disp = !state ? 'none' : 'flex';
                        cards[i].style.display = disp;
                        console.log("Not target! this: "+cards[i]);   
                    }
                }
             console.log("Clicked! target: "+target);   
            }
        </script>
    </head>
    <body>
        <div id="header">
            <?php echo $uname; ?>'s Wisdom
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
                    foreach($feed as $card){
                        echo "<div focused='false' onclick='cardClick(this)' class='card'>";
                        echo "<a href='view-user.php?uname=${card['Name']}'>${card['Name']}:</a>";
                        echo "<p>${card['Text']}</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div id="footer">
        </div>
    </body>
</HTML>