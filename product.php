<!DOCTYPE HTML>
<?PHP include 'configuration.php'?>
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
            </div>
            <?php 
            $PID = $_GET['ProductId'];
            $pQuery = $connection->prepare("SELECT * FROM Products WHERE ProductId=?");
	        $pQuery->bind_param("i", $PID);
	        $pQuery->execute();
	        $pQuery->store_result();
            $pQuery->bind_result($id, $PDesc, $Stock, $IMG, $PName, $Price, $IsVis, $Grade, $Gradees);
		    $pQuery->fetch();
            ?>
            <div id = "content">
               <h1><?PHP echo $PID.": ".$PName. " ~ ".$Price."€"; ?></h1>
                <div id = "watches">
                    <div id = "watchDescription">
                    <?php $imglink = "../".$IMG;?>
                    <img src=<?php echo $imglink; ?> class = "watchimg">
                        <div id = "buyDiv">
                            <form action="/add_to_cart.php" method = "post">
                                <div class="container">

                                    <label for="ProductAmount"><b>Amount:</b></label>
                                    <input type="text" placeholder="Enter amount" name="ProductAmount" required>
                                    <input type="hidden" name="ProductID" value=<?PHP echo $PID;?>>
                                    <div class="clearfix">
                                        <button type="submit" class="signupbtn" name="subbttn" style="margin-left: 95px;">Add to cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id = "buyDiv">
                            <form action="/grades.php" method = "post">
                                <div class="container">
                                    <label for="Grade"><b>Rate product:</b></label>
                                    <input type="range" name="Grade" min="1" max="5" required>
                                    <input type="hidden" name="ProductID" value=<?PHP echo $PID;?>>
                                    <input type="hidden" name="PreGrade" value=<?PHP echo $Grade;?>>
                                    <input type="hidden" name="Gradees" value=<?PHP echo $Gradees;?>>
                                    <div class="clearfix">
                                        <button type="submit" class="signupbtn" name="subbttn" style="margin-left: 95px;">Rate</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <h3><?PHP echo "In stock: ".$Stock;?><br><?php echo "Grade: ".(int)($Grade+0.5)." stars"; ?> <br><?PHP echo $PDesc; ?></h3>
                        
                        <div id="comments">
                            <h2>Comments:</h2>
                            <form action="/comment.php" method = "post">
                                <div class="container">
                                    <label for="Comment" style="margin-left: 20px;"><b>Comment</b></label>
                                    <input type="text" placeholder="Enter comment" name="Comment" required style="display: block float:left;">
                                    <input type="hidden" name="ProductID" value=<?PHP echo $PID;?>>
                                    <div class="clearfix" style="margin-left: 0px; display: block; float:right; margin-bottom: 100px;">
                                        <button name="subbttn" type="submit" class="signupbtn"  style="margin-right: 550px; display: block; float:left;">Comment</button>
                                    </div>
                                </div>
                            </form>
                            <?PHP
                            $pQuery = $connection->prepare("SELECT * FROM Comments WHERE ProductId=?");
                            $pQuery->bind_param("i", $PID);
                            $pQuery->execute();
                            $pQuery->store_result();
                            $pQuery->bind_result($CommentId, $CustomerId, $ProductId, $Content);

                            while($pQuery->fetch()) {
                                $cQuery = $connection->prepare("SELECT CUsername FROM Customers WHERE CustomerId=?");
                                $cQuery->bind_param("i", $CustomerId);
                                $cQuery->execute();
                                $cQuery->store_result();
                                $cQuery->bind_result($CUsername);
                                $cQuery->fetch(); ?>
                                <div class = "comment">
                                    <h3><?php echo $CommentId.": ".$CUsername;?></h3>
                                    <p><?php echo $Content;?></p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
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