<?php
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";

	$ingredienttypeid =  $_POST['ingredienttypeid'];
	$typename = $_POST['typename'];
	$color =  $_POST['color'];
	$description =  $_POST['description'];
	$image =  $_POST['image'];

	if(empty($ingredienttypeid))
	{
		$stmt_sql_ingredienttype = mysqli_prepare($link, $sql_create_ingredienttype);
		mysqli_stmt_bind_param($stmt_sql_ingredienttype, "ssss", $typename, $color, $description, $image);
	}
	else
	{
		$stmt_sql_ingredienttype = mysqli_prepare($link, $sql_update_ingredienttype);
		mysqli_stmt_bind_param($stmt_sql_ingredienttype, "ssssi", $typename, $color, $description, $image, $ingredienttypeid);
	}

	mysqli_stmt_execute($stmt_sql_ingredienttype);
	mysqli_stmt_close($stmt_sql_ingredienttype);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: ingredienttypes.php");
	exit;
?>