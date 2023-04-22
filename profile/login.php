<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from mehedi.asiandevelopers.com/westo-demo/testimonials.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 Feb 2023 14:16:40 GMT -->

<head>
    <meta charset="UTF-8">
    <title>Wastey - Login</title>

    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Google Fonts -->

    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&amp;display=swap" rel="stylesheet">



    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/aos.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/custom-animate.css">
    <link rel="stylesheet" href="../assets/css/fancybox.min.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/icomoon.css">
    <link rel="stylesheet" href="../assets/css/imp.css">
    <link rel="stylesheet" href="../assets/css/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/rtl.css">
    <link rel="stylesheet" href="../assets/css/scrollbar.css">
    <link rel="stylesheet" href="../assets/css/swiper.min.css">

    <!-- Module css -->
    <link rel="stylesheet" href="../assets/css/module-css/header-section.css">
    <link rel="stylesheet" href="../assets/css/module-css/banner-section.css">
    <link rel="stylesheet" href="../assets/css/module-css/about-section.css">
    <link rel="stylesheet" href="../assets/css/module-css/blog-section.css">
    <link rel="stylesheet" href="../assets/css/module-css/fact-counter-section.css">
    <link rel="stylesheet" href="../assets/css/module-css/faq-section.css">
    <link rel="stylesheet" href="../assets/css/module-css/contact-page.css">
    <link rel="stylesheet" href="../assets/css/module-css/breadcrumb-section.css">
    <link rel="stylesheet" href="../assets/css/module-css/team-section.css">
    <link rel="stylesheet" href="../assets/css/module-css/partner-section.css">
    <link rel="stylesheet" href="../assets/css/module-css/profile-login-section.css">
    <link rel="stylesheet" href="../assets/css/module-css/services-section.css">
    <link rel="stylesheet" href="../assets/css/module-css/footer-section.css">

    <link href="../assets/css/color/theme-color.css" id="jssDefault" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="img/favicon.ico" sizes="32x32">
    <link rel="icon" type="image/png" href="img/favicon.ico" sizes="16x16">

    <!-- Login page-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <script defer src="js/login.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"
        integrity="sha512-8pbzenDolL1l5OPSsoURCx9TEdMFTaeFipASVrMYKhuYtly+k3tcsQYliOEKTmuB1t7yuzAiVo+yd7SJz+ijFQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Fixing Internet Explorer-->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

</head>


<body>

    <div class="boxed_wrapper ltr">

        <!-- Preloader -->
        <div class="loader-wrap">
            <div class="preloader">
                <div class="preloader-close">Preloader Close</div>
            </div>
            <div class="layer layer-one"><span class="overlay"></span></div>
            <div class="layer layer-two"><span class="overlay"></span></div>
            <div class="layer layer-three"><span class="overlay"></span></div>
        </div>

        <!-- Main header-->
        <?php
        include_once 'includes/web_header.php';
        ?>

        <section class="login-page">
            <div class="container">

                <!-- Outer Row -->
                <div class="row justify-content-center">

                    <div class="col-xl-10 col-lg-12 col-md-9">

                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                    <div class="col-lg-6">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>

                                            </div>
                                            <form class="user">
                                                <div class="form-group">
                                                    <input type="email" class="form-control form-control-user"
                                                        id="inputEmail" name="inputEmail" aria-describedby="emailHelp"
                                                        placeholder="Enter Email Address..."
                                                        value="dinuk.ranaweera@gmail.com" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-user"
                                                        id="inputPassword" name="inputPassword" placeholder="Password"
                                                        autocomplete="off" value="2211" required>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox small">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck">
                                                        <label class="custom-control-label" for="customCheck">Remember
                                                            Me</label>
                                                    </div>
                                                </div>
                                                <input type="button" class="btn btn-primary btn-user btn-block"
                                                    id="cusLBtn" name="cusLBtn" value="Login">
                                                <span id="errMsg" style="color: red;"></span>
                                            </form>
                                            <hr>
                                            <div class="text-center">
                                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                                            </div>
                                            <div class="text-center">
                                                <a class="small" href="register.php">Create an Account!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <div class="bottom-parallax">
            <!--Start footer area -->
            <?php
            include_once '../includes/footer.php';
            ?>
            <!--End footer area-->
        </div>


        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="flaticon-up-arrow"></span>
        </button>

        <!-- search-popup -->
        <div id="search-popup" class="search-popup">
            <div class="close-search"><i class="icon-close"></i></div>
            <div class="popup-inner">
                <div class="overlay-layer"></div>
                <div class="search-form">
                    <form method="post" action="https://mehedi.asiandevelopers.com/westo-demo/index.html">
                        <div class="form-group">
                            <fieldset>
                                <input type="search" class="form-control" name="search-input" value=""
                                    placeholder="Search Here" required>
                                <input type="submit" value="Search Now!" class="theme-btn style-four">
                            </fieldset>
                        </div>
                    </form>
                    <h3>Recent Search Keywords</h3>
                    <ul class="recent-searches">
                        <li><a href="index.php">waste</a></li>
                        <li><a href="index.php">Dumpster</a></li>
                        <li><a href="index.php">Zerowaste</a></li>
                        <li><a href="index.php">Garbage</a></li>
                        <li><a href="index.php">trash</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- search-popup end -->
    </div>

        <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
     <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    

    <!-- <script src="../assets/js/aos.js"></script>
    <script src="../assets/js/appear.js"></script> -->
   
    <!-- <script src="../assets/js/isotope.js"></script>
    <script src="../assets/js/jquery.bootstrap-touchspin.js"></script>
    <script src="../assets/js/jquery.countTo.js"></script> -->
    <!-- <script src="../assets/js/jquery.easing.min.js"></script> -->
    <!-- <script src="../assets/js/jquery.event.move.js"></script> -->
    <!-- <script src="../assets/js/jquery.fancybox.js"></script> -->
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <!-- <script src="../assets/js/jquery.paroller.min.js"></script> -->
    <!-- <script src="../assets/js/jquery-sidebar-content.js"></script> -->
    <!-- <script src="../assets/js/knob.js"></script> -->
    <!-- <script src="../assets/js/map-script.js"></script> -->
    <!-- <script src="../assets/js/owl.js"></script> -->
    <!-- <script src="../assets/js/pagenav.js"></script> -->
    <script src="../assets/js/scrollbar.js"></script>
    <!-- <script src="../assets/js/swiper.min.js"></script> -->
    <!-- <script src="../assets/js/tilt.jquery.js"></script> -->
    <!-- <script src="../assets/js/TweenMax.min.js"></script> -->
    <!-- <script src="../assets/js/validation.js"></script> -->
    <!-- <script src="../assets/js/wow.js"></script> -->

    <script src="../assets/js/jquery-1color-switcher.min.js"></script>

    <!-- <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATY4Rxc8jNvDpsK8ZetC7JyN4PFVYGCGM&amp;callback=initMap">
        </script> -->

    <!-- thm custom script -->
    <script src="../assets/js/custom.js"></script>



  

</body>


<!-- Mirrored from mehedi.asiandevelopers.com/westo-demo/testimonials.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 Feb 2023 14:16:41 GMT -->

</html>