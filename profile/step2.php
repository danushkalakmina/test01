<?php
include_once "includes/session-validation.php";
$company_id = $_SESSION["company-id"];
include_once "./classes/connetion.class.php";
include_once "./classes/datacall.class.php";
include_once "./classes/utils.class.php";
$dataCalls = new datacall();
$utils = new utils();
$responsePost = "";
$process_type = "";
$responseDiscount = "";
$partiallyQty = "";
$bidding_no = "";
if ($utils->c_Isset("post_code") && !$utils->c_IsEmpty("post_code")) {
    $post_code = $utils->getParam("post_code");
    $discount_coupon = $utils->getParam("discount_coupon");
    $process_type = $utils->getParam("process_type");
    $partiallyQty = $utils->getParam("partiallyQty");
    $bidding_no = $utils->getParam("bidding_no");
    $responsePost = $dataCalls->loadWastageSinglePost($post_code);
    $responseDiscount = $dataCalls->checkDiscount($post_code, $discount_coupon, $utils->getValue($responsePost, "total_price"), $utils->getValue($responsePost, "delivery_price"));
}

$title_1 = "Order";
$title_2 = " Confirmation";
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
    <link href="css/product_page.css" rel="stylesheet" type="text/css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
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

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Product Details</h1>
                <main>

                    <div class="row card ">
                        <div class="card-body store-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    if ($process_type == "buy_partially") {
                                        $subTotal = ($utils->getValue($responsePost, "unit_price") * $partiallyQty);
                                        $responseDiscount = $dataCalls->checkDiscount($post_code, $discount_coupon, $subTotal,$utils->getValue($responsePost, "delivery_price"));
                                        ?>
                                        <div class="card mb-2">
                                            <div class="card-header buy-partially-header">Buy Partially</div>
                                            <div class="card-body buy-partially-body">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-3">
                                                        <table class="w-100">
                                                            <tr>
                                                                <td class="w-75 pb-2"></td>
                                                                <td class="text-right">LKR</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-75 pb-2">Unit Price</td>
                                                                <td class="text-right"><?= number_format($utils->getValue($responsePost, "unit_price"), 2) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-75 pb-2">QTY</td>
                                                                <td class="text-right"
                                                                    id="buy-partially-qty-text"><?= $partiallyQty ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-75 pb-2">Sub Total</td>
                                                                <td class="border-top text-right"
                                                                    id="buy-partially-sub-total-text"><?= number_format($subTotal, 2) ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-75 pb-2">Discount <?=(!empty($discount_coupon) ? '('.$discount_coupon.')' : '')?></td>
                                                                <td class="text-right"
                                                                    id="buy-partially-discount-text"><?= $utils->getValue($responseDiscount, "discountPercentage") ?>
                                                                    %<br><?= number_format($utils->getValue($responseDiscount, "discountValue"), 2) ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-75 pb-2">Sub Total</td>
                                                                <td class="border-top border-bottom text-right"
                                                                    id="buy-partially-total"><?= number_format($utils->getValue($responseDiscount, "sub_total"), 2) ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            if($utils->getValue($responsePost, "is_delivery")=="1"){
                                                                ?>
                                                                <tr>
                                                                    <td class="w-75 pb-2">Delivery</td>
                                                                    <td class="text-right"><?= number_format($utils->getValue($responsePost, "delivery_price"), 2) ?></td>
                                                                </tr>

                                                                <td class="w-75 pb-2">Total</td>
                                                                <td class="border-top double-line-bottom text-right"
                                                                    id="buy-partially-total"><?= number_format($utils->getValue($responseDiscount, "total"), 2) ?>
                                                                </td>
                                                            <?php }?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else if ($process_type == "buy_online") { ?>
                                        <div class="card mb-2">
                                            <div class="card-header buy-partially-header">Buy Online</div>
                                            <div class="card-body buy-partially-body">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-3">
                                                        <table class="w-100">
                                                            <tr>
                                                                <td class="w-75 pb-2"></td>
                                                                <td class="text-right">LKR</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-75 pb-2">QTY</td>
                                                                <td class="text-right"
                                                                    id="buy-partially-qty-text"><?= $utils->getValue($responsePost, "qty") . ' ' . strtoupper($utils->getValue($responsePost, "unit")) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-75 pb-2">Wholesale Price</td>
                                                                <td class="text-right"><?= number_format($utils->getValue($responsePost, "total_price"), 2) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-75 pb-2">Discount <?=(!empty($discount_coupon) ? '('.$discount_coupon.')' : '')?></td>
                                                                <td class="text-right"
                                                                    id="buy-partially-discount-text"><?= $utils->getValue($responseDiscount, "discountPercentage") ?>
                                                                    %<br>-(<?= number_format($utils->getValue($responseDiscount, "discountValue"), 2) ?>)
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-75 pb-2">Sub Total</td>
                                                                <td class="border-top <?=($utils->getValue($responsePost, "is_delivery")=="0")?'double-line-bottom':''?> text-right"
                                                                    id="buy-partially-total"><?= number_format($utils->getValue($responseDiscount, "sub_total"), 2) ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            if($utils->getValue($responsePost, "is_delivery")=="1"){
                                                                ?>
                                                                <tr>
                                                                    <td class="w-75 pb-2">Delivery</td>
                                                                    <td class="text-right"><?= number_format($utils->getValue($responsePost, "delivery_price"), 2) ?></td>
                                                                </tr>

                                                                <td class="w-75 pb-2">Total</td>
                                                                <td class="border-top double-line-bottom text-right"
                                                                    id="buy-partially-total"><?= number_format($utils->getValue($responseDiscount, "total"), 2) ?>
                                                                </td>
                                                            <?php }?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else if ($process_type == "select_bid") {
                                        $responseBidDetails = $dataCalls->checkBidDetails($bidding_no);
                                        ?>
                                        <div class="card mb-2">
                                            <div class="card-header buy-partially-header">Bid</div>
                                            <div class="card-body buy-partially-body">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-3">
                                                        <table class="w-100">
                                                            <tr>
                                                                <td class="w-75 pb-2"></td>
                                                                <td class="text-right">LKR</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-75 pb-2">QTY</td>
                                                                <td class="text-right"
                                                                    id="buy-partially-qty-text"><?= $utils->getValue($responseBidDetails, "qty") . ' ' . strtoupper($utils->getValue($responsePost, "unit")) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-75 pb-2">Bid Price</td>
                                                                <td class="text-right"><?= number_format($utils->getValue($responseBidDetails, "bid_price"), 2) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-75 pb-2">Sub Total</td>
                                                                <td class="border-top <?=($utils->getValue($responsePost, "is_delivery")=="0")?'double-line-bottom':''?> text-right"
                                                                    id="buy-partially-total"><?= number_format($utils->getValue($responseBidDetails, "bid_price"), 2) ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            if($utils->getValue($responsePost, "is_delivery")=="1"){
                                                                ?>
                                                                <tr>
                                                                    <td class="w-75 pb-2">Delivery</td>
                                                                    <td class="text-right"><?= number_format($utils->getValue($responseBidDetails, "delivery_price"), 2) ?></td>
                                                                </tr>

                                                                <td class="w-75 pb-2">Total</td>
                                                                <td class="border-top double-line-bottom text-right"
                                                                    id="buy-partially-total"><?= number_format($utils->getValue($responseBidDetails, "total"), 2) ?>
                                                                </td>
                                                            <?php }?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-12">
                                    <div class="card mb-2">
                                        <div class="card-header buy-partially-header">Billing Area</div>
                                        <div class="card-body buy-partially-body">
                                            <form action="step3.php" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-3">
                                                        <div class="row">
                                                            <div class="col-sm form-group required">
                                                                <label for="" class="form-label">First Name</label>
                                                                <input type="text" name="first_name" id="" class="form-control cmpRg" required autocomplete="off">
                                                            </div>
                                                            <div class="col-sm form-group required">
                                                                <label for="" class="form-label">Last Name</label>
                                                                <input type="text" name="last_name" id="" class="form-control cmpRg" required autocomplete="off">
                                                            </div>
                                                            <div class="col-sm form-group required">
                                                                <label for="" class="form-label">Email</label>
                                                                <input type="text" name="email" id="" class="form-control cmpRg" required autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm form-group required">
                                                                <label for="" class="form-label">Billing Address</label>
                                                                <textarea type="text" name="billing_address" class="form-control cmpRg"
                                                                          style="height: 100px" required
                                                                          autocomplete="off"></textarea>
                                                            </div>
                                                            <?php
                                                            if($utils->getValue($responsePost, "is_delivery")=="1"){
                                                                ?>
                                                                <div class="col-sm form-group required">
                                                                    <label for="" class="form-label">Delivery Address</label>
                                                                    <textarea type="text" name="delivery_address" class="form-control cmpRg"
                                                                              style="height: 100px"
                                                                              autocomplete="off" required></textarea>
                                                                </div>
                                                            <?php }?>
                                                            <div class="col-sm form-group">
                                                                <label for="" class="form-label">Billing Note</label>
                                                                <textarea type="text" name="billing_note" class="form-control cmpRg"
                                                                          style="height: 100px"
                                                                          autocomplete="off"></textarea>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm form-group required">
                                                                <label for="" class="form-label">Credit / Debit Card Number</label>
                                                                <input type="text" id="" class="form-control cmpRg" oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="···· ···· ···· ····" required autocomplete="off">
                                                            </div>
                                                            <div class="col-sm form-group required">
                                                                <label for="" class="form-label">Security Code</label>
                                                                <input type="text" id="" placeholder="CVC" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control cmpRg" required autocomplete="off">
                                                            </div>
                                                            <div class="col-sm form-group required">
                                                                <label for="" class="form-label">Card Expiration</label>
                                                                <input type="text" id="" placeholder="MM / YY" class="form-control cmpRg" required autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="post_code" value="<?=$post_code?>">
                                                        <input type="hidden" name="discount_coupon" value="<?=$discount_coupon?>">
                                                        <input type="hidden" name="process_type" value="<?=$process_type?>">
                                                        <input type="hidden" name="partiallyQty" value="<?=$partiallyQty?>">
                                                        <input type="hidden" name="bidding_no" value="<?=$bidding_no?>">
                                                        <input type="submit" class="btn btn-success" value="Submit Order"/>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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