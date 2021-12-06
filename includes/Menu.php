	<?php 
	$currentPage = basename($_SERVER['SCRIPT_FILENAME']); 
	//if(isset($_SESSION['email'])) { $yep = TRUE;}?>
	<ul id="nav">
        <li><a href="index.php" <?php if ($currentPage == 'index.php') {echo 'id="here"'; } ?> >Home</a></li>
		
		<?php if (isset($_SESSION['email'])) { ?>
			<?php if (isset($_SESSION['Admin'])) { ?>
			<li><a href="upload_admin_image.php" <?php if ($currentPage == 'upload_admin_image.php') {echo 'id="here"'; } ?> >Upload Admin image</a></li>
			<li><a href="register_new_Admin.php" <?php if ($currentPage == 'register_new_Admin.php') {echo 'id="here"'; } ?> >Register new Admin</a></li>
			<br>
			<li><a href="Admin_remove.php" <?php if ($currentPage == 'Admin_remove.php') {echo 'id="here"'; } ?> >Remove Admin Permission</a></li>
			<?php } ?>
			<br>
		<li><a href="view_users.php" <?php if ($currentPage == 'view_users.php') {echo 'id="here"'; } ?> >See other users</a></li>
		<li><a href="upload_user_image.php" <?php if ($currentPage == 'upload_user_image.php') {echo 'id="here"'; } ?> >Upload image</a></li>
		<li><a href="view_images.php" <?php if ($currentPage == 'view_images.php') {echo 'id="here"'; } ?> >View images</a></li>
		<li><a href="logged_out.php" <?php if ($currentPage == 'logged_out.php') {echo 'id="here"'; } ?> >Logout</a></li>
		<?php } else { ?>
		
        <li><a href="log_in.php" <?php if ($currentPage == 'log_in.php') {echo 'id="here"'; } ?> >Login</a></li>
		
		<li><a href="log_in_admin.php" <?php if ($currentPage == 'log_in_admin.php') {echo 'id="here"'; } ?> >Login as Admin</a></li>
		
		<li><a href="register.php" <?php if ($currentPage == 'register.php') {echo 'id="here"'; } ?> >Register</a></li> 
		<?php } ?>
    </ul>
	
	