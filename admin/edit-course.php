<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  $id = intval($_GET['id']);
  date_default_timezone_set('Asia/Kolkata');
  $currentTime = date('d-m-Y h:i:s A', time());
  if (isset($_POST['submit'])) {
    $coursecode = $_POST['coursecode'];
    $coursename = $_POST['coursename'];
    $courseunit = $_POST['courseunit'];
    $seatlimit = $_POST['seatlimit'];
    $ret = mysqli_query($bd, "update course set courseCode='$coursecode',courseName='$coursename',courseUnit='$courseunit',noofSeats='$seatlimit',updationDate='$currentTime' where id='$id'");
    if ($ret) {
      $_SESSION['msg'] = "Course Updated Successfully !!";
    } else {
      $_SESSION['msg'] = "Error : Course not Updated";
    }
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>admin edit course</title>
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
                <h1 class="page-head-line">Course </h1>
              </div>
            </div>

                  <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>


                  <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                      <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                          <h6 class="mb-4">chnage password</h6>
                          <form name="dept" method="post">
                            <?php
                            $sql = mysqli_query($bd, "select * from course where id='$id'");
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                              <p><b>Last Updated at</b> :<?php echo htmlentities($row['updationDate']); ?></p>
                              <div class="form-group">
                                <label for="coursecode">Course Code </label>
                                <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Course Code" value="<?php echo htmlentities($row['courseCode']); ?>" required />
                              </div>

                              <div class="form-group">
                                <label for="coursename">Course Name </label>
                                <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Course Name" value="<?php echo htmlentities($row['courseName']); ?>" required />
                              </div>

                              <div class="form-group">
                                <label for="courseunit">Course unit </label>
                                <input type="text" class="form-control" id="courseunit" name="courseunit" placeholder="Course Unit" value="<?php echo htmlentities($row['courseUnit']); ?>" required />
                              </div>

                              <div class="form-group">
                                <label for="seatlimit">Seat limit </label>
                                <input type="text" class="form-control" id="seatlimit" name="seatlimit" placeholder="Seat limit" value="<?php echo htmlentities($row['noofSeats']); ?>" required />
                              </div>


                            <?php } ?><br>  
                            <button type="submit" name="submit" class="btn btn-primary"><i class=" fa fa-refresh "></i> Update</button>
                          </form>
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