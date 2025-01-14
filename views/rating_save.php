<?php
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";

	if(isset($_GET['cocktailid'])&&isset($_GET['rating'])&&isset($_GET['userid']))
	{
		$cocktailid =  $_GET['cocktailid'];
		$rating =  $_GET['rating'];
		$userid =  $_GET['userid'];
		$stmt_create_rating = mysqli_prepare($link, $sql_create_rating);
		mysqli_stmt_bind_param($stmt_create_rating, "iiiiii", $cocktailid, $userid, $rating, $cocktailid, $userid, $rating);
		mysqli_stmt_execute($stmt_create_rating);
		mysqli_stmt_close($stmt_create_rating);
		mysqli_commit($link);
		mysqli_close($link);
		header("location: cocktail.php?cocktailid=" . $cocktailid);
	}
	else if(isset($_GET['cocktailid']))
	{
		$cocktailid =  $_GET['cocktailid'];
		//header("location: cocktail.php?cocktailid=" . $cocktailid);
	}
	//header("location: cocktails.php?view=my");
?>