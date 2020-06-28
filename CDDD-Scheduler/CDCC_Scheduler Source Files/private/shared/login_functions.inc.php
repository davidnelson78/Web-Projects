<?php

// This page defines two functions used by the login/logout process.
function redirect_user($page = 'index.php') {

    // Start defining the URL...
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

    // Remove any trailing slashes:
    $url = rtrim($url, '/\\');

    // Add the page:
    $url .= '/' . $page;

    // Redirect the user:
    header("Location: $url");
    exit(); // Quit the script.
}

// End of redirect_user() function.
//This function validates the form data (the email address and password).
function check_login($dbc, $email = '', $password = '') {
    $errors = array(); // Initialize error array.
    // Validate the email address:
    if (empty($email)) {
        $errors[] = 'You forgot to enter your email.';
    } else {
        $e = mysqli_real_escape_string($dbc, trim($email));
    }
    // Validate the password:
    if (empty($password)) {
        $errors[] = 'You forgot to enter your password.';
    } else {
        $p = mysqli_real_escape_string($dbc, trim($password));
    }
    if (empty($errors)) {
        // Retrieve the user_id and first_name for that email/password combination:
        $q = "SELECT employee_id, first_name, manager_indicator, email FROM employee WHERE email='$e' AND password='$p'";
        $r = mysqli_query($dbc, $q); // Run the query.
        // Check the result:
        if (mysqli_num_rows($r) == 1) {

            // Fetch the record:
            $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

            // Return true and the record:
            return array(true, $row);
        } else { // Not a match!
            $errors[] = 'The email and password entered do not match those on file.';
        }
    } // End of empty($errors) IF.
    return array(false, $errors);
}

// End of check_login() function.

