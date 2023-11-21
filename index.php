<?php
session_start();
include 'database_connection.php';
if (isset($_POST['register'])) {
  $fullname = filter_var(mysqli_real_escape_string($connection, $_POST['fullname']), FILTER_SANITIZE_STRING);
  $phone_number = filter_var(mysqli_real_escape_string($connection, $_POST['phone_number']), FILTER_SANITIZE_NUMBER_INT);
  $email_address = filter_var(mysqli_real_escape_string($connection, $_POST['email_address']), FILTER_SANITIZE_EMAIL);
  $date_of_birth = filter_var(mysqli_real_escape_string($connection, $_POST['date_of_birth']), FILTER_SANITIZE_STRING);
  $gender = filter_var(mysqli_real_escape_string($connection, $_POST['gender']), FILTER_SANITIZE_STRING);
  $symptoms = filter_var(mysqli_real_escape_string($connection, $_POST['symptoms']), FILTER_SANITIZE_STRING);
  $address = filter_var(mysqli_real_escape_string($connection, $_POST['address']), FILTER_SANITIZE_STRING);
  $today = date("Y-m-d");
  $date_difference = date_diff(date_create($today), date_create($date_of_birth));
  $age = $date_difference->format("%y");
  $_SESSION['fullname'] = $fullname;
  $insert = "INSERT INTO patient(patient_id, fullname, phone_number, email_address,address,symptoms, date_of_birth,gender,age) VALUES('$phone_number','$fullname','$phone_number','$email_address','$address','$symptoms','$date_of_birth','$gender','$age')";
  $result = mysqli_query($connection, $insert);
  if ($result) {
    header("Location:successpage.php");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Online Dental Reservation System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->


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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body style="background-image:url(image/dental.png);">

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4 ">
        <div class="container">
          <div class="row justify-content-center ">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center px-6">
              <div class="card mb-3 ">

                <div class=" card-body">
                  <div class="pt-2 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Online Dental Reservation System</h5>

                  </div>

                  <form action="index.php" method="POST" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Fullname</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-people"></i></span>
                        <input type="text" name="fullname" class="form-control" id="yourUsername" placeholder="Please Enter your Fullname" required>
                        <div class="invalid-feedback">Please Enter your Fullname</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Phone Number</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-telephone"></i></span>
                        <input type="text" name="phone_number" class="form-control" id="yourUsername" placeholder="Please Enter your Phone Number" required>
                        <div class="invalid-feedback">Please Enter your Phone Number</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email Address</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email_address" class="form-control" id="yourUsername" placeholder="Please Enter your Email Address">
                        <div class="invalid-feedback">Please Enter your Email Address</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Date of Birth</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-calendar-date-fill"></i></span>
                        <input type="date" name="date_of_birth" class="form-control" id="yourUsername" placeholder="Please Enter your Date of Birth" required>
                        <div class="invalid-feedback">Please Enter your Date of Birth</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Gender</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-gender-trans"></i></span>
                        <select name="gender" required id="" class="form-control">
                          <option value="">----Select Gender----</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                        <div class="invalid-feedback">Please Select your Gender</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Address</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" name="address" class="form-control" id="yourUsername" placeholder="Please Enter your Home Address" required>
                        <div class="invalid-feedback">Please Enter your Home Address</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Symptoms</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-exclamation-octagon"></i></span>
                        <input type="text" name="symptoms" class="form-control" id="yourUsername" placeholder="Symptoms Separated by Comma" required>
                        <div class="invalid-feedback">Please Enter Symptoms</div>
                      </div>
                    </div>

                    <div class="col-12">

                    </div>
                    <div class="col-12">
                      <button class="btn btn-success w-100" type="submit" name="register">Submit</button>
                    </div>

                  </form>

                </div>
              </div>

              <div class="credits">

                Designed by <a href="alinks.com">Amina Limited</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>