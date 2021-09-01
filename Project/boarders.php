<?php
    require_once 'includes/validate.php';
    require 'includes/session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boarders</title>
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
                        <h1 class="m-0">Clients</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item">Clients</li>
                            <li class="breadcrumb-item active">Boarders</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h4>Boarders</h4>
                            </div>
                            <div class="card-body">
                                <table id="boarders-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact #</th>
                                            <th>Gender</th>
                                            <th>Room</th>
                                            <th>Last Payment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = $conn->query("SELECT * FROM `boarder`, `client`, `owner`, `room` WHERE boarder.boarder_client_id = client.client_id AND boarder.boarder_owner_id = owner.owner_id AND boarder.boarder_room_id = room.room_id AND boarder.boarder_status = 'active' AND boarder.boarder_owner_id = '$_SESSION[id]'") or die(mysqli_error());
                                            while($fetch = $query->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['client_fname'] ?>&nbsp;<?php echo $fetch['client_lname'] ?></td>
                                            <td><?php echo $fetch['client_contact_no'] ?></td>
                                            <td><?php echo $fetch['client_gender'] ?></td>
                                            <td><?php echo $fetch['room_name'] ?></td>
                                            <td><?php echo $fetch['boarder_last_payment'] ?></td>
                                            <td><?php echo $fetch['boarder_status'] ?></td>
                                            <td align="center">
                                                <a href="boarders-transaction.php?boarder_id=<?php echo $fetch['boarder_id'] ?>" class="btn btn-xs btn-outline-primary"><i class="fa fa-search"></i> Transaction</a>
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
    <?php include('includes/footer.php') ?>
</div>

<?php include('includes/script.php') ?>
<script>
$(document).ready(function() {
    $('#boarders-table').DataTable();
})
</script>

</body>
</html>
