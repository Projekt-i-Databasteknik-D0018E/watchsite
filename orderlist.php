<!DOCTYPE HTML>
<?PHP
session_start();
include "configuration.php";
?>
<html>
    <head>
        
        <title>Watchsite Customer Order List</title>
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
                    <a href="cart.php">Shopping cart</a>
                </div>  
                <div class = "dropDown">
                    <a href="">Previous Orders</a>
                </div>                 
            </div>
            
            <div id = "content">
               <h1>Your previous orders:</h1>  
                <?php   
                        $UID = $_SESSION['UID'];
                        $orderItems = $connection->prepare("SELECT * FROM Orders WHERE CId=?");
                        $orderItems->bind_param("i", $UID);
                        $orderItems->execute();
                        $orderItems->store_result();
                        $orderItems->bind_result($ONR, $CID, $PID, $Batch, $Adress, $Name, $PricePaid, $AMT);
                        
                        while($orderItems->fetch()){
                            $the_query_is_correct = "SELECT * FROM Products WHERE ProductId = ?";
                            $stmt = $connection->prepare($the_query_is_correct);
                            $stmt->bind_param("i", $PID);
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($ProductId, $ProductDescription, $Stock, $Image, $ProductName, $Price, $IsVisible, $Grade, $Gradees);
                            $stmt->fetch();    
                            $hreflink = "product.php?ProductId=".$ProductId;
                            ?>
                            <div id ="watches">
                                <div class = "watch">
                                    <p style="font-size: 15px;"><h2><a href=<?php printf($hreflink);?>><?php echo $ProductName.":".$AMT;?></a></h2> 
                                    total: <?PHP echo $AMT*$PricePaid; ?> €
                                    <h3>Belongs to order: <?PHP echo $Batch ?> </h3>
                                    <h3>Delivered to: <?PHP echo $Name ?> </h3>
                                    <h3>Delivery adress: <?PHP echo $Adress ?> </h3>
                                    <img src="<?php printf("%s", $Image);?>" class = "watchimg">
                                </div>
                            </div>      
                            <?php
                        }?>
                <!-- <div id = "cartDiv">
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
                </div> -->
                
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