<?php 
	session_start();
	include './includes/title.php';
?>	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<img src="images/GenericMap.jpg" alt="Ex Map" style="width:150px;height:120px;">
	<title>Marvins Maps - <?php include "includes/title.php"; ?> </title>
	<style>
	label {
		font-weight: bold;
		color: #300ACC;
	}
	</style>
</head>
<body>
<div id="wrapper">
    <?php require './includes/Menu.php'; ?>