<?php

require_once('../../private/initialize.php');
// Test for admin user and admin page
if ($_SESSION['admin'] != 1 && basename(dirname((__FILE__))) == "admin") { // Not an admin and admin page
    echo '<h2>' . $_SESSION['username'] . ' not authorized for user admin functions</h2>';
    exit();
}

