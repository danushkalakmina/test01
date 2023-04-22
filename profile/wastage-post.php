<?php
include_once "includes/session-validation.php";
$company_id = $_SESSION["company-id"];
$user_id = $_SESSION["user-id"];
include_once "./classes/connetion.class.php";
include_once "./classes/datacall.class.php";
include_once "./classes/utils.class.php";
$dataCalls = new datacall();
$utils = new utils();
$post_code = "";
$responseEditItem = "";
$imageSelectedType = "file";

$companyTypeList = $dataCalls->loadCompanyType();
$districtList = $dataCalls->loadDistrict();
$preferredBuyersTimeList = $dataCalls->loadPreferredBuyersTime();

if ($utils->c_Isset("createPost") && !$utils->c_IsEmpty("createPost")) {
    $post_title = $utils->getParamVal("post_title");
    $post_description = $utils->getParamVal("post_description");
    $waste_type = $utils->getParamVal("waste_type");
    $total_qty = $utils->getParamVal("total_qty");
    $units = $utils->getParamVal("units");
    $total_price = $utils->getParamVal("total_price");
    $parkImageSave = '';
    $is_negotiate = $utils->getParamVal("is_negotiate");
    $is_biding = $utils->getParamVal("is_biding");
    $is_partially_allowed = $utils->getParamVal("is_partially_allowed");
    $buyersArray = $utils->getParam("buyers");
    $contact_no = $utils->getParamVal("contact_no");
    $district = $utils->getParamVal("district");
    $city = $utils->getParamVal("city");
    $pickup_address = $utils->getParamVal("pickup_address");
    $min_partial_qty = $utils->getParamVal("min_partial_qty");
    $is_deliver_allowed = $utils->getParamVal("is_deliver_allowed");
    $delivery_cost = $utils->getParamVal("delivery_cost");
    $partial_unit_price = $utils->getParamVal("partial_unit_price");
    $image_upload_type = $utils->getParamVal("image_upload_type");

    if (isset($_FILES['imageFile']) && $image_upload_type == "file") {
        $filepath = $_FILES['imageFile']['tmp_name'];
        $target_path = "post/" . $company_id;
        $ext = pathinfo($_FILES['imageFile']['name'], PATHINFO_EXTENSION);
        if (!file_exists($target_path)) {
            mkdir($target_path, 0777, true);
        }
        $parkImageSave = $target_path . "/Wastey_" . date("dmYhis") . rand(1000, 1000000) . '.' . $ext;
        move_uploaded_file($filepath, $parkImageSave);
    } else if (isset($_POST["imageUrl"]) && $image_upload_type == "url") {
        $parkImageSave = $utils->getParamVal("imageUrl");
    }
    $responseText = $dataCalls->createPost($user_id, $post_title, $post_description, $waste_type, $total_qty, $units, $total_price, $parkImageSave, $is_negotiate, $is_biding, $is_partially_allowed, $min_partial_qty, $partial_unit_price, $buyersArray, $contact_no, $city, $pickup_address, $is_deliver_allowed, $delivery_cost);
} else if ($utils->c_Isset("updatePost") && !$utils->c_IsEmpty("updatePost")) {
    $idwastage = $utils->getParamVal("idwastage");
    $post_title = $utils->getParamVal("post_title");
    $post_description = $utils->getParamVal("post_description");
    $waste_type = $utils->getParamVal("waste_type");
    $total_qty = $utils->getParamVal("total_qty");
    $units = $utils->getParamVal("units");
    $total_price = $utils->getParamVal("total_price");
    $parkImageSave = '';
    $is_negotiate = $utils->getParamVal("is_negotiate");
    $is_biding = $utils->getParamVal("is_biding");
    $is_partially_allowed = $utils->getParamVal("is_partially_allowed");
    $buyersArray = $utils->getParam("buyers");
    $contact_no = $utils->getParamVal("contact_no");
    $district = $utils->getParamVal("district");
    $city = $utils->getParamVal("city");
    $pickup_address = $utils->getParamVal("pickup_address");
    $min_partial_qty = $utils->getParamVal("min_partial_qty");
    $is_deliver_allowed = $utils->getParamVal("is_deliver_allowed");
    $delivery_cost = $utils->getParamVal("delivery_cost");
    $partial_unit_price = $utils->getParamVal("partial_unit_price");
    $image_upload_type = $utils->getParamVal("image_upload_type");

    if (isset($_FILES['imageFile']) && $_FILES['imageFile']['size'] != 0 && $image_upload_type == "file") {
        $filepath = $_FILES['imageFile']['tmp_name'];
        $target_path = "post/" . $company_id;
        $ext = pathinfo($_FILES['imageFile']['name'], PATHINFO_EXTENSION);
        if (!file_exists($target_path)) {
            mkdir($target_path, 0777, true);
        }
        $parkImageSave = $target_path . "/Wastey_" . date("dmYhis") . rand(1000, 1000000) . '.' . $ext;
        move_uploaded_file($filepath, $parkImageSave);
    } else if (isset($_POST["imageUrl"]) && $image_upload_type == "url") {
        $parkImageSave = $utils->getParamVal("imageUrl");
    }
    $responseText = $dataCalls->updateWastagePost($company_id, $idwastage, $post_title, $post_description, $waste_type, $total_qty, $units, $total_price, $parkImageSave, $is_negotiate, $is_biding, $is_partially_allowed, $min_partial_qty, $partial_unit_price, $buyersArray, $contact_no, $city, $pickup_address, $is_deliver_allowed, $delivery_cost);
} else if ($utils->c_Isset("edit")) {
    $post_code = $utils->getParam("post_code");
    $responseEditItem = $dataCalls->loadWastagePost($post_code, $user_id);
    $imageSelectedType = (strpos($utils->getValue($responseEditItem, "image"), 'http') !== false) ? 'url' : 'file';
}
$title_1 = "Post";
$title_2 = " Ads";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

    <title>Wastey : <?=$title_1.$title_2?></title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script defer src="js/wastage_post.js"></script>
