<?php
require_once 'Wine.php';
require_once 'Connection.php';
require_once 'WineTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new WineTableGateway($connection);

$statement = $gateway->getWineById($id);
$row = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require "styles.php" ?>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="js/wine.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?>
        <div class="container">
            <h1>Edit Wine Form</h1>
            <?php
            if (isset($errorMessage)) {
                echo '<p>Error: ' . $errorMessage . '</p>';
            }
            ?>
            <div class ="container">
                <form id="editWineForm" name="editWineForm" action="editWine.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <table class="table table-bordered">
                        <tbody>
                            <tr>

                                <td>Wine</td>
                                <td>
                                    <input type="text" name="wine" class="form-control" value="<?php
                                    if (isset($_POST) && isset($_POST['wine'])) {
                                        echo $_POST['wine'];
                                    } else {
                                        echo $row['wine'];
                                    }
                                    ?>" />
                                    <span id="wineError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['wine'])) {
                                            echo $errorMessage['wine'];
                                        }
                                        ?>
                                    </span>
                                </td>                            
                            </tr>                  
                            <tr>
                                <td>Description</td>
                                <td>
                                    <input type="text" name="description" class="form-control" value="<?php
                                    if (isset($_POST) && isset($_POST['description'])) {
                                        echo $_POST['description'];
                                    } else {
                                        echo $row['description'];
                                    }
                                    ?>" />
                                    <span id="descriptionError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['description'])) {
                                            echo $errorMessage['description'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Year</td>
                                <td>
                                    <input type="text" name="year" class="form-control" value="<?php
                                    if (isset($_POST) && isset($_POST['year'])) {
                                        echo $_POST['year'];
                                    } else {
                                        echo $row['year'];
                                    }
                                    ?>" />
                                    <span id="yearError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['year'])) {
                                            echo $errorMessage['year'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Temperature</td>
                                <td>
                                    <input type="text" name="temperature" class="form-control" value="<?php
                                    if (isset($_POST) && isset($_POST['temperature'])) {
                                        echo $_POST['temperature'];
                                    } else {
                                        echo $row['temperature'];
                                    }
                                    ?>" />
                                    <span id="temperatureError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['temperature'])) {
                                            echo $errorMessage['temperature'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>
                                    <input type="text" name="type" class="form-control" value="<?php
                                    if (isset($_POST) && isset($_POST['type'])) {
                                        echo $_POST['type'];
                                    } else {
                                        echo $row['type'];
                                    }
                                    ?>" />
                                    <span id="typeError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['type'])) {
                                            echo $errorMessage['type'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input class="btn btn-default" type="submit" value="Update Wine" name="updateWine" />
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </form>
            </div>
        </div>
        <?php require 'footer.php'; ?>
        <?php require 'styles.php'; ?>

    </body>
</html>
