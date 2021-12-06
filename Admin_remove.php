//for the removal of an Admin
<?php 
include('includes/header.php');
require_once '../../mysqli_connect.php';
?>
<!--The header Need to make form sticky -->
<?php
if (isset($_SESSION['Admin'])){
	if (isset($_POST['submit'])) {
		
		if (!empty($_POST['email']))
			$email = $_POST['email'];
		else
			$missing['email'] = "-you didn't enter an email address";		
		
		if ($missing) { //There is at least one element in the $missing array
			echo 'You forgot the following item(s):<br>';
			//output the contents of the $missing array
			foreach($missing as $i => $value){
			echo $value;
			echo "<br>";
			}
			
			echo 'Please <a href="register.php">return to the page<a>';
			//include("includes/footer/php");
			//exit after missing
		}
		else {
			//Form was filled out completely and submitted. Print the submitted information:
			echo "<p>You have removed, the admin, they are still a user:<br>";
			
			echo "Please make sure the email address is correct : <strong>$email</strong><br> ";
			//now use prepared statements to insert a new user to database
			require_once ('../../mysqli_connect.php'); // Connect to the db.
		
			$sqlT = "SELECT * FROM User WHERE email = ?";
			$stmtT = mysqli_prepare($dbc, $sqlT);
			mysqli_stmt_bind_param($stmtT, '?', $email);
			mysqli_stmt_execute($stmtT);
			$result=mysqli_stmt_get_result($stmtT);
			$rows = mysqli_num_rows($result);
			mysqli_free_result($stmt);
			if ($rows != 0) { //email found
			
				$fname = $rows['Fname'];
				//Folder name is email stripped of non-alphanumeric characters
				$folder = preg_replace("/[^a-zA-Z0-9]/", "", $email);
				// make lowercase
				$folder = strtolower($folder);
				$sql = "UPDATE User SET admin = 0 WHERE email = ?";
				$stmt = mysqli_prepare($dbc, $sql);
				$pw_hash= password_hash($pwd, PASSWORD_DEFAULT);
				mysqli_stmt_bind_param($stmt, 's',$email );
				mysqli_stmt_execute($stmt);
				if (mysqli_stmt_affected_rows($stmt)){
					echo "<main> <h2> The update has been registered properly with our database. $fname is no longer an Admin!</h2> </main>";

				}
				else {
					echo "<main><h2>We're sorry. there was an error.</h2><h3>Please try again later</h3></main>";
				}
			}
			else{
				echo "";
			}
			//redirect to logged_in page
			
			include("includes/footer.php");
			exit;
		}

	}

	?>
<!-- Script 2.1 - form.html -->
	<form action="Admin_remove.php" method="post">

		<fieldset>
			<legend>Enter the information for the new ADMIN in the form below:</legend>
<!-- First Name -->
		<p><label>First name: <input type="text" name="fname" size="20" maxlength="40" <?php if(isset($fname)){ 
		echo "value=\"$fname\" "; }?> > </label></p>

		<p><label>Email Address: <input type="email" name="email" size="40" maxlength="60" <?php if(isset($email)){
		echo "value=\"$email\" "; } ?> ></label></p>

		</fieldset>
		<p><input type="submit" name="submit" value="Submit My Information"></p>

	</form>
	<!-- http://satoshi.cis.uncw.edu/~bwb6403/HW/register.php -->
<?php } else{
echo "YOU ARE NOT REGISTERED AS AN ADMIN, YOUR RESOURCEFULNESS IS NOTED, BUT LEAVE";
}	?>
<?php include("includes/footer/php"); ?>