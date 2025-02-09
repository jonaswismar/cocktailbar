<?php
require_once "../db/sql_config.php";
require_once "../db/sql_statements.php";

$username = $password = $confirm_password = $language = "";
$username_err = $password_err = $barname_err = $language_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty(trim($_POST["username"]))){
		$username_err = "Bitte Benutzername eingeben.";
	}
	elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
		$username_err = "Benutzername darf nur aus Zahlen, Buchstaben und Unterstrichen bestehen.";
	}
	else{
		if($stmt = mysqli_prepare($link, $sql_users_singleid)){
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			$param_username = trim($_POST["username"]);
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				if(mysqli_stmt_num_rows($stmt) == 1){
					$username_err = "Benutzername ist bereits vergeben.";
				}
				else{
					$username = trim($_POST["username"]);
				}
			}
			else{
				echo "Oops! Irgendetwas lief schief. Versuche es später wieder.";
			}
			mysqli_stmt_close($stmt);
		}
	}
	if(empty(trim($_POST["password"]))){
		$password_err = "Bitte Passwort eingeben.";     
	}
	elseif(strlen(trim($_POST["password"])) < 6){
		$password_err = "Passwort muss mindestens 6 Zeichen beinhalten.";
	}
	else{
		$password = trim($_POST["password"]);
	}
	if(empty(trim($_POST["confirm_password"]))){
		$confirm_password_err = "Bitte Passwort bestätigen.";     
	}
	else{
		$confirm_password = trim($_POST["confirm_password"]);
		if(empty($password_err) && ($password != $confirm_password)){
			$confirm_password_err = "Passwort nicht identisch.";
		}
	}
	if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
		if($stmtreg = mysqli_prepare($link, $sql_users_create)){
			$param_username = $username;
			$param_password = password_hash($password, PASSWORD_BCRYPT);
			$param_language = trim($_POST["language"]);
			$param_barid = trim($_POST["barname"]);
			if(empty($param_barid)){
				$param_barid = 1;
			}
			if(empty($param_language)){
				$param_language = 'de';
			}
			mysqli_stmt_bind_param($stmtreg, "ssis", $param_username, $param_password, $param_barid, $param_language);
			if(mysqli_stmt_execute($stmtreg)){
				if($stmtlogin = mysqli_prepare($link, $sql_users_single)){
					mysqli_stmt_bind_param($stmtlogin, "s", $param_username);
					$param_username = $username;
					if(mysqli_stmt_execute($stmtlogin)){
						mysqli_stmt_store_result($stmtlogin);
						if(mysqli_stmt_num_rows($stmtlogin) == 1){
							mysqli_stmt_bind_result($stmtlogin, $id, $role, $bar, $icon, $username, $ignoregarnish, $startpage, $language, $metricunits, $searchmode, $darkmode, $theme, $hashed_password);
							if(mysqli_stmt_fetch($stmtlogin)){
								if(password_verify($password, $hashed_password)){
									session_start();
									$_SESSION["loggedin"] = true;
									$_SESSION["id"] = $id;
									$_SESSION["role"] = $role;
									$_SESSION["bar"] = $bar;
									$_SESSION["icon"] = $icon;
									$_SESSION["username"] = $username;
									$_SESSION["ignoregarnish"] = $ignoregarnish;
									$_SESSION["startpage"] = $startpage;
									$_SESSION["language"] = $language;
									$_SESSION["metricunits"] = $metricunits;
									$_SESSION["searchmode"] = $searchmode;
									$_SESSION["darkmode"] = $darkmode;
									$_SESSION["theme"] = $theme;
									if($_SESSION["icon"] == "")
									{
										$stmtrole = mysqli_prepare($link, $sql_roles_icon);
										mysqli_stmt_bind_param($stmtrole, "i", $_SESSION["role"]);
										mysqli_stmt_execute($stmtrole);
										mysqli_stmt_bind_result($stmtrole, $icon);
										if(mysqli_stmt_fetch($stmtrole)){
											$_SESSION["icon"] = $icon;
										}
									}
									header("location: /views/index.php");
								}
								else{
									$login_err = "Ungültiges Passwort."; //Change
								}
							}
						}
						else{
							$login_err = "Ungültiger Benutzername."; //Change
						}
					}
					else{
						echo "Oops! Irgendetwas lief schief. Versuche es später wieder.";
					}
					mysqli_stmt_close($stmt);
				}
				mysqli_close($link);
				header("location: login.php");
			}
			else{
				echo "Oops! Irgendetwas lief schief. Versuche es später wieder.";
			}
			mysqli_stmt_close($stmtreg);
		}
	}
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
					<select type="language" name="language" class="form-select <?php echo (!empty($language_err)) ? 'is-invalid' : ''; ?>" id="floatingLangDrop" data-toggle="tooltip" data-placement="bottom" title="Sprache">
						<option value="de" selected>Deutsch</option>
						<option value="en">English</option>
						<option value="fr">Français</option>
					</select>
					<label for="floatingLangDrop">Sprache</label>
					<span class="invalid-feedback"><?php echo $language_err; ?></span>
				</div>
				<div class="form-floating">
					<select type="barname" name="barname" class="form-select <?php echo (!empty($barname_err)) ? 'is-invalid' : ''; ?>" id="floatingBarDrop" data-toggle="tooltip" data-placement="bottom" title="Standard Bar" required>
