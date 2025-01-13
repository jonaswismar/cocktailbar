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
	$toolid = 0;
	if(isset($_POST['toolid'])){
		$toolid =  $_POST['toolid'];
	}
	if(isset($_GET['toolid'])){
		$toolid = $_GET['toolid'];
	}
	$stmt_sql_tool = mysqli_prepare($link, $sql_delete_tool);
	mysqli_stmt_bind_param($stmt_sql_tool, "i", $toolid);
	mysqli_stmt_execute($stmt_sql_tool);
	mysqli_stmt_close($stmt_sql_tool);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: /views/tools.php");
	exit;
?>