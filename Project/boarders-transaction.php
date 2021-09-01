<?php
    require_once 'includes/validate.php';
    require 'includes/session.php';
    
    $query = $conn->query("SELECT * FROM `boarder`, `transaction`, `room`, `client`, `owner` WHERE boarder.boarder_id = transaction.t_boarder_id AND boarder.boarder_room_id = room.room_id AND boarder.boarder_client_id = client.client_id AND boarder.boarder_owner_id = owner.owner_id AND boarder.boarder_id = '$_REQUEST[boarder_id]'") or die(mysqli_error());
    $fetch = $query->fetch_array();

    if(ISSET($_POST['remove'])) {
        $clientid = $_POST['client_id'];
        $roomid = $_POST['room_id'];
        $conn->query("UPDATE `boarder` SET boarder_status = 'inactive' WHERE boarder_client_id = '$clientid'") or die(mysqli_error());
        $conn->query("UPDATE `room` SET room_status = 'available' WHERE room_id = '$roomid'") or die(mysqli_error());
        echo "<script>alert('Boarder Removed! Room Posted!');location.href='boarders.php'</script>";
    }
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item">Clients</li>
                            <li class="breadcrumb-item"><a href="boarders.php">Boarders</a></li>
                            <li class="breadcrumb-item active">Transaction Record</li>
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
                                <h4>Transaction Record</h4>                            
                            </div>
                            <?php
                            ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h4>Boarding House Rental
                                        <small class="float-right"><?php echo date("F j, Y"); ?></small></h4>
                                    </div>
                                </div>
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        OWNER
                                        <address>
                                            <strong><?php echo $fetch['owner_fname'] ?>&nbsp;<?php echo $fetch['owner_lname'] ?></strong><br>
                                            <?php echo $fetch['owner_address'] ?><br>
                                            Phone: <?php echo $fetch['owner_contact_no'] ?><br>
                                            Email: <?php echo $fetch['owner_email'] ?>
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        CLIENT
                                        <address>
                                            <strong><?php echo $fetch['client_fname'] ?>&nbsp;<?php echo $fetch['client_lname'] ?></strong><br>
                                            <?php echo $fetch['client_address'] ?><br>
                                            Phone: <?php echo $fetch['client_contact_no'] ?><br>
                                            Email: <?php echo $fetch['client_email'] ?>
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <b>Invoice #<?php echo $fetch['t_invoice'] ?></b><br>
                                        <b>Last Payment:</b> <?php echo $fetch['boarder_last_payment'] ?><br>
                                        <b>Status:</b> <?php if($fetch['boarder_status'] == 'active') { echo "ACTIVE"; } else { "inactive"; } ?><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Transaction Date</th>
                                                    <th>Room</th>
                                                    <th>Room Price (per month)</th>
                                                    <th>Months Paid</th>
                                                    <th>Month Paid</th>
                                                    <th>Due Date</th>
                                                    <th>Amount Paid</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $query = $conn->query("SELECT * FROM `boarder`, `transaction`, `room`, `client`, `owner` WHERE boarder.boarder_id = transaction.t_boarder_id AND boarder.boarder_room_id = room.room_id AND boarder.boarder_client_id = client.client_id AND boarder.boarder_owner_id = owner.owner_id AND transaction.t_boarder_id = '$_REQUEST[boarder_id]'") or die(mysqli_error());
                                                    while($fetch2 = $query->fetch_array()) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $fetch2['t_date'] ?></td>
                                                    <td><?php echo $fetch2['room_name'] ?></td>
                                                    <td>Php <?php echo $fetch2['room_price'] ?>.00</td>
                                                    <td><?php echo $fetch2['t_months'] ?> Month(s)</td>
                                                    <td><?php echo $fetch2['t_month_start'] ?></td>
                                                    <td><?php echo $fetch2['t_month_end'] ?></td>
                                                    <td>Php <?php echo $fetch2['t_total'] ?>.00</td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="lead">Payment Methods:</p>
                                        <img src="../assets/dashboard/img/credit/visa.png" alt="Visa">
                                        <img src="../assets/dashboard/img/credit/mastercard.png" alt="Mastercard">
                                        <img src="../assets/dashboard/img/credit/american-express.png" alt="American Express">
                                        <img src="../assets/dashboard/img/credit/paypal2.png" alt="Paypal">

                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                            This is for commercial use only.
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Monthly Payment</th>
                                                    <td>Php <?php echo $fetch['room_price'] ?>.00</td>
                                                </tr>
                                                <tr>
                                                    <th>Advance Payment Deposit</th>
                                                    <td><?php echo $fetch['room_advance'] ?> Month(s) (Php <?php echo $fetch['room_advance'] * $fetch['room_price']; ?> .00) </td>
                                                </tr>
                                                <tr>
                                                    <th>Total Months Paid:</th>
                                                    <td>
                                                        <?php 
                                                            $query2 = $conn->query("SELECT SUM(t_months) AS sum_months FROM `transaction` WHERE t_boarder_id = '$_REQUEST[boarder_id]'") or die(mysqli_error()); 
                                                            $sum = $query2->fetch_array();
                                                            echo $sum['sum_months'];
                                                        ?> Month(s)
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Total Payment:</th>
                                                    <td>Php&nbsp;
                                                        <?php 
                                                            $query2 = $conn->query("SELECT SUM(t_total) AS sum_total FROM `transaction` WHERE t_boarder_id = '$_REQUEST[boarder_id]'") or die(mysqli_error()); 
                                                            $sum = $query2->fetch_array();
                                                            echo $sum['sum_total'];
                                                        ?> .00
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#remove">&times; Remove Boarder</button>
                            </div>
                        </div>
                    <div>
                </div>
            </div>
        </section>
    </div>
    <?php include('includes/footer.php') ?>
</div>

<div class="modal fade" id="remove">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Remove Boarder</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
            <input type="hidden" name="client_id" value="<?php echo $fetch['boarder_client_id'] ?>">
            <input type="hidden" name="room_id" value="<?php echo $fetch['boarder_room_id'] ?>">
            <div class="modal-body">
                <p>Removing the Boarder means he/she left out the room. The room will be vacant and will be posted back.</p>
                <p>Are you sure you want to remove <strong><?php echo $fetch['client_fname'] ?>&nbsp;<?php echo $fetch['client_lname'] ?></strong>?</p>
            </div>
			<div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" name="remove" class="btn btn-danger float-right">Remove</button>
			</div>
			</form>
        </div>
    </div>
</div>

<?php include('includes/script.php') ?>
<script>
$(document).ready(function() {
    $('#boarders-table').DataTable();
})
</script>

</body>
</html>
