<?php 
if(isset($_POST['subbttn'])) {
	include 'configuration.php';
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['psw'];
	$checkname = $connection->prepare("SELECT CUsername FROM Customers WHERE CUsername=?");
	$checkname->bind_param("s", $username);
	$checkname->execute();
	$checkname->store_result();
	$result = $checkname->num_rows;
	if($result > 0){
	?>
	<script type="text/javascript">
	alert("That username is already in use, please try again with another username.");
	document.location.href = "signup.html";
	</script>
	<?php
	} else {
		$query = $connection->prepare("INSERT INTO Customers (CUsername, CEmail, CPassword) VALUE (?, ?, ?)");
		$query->bind_param('sss',$username,$email,$password);
		$query->execute();
		header('Location: http://130.240.200.109/login.html');
		if(mysqli_query($connection, $query))
		{
			echo "Registration successfull.";
		} else { echo "Connection error."; }
	}
}  else {
	echo "Submission error";
}
