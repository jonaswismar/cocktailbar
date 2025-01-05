<?php
	if(!isset($_SESSION)){
		session_start(); 
	}
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";
	$categoryid = 0;
	if(isset($_POST['categoryid'])){
		$categoryid =  $_POST['categoryid'];
	}
	if(isset($_GET['categoryid'])){
		$categoryid = $_GET['categoryid'];
	}
	$stmt_sql_category = mysqli_prepare($link, $sql_delete_category);
	mysqli_stmt_bind_param($stmt_sql_category, "i", $categoryid);
	mysqli_stmt_execute($stmt_sql_category);
	mysqli_stmt_close($stmt_sql_category);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: categorys.php");
	exit;
?>