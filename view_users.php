//users
<?php 
session_start();
require 'includes/header.php';
?>
	<main>
	<?php if (isset($_SESSION['fn']) )  {
			$firstname = $_SESSION['fn'];
			echo "<h1> This webpage shows a list of fellow enthusists </h1>";
			$message = "Hello $firstname";
			$message2 = "Here is a list of other users emails, who are also intersested in maps!";
			if (isset($_SESSION['Admin'])){
				$message3 = "You are an honorable Admin";
			}
				require_once ('../../mysqli_connect.php'); // Connect to the db.
				
				$sqlT = "SELECT Fname, Lname, email FROM User";
				$stmtT = mysqli_prepare($dbc, $sqlT);
				mysqli_stmt_execute($stmtT);
				$result=mysqli_stmt_get_result($stmtT);
				$rows = mysqli_num_rows($result);
				
				foreach($result as $key => $val){
				echo "{$val['Fname']} {$val['Lname']} -- {$val['email']}" ;
				echo "<br>"; }
	}
	else{
			$message = 'You have reached this page in error';
			$message2 = 'Please use the menu at the right';	
		}
		// Print the message:
		echo '<h2>'.$message.'</h2>';
		echo '<h3>'.$message2.'</h3>';
		echo '<h3>'.$message3.'</h3>';
		?>
	</main>
	<?php // Include the footer and quit the script:
	include ('./includes/footer.php'); 
	?>
	