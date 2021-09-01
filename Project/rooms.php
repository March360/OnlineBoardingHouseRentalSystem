<?php
    require_once 'includes/validate.php';
    require 'includes/session.php';

    if(ISSET($_POST['addroom'])) {
        $name = $_POST['name'];
        $location = $_POST['location'];
        $price = $_POST['price'];
        $advance = $_POST['advance'];
        $dimension = $_POST['dimension'];
        $capacity = $_POST['capacity'];
        $bed = $_POST['bed'];
        $policy = $_POST['policy'];
        $ownerid = $_SESSION['id'];

        $conn->query("INSERT INTO `room` (room_owner_id, room_name, room_location, room_price, room_advance, room_dimension, room_capacity, room_bed, room_policy) VALUES ('$ownerid', '$name', '$location', '$price', '$advance', '$dimension', '$capacity', '$bed', '$policy')") or die(mysqli_error());
        $roomid = mysqli_insert_id($conn);
        foreach($img_name = $_FILES['image']['name'] as $key => $imgs) {
            $ran = rand(000,99999);
            $date = date('dmy_H_s_i');
            $img_name = $_FILES['image']['name'][$key];
            $ext = pathinfo($img_name, PATHINFO_EXTENSION);
            $filename = $ran.'_'.$date.'.'.$ext;
            $savefile = "../assets/images/$filename";
            $savedb = "images/$filename";
            move_uploaded_file($_FILES['image']["tmp_name"][$key], $savefile);
            $conn->query("INSERT INTO `room_image` (img_room_id, img_filename) VALUES ('$roomid', '$savedb')") or die(mysqli_error());
        }
        echo "<script>alert('Added Room Successfully!')</script>";
    }

    if(ISSET($_POST['updateroom'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $location = $_POST['location'];
        $price = $_POST['price'];
        $advance = $_POST['advance'];
        $dimension = $_POST['dimension'];
        $capacity = $_POST['capacity'];
        $bed = $_POST['bed'];
        $policy = $_POST['policy'];

        $conn->query("UPDATE `room` SET room_name = '$name', room_location = '$location', room_price = '$price', room_advance = '$advance', room_dimension = '$dimension', room_capacity = '$capacity', room_bed = '$bed', room_policy = '$policy' WHERE `room_id` = '$id'");
        echo "<script>alert('Room Updated Successfully!')</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Room</title>
  <?php include('includes/link.php') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

<div class="wrapper">
    <?php include('includes/header.php') ?>
    <?php include('includes/sidebar.php') ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Rooms</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Room</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="d-flex justify-content-start">
                                    <div class="row">
                                        <button type="button" data-target="#add-room" data-toggle="modal" class="btn btn-block bg-gradient-success btn-sm"><i class="fa fa-plus"></i>&nbsp;Add Room</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="rooms-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Price</th>
                                            <th>Dimension</th>
                                            <th>Bed</th>
                                            <th>Capacity</th>
                                            <th>Status</th>
                                            <th style="width:25px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = $conn->query("SELECT * FROM `room` WHERE `room_owner_id` = '$_SESSION[id]'") or die(mysqli_error());
                                            while($fetch = $query->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['room_name']?></td>
                                            <td><?php echo $fetch['room_location']?></td>
                                            <td>Php. <?php echo $fetch['room_price']?></td>
                                            <td><?php echo $fetch['room_dimension']?></td>
                                            <td><?php echo $fetch['room_bed']?></td>
                                            <td><?php echo $fetch['room_capacity']?> Person(s)</td>
                                            <td><?php echo $fetch['room_status']?></td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit-room"
                                                        data-id="<?php echo $fetch['room_id']?>" 
                                                        data-name="<?php echo $fetch['room_name']?>"
                                                        data-location="<?php echo $fetch['room_location']?>"
                                                        data-price="<?php echo $fetch['room_price']?>"
                                                        data-advance="<?php echo $fetch['room_advance']?>"
                                                        data-capacity="<?php echo $fetch['room_capacity']?>"
                                                        data-dimension="<?php echo $fetch['room_dimension']?>"
                                                        data-bed="<?php echo $fetch['room_bed']?>"
                                                        data-policy="<?php echo $fetch['room_policy'] ?>"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<div class="modal fade" id="add-room">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Room Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name of the Room</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control" placeholder="Location" required>
                </div>
                <div class="form-group">
                    <label>Price (per monthly basis)</label>
                    <input type="number" name="price" class="form-control" placeholder="Php" required>
                </div>
                <div class="form-group">
                    <label>Advance Deposit (months only)</label>
                    <input type="number" name="advance" class="form-control" placeholder="Months" required>
                </div>
                <div class="form-group">
                    <label>Dimensions of the Room <span style="font-size:10px;color:red">*optional</span></label>
                    <input type="text" name="dimension" class="form-control" placeholder="l * w * h" require>
                </div>
                <div class="form-group">
                    <label>Persons Capacity</label>
                    <input type="number" name="capacity" class="form-control" placeholder="Capacity" required>
                </div>
                <div class="form-group">
                    <label>Bed Type</label>
                    <select name="bed" class="form-control" required>
                        <option value="" selected disabled>Choose an Option . . .</option>
                        <option value="Single Size Bed">Single Size Bed</option>
                        <option value="Double Size Bed">Double Size Bed</option>
                        <option value="Double Deck">Double Deck</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Policy</label>
                    <textarea name="policy" class="form-control" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label>Room Image</label>
                    <div class="custom-file">
                        <input type="file" name="image[]" class="custom-file-input" id="customFile" multiple required>
                        <label for="customFile" class="custom-file-label">Choose File</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="addroom" class="btn btn-primary">Add Room</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-room">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Room Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                <input type="hidden" id="edit-id" name="id">
                <div class="form-group">
                    <label>Name of the Room</label>
                    <input type="text" id="edit-name" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" id="edit-location" name="location" class="form-control" placeholder="Location" required>
                </div>
                <div class="form-group">
                    <label>Price (per monthly basis)</label>
                    <input type="number" id="edit-price" name="price" class="form-control" placeholder="Php" required>
                </div>
                <div class="form-group">
                    <label>Advance Deposit (months only)</label>
                    <input type="number" id="edit-advance" name="advance" class="form-control" placeholder="Months" required>
                </div>
                <div class="form-group">
                    <label>Dimensions of the Room <span style="font-size:10px;color:red">*optional</span></label>
                    <input type="text" id="edit-dimension" name="dimension" class="form-control" placeholder="l * w * h" require>
                </div>
                <div class="form-group">
                    <label>Persons Capacity</label>
                    <input type="number" id="edit-capacity" name="capacity" class="form-control" placeholder="Capacity" required>
                </div>
                <div class="form-group">
                    <label>Bed Type</label>
                    <select name="bed" class="form-control" required>
                        <option id="edit-bed">Choose an Option . . .</option>
                        <option value="single">Single Size Bed</option>
                        <option value="double">Double Size Bed</option>
                        <option value="double_deck">Double Deck</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Policy</label>
                    <textarea name="policy" id="edit-policy" class="form-control" rows="5" required></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" name="updateroom" class="btn btn-primary">Update Room</button>
            </div>
            </form>
        </div>
    </div>
</div>


    <?php include('includes/footer.php') ?>
</div>

<?php include('includes/script.php') ?>
<script>
$(document).ready(function() {
    bsCustomFileInput.init();
    $('#rooms-table').DataTable({
        responsive: true,
        autoWidth: false,
    });
    $('#edit-room').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var modal = $(this);

        modal.find('#edit-id').val(button.data('id'));
        modal.find('#edit-name').val(button.data('name'));
        modal.find('#edit-location').val(button.data('location'));
        modal.find('#edit-price').val(button.data('price'));
        modal.find('#edit-advance').val(button.data('advance'));
        modal.find('#edit-dimension').val(button.data('dimension'));
        modal.find('#edit-capacity').val(button.data('capacity'));
        modal.find('#edit-bed').val(button.data('bed')).html(button.data('bed'));
        modal.find('#edit-policy').val(button.data('policy'));
    });
});
</script>
</body>
</html>
