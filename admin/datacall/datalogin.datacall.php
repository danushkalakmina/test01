<?php

include_once "../classes/connetion.class.php";
include_once "../classes/login.class.php";


$dataLoging = new logData();

if (isset($_POST['emailPass'])) {
    
    $emailId = filter_var($_POST['emailId'],FILTER_SANITIZE_EMAIL);
    $emailPass = filter_var($_POST['emailPass'],FILTER_SANITIZE_STRING);

    echo ($dataLoging->userVerifiy($emailId,$emailPass));

}

?>