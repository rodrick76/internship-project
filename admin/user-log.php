<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {



?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>DarkPan - Bootstrap 5 Admin Template</title>
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
                                <h1 class="page-head-line">User Log</h1>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        User Log
                                    </div>

                                    <div class="panel-body">
                                        <div class="table-responsive table-bordered bg-secondary">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>

                                                        <th>Student Reg no </th>
                                                        <th>IP </th>
                                                        <th>Login Time </th>

                                                        <th>Logout Time</th>
                                                        <th>Status</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = mysqli_query($bd, "select * from userlog");
                                                    $cnt = 1;
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                    ?>


                                                        <tr>
                                                            <td><?php echo $cnt; ?></td>
                                                            <td><?php echo htmlentities($row['studentRegno']); ?></td>
                                                            <td><?php echo htmlentities($row['userip']); ?></td>
                                                            <td><?php echo htmlentities($row['loginTime']); ?></td>
                                                            <td><?php echo htmlentities($row['logout']); ?></td>
                                                            <td><?php echo htmlentities($row['status']); ?></td>
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

                <?php include('includes/footer.php'); ?>

                <script src="assets/js/jquery-1.11.1.js"></script>

                <script src="assets/js/bootstrap.js"></script>
    </body>

    </html>
<?php } ?>