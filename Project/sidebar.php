<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link">
        <img src="../assets/dashboard/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Online Rental</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../assets/dashboard/img/user.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="javascript:void(0);" class="d-block"><?php echo $fname?>&nbsp;<?php echo $lname?></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'dashboard.php') { ?> active <?php } ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="rooms.php" class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'rooms.php') { ?> active <?php } ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Room</p>
                    </a>
                </li>
                <li class="nav-item <?php if((basename($_SERVER['PHP_SELF']) == 'inquiries.php') || (basename($_SERVER['PHP_SELF']) == 'boarders.php')) { ?> menu-open <?php } ?>">
                    <a href="javascript:void(0);" class="nav-link <?php if((basename($_SERVER['PHP_SELF']) == 'inquiries.php') || (basename($_SERVER['PHP_SELF']) == 'boarders.php')) { ?> active <?php } ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Client<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="inquiries.php" class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'inquiries.php') { ?> active <?php } ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Inquiries</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="boarders.php" class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'boarders.php') { ?> active <?php } ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Boarders</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="payments.php" class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'payments.php') { ?> active <?php } ?>">
                        <i class="nav-icon fa fa-cash-register"></i> <p>Payment</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="transaction.php" class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'transaction.php') { ?> active <?php } ?>">
                        <i class="nav-icon fa fa-file-invoice"></i> <p>Transactions</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>