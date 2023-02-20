<!DOCTYPE HTML>
<html>
    <head>
        
        <title>Watchsite, the best watch-buying site</title>
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
                    <a href="">Watches</a>
                </div>
                <div class = "dropDown">
                    <a href="login.html">Login/Sign up</a>
                </div>
                <div class = "dropDown">
                    <a href="profile.html">My profile</a>
                </div>
                <div class = "dropDown">
                    <a href="about.html">About Watchsite</a>
                </div>
                <div class = "dropDown">
                    <a href="admin_login.html">Admin tools</a>
                </div>
                <div class = "dropDown">
                    <a href="cart.html">Shopping cart</a>
                </div>            
            </div>
            
            <div id = "content">
               <h1>Buy one of our many watches now and "watch" out for our next sale!</h1>
                <div id ="watches">
                    <div class = "watch">
                        <h2><a href="product.html">Watch</a></h2>
                        <img src="defaultWatch.jpg" class = "watchimg">
                    </div>
                    <div class = "watch">
                        <h2><a href="product.html">Watch</a></h2>
                        <img src="defaultWatch.jpg" class = "watchimg">
                    </div>
                    <div class = "watch">
                        <h2><a href="product.html">Watch</a></h2>
                        <img src="defaultWatch.jpg" class = "watchimg">
                    </div>
                    <div class = "watch">
                        <h2><a href="product.html">Watch</a></h2>
                        <img src="defaultWatch.jpg" class = "watchimg">
                    </div>
                    <div class = "watch">
                        <h2><a href="product.html">Watch</a></h2>
                        <img src="defaultWatch.jpg" class = "watchimg">
                    </div>
                    <div class = "watch">
                        <h2><a href="product.html">Watch</a></h2>
                        <img src="defaultWatch.jpg" class = "watchimg">
                    </div>
                    <div class = "watch">
                        <h2><a href="product.html">Watch</a></h2>
                        <img src="defaultWatch.jpg" class = "watchimg">
                    </div>
                    <div class = "watch">
                        <h2><a href="product.html">Watch</a></h2>
                        <img src="defaultWatch.jpg" class = "watchimg">
                    </div>
                    <div class = "watch">
                        <h2><a href="product.html">Watch</a></h2>
                        <img src="defaultWatch.jpg" class = "watchimg">
                    </div>
                    <?php 
                        $sql = "SELECT COUNT(*) FROM Products";
                        $item = mysqli_query($connection, $sql);
                    //  $item = mysqli_fetch_row($result)[0];
                        $sql_message = "SELECT ProductName FROM Products WHERE ProductId= $item";
                        $sql_imglink = "SELECT Image FROM Products WHERE ProductId = $item";
                        $sql_imgalt = "SELECT ProductDescription FROM Products WHERE ProductId = $item";
                        $sql_visible = "SELECT IsVisible FROM Products  WHERE ProductId = $item";
                        while ($item >= 0){
                            $data  = [
                                "message"=> mysqli_query($connection, $sql_message),
                                "imglink"=> mysqli_query($connection, $sql_imglink),
                                "imgalt"=> mysqli_query($connection, $sql_imgalt)];
                            $visible = mysqli_query($connection, $sql_visible);
                            if($visible == 1){?>
                                <div class = "watch"> 
                                    <h2><a href=""><?php echo $data["message"];?></h2>
                                    <img src="<?php echo $data["imglink"]?>" alt="<?php echo $data["imgalt"]?>">
                                </div>
                            <?php
                            }
                        $item = $item - 1;
                        }?>
                </div>
            </div>
            
            <div id = "bigFoot">
                All complaints about this site will remain unadressed
            </div>
            
            <div id = "datum">
                    <p>Last published 31/1 2023 | A site made for a course in databases (D0018E) by Amanda Lorné, Helge Lindgren and Axel Johansson, Luleå University of Technology</p>
            
            </div>
        </div>
        
    </body>
</html>