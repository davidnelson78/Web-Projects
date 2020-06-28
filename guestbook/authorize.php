<div class="comment">Admin Login</div>
<?php
if ($errors != '') {
	echo '<div class="error">' . $errors . '</div>';
}
if ($is_success) {
	echo '<div class="comment">Success!<br/>Please click the home button below to enter the Admin Guestbook.</div>';
} else { ?>
	<form action="?" method="POST">
		<input type="text" name="password" placeholder="Type your password" />
		<input type="submit" name="ok" value="Enter" />
	</form>
<?php } ?>
<div class="comment"><a href="./index.php">Home</a></div>