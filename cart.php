<!DOCTYPE HTML>
<?PHP
session_start();
include "configuration.php";
?>
<html>
    <head>
        
        <title>Watchsite Shopping Cart</title>
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
                    <a href="profile.php">My profile</a>
                </div>
                <div class = "dropDown">
                    <a href="about.html">About Watchsite</a>
                </div>
                <div class = "dropDown">
                    <a href="admin_login.html">Admin tools</a>
                </div>
                <div class = "dropDown">
                    <a href="">Shopping cart</a>
                </div>            
            </div>
            
            <div id = "content">
               <h1>Your shopping cart currently contains:</h1>  
                <?php   
                        $UID = $_SESSION['UID'];
                        $TOTALPRICE = 0;
                        $cartItems = $connection->prepare("SELECT * FROM Cart WHERE CartCID = ?");
                        $cartItems->bind_param("i", $UID);
                        $cartItems->execute();
                        $cartItems->store_result();
                        $cartItems->bind_result($ItemID, $CartCID, $CartPID, $Amount);
                        
                        while($cartItems->fetch()){
                            $the_query_is_correct = "SELECT * FROM Products WHERE ProductId = ?";
                            $stmt = $connection->prepare($the_query_is_correct);
                            $stmt->bind_param("i", $CartPID);
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($ProductId, $ProductDescription, $Stock, $Image, $ProductName, $Price, $IsVisible, $Grade, $Gradees);
                            $stmt->fetch();
                            $TOTALPRICE += $Price*$Amount;    
                            $hreflink = "product.php?ProductId=".$ProductId;
                            ?>
                            <div id ="watches">
                                <div class = "watch">
                                    <p style="font-size: 15px;"><h2><a href=<?php printf($hreflink);?>><?php echo $ProductName." x ".$Amount;?></a></h2> 
                                    <?PHP echo $Amount*$Price; ?> €</p>
                                    <img src="<?php printf("%s", $Image);?>" class = "watchimg">
                                </div>
                            </div>      
                            <?php
                        }?>
                <div id = "cartDiv">
                <h1>Total cost: <?PHP echo $TOTALPRICE;?> €</h1>
                <h1>Purchase items in cart:</h1>
                <div id = "cartBuyDiv">   
                    <form action="/purchase.php" method = "post">
                        <div class="container">

                            <label for="DeliveryAdress"><b>Adress:</b></label>
                            <input type="text" placeholder="Enter adress" name="DeliveryAdress" required>
                            <label for="DeliveryName"><b><br>Name:</b></label>
                            <input type="text" placeholder="Enter name" name="DeliveryName" required>
                            <input type="hidden" value=<?PHP echo $UID;?> name="UID">
                            <div class="clearfix">
                                <button type="submit" class="signupbtn" name="subbttn" style="margin-left: 95px;">Purchase</button>
                            </div>
                        </div>
                    </form>
                    <form action="/clear_cart.php" method = "post">
                                <div class="clearfix" style="float:left;">
                                    <input type="hidden" value=<?PHP echo $UID;?> name="UID">
                                    <button type="submit" class="signupbtn" name="subbttn" style="margin-left: 95px;">Clear cart</button>
                                </div>
                    </form>
                </div>
                </div>
                
            </div>
            
            <div id = "bigFoot">
                All complaints about this site will remain unadressed
            </div>
            
            <div id = "datum">
                    <p>Last published 8/3 2023 | A site made for a course in databases (D0018E) by Amanda Lorné, Helge Lindgren and Axel Johansson, Luleå University of Technology</p>
            
            </div>
        </div>
        
    </body>
</html>