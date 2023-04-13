<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
  date_default_timezone_set('Asia/Kolkata');
  $currentTime = date('d-m-Y h:i:s A', time());


  if (isset($_POST['submit'])) {
    $sql = mysqli_query($bd, "SELECT password FROM  students where password='" . md5($_POST['cpass']) . "' && studentRegno='" . $_SESSION['login'] . "'");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {
      $con = mysqli_query($bd, "update students set password='" . md5($_POST['newpass']) . "', updationDate='$currentTime' where studentRegno='" . $_SESSION['login'] . "'");
      $_SESSION['msg'] = "Password Changed Successfully !!";
    } else {
      $_SESSION['msg'] = "Current Password not match !!";
    }
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <?php include('includes/menubar.php');?>

  <body class="fix-header fix-sidebar card-no-border">
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
      <script type="text/javascript">
        function valid() {
          if (document.chngpwd.cpass.value == "") {
            alert("Current Password Filed is Empty !!");
            document.chngpwd.cpass.focus();
            return false;
          } else if (document.chngpwd.newpass.value == "") {
            alert("New Password Filed is Empty !!");
            document.chngpwd.newpass.focus();
            return false;
          } else if (document.chngpwd.cnfpass.value == "") {
            alert("Confirm Password Filed is Empty !!");
            document.chngpwd.cnfpass.focus();
            return false;
          } else if (document.chngpwd.newpass.value != document.chngpwd.cnfpass.value) {
            alert("Password and Confirm Password Field do not match  !!");
            document.chngpwd.cnfpass.focus();
            return false;
          }
          return true;
        }
      </script>
      <!-- <body> -->
      <!-- <?php include('includes/header.php'); ?> -->

      <?php if ($_SESSION['login'] != "") {
        //  include('includes/menubar.php');
      }
      ?>
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
              <h3 class="text-themecolor">Dashboard</h3>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
            
          </div>

          <div class="content-wrapper">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h1 class="page-head-line">Student Change Password </h1>
                </div>
              </div>
            
                    <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>


                    <div class="panel-body">
                      <form name="chngpwd" method="post" onSubmit="return valid();">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Current Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" name="cpass" placeholder="Password" />
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">New Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword2" name="newpass" placeholder="Password" />
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Confirm Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword3" name="cnfpass" placeholder="Password" />
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <hr />




                      </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>


          <script src="assets/js/jquery-1.11.1.js"></script>

          <script src="assets/js/bootstrap.js"></script>
  </body>

  </html>
<?php } ?>