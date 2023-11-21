<?php
session_start();
if (isset($_SESSION['login_in'])) {
    header("location:dashboard.php");
}
include 'database_connection.php';
if (isset($_POST['login'])) {
    $username = filter_var(mysqli_real_escape_string($connection, $_POST['username']), FILTER_SANITIZE_EMAIL);
    $password = filter_var(mysqli_real_escape_string($connection, $_POST['password']), FILTER_SANITIZE_STRING);
    $sql = "SELECT * FROM doctor where  email_address = '$username'";
    $query = mysqli_query($connection, $sql);
    $numRow = mysqli_num_rows($query);
    if ($numRow > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['doctor'] = $row;
                $_SESSION['fullname'] = $row['fullname'];
                echo '<script>
            window.setTimeout(function() {
    window.location.href = "dashboard.php";
}, 4000);
            </script>';
            }
        }
    } else {
        $_SESSION['errorr'] = "Incorrect Credential";
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "login.php";
}, 4000);
            </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Doctor Login | Online Dental Reservation System</title>
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
                                        <h5 class="card-title text-center pb-0 fs-4">Doctor Login</h5>

                                    </div>

                                    <form action="login.php" method="POST" class="row g-3 needs-validation" novalidate>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-people"></i></span>
                                                <input type="email" name="username" class="form-control" id="yourUsername" placeholder="Please Enter your Username" required>
                                                <div class="invalid-feedback">Please Enter your Username</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Password</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock-fill"></i></span>
                                                <input type="text" name="password" class="form-control" id="yourUsername" placeholder="Please Enter your Password" required>
                                                <div class="invalid-feedback">Please Enter your Password</div>
                                            </div>
                                        </div>
                                        <div class="col-12">

                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="submit" name="login">Login</button>
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
    <?php
    if (isset($_SESSION['doctor'])) {
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
  title: 'Signed in successfully'
})
</script>";
    } elseif (isset($_SESSION['errorr'])) {
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
  icon: 'error',
  title: 'Invalid Credentials'
})
</script>";
        unset($_SESSION['errorr']);
    }
    ?>

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