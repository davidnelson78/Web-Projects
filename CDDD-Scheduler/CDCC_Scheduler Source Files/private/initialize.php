<?php

session_start(); // Start the session.
//file paths
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH, '/public');
define("SHARED_PATH", PRIVATE_PATH, '/shared');
define("WWW_ROOT", "");
// If no session value is present, redirect the user:
if (!isset($_SESSION['agent']) OR ( $_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

    // Need the functions:
    require ('shared/login_functions.inc.php');

    // Redirect the user:
    header("Location: https://group3.uwmsois.com/CDCC-Scheduler/public/index.php");
    exit(); // Quit the script.
}
include('shared/mysqli_connect.php');

