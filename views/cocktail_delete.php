 <?php
if(!isset($_SESSION)) 
	{
		session_start(); 
	}
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: login.php");
	exit;
}
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";
	
	
	if(isset($_GET['cocktailid'])&&$_SESSION["role"] == 1)
	{
		$cocktailid =  $_GET['cocktailid'];
		
		$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_cocktailcategorylist);
		mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
		mysqli_stmt_execute($stmt_sql_cocktail);
		mysqli_stmt_close($stmt_sql_cocktail);
		mysqli_commit($link);
		
		$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_all_cocktailfavorite);
		mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
		mysqli_stmt_execute($stmt_sql_cocktail);
		mysqli_stmt_close($stmt_sql_cocktail);
		mysqli_commit($link);
		
		$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_all_cocktailingredientlist);
		mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
		mysqli_stmt_execute($stmt_sql_cocktail);
		mysqli_stmt_close($stmt_sql_cocktail);
		mysqli_commit($link);
		
		$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_all_cocktailrating);
		mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
		mysqli_stmt_execute($stmt_sql_cocktail);
		mysqli_stmt_close($stmt_sql_cocktail);
		mysqli_commit($link);
		
		$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_cocktailtastelist);
		mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
		mysqli_stmt_execute($stmt_sql_cocktail);
		mysqli_stmt_close($stmt_sql_cocktail);
		mysqli_commit($link);
		
		$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_cocktailorder);
		mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
		mysqli_stmt_execute($stmt_sql_cocktail);
		mysqli_stmt_close($stmt_sql_cocktail);
		mysqli_commit($link);
		
		$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_cocktail);
		mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
		mysqli_stmt_execute($stmt_sql_cocktail);
		mysqli_stmt_close($stmt_sql_cocktail);
		mysqli_commit($link);
		mysqli_close($link);
	}
	header("location: cocktails.php");
	exit;
?>