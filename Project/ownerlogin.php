<?php
require_once "includes/connect.php";


if(ISSET($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $conn->query("SELECT * FROM `owner` WHERE `owner_username` = '$username'") or die(mysqli_error());
    $fetch = $query->fetch_array();
    $row = $query->num_rows;

    if($row == 0) {
        $query2 = $conn->query("SELECT * FROM `admin` WHERE `admin_username` = '$username'") or die(mysqli_error());
        $fetch2 = $query2->fetch_array();
        $row2 = $query2->num_rows;

        if(password_verify($password,$fetch2["admin_password"])) {
            session_start();
            $_SESSION['id'] = $fetch2['admin_id'];
            header('location:admin/dashboard.php');
            exit;
        } else {
            echo "<script>alert('Password Invalid. Please try again.')</script>";
        }
    } else if($row > 0) {
        if($fetch['owner_status'] == 'pending') {
            echo "<script>alert('Account is still pending. Contact administration.')</script>";
        } else {
            if(password_verify($password,$fetch["owner_password"])) {
                session_start();
                $_SESSION['id'] = $fetch['owner_id'];
                header('location:owner/dashboard.php');
                exit;
            } else {
                echo "<script>alert('Password Invalid. Please try again.')</script>";
            }
        }
    } else { 
        echo "<script>alert('Invalid Username or Password. Please try again.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>boarding house rental</title>

  <!-- Custom fonts for this theme -->
  <link href="assets/frontend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Theme CSS -->
  <link href="assets/frontend/css/freelancer.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <?php include('includes/header.php') ?>

  <!-- Masthead -->
    <div class="container d-flex justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-flex justify-content-center">Login</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label class="control-label">Username</label>  
                            <input placeholder="Enter Username" class="form-control" type="text" name="username" id="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ''; ?>" required oninput="$(this).removeClass('is-invalid')">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter Password" name="password" required oninput="$(this).removeClass('is-invalid')">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="login" class="btn btn-success align-center col-sm-6"><i class="fas fa-sign-in-alt"></i> Login</button>
                        </div>
                    </form>
                    <div class="d-flex justify-content-center pt-2">
                        <a href="ownerreg.php">Not yet Registered?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Bootstrap core JavaScript -->
<script src="assets/frontend/vendor/jquery/jquery.min.js"></script>
<script src="assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Plugin JavaScript -->
<script src="assets/frontend/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Contact Form JavaScript -->
<script src="assets/frontend/js/jqBootstrapValidation.js"></script>
<script src="assets/frontend/js/contact_me.js"></script>
<!-- Custom scripts for this template -->
<script src="assets/frontend/js/freelancer.min.js"></script>
  


</body>

</html>
