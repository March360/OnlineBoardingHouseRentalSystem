<?php
    require_once 'includes/validate.php';
    require 'includes/session.php';

    if(ISSET($_POST['approve'])) {
        $id = $_POST['id'];

        $conn->query("UPDATE `owner` SET owner_status = 'approved' WHERE owner_id = '$id'") or die(mysqli_error());
        echo "<script>alert('Approved Successfully!')</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN | Owners</title>
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
                        <h1 class="m-0">Owners</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Owners</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="owners-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>Contact #</th>
                                            <th>Registration Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  
                                            $query = $conn->query("SELECT * FROM `owner` WHERE `owner_status`='pending'") or die(mysqli_error());
                                            while($fetch = $query->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['owner_lname']?>, <?php echo $fetch['owner_fname']?></td>
                                            <td><?php echo $fetch['owner_email']?></td>
                                            <td><?php echo $fetch['owner_contact_no']?></td>
                                            <td><?php echo $fetch['owner_reg_date']?></td>
                                            <td align="center" width="15px">
                                                <button type="button" class="btn btn-outline-info btn-xs" data-toggle="modal" data-target="#view"
                                                        data-id="<?php echo $fetch['owner_id']?>"
                                                        data-fname="<?php echo $fetch['owner_fname']?>"
                                                        data-lname="<?php echo $fetch['owner_lname']?>"
                                                        data-email="<?php echo $fetch['owner_email']?>"
                                                        data-contactno="<?php echo $fetch['owner_contact_no']?>"
                                                        data-address="<?php echo $fetch['owner_address']?>"
                                                        data-regdate="<?php echo $fetch['owner_reg_date']?>"><i class="fa fa-eye"></i> View</button>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="modal fade" id="view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Information</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-0">
                <table class="table">
                    <tr>
                        <td>Name</td>
                        <td id="name"></td>
                    </tr>
                    <tr>
                        <td>E-Mail</td>
                        <td id="email"></td>
                    </tr>
                    <tr>
                        <td>Contact No</td>
                        <td id="contactno"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td id="address"></td>
                    </tr>
                    <tr>
                        <td>Registration Date</td>
                        <td id="regdate"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <form method="POST">
                    <input type="hidden" name="id" id="id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button name="approve" type="submit" class="btn btn-primary">Approve</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/script.php') ?>
<script>
  $(function () {
    $("#owners-table").DataTable();
    $('#view').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var modal = $(this);

        modal.find('#id').val(button.data('id'));
        modal.find('#name').html(button.data('fname')+" "+button.data('lname'));
        modal.find('#email').html(button.data('email'));
        modal.find('#contactno').html(button.data('contactno'));
        modal.find('#address').html(button.data('address'));
        modal.find('#regdate').html(button.data('regdate'));
    });
  });
</script>
</body>
</html>