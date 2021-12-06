<?php 
	session_start();
	include './includes/title.php';
?>	
<!DOCTYPE html>
<!-- Bradley Brosovich -->
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="styles/main.css">
	<title>Marvins Map-enthusiasm's</title>
</head>
<body>
<div id="wrapper">
    <?php require './includes/Menu.php'; ?>
<header>
<img src="images/GenericMap.jpg" alt="Ex Map" style="width:150px;height:120px;">
<h1> Marvins Map-enthusiasm's <h1>
</header>
<h2> Are you a member of the Map enthusists club? <br> </h2> <a href="log_in.php" >SIGN IN HERE </a>
<form>
<p> Here at Marvins Map-enthusiasm's, we are a public group of map enthusisists that like to share maps,
both real and fantastical. Joining is free.</p>
<a href ="register.php">REGISTER HERE</a>
</form>

<footer><h6> Contact us at 910-555-5869 <br>
or email us at MMaps@mail.com </h6>
</footer>
</body>
</html>