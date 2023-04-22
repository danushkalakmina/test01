<?php
$target_dir = "../prof/".base64_decode($_COOKIE['company-id'])."/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$prof_image ="prof/".base64_decode($_COOKIE['company-id'])."/". basename($_FILES["fileToUpload"]["name"]);

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    setcookie('prof_image', $prof_image, time() + 600, "/");
    echo "uploaded";
} else {
    echo "error";
}
?>