<?php
	$stmt_sql_bars = mysqli_prepare($link, $sql_bars);
	mysqli_stmt_execute($stmt_sql_bars);
	$bars_all_res=mysqli_stmt_get_result($stmt_sql_bars);
	while($bars_all_rows= mysqli_fetch_array($bars_all_res, MYSQLI_ASSOC))
	{
?>
						<option value="<?php echo $bars_all_rows['ID']; ?>"><?php echo $bars_all_rows['barname']; ?></option>
<?php }
	mysqli_stmt_close($stmt_sql_bars);
?>
					</select>
					<label for="floatingBarDrop">Standard Bar</label>
					<span class="invalid-feedback"><?php echo $barname_err; ?></span>
				</div>
				<div class="form-floating">
					<input type="username" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="floatingInput" placeholder="Benutzername" value="<?php echo $username; ?>" data-toggle="tooltip" data-placement="bottom" title="Benutzername" required>
					<label for="floatingInput">Benutzername</label>
					<span class="invalid-feedback"><?php echo $username_err; ?></span>
				</div>
				<div class="form-floating">
					<input type="password" name="password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" id="floatingPassword" placeholder="Passwort" value="<?php echo $confirm_password; ?>" style="margin-bottom: 0px;border-top-left-radius: 0;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;" data-toggle="tooltip" data-placement="bottom" title="Passwort" required>
					<label for="floatingPassword">Passwort</label>
					<span class="invalid-feedback"><?php echo $password_err; ?></span>
				</div>
				<div class="form-floating">
					<input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" id="floatingConfirmPassword" placeholder="Password" value="<?php echo $confirm_password; ?>" style="margin-bottom: 10px;border-top-left-radius: 0;border-top-right-radius: 0;border-bottom-right-radius: var(--bs-border-radius);border-bottom-left-radius: var(--bs-border-radius);" data-toggle="tooltip" data-placement="bottom" title="Passwort bestätigen" required>
					<label for="floatingConfirmPassword">Passwort bestätigen</label>
					<span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
				</div>
				<button class="btn btn-primary w-100 py-2" type="submit">Registrieren</button>
				<p class="mt-1 mb-3 text-body-secondary">Bereits einen Account? 
					<a href="login.php">Hier</a> anmelden
				</p>
				<p class="mt-5 mb-3 text-body-secondary">&copy; 2024–<?php echo date("Y"); ?></p>
			</form>
<?php include("footer_login.php") ?>