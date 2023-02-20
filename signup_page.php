<?php 
if(isset($_POST['subbttn'])) {
	include 'configuration.php';
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['psw'];
	$query = $connection->prepare("INSERT INTO Customers (CUsername, CEmail, CPassword) VALUE (?, ?, ?)");
	$query->bind_param('sss',$username,$email,$password);
	$query->execute();
	header('Location: http://130.240.200.109/login.html');
	if(mysqli_query($connection, $query))
	{
		echo "Registration successfull.";
	} else { echo "Connection error."; }
}  else {
	echo "Submission error";
}
