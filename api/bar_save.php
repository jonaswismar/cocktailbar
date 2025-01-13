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
	$barname = "";
	$baricon = "";
	if(isset($_POST['barid'])){
		$barid =  $_POST['barid'];
		$barname = $_POST['barname'];
		$baricon =  $_POST['baricon'];
	}
	if(isset($_GET['barid'])){
		$barid =  $_GET['barid'];
		$barname = $_GET['barname'];
		$bariicon=  $_GET['baricon'];
	}
	if(empty($barid)||$barid = 0){
		$stmt_sql_bar = mysqli_prepare($link, $sql_create_bar);
		mysqli_stmt_bind_param($stmt_sql_bar, "ss", $barname, $baricon);
	}
	else{
		$stmt_sql_bar = mysqli_prepare($link, $sql_update_bar);
		mysqli_stmt_bind_param($stmt_sql_bar, "ssi", $barname, $baricon, $barid);
	}
	mysqli_stmt_execute($stmt_sql_bar);
	mysqli_stmt_close($stmt_sql_bar);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: /views/bars.php");
	exit;
?>