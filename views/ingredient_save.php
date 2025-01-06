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
	if(isset($_POST['ingredientid'])){
		$ingredientid = $_POST['ingredientid'];
		if(isset($_POST['available'])){
			$available = $_POST['available'];
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_update_ingredient_available);
			mysqli_stmt_bind_param($stmt_sql_ingredient, "iii", $available, $_SESSION["bar"], $ingredientid);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
			mysqli_close($link);
		}
		else if(isset($_POST['shoppable'])){
			$shoppable = $_POST['shoppable'];
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_update_ingredient_shoppable);
			mysqli_stmt_bind_param($stmt_sql_ingredient, "iii", $shoppable, $_SESSION["bar"], $ingredientid);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
			mysqli_close($link);
		}
		else if(isset($_POST['favorite'])){
			$favorite =  $_POST['favorite'];
			$stmt_create_order = mysqli_prepare($link, $sql_create_ingredientfavorite);
			if($favorite == 0)
			{
				$stmt_create_order = mysqli_prepare($link, $sql_delete_ingredientfavorite);
			}
			mysqli_stmt_bind_param($stmt_create_order, "ii", $_SESSION["id"], $ingredientid);
			mysqli_stmt_execute($stmt_create_order);
			mysqli_stmt_close($stmt_create_order);
			mysqli_commit($link);
			mysqli_close($link);
		}
		header("location: ingredient_view.php?ingredientid=" . $ingredientid);
		exit;
	}
	if(isset($_GET['ingredientid'])){
		$ingredientid = $_GET['ingredientid'];
		if(isset($_GET['available'])){
			$available = $_GET['available'];
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_update_ingredient_available);
			mysqli_stmt_bind_param($stmt_sql_ingredient, "iii", $available, $_SESSION["bar"], $ingredientid);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
			mysqli_close($link);
		}
		else if(isset($_GET['shoppable'])){
			$shoppable = $_GET['shoppable'];
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_update_ingredient_shoppable);
			mysqli_stmt_bind_param($stmt_sql_ingredient, "iii", $shoppable, $_SESSION["bar"], $ingredientid);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
			mysqli_close($link);
		}
		else if(isset($_GET['favorite'])){
			$favorite =  $_GET['favorite'];
			$stmt_create_order = mysqli_prepare($link, $sql_create_ingredientfavorite);
			if($favorite == 0)
			{
				$stmt_create_order = mysqli_prepare($link, $sql_delete_ingredientfavorite);
			}
			mysqli_stmt_bind_param($stmt_create_order, "ii", $_SESSION["id"], $ingredientid);
			mysqli_stmt_execute($stmt_create_order);
			mysqli_stmt_close($stmt_create_order);
			mysqli_commit($link);
			mysqli_close($link);
		}
		header("location: ingredient_view.php?ingredientid=" . $ingredientid);
		exit;
	}
	if(isset($_GET['ingredientname'])){
		$ingredientid =  $_GET['ingredientid'];
		$ingredientname =  $_GET['ingredientname'];
		$ingredienttype =  $_GET['ingredienttype'];
		$description =  $_GET['description'];
		$available =  $_GET['available'];
		$shoppable =  $_GET['shoppable'];
		$image =  $_GET['image'];
		if(empty($ingredientid)){
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_create_ingredient);
			mysqli_stmt_bind_param($stmt_sql_ingredient, "sssiii", $ingredientname, $description, $image, $available, $shoppable, $ingredienttype);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
			mysqli_close($link);
		}
		else{
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_update_ingredient);
			mysqli_stmt_bind_param($stmt_sql_ingredient, "sssiiii", $ingredientname, $description, $image, $available, $shoppable, $ingredienttype, $ingredientid);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
			mysqli_close($link);
		}
		header("location: ingredient_view.php?ingredientid=" . $ingredientid);
		exit;
	}
	if(isset($_POST['ingredientname'])){
		$ingredientid =  $_POST['ingredientid'];
		$ingredientname =  $_POST['ingredientname'];
		$ingredienttype =  $_POST['ingredienttype'];
		$description =  $_POST['description'];
		$available =  $_POST['available'];
		$shoppable =  $_POST['shoppable'];
		$image =  $_POST['image'];
		if(empty($ingredientid)){
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_create_ingredient);
			mysqli_stmt_bind_param($stmt_sql_ingredient, "sssiii", $ingredientname, $description, $image, $available, $shoppable, $ingredienttype);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
			mysqli_close($link);
		}
		else{
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_update_ingredient);
			mysqli_stmt_bind_param($stmt_sql_ingredient, "sssiiii", $ingredientname, $description, $image, $available, $shoppable, $ingredienttype, $ingredientid);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
			mysqli_close($link);
		}
		header("location: ingredient_view.php?ingredientid=" . $ingredientid);
		exit;
	}
?>