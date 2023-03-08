<?php 
session_start();
if($_SESSION['Privilege'] == 'Customer'){
if(isset($_POST['subbttn'])) {
	include 'configuration.php';
	$pID = $_POST['ProductID'];
    $preGrade = $_POST['PreGrade'];
    $gradees = $_POST['Gradees'];
    $grade = $_POST['Grade'];
    $newGrade = ($preGrade*$gradees+$grade)/($gradees+1);
    $gradees = $gradees+1;
        
		$query = $connection->prepare("UPDATE Products SET Gradees=?, Grade=? WHERE ProductId=?");
        $query->bind_param('iii',$gradees, $newGrade, $pID);
		$query->execute();
        $hreflink = "product.php?ProductId=".$pID;
		?>
		<script type="text/javascript">
		alert("Successfully graded.");
        document.location.href = "<?php echo $hreflink; ?>";
		</script>
		<?php
}  else {
	echo "Submission error";
}
} else {
    echo "Admin token not working for some reason";
}