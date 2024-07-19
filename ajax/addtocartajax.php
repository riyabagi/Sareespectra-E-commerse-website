<?php
session_start();
include('../connect.php');
$productId = isset($_POST['productId']) ? mysqli_real_escape_string($con, $_POST['productId']) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $productId) {
    
    $uid = isset($_SESSION["uid"]) ? $_SESSION["uid"] : null;
   
    $sqlRemoveProduct = "DELETE FROM addtocart WHERE userid = '$uid' AND productid = '$productId'";
    $resultRemoveProduct = mysqli_query($con, $sqlRemoveProduct);

    if ($resultRemoveProduct) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
    }
} else {
    // echo "error";
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}

if ($con) {
    mysqli_close($con);
}
?>