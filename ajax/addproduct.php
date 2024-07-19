<?php

include('../connect.php');

$category = $_POST['category'];
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$size = $_POST['size'];
$coins = $_POST['coin'];
$color = $_POST['colorr'];

$colors = isset($_POST['color']) ? $_POST['color'] : [];
$images = isset($_FILES['image']) ? $_FILES['image'] : ['tmp_name' => []];
$imageArray1 = [];



for ($i = 0; $i < count($colors); $i++) {
    $color = isset($colors[$i]) ? $colors[$i] : null;
    $image = isset($images['tmp_name'][$i]) ? $images['tmp_name'][$i] : null;


    $targetDir1 = '../uploads/';
    $path = upload_Profile($images['name'][$i], $image, $targetDir1);
    if ($color !== null && $image !== null) {
        $targetDir1 = '../uploads/';
        $path = upload_Profile(isset($images['name'][$i]) ? $images['name'][$i] : null, $image, $targetDir1);
        if ($path) {
            $imageArray1[] = $path;
        }
    }
}

$colorvalue = implode(',', $colors);
$imageArray1 = implode(',', $imageArray1);
$sql11 = "INSERT INTO `imagecolor` (`color`,`image`) VALUES('$colorvalue','$imageArray1');";
$query11 = mysqli_query($con, $sql11);



$uploadedFiles = $_FILES['files'];
$allFilesInserted = true;
$imageArray = [];
for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
    $file = array(
        'name' => $uploadedFiles['name'][$i],
        'type' => $uploadedFiles['type'][$i],
        'tmp_name' => $uploadedFiles['tmp_name'][$i],
        'error' => $uploadedFiles['error'][$i],
        'size' => $uploadedFiles['size'][$i]
    );

    if ($file['error'] === UPLOAD_ERR_OK) {
        $targetDir = '../uploads/';
        $uploadedFilePath = upload_Profile($file['name'], $file['tmp_name'], $targetDir);

        if ($uploadedFilePath) {
            $imageArray[] = $uploadedFilePath;
        }
    }
}
$uploadedFilesString = implode(',', $imageArray);

$sql = "INSERT INTO `product` (`pname`,`price`,`Discription`,`Sizes`,`category`,`images`,`coins`,`color`) VALUES('$name','$price','$description','$size','$category','$uploadedFilesString','$coins','$color');";
$query = mysqli_query($con, $sql);

function upload_Profile($fileName, $image, $target_dir)
{
    if ($fileName != "") {
        $target_file = $target_dir . basename($fileName);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $msg = " ";
        try {
            $check = getimagesize($image);
            $msg = array();
            if ($check !== false) {
                $uploadOk = 1;
            }
            if (file_exists($target_file)) {
                $msg[1] = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            if ($imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $msg[2] = "Sorry, only PDF, JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                $msg[3] = "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($image, $target_file)) {
                } else {
                    $msg[4] = "Sorry, there was an error uploading your file.";
                }
            }
            return ltrim($target_file, '');
        } catch (Exception $e) {
        }
    } else {
        return "";
    }
}

if ($query) {
    echo json_encode(["status" => "success", "message" => "Successfully added the data"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed! Please Try Again"]);
}

?>