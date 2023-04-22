<?php
session_start();
ob_start();
if (!isset($_COOKIE["user-id"]) || empty($_COOKIE["user-id"]) || !isset($_COOKIE["company-id"]) || empty($_COOKIE["company-id"])) {
    header("Location:login.php");
    return;
}
$_SESSION['company-id'] = base64_decode($_COOKIE['company-id']);
$_SESSION['user-id'] = base64_decode($_COOKIE['user-id']);
$_SESSION['user-name'] = base64_decode($_COOKIE['user-name']);
$company_id = $_SESSION["company-id"];
include_once "./classes/connetion.class.php";
include_once "./classes/datacall.class.php";
include_once "./classes/utils.class.php";
include_once "./classes/userdata.class.php";
$dataCalls = new datacall();
$utils = new utils();
$userData = new userdata();












$details = $userData->call_UserData(base64_decode($_COOKIE['user-id']));

$title_1 = "User";
$title_2 = " Profile";
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

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/common.css" rel="stylesheet" type="text/css">

    <script defer src="js/profile.js"></script>


</head>

<body id="page-top">

    <!-- Test Comment-->
    <!-- Page Wrapper -->
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

                <!-- Data Area Start-->
                <div class="row m-2">
                    <h6><b> User Deatils <p style="color:red;" id='msg'></p></b></h6>
                    <br>
                    
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row m-2">

                        <div class="col-sm ">
                            <label for="" class="form-label">User Name</label>
                            <input type="text" id="userName" name="" class="form-control data_Pass" placeholder=""
                                data-userId="<?php echo base64_decode($_COOKIE['user-id']); ?>" 
                                data-userName="<?php echo $details[0]['cusNam']; ?>"
                                value="<?php echo $details[0]['cusNam']; ?>" required>
                        </div>
                        <div class="col-sm">
                            <label for="" class="form-label">Email</label>
                            <label class="form-control data_Pass" data-email="<?php echo $details[0]['cusEmail']; ?>"><?php echo $details[0]['cusEmail']; ?></label>
                        </div>
                        <div class="col-sm">
                            <label for="userContact" class="form-label">Contact</label>
                            <input type="text" id="userContact" name="" class="form-control data_Pass" minlength="10"
                                maxlength="10"  data-cntNum="<?php echo $details[0]['cusContact']; ?>" value="<?php echo $details[0]['cusContact']; ?>" required>
                        </div>
                        <div class="col-sm">
                            <label for="typeAll" class="form-label">Type</label>
                            <div id="typeAll">
                                <label class="form-control data_Pass"
                                    data-typeId="<?php echo $details[0]['userType']; ?>"
                                    onclick="allTypes();"><?php echo $details[0]['type']; ?></label>
                            </div>


                        </div>
                    </div>

                    <hr>

                    <div class="row m-2">
                        <h6><b> Company Deatils </b></h6>
                    </div>

                    <div class="row m-2">
                        <div class="col-sm">
                            <label for="" class="form-label">Company Name</label>
                            <input type="text" name="" id="companyName" class="form-control data_Pass" data-companyName="<?php echo $details[0]['compName']; ?>" 
                            data-companyID="<?php echo $details[0]['compID']; ?>"
                                value="<?php echo $details[0]['compName']; ?>" required>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-sm"><label for="" class="form-label">Company Address</label>

                            <input type="text" name="" id="companyAddress" class="form-control data_Pass" data-address="<?php echo $details[0]['compAddress']; ?>"
                                value="<?php echo $details[0]['compAddress']; ?>" required>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-sm">
                            <label for="" class="form-label">Distric</label>
                            <div id="districAll">
                                <label for="" class="form-control data_Pass" id="districAllElement" data-districID="<?php echo $details[0]['districtID']; ?>" onclick="allDistric();"><?php echo $details[0]['districtName']; ?></label>
                            </div>

                        </div>
                        <div class="col-sm">
                            <label for="" class="form-label">City</label>
                            <div id="cityAll">
                                <label for="" class="form-control data_Pass" data-cityID="<?php echo $details[0]['cityId']; ?>" onclick="allCity();"><?php echo $details[0]['cityName']; ?></label>
                            </div>

                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-sm">
                            <label for="" class="form-label">Proof</label>
                            <input type="file" name="" id="" class="form-control data_Pass" required>

                        </div>

                    </div>

                    <hr>

                    <div class="row text-right mt-2">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-warning" id="profileBtn">Update Information</button>
                        </div>
                    </div>
                </form>



                <!-- Data Area End-->





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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>