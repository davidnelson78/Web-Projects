<?php

$title = "Admin Access";
$errors = '';
$is_success = false;

include './hash.php';

if(!empty($_POST['ok']))
{
	if($_POST['password'] != '')
	{
		if($hash_pass == hash("sha256",$_POST['password'],false))
		{
			setcookie("pass",$hash_pass);
			$redirect = $_SERVER['SERVER_NAME'];
			$is_success = true;
		}
		else
		{
			$errors = 'Wrong password!';
		}
	}
	else
	{
		$errors = 'Enter password!';
	}
}

include './header.php';
include './authorize.php';
include './footer.php';

?>