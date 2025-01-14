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
	$ingredientid = 0;
	if(isset($_POST['ingredientid'])){
		$ingredientid = $_POST['ingredientid'];
		if(isset($_POST['ingredientname'])&&isset($_POST['ingredienttype'])&&isset($_POST['description'])&&isset($_POST['ingredientimage'])){
			$ingredientname =  $_POST['ingredientname'];
			$ingredienttype =  $_POST['ingredienttype'];
			$description =  $_POST['description'];
			$image =  $_POST['ingredientimage'];
			foreach ($ingredienttype as $type){
				if(empty($ingredientid)){
					$stmt_sql_ingredient = mysqli_prepare($link, $sql_create_ingredient);
					mysqli_stmt_bind_param($stmt_sql_ingredient, "sssi", $ingredientname, $description, $image, $type);
					mysqli_stmt_execute($stmt_sql_ingredient);
					$ingredientid = mysqli_stmt_insert_id($stmt_sql_ingredient);
					mysqli_stmt_close($stmt_sql_ingredient);
					mysqli_commit($link);
				}
				else{
					$stmt_sql_ingredient = mysqli_prepare($link, $sql_update_ingredient);
					mysqli_stmt_bind_param($stmt_sql_ingredient, "sssii", $ingredientname, $description, $image, $type, $ingredientid);
					mysqli_stmt_execute($stmt_sql_ingredient);
					mysqli_stmt_close($stmt_sql_ingredient);
					mysqli_commit($link);
				}
			}
		}
		if(isset($_POST['ingredienttaste'])){
			$ingredienttaste = $_POST['ingredienttaste'];
			$stmt_delete_ingredienttastelist = mysqli_prepare($link, $sql_delete_ingredienttastelist);
			mysqli_stmt_bind_param($stmt_delete_ingredienttastelist, "i", $ingredientid);
			mysqli_stmt_execute($stmt_delete_ingredienttastelist);
			mysqli_stmt_close($stmt_delete_ingredienttastelist);
			mysqli_commit($link);
			foreach ($ingredienttaste as $taste){
				$stmt_create_ingredienttastelist = mysqli_prepare($link, $sql_create_ingredienttastelist);
				mysqli_stmt_bind_param($stmt_create_ingredienttastelist, "ii", $ingredientid, $taste);
				mysqli_stmt_execute($stmt_create_ingredienttastelist);
				mysqli_stmt_close($stmt_create_ingredienttastelist);
				mysqli_commit($link);
			}
		}
		if(isset($_POST['available'])){
			$available = $_POST['available'];
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_update_ingredient_available);
			mysqli_stmt_bind_param($stmt_sql_ingredient, "iii", $available, $_SESSION["bar"], $ingredientid);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
		}
		if(isset($_POST['shoppable'])){
			$shoppable = $_POST['shoppable'];
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_update_ingredient_shoppable);
			mysqli_stmt_bind_param($stmt_sql_ingredient, "iii", $shoppable, $_SESSION["bar"], $ingredientid);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
		}
		if(isset($_POST['favorite'])){
			$favorite =  $_POST['favorite'];
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_create_ingredientfavorite);
			if($favorite == 0){
				$stmt_sql_ingredient = mysqli_prepare($link, $sql_delete_ingredientfavorite);
			}
			mysqli_stmt_bind_param($stmt_sql_ingredient, "ii", $_SESSION["id"], $ingredientid);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
		}
		mysqli_close($link);
	}
	if(isset($_GET['ingredientid'])){
		$ingredientid = $_GET['ingredientid'];
		if(isset($_GET['ingredientname'])&&isset($_GET['ingredienttype'])&&isset($_GET['description'])&&isset($_GET['ingredientimage'])){
			$ingredientname =  $_GET['ingredientname'];
			$ingredienttype =  $_GET['ingredienttype'];
			$description =  $_GET['description'];
			$image =  $_GET['ingredientimage'];
			foreach ($ingredienttype as $type){
				if(empty($ingredientid)){
					$stmt_sql_ingredient = mysqli_prepare($link, $sql_create_ingredient);
					mysqli_stmt_bind_param($stmt_sql_ingredient, "sssi", $ingredientname, $description, $image, $type);
					mysqli_stmt_execute($stmt_sql_ingredient);
					$ingredientid = mysqli_stmt_insert_id($stmt_sql_ingredient);
					mysqli_stmt_close($stmt_sql_ingredient);
					mysqli_commit($link);
				}
				else{
					$stmt_sql_ingredient = mysqli_prepare($link, $sql_update_ingredient);
					mysqli_stmt_bind_param($stmt_sql_ingredient, "sssii", $ingredientname, $description, $image, $type, $ingredientid);
					mysqli_stmt_execute($stmt_sql_ingredient);
					mysqli_stmt_close($stmt_sql_ingredient);
					mysqli_commit($link);
				}
			}
		}
		if(isset($_GET['ingredienttaste'])){
			$ingredienttaste = $_GET['ingredienttaste'];
			$stmt_delete_ingredienttastelist = mysqli_prepare($link, $sql_delete_ingredienttastelist);
			mysqli_stmt_bind_param($stmt_delete_ingredienttastelist, "i", $ingredientid);
			mysqli_stmt_execute($stmt_delete_ingredienttastelist);
			mysqli_stmt_close($stmt_delete_ingredienttastelist);
			mysqli_commit($link);
			foreach ($ingredienttaste as $taste){
				$stmt_create_ingredienttastelist = mysqli_prepare($link, $sql_create_ingredienttastelist);
				mysqli_stmt_bind_param($stmt_create_ingredienttastelist, "ii", $ingredientid, $taste);
				mysqli_stmt_execute($stmt_create_ingredienttastelist);
				mysqli_stmt_close($stmt_create_ingredienttastelist);
				mysqli_commit($link);
			}
		}
		if(isset($_GET['available'])){
			$available = $_GET['available'];
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_update_ingredient_available);
			mysqli_stmt_bind_param($stmt_sql_ingredient, "iii", $available, $_SESSION["bar"], $ingredientid);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
		}
		if(isset($_GET['shoppable'])){
			$shoppable = $_GET['shoppable'];
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_update_ingredient_shoppable);
			mysqli_stmt_bind_param($stmt_sql_ingredient, "iii", $shoppable, $_SESSION["bar"], $ingredientid);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
		}
		if(isset($_GET['favorite'])){
			$favorite =  $_GET['favorite'];
			$stmt_sql_ingredient = mysqli_prepare($link, $sql_create_ingredientfavorite);
			if($favorite == 0){
				$stmt_sql_ingredient = mysqli_prepare($link, $sql_delete_ingredientfavorite);
			}
			mysqli_stmt_bind_param($stmt_sql_ingredient, "ii", $_SESSION["id"], $ingredientid);
			mysqli_stmt_execute($stmt_sql_ingredient);
			mysqli_stmt_close($stmt_sql_ingredient);
			mysqli_commit($link);
		}
		mysqli_close($link);
	}
	if(empty($ingredientid)){
		header("location: /views/ingredients.php");
	}
	else{
		header("location: /views/ingredient.php?ingredientid=" . $ingredientid);
	}
	exit;
?>