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
	if(isset($_GET['ingredientid'])&&isset($_GET['rating'])){
		$ingredientid =  $_GET['ingredientid'];
		$rating =  $_GET['rating'];
		$userid =  $_SESSION["id"];
		$stmt_create_rating = mysqli_prepare($link, $sql_create_ingredientrating);
		mysqli_stmt_bind_param($stmt_create_rating, "iiiiii", $ingredientid, $userid, $rating, $ingredientid, $userid, $rating);
		mysqli_stmt_execute($stmt_create_rating);
		mysqli_stmt_close($stmt_create_rating);
		mysqli_commit($link);
		mysqli_close($link);
		header("location: ingredient_view.php?ingredientid=" . $ingredientid);
	}
?>