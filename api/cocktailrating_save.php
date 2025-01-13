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
	if(isset($_GET['cocktailid'])&&isset($_GET['rating'])){
		$cocktailid =  $_GET['cocktailid'];
		$rating =  $_GET['rating'];
		$userid =  $_SESSION["id"];
		$stmt_create_rating = mysqli_prepare($link, $sql_create_cocktailrating);
		mysqli_stmt_bind_param($stmt_create_rating, "iiiiii", $cocktailid, $userid, $rating, $cocktailid, $userid, $rating);
		mysqli_stmt_execute($stmt_create_rating);
		mysqli_stmt_close($stmt_create_rating);
		mysqli_commit($link);
		mysqli_close($link);
		header("location: /views/cocktail.php?cocktailid=" . $cocktailid);
	}
?>