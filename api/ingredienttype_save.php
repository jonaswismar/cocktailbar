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
	$ingredienttypeid = 0;
	$ingredienttypename = "";
	$ingredienttypedescription = "";
	$ingredienttypeicon = "";
	if(isset($_POST['ingredienttypeid'])){
		$ingredienttypeid =  $_POST['ingredienttypeid'];
		$ingredienttypename = $_POST['ingredienttypename'];
		$ingredienttypedescription =  $_POST['ingredienttypedescription'];
		$ingredienttypeicon =  $_POST['ingredienttypeicon'];
	}
	if(isset($_GET['ingredienttypeid'])){
		$ingredienttypeid =  $_GET['ingredienttypeid'];
		$ingredienttypename = $_GET['ingredienttypename'];
		$ingredienttypedescription =  $_GET['ingredienttypedescription'];
		$ingredienttypeiicon=  $_GET['ingredienttypeicon'];
	}
	if(empty($ingredienttypeid)||$ingredienttypeid = 0){
		$stmt_sql_ingredienttype = mysqli_prepare($link, $sql_create_ingredienttype);
		mysqli_stmt_bind_param($stmt_sql_ingredienttype, "sss", $ingredienttypename, $ingredienttypedescription, $ingredienttypeicon);
	}
	else{
		$stmt_sql_ingredienttype = mysqli_prepare($link, $sql_update_ingredienttype);
		mysqli_stmt_bind_param($stmt_sql_ingredienttype, "sssi", $ingredienttypename, $ingredienttypedescription, $ingredienttypeicon, $ingredienttypeid);
	}
	mysqli_stmt_execute($stmt_sql_ingredienttype);
	mysqli_stmt_close($stmt_sql_ingredienttype);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: /views/ingredienttypes.php");
	exit;
?>