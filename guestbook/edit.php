<?php



if ($is_admin) {

	if ($is_edit) {

		echo '<div class="comment">The entry has been successfully edited.</div>';
	} else {

		?>

		<div class="comment">Guestbook ID: <?php echo $id_to_edit; ?></div>
		<form action="?guestbook_id=<?php echo $id_to_edit; ?>" method="POST">
			<input name="fname" size="20" placeholder="First Name" autofocus required><?php echo $fname_after_refresh; ?></input>
			<input name="lname" size="20" placeholder="Last Name" autofocus required><?php echo $lname_after_refresh; ?></input>
			<br /> <br />
			<input name="email" size="30" placeholder="Email" autofocus required><?php echo $email_after_refresh; ?></input>
			<br /> <br />
			<textarea name="comment" cols="50" rows="4" maxlength="200" placeholder="Type your comment here" autofocus required><?php echo $msg_after_refresh; ?></textarea>
			<br /> <br />
			<input type="submit" name="ok" value="Save" />
		</form>

	<?php
		}
	} else {
		?>
	<div class="comment">Access denied!</div>
<?php
}
?>
<div class="comment"><a href="../index.php">Home</div>