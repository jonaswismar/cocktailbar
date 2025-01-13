 <?php
	if(!isset($_SESSION)){
		session_start(); 
	}
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: /views/login.php");
		exit;
	}
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";
	$userid = 0;
	if(isset($_POST['userid'])){
		$userid =  $_POST['userid'];
	}
	if(isset($_GET['userid'])){
		$userid = $_GET['userid'];
	}
	$stmt_sql_user = mysqli_prepare($link, $sql_user_delete);
	mysqli_stmt_bind_param($stmt_sql_user, "i", $userid);
	mysqli_stmt_execute($stmt_sql_user);
	mysqli_stmt_close($stmt_sql_user);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: /views/users.php");
	exit;
?>