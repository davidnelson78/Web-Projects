<?php

$db_host = "uwmsois.com";
$db_user = "nelso596";
$db_pass = "T*hPj7KpL7gZ#&MoC^";
$db_name = "nelso596_guestbook";
$charset = "utf8";

$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$charset";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn, $db_user, $db_pass, $opt);

?>
