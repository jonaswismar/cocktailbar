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
	if(isset($_POST['cocktailid'])){
		$userid = $_POST['userid'];
		$cocktailid = $_POST['cocktailid'];
		$ordered = $_POST['ordered'];
		$favorite = $_POST['favorite'];
		$cocktailname = $_POST['cocktailname'];
		$image = $_POST['image'];
		$cocktailcategory = $_POST['cocktailcategory'];
		$cocktailtaste = $_POST['cocktailtaste'];
		$description = $_POST['description'];
		$rating = $_POST['myrating'];
		if(empty($cocktailid)){
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_create_cocktail);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "ssss", $cocktailname, $description, $instruction, $image);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			mysqli_commit($link);
		}
		else{
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_update_cocktail);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "ssssi", $cocktailname, $description, $instruction, $image, $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			$cocktailid = mysqli_stmt_insert_id($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			mysqli_commit($link);
		}
		$stmt_delete_cocktailcategorylist = mysqli_prepare($link, $sql_delete_cocktailcategorylist);
		mysqli_stmt_bind_param($stmt_delete_cocktailcategorylist, "i", $cocktailid);
		mysqli_stmt_execute($stmt_delete_cocktailcategorylist);
		mysqli_stmt_close($stmt_delete_cocktailcategorylist);
		mysqli_commit($link);
		if(isset($cocktailcategory)){
			foreach ($cocktailcategory as $category){
				$stmt_create_cocktailcategorylist = mysqli_prepare($link, $sql_create_cocktailcategorylist);
				mysqli_stmt_bind_param($stmt_create_cocktailcategorylist, "ii", $cocktailid, $category);
				mysqli_stmt_execute($stmt_create_cocktailcategorylist);
				mysqli_stmt_close($stmt_create_cocktailcategorylist);
				mysqli_commit($link);
			}
		}
		$stmt_delete_cocktailtastelist = mysqli_prepare($link, $sql_delete_cocktailtastelist);
		mysqli_stmt_bind_param($stmt_delete_cocktailtastelist, "i", $cocktailid);
		mysqli_stmt_execute($stmt_delete_cocktailtastelist);
		mysqli_stmt_close($stmt_delete_cocktailtastelist);
		mysqli_commit($link);
		if(isset($cocktailtaste)){
			foreach ($cocktailtaste as $taste){
				$stmt_create_cocktailtastelist = mysqli_prepare($link, $sql_create_cocktailtastelist);
				mysqli_stmt_bind_param($stmt_create_cocktailtastelist, "ii", $cocktailid, $taste);
				mysqli_stmt_execute($stmt_create_cocktailtastelist);
				mysqli_stmt_close($stmt_create_cocktailtastelist);
				mysqli_commit($link);
			}
		}
		mysqli_close($link);
		header("location: cocktail_view.php?cocktailid=" . $cocktailid);
	}
	if(isset($_POST['cocktailid'])&&isset($_POST['ordered'])){
		$cocktailid =  $_POST['cocktailid'];
		$ordered =  $_POST['ordered'];
		$stmt_create_order = mysqli_prepare($link, $sql_create_order);
		mysqli_stmt_bind_param($stmt_create_order, "iii", $_SESSION["id"], $cocktailid, $_SESSION["bar"]);
		mysqli_stmt_execute($stmt_create_order);
		mysqli_stmt_close($stmt_create_order);
		mysqli_commit($link);
		mysqli_close($link);
		header("location: cocktail_view.php?cocktailid=" . $cocktailid);
	}
	if(isset($_POST['cocktailid'])&&isset($_POST['favorite'])){
		$cocktailid =  $_POST['cocktailid'];
		$favorite =  $_POST['favorite'];
		$stmt_create_order = mysqli_prepare($link, $sql_create_cocktailfavorite);
		if($favorite == 0){
			$stmt_create_order = mysqli_prepare($link, $sql_delete_cocktailfavorite);
		}
		mysqli_stmt_bind_param($stmt_create_order, "ii", $_SESSION["id"], $cocktailid);
		mysqli_stmt_execute($stmt_create_order);
		mysqli_stmt_close($stmt_create_order);
		mysqli_commit($link);
		mysqli_close($link);
		header("location: cocktail_view.php?cocktailid=" . $cocktailid);
	}
		if(isset($_GET['cocktailid'])){
		$userid = $_GET['userid'];
		$cocktailid = $_GET['cocktailid'];
		$ordered = $_GET['ordered'];
		$favorite = $_GET['favorite'];
		$cocktailname = $_GET['cocktailname'];
		$image = $_GET['image'];
		$cocktailcategory = $_GET['cocktailcategory'];
		$cocktailtaste = $_GET['cocktailtaste'];
		$description = $_GET['description'];
		$rating = $_GET['myrating'];
		if(empty($cocktailid)){
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_create_cocktail);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "ssss", $cocktailname, $description, $instruction, $image);
			mysqli_stmt_execute($stmt_sql_cocktail);
			$cocktailid = mysqli_stmt_insert_id($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			mysqli_commit($link);
		}
		else{
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_update_cocktail);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "ssssi", $cocktailname, $description, $instruction, $image, $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			mysqli_commit($link);
		}
		$stmt_delete_cocktailcategorylist = mysqli_prepare($link, $sql_delete_cocktailcategorylist);
		mysqli_stmt_bind_param($stmt_delete_cocktailcategorylist, "i", $cocktailid);
		mysqli_stmt_execute($stmt_delete_cocktailcategorylist);
		mysqli_stmt_close($stmt_delete_cocktailcategorylist);
		mysqli_commit($link);
		if(isset($cocktailcategory)){
			foreach ($cocktailcategory as $category){
				$stmt_create_cocktailcategorylist = mysqli_prepare($link, $sql_create_cocktailcategorylist);
				mysqli_stmt_bind_param($stmt_create_cocktailcategorylist, "ii", $cocktailid, $category);
				mysqli_stmt_execute($stmt_create_cocktailcategorylist);
				mysqli_stmt_close($stmt_create_cocktailcategorylist);
				mysqli_commit($link);
			}
		}
		$stmt_delete_cocktailtastelist = mysqli_prepare($link, $sql_delete_cocktailtastelist);
		mysqli_stmt_bind_param($stmt_delete_cocktailtastelist, "i", $cocktailid);
		mysqli_stmt_execute($stmt_delete_cocktailtastelist);
		mysqli_stmt_close($stmt_delete_cocktailtastelist);
		mysqli_commit($link);
		if(isset($cocktailtaste)){
			foreach ($cocktailtaste as $taste){
				$stmt_create_cocktailtastelist = mysqli_prepare($link, $sql_create_cocktailtastelist);
				mysqli_stmt_bind_param($stmt_create_cocktailtastelist, "ii", $cocktailid, $taste);
				mysqli_stmt_execute($stmt_create_cocktailtastelist);
				mysqli_stmt_close($stmt_create_cocktailtastelist);
				mysqli_commit($link);
			}
		}
		mysqli_close($link);
		header("location: cocktail_view.php?cocktailid=" . $cocktailid);
	}
	if(isset($_GET['cocktailid'])&&isset($_GET['ordered'])){
		$cocktailid =  $_GET['cocktailid'];
		$ordered =  $_GET['ordered'];
		$stmt_create_order = mysqli_prepare($link, $sql_create_order);
		mysqli_stmt_bind_param($stmt_create_order, "iii", $_SESSION["id"], $cocktailid, $_SESSION["bar"]);
		mysqli_stmt_execute($stmt_create_order);
		mysqli_stmt_close($stmt_create_order);
		mysqli_commit($link);
		mysqli_close($link);
		header("location: cocktail_view.php?cocktailid=" . $cocktailid);
	}
	if(isset($_GET['cocktailid'])&&isset($_GET['favorite'])){
		$cocktailid =  $_GET['cocktailid'];
		$favorite =  $_GET['favorite'];
		$stmt_create_order = mysqli_prepare($link, $sql_create_cocktailfavorite);
		if($favorite == 0){
			$stmt_create_order = mysqli_prepare($link, $sql_delete_cocktailfavorite);
		}
		mysqli_stmt_bind_param($stmt_create_order, "ii", $_SESSION["id"], $cocktailid);
		mysqli_stmt_execute($stmt_create_order);
		mysqli_stmt_close($stmt_create_order);
		mysqli_commit($link);
		mysqli_close($link);
		header("location: cocktail_view.php?cocktailid=" . $cocktailid);
	}
?>