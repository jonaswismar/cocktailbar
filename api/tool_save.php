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
	$toolname = "";
	$tooldescription = "";
	$toolicon = "";
	if(isset($_POST['toolid'])){
		$toolid =  $_POST['toolid'];
		$toolname = $_POST['toolname'];
		$tooldescription =  $_POST['tooldescription'];
		$toolicon =  $_POST['toolicon'];
	}
	if(isset($_GET['toolid'])){
		$toolid =  $_GET['toolid'];
		$toolname = $_GET['toolname'];
		$tooldescription =  $_GET['tooldescription'];
		$toolicon=  $_GET['toolicon'];
	}
	if(empty($toolid)||$toolid = 0){
		$stmt_sql_tool = mysqli_prepare($link, $sql_create_tool);
		mysqli_stmt_bind_param($stmt_sql_tool, "sss", $toolname, $tooldescription, $toolicon);
	}
	else{
		$stmt_sql_tool = mysqli_prepare($link, $sql_update_tool);
		mysqli_stmt_bind_param($stmt_sql_tool, "sssi", $toolname, $tooldescription, $toolicon, $toolid);
	}
	mysqli_stmt_execute($stmt_sql_tool);
	mysqli_stmt_close($stmt_sql_tool);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: /views/tools.php");
	exit;
?>