<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: index.php");
	exit;
}

require_once "../db/sql_config.php";
require_once "../db/sql_statements.php";

$username = $password = "";
$username_err = $password_err = $login_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(empty(trim($_POST["username"]))){
		$username_err = "Please enter username.";
	} else{
		$username = trim($_POST["username"]);
	}
	if(empty(trim($_POST["password"]))){
		$password_err = "Please enter your password.";
	} else{
		$password = trim($_POST["password"]);
	}
	if(empty($username_err) && empty($password_err)){
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
						} else{
							$login_err = "Ungültiger/s Benutzername/Passwort."; //Ungültiges Passwort
						}
					}
				} else{
					$login_err = "Ungültiger/s Benutzername/Passwort."; //Ungültiger Benutzername
				}
			} else{
				echo "Oops! Irgendetwas lief schief. Versuche es später wieder.";
			}
			mysqli_stmt_close($stmtlogin);
		}
	}
	mysqli_close($link);
}
?>
<?php include("header_login.php") ?>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<div class="mb-4 d-flex justify-content-center">
					<!--<div class="logo-blurred-edge"></div>-->
					
					
					<picture>
<?php
	$currentfilepath = dirname(__DIR__, 1);
		if(file_exists($currentfilepath .'/img/logo/png700/default.png')){
		echo '							<source srcset="../img/logo/png700/default.png" type="image/png" media="(min-width: 1600px)">
';
	}
	if(file_exists($currentfilepath .'/img/logo/png512/default.png')){
		echo '							<source srcset="../img/logo/png512/default.png" type="image/png" media="(min-width: 960px)">
';
	}
	if(file_exists($currentfilepath .'/img/logo/png256/default.png')){
		echo '							<source srcset="../img/logo/png256/default.png" type="image/png">
';
	}
?>
							<img loading="lazy" src="../img/logo/png256/default.png" style="text-align: center;">
						</picture>
				</div>
				<h1 class="h3 mb-3 fw-normal">Bitte anmelden</h1>
				<?php 
					if(!empty($login_err)){
						echo '<div class="alert alert-danger">' . $login_err . '</div>';
					}
				?>
				<div class="form-floating">
					<input type="username" name="username" class="form-control" id="floatingInput" placeholder="Benutzername" data-toggle="tooltip" data-placement="bottom" title="Benutzername" required>
					<label for="floatingInput">Benutzername</label>
				</div>
				<div class="form-floating">
					<input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Passwort" data-toggle="tooltip" data-placement="bottom" title="Passwort" required>
					<label for="floatingPassword">Passwort</label>
				</div>
				<div class="form-check text-start my-3">
					<input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
					<label class="form-check-label" for="flexCheckDefault">Angemeldet bleiben</label>
				</div>
				<button class="btn btn-primary w-100 py-2" type="submit">Anmelden</button>
				<p class="mt-1 mb-3 text-body-secondary">Noch keinen Account? 
					<a href="/views/register.php">Hier</a> registrieren
				</p>
				<p class="mt-5 mb-3 text-body-secondary">&copy; 2024–<?php echo date("Y"); ?></p>
			</form>
<?php include("footer_login.php") ?>