<HTML>
    <head>
        <title>Write Your Wisdom</title>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
    </head>
    <body>
        <div id="header">
            <h1>Write Some Wisdom</h1>
        </div>
        <div id="toolbar">
            <a href="home.php">Home</a>
        </div>
        <div id="container">
            <div class="centered">
                <form id="wisdom-form" method="post" action="dowisdom.php">
                    <textarea maxlength="255" rows="10" cols="30" placeholder="Write your wisdom here..." name="wisdom"></textarea>
                </form>
            </div>
            
            <div class="centered">
                <button id="submit" form="form" value="Submit">Submit</button>
            </div>
        </div>

        <div id="footer">

        </div>
    </body>
</HTML>