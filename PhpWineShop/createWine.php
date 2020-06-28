<?php
require_once 'Connection.php';
require_once 'WineTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new WineTableGateway($connection);

$wine           = filter_input(INPUT_POST, 'wine',          FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$description    = filter_input(INPUT_POST, 'description',   FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$year           = filter_input(INPUT_POST, 'year',          FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$temperature    = filter_input(INPUT_POST, 'temperature',   FILTER_SANITIZE_NUMBER_INT);
$type           = filter_input(INPUT_POST, 'type',          FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$wineryId       = filter_input(INPUT_POST, 'winery_id',     FILTER_SANITIZE_NUMBER_INT);
if ($managerId == -1) {
    $managerId = NULL;
}

$id = $gateway->insertWine($wine, $description, $year, $temperature, $type, $wineryId);

header('Location: viewWines.php');
