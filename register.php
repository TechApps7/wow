<?php
//Setup php
$filledOut = true;

function getFromGet($param){
    if(isset($_GET[$param]) && !empty($_GET[$param]))
        return htmlspecialchars($_GET[$param]);
    else
        return "";
}
function getFromPost($param){
    if(isset($_POST[$param]) && !empty($_POST[$param]))
        return htmlspecialchars($_POST[$param]);
    else
        return "";
}
$fields = array("fname" => "", "lname" => "", "email" => "", "uname" => "", "pass" => "");

foreach($fields as $k => $v){
    $fields[$k] = getFromPost($k);
    if(!$fields[$k])
        $filledOut = false;
}

?>
<HTML>
    <head>
        <title>Create a New Account</title>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
        <link rel="stylesheet" type="text/css" href="styles/register.css">
        <script>
            function confirmPassHandler(evt){
                let pass = document.getElementById("pass");
                let confirm = document.getElementById("confirm");
                let msg = document.getElementById("passErr");
                let button = document.getElementById("submit");

                if(pass.value != confirm.value){
                    msg.innerHTML = "Please make sure passwords match";
                    button.disabled = true;
                }
                else{
                    msg.innerHTML = "";
                    button.disabled = false;
                }
            }
        </script>
    </head>
    <body>
        <div id="header">
            <img src="img/kanye-face.png" id="kleft">
            <img src="img/kanye-face.png" id="kright">
            <h1>Register Your Account</h1>
        </div>
        <div id="container">
            <?php
            if($filledOut){ //Conditional page - If filled out, show confirmation
            ?>

            <h1>Thank you for registering</h1>


            <?php
            }
            else{
            ?>
            <div class="centered">
                <form id="regform" method="post" action="doregister.php">
                    <div>
                        <label for="fname">First Name:</label>
                        <input id="fname" type="text" name="fname" value="<?php echo $fields['fname']; ?>">
                    </div>
                    <div>
                        <label for="lname">Last Name:</label>
                        <input id="lname" type="text" name="lname" value="<?php echo $fields['lname']; ?>">
                    </div>
                    <div>
                        <label for="email">E-Mail:</label>
                        <input id="email" type="email" name="email" value="<?php echo $fields['email']; ?>">
                    </div>
                    <div>
                        <label for="user">Username:</label>
                        <input id="user" maxlength="12" type="text" name="uname" value="<?php echo $fields['uname']; ?>">
                    </div>
                    <div>
                        <label for="pass">Password:</label>
                        <input id="pass" type="password" name="pass">
                    </div>
                    <div>
                        <label for="pass">Confirm Password:</label>
                        <input oninput="confirmPassHandler()" id="confirm" type="password">
                        <div id="passErr" class="err"></div>
                    </div>
                    <div>
                        <input type="submit" id="submit">
                    </div>
                    <div class="err">
                        <?php echo getFromGet('err'); ?>
                    </div>
                    <div class="centered">
                        Already have an accout? <a href="login.php">Log in</a>
                    </div>
                </form>
            </div>


        </div>
        <?php
            }
        ?>
        <div id="footer">

        </div>
    </body>
</HTML>
