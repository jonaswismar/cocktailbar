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

	$icon = $_POST['icon'];
	$barid = $_POST['bar'];
	$garnish = 0;
	$metricunits = 0;
	$searchmode = 1;
	$darkmode = "auto";
	$theme = "default";
	if(isset($_POST["garnish"])){
		$garnish = 1;
	}
	if(isset($_POST["metric"])){
		$metricunits = 1;
	}
	if(isset($_POST["searchmode"])){
		$searchmode = $_POST["searchmode"];
	}
	if(isset($_POST["darkmode"])){
		$darkmode = $_POST["darkmode"];
	}
	if(isset($_POST["theme"])){
		$theme = $_POST["theme"];
	}
	$startpage = $_POST['startpage'];
	$language = $_POST['language'];
	$userid = $_SESSION["id"];
	
	$stmt_changesettings = mysqli_prepare($link, $sql_users_changesettings);
	mysqli_stmt_bind_param($stmt_changesettings, "siissiiiss", $icon, $barid, $garnish, $startpage, $language, $metricunits, $searchmode, $darkmode, $theme, $userid);
	mysqli_stmt_execute($stmt_changesettings);
	mysqli_stmt_close($stmt_changesettings);
	mysqli_commit($link);
	mysqli_close($link);
	
	$_SESSION["bar"] = $barid;
	$_SESSION["icon"] = $icon;
	$_SESSION["ignoregarnish"] = $garnish;
	$_SESSION["startpage"] = $startpage;
	$_SESSION["language"] = $language;
	$_SESSION["metricunits"] = $metricunits;
	$_SESSION["searchmode"] = $searchmode;
	$_SESSION["darkmode"] = $darkmode;
	$_SESSION["theme"] = $theme;
	header("location: /views/userprefs.php");
	exit;
?>