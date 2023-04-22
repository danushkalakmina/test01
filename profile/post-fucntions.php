<?php
include_once "includes/session-validation.php";
$company_id = $_SESSION["company-id"];
$user_id = $_SESSION['user-id'];
include_once "./classes/connetion.class.php";
include_once "./classes/datacall.class.php";
include_once "./classes/utils.class.php";
$dataCalls = new datacall();
$utils = new utils();
$responseCreateDiscount = "";
$postStatusMessage = "";

if ($utils->c_Isset("createDiscount") && !$utils->c_IsEmpty("createDiscount")) {
    $post_code = $utils->getParam("id");
    $discount_coupon_code = $utils->getParamVal("discount_coupon_code");
    $discount_percentage = $utils->getParamVal("discount_percentage");
    $responseCreateDiscount = $dataCalls->createDiscount($post_code, $discount_percentage);
}else if ($utils->c_Isset("changeStatus") && !$utils->c_IsEmpty("changeStatus")) {
    $post_code = $utils->getParam("id");
    $post_status = $utils->getParam("post_status");
    $responseStatusChange = $dataCalls->updatePostStatusNo($post_code, $post_status, $company_id);
}

if ($utils->c_Isset("id") && !$utils->c_IsEmpty("id")) {
    $post_code = $utils->getParam("id");
    $responsePost = $dataCalls->loadWastageSinglePost($post_code);
    $responseDiscount = $dataCalls->loadAllDiscounts($company_id, $post_code);
    $nextCouponID = $dataCalls->getNewID("discount", "discount_code", "D");
    if($utils->getValue($responsePost, "post_status")=="2"){
        $postStatusMessage = $utils->getMessageBar("Can't change post status. Still Admin reviewing this post.", "w");
    }else if($utils->getValue($responsePost, "post_status")=="3"){
        $postStatusMessage = $utils->getMessageBar("Can't change post status. Admin disabled this post. Please contact admin team.", "e");
    }
}

$title_1 = "Post";
$title_2 = " Action";
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
                <main>
                    <div class="row pt-1 mb-2 justify-content-center">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-sm-3">
                                        <img class="card-img img-fluid img-rounded post-image"
                                             src="<?= $responsePost["image"] ?>"
                                             alt="Suresh Dasari Card">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="card-body p-3">
                                            <div style="height: 100%">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <small>#<?= $responsePost["idwastage"] ?></small></div>
                                                    <div class="col-sm-6 text-right">
                                                        <small><?= $responsePost["date"] ?></small></div>
                                                </div>
                                                <h5 class="card-title mt-1 mb-1"><?= $responsePost["title"] ?></h5>
                                                <p class="card-text mt-1 mb-1"><?= mb_strimwidth($responsePost["description"], 0, 130, "...") ?></p>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h6 class="mt-1 mb-1">
                                                            <b>LKR. <?= number_format($responsePost["total_price"], 2) ?></b>
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        <h6 class="mt-1 mb-1">
                                                            Balance.QTY : <?= $responsePost["balance_qty"] ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Discounts</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?= (isset($responseCreateDiscount)) ? $responseCreateDiscount : '' ?>
                            </div>
                            <form action="post-fucntions.php?id=<?= $post_code ?>" method="post">
                                <div class="row">
                                    <div class="col-sm form-group required">
                                        <label for="" class="form-label">Coupon Code</label>
                                        <input type="text" name="discount_coupon_code" id="" class="form-control cmpRg"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '');" minlength="10"
                                               maxlength="10" value="<?= $nextCouponID ?>"
                                               required autocomplete="off" disabled>
                                    </div>
                                    <div class="col-sm form-group required">
                                        <label for="" class="form-label">Percentage</label>
                                        <input type="text" name="discount_percentage" id="" class="form-control cmpRg"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '');" minlength="10"
                                               maxlength="10"
                                               required autocomplete="off">
                                    </div>

                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12 text-right">
                                        <input type="hidden" name="id" value="<?= $post_code ?>">
                                        <button type="submit" class="btn btn-success"
                                                name="createDiscount"
                                                value="createDiscount"
                                                id="buy-partially-btn-pay-now">
                                            <i class="fas fa-check"></i>
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Coupon Code</th>
                                        <th>Percentage</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Bid No</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    <?php
                                    foreach ($responseDiscount as $result) {
                                        ?>
                                        <tr>
                                            <td><?= $result["discount_code"] ?></td>
                                            <td><?= $result["percentage"] ?>%</td>
                                            <td>
                                                <div class="row pl-2 pr-2">
                                                    <form action="post-fucntions.php" method="POST">
                                                        <input type="hidden" name="discount_id"
                                                               value="<?= $result["discount_code"] ?>"/>
                                                        <?= $utils->getDiscountStatusButton($result["status"]) ?>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Update Post Status</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?= (isset($responseStatusChange)) ? $responseStatusChange : '' ?>
                            </div>

                            <form action="post-fucntions.php?id=<?= $post_code ?>" method="post">
                                <div class="row">
                                    <div class="col-sm-12 form-group required">
                                        <label for="" class="form-label">Status</label>
                                        <select name="post_status" class="form-select form-control datadetails" <?= (!empty($postStatusMessage))?'disabled':''?>>
                                            <option value="0" <?= $utils->getSelectTagValue($responsePost, "post_status", "0") ?>>Inactive Post</option>
                                            <option value="1" <?= $utils->getSelectTagValue($responsePost, "post_status", "1") ?>>Active Post</option>
                                            <option value="2" <?= $utils->getSelectTagValue($responsePost, "post_status", "2") ?> disabled>Post In-Review</option>
                                            <option value="3" <?= $utils->getSelectTagValue($responsePost, "post_status", "3") ?> disabled>Disabled</option>
                                            <option value="4" <?= $utils->getSelectTagValue($responsePost, "post_status", "4") ?>>Sold</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                    <?=$postStatusMessage?>
                                    </div>
                                </div>
                                <?php if(empty($postStatusMessage)){?>
                                <div class="row mb-2">
                                    <div class="col-sm-12 text-right">
                                        <input type="hidden" name="id" value="<?= $post_code ?>">
                                        <button type="submit" class="btn btn-success"
                                                name="changeStatus"
                                                value="changeStatus"
                                                id="buy-partially-btn-pay-now">
                                            <i class="fas fa-check"></i>
                                            Update
                                        </button>
                                    </div>
                                </div>
                                <?php }?>

                            </form>
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

<script src="js/common.js"></script>
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

<script>
    function PrintElem(elem) {

        var divToPrint = document.getElementById(elem);

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);

    }
</script>

</body>

</html>