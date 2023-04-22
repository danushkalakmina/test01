<?php
include_once "includes/session-validation.php";
$company_id = $_SESSION["company-id"];
include_once "./classes/connetion.class.php";
include_once "./classes/datacall.class.php";
include_once "./classes/utils.class.php";
$dataCalls = new datacall();
$utils = new utils();
$companyTypeList = $dataCalls->loadCompanyType();
$districtList = $dataCalls->loadDistrict();

$title_1 = "Market";
$title_2 = " Place";
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

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="css/marcketplace.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Abel&family=Marhey:wght@700&display=swap');
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script defer src="js/market_place.js"></script>
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

                    <main class="main">
                        <nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom">

                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarColor" aria-controls="navbarColor" aria-expanded="true"
                                aria-label="Toggle navigation" hidden> <span
                                    class="navbar-toggler-icon"></span></button>
                            <div class="collapse navbar-collapse show" id="navbarColor">
                                <ul class="navbar-nav" style="width: 100%">
                                    <li class="nav-item rounded bg-light search-nav-item" style="width:100%">
                                        <input type="text" id="searchr" class="form-control bg-light search_title"
                                            placeholder="What are you looking for?">
                                        <span class="fa fa-search text-muted" id="searchTextButton"></span>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <div class="filter">
                            <button class="btn btn-default collapsed" type="button" data-toggle="collapse"
                                data-target="#mobile-filter" aria-expanded="false"
                                aria-controls="mobile-filter">Filters<span class="fa fa-filter pl-1"></span></button>
                        </div>
                        <div id="mobile-filter" class="collapse">
                            <!-- <p class="pl-sm-0 pl-2"> Home | <b>All Breads</b></p> -->
                            <div class="border-bottom pb-2 ml-2">
                                <h4 id="burgundy">Filters</h4>
                            </div>
                            <div class="py-2 border-bottom ml-3">
                                <h6 class="font-weight-bold">Categories</h6>
                                <div id="orange"><span class="fa fa-minus"></span></div>
                                <form>
                                    <?php
                                    foreach ($companyTypeList as $result) {
                                        ?>
                                        <div class="form-group">
                                            <input type="checkbox" name="mcategories[]"
                                                id="mCat_cb_<?= $result["iduser_type"] ?>"
                                                value="<?= $result["iduser_type"] ?>"><label>
                                                <?= $result["type"] ?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                            <div class="py-2 border-bottom ml-3">
                                <h6 class="font-weight-bold">Waste Type</h6>
                                <div id="orange"><span class="fa fa-minus"></span></div>
                                <form>
                                    <div class="form-group"><input type="checkbox" name="mtype[]" value="Raw"
                                            id="mType_cb_Raw"><label>Raw
                                            Item</label></div>
                                    <div class="form-group"><input type="checkbox" name="mtype[]" id="mType_cb_Cooked"
                                            value="Cooked"><label>Cooked
                                            Item</label></div>
                                    <div class="form-group"><input type="checkbox" name="mtype[]" id="mType_cb_Waste"
                                            value="Waste"><label>Waste
                                            Item</label></div>
                                </form>
                            </div>
                            <div class="py-2 ml-3">
                                <h6 class="font-weight-bold">Area</h6>
                                <div id="orange"><span class="fa fa-minus"></span></div>
                                <form>
                                    <?php
                                    foreach ($districtList as $district) {
                                        ?>
                                        <div class="form-group"><input type="checkbox" name="mdistrict[]"
                                                id="mArea_cb_<?= $district['iddistrict'] ?>"
                                                value="<?= $district['iddistrict'] ?>"><label>
                                                <?= $district["name"] ?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                            <div class="py-2 ml-3">
                                <h6 class="font-weight-bold">Other</h6>
                                <div id="orange"><span class="fa fa-minus"></span></div>
                                <form>
                                    <div class="form-group"><input type="checkbox" id="m_is_Deliver">
                                        <label for="25">Is Deliver Available</label>
                                    </div>
                                    <div class="form-group"><input type="checkbox" id="m_is_Biding">
                                        <label for="5off" id="off">Is Biding Available</label>
                                    </div>
                                    <div class="form-group"><input type="checkbox" id="m_is_Negotiable">
                                        <label for="5off" id="off">Is Negotiable</label>
                                    </div>
                                </form>
                            </div>
                            <div class="py-2 ml-3">
                                <button class="btn btn-success w-100 rounded my-2"
                                    id="mbtn_advance_search">Search</button>
                            </div>
                        </div>
                        <!-- Sidebar filter section -->
                        <section id="sidebar">
                            <!-- <p> Home | <b>All Breads</b></p> -->
                            <div class="border-bottom pb-2 ml-2">
                                <h4 id="burgundy">Filters</h4>
                            </div>
                            <div class="py-2 border-bottom ml-3">
                                <h6 class="font-weight-bold">Categories</h6>
                                <div id="orange"><span class="fa fa-minus"></span></div>
                                <form>
                                    <?php
                                    foreach ($companyTypeList as $result) {
                                        ?>
                                        <div class="form-group">
                                            <input type="checkbox" name="categories[]"
                                                value="<?= $result["iduser_type"] ?>"><label>
                                                <?= $result["type"] ?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                            <div class="py-2 border-bottom ml-3">
                                <h6 class="font-weight-bold">Waste Type</h6>
                                <div id="orange"><span class="fa fa-minus"></span></div>
                                <form>
                                    <div class="form-group"><input type="checkbox" name="type[]" value="Raw"><label>Raw
                                            Item</label></div>
                                    <div class="form-group"><input type="checkbox" name="type[]"
                                            value="Cooked"><label>Cooked
                                            Item</label></div>
                                    <div class="form-group"><input type="checkbox" name="type[]"
                                            value="Waste"><label>Waste
                                            Item</label></div>
                                </form>
                            </div>
                            <div class="py-2 border-bottom ml-3">
                                <h6 class="font-weight-bold">Area</h6>
                                <div id="orange"><span class="fa fa-minus"></span></div>
                                <form>
                                    <?php
                                    foreach ($districtList as $district) {
                                        ?>
                                        <div class="form-group"><input type="checkbox" name="district[]"
                                                value="<?= $district['iddistrict'] ?>"><label>
                                                <?= $district["name"] ?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                            <div class="py-2 ml-3">
                                <h6 class="font-weight-bold">Other</h6>
                                <div id="orange"><span class="fa fa-minus"></span></div>
                                <form>
                                    <div class="form-group"><input type="checkbox" id="is_Deliver">
                                        <label for="25">Is Deliver Available</label>
                                    </div>
                                    <div class="form-group"><input type="checkbox" id="is_Biding">
                                        <label for="5off" id="off">Is Biding Available</label>
                                    </div>
                                    <div class="form-group"><input type="checkbox" id="is_Negotiable">
                                        <label for="5off" id="off">Is Negotiable</label>
                                    </div>
                                </form>
                            </div>
                            <div class="py-2 ml-3">
                                <button class="btn btn-block btn-outline-success rounded my-2"
                                    id="btn_advance_search">Search</button>
                            </div>
                        </section>
                        <!-- products section -->
                        <section id="products">
                            <div class="container">
                                <div class="d-flex flex-row">
                                    <div class="text-muted m-2" id="text_result_count">Showing</div>
                                    <div class="ml-auto mr-lg-4">
                                        <div id="sorting" class="border rounded p-1 m-1"> <span class="text-muted">Sort
                                                by</span>
                                            <select name="sort" id="sort">
                                                <option value="date"><b>Date</b></option>
                                                <option value="price_l_h"><b>Price : Low to High</b></option>
                                                <option value="price_h_l"><b>Price : High to Low</b></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="load_post_view">

                                </div>
                            </div>
                        </section>
                    </main>
                    <!-- new border -->
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

</body>

</html>