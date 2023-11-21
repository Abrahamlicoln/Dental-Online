<?php
session_start();
include 'database_connection.php';
$doctor = $_SESSION['doctor'];
$doctor_name = $doctor['fullname'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Online Dental Reservation System</title>

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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>




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
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $doctor_name; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
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
      <div class="row">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">List of Registered Patient</h5>

            <!-- Table with hoverable rows -->
            <div class="table-responsive">
              <table id="example" class="table table-hover">
                <thead>
                  <tr>
                    <th class="mx-4">S/N</th>
                    <th class="mx-4">Patient ID</th>
                    <th class="mx-4">Fullname</th>
                    <th class="mx-4">Phone Number</th>
                    <th class="mx-4">Gender</th>
                    <th class="mx-4">Age</th>
                    <th class="mx-4">Symptoms</th>
                    <th class="mx-4">Drugs Prescription</th>
                    <th class="mx-4">Date of Appointment</th>
                    <th class="mx-4">Time of Appointment</th>
                    <th class="mx-4">Action</th>
                  </tr>
                </thead>
                <tbody>
                <tbody>

                  <?php
                  $select = "SELECT * FROM patient ORDER BY id DESC";
                  $result  = mysqli_query($connection, $select);
                  $counter = 0;
                  while ($row = mysqli_fetch_assoc($result)) {
                    $counter = $counter + 1;
                    $id = $row['id'];
                    $patient_id = $row['patient_id'];
                    $fullname = $row['fullname'];
                    $phone_number = $row['phone_number'];
                    $status = $row['status'];
                    $gender = $row['gender'];
                    $description = $row['description'];
                    $time_appoint = $row['time_of_appoinment'];
                    $date_appoint = $row['date_of_appointment'];
                    $date_appoint = date("l, F j, Y", strtotime($date_appoint));
                    $new_date = str_replace("Thursday, January 1, 1970", "Not Set", $date_appoint);
                    $age = $row['age'];
                    $symptoms = $row['symptoms']; ?>
                    <tr>
                      <td><?php echo $counter; ?></td>
                      <td><?php echo $patient_id; ?></td>
                      <td><?php echo $fullname; ?></td>
                      <td><?php echo $phone_number; ?></td>
                      <td><?php echo $gender; ?></td>
                      <td><?php echo $age . " Years"; ?></td>
                      <td><?php echo $symptoms; ?></td>
                      <td>



                        <?php echo nl2br($description); ?>
                        <?php
                        if (empty($description)) {
                          echo "Not Set";
                        ?>

                        <?php

                        }
                        ?>



                      </td>
                      <td><?php echo $new_date; ?></td>

                      <?php
                      if (!empty($time_appoint)) {
                      ?>
                        <td><?php echo $time_appoint; ?></td>
                      <?php
                      } else { ?>
                        <td><?php echo "Not Set"; ?></td>
                      <?php
                      }
                      ?>


                      <td>
                        <div class="row">
                          <div class="col-md-6">
                            <?php
                            if ($status == "0") { ?>
                              <a class="btn btn-success" href="approved.php?patient_id=<?php echo $id; ?>">Verify</a>
                            <?php

                            } else { ?>

                              <a class="btn btn-primary disabled " href="">Verified</a>
                          </div>
                          <div class="col-md-6">
                            <a class="btn btn-success mx-4" href="prescription.php?patient_id=<?php echo $id; ?>">Prescription</a>
                          </div>
                        <?php

                            }

                        ?>


                        </div>
                      </td>
                    </tr>

                  <?php
                  }
                  ?>
                </tbody>


                </tbody>
              </table>
            </div>
            <!-- End Table with hoverable rows -->

          </div>
        </div>
      </div>

    </section>
    <?php
    if (isset($_SESSION['successful'])) {
      echo "<script>
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3800,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'You have Successful Approved this Patient.'
})
</script>";
      unset($_SESSION['successful']);
    }
    ?>
  </main>

  <!-- ======= Footer ======= -->


  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
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