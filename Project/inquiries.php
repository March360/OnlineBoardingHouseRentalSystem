<?php
    require_once 'includes/validate.php';
    require 'includes/session.php';

	if(ISSET($_POST['payment'])) {
		$roomid = $_POST['room_id'];
		$clientid = $_POST['client_id'];
		$ownerid = $_POST['owner_id'];
        $month = $_POST['month'];
        $start = $_POST['start'];
        $end = $_POST['end'];
		$total = $_POST['total'];
		$ran = rand(000,99999);
		$date = date('dmyHsi');
		$inv = 'INV-'.$ran.$date;
		$conn->query("INSERT INTO `boarder` (boarder_client_id, boarder_room_id, boarder_owner_id, boarder_last_payment) VALUES ('$clientid', '$roomid', '$ownerid', now())") or die(mysqli_error());
        $boarderid = mysqli_insert_id($conn);
		$conn->query("INSERT INTO `transaction` (t_invoice, t_boarder_id, t_months, t_month_start, t_month_end, t_total, t_date) VALUES ('$inv', '$boarderid', '$month', '$start', '$end', '$total', now())") or die(mysqli_error());
		$conn->query("UPDATE `inquire` SET inq_status = 'approve' WHERE `inq_room_id` = '$roomid' AND `inq_client_id` = $clientid") or die(mysqli_error());
		$conn->query("UPDATE `room` SET room_status = 'occupied' WHERE room_id = '$roomid'") or die(mysqli_error());
		$query = $conn->query("SELECT * FROM `inquire` WHERE inq_room_id = '$roomid'") or die(mysqli_error());
		while($fetch = $query->fetch_array()) {
			$conn->query("UPDATE `inquire` SET inq_status = 'done' WHERE `inq_id` = '$fetch[inq_id]'") or die(mysqli_error());
		}
		echo "<script>alert('Transaction Complete!')</script>";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inquiries</title>
  <?php include('includes/link.php') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

<div class="wrapper">
    <?php include('includes/header.php') ?>
    <?php include('includes/sidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Clients</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item">Clients</li>
                        <li class="breadcrumb-item active">Inquiries</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h4>Inquiries</h4>
                            </div>
                            <div class="card-body">
                                <table id="clients-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Room Inquiry</th>
                                            <th>Contact #</th>
                                            <th>E-Mail</th>
                                            <th>Gender</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  
                                            $query = $conn->query("SELECT * FROM `inquire`, `room`, `client`, `owner` WHERE room.room_id = inquire.inq_room_id AND client.client_id = inquire.inq_client_id AND owner.owner_id = room.room_owner_id AND room.room_owner_id = '$_SESSION[id]' AND inquire.inq_status = 'pending'") or die(mysqli_error());
                                            while($fetch = $query->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['client_fname'] ?>&nbsp;<?php echo $fetch['client_lname'] ?></td>
                                            <td><?php echo $fetch['room_name'] ?></td>
                                            <td><?php echo $fetch['client_contact_no'] ?></td>
                                            <td><?php echo $fetch['client_email'] ?></td>
                                            <td><?php echo $fetch['client_gender'] ?></td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#view"
                                                            data-client_fname="<?php echo $fetch['client_fname'] ?>"
                                                            data-client_lname="<?php echo $fetch['client_lname'] ?>"
                                                            data-client_email="<?php echo $fetch['client_email'] ?>"
                                                            data-client_contactno="<?php echo $fetch['client_contact_no'] ?>"
                                                            data-client_gender="<?php echo $fetch['client_gender'] ?>"
                                                            data-client_address="<?php echo $fetch['client_address'] ?>"
                                                            data-client_status="<?php echo $fetch['client_status'] ?>"
                                                            data-room_name="<?php echo $fetch['room_name'] ?>"
                                                            data-room_location="<?php echo $fetch['room_location'] ?>"
                                                            data-room_price="<?php echo $fetch['room_price'] ?>"
                                                            data-room_dimension="<?php echo $fetch['room_dimension'] ?>"
                                                            data-room_capacity="<?php echo $fetch['room_capacity'] ?>"
                                                            data-room_bed="<?php echo $fetch['room_bed'] ?>"><i class="fa fa-eye"></i> View</button>
                                                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#approve"
															data-client_id="<?php echo $fetch['client_id'] ?>"
                                                            data-client_fname="<?php echo $fetch['client_fname'] ?>"
                                                            data-client_lname="<?php echo $fetch['client_lname'] ?>"
                                                            data-client_email="<?php echo $fetch['client_email'] ?>"
                                                            data-client_contactno="<?php echo $fetch['client_contact_no'] ?>"
                                                            data-client_gender="<?php echo $fetch['client_gender'] ?>"
                                                            data-client_address="<?php echo $fetch['client_address'] ?>"
                                                            data-client_status="<?php echo $fetch['client_status'] ?>"
                                                            data-room_id="<?php echo $fetch['room_id'] ?>"
                                                            data-room_owner_id="<?php echo $fetch['room_owner_id'] ?>"
                                                            data-room_name="<?php echo $fetch['room_name'] ?>"
                                                            data-room_location="<?php echo $fetch['room_location'] ?>"
                                                            data-room_price="<?php echo $fetch['room_price'] ?>"
                                                            data-room_advance="<?php echo $fetch['room_advance'] ?>"
                                                            data-room_dimension="<?php echo $fetch['room_dimension'] ?>"
                                                            data-room_capacity="<?php echo $fetch['room_capacity'] ?>"
                                                            data-room_bed="<?php echo $fetch['room_bed'] ?>"
															data-owner_fname="<?php echo $fetch['owner_fname'] ?>"
															data-owner_lname="<?php echo $fetch['owner_lname'] ?>"
															data-owner_address="<?php echo $fetch['owner_address'] ?>"
															data-owner_contactno="<?php echo $fetch['owner_contact_no'] ?>"
															data-owner_email="<?php echo $fetch['owner_email'] ?>"><i class="fa fa-check"></i> Approve</button>
                                                </div>
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
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php include('includes/footer.php') ?>
</div><!-- ./wrapper -->

<div class="modal fade" id="view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Inquiry</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center pb-4">
                            <h4>Client Information</h4>
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <p id="view-name"></p>
                        </div>
                        <div class="form-group">
                            <label for="">E-Mail</label>
                            <p id="view-email"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Contact #</label>
                            <p id="view-contact"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <p id="view-gender"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <p id="view-address"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <p id="view-status"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center pb-4">
                            <h4>Room Information</h4>
                        </div>
                        <div class="form-group">
                            <label for="">Room Name</label>
                            <p id="view-room-name"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Room Location</label>
                            <p id="view-location"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Room Price</label>
                            <p id="view-price"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Room Dimensions</label>
                            <p id="view-dimension">/p>
                        </div>
                        <div class="form-group">
                            <label for="">Room Capacity</label>
                            <p id="view-capacity"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Bed Size</label>
                            <p id="view-bed"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="approve">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Approval Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              	<div class="row invoice-info">
                	<div class="col-sm-6 invoice-col">
						Owner
						<address>
							<strong id="approve-owner-name"></strong><br>
							<span id="approve-owner-address"></span><br>
							<span id="approve-owner-contactno"></span><br>
							<span id="approve-owner-email"></span>
						</address>
					</div>
					<div class="col-sm-6 invoice-col">
						Client
						<address>
							<strong id="approve-client-name"></strong><br>
							<span id="approve-client-address"></span><br>
							<span id="approve-client-contactno"></span><br>
							<span id="approve-client-email"></span>
						</address>
					</div>
				</div>
              	<div class="row">
                	<div class="col-12 table-responsive">
                  		<table class="table table-striped">
                    		<thead>
								<tr>
									<th>Room</th>
									<th>Location</th>
									<th>Dimension</th>
									<th>Bed</th>
									<th>Capacity</th>
									<th>Price (monthly)</th>
								</tr>
                   			</thead>
                    		<tbody>
								<tr>
									<td id="approve-room-name"></td>
									<td id="approve-room-location"></td>
									<td id="approve-room-dimension"></td>
									<td id="approve-room-bed"></td>
									<td id="approve-room-capacity">)</td>
									<td id="approve-room-price"></td>
								</tr>
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
							This is only for commercial use.
						</p>
					</div>
					<div class="col-6">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<th style="width:50%">Monthly Payment</th>
									<td id="approve-monthly-payment"></td>
								</tr>
								<tr>
									<th style="width:50%">Advance Payment Deposit</th>
									<td><span id="approve-room-advance"></span> Months (<span id="approve-advance-payment"></span>)</td>
								</tr>
			<form method="POST" enctype="multipart/form-data">
                                <tr>
									<th>Month to Start:</th>
									<td><input type="date" name="start" class="form-control" id="approve-start" min="<?php echo date("Y-m-d") ?>" value="<?php echo date("Y-m-d") ?>" required></td>
								</tr>
								<tr>
									<th>Months to Stay:</th>
									<td><input type="number" name="month" class="form-control" id="approve-stay" min="1" placeholder="Months" required></td>
								</tr>
								<tr>
									<th>Total Payment:</th>
									<td><strong id="approve-total-payment"></strong></td>
								</tr>
								<tr>
									<th>Cash Payment:</th>
									<td><input type="number" id="approve-cash" class="form-control" placeholder="Php." required></td>
								</tr>
								<tr>
									<th>Change:</th>
									<td><strong id="approve-change"></strong></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="room_id" id="approve-room-id" required>
			<input type="hidden" name="client_id" id="approve-client-id" required>
			<input type="hidden" name="owner_id" id="approve-owner-id" required>
            <input type="hidden" name="end" id="approve-month-end" required>
			<input type="hidden" name="total" id="approve-total" required>

			<div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" name="payment" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
					Payment
				</button>
			</div>
			</form>
        </div>
    </div>
</div>

<?php include('includes/script.php') ?>
<script>
$(document).ready(function() {
    $("#clients-table").DataTable();
    $('#view').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var modal = $(this);

        modal.find('#view-name').html(button.data('client_fname')+" "+button.data('client_lname'));
        modal.find('#view-email').html(button.data('client_email'));
        modal.find('#view-contact').html(button.data('client_contactno'));
        modal.find('#view-gender').html(button.data('client_gender'));
        modal.find('#view-address').html(button.data('client_address'));
        modal.find('#view-status').html(button.data('client_status'));
        modal.find('#view-room-name').html(button.data('room_name'));
        modal.find('#view-location').html(button.data('room_location'));
        modal.find('#view-price').html("Php "+button.data('room_price')+".00");
        modal.find('#view-dimension').html(button.data('room_dimension'));
        modal.find('#view-capacity').html(button.data('room_capacity'));
        modal.find('#view-bed').html(button.data('room_bed'));
    });
	$('#approve').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget);
        var modal = $(this);
		
        modal.find('#approve-owner-name').html(button.data('owner_fname')+" "+button.data('owner_lname'));
        modal.find('#approve-owner-email').html(button.data('owner_email'));
        modal.find('#approve-owner-contactno').html(button.data('owner_contactno'));
        modal.find('#approve-owner-address').html(button.data('owner_address'));
        modal.find('#approve-client-name').html(button.data('client_fname')+" "+button.data('client_lname'));
        modal.find('#approve-client-email').html(button.data('client_email'));
        modal.find('#approve-client-contactno').html(button.data('client_contactno'));
        modal.find('#approve-client-gender').html(button.data('client_gender'));
        modal.find('#approve-client-address').html(button.data('client_address'));
        modal.find('#approve-room-name').html(button.data('room_name'));
        modal.find('#approve-room-location').html(button.data('room_location'));
        modal.find('#approve-room-price').html("Php "+button.data('room_price')+".00");
        modal.find('#approve-room-advance').html(button.data('room_advance'));
        modal.find('#approve-room-dimension').html(button.data('room_dimension'));
        modal.find('#approve-room-capacity').html(button.data('room_capacity'));
        modal.find('#approve-room-bed').html(button.data('room_bed'));
        modal.find('#approve-monthly-payment').html("Php "+button.data('room_price')+".00");

		var advance = button.data('room_price') * button.data('room_advance');
		modal.find('#approve-advance-payment').html("Php "+advance+".00");

		$('#approve-stay').on('input', function() {
			var month = $(this).val();
            var start = $('#approve-start').val();
            var end = moment(start).add(month, 'months').format('YYYY-MM-DD');
			var total = (month * button.data('room_price')) + advance;
			
			modal.find('#approve-total-payment').html("Php "+total+".00");
			
			modal.find('#approve-room-id').val(button.data('room_id'));
			modal.find('#approve-client-id').val(button.data('client_id'));
			modal.find('#approve-owner-id').val(button.data('room_owner_id'));
			modal.find('#approve-month-end').val(end);
			modal.find('#approve-total').val(total);
		});
        $('#approve-cash').on('input', function() {
            var cash = $(this).val();
			var total = ($('#approve-stay').val() * button.data('room_price')) + advance;
            var totalpayment = cash - total;

            if(cash < total) {
                modal.find('#approve-change').html("INVALID");
            } else {
                modal.find('#approve-change').html("Php "+totalpayment+".00");
            }
        });
	});
});
</script>

</body>
</html>
