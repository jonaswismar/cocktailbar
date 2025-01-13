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
	$barkeeperid = 0;
	if(isset($_POST['barkeeperid'])){
		$barkeeperid =  $_POST['barkeeperid'];
	}
	if(isset($_GET['barkeeperid'])){
		$barkeeperid = $_GET['barkeeperid'];
	}
	$stmt_sql_barkeeper = mysqli_prepare($link, $sql_barkeeper_delete);
	mysqli_stmt_bind_param($stmt_sql_barkeeper, "i", $barkeeperid);
	mysqli_stmt_execute($stmt_sql_barkeeper);
	mysqli_stmt_close($stmt_sql_barkeeper);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: /views/bars.php");
	exit;
?>