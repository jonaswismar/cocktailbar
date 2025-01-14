 <?php
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";
	
	$ingredienttypeid =  $_GET['ingredienttypeid'];
	
	$stmt_sql_ingredienttype = mysqli_prepare($link, $sql_delete_ingredienttype);
	mysqli_stmt_bind_param($stmt_sql_ingredienttype, "i", $ingredienttypeid);
	mysqli_stmt_execute($stmt_sql_ingredienttype);
	mysqli_stmt_close($stmt_sql_ingredienttype);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: ingredienttypes.php");
	exit;
?>