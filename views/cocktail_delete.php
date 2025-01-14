 <?php
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";
	
	$cocktailid =  $_GET['cocktailid'];
	
	$stmt_sql_cocktail = mysqli_prepare($link, $sql_delete_cocktail);
	mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
	mysqli_stmt_execute($stmt_sql_cocktail);
	mysqli_stmt_close($stmt_sql_cocktail);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: cocktails.php");
	exit;
?>