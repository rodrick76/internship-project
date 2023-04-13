<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {

  if (isset($_POST['submit'])) {
    $studentname = $_POST['studentname'];
    $studentregno = $_POST['studentregno'];
    $password = md5($_POST['password']);
    $pincode = rand(100000, 999999);
    $ret = mysqli_query($bd, "insert into students(studentName,StudentRegno,password,pincode) values('$studentname','$studentregno','$password','$pincode')");
    if ($ret) {
      $_SESSION['msg'] = "Student Registered Successfully !!";
    } else {
      $_SESSION['msg'] = "Error : Student  not Register";
    }
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>admin add student</title>
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
      <?php include('includes/header.php');?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->

    
        <?php if ($_SESSION['alogin'] != "") {
            include('includes/menubar.php');
        }
        ?>

<div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">student registration </h1>
                    </div>
                </div>

        <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>


        <!-- <div class="panel-body">
          <form name="dept" method="post">
            <div class="form-group">
              <label for="studentname">Student Name </label>
              <input type="text" class="form-control" id="studentname" name="studentname" placeholder="Student Name" required />
            </div>

            <div class="form-group">
              <label for="studentregno">Student Reg No </label>
              <input type="text" class="form-control" id="studentregno" name="studentregno" onBlur="userAvailability()" placeholder="Student Reg no" required />
              <span id="user-availability-status1" style="font-size:12px;">
            </div>



            <div class="form-group">
              <label for="password">Password </label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required />
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-default">Submit</button>
          </form>
        </div> -->
        <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">student registration</h6>
                            <form name="dept" method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Student Name</label>
                                    <input type="text" class="form-control"  id="studentname" name="studentname" >
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Student Reg No </label>
                                    <input type="text" class="form-control" id="studentregno" name="studentregno" id="exampleInputPassword1" onBlur="userAvailability()" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control"  id="password" name="password" required>
                                </div>

                                <button type="submit" name="submit" id="submit" class="btn btn-primary">submit</button>
                            </form>
                        </div>
                    </div>
                  </div>
       </div>
      </div>



  </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script>
      function userAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
          url: "check_availability.php",
          data: 'regno=' + $("#studentregno").val(),
          type: "POST",
          success: function(data) {
            $("#user-availability-status1").html(data);
            $("#loaderIcon").hide();
          },
          error: function() {}
        });
      }
    </script>


  </body>

  </html>
<?php } ?>