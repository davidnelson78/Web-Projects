<?php
require_once 'Connection.php';
require_once 'WineTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$connection = Connection::getInstance();
$gateway = new WineTableGateway($connection);

$statement = $gateway->getWines();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require "styles.php" ?>
        <meta charset="UTF-8">
        <title>UnWined</title>
    </head>
    <body>
        <div class ="container">
            <?php require 'toolbar.php' ?>
            <?php require 'header.php' ?>
            <?php require 'mainMenu.php' ?>
            `       <div class = "jumbotron">
                <div class = "container">
                    <center>
                        <h6 class="banner">Let's UnWined</h6>
                        <p><a href="registerForm.php" class="btn btn-default loginbt">Sign Up Today</a></p>
                    </center>
                </div>
            </div>
            <!-- row 2 -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-10S">
                        <h1> We have a drinking problem</h1>
                        <p>At UnWined we like to give you the best quality wines we can at the lowest prices possible. </p>
                    </div>
                </div>
                <!-- row 3 -->
                <div class="row spacer2">
                    <div class="col-md-3 col-xs-6">
                        <p><img src="img/wine1.png" alt="" class="img-responsive img-circle"></p>
                        <h4>we really like wine</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</p>
                        <p><a href="login.php" class="btn btn-default">Read more </a></p>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <p><img src="img/wine2.png" alt="" class="img-responsive img-circle"></p>
                        <h4>we really like wine</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </p>
                        <p><a href="login.php" class="btn btn-default">Read more </a></p>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <p><img src="img/wine1.png" alt="" class="img-responsive img-circle"></p>
                        <h4>we really like wine</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</p>
                        <p><a href="login.php" class="btn btn-default">Read more </a></p>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <p><img src="img/wine2.png" alt="" class="img-responsive img-circle"></p>
                        <h4>we really like wine</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</p>
                        <p><a href="login.php" class="btn btn-default">Read more </a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer"> </div> 
        <?php require 'footer.php'; ?>
    </body>
</html>
