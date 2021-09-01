<?php
require_once "includes/connect.php";

if(ISSET($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email= $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contactno = $_POST['contact_no'];
    $hashpwd = password_hash($password,PASSWORD_BCRYPT);

    $query = $conn->query("SELECT 'owner_username' FROM `owner` WHERE `owner_username` = '$username'") or die(mysqli_error());
    $query2 = $conn->query("SELECT 'admin_username' FROM `admin` WHERE `admin_username` = '$username'") or die(mysqli_error());
    $valid = $query->num_rows;
    $valid2 = $query2->num_rows;
    if($valid > 0) {
        echo "<script>alert('Username already exists. Please try again.')</script>";
    } else if($valid2 > 0) {
        echo "<script>alert('Username already exists. Please try again.')</script>";
    } else {
        $conn->query("INSERT INTO `owner` (owner_fname, owner_lname, owner_email, owner_username, owner_password, owner_gender, owner_address, owner_contact_no, owner_reg_date) VALUES('$fname', '$lname', '$email', '$username', '$hashpwd', '$gender', '$address', '$contactno', now())") or die(mysqli_error());
        echo "<script>alert('Registered Successfully!');location.href='ownerlogin.php'</script>";
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

  <title>boarding house rental  </title>

  <!-- Custom fonts for this theme -->
  <link href="assets/frontend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Theme CSS -->
  <link href="assets/frontend/css/freelancer.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <?php include('includes/header.php') ?>
  
  <!-- Masthead -->
    <div class="container d-flex justify-content-center pb-4">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-center">
                        <h2>Registration Form</h2>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <h3>Personal Details</h3>
                        <div class="form-group">
                            <label class="control-label">First Name</label>  
                            <input name="fname" placeholder="First Name" class="form-control" type="text"  value="<?php echo isset($_POST["fname"]) ? $_POST["fname"] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" >Last Name</label> 
                            <input name="lname" placeholder="Last Name" class="form-control" type="text" value="<?php echo isset($_POST["lname"]) ? $_POST["lname"] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label" >E-Mail</label> 
                            <input name="email" placeholder="E-Mail" class="form-control" type="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Gender</label> 
                            <select name="gender" class="form-control" required>
                                <option value="" selected disabled>--Choose--</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Address</label>  
                            <input name="address" placeholder="Address" class="form-control" type="text" value="<?php echo isset($_POST["address"]) ? $_POST["address"] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Contact No.</label>  
                            <input name="contact_no" placeholder="(639)" class="form-control" type="text" value="<?php echo isset($_POST["contact_no"]) ? $_POST["contact_no"] : ''; ?>" required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <h3>Login Information</h3>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Username</label>  
                            <input placeholder="Username" class="form-control" type="text" name="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password</label>  
                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Repeat Password</label>  
                            <input type="password" class="form-control" id="password_repeat" placeholder="Enter password" required>
                        </div>
                        <div class="pt-4">
                            <button type="submit" name="register" class="btn btn-success col-sm-12" >Register</button>
                        </div>
                    </form>
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

<script>
$(document).ready(function() {
    var password = document.getElementById('password');
    var password_repeat = document.getElementById('password_repeat');

    function validatePassword(){
        if(password.value != password_repeat.value) {
            password_repeat.setCustomValidity("Passwords Don't Match");
        } else {
            password_repeat.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    password_repeat.onkeyup = validatePassword;
})
</script>

</body>

</html>
