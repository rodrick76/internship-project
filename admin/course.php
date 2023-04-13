<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $coursecode = $_POST['coursecode'];
        $coursename = $_POST['coursename'];
        $courseunit = $_POST['courseunit'];
        $seatlimit = $_POST['seatlimit'];
        $ret = mysqli_query($bd, "insert into course(courseCode,courseName,courseUnit,noofSeats) values('$coursecode','$coursename','$courseunit','$seatlimit')");
        if ($ret) {
            $_SESSION['msg'] = "Course Created Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Course not created";
        }
    }
    if (isset($_GET['del'])) {
        mysqli_query($bd, "delete from course where id = '" . $_GET['id'] . "'");
        $_SESSION['delmsg'] = "Course deleted !!";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin | course</title>
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

        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Course </h1>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Course
                            </div>
                            <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>


                            <div class="panel-body">
                                <form name="dept" method="post">
                                    <div class="form-group">
                                        <label for="coursecode">Course Code </label>
                                        <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Course Code" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="coursename">Course Name </label>
                                        <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Course Name" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="courseunit">Course unit </label>
                                        <input type="text" class="form-control" id="courseunit" name="courseunit" placeholder="Course Unit" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="seatlimit">Seat limit </label>
                                        <input type="text" class="form-control" id="seatlimit" name="seatlimit" placeholder="Seat limit" required />
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-default">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div> -->
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?></font>
                <div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <a href="addcourse.php"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> add course</button></a>
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive table-bordered bg-secondary">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="b">#</th>
                                            <th>Course Code</th>
                                            <th>Course Name </th>
                                            <th>Course Unit</th>
                                            <th>Seat limit</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = mysqli_query($bd, "select * from course");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($sql)) {
                                        ?>


                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo htmlentities($row['courseCode']); ?></td>
                                                <td><?php echo htmlentities($row['courseName']); ?></td>
                                                <td><?php echo htmlentities($row['courseUnit']); ?></td>
                                                <td><?php echo htmlentities($row['noofSeats']); ?></td>
                                                <td><?php echo htmlentities($row['creationDate']); ?></td>
                                                <td>
                                                    <a href="edit-course.php?id=<?php echo $row['id'] ?>">
                                                        <button class="btn btn-info"><i class="fa fa-edit "></i> Edit</button> </a>
                                                    <a href="course.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                                        <button class="btn btn-primary"><i class="fa fa-trash "></i>Delete</button>
                                                    </a>
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





        </div>
        </div>

        

        <script src="assets/js/jquery-1.11.1.js"></script>

        <script src="assets/js/bootstrap.js"></script>
    </body>

    </html>
<?php } ?>