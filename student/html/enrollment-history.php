<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {



?>


    <!DOCTYPE html>
    <html lang="en">

    <?php include('includes/menubar.php');?>


    <body class="fix-header card-no-border fix-sidebar">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Admin Wrap</p>
            </div>
        </div>
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
                            <h3 class="text-themecolor">Table Basic</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Table Basic</li>
                            </ol>
                        </div>
         
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <!-- column -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Basic Table</h4>
                                    <h6 class="card-subtitle">Add class <code>.table</code></h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Course Name </th>
                                                    <th>Session </th>
                                                    <th> Department</th>
                                                    <th>Level</th>
                                                    <th>Semester</th>
                                                    <th>Enrollment Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = mysqli_query($bd, "select courseenrolls.course as cid, course.courseName as courname,session.session as session,department.department as dept,level.level as level,courseenrolls.enrollDate as edate ,semester.semester as sem from courseenrolls join course on course.id=courseenrolls.course join session on session.id=courseenrolls.session join department on department.id=courseenrolls.department join level on level.id=courseenrolls.level  join semester on semester.id=courseenrolls.semester  where courseenrolls.studentRegno='" . $_SESSION['login'] . "'");
                                                $cnt = 1;
                                                while ($row = mysqli_fetch_array($sql)) {
                                                ?>


                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><?php echo htmlentities($row['courname']); ?></td>
                                                        <td><?php echo htmlentities($row['session']); ?></td>
                                                        <td><?php echo htmlentities($row['dept']); ?></td>
                                                        <td><?php echo htmlentities($row['level']); ?></td>
                                                        <td><?php echo htmlentities($row['sem']); ?></td>
                                                        <td><?php echo htmlentities($row['edate']); ?></td>
                                                        <td>
                                                            <a href="print.php?id=<?php echo $row['cid'] ?>" target="_blank">
                                                                <button class="btn btn-primary"><i class="fa fa-print "></i> Print</button> </a>


                                                        </td>
                                                    </tr>
                                                <?php
                                                    $cnt++;
                                                } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <footer class="footer"> © 2021 Adminwrap by <a href="https://www.wrappixel.com/">wrappixel.com</a> </footer>
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
        <!-- jQuery peity -->
        <script src="../assets/node_modules/peity/jquery.peity.min.js"></script>
        <script src="../assets/node_modules/peity/jquery.peity.init.js"></script>
    </body>

    </html>

<?php } ?>