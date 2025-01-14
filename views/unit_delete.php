 <?php
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";
	
	$unitid =  $_GET['unitid'];
	
	$stmt_sql_unit = mysqli_prepare($link, $sql_delete_unit);
	mysqli_stmt_bind_param($stmt_sql_unit, "i", $unitid);
	mysqli_stmt_execute($stmt_sql_unit);
	mysqli_stmt_close($stmt_sql_unit);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: units.php");
	exit;
?>