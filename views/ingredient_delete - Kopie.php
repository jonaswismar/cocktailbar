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
	
	$ingredientid =  $_GET['ingredientid'];
	
	$stmt_sql_ingredient = mysqli_prepare($link, $sql_delete_ingredient);
	mysqli_stmt_bind_param($stmt_sql_ingredient, "i", $ingredientid);
	mysqli_stmt_execute($stmt_sql_ingredient);
	mysqli_stmt_close($stmt_sql_ingredient);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: ingredient.php");
	exit;
?>