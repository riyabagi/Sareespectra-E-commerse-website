<?php
session_start();
include('../connect.php');


$state = $_POST['state'];
$city = $_POST['city'];
$pin = $_POST['pin'];
$area = $_POST['area'];
$houseno = $_POST['houseno'];

$uid = $_SESSION['uid'];

$sqlll = "UPDATE `registration` SET `state`='$state', `city`='$city', `pincode`='$pin', `area`='$area', `houseno`='$houseno' WHERE `id`='$uid'";
$queryyy = mysqli_query($con, $sqlll);

if ($queryyy) {
    echo "Successfuly saved";
} else {
    echo "Did not save";
}

$con->close();

?>