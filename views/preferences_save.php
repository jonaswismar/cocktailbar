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

	$barid = $_POST['bar'];
	
	
	echo $barid;
	if(isset($barid))
	{
		$stmt_pref_insert = mysqli_prepare($link, $sql_pref_insert);
		mysqli_stmt_bind_param($stmt_pref_insert, "s", "bar");
		mysqli_stmt_execute($stmt_pref_insert);
		mysqli_stmt_close($stmt_pref_insert);
		mysqli_commit($link);
		mysqli_close($link);
		//header("location: preferences.php");
	}
?>