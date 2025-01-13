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
	$barid = 0;
	if(isset($_POST['barid'])){
		$barid =  $_POST['barid'];
	}
	if(isset($_GET['barid'])){
		$barid = $_GET['barid'];
	}
	$stmt_sql_bar = mysqli_prepare($link, $sql_delete_bar);
	mysqli_stmt_bind_param($stmt_sql_bar, "i", $barid);
	mysqli_stmt_execute($stmt_sql_bar);
	mysqli_stmt_close($stmt_sql_bar);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: /views/bars.php");
	exit;
?>