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
	$barid = 0;
	$userid = 0;
	if(isset($_POST['barkeeperid'])){
		$barkeeperid =  $_POST['barkeeperid'];
		$barid = $_POST['barid'];
		$userid =  $_POST['userid'];
	}
	if(isset($_GET['barkeeperid'])){
		$barkeeperid =  $_GET['barkeeperid'];
		$barid = $_GET['barid'];
		$userid =  $_GET['userid'];
	}
	if(empty($barkeeperid)||$barkeeperid = 0){
		$stmt_sql_barkeeper = mysqli_prepare($link, $sql_barkeeper_create);
		mysqli_stmt_bind_param($stmt_sql_barkeeper, "ii", $barid, $userid);
	}
	else{
		$stmt_sql_barkeeper = mysqli_prepare($link, $sql_barkeeper_update);
		mysqli_stmt_bind_param($stmt_sql_barkeeper, "iii", $barid, $userid, $barkeeperid);
	}
	mysqli_stmt_execute($stmt_sql_barkeeper);
	mysqli_stmt_close($stmt_sql_barkeeper);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: /views/bar.php?barid=" . $barid);
	exit;
?>