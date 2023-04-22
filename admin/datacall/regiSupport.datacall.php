<?php
include_once "../includes/autoloader.inc.php";

$dataCalls = new datacall;

if (isset($_POST['loadFrmReg'])) {

    $districList = $dataCalls->districtList();

    echo json_encode($districList);
    

}

elseif (isset($_POST['cityList'])) {

    $districId = filter_var($_POST['cityList'],FILTER_SANITIZE_STRING);

    $cityList = $dataCalls->cityList($districId);

    echo json_encode($cityList);
    

}

?>