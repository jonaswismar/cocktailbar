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
	$ingredienttypename = "";
	$ingredienttypedescription = "";
	$ingredienttypeimage = "";
	if(isset($_POST['ingredienttypeid'])){
		$ingredienttypeid =  $_POST['ingredienttypeid'];
		$ingredienttypename = $_POST['ingredienttypename'];
		$ingredienttypedescription =  $_POST['ingredienttypedescription'];
		$ingredienttypeimage =  $_POST['ingredienttypeimage'];
	}
	if(isset($_GET['ingredienttypeid'])){
		$ingredienttypeid =  $_GET['ingredienttypeid'];
		$ingredienttypename = $_GET['ingredienttypename'];
		$ingredienttypedescription =  $_GET['ingredienttypedescription'];
		$ingredienttypeimage =  $_GET['ingredienttypeimage'];
	}
	if(empty($ingredienttypeid)||$ingredienttypeid = 0){
		$stmt_sql_ingredienttype = mysqli_prepare($link, $sql_create_ingredienttype);
		mysqli_stmt_bind_param($stmt_sql_ingredienttype, "sss", $ingredienttypename, $ingredienttypedescription, $ingredienttypeimage);
	}
	else{
		$stmt_sql_ingredienttype = mysqli_prepare($link, $sql_update_ingredienttype);
		mysqli_stmt_bind_param($stmt_sql_ingredienttype, "sssi", $ingredienttypename, $ingredienttypedescription, $ingredienttypeimage, $ingredienttypeid);
	}
	mysqli_stmt_execute($stmt_sql_ingredienttype);
	mysqli_stmt_close($stmt_sql_ingredienttype);
	mysqli_commit($link);
	mysqli_close($link);
	header("location: ingredienttypes.php");
	exit;
?>