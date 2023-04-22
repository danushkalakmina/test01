<?php
include_once "includes/session-validation.php";
$company_id = $_SESSION["company-id"];
include_once "./classes/connetion.class.php";
include_once "./classes/datacall.class.php";
include_once "./classes/utils.class.php";
$dataCalls = new datacall();
$utils = new utils();
if ($utils->c_Isset("changeStatus") && !$utils->c_IsEmpty("changeStatus")) {
    $post_code = $utils->getParam("post_code");
    $change_status = $utils->getParam("changeStatus");
    $responseText = $dataCalls->updatePostStatus($post_code, $change_status, $company_id);
}
$current_page_no = ($utils->c_Isset("page_no") && !empty($utils->getParam("page_no"))) ? $utils->getParam("page_no") : "1";
$post_limit = 10;
$wastagePostsList = $dataCalls->loadWastagePosts($company_id, $current_page_no, $post_limit);
$number_of_page = $dataCalls->getWastagePostsPageCount($company_id, $post_limit);

$title_1 = "My";
$title_2 = " Posts";
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

    <title>Wastey : <?= $title_1 . $title_2 ?></title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script defer src="js/registation.js"></script>
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <style>

        .post-image {
            height: 180px;
            overflow: hidden;
            display: flex;
            justify-content: center;
        }

    </style>
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

                        <?php if (empty($wastagePostsList)) { ?>
                            <div class="row pt-1">
                                <div class="col-sm-8">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="card-body text-center p-3">
                                                <i class="fas fa-ad fa-6x"></i><br>
                                                <b>No Posts Yet</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            foreach ($wastagePostsList as $result) {
                                $number_of_bids = $dataCalls->getBidCount($result["idwastage"], $company_id);
                                $number_of_orders = $dataCalls->getOrderCount($result["idwastage"], $company_id);
                                ?>
                                <div class="row pt-1">
                                    <div class="col-sm-8">
                                        <div class="card">
                                            <div class="row no-gutters">
                                                <div class="col-sm-3">
                                                    <img class="card-img img-fluid img-rounded post-image"
                                                         src="<?= $result["image"] ?>"
                                                         alt="Suresh Dasari Card">
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="card-body p-3">
                                                        <div style="height: 100%">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <small>#<?= $result["idwastage"] ?></small></div>
                                                                <div class="col-sm-6 text-right">
                                                                    <small><?= $result["date"] ?></small></div>
                                                            </div>
                                                            <h5 class="card-title mt-1 mb-1"><?= $result["title"] ?></h5>
                                                            <p class="card-text mt-1 mb-1"><?= mb_strimwidth($result["description"], 0, 130, "...") ?></p>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <h6 class="mt-1 mb-1">
                                                                        <b>LKR. <?= number_format($result["total_price"], 2) ?></b>
                                                                    </h6>
                                                                </div>
                                                                <div class="col-sm-6 text-right">
                                                                    <h6 class="mt-1 mb-1">
                                                                        Balance.QTY : <?= $result["balance_qty"] ?>
                                                                    </h6>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <?php
                                                            if ($utils->getValue($result, "isbidding") == "1") {
                                                                ?>
                                                                <a href="biding.php?id=<?= $result["idwastage"] ?>"
                                                                   class="btn btn-sm btn-info ml-1 mt-1">Biding <span
                                                                            class="badge badge-light"><?= $number_of_bids ?></span></a>
                                                            <?php } ?>
                                                            <a href="orders.php?id=<?= $result["idwastage"] ?>"
                                                               class="btn btn-sm btn-info ml-1 mt-1">Orders <span
                                                                        class="badge badge-light"><?= $number_of_orders ?></span></a>
                                                            <a href="post-fucntions.php?id=<?= $result["idwastage"] ?>"
                                                               class="btn btn-sm btn-dark ml-1 mt-1">Discount</a>
                                                            <a href="post-fucntions.php?id=<?= $result["idwastage"] ?>"
                                                               class="btn btn-sm btn-primary ml-1 mt-1">Update
                                                                Status</a>
                                                            </button>
                                                            <form class="ml-1 mt-1"
                                                                  action="wastage-post.php<?= (isset($_GET['mobile_view'])) ? '?mobile_view=true' : '' ?>"
                                                                  method="POST">
                                                                <input type="hidden" name="post_code"
                                                                       value="<?= $result["idwastage"] ?>"/>
                                                                <button type="submit" name="edit"
                                                                        class="btn btn-sm btn-primary btn-block">Edit
                                                                </button>
                                                            </form>
                                                            <form class="ml-1 mt-1"
                                                                  action="my-wastage-posts.php<?= (isset($_GET['mobile_view'])) ? '?mobile_view=true' : '' ?>"
                                                                  method="POST">
                                                                <input type="hidden" name="post_code"
                                                                       value="<?= $result["idwastage"] ?>"/>
                                                                <?= $utils->getWastagePostStatusButton($result["status"]) ?>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-sm-9 m-3">
                                <div class="row justify-content-center">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item" <?= ($current_page_no == "1") ? 'disabled' : '' ?>>
                                                <a class="page-link"
                                                   href="my-wastage-posts.php?page_no=<?= $current_page_no - 1 ?>">Previous</a>
                                            </li>
                                            <?php
                                            for ($page = 1; $page <= $number_of_page; $page++) {
                                                ?>
                                                <li class="page-item"><a class="page-link"
                                                                         href="my-wastage-posts.php?page_no=<?= $page ?>"><?= $page ?></a>
                                                </li>
                                            <?php } ?>
                                            <li class="page-item"><a class="page-link"
                                                                     href="my-wastage-posts.php?page_no=<?= $current_page_no + 1 ?>">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        <?php } ?>
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

</body>

</html>



