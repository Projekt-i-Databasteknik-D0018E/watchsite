<?php
session_start();
include 'configuration.php';
if(isset($_POST['subbttn'])){
	$username = $_POST['username'];
	$password = $_POST['psw'];
	$loginq = $connection->prepare("SELECT * FROM Customers WHERE CUsername=? AND CPassword=?");
	$loginq->bind_param("ss", $username, $password);
	$loginq->execute();
	$loginq->store_result();
	$res = $loginq->num_rows;
	if ($res <1){
		?>
		<script type="text/javascript">
		alert("Username does not exist or password is incorrect, please try again.");
		document.location.href = "login.html";
		</script>
		<?php
	} else { 
		$loginq->bind_result($id, $fn, $ln, $un, $pw, $em);
		$loginq->fetch();

		$_SESSION["UName"] = $un;
		$_SESSION["UID"] = $id;
		$_SESSION["Privilege"] = "Customer";
		?>
		<script type="text/javascript">
		alert("You should now be logged in.");
		document.location.href = "index.php";
		</script>
		<?php
	}
} else {echo "error";}
