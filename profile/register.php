<?php
include_once "./classes/connetion.class.php";
include_once "./classes/datacall.class.php";
include_once "./classes/utils.class.php";
$dataCalls = new datacall();
$companyTypeList = $dataCalls->loadCompanyType();
$districtList = $dataCalls->loadDistrict();
$userAccountTypeList = $dataCalls->loadUserAccountTypes();
$utils = new utils();

if (isset($_POST['userType'])) {

    $nextCompanyCode = $dataCalls->getNewCompanyCode();
    $nextUserCode = $dataCalls->getNewUserCode();
    $parkImageSave = '';

    if (isset($_FILES['profFile'])) {
        $filepath = $_FILES['profFile']['tmp_name'];
        $filenam = $_FILES['profFile']['name'];
        $savepath = "prof/" . $nextCompanyCode;
        $parkImageSave = $savepath . '/' . $filenam;
        if (!file_exists($savepath)) {
            mkdir($savepath, 0777, true);
        }
        move_uploaded_file($filepath, $parkImageSave);
    }

    $type = $utils->getParamVal('userType');
    $accountType = $utils->getParamVal('accountType');
    $cmpName = $utils->getParamVal('companyName');
    $city = $utils->getParamVal('cmpyCity');
    $cmpAddress = $utils->getParamVal('companyAddress');
    $cntName = $utils->getParamVal('contactName');
    $cntNumb = $utils->getParamVal('contactNumer');
    $usrEmail = $utils->getParamVal('usrEmail');
    $usrPass = $utils->getParamVal('usrRPass');

    $responseText = $dataCalls->resistorUses($type,$accountType, $cmpName, $city, $cmpAddress, $cntName, $cntNumb, $usrEmail, $usrPass, $parkImageSave, $nextCompanyCode, $nextUserCode);

    header("Location: login.php");
}
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

        <title>Wastey - Registration</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body>

        <div class="container">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <?php if (!$utils->isWebViewDevice()) { ?>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                <?php }?>
                                <form class="user" action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label for="" class="form-label">Account type</label>
                                            <select name="accountType" id="accountType"
                                                    class="form-select form-control datadetails" required
                                                    onchange="accountTypeNameChange(this)">
                                                <option hidden value="">Select one</option>

                                                <?php
                                                foreach ($userAccountTypeList as $result) {
                                                    ?>
                                                    <option data-name="<?= $result["suggested_name"] ?>"
                                                            value="<?= $result["iduser_account_type"] ?>"><?= $result["account_type"] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="" class="form-label">User type</label>
                                            <select name="userType" id="userType"
                                                    class="form-select form-control datadetails" required
                                                    onchange="profNeed(this)">
                                                <option hidden value="">Select one</option>
                                                <?php
                                                foreach ($companyTypeList as $result) {
                                                    ?>
                                                    <option data-prof="<?= $result["is_proof_needed"] ?>"
                                                            value="<?= $result["iduser_type"] ?>"><?= $result["type"] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label for="" class="form-label" id="text-company-name">
                                                Name</label>
                                            <input type="text" name="companyName" id="companyName"
                                                   class="form-control cmpRg" required>
                                        </div>

                                    </div>
                                    <div class="form-group" id="profLoad">

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="" class="form-label">District</label>
                                            <select name="dslistBox" id="dslistBox" class="form-select form-control datadetails" required onchange="cityList(this.value)">
                                                <option hidden=hidden value="">Select one</option>
                                                <?php
                                                foreach ($districtList as $district) {
                                                    ?>
                                                    <option value="<?= $district["iddistrict"] ?>"><?= $district["name"] ?></option>
                                                <?php } ?>
                                            </select>    
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="" class="form-label">City</label>
                                            <select name="cmpyCity" id="select-city" class="form-select form-control datadetails" required>                                                <option hidden value="">Select One</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="form-label"><span>Company</span> Address</label>
                                        <textarea type="text" name="companyAddress" id="companyAddress" class="form-control cmpRg" required></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="" class="form-label">Contact Person</label>
                                            <input type="text" name="contactName" id="contactName" class="form-control cmpRg" placeholder="Name" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="" class="form-label">&nbsp;</label>
                                            <input type="text" name="contactNumer" id="contactNumer" class="form-control cmpRg" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" minlength="10" maxlength="10" placeholder="Number" required>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group">
                                        <label for="" class="form-label">Email Address <span id="emailInfo"></span> </label>
                                        <input type="text" name="usrEmail" id="usrEmail" class="form-control cmpRg" required oninput="emailCheck(this)">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="" class="form-label">Password</label>
                                            <input type="password" name="usrEPass" id="usrEPass" class="form-control cmpRg" required >
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="" class="form-label">Repeat Password <span id='msg'></span> </label>
                                            <input type="password" name="usrRPass" id="usrRPass" class="form-control cmpRg" required oninput="passCheck();">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block" id="submitBtn">
                                        Register Account
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="login.html">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script src="js/common.js"></script>
        <script src="js/registation.js"></script>


        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <script src="js/jquery-3.3.1.min.js"></script>

    </body>

</html>