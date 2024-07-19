<?php

include('../connect.php');

$cname = $_POST['cname'];

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
    $targetDir = '../uploads/';
    $uploadedFilePath = upload_Profile($file, $targetDir);
    if ($uploadedFilePath) {
        $imageArray[] = $uploadedFilePath;
    }
}
$uploadedFilesString0 = implode(',', $imageArray);

$sql2 = "INSERT INTO `categories` (`catagoryName`,`cimage`) VALUES('$cname','$uploadedFilesString0');";

$query2 = mysqli_query($con, $sql2);

function upload_Profile($image, $target_dir)
{
    if ($image['name'] != "") {
        $target_file = $target_dir . basename($image["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $msg = " ";
        try {
            $check = getimagesize($image["tmp_name"]);
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
                if (move_uploaded_file($image["tmp_name"], $target_file)) {
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

if ($query2) {
    echo json_encode(["status" => "success", "message" => "Successfully added the data"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed! Please Try Again"]);
}

?>