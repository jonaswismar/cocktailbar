 <?php
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";

	$unitid =  $_POST['unitid'];
	$unitname = $_POST['unitname'];
	$unitshort =  $_POST['unitshort'];
	$unitshortX =  $_POST['unitshortX'];
	$description =  $_POST['description'];
	$image =  $_POST['image'];

	if(empty($unitid))
	{
		$stmt_sql_unit = mysqli_prepare($link, $sql_create_unit);
		mysqli_stmt_bind_param($stmt_sql_unit, "sssss", $unitname, $unitshort, $unitshortX, $description, $image);
	}
	else
	{
		$stmt_sql_unit = mysqli_prepare($link, $sql_update_unit);
		mysqli_stmt_bind_param($stmt_sql_unit, "sssssi", $unitname, $unitshort, $unitshortX, $description, $image, $unitid);
	}

	mysqli_stmt_execute($stmt_sql_unit);
	mysqli_stmt_close($stmt_sql_unit);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: units.php");
	exit;
?>