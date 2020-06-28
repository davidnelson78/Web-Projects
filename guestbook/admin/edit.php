<?php

include '../hash.php';
include '../mysqli_connect.php';
include '../admin/authorize.php';

if($is_admin)
{
	$id_to_edit = trim($_GET['guestbook_id']);
	if(isset($_POST['ok']))
	{			
		$message_to_save = trim(htmlspecialchars($_POST['comment']));
		$rows = $pdo->prepare('UPDATE guestbook SET comment=:message WHERE guestbook_id=:guestbook_id;');
		$rows->bindParam(':guestbook_id',$id_to_edit);
		$rows->bindParam(':comment',$message_to_save);
		$rows->execute();
		$is_edit = true;
		$redirect = $_SERVER['SERVER_NAME'];
	}
	else
	{
		$rows = $pdo->prepare('SELECT comment FROM guestbook WHERE guestbook_id=:guestbook_id');
		$rows->bindParam(':guestbook_id',$id_to_edit);
		$rows->execute();
		$row = $rows->fetch();
		$message = $row['comment'];
		$is_edit = false;
	}
}

include '../header.php';
include '../edit.php';
include '../footer.php';

?>