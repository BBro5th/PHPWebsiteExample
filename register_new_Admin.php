<?php 
include('includes/header.php');
require_once '../../mysqli_connect.php';
?>
<!--The header Need to make form sticky -->
<?php
if (isset($_SESSION['Admin'])){
	if (isset($_POST['submit'])) {
	
		// Create scalar variables for the form data:
		if (!empty($_POST['fname']))
			$fname = $_POST['fname'];
		else
			$missing['name'] = "-you didn't enter your first name";
		
		if (!empty($_POST['lname']))
			$lname = $_POST['lname'];
		else
			$missing['name'] = "-you didn't enter your last name";
		
		
		if (!empty($_POST['email']))
			$email = $_POST['email'];
		else
			$missing['email'] = "-you didn't enter your email address";	
//password checking time		
		if (!empty($_POST['pwd']))
			$pwd= $_POST['pwd'];
		else
			$missingp['pwd'] = "you did not enter an initial password";
		if (!empty($_POST['confirm']))
			$confirm= $_POST['confirm'];
		else
			$missingp['confirm'] = "you did not confirm your password";
		if ($pwd == $confirm)
			$password = password_hash($pwd, PASSWORD_DEFAULT); //$password is hashed of pwd
		else
			$missing['matched'] = "your password and confirmation password did not match";
		
		if (isset($_POST['genre']))
			$genre = $_POST['genre'];
		else
			$missing['genre'] = "-you didn't select your genre";
		
		//The first option of a select list is the default, so there will always be something set
		if ($_POST['mapScale'] != "default") {
			$mapScale = $_POST['mapScale'];
		}
		else
			$missing['mapScale'] = "-you didn't select your map type";
		
		if (!empty($_POST['maptype'])){ //maptype need to be an array
			$maptype = $_POST['maptype'];
		}
		else
			$missing['maptype'] = "-you did not select a map type";
		
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
			echo "<p>Thank you for registering, $fname $lname, as an Admin:<br>";
			echo "You entered <strong>$genre</strong> for your prefered genre of map, and <strong>$mapScale</strong> for your map scale.<br>";
			
			echo "you are interested in <br> "; 
			foreach($maptype as $key => $val){
				echo "<strong>- $val </strong><br>" ;
			}
			echo "Please make sure your email address is correct : <strong>$email</strong><br>";
			//now use prepared statements to insert a new user to database
			require_once ('../../mysqli_connect.php'); // Connect to the db.
		
			$sqlT = "SELECT * FROM User WHERE email = ?";
			$stmtT = mysqli_prepare($dbc, $sqlT);
			mysqli_stmt_bind_param($stmtT, '?', $email);
			mysqli_stmt_execute($stmtT);
			$result=mysqli_stmt_get_result($stmtT);
			$rows = mysqli_num_rows($result);
			mysqli_free_result($stmt);
			if ($rows==0) { //email not found, add user
			
				$admin = 1;
				//Folder name is email stripped of non-alphanumeric characters
				$folder = preg_replace("/[^a-zA-Z0-9]/", "", $email);
				// make lowercase
				$folder = strtolower($folder);
				$sql = "INSERT into User (Fname, Lname, email, Admin, ScalePref, GenrePref, password, folder) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
				$stmt = mysqli_prepare($dbc, $sql);
				$pw_hash= password_hash($pwd, PASSWORD_DEFAULT);
				mysqli_stmt_bind_param($stmt, 'ssssssss', $fname, $lname, $email, $admin, $mapScale, $genre, $pw_hash, $folder);
				mysqli_stmt_execute($stmt);
				if (mysqli_stmt_affected_rows($stmt)){
					echo "<main> <h2> All has been registered properly with our database. Thank you for registering $fname as a new Admin!</h2> </main>";
					$dirPath = "../../uploads/".$folder;
					mkdir($dirPath,0777);
				}
				else {
					echo "<main><h2>We're sorry. there was an error.</h2><h3>Please try again later</h3></main>";
				}
			}
			else{
				echo "This email already has an account";
			}
			//redirect to logged_in page
			
			include("includes/footer.php");
			exit;
		}

		
	}



	?>
<!-- Script 2.1 - form.html -->
	<form action="register_new_Admin.php" method="post">

		<fieldset>
			<legend>Enter the information for the new ADMIN in the form below:</legend>
<!-- First Name -->
		<p><label>First name: <input type="text" name="fname" size="20" maxlength="40" <?php if(isset($fname)){ 
		echo "value=\"$fname\" "; }?> > </label></p>
		<p><label>Last name: <input type="text" name="lname" size="20" maxlength="40" <?php if(isset($lname)){ 
		echo "value=\"$lname\" "; }?> ></label></p>

		<p><label>Email Address: <input type="email" name="email" size="40" maxlength="60" <?php if(isset($email)){
		echo "value=\"$email\" "; } ?> ></label></p>
		<label> Password: </label>
		<input type="password" name="pwd">
		<label> Confirm Password: </label>
		<input type="password" name="confirm">

		<p>Genre: 
			<label><input type="radio" name="genre" value="Non-Fic"<?php if(isset($genre) && $genre=="Non-Fic"){ echo " checked"; } ?> > Non-Fiction</label>&nbsp;&nbsp;
			<label><input type="radio" name="genre" value="Fic" <?php if(isset($genre) && $genre=="Fic"){ echo " checked"; } ?> > Fiction</label>&nbsp;&nbsp;
		</p>

		<p><label>MapScale (size maps you are interested in): <!-- make sticky using "checked" -->
			<select name="mapScale">
				<option value="default" <?php if(isset($mapScale) && $mapScale=="default"){ echo " selected"; } ?> >default</option>
				<option value="World" <?php if(isset($mapScale) && $mapScale=="World"){ echo " selected"; } ?> >World</option>
				<option value="Local" <?php if(isset($mapScale) && $mapScale=="Local"){ echo " selected"; } ?> >Local area</option>
				<option value="BM" <?php if(isset($mapScale) && $mapScale=="BM"){ echo " selected"; } ?> >Battle Map</option>
			</select>
		</label></p>
		<p> Select which types of maps you are interested in <br>
		<label> General Reference </label>
		<input type="checkbox" name="maptype[]" value="GeneralReference"<?php if(!empty($maptype) && $maptype.includes("GeneralReference")){echo "checked";} ?> >
		<label> Topographic </label>
		<input type="checkbox" name="maptype[]" value="Topographic" <?php if(!empty($maptype) && $maptype.includes("Topographic")){echo "checked";} ?> >
		<label> Thematic </label>
		<input type="checkbox" name="maptype[]" value="Thematic" <?php if(!empty($maptype) && $maptype.includes("Thematic")){echo "checked";} ?> >
		<label> Navigation Charts </label>
		<input type="checkbox" name="maptype[]" value="Navigation" <?php if(!empty($maptype) && $maptype.includes("Navigation")){echo "checked";} ?> >
		<label> Cadastral Maps / Plans</label>
		<input type="checkbox" name="maptype[]" value="Cadastral" <?php if(!empty($maptype) && $maptype.includes("Cadastral")){echo "checked";} ?> >
		</p>
		</fieldset>
		<p><input type="submit" name="submit" value="Submit My Information"></p>

	</form>
	<!-- http://satoshi.cis.uncw.edu/~bwb6403/HW/register.php -->
<?php } else{
echo "YOU ARE NOT REGISTERED AS AN ADMIN, YOUR RESOURCEFULNESS IS NOTED, BUT LEAVE";
}	?>
<?php include("includes/footer/php"); ?>