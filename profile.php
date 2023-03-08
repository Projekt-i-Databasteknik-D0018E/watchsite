<!DOCTYPE HTML>
<html>
    <head>
        <?PHP
        SESSION_START();
        include 'configuration.php';
        ?>
        <title>Watchsite Profile</title>
        <meta charset="utf-8">
        <link rel = "stylesheet" href = "style.css">
<!--        <script src="script.js"></script>-->
        <meta name= "viewport" content = "width=device-width, initial-scale = 1.0">
        
    </head>
    
    <body>
        <div id = "alles">
            <div id = "loggaHead">
                <div><img src="Logga.png" id="logga" width=100 height=135></div>
                <div id = "loggheadtext"><h2>Watchsite - The site for watches</h2></div>
            </div>
            
            <div id = "dropHead">
                <div class = "dropDown">
                    <a href="index.php">Watches</a>
                </div>
                <div class = "dropDown">
                    <a href="login.html">Login/Sign up</a>
                </div>
                <div class = "dropDown">
                    <a href="">My profile</a>
                </div>
                <div class = "dropDown">
                    <a href="about.html">About Watchsite</a>
                </div>
                <div class = "dropDown">
                    <a href="admin_login.html">Admin tools</a>
                </div>
                <div class = "dropDown">
                    <a href="cart.php">Shopping cart</a>
                </div>            
            </div>
            <?PHP
            $UID = $_SESSION['UID'];
            $profQ = $connection->prepare("SELECT * FROM Customers WHERE CustomerId=?");
	        $profQ->bind_param("i", $UID);
	        $profQ->execute();
            $profQ->store_result();
            $profQ->bind_result($id, $fn, $ln, $un, $pw, $em);
            $profQ->fetch();
            if ($fn == NULL){$fn = "NOT SET";}
            if ($ln == NULL){$ln = "NOT SET";}
            ?>
            <div id = "content">
                <h1>Name:</h1>
                <p style="margin-left: 25px; margin-top: 10px; margin-bottom: 20px;"><?PHP echo "First name: ".$fn.", last name: ".$ln; ?></p>
                <h1>Username:</h1>
                <p style="margin-left: 25px; margin-top: 10px; margin-bottom: 20px;"><?PHP echo "Username: ".$un?></p>
                <h1>Email:</h1>
                <p style="margin-left: 25px; margin-top: 10px; margin-bottom: 20px;"><?PHP echo "Email: ".$em?></p>
                <div id = "watches">
                    <h1 style="margin-top: 80px;">Change Name:</h1>
                    <form action="/name_page.php" method = "post">
                        <div class="container">

                            <label for="CFirstName" style="margin-left: 30px;"><b>First Name</b></label>
                            <input type="text" placeholder="Enter First Name" name="CFirstName" required>

                            <label for="CLastName"><b>Last Name</b></label>
                            <input type="text" placeholder="Enter Last Name" name="CLastName" required style="display: block float:left;">

                            <div class="clearfix" style="margin-left: 0px; display: block; float:right; margin-bottom: 100px;">
                                <button type="submit" class="signupbtn" name="subbttn" style="margin-right: 390px; display: block; float:left;">Change</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        
    </body>
</html>