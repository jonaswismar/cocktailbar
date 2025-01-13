<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: login.php");
	exit;
}
require_once "../db/sql_config.php";
require_once "../db/sql_statements.php";

$password = $confirm_password = "";
$password_err = $confirm_password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty(trim($_POST["password"]))){
		$password_err = "Bitte Passwort eingeben.";     
	} elseif(strlen(trim($_POST["password"])) < 6){
		$password_err = "Passwort muss mindestens 6 Zeichen beinhalten.";
	} else{
		$password = trim($_POST["password"]);
	}
	if(empty(trim($_POST["confirm_password"]))){
		$confirm_password_err = "Bitte Passwort bestätigen.";
	} else{
		$confirm_password = trim($_POST["confirm_password"]);
		if(empty($password_err) && ($password != $confirm_password)){
			$confirm_password_err = "Passwort nicht identisch.";
		}
	}
	if(empty($password_err) && empty($confirm_password_err)){
		if($stmt = mysqli_prepare($link, $sql_users_changepassword)){
			$param_password = password_hash($password, PASSWORD_DEFAULT);
			$param_id = $_SESSION["id"];
			mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
			if(mysqli_stmt_execute($stmt)){
				session_destroy();
				header("location: /views/login.php");
				exit();
			} else{
				echo "Oops! Irgendetwas lief schief. Versuche es später wieder.";
			}
			mysqli_stmt_close($stmt);
		}
	}
	mysqli_close($link);
}
?>
<?php include("header_login.php") ?>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<div class="mb-4 d-flex justify-content-center">
					<div class="logo-blurred-edge"></div>
				</div>
				<h1 class="h3 mb-3 fw-normal">Passwort ändern</h1>
<?php 
	if(!empty($login_err)){
		echo '<div class="alert alert-danger">' . $login_err . '</div>';
	}        
?>
				<div class="form-floating">
					<input type="password" name="password" class="form-control<?php echo (!empty($password_err)) ? ' is-invalid' : ''; ?>" id="floatingPassword" placeholder="Passwort" value="<?php echo $password; ?>" style="margin-bottom: -1px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;" data-toggle="tooltip" data-placement="bottom" title="Passwort">
					<label for="floatingPassword">Passwort</label>
					<span class="invalid-feedback"><?php echo $password_err; ?></span>
				</div>
				<div class="form-floating">
					<input type="password" name="confirm_password" class="form-control<?php echo (!empty($confirm_password_err)) ? ' is-invalid' : ''; ?>" id="floatingConfirmPassword" placeholder="Passwort" value="<?php echo $confirm_password; ?>" style="margin-bottom: 10px;border-top-left-radius: 0;border-top-right-radius: 0;border-bottom-right-radius: var(--bs-border-radius);border-bottom-left-radius: var(--bs-border-radius);" data-toggle="tooltip" data-placement="bottom" title="Passwort bestätigen">
					<label for="floatingConfirmPassword">Passwort bestätigen</label>
					<span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
				</div>
				<button class="btn btn-primary w-100 py-2" type="submit">Ändern</button>
				<p class="mt-5 mb-3 text-body-secondary">&copy; 2024–<?php echo date("Y"); ?></p>
			</form>
<?php include("footer_login.php") ?>