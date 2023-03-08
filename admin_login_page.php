<?php
session_start();
include 'configuration.php';
if(isset($_POST['subbttn'])){
	$username = $_POST['username'];
	$password = $_POST['psw'];
	$loginq = $connection->prepare("SELECT * FROM Admins WHERE AUsername=? AND APassword=?");
	$loginq->bind_param("ss", $username, $password);
	$loginq->execute();
	$loginq->store_result();
	$res = $loginq->num_rows;
	if ($res <1){
		?>
		<script type="text/javascript">
		alert("Admin username does not exist or password is incorrect, please try again.");
		document.location.href = "login.html";
		</script>
		<?php
	} else { 
		$loginq->bind_result($id, $user, $psw);
		$loginq->fetch();

		$_SESSION["UName"] = $user;
		$_SESSION["UID"] = $id;
		$_SESSION["Privilege"] = "Admin";
		?>
		<script type="text/javascript">
		alert("You should now be logged in as admin.");
		document.location.href = "index.php";
		</script>
		<?php
	}
} else {echo "error";}