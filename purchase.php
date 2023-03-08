<?PHP
SESSION_START();
include 'configuration.php';

$UID = $_POST['UID'];
$ADR = $_POST['DeliveryAdress'];
$DVN = $_POST['DeliveryName'];
$stockflag = 1;
$myCart = $connection->prepare("SELECT * FROM Cart WHERE CartCID = ?");
$myCart->bind_param("i", $UID);
$myCart->execute();
$myCart->store_result();
$myCart->bind_result($itemID, $CID, $PID, $AMT);


$findBatch = $connection->prepare("SELECT MAX(BatchId) FROM Orders");
$findBatch->execute();
$findBatch->store_result();
$findBatch->bind_result($BatchID);
$findBatch->fetch();
$BatchID++;

$ensureStock = $connection->prepare("SELECT * FROM Cart WHERE CartCID = ?");
$ensureStock->bind_param("i", $UID);
$ensureStock->execute();
$ensureStock->store_result();
$ensureStock->bind_result($itemID_stock, $CID_stock, $PID_stock, $AMT_stock);

while($ensureStock->fetch()){ //THIS MAKES SURE ALL THE REQUESTED PRODUCTS ARE IN STOCK AND EXITS IF THEY AREN'T.
    $sumAmt = $connection->prepare("SELECT SUM(Amount) FROM Cart WHERE CartCID=? AND CartPID=?");
    $sumAmt->bind_param("ii", $CID_stock, $PID_stock);
    $sumAmt->execute();
    $sumAmt->store_result();
    $sumAmt->bind_result($aggregateAmount);
    $sumAmt->fetch();
    $getStock = $connection->prepare("SELECT Stock FROM Products WHERE ProductId=?");
    $getStock->bind_param("i", $PID_stock);
    $getStock->execute();
    $getStock->store_result();
    $getStock->bind_result($Stockcheck);
    $getStock->fetch();
    if ( $aggregateAmount > $Stockcheck){
        $stockflag = 0;
        ?>
        <script type="text/javascript">
		alert("You are trying to order more of a product than exists in our stock, please try again with a lower quantity.");
		document.location.href = "index.php";
		</script>
        <?PHP
    }
    }
    if ( $stockflag == 1){
        //MOVE THIS OUT OF OTHER WHILE LOOP AND CHECK FLAG BEFORE ENTERING LOOP
        while( $myCart->fetch()){
            $getPrice = $connection->prepare("SELECT Price FROM Products WHERE ProductId=?");
            $getPrice->bind_param("i", $PID);
            $getPrice->execute();
            $getPrice->store_result();
            $getPrice->bind_result($PRICE);
            $getPrice->fetch();
            $decreaseStock = $connection->prepare("UPDATE Products SET Stock = (Stock - ?) WHERE ProductId=?");
            $decreaseStock->bind_param("ii", $AMT, $PID);
            $decreaseStock->execute();
            $placeOrder = $connection->prepare("INSERT INTO Orders (CId, PId, BatchId, Amount, DeliveryAdress, DeliveryName, OrderPrice) VALUE (?, ?, ?, ?, ?, ?, ?)");
            $placeOrder->bind_param("iiiissd", $CID, $PID, $BatchID, $AMT, $ADR, $DVN, $PRICE);
            $placeOrder->execute();
            echo "Price for this loop: ".$PRICE;
            $strikeRow = $connection->prepare("DELETE FROM Cart WHERE ItemID=?");
            $strikeRow->bind_param("i", $itemID);
            $strikeRow->execute();
            }
        ?>
        <script type="text/javascript">
		    alert("Successfully placed order.");
		    document.location.href = "index.php";
		</script> 
        <?PHP
}
