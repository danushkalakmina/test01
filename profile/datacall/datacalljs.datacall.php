<?php

header('Content-Type: application/json');
include_once "../classes/connetion.class.php";
include_once "../classes/datacall.class.php";
include_once "../classes/utils.class.php";
include_once "../classes/login.class.php";
$dataCalls = new datacall();
$utils = new utils();
$pRest = new logData();

if (isset($_POST['functionname'])) {
    switch ($_POST['functionname']) {
        case 'cityList':
            echo json_encode($dataCalls->cityList($utils->getParamVal("district")));
            break;
        case 'postSearch':
            $categoriesArray = $utils->getParam("categoriesArray");
            $typeArray = $utils->getParam("typeArray");
            $districtArray = $utils->getParam("districtArray");
            $search_title = $utils->getParam("search_title");
            $sort_type = $utils->getParam("sort_type");
            $is_Deliver = $utils->getParam("is_Deliver");
            $is_Biding = $utils->getParam("is_Biding");
            $is_Negotiable = $utils->getParam("is_Negotiable");
            echo json_encode($dataCalls->searchPosts($categoriesArray,$typeArray,$districtArray,$search_title,$sort_type,$is_Deliver,$is_Biding,$is_Negotiable));
            break;
        case 'checkDiscount':
            $discountCode = $utils->getParam("discountCode");
            $subTotal = $utils->getParam("subTotal");
            $postID = $utils->getParam("postID");
            $deliveryPrice = $utils->getParam("deliveryPrice");
            echo json_encode($dataCalls->checkDiscount($postID,$discountCode,$subTotal,$deliveryPrice));
            break;
        case 'getPostedCount':
            $companyID = $utils->getParam("companyID");
            echo json_encode($dataCalls->getPostedCount($companyID));
            break;
        default:
            echo json_encode('Not found function ' . $_POST['functionname'] . '!');
            break;
    }
}else if (isset($_POST['emailid'])) {


    $emailId = filter_var($_POST['emailid'],FILTER_SANITIZE_EMAIL);

    echo ($dataCalls->emailVerifiy($emailId));

    

}elseif (isset($_POST['emailPassOTP'])) {


    echo($pRest->userTempPw($_POST['emailPassOTP']));
    

}

?>