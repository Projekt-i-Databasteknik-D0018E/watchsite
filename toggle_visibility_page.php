<?php 
session_start();
if($_SESSION['Privilege'] == 'Admin'){
if(isset($_POST['subbttn'])) {
	include 'configuration.php';
	$pID = $_POST['ProductId'];
		$query = $connection->prepare("UPDATE Products SET IsVisible=IsVisible^1 WHERE ProductId=?");
        $query->bind_param('i',$pID);
		$query->execute();
		?>
		<script type="text/javascript">
		alert("Successfully toggled.");
		document.location.href = "admin.html";
		</script>
		<?php
}  else {
	echo "Submission error";
}
} else {
    echo "Admin token not working for some reason";
}