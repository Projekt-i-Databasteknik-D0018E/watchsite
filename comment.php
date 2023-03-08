<?php
session_start();
$privilege = $_SESSION['Privilege'];
include 'configuration.php';
if($privilege == 'Customer'){
    if(isset($_POST['subbttn'])){
        $userID = $_SESSION['UID'];
        $ProductId = (int)$_POST['ProductID'];
        $Comment = $_POST['Comment'];
        echo $userID." ";
        $commentQ = $connection->prepare("INSERT INTO Comments (CustomerId, ProductId, Content) VALUES (?, ?, ?)");
        echo $ProductId." ";
        $commentQ->bind_param("iis", $userID, $ProductId, $Comment);
        echo $Comment." ";
        $commentQ->execute();
        echo "abc";
        $hreflink = "product.php?ProductId=".$ProductId;
            ?>
            <script type="text/javascript">
            alert("Comment successfully placed.");
            document.location.href = "<?php echo $hreflink; ?>";
            </script>
            <?php
    } else {echo "error";}
} else {
    ?>
    <script type="text/javascript">
    alert("Please sign in before commenting.");
    document.location.href = "login.html";
    </script>
    <?php  
} 