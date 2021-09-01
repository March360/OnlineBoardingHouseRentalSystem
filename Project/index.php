<?php
    require_once "includes/connect.php";
    
    if(ISSET($_POST['register'])) {
        $idroom = $_POST['room_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $contactno = $_POST['contact_no'];
        $status = $_POST['status'];
        $conn->query("INSERT INTO `client` (client_fname, client_lname, client_email, client_gender, client_address, client_contact_no, client_status) VALUES('$fname', '$lname', '$email', '$gender', '$address', '$contactno', '$status')") or die(mysqli_error());
        $clientid = mysqli_insert_id($conn);
        $conn->query("INSERT INTO `inquire` (inq_room_id, inq_client_id) VALUES ('$idroom', '$clientid')");
        echo "<script>alert('Inquired Successfully!')</script>";
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
<!-- Masthead Avatar Image -->
  <!-- Navigation -->
  <?php include('includes/header.php') ?>
  
  <!-- Masthead -->
    <div class="container d-flex align-items-center flex-column">

    <!-- Masthead Avatar Image -->
    <?php
        $query = $conn->query("SELECT * FROM `room`, `owner` WHERE room.room_owner_id = owner.owner_id  AND room.room_status = 'available'") or die(mysqli_error());
        while($fetch = $query->fetch_array()) {
    ?>
    <div class="row pb-4">
        <div class="card">
            <div class="card-header">
                <h3><?php echo $fetch['room_name'] ?></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                            $roomid = $fetch['room_id'];
                            $query2 = $conn->query("SELECT * FROM `room_image` WHERE img_room_id = '$roomid'") or die(mysqli_error());
                            $count = mysqli_num_rows($query2);
                            $i = 0;
                        ?>
                        <div id="carouselExampleControls_<?php echo $fetch['room_id'] ?>" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                                while($fetch2 = $query2->fetch_array()) {
                            ?>
                            <div class="carousel-item <?php if($i==0) { ?> active <?php $i++; } ?>">
                                <img class="d-block w-100" src="assets/<?php echo $fetch2['img_filename'] ?>" style="max-width:720px;min-width:720px;min-height:360px;max-height:360px;">
                            </div>
                            <?php } ?>
                        </div>
                        <?php if($count > 1) { ?>
                        <a class="carousel-control-prev" href="#carouselExampleControls_<?php echo $fetch['room_id'] ?>" role="button">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls_<?php echo $fetch['room_id'] ?>" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="caption">
                            <div class="d-flex justify-content-between">
                                <p class="font-weight-bold">Location</p>
                                <p><?php echo $fetch['room_location'] ?></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="font-weight-bold">Name of owner</p>
                                <p><?php echo $fetch['owner_fname']?>&nbsp;<?php echo $fetch['owner_lname']?></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="font-weight-bold">Price (per monthly basis)</p>
                                <p>Php. <?php echo $fetch['room_price'] ?></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="font-weight-bold">Advance Deposit (Months)</p>
                                <p><?php echo $fetch['room_advance'] ?> Month(s)</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="font-weight-bold">Capacity</p>
                                <p><?php echo $fetch['room_capacity'] ?> Person(s)</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="font-weight-bold">Dimensions</p>
                                <p><?php echo $fetch['room_dimension'] ?><</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="font-weight-bold">Contact #</p>
                                <p><?php echo $fetch['owner_contact_no']?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="button" class="btn btn-primary col-sm-2" data-toggle="modal" data-target="#rent" data-id="<?php echo $fetch['room_id'] ?>" data-policy="<?php echo $fetch['room_policy'] ?>">Rent</button>
            </div>
        </div>
    </div>
    <?php } ?>
    
<!-- The Modal -->
<div class="modal fade" id="rent">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Registration Form</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
            <div class="modal-body py-0">
                <input type="hidden" name="room_id" id="roomid">
                <div class="pb-4">
                    <h4 class="pb-2">Room Policy</h4>
                    <p id="room-policy"></p>
                    <div class="form-check pt-0">
                        <input class="form-check-input" type="checkbox" id="reg-form-checkbox" required>
                        <label class="form-check-label" for="reg-form-checkbox">
                            I have agreed to the Owner's Policy
                        </label>
                    </div>
                </div>
                <div id="reg-form" style="display:none;">
                    <div class="form-group">
                        <label>First Name</label>  
                        <input name="fname" placeholder="First Name" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label> 
                        <input name="lname" placeholder="Last Name" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" placeholder="E-mail" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>  
                        <select name="gender" class="form-control" required>
                            <option value="" selected disabled>--Choose--</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Address</label>  
                        <input name="address" placeholder="Address" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label>Contact No.</label>  
                        <input name="contact_no" placeholder="(639)" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="">Social Status</label>
                        <select name="status" class="form-control" required>
                            <option value="" disabled selected>Choose an option . . .</option>
                            <option value="Student">Student</option>
                            <option value="Employed">Employed</option>
                            <option value="Unemployed">Unemployed</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="reg-form-submit" style="display:none;">
                <div class="modal-footer py-0">
                    <div class="form-group">
                        <label></label>
                        <div class="col-md-4"><br>
                            <button name="register" type="submit" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
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
    $('#rent').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var modal = $(this);

        modal.find('#roomid').val(button.data('id'));
        modal.find('#room-policy').html(button.data('policy'));
    })
    $('#reg-form-checkbox').on('change', function() {
        if($(this).is(':checked')) {
            $('#reg-form').show();
            $('#reg-form-submit').show();
        } else {
            $('#reg-form').hide();
            $('#reg-form-submit').hide();
        }
    })
})
</script>
</body>
</html>
