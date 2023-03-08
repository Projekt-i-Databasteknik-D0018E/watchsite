<?PHP
SESSION_START();
include 'configuration.php';
$UID = $_POST['UID'];
if(!$UID) {
    ?>
    <script type="text/javascript">
    alert("You are not logged in");
    document.location.href = "index.php";
    </script>
    <?PHP
}
$myCart = $connection->prepare("DELETE FROM Cart WHERE CartCID = ?");
$myCart->bind_param("i", $UID);
$myCart->execute();
?>
<script type="text/javascript">
	alert("Successfully cleared cart.");
	document.location.href = "index.php";
</script>