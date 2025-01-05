 <?php
	if(!isset($_SESSION)){
		session_start(); 
	}
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";
	$tasteid = 0;
	$tastename = "";
	$tastedescription = "";
	$tasteimage = "";
	if(isset($_POST['tasteid'])){
		$tasteid =  $_POST['tasteid'];
		$tastename = $_POST['tastename'];
		$tastedescription =  $_POST['tastedescription'];
		$tasteimage =  $_POST['tasteimage'];
	}
	if(isset($_GET['tasteid'])){
		$tasteid =  $_GET['tasteid'];
		$tastename = $_GET['tastename'];
		$tastedescription =  $_GET['tastedescription'];
		$tasteimage =  $_GET['tasteimage'];
	}
	if(empty($tasteid)||$tasteid = 0){
		$stmt_sql_taste = mysqli_prepare($link, $sql_create_taste);
		mysqli_stmt_bind_param($stmt_sql_taste, "sss", $tastename, $tastedescription, $tasteimage);
	}
	else{
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