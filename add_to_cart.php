<?php
session_start();
$privilege = $_SESSION['Privilege'];
include 'configuration.php';
if($privilege == 'Customer'){
if(isset($_POST['subbttn'])){
	$userID = $_SESSION['UID'];
    $ProductId = (int)$_POST['ProductID'];
    $PAMT = (int)$_POST['ProductAmount'];
	$cartQ = $connection->prepare("INSERT INTO Cart (CartCId, CartPId, Amount) VALUES (?, ?, ?)");
	$cartQ->bind_param("iii", $userID, $ProductId, $PAMT);
	$cartQ->execute();
		?>
		<script type="text/javascript">
		alert("Item successfully placed in cart.");
		document.location.href = "cart.php";
		</script>
		<?php
} else {echo "error";}
} else {
    ?>
    <script type="text/javascript">
    alert("Please sign in before shopping.");
    document.location.href = "login.html";
    </script>
    <?php  
} 