 <?php
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";
	
	$tasteid =  $_GET['tasteid'];
	
	$stmt_sql_taste = mysqli_prepare($link, $sql_delete_taste);
	mysqli_stmt_bind_param($stmt_sql_taste, "i", $tasteid);
	mysqli_stmt_execute($stmt_sql_taste);
	mysqli_stmt_close($stmt_sql_taste);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: tastes.php");
	exit;
?>