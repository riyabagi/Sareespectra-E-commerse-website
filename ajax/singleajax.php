<?php
session_start();
include('../connect.php');

$uid = isset($_SESSION["uid"]) ? $_SESSION["uid"] : null;
$pid = isset($_POST['pid']) ? $_POST['pid'] : null;
$pname = isset($_POST['pname']) ? $_POST['pname'] : null;
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

// Check if the product is already in the user's cart
$sqlCheckProduct = "SELECT * FROM addtocart WHERE userid = '$uid' AND productid = '$pid'";
$resultCheckProduct = mysqli_query($con, $sqlCheckProduct);

if (!$resultCheckProduct) {
    $response = ['success' => false, 'error' => mysqli_error($con)];
} else {
    if (mysqli_num_rows($resultCheckProduct) > 0) {
        // Product is already in the cart, update the quantity
        $sqlUpdateQuantity = "UPDATE addtocart SET quantity = quantity + '$quantity' WHERE userid = '$uid' AND productid = '$pid'";
        $resultUpdateQuantity = mysqli_query($con, $sqlUpdateQuantity);

        if ($resultUpdateQuantity) {
            $response = ['success' => true, 'pname' => $pname, 'quantity' => $quantity, 'debug' => 'Quantity updated successfully'];
        } else {
            $response = ['success' => false, 'error' => mysqli_error($con)];
        }
    } else {
        // Product is not in the cart, insert a new record
        $sqlInsertProduct = "INSERT INTO `addtocart` (`productid`, `productname`, `userid`, `quantity`) VALUES ('$pid', '$pname', '$uid', '$quantity')";
        $resultInsertProduct = mysqli_query($con, $sqlInsertProduct);

        if ($resultInsertProduct) {
            $response = ['success' => true, 'pname' => $pname, 'quantity' => $quantity, 'debug' => 'Inserted successfully'];
        } else {
            $response = ['success' => false, 'error' => mysqli_error($con)];
        }
    }
}

echo json_encode($response);
?>