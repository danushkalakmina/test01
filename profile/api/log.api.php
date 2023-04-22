<?php

include_once "../classes/connetion.class.php";
include_once "../classes/login.class.php";
include_once "../classes/utils.class.php";
$dataLogin = new logData();
$utils = new utils();
$json = file_get_contents('php://input');
$obj=json_decode($json, true);
$emailId = $obj["email"];
$emailPass = $obj["password"];
if (!empty($emailId) && !empty($emailPass)) {
    echo json_encode($dataLogin->userVerifyMobile($emailId, $emailPass));
}
?>