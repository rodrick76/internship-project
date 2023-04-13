<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0 or strlen($_SESSION['pcode']) == 0) {
  header('location:index.php');
} else {

  if (isset($_POST['submit'])) {
    $studentregno = $_POST['studentregno'];
    $pincode = $_POST['Pincode'];
    $session = $_POST['session'];
    $dept = $_POST['department'];
    $level = $_POST['level'];
    $course = $_POST['course'];
    $sem = $_POST['sem'];
    $ret = mysqli_query($bd, "insert into courseenrolls(studentRegno,pincode,session,department,level,course,semester) values('$studentregno','$pincode','$session','$dept','$level','$course','$sem')");
    if ($ret) {
      $_SESSION['msg'] = "Enroll Successfully !!";
      header('location:enrollment-history.php');
    } else {
      $_SESSION['msg'] = "Error : Not Enroll";
    }
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <?php include('includes/menubar.php');?>

  <body>

    

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
                                <li class="breadcrumb-item active">Course Enroll</li>
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
                    <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      Course Enroll
                    </div>
                    <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>
                    <?php $sql = mysqli_query($bd, "select * from students where StudentRegno='" . $_SESSION['login'] . "'");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($sql)) { ?>

                      <div class="panel-body">
                        <form name="dept" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label for="studentname">Student Name </label>
                            <input type="text" class="form-control" id="studentname" name="studentname" value="<?php echo htmlentities($row['studentName']); ?>" />
                          </div>

                          <div class="form-group">
                            <label for="studentregno">Student Reg No </label>
                            <input type="text" class="form-control" id="studentregno" name="studentregno" value="<?php echo htmlentities($row['StudentRegno']); ?>" placeholder="Student Reg no" readonly />

                          </div>



                          <div class="form-group">
                            <label for="Pincode">Pincode </label>
                            <input type="text" class="form-control" id="Pincode" name="Pincode" readonly value="<?php echo htmlentities($row['pincode']); ?>" required />
                          </div>

                          <div class="form-group">
                            <label for="Pincode">Student Photo </label>
                            <?php if ($row['studentPhoto'] == "") { ?>
                              <img src="studentphoto/noimage.png" width="200" height="200"><?php } else { ?>
                              <img src="studentphoto/<?php echo htmlentities($row['studentPhoto']); ?>" width="200" height="200">
                            <?php } ?>
                          </div>
                        <?php } ?>

                        <div class="form-group">
                          <label for="Session">Session </label>
                          <select class="form-control" name="session" required="required">
                            <option value="">Select Session</option>
                            <?php
                            $sql = mysqli_query($bd, "select * from session");
                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                              <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['session']); ?></option>
                            <?php } ?>

                          </select>
                        </div>



                        <div class="form-group">
                          <label for="Department">Department </label>
                          <select class="form-control" name="department" required="required">
                            <option value="">Select Depertment</option>
                            <?php
                            $sql = mysqli_query($bd, "select * from department");
                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                              <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['department']); ?></option>
                            <?php } ?>

                          </select>
                        </div>


                        <div class="form-group">
                          <label for="Level">Level </label>
                          <select class="form-control" name="level" required="required">
                            <option value="">Select Level</option>
                            <?php
                            $sql = mysqli_query($bd, "select * from level");
                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                              <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['level']); ?></option>
                            <?php } ?>

                          </select>
                        </div>

                        <div class="form-group">
                          <label for="Semester">Semester </label>
                          <select class="form-control" name="sem" required="required">
                            <option value="">Select Semester</option>
                            <?php
                            $sql = mysqli_query($bd, "select * from semester");
                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                              <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['semester']); ?></option>
                            <?php } ?>

                          </select>
                        </div>


                        <div class="form-group">
                          <label for="Course">Course </label>
                          <select class="form-control" name="course" id="course" onBlur="courseAvailability()" required="required">
                            <option value="">Select Course</option>
                            <?php
                            $sql = mysqli_query($bd, "select * from course");
                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                              <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['courseName']); ?></option>
                            <?php } ?>
                          </select>
                          <span id="course-availability-status1" style="font-size:12px;">
                        </div>



                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Enroll</button>
                        </form>
                      </div>
                  </div>
                </div>

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

  
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script>
      function courseAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
          url: "check_availability.php",
          data: 'cid=' + $("#course").val(),
          type: "POST",
          success: function(data) {
            $("#course-availability-status1").html(data);
            $("#loaderIcon").hide();
          },
          error: function() {}
        });
      }
    </script>


  

  </html>
<?php } ?>