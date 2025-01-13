<?php print_r($_POST); ?>
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
	$usericon = "";
	$username = "";
	$userrole = 3;
	$userpassword = "";
	if(isset($_POST['userid'])){
		$userid =  $_POST['userid'];
		if(isset($_POST['usericon'])){
			$usericon =  $_POST['usericon'];
		}
		if(isset($_POST['username'])){
			$username =  $_POST['username'];
		}
		if(isset($_POST['userrole'])){
			$userrole =  $_POST['userrole'];
		}
	}
	if(isset($_GET['userid'])){
		$userid = $_GET['userid'];
		if(isset($_GET['usericon'])){
			$usericon =  $_GET['usericon'];
		}
		if(isset($_GET['username'])){
			$username =  $_GET['username'];
		}
		if(isset($_GET['userrole'])){
			$userrole =  $_GET['userrole'];
		}
	}
	if(isset($_POST['userpassword'])){
		$userpassword =  $_POST['userpassword'];
		$userpassword = password_hash($userpassword, PASSWORD_DEFAULT);
	}
	if(isset($_GET['userpassword'])){
		$userpassword = $_GET['userpassword'];
		$userpassword = password_hash($userpassword, PASSWORD_DEFAULT);
	}
	if(empty($userid)){
		$stmt_sql_user = mysqli_prepare($link, $sql_users_create2);
		mysqli_stmt_bind_param($stmt_sql_user, "siss", $username, $userrole, $usericon, $userpassword);
		mysqli_stmt_execute($stmt_sql_user);
		mysqli_stmt_close($stmt_sql_user);
		mysqli_commit($link);
	}
	else{
		if(!empty($userpassword)){
			$stmt_sql_user = mysqli_prepare($link, $sql_users_changepassword);
			mysqli_stmt_bind_param($stmt_sql_user, "s", $userpassword);
			mysqli_stmt_execute($stmt_sql_user);
			mysqli_stmt_close($stmt_sql_user);
			mysqli_commit($link);
		}
		$stmt_sql_user = mysqli_prepare($link, $sql_users_change2);
		mysqli_stmt_bind_param($stmt_sql_user, "sisi", $username, $userrole, $usericon, $userid);
		mysqli_stmt_execute($stmt_sql_user);
		mysqli_stmt_close($stmt_sql_user);
		mysqli_commit($link);
	}
	header("location: /views/users.php");
	exit;
?>