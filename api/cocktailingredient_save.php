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
	print_r($_POST);
	print_r($_GET);
	
	$cocktailid = 0;
	$ingredientidlist;
	$ingredientquantity = 0;
	$ingredientunit = 0;
	$ingredientgarnish = 0;
	$ingredientoptional = 0;
	$cocktailingredientid = 0;
	if(isset($_POST['cocktailid'])){
		$cocktailid =  $_POST['cocktailid'];
	}
	if(isset($_POST['ingredientid'])){
		$ingredientidlist =  $_POST['ingredientid'];
	}
	if(isset($_POST['ingredientquantity'])){
		$ingredientquantity =  $_POST['ingredientquantity'];
	}
	if(isset($_POST['ingredientunit'])){
		$ingredientunit =  $_POST['ingredientunit'];
	}
	if(isset($_POST['ingredientgarnish'])){
		$ingredientgarnish =  $_POST['ingredientgarnish'];
	}
	if(isset($_POST['ingredientoptional'])){
		$ingredientoptional =  $_POST['ingredientoptional'];
	}
	if(isset($_POST['cocktailingredientid'])){
		$cocktailingredientid =  $_POST['cocktailingredientid'];
	}
	if(isset($_GET['cocktailid'])){
		$cocktailid =  $_GET['cocktailid'];
	}
	if(isset($_GET['ingredientid'])){
		$ingredientidlist =  $_GET['ingredientid'];
	}
	if(isset($_GET['ingredientquantity'])){
		$ingredientquantity =  $_GET['ingredientquantity'];
	}
	if(isset($_GET['ingredientunit'])){
		$ingredientunit =  $_GET['ingredientunit'];
	}
	if(isset($_GET['ingredientgarnish'])){
		$ingredientgarnish =  $_GET['ingredientgarnish'];
	}
	if(isset($_GET['ingredientoptional'])){
		$ingredientoptional =  $_GET['ingredientoptional'];
	}
	if(isset($_GET['cocktailingredientid'])){
		$cocktailingredientid =  $_GET['cocktailingredientid'];
	}
	if($cocktailid != 0 && $ingredientquantity != 0 && $ingredientunit != 0){
		foreach ($ingredientidlist as $ingredientid){
			if($cocktailingredientid == 0){
				$stmt_sql_cocktailingredientlist = mysqli_prepare($link, $sql_create_cocktailingredientlist);
				mysqli_stmt_bind_param($stmt_sql_cocktailingredientlist, "iiiiii", $cocktailid, $ingredientid, $ingredientquantity, $ingredientunit, $ingredientoptional, $ingredientgarnish);
				mysqli_stmt_execute($stmt_sql_cocktailingredientlist);
				mysqli_stmt_close($stmt_sql_cocktailingredientlist);
			}
			else{
				$stmt_sql_cocktailingredientlist = mysqli_prepare($link, $sql_update_cocktailingredientlist);
				mysqli_stmt_bind_param($stmt_sql_cocktailingredientlist, "iiiiiii", $cocktailid, $ingredientid, $ingredientquantity, $ingredientunit, $ingredientoptional, $ingredientgarnish, $cocktailingredientid);
				mysqli_stmt_execute($stmt_sql_cocktailingredientlist);
				mysqli_stmt_close($stmt_sql_cocktailingredientlist);
			}
		}
	}
	mysqli_commit($link);
	mysqli_close($link);
	header("location: /views/cocktailingredient.php?cocktailid=" . $cocktailid);
	exit;
?>