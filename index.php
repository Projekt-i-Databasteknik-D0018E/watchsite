<!DOCTYPE HTML>
<html>
    <head>
        <?php session_start(); ?>
        <?php include("configuration.php"); ?>
        <title>Watchsite, the best watch-buying site</title>
        <meta charset="utf-8">
        <link rel = "stylesheet" href = "style.css">
        <link rel="SHORTCUT ICON" href="favicon.ico" type="image/ico" />
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
                    <a href="">Watches</a>
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
                    <?php
                    if($_SESSION['Privilege'] == "Admin"){
                    ?>
                        <a href="admin.html">Admin tools</a>

                    <?php
                    } else {
                    ?>
                        <a href="admin_login.html">Admin login</a>
                    <?php                       
                    }
                    ?>
                </div>
                <div class = "dropDown">
                    <a href="cart.php">Shopping cart</a>
                </div>            
            </div>
            
            <div id = "content">
               <h1>Buy one of our many watches now and "watch" out for our next sale!</h1>
                <div id ="watches">
                    <?php 
                        $sql = "SELECT COUNT(*) FROM Products";

                        $result = mysqli_query($connection, "SELECT * FROM Products");
                        $item = mysqli_num_rows($result);

                    //  $item = mysqli_fetch_row($result)[0];
                        while($item > 0){
                            $sql_message = "SELECT ProductName, Image, ProductDescription, IsVisible FROM Products WHERE ProductId= ?";
                            $stmt = $connection->prepare($sql_message);
                            $stmt->bind_param("i", $item);
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($message, $imglink, $imgalt, $visible);
                            $stmt->fetch();

                          //$data  = [
                          //    "message"=> $message,
                          //    "imglink"=> $img_link,
                          //    "imgalt"=> $imgalt];
                            if($visible){?>
                                <?PHP
                                $hreflink = "product.php?ProductId=".$item;
                                ?>
                                <div class = "watch">
                                    <h2><a href=<?php printf($hreflink);?>><?php echo $message;?></a></h2>
                                    <img src="<?php printf("%s", $imglink);?>" alt="<?php echo $imgalt;?>" class="watchimg">
                                </div>
                            <?php
                            }
                            $item = $item-1;
                        }?>
                    
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