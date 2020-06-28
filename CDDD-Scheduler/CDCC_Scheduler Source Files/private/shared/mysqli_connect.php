<?php

// Set the database access information as constants:
DEFINE('DB_USER', 'group3_dave');
DEFINE('DB_PASSWORD', 'Nelly2307!');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'group3_cdancc');

// Make the connection:
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error());

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');


