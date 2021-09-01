<?php
    require_once 'includes/validate.php';
    require 'includes/session.php';
    
    $count = $conn->query("SELECT COUNT(*) as total FROM `inquire`, `owner`, `room` WHERE inquire.inq_room_id = room.room_id AND room.room_owner_id = owner.owner_id AND owner.owner_id = '$_SESSION[id]' AND inq_status = 'pending'") or die(mysqli_error());
    $inq = $count->fetch_array();
    $count2 = $conn->query("SELECT COUNT(*) as total FROM `boarder` WHERE boarder_owner_id = '$_SESSION[id]' AND boarder_status = 'active'") or die(mysqli_error());
    $boarders = $count2->fetch_array();
    $count3 = $conn->query("SELECT COUNT(*) as total FROM `room` WHERE room_owner_id = '$_SESSION[id]'") or die(mysqli_error());
    $rooms = $count3->fetch_array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
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
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo $inq['total'] ?></h3>
                                <p>Inquiries</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="inquiries.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3><?php echo $boarders['total'] ?></h3>
                                <p>Boarders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="boarders.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo $rooms['total'] ?></h3>
                                <p>Rooms</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-person-booth"></i>
                            </div>
                            <a href="rooms.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include('includes/footer.php') ?>
</div>

<?php include('includes/script.php') ?>

</body>
</html>
