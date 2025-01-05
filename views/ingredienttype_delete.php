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
	$ingredienttypeid = 0;
	if(isset($_POST['ingredienttypeid'])){
		$ingredienttypeid =  $_POST['ingredienttypeid'];
	}
	if(isset($_GET['ingredienttypeid'])){
		$ingredienttypeid = $_GET['ingredienttypeid'];
	}
	$stmt_sql_ingredienttype = mysqli_prepare($link, $sql_delete_ingredienttype);
	mysqli_stmt_bind_param($stmt_sql_ingredienttype, "i", $ingredienttypeid);
	mysqli_stmt_execute($stmt_sql_ingredienttype);
	mysqli_stmt_close($stmt_sql_ingredienttype);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: ingredienttypes.php");
	exit;
?>