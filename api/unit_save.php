<?php
	if(!isset($_SESSION)){
		session_start(); 
	}
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: /views/login.php");
		exit;
	}
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";
	$unitid = 0;
	$unitname = "";
	$unitshort = "";
	$unitshortX = "";
	$unitdescription = "";
	$uniticon = "";
	if(isset($_POST['unitid'])){
		$unitid =  $_POST['unitid'];
		$unitname = $_POST['unitname'];
		$unitshort = $_POST['unitshort'];
		$unitshortX = $_POST['unitshortX'];
		$unitdescription = $_POST['unitdescription'];
		$uniticon = $_POST['uniticon'];
	}
	if(isset($_GET['unitid'])){
		$unitid = $_GET['unitid'];
		$unitname = $_GET['unitname'];
		$unitshort = $_GET['unitshort'];
		$unitshortX = $_GET['unitshortX'];
		$unitdescription = $_GET['unitdescription'];
		$uniticon = $_GET['uniticon'];
	}
	if(empty($unitid)||$unitid = 0){
		$stmt_sql_unit = mysqli_prepare($link, $sql_create_unit);
		mysqli_stmt_bind_param($stmt_sql_unit, "sssss", $unitname, $unitshort, $unitshortX, $unitdescription, $uniticon);
	}
	else{
		$stmt_sql_unit = mysqli_prepare($link, $sql_update_unit);
		mysqli_stmt_bind_param($stmt_sql_unit, "sssssi", $unitname, $unitshort, $unitshortX, $unitdescription, $uniticon, $unitid);
	}
	mysqli_stmt_execute($stmt_sql_unit);
	mysqli_stmt_close($stmt_sql_unit);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: /views/units.php");
	exit;
?>