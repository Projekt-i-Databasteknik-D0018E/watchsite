<?php 
session_start();
if($_SESSION['Privilege'] == 'Admin'){
if(isset($_POST['subbttn'])) {
	include 'configuration.php';
	$pname = $_POST['ProductName'];
	$pdesc = $_POST['ProductDescription'];
    $image = $_POST['Image'];
    $price = $_POST['Price'];
    $stock = $_POST['Stock'];
    
	$checkname = $connection->prepare("SELECT ProductName FROM Products WHERE Productname=?");
	$checkname->bind_param("s", $pname);
	$checkname->execute();
	$checkname->store_result();
	$result = $checkname->num_rows;
	if($result > 0){
	?>
	<script type="text/javascript">
	alert("Product name already exists.");
	document.location.href = "admin.html";
	</script>
	<?php
	} else {
		$query = $connection->prepare("INSERT INTO Products (ProductName, ProductDescription, Image, Price, Stock) VALUE (?, ?, ?, ?, ?)");
		$query->bind_param('sssdi',$pname, $pdesc, $image, $price, $stock);
		$query->execute();
		?>
		<script type="text/javascript">
		alert("Product successfully created.");
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