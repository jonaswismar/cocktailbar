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
	if(isset($_POST['ingredientid'])&&$_SESSION["role"] == 1){
		$ingredientid =  $_POST['ingredientid'];
		$stmt_sql_ingredient = mysqli_prepare($link, $sql_get_cocktail_from_ingredient);
		mysqli_stmt_bind_param($stmt_sql_ingredient, "i", $ingredientid);
		mysqli_stmt_execute($stmt_sql_ingredient);
		$ingredient_all_res=mysqli_stmt_get_result($stmt_sql_ingredient);
		while($ingredient_all_rows= mysqli_fetch_array($ingredient_all_res, MYSQLI_ASSOC)){
			$cocktailid =  $ingredient_all_rows['cocktail'];
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_cocktailcategorylist);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_all_cocktailfavorite);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_all_cocktailingredientlist);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_all_cocktailrating);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_cocktailtastelist);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_cocktailorder);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_cocktail);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
		}
		mysqli_commit($link);
		mysqli_stmt_close($stmt_sql_ingredient);
		$stmt_sql_ingredient = mysqli_prepare($link, $sql_delete_all_ingredientfavorite);
		mysqli_stmt_bind_param($stmt_sql_ingredient, "i", $ingredientid);
		mysqli_stmt_execute($stmt_sql_ingredient);
		mysqli_stmt_close($stmt_sql_ingredient);
		mysqli_commit($link);
		$stmt_sql_ingredient = mysqli_prepare($link, $sql_delete_all_ingredientrating);
		mysqli_stmt_bind_param($stmt_sql_ingredient, "i", $ingredientid);
		mysqli_stmt_execute($stmt_sql_ingredient);
		mysqli_stmt_close($stmt_sql_ingredient);
		mysqli_commit($link);
		$stmt_sql_ingredient = mysqli_prepare($link, $sql_delete_ingredienttastelist);
		mysqli_stmt_bind_param($stmt_sql_ingredient, "i", $ingredientid);
		mysqli_stmt_execute($stmt_sql_ingredient);
		mysqli_stmt_close($stmt_sql_ingredient);
		mysqli_commit($link);
		$stmt_sql_ingredient = mysqli_prepare($link, $sql_delete_all_ingredient);
		mysqli_stmt_bind_param($stmt_sql_ingredient, "i", $ingredientid);
		mysqli_stmt_execute($stmt_sql_ingredient);
		mysqli_stmt_close($stmt_sql_ingredient);
		mysqli_commit($link);
	}
	if(isset($_GET['ingredientid'])&&$_SESSION["role"] == 1){
		$ingredientid =  $_GET['ingredientid'];
		$stmt_sql_ingredient = mysqli_prepare($link, $sql_get_cocktail_from_ingredient);
		mysqli_stmt_bind_param($stmt_sql_ingredient, "i", $ingredientid);
		mysqli_stmt_execute($stmt_sql_ingredient);
		$ingredient_all_res=mysqli_stmt_get_result($stmt_sql_ingredient);
		while($ingredient_all_rows= mysqli_fetch_array($ingredient_all_res, MYSQLI_ASSOC)){
			$cocktailid =  $ingredient_all_rows['cocktail'];
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_cocktailcategorylist);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_all_cocktailfavorite);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_all_cocktailingredientlist);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_all_cocktailrating);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_cocktailtastelist);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_cocktailorder);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
			$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_cocktail);
			mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
			mysqli_stmt_execute($stmt_sql_cocktail);
			mysqli_stmt_close($stmt_sql_cocktail);
		}
		mysqli_commit($link);
		mysqli_stmt_close($stmt_sql_ingredient);
		$stmt_sql_ingredient = mysqli_prepare($link, $sql_delete_all_ingredientfavorite);
		mysqli_stmt_bind_param($stmt_sql_ingredient, "i", $ingredientid);
		mysqli_stmt_execute($stmt_sql_ingredient);
		mysqli_stmt_close($stmt_sql_ingredient);
		mysqli_commit($link);
		$stmt_sql_ingredient = mysqli_prepare($link, $sql_delete_all_ingredientrating);
		mysqli_stmt_bind_param($stmt_sql_ingredient, "i", $ingredientid);
		mysqli_stmt_execute($stmt_sql_ingredient);
		mysqli_stmt_close($stmt_sql_ingredient);
		mysqli_commit($link);
		$stmt_sql_ingredient = mysqli_prepare($link, $sql_delete_ingredienttastelist);
		mysqli_stmt_bind_param($stmt_sql_ingredient, "i", $ingredientid);
		mysqli_stmt_execute($stmt_sql_ingredient);
		mysqli_stmt_close($stmt_sql_ingredient);
		mysqli_commit($link);
		$stmt_sql_ingredient = mysqli_prepare($link, $sql_delete_all_ingredient);
		mysqli_stmt_bind_param($stmt_sql_ingredient, "i", $ingredientid);
		mysqli_stmt_execute($stmt_sql_ingredient);
		mysqli_stmt_close($stmt_sql_ingredient);
		mysqli_commit($link);
	}
	header("location: /views/ingredients.php");
	exit;
?>