<?php
include_once "includes/session-validation.php";
$company_id = $_SESSION["company-id"];
$user_id = $_SESSION['user-id'];
include_once "./classes/connetion.class.php";
include_once "./classes/datacall.class.php";
include_once "./classes/utils.class.php";
$dataCalls = new datacall();
$utils = new utils();
$responseEditItem = "";
$responsePreferredUserType = "";
$responseBidding = "";
if ($utils->c_Isset("id") && !$utils->c_IsEmpty("id")) {
    $post_code = $utils->getParam("id");
    if ($utils->c_Isset("process_type") && !$utils->c_IsEmpty("process_type")) {
        $bidding_price = $utils->getParam("bidding_price");
        $bidding_message = $utils->getParam("bidding_message");
        $responseBidding = $dataCalls->createBid($post_code, $bidding_price, $bidding_message, $user_id);
        $_SESSION['response-message'] = $responseBidding;
        header("Location: ?id=" . $post_code);
    }


    $responseEditItem = $dataCalls->loadWastageSinglePost($post_code);
    $responsePreferredUserType = $dataCalls->loadPreferredUserType($post_code);
    $postStatus = $utils->getValue($responseEditItem, "status");
}

$title_1 = "Post";
$title_2 = " Details";
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


    <!--    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
    <link href="css/product_detail.css" rel="stylesheet" type="text/css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script defer src="js/product_detail.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Abel&family=Marhey:wght@700&display=swap');
    </style>
    <link href="css/common.css" rel="stylesheet" type="text/css">
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

                <main>
                    <div class="row">
                        <?= $utils->getResponseSessionMessage() ?>
                    </div>
                    <div class="row card ">
                        <div class="card-body store-body">
                            <div class="row">
                                <div class="col-md-8 product-img">
                                    <div class="product-gallery row">
                                        <div class="product-gallery-thumbnails col-md-1">
                                            <ol class="thumbnails-list list-unstyled">
                                                <li><img  class="img" src="<?= $utils->getValue($responseEditItem, "image") ?>"
                                                         alt="">
                                                </li>

                                            </ol>
                                        </div>
                                        <div class="product-gallery-featured col-md-11">
                                            <img class="img" src="<?= $utils->getValue($responseEditItem, "image") ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <?php
                                    if (!empty($postStatus)) {
                                        ?>
                                        <span class="btn btn-warning btn-block text-dark"><b><?= $utils->getValue($responseEditItem, "status") ?></b></span>
                                    <?php } ?>
                                    <h4 class="product-title mb-2"><?= $utils->getValue($responseEditItem, "title") ?></h4>
                                    <h2 class="product-price display-6">
                                        LKR. <?= number_format($utils->getValue($responseEditItem, "total_price"), 2) ?><?= ($utils->getValue($responseEditItem, "isnegotiable") == "1") ? '(Negotiable)' : '' ?></h2>
                                    <p>
                                        <i class="fa fa-calendar"></i> <?= date('M d, Y h:i A', strtotime($utils->getValue($responseEditItem, "date"))) ?>
                                    </p>
                                    <p class="mb-0"><i
                                                class="fa fa-check-circle <?= ($utils->getValue($responseEditItem, "is_delivery") == "1") ? 'text-success' : '' ?>"></i>
                                        <i class="fa fa-truck"></i> <?= ($utils->getValue($responseEditItem, "is_delivery") == "1") ? 'Delivery is available' : 'Delivery is not available' ?>
                                        <small><?= ($utils->getValue($responseEditItem, "is_delivery") == "1") ? "(Delivery Fee LKR." . number_format($utils->getValue($responseEditItem, "delivery_price"), 2) . ")" : '' ?></small>
                                    </p>
                                    <p class="mb-0"><i
                                                class="fa fa-check-circle <?= ($utils->getValue($responseEditItem, "isbidding") == "1") ? 'text-success' : '' ?>"></i>
                                        <i class="fa fa-gavel"></i> <?= ($utils->getValue($responseEditItem, "isbidding") == "1") ? 'You can bid for this items' : "You can't bid for this items" ?>
                                    </p>
                                    <p class="mb-0"><i
                                                class="fa fa-check-circle <?= ($utils->getValue($responseEditItem, "isseperate") == "1") ? 'text-success' : '' ?>"></i>
                                        <i class="fa fa-people-arrows"></i> <?= ($utils->getValue($responseEditItem, "isseperate") == "1") ? 'You can purchase partial quotients' : "You can't purchase partial quotients" ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 product-dec">
                                    <!-- /.recommended-items-->
                                    <p class="mb-5 mt-5"></p>
                                    <div class="product-description mb-3">
                                        <h2 class="mb-3">Features</h2>
                                        <dl class="row mb-3">
                                            <dt class="col-sm-3">Waste Type</dt>
                                            <dd class="col-sm-9"><?= $utils->getValue($responseEditItem, "waste_type") ?></dd>
                                            <dt class="col-sm-3">Quantity</dt>
                                            <dd class="col-sm-9"><?= $utils->getValue($responseEditItem, "qty") . ' ' . strtoupper($utils->getValue($responseEditItem, "unit")) ?></dd>
                                            <dt class="col-sm-3">Contact No</dt>
                                            <dd class="col-sm-9"><?= $utils->getValue($responseEditItem, "contact_no") ?></dd>
                                            <dt class="col-sm-3">Area</dt>
                                            <dd class="col-sm-9"><?= $utils->getValue($responseEditItem, "district_name") . ',', $utils->getValue($responseEditItem, "city_name") ?></dd>
                                            <dt class="col-sm-3">Pick-Up Address</dt>
                                            <dd class="col-sm-9"><?= $utils->getValue($responseEditItem, "pick_up_address") ?></dd>
                                        </dl>
                                        <h2 class="mb-3">Description</h2>
                                        <p><?= $utils->getValue($responseEditItem, "description") ?></p>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-12 col-lg-12">
                                            <div id="tracking">
                                                <div class="text-center tracking-status-intransit">
                                                    <p class="tracking-status text-tight">Current status of the item</p>
                                                </div>
                                                <div class="tracking-list">
                                                    <?php
                                                    $sDate = date('Y-m-d H:i', strtotime($utils->getValue($responseEditItem, "date")));
                                                    foreach ($responsePreferredUserType as $value) {
                                                        try {
                                                            $datetime = new DateTime($sDate);

                                                            $datetime->add(new DateInterval('PT' . $value["preferred_time"] . 'H'));

                                                            $textStyle = "";
                                                            $currentDateTime = date('Y-m-d H:i');
                                                            $dateBegin = date('Y-m-d H:i', strtotime($sDate));
                                                            $dateEnd = date('Y-m-d H:i', strtotime($datetime->format('Y-m-d H:i')));


                                                            if (($currentDateTime >= $dateBegin) && ($currentDateTime <= $dateEnd)) {
                                                                $textStyle = "color:#28B463";
                                                            } else {
                                                                $textStyle = "color:#858796";
                                                            }
                                                        } catch (Exception $e) {
                                                        }
                                                        ?>
                                                        <div class="tracking-item">
                                                            <div class="tracking-icon status-intransit">
                                                                <img src="<?= $value["user_type_image"] ?>" class="img"
                                                                     style="height: 10px;">
                                                            </div>
                                                            <div class="tracking-date" style="<?= $textStyle ?>">
                                                                <b><?= $datetime->format('M d, Y') ?></b><span
                                                                        style="<?= $textStyle ?>"><b><?= $datetime->format('h:i A') ?></b></span>
                                                            </div>
                                                            <div class="tracking-content" style="<?= $textStyle ?>">
                                                                <b><?= $value["type"] ?></b><span
                                                                        style="<?= $textStyle ?>">This item only valid <?= $value["preferred_time"] ?> from <?= date('M d, Y h:i A', strtotime($sDate)) ?></span>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $sDate = $dateEnd;
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-2">
                                        <div class="card-header buy-thur-call-header">Buy Thur Call</div>
                                        <div class="card-body  buy-thur-call-body">
                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                    <a href="tel:<?= $utils->getValue($responseEditItem, "contact_no") ?>"
                                                       class="btn btn-block btn-success"><i
                                                                class="fa fa-phone"></i>
                                                        <?= $utils->getValue($responseEditItem, "contact_no") ?>
                                                    </a>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <span>PickUp Address
                                                        : <?= $utils->getValue($responseEditItem, "pick_up_address") ?></span>
                                                    <a href="http://maps.google.co.in/maps?q=<?= $utils->getValue($responseEditItem, "pick_up_address") ?>"
                                                       class="btn btn-block btn-success m-0">Open in Map</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if (empty($postStatus)) {
                                        ?>
                                        <div class="card mb-2">
                                            <div class="card-header buy-online-header">Buy Online</div>
                                            <div class="card-body buy-online-body" style="display: none">
                                                <div class="row">
                                                    <form action="step2.php<?= (isset($_GET['mobile_view'])) ? '?mobile_view=true' : '' ?>"
                                                          method="POST">
                                                        <div class="col-sm-12 mb-3">
                                                            <input type="hidden" id="buy-online-wholesale-price"
                                                                   value="<?= $utils->getValue($responseEditItem, "total_price") ?>"/>
                                                            <input type="hidden" id="buy-online-delivery_price"
                                                                   value="<?= $utils->getValue($responseEditItem, "delivery_price") ?>"/>
                                                            <table class="w-100">
                                                                <tr>
                                                                    <td class="w-75">QTY</td>
                                                                    <td class="text-right"><?= $utils->getValue($responseEditItem, "qty") . ' ' . strtoupper($utils->getValue($responseEditItem, "unit")) ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="w-75">Wholesale Price</td>
                                                                    <td class="text-right"><?= number_format($utils->getValue($responseEditItem, "total_price"), 2) ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="w-75">
                                                                        <label for="" class="form-label">Discount (Enter
                                                                            you
                                                                            coupon code if you have)</label>

                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control"
                                                                                   id="buy-online-discount"
                                                                                   placeholder="WXXXXXXXXXXXX"
                                                                                   name="discount_coupon">
                                                                            <div class="input-group-append">
                                                                                <button class="btn btn-success"
                                                                                        type="button"
                                                                                        onclick="checkDiscount('<?= $post_code ?>','buy-online-wholesale-price','buy-online-delivery_price','buy-online-discount','buy-online-discount-text','buy-online-discount-status','buy-online-total')">
                                                                                    Check
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div id="buy-online-discount-status"></div>
                                                                    </td>
                                                                    <td class="text-right"
                                                                        id="buy-online-discount-text">
                                                                        0%<br>0.00
                                                                    </td>
                                                                </tr>

                                                                <?php
                                                                if ($utils->getValue($responseEditItem, "is_delivery") == "1") {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="w-75">Delivery</td>
                                                                        <td class="text-right"><?= number_format($utils->getValue($responseEditItem, "delivery_price"), 2) ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td class="w-75">Total Price</td>
                                                                    <td class="border-top border-bottom text-right"
                                                                        id="buy-online-total"><?= number_format(($utils->getValue($responseEditItem, "total_price") + $utils->getValue($responseEditItem, "delivery_price")), 2) ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <input type="hidden" value="buy_online"
                                                                   name="process_type"/>
                                                            <input type="hidden" value="<?= $post_code ?>"
                                                                   name="post_code"/>
                                                            <button type="submit" class="btn btn-block btn-success"><i
                                                                        class="fa fa-gavel"></i>
                                                                Pay Now
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($utils->getValue($responseEditItem, "isbidding") == "1") { ?>
                                            <div class="card mb-2">
                                                <div class="card-header bidding-area-header">Bidding Area</div>
                                                <div class="card-body bidding-area-body" style="display: none">
                                                    <?php
                                                    $responseIsAlreadyBid = $dataCalls->isAlreadyBid($user_id, $post_code);

                                                    ?>
                                                    <p class="text-success">
                                                        <b><?= ($responseIsAlreadyBid != "") ? 'You already submit your bid at (' . $utils->getValue($responseIsAlreadyBid, "created_by") . ')' : '' ?></b>
                                                    </p>
                                                    <form action="product_detail.php<?= (isset($_GET['mobile_view'])) ? '?mobile_view=true' : '' ?>"
                                                          method="POST">
                                                        <div class="row">
                                                            <div class="col-sm-12 form-group required">
                                                                <label for="" class="form-label">Bidding Price</label>
                                                                <input type="text" name="bidding_price"
                                                                       class="form-control cmpRg"
                                                                       required
                                                                       value="<?= $utils->getValue($responseIsAlreadyBid, "price") ?>"
                                                                       autocomplete="off" <?= ($responseIsAlreadyBid != "") ? 'disabled' : '' ?>>
                                                            </div>
                                                            <div class="col-sm-12 form-group">
                                                                <label for="" class="form-label">Message</label>
                                                                <textarea type="text" name="bidding_message"
                                                                          class="form-control cmpRg"
                                                                          style="height: 150px"
                                                                          autocomplete="off" <?= ($responseIsAlreadyBid != "") ? 'disabled' : '' ?>><?= $utils->getValue($responseIsAlreadyBid, "remark") ?></textarea>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <input type="hidden" value="bidding"
                                                                       name="process_type"/>
                                                                <input type="hidden" value="<?= $post_code ?>"
                                                                       name="id"/>
                                                                <?php if ($responseIsAlreadyBid == "") { ?>
                                                                    <button type="submit"
                                                                            class="btn btn-block btn-success"><i
                                                                                class="fa fa-gavel"></i>
                                                                        Submit Your Request
                                                                    </button>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <p class="<?= ($utils->getValue($responseIsAlreadyBid, "status") == "0") ? 'text-warning' : 'text-success' ?>">
                                                        <b><?= ($responseIsAlreadyBid != "") ? 'Bid Status: ' . (($utils->getValue($responseIsAlreadyBid, "status") == "0") ? 'Not Selected Yet' : 'Selected') : '' ?></b>
                                                    </p>

                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($utils->getValue($responseEditItem, "isseperate") == "1") { ?>
                                            <div class="card mb-2">
                                                <div class="card-header buy-partially-header">Buy Partially</div>
                                                <div class="card-body buy-partially-body" style="display: none">
                                                    <div class="row">
                                                        <form action="step2.php<?= (isset($_GET['mobile_view'])) ? '?mobile_view=true' : '' ?>"
                                                              method="POST">
                                                            <div class="col-sm-12 form-group required">
                                                                <label for="" class="form-label">Quantity (Min.Qty
                                                                    : <?= $utils->getValue($responseEditItem, "seperate_min_qty") ?>
                                                                    )</label>
                                                                <input type="text" name="partiallyQty"
                                                                       class="form-control cmpRg"
                                                                       required
                                                                       autocomplete="off" id="buy-partially-qty-value"
                                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                                <small class="text-danger"
                                                                       id="buy-partially-status"></small>
                                                                <input type="hidden" id="buy-partially-min-qty"
                                                                       value="<?= $utils->getValue($responseEditItem, "seperate_min_qty") ?>">
                                                                <input type="hidden" id="buy-partially-max-qty"
                                                                       value="<?= $utils->getValue($responseEditItem, "qty") ?>">
                                                                <input type="hidden" id="buy-partially-unit-price"
                                                                       value="<?= $utils->getValue($responseEditItem, "unit_price") ?>">
                                                                <input type="hidden" id="buy-partially-delivery_price"
                                                                       value="<?= $utils->getValue($responseEditItem, "delivery_price") ?>"/>
                                                                <input type="hidden" id="buy-partially-sub-total"
                                                                       value="0.00">
                                                            </div>
                                                            <div class="col-sm-12 mb-3">
                                                                <table class="w-100">
                                                                    <tr>
                                                                        <td class="w-75">Unit Price</td>
                                                                        <td class="text-right"><?= number_format($utils->getValue($responseEditItem, "unit_price"), 2) ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="w-75">QTY</td>
                                                                        <td class="text-right"
                                                                            id="buy-partially-qty-text">0
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="w-75">Sub Total</td>
                                                                        <td class="border-top border-bottom text-right"
                                                                            id="buy-partially-sub-total-text">0.00
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td class="w-75">
                                                                            <label for="" class="form-label">Discount
                                                                                (Enter you
                                                                                coupon code if you have)</label>

                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control"
                                                                                       id="buy-partially-discount"
                                                                                       placeholder="WXXXXXXXXXXXX"
                                                                                       name="discount_coupon"
                                                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                                                <div class="input-group-append">
                                                                                    <button class="btn btn-success"
                                                                                            type="button"
                                                                                            onclick="checkDiscount('<?= $post_code ?>','buy-partially-sub-total','buy-partially-delivery_price','buy-partially-discount','buy-partially-discount-text','buy-partially-discount-status','buy-partially-total')">
                                                                                        Check
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div id="buy-partially-discount-status">
                                                                                <small
                                                                                        class="text-success">Discount
                                                                                    Applied</small></div>
                                                                        </td>
                                                                        <td class="text-right"
                                                                            id="buy-partially-discount-text">
                                                                            0%
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    if ($utils->getValue($responseEditItem, "is_delivery") == "1") {
                                                                        ?>
                                                                        <tr>
                                                                            <td class="w-75">Delivery</td>
                                                                            <td class="text-right"><?= number_format($utils->getValue($responseEditItem, "delivery_price"), 2) ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <tr>
                                                                        <td class="w-75">Total</td>
                                                                        <td class="border-top border-bottom text-right"
                                                                            id="buy-partially-total">0.00
                                                                        </td>
                                                                    </tr>
                                                                </table>


                                                            </div>
                                                            <div class="col-sm-12">
                                                                <input type="hidden" value="buy_partially"
                                                                       name="process_type"/>
                                                                <input type="hidden" value="<?= $post_code ?>"
                                                                       name="post_code"/>
                                                                <button type="submit" class="btn btn-block btn-success"
                                                                        id="buy-partially-btn-pay-now" disabled><i
                                                                            class="fa fa-gavel"></i>
                                                                    Pay Now
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="product-info">

                                <div class="product-seller-recommended">


                                </div>
                            </div>
                            <div class="product-payment-details">
                                <!-- <p class="last-sold text-muted"><small>145 items sold</small></p> -->

                            </div>
                        </div>


                    </div>

                </main>

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

<!-- Bootstrap core JavaScript-->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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

<script src="js/product_page.js"></Script>

</body>

</html>