<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="../assets/dashboard/img/user.jpg" class="user-image img-circle elevation-2 alt="User Image">
                <span class="hidden-xs"><?php echo $fname?>&nbsp;<?php echo $lname?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="../assets/dashboard/img/user.jpg" class="img-circle elevation-2" alt="User Image">
                    <p><?php echo $fname?>&nbsp;<?php echo $lname?>
                        <small><?php echo $email?></small>
                        <small>Member since <?php echo date("F j, Y",strtotime($date))?></small>
                    </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                    <div class="row">
                    <div class="col-6 text-center">
                        <a href="javascript:void(0);"><i class="fas fa-user"></i> Profile</a>
                    </div>
                    <div class="col-6 text-center">
                        <a href="includes/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                    </div>
                    <!-- /.row -->
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->