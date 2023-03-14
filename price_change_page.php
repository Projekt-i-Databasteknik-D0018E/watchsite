<?php 
session_start();
if($_SESSION['Privilege'] == 'Admin'){
if(isset($_POST['subbttn'])) {
	include 'configuration.php';
	$pID = $_POST['ProductId'];
    $NP = $_POST['NewPrice'];
    
		$query = $connection->prepare("UPDATE Products SET Price=? WHERE ProductId=?");
		$query->bind_param('di',$NP, $pID);
		$query->execute();
        
		?>
		<script type="text/javascript">
		alert("Price successfully altered.");
		document.location.href = "admin.html";
		</script>
		<?php
	
}  else {
	echo "Submission error";
}
} else {
    echo "Admin token not working for some reason";
}