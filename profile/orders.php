<?php
include_once "includes/session-validation.php";
$company_id = $_SESSION["company-id"];
$user_id = $_SESSION['user-id'];
include_once "./classes/connetion.class.php";
include_once "./classes/datacall.class.php";
include_once "./classes/utils.class.php";
$dataCalls = new datacall();
$utils = new utils();
$searchFilter = "";

if ($utils->c_Isset("idinvoice") && !$utils->c_IsEmpty("idinvoice")) {
    $idinvoice = $utils->getParam("idinvoice");
    $status_name = $utils->getParam("status_name");
    $responseDiscount = $dataCalls->updateDeliveryTracker($idinvoice, $status_name);
    header("Location: #");
}
$responseOrders = $dataCalls->loadAllOrders($company_id,"");
if ($utils->c_Isset("id") && !$utils->c_IsEmpty("id")) {
    $post_id = $utils->getParam("id");
    $searchFilter = "Search By : Post ID : ".$post_id;
    $responseOrders = $dataCalls->loadAllOrders($company_id,$post_id);
}

$title_1 = "Order";
$title_2 = " History";
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
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <?php if(!empty($searchFilter)){?>
                            <span class="btn btn-secondary btn-sm mb-2"><?=$searchFilter?><a href="orders.php" class="btn btn-sm text-warning">X</a></span>
                           <?php }?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Post No</th>
                                        <th>Invoice Date</th>
                                        <th>Delivery Address</th>
                                        <th>Billing Note</th>
                                        <th>Tracker Last Update</th>
                                        <th>Tracker Status</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Post No</th>
                                        <th>Invoice Date</th>
                                        <th>Delivery Address</th>
                                        <th>Billing Note</th>
                                        <th>Tracker Last Update</th>
                                        <th>Tracker Status</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    <?php
                                    foreach ($responseOrders as $result) {
                                        ?>
                                        <tr>
                                            <td><a href="invoice.php?id=<?= $result["idinvoice"] ?>"
                                                   class="btn btn-primary btn-sm  w-100"><?= $result["idinvoice"] ?><br>View
                                                    Invoice</a></td>
                                            <td><a href="product_detail.php?id=<?= $result["idwastage"] ?>"
                                                   class="btn btn-success btn-sm w-100 mb-1"><?= $result["idwastage"] ?>
                                                    <br>View Post</a></td>
                                            <td><?= $result["inv_date"] ?></td>
                                            <td><?= $result["delivery_address"] ?></td>
                                            <td><?= $result["billing_note"] ?></td>
                                            <td><?= $result["tracker_date"] ?></td>
                                            <td>
                                                <form action="orders.php" method="post">
                                                    <input type="hidden" value="<?= $result["idinvoice"] ?>"
                                                           name="idinvoice">
                                                    <input type="hidden" value="<?= $result["status_name"] ?>"
                                                           name="status_name">
                                                    <button type="submit"
                                                            class="btn <?= ($result["status_name"] == "Delivered") ? 'btn-success  text-white' : 'btn-warning text-dark' ?> " <?= ($result["status_name"] == "Delivered") ? 'disabled' : '' ?>><?= $result["status_name"] ?>
                                                        <i class="fa <?= ($result["status_name"] == "Delivered") ? 'fa-check' : 'fa-arrow-right' ?>"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <label class="display-4"><b>Order Delivery Flow</b></label>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <span class="btn btn-warning btn-sm">Order Request Send To Seller</span>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <i class="fa fa-arrow-down"></i>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <span class="btn btn-warning btn-sm">Request Processing</span>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <i class="fa fa-arrow-down"></i>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <span class="btn btn-warning btn-sm">Packaging</span>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <i class="fa fa-arrow-down"></i>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <span class="btn btn-primary btn-sm">Ready to Delivery</span>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <i class="fa fa-arrow-down"></i>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <span class="btn btn-primary btn-sm">Delivery On-The-Way</span>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <i class="fa fa-arrow-down"></i>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <span class="btn btn-success btn-sm">Delivered <i class="fa fa-check-circle"></i></span>
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