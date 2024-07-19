<?php

include('../connect.php');

$uid = $_POST['userid'];
$productid = $_POST['productId'];
$paymentMethodText = $_POST['paymentMethod'];

$color = $_POST['color'];
$Sizes = $_POST['Sizes'];
$coin = $_POST['coin'];
$quantity = $_POST['quantity'];

$price = $_POST['price'];
$deliveryCharge = $_POST['deliveryCharge'];
$subtotal = $_POST['subtotal'];
$coinsUsed = $_POST['enteredCoins'];
$finalTotal = $_POST['finalTotal'];
// $enteredCoins = $_POST['enteredCoins'];

$date = $_POST['date'];

$sql3 = "INSERT INTO `orders` (`uid`, `productid`,`pamentmeathod`, `color`,`size`,`Quantity`,`coinsgained`,`price`,`deliverycharge`,`subtotal`,`coinsused`,`total`,`date`) VALUES ('$uid','$productid','$paymentMethodText', '$color', '$Sizes', '$quantity', '$coin', '$price', '$deliveryCharge', '$subtotal', '$coinsUsed', '$finalTotal','$date');";
$query3 = mysqli_query($con, $sql3);

$fet = "SELECT * FROM registration WHERE `id`='$uid'";
$query4 = mysqli_query($con, $fet);
if ($query4) {
    if (mysqli_num_rows($query4) > 0) {
        $row = mysqli_fetch_assoc($query4);
        $coins = $row['coin'];
    } 
}
$newTotalCoins =0;
$newTotalCoinspro =0;
$newTotalCoins = (int)$coins + (int)$coin;
$newTotalCoinspro = (int)$newTotalCoins -(int)$coinsUsed;



$sqlll = "UPDATE `registration` SET `coin`='$newTotalCoinspro' WHERE `id`='$uid'";
$queryyy = mysqli_query($con, $sqlll);



if ($query3) {
    echo json_encode(["success" => true, "message" => "Order placed successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to update"]);
}

?>