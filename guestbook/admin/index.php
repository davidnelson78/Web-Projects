<?php
if ($errors != '') echo '<div class="error">' . $errors . '</div>';
?>

<form action="?p=<?php echo $page; ?>" method="POST">
	<input name="fname" size="20" placeholder="First Name" autofocus required></input>
	<input name="lname" size="20" placeholder="Last Name" autofocus required></input>
	<br /> <br />
	<input name="email" size="30" placeholder="Email" autofocus required></input>
	<br /> <br />
	<textarea name="comment" cols="50" rows="4" maxlength="200" placeholder="Type your comment here" autofocus required></textarea>
	<br /> <br />
	Code: <?php echo $captcha; ?> <input type="text" name="captcha" placeholder="Enter code to post" required />
	<button name="add">Add</button>
	<button name="refresh">Refresh</button>


</form>

<?php
foreach ($messages_by_id as $row) {
	echo '<div class="comment">';

	if ($is_admin) {
		echo '<a href="./admin/edit.php?id=' . $row['guestbook_id'] . '"><img src="./img/edit.png" width="12" height="12" alt="e"/></a>';
		echo '<a href="./admin/delete.php?id=' . $row['guestbook_id'] . '"><img src="./img/delete.png" width="12" height="12" alt="x"/></a>';
	}

	echo '<img src="./img/avatar.png" width="15" height="12" alt="avatar"/>' . '<b> ID: </b> ' . $row['guestbook_id'] . ' <b> Name: </b> ' . $row['fname'] . ' ' . $row['lname'] . '<br><b> Date: </b>' . $row['date'];
	echo '<br><b>Comment</b>: ' . $row['comment'];

	echo '</div>';
}
if ($posts == 0) {
	echo '<div class="comment">No entries yet, be the first to sign in!</div>';
}
?>
<div class="comment">
	<?php echo $navi_links; /* Links to nav */ ?>
</div>
<div class="comment">
	Pages: <?php echo $pages; ?> | Posts: <?php echo $posts; ?>
</div>

<?php
if ($is_admin) {
	echo '<div class="comment"><a href="./logout.php">Logout</a></div>';
} else {
	echo '<div class="comment"><a href="./login.php">Sign in</a></div>';
}
?>