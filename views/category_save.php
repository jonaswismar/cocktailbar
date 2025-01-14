 <?php
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";

	$categoryid =  $_POST['categoryid'];
	$categoryname = $_POST['categoryname'];
	$description =  $_POST['description'];
	$image =  $_POST['image'];

	if(empty($categoryid))
	{
		$stmt_sql_category = mysqli_prepare($link, $sql_create_category);
		mysqli_stmt_bind_param($stmt_sql_category, "sss", $categoryname, $description, $image);
	}
	else
	{
		$stmt_sql_category = mysqli_prepare($link, $sql_update_category);
		mysqli_stmt_bind_param($stmt_sql_category, "sssi", $categoryname, $description, $image, $categoryid);
	}

	mysqli_stmt_execute($stmt_sql_category);
	mysqli_stmt_close($stmt_sql_category);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: categorys.php");
	exit;
?>