<?php

if ($is_admin) {

	if ($is_delete) {

		echo '<div class="comment">The entry has been successfully deleted.</div>';
	} else {

		?>

		<div class="comment">Do you really want to delete this entry? <?php echo $message; ?></div>
		<form action="?guestbook_id=<?php echo $id_to_delete; ?>" method="POST">
			<input type="submit" name="ok" value="Yes" />
		</form>

	<?php
		}
	} else {
		?>
	<div class="comment">Access Denied!</div>
<?php
}
?>
<div class="comment"><a href="../index.php">Home</div>