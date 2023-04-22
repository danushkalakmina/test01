<?php
include_once "../classes/connetion.class.php";
include_once "../classes/userdata.class.php";

$userData = new userdata();

if (isset($_POST['dataTypes'])) {

    echo json_encode ($userData ->typeList());
    

}elseif (isset($_POST['datacityAll'])) {

    echo json_encode ($userData ->cityAll($_POST['datacityAll']));
    
    
}elseif (isset($_POST['datadistricAll'])) {


    echo json_encode ($userData ->districAll());
    
}elseif (isset($_POST['userIDUpadte'])) {


    echo ($userData ->userUpdate($_POST['userName'],$_POST['userEmail'],$_POST['userContact'],$_POST['companyType'],$_POST['companyName'],$_POST['companyAddress'],$_POST['distric'],$_POST['city']));
    
}



?>