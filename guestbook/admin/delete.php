<?php

$title = "Remove a Comment";

include '../hash.php';
include '../mysqli_connect.php';
include '../admin/authorize.php';

if($is_admin)
{
	$id_to_delete = trim($_GET['guestbook_id']);
	if(isset($_POST['ok']))
	{			
		$STH = $pdo->prepare("DELETE FROM guestbook WHERE (guestbook_id = :guestbook_id) ;");
		$STH->bindParam(':guestbook_id',$id_to_delete);
		$STH->execute();
		$is_delete = true;
		$redirect = $_SERVER['SERVER_NAME']; 
	}
	else
	{
		$rows = $pdo->prepare('SELECT comment FROM guestbook WHERE guestbook_id=:guestbook_id');
		$rows->bindParam(':guestbook_id',$id_to_delete);
		$rows->execute();
		$row = $rows->fetch();
		$message = $row['comment'];
		$is_delete = false;
	}
}

include '../header.php';
include '../delete.php';
include '../footer.php';

?>