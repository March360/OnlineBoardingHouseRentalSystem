<?php
    require_once 'includes/validate.php';
    require 'includes/session.php';
    
    $query = $conn->query("SELECT * FROM `boarder`, `transaction`, `room`, `client`, `owner` WHERE boarder.boarder_id = transaction.t_boarder_id AND boarder.boarder_room_id = room.room_id AND boarder.boarder_client_id = client.client_id AND boarder.boarder_owner_id = owner.owner_id AND boarder.boarder_id = '$_REQUEST[boarder_id]'") or die(mysqli_error());
    $fetch = $query->fetch_array();

    if(ISSET($_POST['submit'])) {
        $invoice = $_POST['invoice'];
        $boarderid = $_POST['boarder_id'];
        $months = $_POST['months'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $total = $_POST['total'];

        $conn->query("INSERT INTO `transaction` (t_invoice, t_boarder_id, t_months, t_month_start, t_month_end, t_total, t_date) VALUES ('$invoice', '$boarderid', '$months', '$start', '$end', '$total', now())") or die(mysqli_error());
        $conn->query("UPDATE `boarder` SET boarder_last_payment = now() WHERE boarder_id = '$_REQUEST[boarder_id]'");
        echo "<script>alert('Payment Successful!')</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment</title>
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="payments.php">Payments</a></li>
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
                                                    <td><?php echo $fetch['room_advance'] ?> Months(s)</td>
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
                                            <table class="table" id="payment-table" style="display:none;">
                                                <form method="POST">
                                                    <?php 
                                                        $query3 = $conn->query("SELECT * FROM `transaction` WHERE t_boarder_id = '$_REQUEST[boarder_id]' ORDER BY t_id DESC LIMIT 1") or die(mysqli_error()); 
                                                        $last = $query3->fetch_array();
                                                    ?>
                                                <tr>
                                                    <th>Month Last Paid:</th>
                                                    <td><input type="date" name="start" class="form-control" id="start" min="<?php echo date("Y-m-d") ?>" value="<?php echo $last['t_month_end'] ?>" disabled required></td>
                                                </tr>
                                                <tr>
                                                    <th>Months to Pay:</th>
                                                    <td><input type="number" name="month" id="months-to-pay" class="form-control" min="1" placeholder="Months" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Total Payment:</th>
                                                    <td><strong id="total-payment"></strong></td>
                                                </tr>
                                                <tr>
                                                    <th>Cash Payment:</th>
                                                    <td><input type="number" id="cash-payment" class="form-control" placeholder="Php." disabled required></td>
                                                </tr>
                                                <tr>
                                                    <th>Change:</th>
                                                    <td><strong id="change"></strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="invoice" value="<?php echo $fetch['t_invoice'] ?>">
                                <input type="hidden" name="months" id="months-post">
                                <input type="hidden" name="boarder_id" value="<?php echo $fetch['t_boarder_id'] ?>">
                                <input type="hidden" name="start" value="<?php echo $last['t_month_end'] ?>">
                                <input type="hidden" name="end" id="month-end">
                                <input type="hidden" name="total" id="total-pay">
                                <div class="row no-print" id="additional-payment">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-success float-right"><i class="fa fa-plus"></i> Additional Payment</button>
                                    </div>
                                </div>
                                <div class="row no-print" id="submit-payment" style="display:none;">
                                    <div class="col-12">
                                        <button type="submit" name="submit" id="submit-btn" class="btn btn-success float-right" disabled><i class="far fa-credit-card"></i> Submit
                                            Payment
                                        </button>
                                        <button type="button" class="btn btn-default float-right" id="submit-payment-button" style="margin-right: 5px;"> Cancel
                                        </button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    <div>
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
    $('#additional-payment').on('click', function() {
        $(this).hide();
        $('#submit-payment').show();
        $('#payment-table').show();
    });
    $('#submit-payment-button').on('click', function() {
        $('#submit-payment').hide();
        $('#payment-table').hide();
        $('#additional-payment').show();
    });
    $('#months-to-pay').on('input', function() {
        var month = $(this).val();
        var start = $('#start').val();
        var end = moment(start).add(month, 'months').format('YYYY-MM-DD');
        var total = month * <?php echo $fetch['room_price'] ?>;
        
        $('#total-payment').html("Php "+total+".00");
        
        $('#months-post').val(month);
        $('#month-end').val(end);
        $('#total').val(total);
        $('#total-pay').val(total);
        $('#cash-payment').val("").prop('disabled', false);
        $('#submit-btn').prop('disabled', true);
        $('#change').html("INVALID");
    });
    $('#cash-payment').on('input', function() {
        var cash = $(this).val();
        var total = $('#months-to-pay').val() * <?php echo $fetch['room_price'] ?>;
        var totalpayment = cash - total;

        if(cash < total) {
            $('#change').html("INVALID");
            $('#submit-btn').prop('disabled', true);
        } else {
            $('#change').html("Php "+totalpayment+".00");
            $('#submit-btn').prop('disabled', false);
        }
    });
})
</script>

</body>
</html>
