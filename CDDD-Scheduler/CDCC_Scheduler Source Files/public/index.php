<?php
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Need two helper files:
    require ('../private/shared/login_functions.inc.php');
    require ('../private/shared/mysqli_connect.php');

    // Check the login:
    list ($check, $data) = check_login($dbc, $_POST['username'], $_POST['password']);

    if ($check) { // OK!
        // Set the session data:
        session_start();
        $_SESSION['employee_id'] = $data['employee_id'];
        $_SESSION['first_name'] = $data['first_name'];
        $_SESSION['admin'] = $data['manager_indicator'];
        $_SESSION['username'] = $data['email'];

        // Store the HTTP_USER_AGENT:
        $_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

        // Redirect:
        redirect_user('/dashboard.php');
    } else { // Unsuccessful!
        // Assign $data to $errors for login_page.inc.php:
        $errors = $data;
    }

    mysqli_close($dbc); // Close the database connection.
} // End of the main submit conditional.
?>

<?php
// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
    echo '<h1>Error!</h1>
    <p class="error">The following error(s) occurred:<br />';
    foreach ($errors as $msg) {
        echo " - $msg<br />\n";
    }
    echo '</p><p>Please try again.</p>';
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

        <title>CD&CC - Login</title>

        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body class="bg-gradient-primary">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">City Dome & Convention Center Login</h1>
                                        </div>
                                        <form action="index.php" method="post" class="user">
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" name="username" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <input class="btn btn-primary" type="submit" name="submit" value="Login" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../js/sb-admin-2.min.js"></script>

    </body>

</html>
