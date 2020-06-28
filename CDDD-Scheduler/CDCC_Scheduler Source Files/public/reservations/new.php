<?php
include('../../private/shared/mysqli_connect.php');

/* Set logic handling variables named to improve readability */
$fieldsfilled = false;
$firstpageload = empty($_POST);
if (
        $_POST['customer'] != "Select Customer" &&
        $_POST['venue'] != "Select Venue") {

    $ddsfilled = true;
} else {
    $ddsfilled = false;
}


// Create arrays for processing conditions on data elements
$rlist = array('customer', 'date', 'start-time', 'end-time', 'venue');

// Create code friendly handles for select form data elements
$reservation_date = $_POST['date'];
$start_time = $_POST['start-time'];
$end_time = $_POST['end-time'];


/* Determine page state and if any required fields are empty */
if (!$firstpageload && $ddsfilled) {
    foreach ($rlist as $vval) {
        if ($_POST[$vval] == NULL) {
            $fieldsfilled = false;
            break;
        } else {
            $fieldsfilled = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>CD&CC Scheduler</title>

        <!-- Custom fonts for this template -->
        <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
        <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../dashboard.php">
                    <div class="sidebar-brand-text mx-3">CD&CC Admin</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="../dashboard.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Events
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Reservations</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="../reservations/new.php">Book</a>
                            <a class="collapse-item" href="../reservations/reservations.php">View</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../venues/venues.php">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Venues</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Records
                </div>

                <!-- Nav Item - Pages Collapse Menu -->

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="../customers/customers.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Customers</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/employees.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Employees</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Book an Event</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <form id="fcform" class="clear" action=<?php
                                    /* Determine if form is good to proceed to confirmation page */
                                    if ($firstpageload || !$fieldsfilled) {
                                        echo '"new.php "';
                                    } else {
                                        echo '"newhandle.php "';
                                        $autosubmit = true;
                                    }
                                    ?>method="post">
                                        <div class="form-group">
                                            <select name="customer">
                                                <option>Select Customer</option>
                                                <?php
                                                // SQL to retrieve database records with formatted date result
                                                $sql = "SELECT customer_id, first_name, last_name FROM customer order by last_name";

                                                // Execute SQL and save result
                                                $result = mysqli_query($dbc, $sql);

                                                // Loop through each row returned by datbase
                                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                    if ($_POST['customer'] == $row['customer_id']) {
                                                        echo '<option value="' . $row['customer_id'] . '" selected>' . $row['last_name'] . ', ' . $row['first_name'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $row['customer_id'] . '">' . $row['last_name'] . ', ' . $row['first_name'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select><?php
                                            /* Determine if field is not filled */
                                            if ($_POST['customer'] == "Select Customer") {
                                                echo "<span class='valid'>* Customer Required</span><br/>";
                                            }
                                            ?>
                                        </div>
                                        <div>
                                            <a href="../customers/new.php" class="btn btn-primary">New Customer?</a>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <span class="form-label">Event date</span>
                                            <input class="form-control" type="date" value="<?php
                                            /* Determine if date to keep exists */
                                            if ($_POST['date'] != NULL) {
                                                echo "$reservation_date";
                                            }
                                            ?>"required><?php
                                                   /* Determine if field needed */
                                                   if ($_POST['date'] == NULL && !$firstpageload) {
                                                       echo "<span class='valid'>* Date required</span><br/>";
                                                   }
                                                   ?>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span class="form-label">Event start time</span>
                                                    <input class="form-control" type="time" name="start-time" value="<?php
                                                    /* Determine if date to keep exists */
                                                    if ($_POST['start-time'] != NULL) {
                                                        echo "$start_time";
                                                    }
                                                    ?>"required><?php
                                                           /* Determine if field needed */
                                                           if ($_POST['start-time'] == NULL && !$firstpageload) {
                                                               echo "<span class='valid'>* Start time required</span><br/>";
                                                           }
                                                           ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span class="form-label">Event end time</span>
                                                    <input class="form-control" type="time" name="end-time" value="<?php
                                                    /* Determine if date to keep exists */
                                                    if ($_POST['end-time'] != NULL) {
                                                        echo "$end_time";
                                                    }
                                                    ?>"required><?php
                                                           /* Determine if field needed */
                                                           if ($_POST['end-time'] == NULL && !$firstpageload) {
                                                               echo "<span class='valid'>* End time required</span><br/>";
                                                           }
                                                           ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <select name="venue">
                                                <option>Select Venue</option>
                                                <?php
                                                // SQL to retrieve database records with formatted date result
                                                $sql = "SELECT venue_id, venue_name FROM venue order by venue_name";

                                                // Execute SQL and save result
                                                $result = mysqli_query($dbc, $sql);

                                                // Loop through each row returned by datbase
                                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                    if ($_POST['venue'] == $row['venue_id']) {
                                                        echo '<option value="' . $row['venue_id'] . '" selected>' . $row['venue_name'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $row['venue_id'] . '">' . $row['venue_name'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select><?php
                                            /* Determine if field is not filled */
                                            if ($_POST['venue'] == "Select Venue") {
                                                echo "<span class='valid'>* Venue Required</span><br/>";
                                            }
                                            ?>
                                        </div>
                                        <br>
                                        <div>
                                            <button class="btn btn-primary" type="submit" >Book this Reservation</button>
                                        </div>
                                        <br>
                                    </form>
                                    <?php
                                    if ($autosubmit) {
                                        //Submit form if all required fields are filled out
                                        echo"<script>document.getElementById('fcform').submit();</script> ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                        <!-- End of Main Content -->
                    </div>
                </div>

                <!-- End of Content Wrapper -->
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; City Dome and Convention Center 2020</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Page Wrapper -->
        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="../../private/shared/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="../../vendor/jquery/jquery.min.js"></script>
        <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../../js/sb-admin-2.min.js"></script>
        <script src="../../js/datatables.js"></script>

        <!-- Page level plugins -->
        <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    </body>

</html>
