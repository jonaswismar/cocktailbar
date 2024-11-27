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
		//$password = password_hash($password, PASSWORD_BCRYPT);
	}

	if(empty($username_err) && empty($password_err)){
		if($stmt = mysqli_prepare($link, $sql_users_single)){
			mysqli_stmt_bind_param($stmt, "s", $param_username);

			$param_username = $username;

			if(mysqli_stmt_execute($stmt)){

				mysqli_stmt_store_result($stmt);

				if(mysqli_stmt_num_rows($stmt) == 1){

					mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role, $bar, $image);
					if(mysqli_stmt_fetch($stmt)){
						//echo $password;
						//echo $hashed_password;
						if(password_verify($password, $hashed_password)){
							session_start();
							$_SESSION["loggedin"] = true;
							$_SESSION["id"] = $id;
							$_SESSION["role"] = $role;
							$_SESSION["bar"] = $bar;
							$_SESSION["image"] = $image;
							$_SESSION["username"] = $username;
							if($_SESSION["image"] == "")
							{
								$stmtrole = mysqli_prepare($link, $sql_roles_image);
								mysqli_stmt_bind_param($stmtrole, "i", $_SESSION["role"]);
								mysqli_stmt_execute($stmtrole);
								mysqli_stmt_bind_result($stmtrole, $image);
								if(mysqli_stmt_fetch($stmtrole)){
									$_SESSION["image"] = $image;
								}
							}
							header("location: index.php");
						} else{
							$login_err = "Ungültiges Passwort."; //Change
						}
					}
				} else{
					$login_err = "Ungültiger Benutzername.";//Change
				}
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
				<h1 class="h3 mb-3 fw-normal">Bitte anmelden</h1>
				<?php 
					if(!empty($login_err)){
						echo '<div class="alert alert-danger">' . $login_err . '</div>';
					}
				?>
				<div class="form-floating">
					<input type="username" name="username" class="form-control" id="floatingInput" placeholder="name@example.com">
					<label for="floatingInput">Benutzername</label>
				</div>
				<div class="form-floating">
					<input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
					<label for="floatingPassword">Passwort</label>
				</div>
				<div class="form-check text-start my-3">
					<input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
					<label class="form-check-label" for="flexCheckDefault">Angemeldet bleiben</label>
				</div>
				<button class="btn btn-primary w-100 py-2" type="submit">Anmelden</button>
				<p class="mt-1 mb-3 text-body-secondary">Noch keinen Account? <a href="register.php">Hier</a> registrieren</p>
				<p class="mt-5 mb-3 text-body-secondary">&copy; 2024–<?php echo date("Y"); ?></p>
			</form>
<?php include("footer_login.php") ?>