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
	if(isset($_POST['unitid'])){
		$unitid =  $_POST['unitid'];
	}
	if(isset($_GET['unitid'])){
		$unitid = $_GET['unitid'];
	}
	$stmt_sql_unit = mysqli_prepare($link, $sql_delete_unit);
	mysqli_stmt_bind_param($stmt_sql_unit, "i", $unitid);
	mysqli_stmt_execute($stmt_sql_unit);
	mysqli_stmt_close($stmt_sql_unit);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: /views/units.php");
	exit;
?>