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
	$cocktailid = 0;
	$ingredientid = 0;
	$ingredientid = 0;
	if(isset($_POST['cocktailid'])){
		$cocktailid =  $_POST['cocktailid'];
	}
	if(isset($_POST['ingredientid'])){
		$ingredientid =  $_POST['ingredientid'];
	}
	if(isset($_POST['cocktailingredientid'])){
		$cocktailingredientid =  $_POST['cocktailingredientid'];
	}
	if(isset($_GET['cocktailid'])){
		$cocktailid = $_GET['cocktailid'];
	}
	if(isset($_GET['ingredientid'])){
		$ingredientid =  $_GET['ingredientid'];
	}
	if(isset($_GET['cocktailingredientid'])){
		$cocktailingredientid =  $_GET['cocktailingredientid'];
	}
	if($cocktailid != 0 && $cocktailingredientid != 0){
		$stmt_sql_cocktailingredientlist = mysqli_prepare($link, $sql_delete_cocktailingredientlistid);
		mysqli_stmt_bind_param($stmt_sql_cocktailingredientlist, "i", $cocktailingredientid);
		mysqli_stmt_execute($stmt_sql_cocktailingredientlist);
		mysqli_stmt_close($stmt_sql_cocktailingredientlist);
	}
	mysqli_commit($link);
	mysqli_close($link);
	header("location: /views/cocktailingredient.php?cocktailid=" . $cocktailid);
	exit;
?>