</head>

<body id="page-top">
<div id="wrapper">

    <!-- Sidebar -->

    <?php include_once "includes/sidebar.php"; ?>

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include_once "includes/navup.php"; ?>

            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <div id="newCustomer">

                    <div id="companyRegistation">
                        <div class="row">
                            <?= (isset($responseText)) ? $responseText : '' ?>
                        </div>
                        <form action="wastage-post.php<?= (isset($_GET['mobile_view'])) ? '?mobile_view=true' : '' ?>"
                              method="POST" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Post Title</label>
                                    <input type="text" name="post_title" class="form-control cmpRg"
                                           value="<?= $utils->getValue($responseEditItem, "title") ?>" required
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Post Description</label>
                                    <textarea type="text" name="post_description" class="form-control cmpRg"
                                              style="height: 250px" required
                                              autocomplete="off"><?= $utils->getValue($responseEditItem, "description") ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Waste Type</label>
                                    <select name="waste_type" class="form-select form-control datadetails" required>
                                        <option hidden value="">Select one</option>
                                        <option value="Raw" <?= $utils->getSelectTagValue($responseEditItem, "waste_type", "Raw") ?>>
                                            Raw Item
                                        </option>
                                        <option value="Cooked" <?= $utils->getSelectTagValue($responseEditItem, "waste_type", "Cooked") ?>>
                                            Cooked Item
                                        </option>
                                        <option value="Waste" <?= $utils->getSelectTagValue($responseEditItem, "waste_type", "Waste") ?>>
                                            Waste Item
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">QTY</label>
                                    <input type="text" name="total_qty" id="" class="form-control cmpRg"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '');" minlength="10"
                                           maxlength="10" value="<?= $utils->getValue($responseEditItem, "qty") ?>"
                                           required autocomplete="off">
                                </div>
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Units</label>
                                    <select name="units" class="form-select form-control datadetails" required>
                                        <option hidden>Select one</option>
                                        <option value="mg" <?= $utils->getSelectTagValue($responseEditItem, "unit", "mg") ?>>
                                            Milligram (mg)
                                        </option>
                                        <option value="g" <?= $utils->getSelectTagValue($responseEditItem, "unit", "g") ?>>
                                            Gram (g)
                                        </option>
                                        <option value="kg" <?= $utils->getSelectTagValue($responseEditItem, "unit", "kg") ?>>
                                            Kilogram (kg)
                                        </option>
                                        <option value="t" <?= $utils->getSelectTagValue($responseEditItem, "unit", "t") ?>>
                                            Tonne (t)
                                        </option>
                                        <option value="packs" <?= $utils->getSelectTagValue($responseEditItem, "unit", "packs") ?>>
                                            Number of Packs
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Wholesale Price</label>
                                    <input type="text" name="total_price" class="form-control cmpRg"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '');" minlength="10"
                                           maxlength="10"
                                           value="<?= $utils->getValue($responseEditItem, "total_price") ?>" required
                                           autocomplete="off">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="" class="form-label">Update Image</label>
                                    <div class="col-sm form-group">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="image_upload_type"
                                                       id="radeio-image-file" checked="true"
                                                       value="file" <?= ($imageSelectedType == 'file') ? 'checked' : '' ?>>By
                                                uploading a
                                                image file
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="radeio-image-url"
                                                       name="image_upload_type"
                                                       value="url" <?= ($imageSelectedType == "url") ? 'checked' : '' ?>>By
                                                posting URL
                                            </label>
                                        </div>
                                    </div>
                                    <div class="custom-file"
                                         id="imageByFileView" <?= (!empty($imageSelectedType) && $imageSelectedType == "file") ? '' : 'style="display: none"' ?>>
                                        <input type="file" class="custom-file-input" id="imageFile" name="imageFile" <?=(!empty($imageSelectedType) && $imageSelectedType == "file")? 'required' : ''?>>
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <div class="input-group"
                                         id="imageByURLView" <?= (!empty($imageSelectedType) && $imageSelectedType == "url") ? '' : 'style="display: none"' ?>>
                                        <input type="text" class="form-control" name="imageUrl" id="imageUrl"
                                               placeholder="URL here"
                                               value="<?= $utils->getValue($responseEditItem, "image") ?>"  <?=(!empty($imageSelectedType) && $imageSelectedType == "url")? 'required' : ''?>>
                                        <div class="input-group-append">
                                            <button class="btn btn-success" id="btnImageUrl" type="button"
                                                    onclick="loadImageByURL()">Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 form-group"
                                     id="imgViewArea" <?= (empty($utils->getValue($responseEditItem, "image"))) ? 'style="display: none"' : '' ?>>
                                    <div class="card col-sm-2 pt-3 pb-3">
                                        <img src="<?= $utils->getValue($responseEditItem, "image") ?>"
                                             class="img-rounded" id="imageView" alt="alt"/>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Do you like to negotiate your items?</label>
                                    <div class="col-sm">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="is_negotiate"
                                                       value="1" <?= $utils->getCheckTagValue($responseEditItem, "isnegotiable", "1") ?> required>Yes, I do
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="is_negotiate"
                                                       value="0" <?= $utils->getCheckTagValue($responseEditItem, "isnegotiable", "0") ?>>No,
                                                I don't
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Do you like to place your items for bid?</label>
                                    <div class="col-sm">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="is_biding"
                                                       value="1" <?= $utils->getCheckTagValue($responseEditItem, "isbidding", "1") ?>
                                                       required>Yes, I do
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="is_biding"
                                                       value="0" <?= $utils->getCheckTagValue($responseEditItem, "isbidding", "0") ?>>No,
                                                I don't
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Do you like to deliver your items?</label>
                                    <div class="col-sm">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="item-deliver-yes"
                                                       name="is_deliver_allowed"
                                                       value="1" <?= $utils->getCheckTagValue($responseEditItem, "is_delivery", "1") ?>
                                                       required>Yes, I do
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="item-deliver-no"
                                                       name="is_deliver_allowed"
                                                       value="0" <?= $utils->getCheckTagValue($responseEditItem, "is_delivery", "0") ?>>No,
                                                I don't
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row"
                                 id="item-deliver" <?= (empty($responseEditItem) || $utils->getValue($responseEditItem, "is_delivery") == "0") ? 'style="display: none"' : '' ?>>
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Delivery Cost</label>
                                    <input type="text" name="delivery_cost" id="delivery_cost"
                                           class="form-control cmpRg"
                                           value="<?= $utils->getValue($responseEditItem, "delivery_price") ?>"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '');" minlength="10"
                                           maxlength="10" required autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Do you like to sell your item partially?</label>
                                    <div class="col-sm">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="item-partially-yes"
                                                       name="is_partially_allowed"
                                                       value="1" <?= $utils->getCheckTagValue($responseEditItem, "isseperate", "1") ?>
                                                       required>Yes, I do
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="item-partially-no"
                                                       name="is_partially_allowed"
                                                       value="0" <?= $utils->getCheckTagValue($responseEditItem, "isseperate", "0") ?>>No,
                                                I don't
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row"
                                 id="item-partially" <?= (empty($responseEditItem) || $utils->getValue($responseEditItem, "isseperate") == "0") ? 'style="display: none"' : '' ?>>
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Minimum Partial QTY</label>
                                    <input type="text" id="min_partial_qty" name="min_partial_qty"
                                           class="form-control cmpRg"
                                           value="<?= $utils->getValue($responseEditItem, "seperate_min_qty") ?>"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '');" minlength="10"
                                           maxlength="10" required autocomplete="off">
                                </div>
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Partial Unit Price</label>
                                    <input type="text" id="partial_unit_price" name="partial_unit_price"
                                           class="form-control cmpRg"
                                           value="<?= $utils->getValue($responseEditItem, "unit_price") ?>"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '');" minlength="10"
                                           maxlength="10" required autocomplete="off">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6 form-group required">
                                    <label for="" class="form-label">Preferred Buyers</label>
                                    <?php
                                    foreach ($companyTypeList as $result) {
                                        $responseSelectedPreferredBuyers = $dataCalls->selectedPreferredBuyers($result['iduser_type'], $post_code);
                                        ?>
                                        <div class="row input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox"
                                                           name="buyers[<?= $result['iduser_type'] ?>][check]"
                                                           id="buyers_check_<?= $result['iduser_type'] ?>"
                                                           class="mr-2"
                                                           onchange="validatePreferredBuyers(this,<?= $result['iduser_type'] ?>)"
                                                        <?= (!empty($responseSelectedPreferredBuyers)) ? 'checked' : '' ?>><?= $result["type"] ?>
                                                </div>
                                            </div>
                                            <input type="hidden" name="buyers[<?= $result['iduser_type'] ?>][user_type]"
                                                   value="<?= $result['iduser_type'] ?>"/>
                                            <select name="buyers[<?= $result['iduser_type'] ?>][time]"
                                                    id="buyers_time_<?= $result['iduser_type'] ?>"
                                                    class="form-select form-control datadetails">
                                                <option hidden value="">Valid Time</option>

                                                <?php
                                                foreach ($preferredBuyersTimeList as $timeResult) {
                                                    ?>
                                                    <option value="<?= $timeResult["value"] ?>" <?= $utils->getSelectTagValue($responseSelectedPreferredBuyers, "preferred_time", $timeResult["value"]) ?>><?= $timeResult["text"] ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="text" name="buyers[<?= $result['iduser_type'] ?>][discount]"
                                                   id="buyers_discount_<?= $result['iduser_type'] ?>"
                                                   class="form-control col-sm-2"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                   value="<?= $result["discount_leverage"] ?>" minlength="10"
                                                   maxlength="10" placeholder="Discount Leverage">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                            <span>
                                            Please enter maximum consumable time (i.e. how long this stock can be kept at edible stage) for each category at "valid time" field
<br>
Please select percentage price drop expected for each category at xx %
                                            </span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Contact No</label>
                                    <input type="text" name="contact_no"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '');" minlength="10"
                                           maxlength="10" class="form-control cmpRg"
                                           value="<?= $utils->getValue($responseEditItem, "contact_no") ?>" required
                                           autocomplete="off">
                                </div>
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">District</label>
                                    <select name="district" id="dslistBox" class="form-select form-control datadetails"
                                            required autocomplete="off" onchange="cityList(this.value)">
                                        <option hidden=hidden value="">Select one</option>
                                        <?php
                                        foreach ($districtList as $district) {
                                            ?>
                                            <option value="<?= $district["iddistrict"] ?>" <?= $utils->getSelectTagValue($responseEditItem, "district_id", $district["iddistrict"]) ?>><?= $district["name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">City</label>
                                    <select name="city" id="select-city" class="form-select form-control datadetails"
                                            required>
                                        <option hidden value="">Select One</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm form-group required">
                                    <label for="" class="form-label">Pick-Up Address</label>
                                    <textarea type="text" name="pickup_address" id="" class="form-control cmpRg"
                                              required
                                              autocomplete="off"><?= $utils->getValue($responseEditItem, "pick_up_address") ?></textarea>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-sm">
                                    <input type="hidden" name="idwastage"
                                           value="<?= (isset($responseEditItem["idwastage"])) ? $responseEditItem["idwastage"] : '' ?>"/>
                                    <button type="submit"
                                            name="<?= (isset($responseEditItem["idwastage"])) ? 'updatePost' : 'createPost' ?>"
                                            value="<?= (isset($responseEditItem["idwastage"])) ? 'updatePost' : 'createPost' ?>"
                                            class="btn btn-success btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                        <span class="text"><?= (isset($responseEditItem["idwastage"])) ? 'Update' : 'Publish' ?></span>
                                    </button>
                                    <?php
                                    if (isset($responseEditItem["idwastage"])) {
                                        ?>
                                        <a href="wastage-post.php<?= (isset($_GET['mobile_view'])) ? '?mobile_view=true' : '' ?>"
                                           class="btn btn-danger btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                            <span class="text">Discard Changes</span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once "includes/footer.php"; ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="js/common.js"></script>
<script>

    function profNeed(userType) {

        const picBox = `<label for="" class="form-label">Upload Your Proof</label><br>
                                        <span class="small">Upload your proofing documents about your company / organization</span>
                                        <div class="custom-file" id="image_file">
                                            <input type="file" class="custom-file-input" id="imageFile" name="imageFile"
                                                   aria-describedby="inputGroupFileAddon01" required>
                                            <label class="custom-file-label" for="imageFile">Choose file</label>
                                        </div>`;

        const prof = userType.options[userType.selectedIndex].dataset.prof
        const profLoad = document.getElementById('profLoad')

        if (prof != 1) {
            profLoad.innerHTML = '';

        } else {

            profLoad.innerHTML = picBox;
        }


    }
</script>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<script src="js/jquery-3.3.1.min.js"></script>


<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<?php echo '<script type="text/javascript"> cityList(' . $utils->getValue($responseEditItem, "district_id") . ',' . $utils->getValue($responseEditItem, "idcity") . '); </script>'; ?>

</body>

</html>