<?php
include 'database_connection.php';
session_start();
if (isset($_GET['patient_id'])) {
    $id = $_GET['patient_id'];
    $_SESSION['id'] = $id;
    $select = "SELECT * FROM patient WHERE id=$id";
    $result  = mysqli_query($connection, $select);
    $counter = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $patient_id = $row['patient_id'];
        $fullname = $row['fullname'];
        $phone_number = $row['phone_number'];
        $date_of_birth = $row['date_of_birth'];
        $gender = $row['gender'];
        $age = $row['age'];
        $symptoms = $row['symptoms'];
        $address = $row['address'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Approved Patient - Online Dental Reservation System</title>

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">




    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">ODRS</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="index.html">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Page Title Header Starts-->
                    <div class="row page-title-header">
                        <div class="col-12">
                            <div class="page-header">
                                <h4 class="page-title">Approved Out-patient</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Please Complete this Form to Approved Out_patient</h4>
                                    <form action="main_approved.php" class="form-sample" method="POST">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label class="col-sm-3 col-form-label">Fullname</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" readonly value="<?php echo $fullname; ?>" name="fullname" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label class="col-sm-3 col-form-label">Phone Number</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" readonly value="<?php echo $phone_number; ?>" name="phone_number" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label class="col-sm-3 col-form-label">Gender</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control" readonly ">
                                                            <option value=" <?php echo $gender; ?>"><?php echo $gender; ?></option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label class="col-sm-3 col-form-label">Date of Birth</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" class="form-control" readonly value="<?php echo $date_of_birth; ?>" placeholder="dd/mm/yyyy" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label class="col-sm-3 col-form-label">Address</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" readonly value="<?php echo $address; ?>" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label class="col-sm-3 col-form-label">Symptoms</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" readonly value="<?php echo $symptoms; ?>" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label class="col-sm-3 col-form-label">Age of Patient</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" readonly value="<?php echo $age . " Years Old"; ?>" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label class="col-sm-3 col-form-label">Date of Appointment</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" class="form-control" name="date_of_appointment" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label class="col-sm-3 col-form-label">Time Appointment</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" class="form-control" name="time_of_appointment" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <center><button type="submit" name="approved" class="btn btn-success mt-4 py-2">Approved Patient</button></center>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page Title Header Ends-->
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->

                <!-- partial -->
            </div>


        </section>

    </main>

    <!-- ======= Footer ======= -->


    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>