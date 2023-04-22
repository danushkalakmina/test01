<?php
include_once "includes/session-validation.php";
$user_id = $_SESSION['admin-id'];
include_once "./classes/connetion.class.php";
include_once "./classes/datacall.class.php";
include_once "./classes/utils.class.php";
$dataCalls = new datacall();
$utils = new utils();

$responseCronJobID = $dataCalls->runCronJob();
$responseCronJobDetail = $dataCalls->getCronJobDetail($responseCronJobID);


$responseCronJobNotifers = $dataCalls->loadAllCronJobNotifers($responseCronJobID);

$title_1 = "Job";
$title_2 = " Status";
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
                            <div class="row align-content-center mb-3">
                                <h3>
                                    <i class="fa fa-check-circle fa-2x text-success"></i>  Job # <?=$utils->getValue($responseCronJobDetail, "idcron_job")?> <?=date('M d, Y h:i A', strtotime($utils->getValue($responseCronJobDetail, "date")))?>
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Post</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Post</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    <?php
                                    foreach ($responseCronJobNotifers as $result) {
                                        ?>
                                        <tr>
                                            <td><?= $result["name"] ?></td>
                                            <td><?= $result["email"] ?></td>
                                            <td><a href="product_detail.php?id=<?= $result["idwastage"] ?>"
                                                   class="btn btn-success btn-sm w-100 mb-1"><?= $result["idwastage"] ?>
                                                    <br>View Post</a></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
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