<?php
session_start();
include('../connect.php');

$userType = isset($_POST['userType']) ? $_POST['userType'] : '';
$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$companyName = isset($_POST['companyName']) ? $_POST['companyName'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$checkUserQuery = "SELECT * FROM `login` WHERE `username` = ? ";
$stmt = $con->prepare($checkUserQuery);
$stmt->bind_param("s", $name);
$stmt->execute();
$checkUserResult = $stmt->get_result();

if ($checkUserResult->num_rows > 0) {
    $existingUser = $checkUserResult->fetch_assoc();

    if ($existingUser['username'] == $name) {
        echo "Username '$name' is already taken";
    } elseif ($existingUser['email'] == $email) {
        echo "Email '$email' is already taken , please use another";
    } elseif ($existingUser['mobile'] == $phone) {
        echo "Phone number '$phone' is already taken";
    }
} else {
    $stmt->close();

    // Update the SQL statement to include userType, companyName, and sareeType
    $sql = "INSERT INTO `registration` (`firstname`, `lastname`, `name`, `mobile`, `email`, `password`, `type`, `companyName`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssss", $fname, $lname, $name, $phone, $email, $password, $userType, $companyName);
    $query0 = $stmt->execute();

    if ($query0) {
        $user_id = mysqli_insert_id($con);

        $sql_user = "INSERT INTO `login` (`uid`, `username`, `password`, `type`) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE `uid` = ?, `username` = ?, `password` = ?, `type` = ?";
        $stmt = $con->prepare($sql_user);
        $stmt->bind_param("ssssssss", $user_id, $name, $password, $userType, $user_id, $name, $password, $userType);
        $query = $stmt->execute();

        if ($query) {
            echo "Registration successful! Welcome to SareeSpectra";
        } else {
            echo "Registration failed";
        }
    } else {
        echo "Registration failed: " . $stmt->error;
    }

    $stmt->close();
}
?>