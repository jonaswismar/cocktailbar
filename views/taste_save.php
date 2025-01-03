 <?php
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";

	$tasteid =  $_POST['tasteid'];
	$tastename = $_POST['tastename'];
	$tastedescription =  $_POST['tastedescription'];
	$tasteimage =  $_POST['tasteimage'];

	if(empty($tasteid))
	{
		$stmt_sql_taste = mysqli_prepare($link, $sql_create_taste);
		mysqli_stmt_bind_param($stmt_sql_taste, "sss", $tastename, $tastedescription, $tasteimage);
	}
	else
	{
		$stmt_sql_taste = mysqli_prepare($link, $sql_update_taste);
		mysqli_stmt_bind_param($stmt_sql_taste, "sssi", $tastename, $tastedescription, $tasteimage, $tasteid);
	}

	mysqli_stmt_execute($stmt_sql_taste);
	mysqli_stmt_close($stmt_sql_taste);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: tastes.php");
	exit;
?>