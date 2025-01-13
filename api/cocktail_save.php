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
	$cocktailfavorite = 0;
	$cocktailordered = 0;
	$cocktailimage = "";
	if(isset($_POST['cocktailid'])){
		$cocktailid =  $_POST['cocktailid'];
		if(isset($_POST['cocktailimage'])){
			$cocktailimage = $_POST['cocktailimage'];
		}
		if(isset($_POST['cocktailname'])&&isset($_POST['cocktaildescription'])&&isset($_POST['cocktailinstruction'])){
			$cocktailname =  $_POST['cocktailname'];
			$cocktaildescription =  $_POST['cocktaildescription'];
			$cocktailinstruction =  $_POST['cocktailinstruction'];
			if(empty($cocktailid)){
				$stmt_sql_cocktail = mysqli_prepare($link, $sql_create_cocktail);
				mysqli_stmt_bind_param($stmt_sql_cocktail, "ssss", $cocktailname, $cocktaildescription, $cocktailinstruction, $cocktailimage);
				mysqli_stmt_execute($stmt_sql_cocktail);
				$cocktailid = mysqli_stmt_insert_id($stmt_sql_cocktail);
				mysqli_stmt_close($stmt_sql_cocktail);
				mysqli_commit($link);
			}
			else{
				$stmt_sql_cocktail = mysqli_prepare($link, $sql_update_cocktail);
				mysqli_stmt_bind_param($stmt_sql_cocktail, "ssssi", $cocktailname, $cocktaildescription, $cocktailinstruction, $cocktailimage, $cocktailid);
				mysqli_stmt_execute($stmt_sql_cocktail);
				mysqli_stmt_close($stmt_sql_cocktail);
				mysqli_commit($link);
			}
		}
		if(isset($_POST['cocktailcategory'])){
			$cocktailcategory = $_POST['cocktailcategory'];
			$stmt_delete_cocktailcategorylist = mysqli_prepare($link, $sql_delete_cocktailcategorylist);
			mysqli_stmt_bind_param($stmt_delete_cocktailcategorylist, "i", $cocktailid);
			mysqli_stmt_execute($stmt_delete_cocktailcategorylist);
			mysqli_stmt_close($stmt_delete_cocktailcategorylist);
			mysqli_commit($link);
			foreach ($cocktailcategory as $category){
				$stmt_create_cocktailcategorylist = mysqli_prepare($link, $sql_create_cocktailcategorylist);
				mysqli_stmt_bind_param($stmt_create_cocktailcategorylist, "ii", $cocktailid, $category);
				mysqli_stmt_execute($stmt_create_cocktailcategorylist);
				mysqli_stmt_close($stmt_create_cocktailcategorylist);
				mysqli_commit($link);
			}
		}
		if(isset($_POST['cocktailtaste'])){
			$cocktailtaste = $_POST['cocktailtaste'];
			$stmt_delete_cocktailtastelist = mysqli_prepare($link, $sql_delete_cocktailtastelist);
			mysqli_stmt_bind_param($stmt_delete_cocktailtastelist, "i", $cocktailid);
			mysqli_stmt_execute($stmt_delete_cocktailtastelist);
			mysqli_stmt_close($stmt_delete_cocktailtastelist);
			mysqli_commit($link);
			foreach ($cocktailtaste as $taste){
				$stmt_create_cocktailtastelist = mysqli_prepare($link, $sql_create_cocktailtastelist);
				mysqli_stmt_bind_param($stmt_create_cocktailtastelist, "ii", $cocktailid, $taste);
				mysqli_stmt_execute($stmt_create_cocktailtastelist);
				mysqli_stmt_close($stmt_create_cocktailtastelist);
				mysqli_commit($link);
			}
		}
		if(isset($_POST['cocktailfavorite'])){
			$cocktailfavorite = $_POST['cocktailfavorite'];
			$stmt_create_order = mysqli_prepare($link, $sql_create_cocktailfavorite);
			if($cocktailfavorite == 0){
				$stmt_create_order = mysqli_prepare($link, $sql_delete_cocktailfavorite);
			}
			mysqli_stmt_bind_param($stmt_create_order, "ii", $_SESSION["id"], $cocktailid);
			mysqli_stmt_execute($stmt_create_order);
			mysqli_stmt_close($stmt_create_order);
			mysqli_commit($link);
		}
		if(isset($_POST['cocktailordered'])){
			$cocktailid =  $_POST['cocktailid'];
			$cocktailordered = $_POST['cocktailordered'];
			$stmt_create_order = mysqli_prepare($link, $sql_create_order);
			mysqli_stmt_bind_param($stmt_create_order, "iii", $_SESSION["id"], $cocktailid, $_SESSION["bar"]);
			mysqli_stmt_execute($stmt_create_order);
			mysqli_stmt_close($stmt_create_order);
			mysqli_commit($link);
		}
		mysqli_close($link);
	}
	if(isset($_GET['cocktailid'])){
		$cocktailid =  $_GET['cocktailid'];
		if(isset($_GET['cocktailimage'])){
			$cocktailimage = $_GET['cocktailimage'];
		}
		if(isset($_GET['cocktailname'])&&isset($_GET['cocktaildescription'])&&isset($_GET['cocktailinstruction'])){
			$cocktailname =  $_GET['cocktailname'];
			$cocktaildescription =  $_GET['cocktaildescription'];
			$cocktailinstruction =  $_GET['cocktailinstruction'];
			if(empty($cocktailid)){
				$stmt_sql_cocktail = mysqli_prepare($link, $sql_create_cocktail);
				mysqli_stmt_bind_param($stmt_sql_cocktail, "ssss", $cocktailname, $cocktaildescription, $cocktailinstruction, $cocktailimage);
				mysqli_stmt_execute($stmt_sql_cocktail);
				$cocktailid = mysqli_stmt_insert_id($stmt_sql_cocktail);
				mysqli_stmt_close($stmt_sql_cocktail);
				mysqli_commit($link);
			}
			else{
				$stmt_sql_cocktail = mysqli_prepare($link, $sql_update_cocktail);
				mysqli_stmt_bind_param($stmt_sql_cocktail, "ssssi", $cocktailname, $cocktaildescription, $cocktailinstruction, $cocktailimage, $cocktailid);
				mysqli_stmt_execute($stmt_sql_cocktail);
				mysqli_stmt_close($stmt_sql_cocktail);
				mysqli_commit($link);
			}
		}
		if(isset($_GET['cocktailcategory'])){
			$cocktailcategory = $_GET['cocktailcategory'];
			$stmt_delete_cocktailcategorylist = mysqli_prepare($link, $sql_delete_cocktailcategorylist);
			mysqli_stmt_bind_param($stmt_delete_cocktailcategorylist, "i", $cocktailid);
			mysqli_stmt_execute($stmt_delete_cocktailcategorylist);
			mysqli_stmt_close($stmt_delete_cocktailcategorylist);
			mysqli_commit($link);
			foreach ($cocktailcategory as $category){
				$stmt_create_cocktailcategorylist = mysqli_prepare($link, $sql_create_cocktailcategorylist);
				mysqli_stmt_bind_param($stmt_create_cocktailcategorylist, "ii", $cocktailid, $category);
				mysqli_stmt_execute($stmt_create_cocktailcategorylist);
				mysqli_stmt_close($stmt_create_cocktailcategorylist);
				mysqli_commit($link);
			}
		}
		if(isset($_GET['cocktailtaste'])){
			$cocktailtaste = $_GET['cocktailtaste'];
			$stmt_delete_cocktailtastelist = mysqli_prepare($link, $sql_delete_cocktailtastelist);
			mysqli_stmt_bind_param($stmt_delete_cocktailtastelist, "i", $cocktailid);
			mysqli_stmt_execute($stmt_delete_cocktailtastelist);
			mysqli_stmt_close($stmt_delete_cocktailtastelist);
			mysqli_commit($link);
			foreach ($cocktailtaste as $taste){
				$stmt_create_cocktailtastelist = mysqli_prepare($link, $sql_create_cocktailtastelist);
				mysqli_stmt_bind_param($stmt_create_cocktailtastelist, "ii", $cocktailid, $taste);
				mysqli_stmt_execute($stmt_create_cocktailtastelist);
				mysqli_stmt_close($stmt_create_cocktailtastelist);
				mysqli_commit($link);
			}
		}
		if(isset($_GET['cocktailfavorite'])){
			$cocktailfavorite = $_GET['cocktailfavorite'];
			$stmt_create_order = mysqli_prepare($link, $sql_create_cocktailfavorite);
			if($cocktailfavorite == 0){
				$stmt_create_order = mysqli_prepare($link, $sql_delete_cocktailfavorite);
			}
			mysqli_stmt_bind_param($stmt_create_order, "ii", $_SESSION["id"], $cocktailid);
			mysqli_stmt_execute($stmt_create_order);
			mysqli_stmt_close($stmt_create_order);
			mysqli_commit($link);
		}
		if(isset($_GET['cocktailordered'])){
			$cocktailid =  $_GET['cocktailid'];
			$cocktailordered = $_GET['cocktailordered'];
			$stmt_create_order = mysqli_prepare($link, $sql_create_order);
			mysqli_stmt_bind_param($stmt_create_order, "iii", $_SESSION["id"], $cocktailid, $_SESSION["bar"]);
			mysqli_stmt_execute($stmt_create_order);
			mysqli_stmt_close($stmt_create_order);
			mysqli_commit($link);
		}
		mysqli_close($link);
	}
	header("location: /views/cocktail.php?cocktailid=" . $cocktailid);
?>