<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $studentname = $_POST['studentname'];
        $photo = $_FILES["photo"]["name"];
        $cgpa = $_POST['cgpa'];
        move_uploaded_file($_FILES["photo"]["tmp_name"], "studentphoto/" . $_FILES["photo"]["name"]);
        $ret = mysqli_query($bd, "update students set studentName='$studentname',studentPhoto='$photo',cgpa='$cgpa'  where StudentRegno='" . $_SESSION['login'] . "'");
        if ($ret) {
            $_SESSION['msg'] = "Student Record updated Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Student Record not update";
        }
    }

?>



    <!DOCTYPE html>
    <html lang="en">

    <?php include('includes/menubar.php'); ?>


    <body class="fix-header card-no-border fix-sidebar">

        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <?php if ($_SESSION['login'] != "") {
                include('includes/header.php');
            }
            ?>
            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h3 class="text-themecolor">Profile</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>

                    </div>
                    <!-- ============================================================== -->
                    <!-- End Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <!-- Row -->
                    <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>
                    <?php $sql = mysqli_query($bd, "select * from students where StudentRegno='" . $_SESSION['login'] . "'");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($sql)) { ?>

                        <div class="row">
                            <!-- Column -->
                            <div class="col-lg-4 col-xlg-3 col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <center class="mt-4"> <?php if ($row['studentPhoto'] == "") { ?>
                                                <img src="studentphoto/noimage.png" width="200" height="200"><?php } else { ?>
                                                <img src="studentphoto/<?php echo htmlentities($row['studentPhoto']); ?>" width="150">
                                            <?php } ?>
                                            <h4 class="card-title mt-2"><?php echo htmlentities($row['studentName']); ?></h4>
                                            <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                                            <div class="row text-center justify-content-md-center">
                                                <!-- <div class="col-4"><a href="javascript:void(0)" class="link"><i class="fa fa-user"></i>
                                                        <font class="font-medium">254</font>
                                                    </a></div>
                                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="fa fa-camera"></i>
                                                        <font class="font-medium">54</font>
                                                    </a></div> -->
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <!-- Column -->
                            <div class="col-lg-8 col-xlg-9 col-md-7">
                                <div class="card">
                                    <!-- Tab panes -->
                                    <div class="card-body">
                                        <form class="form-horizontal form-material mx-2" name="dept" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-md-12">Full Name</label>
                                                <div class="col-md-12">
                                                    <input type="text" value="<?php echo htmlentities($row['studentName']); ?>" name="studentname" class="form-control form-control-line" ">
                                                </div>
                                            </div>
                                            <div class=" form-group">
                                                    <label for="example-email" class="col-md-12">student Registration number</label>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="<?php echo htmlentities($row['StudentRegno']); ?>" class="form-control form-control-line" name="studentregno" value="<?php echo htmlentities($row['StudentRegno']); ?>" placeholder="Student Reg no" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">pincode</label>
                                                    <div class="col-md-12">
                                                        <input type="text" name="Pincode" readonly value="<?php echo htmlentities($row['pincode']); ?>" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">cgpa</label>
                                                    <div class="col-md-12">
                                                        <input type="text" readonly name="cgpa" placeholder="<?php echo htmlentities($row['cgpa']); ?>" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="Pincode">Upload New Photo </label>
                                                        <input type="file" class="form-control" id="photo" name="photo" value="<?php echo htmlentities($row['studentPhoto']); ?>" />
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group">
                                            <label class="col-sm-12">Select Country</label>
                                            <div class="col-sm-12">
                                                <select class="form-control form-control-line">
                                                    <option>London</option>
                                                    <option>India</option>
                                                    <option>Usa</option>
                                                    <option>Canada</option>
                                                    <option>Thailand</option>
                                                </select>
                                            </div>
                                            <?php } ?>
                                        </div> -->
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <button type="submit" name="submit" id="submit" class="btn btn-success">Update</button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                        </div>
                        <!-- Row -->
                        <!-- ============================================================== -->
                        <!-- End PAge Content -->
                        <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- footer -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End footer -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="../assets/node_modules/jquery/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="../assets/node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="js/perfect-scrollbar.jquery.min.js"></script>
        <!--Wave Effects -->
        <script src="js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="js/custom.min.js"></script>
    </body>

    </html>

<?php } ?>