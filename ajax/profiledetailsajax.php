<?php
session_start();
include('../connect.php');

$dfname = $_POST['dfname'];
$dlname = $_POST['dlname'];
$dbirth = $_POST['dbirth'];
$dnumber = $_POST['dnumber'];
$demail = $_POST['demail'];
// $dcompanyaddress = $_POST['dcompanyaddress'];
$uid = $_SESSION['uid'];





$sqll = "UPDATE `registration` SET `firstname`='$dfname', `lastname`='$dlname', `birthdate`='$dbirth', `mobile`='$dnumber',`email`='$demail' WHERE `id`='$uid'";
$queryy = mysqli_query($con, $sqll);

if ($queryy) {
    echo "Successfully updated";
} else {
    echo "Failed to update";
}

$con->close();
?>