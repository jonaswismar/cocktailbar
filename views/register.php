<?php
require_once "../db/sql_config.php";
require_once "../db/sql_statements.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(empty(trim($_POST["username"]))){
		$username_err = "Bitte Benutzername eingeben.";
	} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
		$username_err = "Benutzername darf nur aus Zahlen, Buchstaben und Unterstrichen bestehen.";
	} else{
		if($stmt = mysqli_prepare($link, $sql_users_singleid)){
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			$param_username = trim($_POST["username"]);
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				if(mysqli_stmt_num_rows($stmt) == 1){
					$username_err = "Benutzername ist bereits vergeben.";
				} else{
					$username = trim($_POST["username"]);
				}
			} else{
				echo "Oops! Irgendetwas lief schief. Versuche es später wieder.";
			}
			mysqli_stmt_close($stmt);
		}
	}
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
	if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
		if($stmt = mysqli_prepare($link, $sql_users_create)){
			mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
			$param_username = $username;
			$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
			if(mysqli_stmt_execute($stmt)){
				header("location: login.php");
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
				<h1 class="h3 mb-3 fw-normal">Bitte registrieren</h1>
				<?php 
					if(!empty($login_err)){
						echo '<div class="alert alert-danger">' . $login_err . '</div>';
					}        
				?>
				<div class="form-floating">
					<input type="username" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="floatingInput" placeholder="name@example.com" value="<?php echo $username; ?>">
					<label for="floatingInput">Benutzername</label>
					<span class="invalid-feedback"><?php echo $username_err; ?></span>
				</div>
				<div class="form-floating">
					<input type="password" name="password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" id="floatingPassword" placeholder="Password" value="<?php echo $confirm_password; ?>" style="margin-bottom: 0px;border-top-left-radius: 0;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;">
					<label for="floatingPassword">Passwort</label>
					<span class="invalid-feedback"><?php echo $password_err; ?></span>
				</div>
				<div class="form-floating">
					<input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" id="floatingConfirmPassword" placeholder="Password" value="<?php echo $confirm_password; ?>" style="margin-bottom: 10px;border-top-left-radius: 0;border-top-right-radius: 0;border-bottom-right-radius: var(--bs-border-radius);border-bottom-left-radius: var(--bs-border-radius);">
					<label for="floatingConfirmPassword">Passwort bestätigen</label>
					<span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
				</div>
				<button class="btn btn-primary w-100 py-2" type="submit">Registrieren</button>
				<p class="mt-1 mb-3 text-body-secondary">Bereits einen Account? <a href="login.php">Hier</a> anmelden</p>
				<p class="mt-5 mb-3 text-body-secondary">&copy; 2024–<?php echo date("Y"); ?></p>
			</form>
<?php include("footer_login.php") ?>