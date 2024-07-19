<?php
session_start();
include('../connect.php');

$uid = mysqli_real_escape_string($con, $_POST['userid']);
$pay = mysqli_real_escape_string($con, $_POST['paymentmeathod']);
$amount = mysqli_real_escape_string($con, $_POST['amount']);

$sql37 = "INSERT INTO `buycoins` (`uid`,`pamentmeathod`,`coins`) VALUES ('$uid','$pay','$amount');";
$query37 = mysqli_query($con, $sql37);


if ($query37) {
    $updateCoinsQuery = "UPDATE `registration` SET `coin` = `coin` + '$amount' WHERE `id` = '$uid'";
    $updateResult = $con->query($updateCoinsQuery);

    if ($updateResult) {
        echo "Coins updated successfully.";
    } else {
        echo "Error updating coins: " . $con->error;
    }

    echo json_encode(["success" => true, "message" => "Transaction successful"]);
} else {
    echo json_encode(["success" => false, "message" => "Transaction failed"]);
}
mysqli_close($con);

?>