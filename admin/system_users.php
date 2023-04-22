<?php
error_reporting(0);
include_once "includes/session-validation.php";
$user_id = $_SESSION["admin-id"];
include_once "./classes/connetion.class.php";
include_once "./classes/datacall.class.php";
include_once "./classes/utils.class.php";
include_once "./classes/login.class.php";
$dataCalls = new datacall();
$utils = new utils();
$logData = new logData();

$usrStatus = ["Inactive","Active","In Review","Disable"];
$msgClass = ['text-danger','text-success'];

$msg = "";
$msgActive = 0;

if(isset($_POST['userDeActive']) || isset($_POST['userActive'])){
    if (isset($_POST['userActive'])) {
        $userid = $_POST['userActive'];
        $userLevel = '1';
    }elseif (isset($_POST['userDeActive'])) {
        $userid = $_POST['userDeActive'];
        $userLevel = '0';
    }
    $dataCalls->userUpdate($userid,$userLevel);
}
$uList = $dataCalls->userList();
$title_1 = "User";
$title_2 = " Handling";
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

                                    <?php for ($i=0; $i < count($uList) ; $i++) { ?>
                                    <tr>
                                        <td><?php echo $uList[$i]['userName']; ?></td>
                                        <td><?php echo $uList[$i]['userEmail']; ?></td>
                                        <td><?php echo $usrStatus[$uList[$i]['userStatus']]; ?></td>
                                        <td>
                                            <div class="input-group mb-3">

                                                <form action="" method="post">
                                                    <?php
                                            if($uList[$i]['userStatus'] == 0 || $uList[$i]['userStatus'] == 2){?> <button name="userActive"
                                                        id="userActive" type="submit" class="btn btn-success"
                                                        value="<?php echo $uList[$i]['userId']; ?>">Active</button> <?php }
                                            else{?> <button name="userDeActive" id="userDeActive" type="submit"
                                                        class="btn btn-danger"
                                                        value="<?php echo $uList[$i]['userId']; ?>">DeActive</button><?php }
                                            ?>

                                                </form>
                                                <button type="button" class="btn btn-warning" style="margin-left: 10px;"
                                                    value="<?php echo $uList[$i]['companyId']; ?>" onclick="companyData(this.value)"
                                                    data-bs-toggle="modal" data-bs-target="#userModal"  >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-binoculars"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M3 2.5A1.5 1.5 0 0 1 4.5 1h1A1.5 1.5 0 0 1 7 2.5V5h2V2.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5v2.382a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V14.5a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 14.5v-3a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5v3A1.5 1.5 0 0 1 5.5 16h-3A1.5 1.5 0 0 1 1 14.5V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V2.5zM4.5 2a.5.5 0 0 0-.5.5V3h2v-.5a.5.5 0 0 0-.5-.5h-1zM6 4H4v.882a1.5 1.5 0 0 1-.83 1.342l-.894.447A.5.5 0 0 0 2 7.118V13h4v-1.293l-.854-.853A.5.5 0 0 1 5 10.5v-1A1.5 1.5 0 0 1 6.5 8h3A1.5 1.5 0 0 1 11 9.5v1a.5.5 0 0 1-.146.354l-.854.853V13h4V7.118a.5.5 0 0 0-.276-.447l-.895-.447A1.5 1.5 0 0 1 12 4.882V4h-2v1.5a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V4zm4-1h2v-.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5V3zm4 11h-4v.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5V14zm-8 0H2v.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5V14z">
                                                        </path>
                                                    </svg>

                                                </button>

                                            </div>

                                        </td>
                                    </tr>

                                    <?php }?>




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

    <!-- User Details Modal-->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModallLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h6 class="modal-title fs-5" id="userModallLabel">Company Deatils</h6>

                </div>
                <div class="modal-body" id="userDeatils">

                

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

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

    <script src="js/system_users.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>


</body>

</html>