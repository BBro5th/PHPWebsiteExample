<?php 
session_start();
//require 'includes/header.php';

?>
	<main>
	<?php if (isset($_SESSION['fn']) )  {
			$_SESSION = array();
			session_destroy();
			setcookie('PHPSESSID','',time()-3600,'/');
			require 'includes/header.php';
			$message = "You are now logged out";
			$message2 = "please use the menu at the right";
			echo '<h2>'.$message.'</h2>';
			echo '<h3>'.$message2.'</h3>';
			require_once ('../../includes/reg_conn.php');
		} else { 
			require 'includes/header.php';
			$message = 'You have reached this page in error';
			$message2 = 'Please use the menu';	
			echo '<h2>'.$message.'</h2>';
			echo '<h3>'.$message2.'</h3>';
		}
		// Print the message:

		//require 'includes/header.php';
		?>
	</main>
	<?php // Include the footer and quit the script:
	include ('./includes/footer.php'); 
	?>
	