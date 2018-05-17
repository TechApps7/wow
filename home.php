<?php
require("utils.php");
session_start();
if($uid = getFromSession('uid')){
    $name = getFromSession('uname');
    $offset = getFromGet('offset');
    $offset = $offset ? $offset : '0'; //Should work. Look here if things break :/
    $db = new mysqli("localhost", "mason", "lKJ87s75GoqoPrNd", "west");
    $sql = "SELECT w.WisdomText AS Text, u.UserName AS Name 
    FROM user AS u, wisdom AS w, follow AS f 
    WHERE f.Follower=${uid} AND f.Followed=w.UserId AND w.UserId=u.UserId
    ORDER BY w.WisdomId DESC LIMIT ?,20";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $offset);
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
    header("Location: /login.php");
}
?>

<HTML>
    <head>
        <title>Homepage - West of West</title>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
        <link rel="stylesheet" type="text/css" href="styles/home.css">
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
            <h1>West of West</h1>
        </div>
        <div id="toolbar">
            <p><?php echo "Logged in as $name";?></p>
            <a href="newwis.php">Write Some Wisdom</a>
            <a href="follow.php">Follow a User</a>
            <a href="view-follows.php">View Follows</a>
            <a href="logout.php">Log Out</a>
        </div>
        <div id="container">
            <div class="centered">
                <div id="feed">
                    <div>
                        <?php
                        $o = $offset - 20;
                        if($offset >= 20)
                            echo " <a href='home.php?offset=${o}'><-</a>";
                        
                        $o = $offset + 20;
                        if(count($feed) == 20)
                            echo " <a href='home.php?offset=${o}'>-></a>";
                        ?>
                       
                        <h3>Your feed:  </h3>
                        
                        
                        
                    </div>
                    <?php
                    foreach($feed as $card){
                        echo "<div title='Click to view only this Wisdom' focused='false' onclick='cardClick(this)' class='card'>";
                        echo "<a href='view-user.php?uname=${card['Name']}'>${card['Name']}:</a>";
                        echo "<br>";
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