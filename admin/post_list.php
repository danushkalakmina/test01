<?php

include_once "includes/session-validation.php";
$user_id = $_SESSION['admin-id'];
include_once "./classes/connetion.class.php";
include_once "./classes/datacall.class.php";
include_once "./classes/utils.class.php";
$dataCalls = new datacall();
$utils = new utils();

$postList = $dataCalls->searchPosts();

$json_array = json_encode($postList);

$title_1 = "Post";
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

    <title>Wastey : <?= $title_1 . $title_2 ?></title>

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

                            <div class="row text-center">
                                <div class="col-md-6 offset-md-3 text-center">
                                    <div class="input-group">
                                            <span class="input-group-text" style="margin-right: 2px;">Post
                                                Status</span>

                                        <select class="form-control" aria-controls="dataTable"
                                                onchange="valueFind(this.value);">
                                            <option selected>Select Status</option>
                                            <option value="All">All Records</option>
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                            <option value="2">In Review</option>
                                            <option value="3">Disable</option>
                                            <option value="4">Sold</option>

                                        </select>
                                    </div>
                                </div>

                            </div>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Post Id</th>
                                        <th>Post Image</th>
                                        <th>Date</th>
                                        <th>Post Title</th>
                                        <th>Waste Type</th>
                                        <th>Contact Number</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Post Id</th>
                                        <th>Post Image</th>
                                        <th>Date</th>
                                        <th>Post Title</th>
                                        <th>Waste Type</th>
                                        <th>Contact Number</th>
                                        <th>Action</th>

                                    </tr>
                                    </tfoot>
                                    <tbody id="postList">
                                    <?php
                                    for ($i = 0; $i < count($postList); $i++) {
                                        $imageSelectedType = (strpos($postList[$i]['image'], 'http') !== false) ? $postList[$i]['image'] : '../profile/'.$postList[$i]['image'];
                                        ?>
                                        <tr>
                                            <td><?php echo $postList[$i]['idwastage']; ?></td>
                                            <td><img src="<?php echo $imageSelectedType; ?>"
                                                     class="img-thumbnail" style="height: 150px" alt="..."></td>
                                            <td><?php echo $postList[$i]['date']; ?></td>
                                            <td><?php echo $postList[$i]['title']; ?></td>
                                            <td><?php echo $postList[$i]['waste_type']; ?></td>
                                            <td><?php echo $postList[$i]['contact_no']; ?></td>
                                            <td>
                                                <a href="product_detail.php?id=<?php echo $postList[$i]['idwastage']; ?>">
                                                    <button type="button" class="btn btn-success"
                                                    >View
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

            </div>
            <!-- /.container-fluid -->

            <script>
                function valueFind(passValue) {
                    if (passValue == 'All') {
                        location.reload();
                    } else {
                        var js_array = JSON.parse('<?php echo $json_array; ?>');
                        const valueToFind = passValue;
                        const indices = [];
                        for (let i = 0; i < js_array.length; i++) {
                            if (js_array[i][22].includes(valueToFind)) {
                                indices.push(i);
                            }
                        }

                        if (indices.length >= 0) {
                            const tableArea = document.getElementById('postList')
                            tableArea.innerHTML = '';
                            for (let j = 0; j < indices.length; j++) {
                                const tr = document.createElement('tr')
                                const pID = document.createElement('td')
                                const pIm = document.createElement('td')
                                const pDt = document.createElement('td')
                                const pTle = document.createElement('td')
                                const pWt = document.createElement('td')
                                const pCn = document.createElement('td')
                                const pAc = document.createElement('td')

                                var imagePath = ""
                                if(js_array[indices[j]][3].includes("http")){
                                    imagePath = js_array[indices[j]][3]
                                }else{
                                    imagePath = "../profile/"+js_array[indices[j]][3]
                                }
                                // $imageSelectedType = (strpos($postList[$i]['image'], 'http') !== false) ? $postList[$i]['image'] : '../profile/'.$postList[$i]['image'];

                                pID.textContent = js_array[indices[j]][0]
                                pIm.innerHTML = `<img src="${imagePath}"class="img-thumbnail" alt="...">`
                                pDt.textContent = js_array[indices[j]][4]
                                pTle.textContent = js_array[indices[j]][5]
                                pWt.textContent = js_array[indices[j]][15]
                                pCn.textContent = js_array[indices[j]][13]
                                pAc.innerHTML = `<a href="product_detail.php?id=${js_array[indices[j]][0]}"> <button type="button" class="btn btn-success">View</button></a>`

                                tr.append(pID, pIm, pDt, pTle, pWt, pCn, pAc)

                                tableArea.appendChild(tr)
                            }
                        } else {
                            const tableArea = document.getElementById('postList')
                            tableArea.innerHTML = ` <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>`
                        }
                    }


                }
            </script>


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

        newWin.document.write(
            '<html><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"><body onload="window.print()">' +
            divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);

    }
</script>

</body>

</html>