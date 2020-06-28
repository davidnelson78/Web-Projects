<?php

$title = "Guest Book";

include './hash.php';
include './mysqli_connect.php';
include './admin/authorize.php';

//Init variable
$errors = '';
$fname_after_refresh = isset($_POST['fname']) ? $_POST['fname'] : '';
$lname_after_refresh = isset($_POST['lname']) ? $_POST['lname'] : '';
$email_after_refresh = isset($_POST['email']) ? $_POST['email'] : '';
$msg_after_refresh = isset($_POST['comment']) ? $_POST['comment'] : '';
$posts = 0;
$isadd = (isset($_POST['add']))? true : false;

//After click on "Add"
if($isadd)
{
    
	if($_SESSION['captcha'] == $_POST['captcha'])
	{
		//Prepare input data
		$fname_to_save = trim(htmlspecialchars($_POST['fname']));
		$lname_to_save = trim(htmlspecialchars($_POST['lname']));
		$email_to_save = trim(htmlspecialchars($_POST['email']));
		$msg_to_save = trim(htmlspecialchars($_POST['comment']));
			
	
		
		//Save message
		$STH = $pdo->prepare("INSERT INTO guestbook (fname,lname,email,comment,date) VALUES (:fname,:lname,:email,:comment,now());");
		$STH->bindParam(':fname', $fname_to_save);
		$STH->bindParam(':lname', $lname_to_save);
		$STH->bindParam(':email', $email_to_save);
		$STH->bindParam(':comment',$msg_to_save);
		$STH->execute();
		$msg_after_refresh = '';
	}
	else
	{
		$errors = "Wrong captcha!";
	}
    
}

//After click on "Refresh"
if(isset($_POST['refresh']))
{
    $msg_after_refresh = $_POST['message'];
}


// Count posts, calc amount pages, sort list
$pg = $pdo->query('SELECT COUNT(guestbook_id) AS total FROM guestbook;');
$posts = $pg->fetch()['total'];
$pages = intval(($posts-1)/10)+1; 

//Receive messages from DB
if(isset($_GET['p']))
{
	$page = $_GET['p'];
	if($page < 1 || $page > $pages)
	{
		$page = 1;
	}
}
else
{
	$page = 1;
}

$page_at = $page * 10 - 10;


//Sort results
$rows_by_id = $pdo->prepare('SELECT * FROM guestbook ORDER BY guestbook_id DESC LIMIT :pageat,10 ;');
$rows_by_id->bindParam(':pageat',$page_at,PDO::PARAM_INT);
$rows_by_id->execute();
$messages_by_id = $rows->fetchAll();


//Page navigation
if($page > 1)
{
	$prev = '<a href="?p='.($page-1).'">Previous Page</a>';
}
else
{
	$prev = 'Previous Page';
}

if($page < $pages)
{
	$next = '<a href="?p='.($page+1).'">Next Page</a>';
}
else
{
	$next = 'Next Page';
}

$navi_links = $prev.' | '. $next.' (Page: '.$page.')';

//Generate catcha
$_SESSION['captcha'] = rand(1000,9999);
$captcha = $_SESSION['captcha'];

include './header.php';
include './admin/index.php';
include './footer.php';
?>
