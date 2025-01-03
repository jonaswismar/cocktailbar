<?php print_r($_POST); ?>
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

	$image = $_POST['image'];
	$barid = $_POST['bar'];
	$garnish = 0;
	$metricunits = 0;
	if(isset($_POST["garnish"])) 
	{
		$garnish = 1;
	}
	if(isset($_POST["metric"])) 
	{
		$metricunits = 1;
	}
	$startpage = $_POST['startpage'];
	$language = $_POST['language'];
	$userid = $_SESSION["id"];
	
	$stmt_changesettings = mysqli_prepare($link, $sql_users_changesettings);
	mysqli_stmt_bind_param($stmt_changesettings, "siissii", $image, $barid, $garnish, $startpage, $language, $metricunits, $userid);
	mysqli_stmt_execute($stmt_changesettings);
	mysqli_stmt_close($stmt_changesettings);
	mysqli_commit($link);
	mysqli_close($link);
	
	$_SESSION["bar"] = $barid;
	$_SESSION["image"] = $image;
	$_SESSION["ignoregarnish"] = $garnish;
	$_SESSION["startpage"] = $startpage;
	$_SESSION["language"] = $language;
	$_SESSION["metricunits"] = $metricunits;
	header("location: user_view.php");
	exit;
?>