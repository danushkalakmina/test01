<?php
error_reporting(0);
include_once "includes/session-validation.php";
$company_id = $_SESSION["company-id"];
$user_id = $_SESSION["admin-id"];
include_once "./classes/connetion.class.php";
include_once "./classes/datacall.class.php";
include_once "./classes/utils.class.php";
include_once "./classes/login.class.php";
$dataCalls = new datacall();
$utils = new utils();
$logData = new logData();

$title_1 = "Admin";
$title_2 = " Account Handling";

$usrStatus = ["Inactive", "Active", "In Review", "Disable"];
$msgClass = ['text-danger', 'text-success'];

$msg = "";
$msgActive = 0;

if (isset($_POST['userName'])) {
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userEpass'];
    if ($_POST['userEpass'] == $_POST['userRpass']) {
        $msg = $logData->newUser($userName, $userEmail, hash('sha256', $userPassword));
        if ($msg == 'User Added') {
            $msgActive = 1;
        }
    } else {
        $msg = "Password Not Matched";
        $msgActive = 0;
    }
}
$uList = $dataCalls->admList();
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
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script defer src="js/wastage_post.js"></script>
    <script defer src="js/userArea.js"></script>
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
            <?php include_once "includes/navup.php"; ?>

            <div class="container">
                <div class="card shadow mb-4">

                    <div class="card-body">
                        <form action="" method="post">

                            <div class="row text-center">
                                <div class="col-md-6 offset-md-3 text-center">
                                    <span class="<?php echo $msgClass[$msgActive]; ?>"><?php echo $msg; ?></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <label for="" class="label-form">User Name</label>
                                    <input type="text" name="userName" id="userName" class="form-control" required
                                           autocomplete="off">
                                </div>
                                <div class="col-sm">
                                    <label for="" class="label-form">Email</label>
                                    <input type="email" name="userEmail" id="userEmail" class="form-control" required
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <label for="" class="label-form">Password</label>
                                    <input type="password" name="userEpass" id="userEpass" class="form-control" required
                                           autocomplete="off">
                                </div>
                                <div class="col-sm">
                                    <label for="" class="label-form">Re Password</label>
                                    <input type="password" name="userRpass" id="userRpass" class="form-control" required
                                           autocomplete="off">
                                </div>
                            </div>

                            <div class="row text-right mt-2">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-warning">Add New User</button>
                                </div>
                            </div>

                        </form>

                        <hr>

                        <div class="row align-content-center">

                            <div class="col-sm">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Email ID</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php for ($i = 0; $i < count($uList); $i++) { ?>
                                            <tr>
                                                <td><?php echo $uList[$i]['userName']; ?></td>
                                                <td><?php echo $uList[$i]['userEmail']; ?></td>
                                                <td><?php echo $usrStatus[$uList[$i]['userStatus']]; ?></td>
                                                <td></td>
                                            </tr>

                                        <?php } ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


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


<!--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">-->
<!--    <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>-->


</body>

</html>