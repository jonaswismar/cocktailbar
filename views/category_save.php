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
	$categoryname = "";
	$categorydescription = "";
	$categoryimage = "";
	if(isset($_POST['categoryid'])){
		$categoryid =  $_POST['categoryid'];
		$categoryname = $_POST['categoryname'];
		$categorydescription =  $_POST['categorydescription'];
		$categoryimage =  $_POST['categoryimage'];
	}
	if(isset($_GET['categoryid'])){
		$categoryid =  $_GET['categoryid'];
		$categoryname = $_GET['categoryname'];
		$categorydescription =  $_GET['categorydescription'];
		$categoryimage =  $_GET['categoryimage'];
	}
	if(empty($categoryid)||$categoryid = 0){
		$stmt_sql_category = mysqli_prepare($link, $sql_create_category);
		mysqli_stmt_bind_param($stmt_sql_category, "sss", $categoryname, $categorydescription, $categoryimage);
	}
	else{
		$stmt_sql_category = mysqli_prepare($link, $sql_update_category);
		mysqli_stmt_bind_param($stmt_sql_category, "sssi", $categoryname, $categorydescription, $categoryimage, $categoryid);
	}
	mysqli_stmt_execute($stmt_sql_category);
	mysqli_stmt_close($stmt_sql_category);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: categorys.php");
	exit;
?>