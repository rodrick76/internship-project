<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  date_default_timezone_set('Asia/Kolkata'); // change according timezone
  $currentTime = date('d-m-Y h:i:s A', time());


  if (isset($_POST['submit'])) {
    $sql = mysqli_query($bd, "SELECT password FROM  admin where password='" . md5($_POST['cpass']) . "' && username='" . $_SESSION['alogin'] . "'");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {
      $con = mysqli_query($bd, "update admin set password='" . md5($_POST['newpass']) . "', updationDate='$currentTime' where username='" . $_SESSION['alogin'] . "'");
      $_SESSION['msg'] = "Password Changed Successfully !!";
    } else {
      $_SESSION['msg'] = "Old Password not match !!";
    }
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Admin | change password</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
  </head>


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

  <body>
    <div class="container-fluid position-relative d-flex p-0">
      <!-- Spinner Start -->
      <!-- <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
      <!-- Spinner End -->


      <!-- Sidebar Start -->
      <?php include('includes/header.php'); ?>
      <!-- Sidebar End -->


      <!-- Content Start -->
      <div class="content">
        <!-- Navbar Start -->


        <?php if ($_SESSION['alogin'] != "") {
          include('includes/menubar.php');
        }
        ?>

        <div class="content-wrapper">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1 class="page-head-line">Admin Change Password </h1>
              </div>
            </div>

            <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>

            <div class="container-fluid pt-4 px-4">
              <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                  <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">chnage password</h6>
                    <form name="chngpwd" method="post" onSubmit="return valid();">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="cpass">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword2" name="newpass" required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword3" name="cnfpass" required>
                      </div>

                      <button type="submit" name="submit" id="submit" class="btn btn-primary">submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>



          <!-- <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                Change Password
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

                  <button type="submit" name="submit" class="btn btn-default">Submit</button>
                  <hr />




                </form>
              </div>
            </div>
          </div>

        </div> -->
        </div>
      </div>
    </div>
      <!-- <?php include('includes/footer.php'); ?> -->

      <script src="assets/js/jquery-1.11.1.js"></script>

      <script src="assets/js/bootstrap.js"></script>
  </body>

  </html>
<?php } ?>