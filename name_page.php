<?php 
session_start();
if($_SESSION['Privilege'] == 'Customer'){
if(isset($_POST['subbttn'])) {
	include 'configuration.php';
	$UID = $_SESSION['UID'];
    $newFname = $_POST['CFirstName'];
    $newLname = $_POST['CLastName'];
    
        
		$FNquery = $connection->prepare("UPDATE Customers SET CFirstName=? WHERE CustomerId=?");
		$FNquery->bind_param('si', $newFname, $UID);
		$FNquery->execute();
        $LNquery = $connection->prepare("UPDATE Customers SET CLastName=? WHERE CustomerId=?");
		$LNquery->bind_param('si', $newLname, $UID);
		$LNquery->execute();
		?>
		<script type="text/javascript">
		alert("Name successfully altered.");
		document.location.href = "profile.php";
		</script>
		<?php
	
}  else {
	echo "Submission error";
}
} else {
    ?>
    <script type="text/javascript">
		alert("Please log in on a customer account to use this feature.");
		document.location.href = "login.html";
	</script>
    <?PHP
}