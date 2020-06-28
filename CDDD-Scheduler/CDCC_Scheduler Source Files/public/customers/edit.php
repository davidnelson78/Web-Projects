<?php
include('../../private/shared/mysqli_connect.php');


// Create code friendly handles for select form data elements
$business_id = $_POST['business_id'];
$business_name = $_POST['business_name'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip_code = $_POST['zip_code'];
$email_address = $_POST['email_address'];
$phone_number = $_POST['phone_number'];

// Test for update request from GET
$updaterequest = !empty($_GET);

$updateid = $_GET['customer_id'];

if ($updaterequest && !($_SERVER['REQUEST_METHOD'] === 'POST')) {

    // SQL to retrieve database record
    $sql = "SELECT business_id, business_name, first_name, last_name, address, city, state, zip_code, email_address, phone_number
        FROM customer WHERE customer_id = $updateid";

    // Execute SQL and save result
    $result = mysqli_query($dbc, $sql);

    $row = mysqli_fetch_row($result);

    $business_id = $row['0'];
    $business_name = $row['1'];
    $first_name = $row['2'];
    $last_name = $row['3'];
    $address = $row['4'];
    $city = $row['5'];
    $state = $row['6'];
    $zip_code = $row['7'];
    $email_address = $row['8'];
    $phone_number = $row['9'];
}

/* Set logic handling variables named to improve readability */
$fieldsfilled = false;
$firstpageload = empty($_POST);

// Create arrays for processing conditions on data elements
$rlist = array('business_id', 'business_name', 'first_name', 'last_name', 'address', 'city', 'state', 'zip_code', 'email_address', 'phone_number');

/* Determine page state and if any required fields are empty */
if (!$firstpageload) {
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
                                <h6 class="m-0 font-weight-bold text-primary">Edit this customer</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <form class="clear" id="fcform" action=<?php
                                    /* Determine if form is good to proceed to confirmation page */
                                    if ($firstpageload || !$fieldsfilled) {
                                        echo "\"edit.php?id=$updateid\"";
                                    } else {
                                        echo "\"edithandle.php?id=$updateid\"";
                                        $autosubmit = true;
                                    }
                                    ?>method="post">
                                        <div class="form-group">
                                            <input type="text" name="business_id" class="form-control form-control-user" id="InputBusinessID" placeholder="Business ID" value="<?php
                                            echo "$business_id";
                                            ?>"/><?php
                                                   /* Determine if field needed */
                                                   if ($_POST['business_id'] == NULL && !$firstpageload) {
                                                       echo "<span class='valid'>* Business ID Required</span>";
                                                   }
                                                   ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="business_name" class="form-control form-control-user" id="InputBusinessName" placeholder="Business Name" value="<?php
                                            echo "$business_name";
                                            ?>"/><?php
                                                   /* Determine if field needed */
                                                   if ($_POST['business_name'] == NULL && !$firstpageload) {
                                                       echo "<span class='valid'>* Business Name Required</span>";
                                                   }
                                                   ?>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <input type="text" name="first_name" class="form-control form-control-user" id="InputFirstName" placeholder="First Name" value="<?php
                                                echo "$first_name";
                                                ?>"/><?php
                                                       /* Determine if field needed */
                                                       if ($_POST['first_name'] == NULL && !$firstpageload) {
                                                           echo "<span class='valid'>* First Name Required</span>";
                                                       }
                                                       ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="last_name" class="form-control form-control-user" id="InputLastName" placeholder="Last Name" value="<?php
                                                echo "$last_name";
                                                ?>"/><?php
                                                       /* Determine if field needed */
                                                       if ($_POST['last_name'] == NULL && !$firstpageload) {
                                                           echo "<span class='valid'>* Last Name Required</span>";
                                                       }
                                                       ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="address" class="form-control form-control-user" id="InputAddress" placeholder="Address" value="<?php
                                            echo "$address";
                                            ?>"/><?php
                                                   /* Determine if field needed */
                                                   if ($_POST['address'] == NULL && !$firstpageload) {
                                                       echo "<span class='valid'>* Address Required</span>";
                                                   }
                                                   ?>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <input type="text" name="city" class="form-control form-control-user" id="InputCity" placeholder="City" value="<?php
                                                echo "$city";
                                                ?>"/><?php
                                                       /* Determine if field needed */
                                                       if ($_POST['city'] == NULL && !$firstpageload) {
                                                           echo "<span class='valid'>* City Required</span>";
                                                       }
                                                       ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="state" class="form-control form-control-user" id="InputState" placeholder="State" value="<?php
                                                echo "$state";
                                                ?>"/><?php
                                                       /* Determine if field needed */
                                                       if ($_POST['state'] == NULL && !$firstpageload) {
                                                           echo "<span class='valid'>* State Required</span>";
                                                       }
                                                       ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="zip_code" class="form-control form-control-user" id="InputZip" placeholder="Zip Code" value="<?php
                                                echo "$zip_code";
                                                ?>"/><?php
                                                       /* Determine if field needed */
                                                       if ($_POST['zip_code'] == NULL && !$firstpageload) {
                                                           echo "<span class='valid'>* Zip Code Required</span>";
                                                       }
                                                       ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="email_address" class="form-control form-control-user" id="InputEmail" placeholder="Email" value="<?php
                                            echo "$email_address";
                                            ?>"/><?php
                                                   /* Determine if field needed */
                                                   if ($_POST['email_address'] == NULL && !$firstpageload) {
                                                       echo "<span class='valid'>* Email Required</span>";
                                                   }
                                                   ?>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="phone_number" class="form-control form-control-user" id="InputPhone" placeholder="Phone Number" value="<?php
                                            echo "$phone_number";
                                            ?>"/><?php
                                                   /* Determine if field needed */
                                                   if ($_POST['phone_number'] == NULL && !$firstpageload) {
                                                       echo "<span class='valid'>* Phone Number Required</span>";
                                                   }
                                                   ?>
                                        </div>
                                        <div>
                                            <button class="btn btn-primary" type="submit" data-dismiss="modal">Submit Changes</button>
                                        </div>
                                        <br>
                                    </form>
                                    <?php
                                    if ($autosubmit) {
                                        //Submit form if all required fields are filled out
                                        echo"<script>document.getElementById('fcform').submit();</script> ";
                                    }
                                    ?>
                                    <div >
                                        <a class="btn btn-secondary" href="./customers.php">Back to Customers</a>
                                    </div>
                                    <br>
                                </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- End of Main Content -->
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
