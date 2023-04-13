<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $semester = $_POST['semester'];
        $ret = mysqli_query($bd, "insert into semester(semester) values('$semester')");
        if ($ret) {
            $_SESSION['msg'] = "Semester Created Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Semester not created";
        }
    }
    if (isset($_GET['del'])) {
        mysqli_query($bd, "delete from semester where id = '" . $_GET['id'] . "'");
        $_SESSION['delmsg'] = "semester deleted !!";
    }
?>

    <head>
        <meta charset="utf-8">
        <title>admin manage semester</title>
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
                                <h1 class="page-head-line">Department </h1>
                            </div>
                        </div>


                        <div class="container-fluid pt-4 px-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-xl-6">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <h6 class="mb-4">add department</h6>
                                        <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>

                                        <form name="semester" method="post">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Semester Name</label>
                                                <input type="text" class="form-control" id="semester" name="semester">
                                            </div>


                                            <button type="submit" name="submit" id="submit" class="btn btn-primary">submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



 
                                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?></font>
                                <div class="col-md-12">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Manage Semester
                                        </div>

                                        <div class="panel-body">
                                            <div class="table-responsive table-bordered bg-secondary">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Semester</th>
                                                            <th>Creation Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql = mysqli_query($bd, "select * from semester");
                                                        $cnt = 1;
                                                        while ($row = mysqli_fetch_array($sql)) {
                                                        ?>


                                                            <tr>
                                                                <td><?php echo $cnt; ?></td>
                                                                <td><?php echo htmlentities($row['semester']); ?></td>
                                                                <td><?php echo htmlentities($row['creationDate']); ?></td>
                                                                <td>
                                                                    <a href="semester.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                                                        <button class="btn btn-danger">Delete</button>
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