<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
  date_default_timezone_set('Asia/Kolkata'); // change according timezone
  $currentTime = date('d-m-Y h:i:s A', time());
  if (isset($_POST['submit'])) {
    $sql = mysqli_query($bd, "SELECT * FROM  students where pincode='" . trim($_POST['pincode']) . "' && StudentRegno='" . $_SESSION['login'] . "'");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {
      $_SESSION['pcode'] = $_POST['pincode'];
      header("location:enroll.php");
    } else {
      $_SESSION['msg'] = "Error :Wrong Pincode. Please Enter a Valid Pincode !!";
    }
  }
?>

<?php include('includes/menubar.php');?>



  <body>
    <?php include('includes/header.php'); ?>

    <?php if ($_SESSION['login'] != "") {
      include('includes/menubar.php');
    }
    ?>



    <div id="main-wrapper">

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
                <li class="breadcrumb-item active">pincode verification</li>
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
          <div class="content-wrapper">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h1 class="page-head-line">Student Pincode Verification</h1>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      Pincode Verification
                    </div>
                    <font color="red" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>


                    <div class="panel-body">
                      <form name="pincodeverify" method="post">
                        <div class="form-group">
                          <label for="pincode">Enter Pincode</label>
                          <input type="password" class="form-control" id="pincode" name="pincode" placeholder="Pincode" required />
                        </div>

                        <button type="submit" name="submit" class="btn btn-success">Verify</button>
                        <hr />




                      </form>
                    </div>
                  </div>
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

    <?php include('includes/footer.php'); ?>

    <script src="assets/js/jquery-1.11.1.js"></script>

    <script src="assets/js/bootstrap.js"></script>
  </body>

  </html>
<?php } ?>