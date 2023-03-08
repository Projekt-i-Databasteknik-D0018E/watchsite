<?php 
session_start();
if($_SESSION['Privilege'] == 'Admin'){
if(isset($_POST['subbttn'])) {
	include 'configuration.php';
	$pID = $_POST['ProductId'];
    $stock = $_POST['Stock'];
    
        echo "SETUP WORKS ";
		$query = $connection->prepare("UPDATE Products SET Stock=? WHERE ProductId=?");
        echo "SQL WORKS ";
		$query->bind_param('ii',$stock, $pID);
        echo "BIND WORKS ";
		$query->execute();
        echo "EXECUTE WORKS";
		?>
		<script type="text/javascript">
		alert("Stock successfully altered.");
		document.location.href = "admin.html";
		</script>
		<?php
	
}  else {
	echo "Submission error";
}
} else {
    echo "Admin token not working for some reason";
}