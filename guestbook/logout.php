<?php

setcookie("pass","",time() - 3600);
echo 'Logout!<br/><a href="./index.php">Home</a>';

?>