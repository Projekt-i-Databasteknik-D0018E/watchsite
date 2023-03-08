<?php 
session_start();
if($_SESSION['Privilege'] == 'Admin'){
if(isset($_POST['subbttn'])) {
	include 'configuration.php';
	$username = $_POST['AUsername'];
	$password = $_POST['APassword'];
	$checkname = $connection->prepare("SELECT AUsername FROM Admins WHERE AUsername=?");
	$checkname->bind_param("s", $username);
	$checkname->execute();
	$checkname->store_result();
	$result = $checkname->num_rows;
	if($result > 0){
	?>
	<script type="text/javascript">
	alert("Admin name already exists.");
	document.location.href = "admin.html";
	</script>
	<?php
	} else {
		$query = $connection->prepare("INSERT INTO Admins (AUsername, APassword) VALUE (?, ?)");
		$query->bind_param('ss',$username,$password);
		$query->execute();
		?>
		<script type="text/javascript">
		alert("Admin account successfully created.");
		document.location.href = "admin.html";
		</script>
		<?php
	}
}  else {
	echo "Submission error";
}
} else {
    echo "Admin token not working for some reason";
}