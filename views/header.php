<?php
	if(!isset($_SESSION)){
		session_start(); 
	}
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
	require_once "../cfg/config.php";
	require_once "../db/sql_config.php";
	require_once "../db/sql_statements.php";
	$current_file_name = basename($_SERVER['PHP_SELF']);
	$searchstring = "";
	if(isset($_POST['search'])){
		$searchstring =  $_POST['search'];
	}
	if(isset($_GET['search'])){
		$searchstring =  $_GET['search'];
	}
?>
<!DOCTYPE html>
<html lang="de" data-bs-theme="<?php echo $_SESSION["darkmode"]; ?>">
	<head>
		<title>Cocktailbar Web App</title>
		<meta charset="utf-8">
		<meta name="csrf_token" content="<?php echo createToken(); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Cocktailbar Web App">
		<meta name="author" content="Jonas Wismar">
		<link rel="icon" type="image/x-icon" href="../favicon.ico">
		<link rel="icon" type="image/png" href="../favicon.png">
<?php 
	$themeurl = "";
	if($_SESSION["theme"] == "cerulean"){
		$themeurl = "themes/cerulean/";
	}
	else if($_SESSION["theme"] == "cosmo"){
		$themeurl = "themes/cosmo/";
	}
	else if($_SESSION["theme"] == "cyborg"){
		$themeurl = "themes/cyborg/";
	}
	else if($_SESSION["theme"] == "darkly"){
		$themeurl = "themes/darkly/";
	}
	else if($_SESSION["theme"] == "flatly"){
		$themeurl = "themes/flatly/";
	}
	else if($_SESSION["theme"] == "journal"){
		$themeurl = "themes/journal/";
	}
	else if($_SESSION["theme"] == "litera"){
		$themeurl = "themes/litera/";
	}
	else if($_SESSION["theme"] == "lumen"){
		$themeurl = "themes/lumen/";
	}
	else if($_SESSION["theme"] == "lux"){
		$themeurl = "themes/lux/";
	}
	else if($_SESSION["theme"] == "materia"){
		$themeurl = "themes/materia/";
	}
	else if($_SESSION["theme"] == "minty"){
		$themeurl = "themes/minty/";
	}
	else if($_SESSION["theme"] == "morph"){
		$themeurl = "themes/morph/";
	}
	else if($_SESSION["theme"] == "pulse"){
		$themeurl = "themes/pulse/";
	}
	else if($_SESSION["theme"] == "quartz"){
		$themeurl = "themes/quartz/";
	}
	else if($_SESSION["theme"] == "sandstone"){
		$themeurl = "themes/sandstone/";
	}
	else if($_SESSION["theme"] == "simplex"){
		$themeurl = "themes/simplex/";
	}
	else if($_SESSION["theme"] == "sketchy"){
		$themeurl = "themes/sketchy/";
	}
	else if($_SESSION["theme"] == "slate"){
		$themeurl = "themes/slate/";
	}
	else if($_SESSION["theme"] == "solar"){
		$themeurl = "themes/solar/";
	}
	else if($_SESSION["theme"] == "spacelab"){
		$themeurl = "themes/spacelab/";
	}
	else if($_SESSION["theme"] == "superhero"){
		$themeurl = "themes/superhero/";
	}
	else if($_SESSION["theme"] == "united"){
		$themeurl = "themes/united/";
	}
	else if($_SESSION["theme"] == "vapor"){
		$themeurl = "themes/vapor/";
	}
	else if($_SESSION["theme"] == "yeti"){
		$themeurl = "themes/yeti/";
	}
	else if($_SESSION["theme"] == "zephyr"){
		$themeurl = "themes/zephyr/";
	}
	echo "		<link rel=\"stylesheet\" href=\"../assets/css/" . $themeurl . "bootstrap.css\">";
?>

		<link rel="stylesheet" href="../assets/css/bootstrap-icons.min.css">
		<link rel="stylesheet" href="../assets/css/css@3.css">
		<link rel="stylesheet" href="../assets/css/fontawesome.css">
		<link rel="stylesheet" href="../assets/css/fontawesome-sharp-duotone-solid.css">
		<link rel="stylesheet" href="../assets/css/fontawesome-sharp-light.css">
		<link rel="stylesheet" href="../assets/css/fontawesome-sharp-regular.css">
		<link rel="stylesheet" href="../assets/css/fontawesome-sharp-solid.css">
		<link rel="stylesheet" href="../assets/css/fontawesome-sharp-thin.css">
		<link rel="stylesheet" href="../assets/css/navbars-offcanvas.css" />
		<link rel="stylesheet" href="../assets/css/tom-select.bootstrap5.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
		<style>
			.navbutton {
				padding-top: 0.25rem;
				padding-left: 0.75rem;
				font-size: 1.25rem;
				border-color: rgba(0, 0, 0, 0.15);
				border-radius: 0.375rem;
			}
		</style>
		<style>
			div.cocktailrating-wrapper-my i {
				cursor: pointer;
			}
			@media (min-width: 1600px) {
				.text-size-h5 {
					font-size: 2rem;
				}
				.text-size-h6 {
					font-size: 3rem;
				}
				.text-size-h6-2x {
					font-size: 5rem;
				}
				div.cocktailrating-wrapper-all, div.ingredientrating-wrapper-all {
					font-size: 3rem;
				}
				div.cocktailrating-wrapper-my, div.ingredientrating-wrapper-my {
					font-size: 3rem;
				}
			}
			@media (min-width: 960px) and (max-width: 1600px) {
				.text-size-h5 {
					font-size: 1.2rem;
				}
				.text-size-h6 {
					font-size: 1.8rem;
				}
				.text-size-h6-2x {
					font-size: 2.8rem;
				}
				div.cocktailrating-wrapper-all, div.ingredientrating-wrapper-all {
					font-size: 2rem;
				}
				div.cocktailrating-wrapper-my, div.ingredientrating-wrapper-my {
					font-size: 2rem;
				}
			}
			@media (max-width: 960px) {
				.text-size-h5 {
					font-size: 0.8em;
				}
				.text-size-h6 {
					font-size: 1em;
				}
				.text-size-h6-2x {
					font-size: 2em;
				}
				div.cocktailrating-wrapper-all, div.ingredientrating-wrapper-all {
					font-size: 1.5rem;
				}
				div.cocktailrating-wrapper-my, div.ingredientrating-wrapper-my {
					font-size: 1.5rem;
				}
			}
			.scrolling-wrapper-flexbox {
				-webkit-overflow-scrolling: touch;
				display: flex;
				flex-wrap: nowrap;
				overflow-x: auto;
				.btn {
					flex: 0 0 auto;
				}
			}
		</style>
		<style>
			body {
				font-family: Roboto;
			}
			.navcalcoffset{
				height: calc(100vh - 105px);
			}
			.navcalcoffsetinner{
				height: calc(navcalcoffset - 30px);
			}
			.textcalcoffset{
				max-width: calc(100vw - 100px);
			}
			.text-overflow-ellipsis{
				overflow: hidden
				text-overflow: ellipsis;
			}
			.main{
				padding-top: 18px;
				margin: 0 auto;
			}
		</style>
	</head>
	<body>
		<header>
			<div class="fixed-top">
				<nav class="navbar navbar-dark bg-primary bg-gradient" aria-label="Offcanvas navbar large">
					<div class="container-fluid">
						<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Menü ein/ausblenden" data-toggle="tooltip" data-placement="bottom" title="Menü ein/ausblenden">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="ms-auto">
							<form class="btn-group" action="/views/search.php">
								<input type="text" id="search" class="form-control" placeholder="Suchen.."<?php if(!empty($searchstring)){ echo ' value="' . $searchstring . '"';} ?> name="search">
								<button type="submit" class="btn btn-primary">
									<div class="row">
									<i class="fa fa-fw fa-regular fa-search"></i>
									<i class="fa fa-fw fa-regular <?php if($_SESSION["searchmode"] == 2){ echo 'fa-comment';}else{echo 'fa-object-intersect';} ?>"></i>
									</div>
								</button>
							</form>
						</div>
						<div class="btn-group ms-auto">
							<a href="javascript:history.go(-1)" type="button" class="btn btn-primary navbutton" role="button" data-toggle="tooltip" data-placement="bottom" title="Springt eine Seite zurück">
								<i class="fa fa-fw fa-regular fa-left-long"></i>
							</a>
						</div>
						<div class="offcanvas offcanvas-start text-bg-dark bg-primary" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
							<div class="offcanvas-header">
								<h5 class="offcanvas-title" id="offcanvasNavbar2Label"><i class="fa-duotone fa-solid fa-bars"></i> Menü</h5>
								<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="Menü schliessen"></button>
							</div>
							<div class="offcanvas-body">
								<ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="<?php if($current_file_name == "userprefs.php"||$current_file_name == "orders.php"||$current_file_name == "order.php"){echo 'true';}else{echo 'false';} ?>" data-toggle="tooltip" data-placement="bottom" title="Benutzer spezifische Aktionen"><i class="fa fa-fw <?php echo $_SESSION["icon"];?>"></i> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
										<ul class="dropdown-menu">
											<li>
												<a class="dropdown-item<?php if($current_file_name == "userprefs.php"){echo ' active" aria-current="page';} ?>" href="/views/userprefs.php" data-toggle="tooltip" data-placement="bottom" title="Ändere deine App Einstellungen">
													<i class="fa fa-fw fa-regular fa-user-gear"></i> Einstellungen
												</a>
											</li>
											<li>
												<a class="dropdown-item<?php if($current_file_name == "password.php"){echo ' active" aria-current="page';} ?>" href="/views/password.php" data-toggle="tooltip" data-placement="bottom" title="Ändere dein Passwort">
													<i class="fa fa-fw fa-regular fa-user-lock"></i> Passwort ändern
												</a>
											</li>
											<li>
												<a class="dropdown-item<?php if($current_file_name == "orders.php"||$current_file_name == "order.php"){echo ' active" aria-current="page';} ?>" href="/views/orders.php" data-toggle="tooltip" data-placement="bottom" title="Blättere durch deine Bestellungen">
													<i class="fa fa-fw fa-regular fa-bag-shopping"></i> Bestellungen
												</a>
											</li>
											<li>
												<a class="dropdown-item" href="/views/logout.php" data-toggle="tooltip" data-placement="bottom" title="Abmelden aus der App">
													<i class="fa fa-fw fa-regular fa-person-to-door"></i> Abmelden
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-item">
										<a class="nav-link<?php if($current_file_name == "cocktails.php"||$current_file_name == "cocktail.php"){echo ' active" aria-current="page';} ?>" href="/views/cocktails.php?view=my" data-toggle="tooltip" data-placement="bottom" title="Blättere durch die Cocktails">
											<i class="fa fa-fw fa-regular fa-martini-glass-citrus"></i> Cocktails
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link<?php if($current_file_name == "ingredients.php"||$current_file_name == "ingredient.php"){echo ' active" aria-current="page';} ?>" href="/views/ingredients.php?view=my" data-toggle="tooltip" data-placement="bottom" title="Blättere durch die Zutaten">
											<i class="fa fa-fw fa-regular fa-lemon"></i> Zutaten
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link<?php if($current_file_name == "specials.php"){echo ' active" aria-current="page';} ?>" href="/views/specials.php?view=day" data-toggle="tooltip" data-placement="bottom" title="Blättere durch Tagestipp und andere Specials">
											<i class="fa fa-fw fa-regular fa-dice-<?php $dice=array("one","two","three","four","five", "six"); echo $dice[rand(0,5)]; ?>"></i> Specials
										</a>
									</li>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-auto-close="false" data-bs-toggle="dropdown" aria-expanded="<?php if($current_file_name == "categorys.php"||$current_file_name == "category.php"||$current_file_name == "ingredienttypes.php"||$current_file_name == "ingredienttype.php"||$current_file_name == "tastes.php"||$current_file_name == "taste.php"){echo 'true';}else{echo 'false';} ?>" data-toggle="tooltip" data-placement="bottom" title="Blättere durch Sonstige Kategorien">
											<i class="fa fa-fw fa-regular fa-list"></i> Sonstiges
										</a>
										<ul class="dropdown-menu">
											<li>
												<a class="dropdown-item<?php if($current_file_name == "categorys.php"||$current_file_name == "category.php"){echo ' active" aria-current="page';} ?>" href="/views/categorys.php" data-toggle="tooltip" data-placement="bottom" title="Blättere durch Cocktail Kategorien">
													<i class="fa fa-fw fa-regular fa-filter-list"></i> Kategorien
												</a>
											</li>
											<li>
												<a class="dropdown-item<?php if($current_file_name == "ingredienttypes.php"||$current_file_name == "ingredienttype.php"){echo ' active" aria-current="page';} ?>" href="/views/ingredienttypes.php" data-toggle="tooltip" data-placement="bottom" title="Blättere durch Zutatentypen">
													<i class="fa fa-fw fa-regular fa-cubes-stacked"></i> Zutatentypen
												</a>
											</li>
											<li>
												<a class="dropdown-item<?php if($current_file_name == "tastes.php"||$current_file_name == "taste.php"){echo ' active" aria-current="page';} ?>" href="/views/tastes.php" data-toggle="tooltip" data-placement="bottom" title="Blättere durch Geschmacksrichtungen">
													<i class="fa fa-fw fa-regular fa-lemon"></i> Geschmacksrichtungen
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-item dropdown<?php if($_SESSION["role"] != 1 && $_SESSION["role"] != 2){echo ' d-none invisible';}?>">
										<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-auto-close="false" data-bs-toggle="dropdown" aria-expanded="<?php if($current_file_name == "debug.php"||$current_file_name == "bars.php"||$current_file_name == "bar.php"||$current_file_name == "units.php"||$current_file_name == "unit.php"||$current_file_name == "users.php"||$current_file_name == "user.php"){echo 'true';}else{echo 'false';} ?>" data-toggle="tooltip" data-placement="bottom" title="Adminbereich der App">
											<i class="fa fa-fw fa-regular fa-hammer"></i> <?php if($_SESSION["role"] == 1){echo 'Admin';}else{echo 'Barkeeper';}?>
										</a>
										<ul class="dropdown-menu">
											<li>
												<a class="dropdown-item<?php if($current_file_name == "bars.php"||$current_file_name == "bar.php"){echo ' active" aria-current="page';} ?>" href="/views/bars.php" data-toggle="tooltip" data-placement="bottom" title="Blättere durch Bars">
													<i class="fa fa-fw fa-regular fa-map-location-dot"></i> Bars
												</a>
											</li>
											<li>
												<a class="dropdown-item<?php if($current_file_name == "users.php"||$current_file_name == "user.php"){echo ' active" aria-current="page';} ?>" href="/views/users.php" data-toggle="tooltip" data-placement="bottom" title="Benutzerverwaltung">
													<i class="fa fa-fw fa-regular fa-users"></i> Benutzer
												</a>
											</li>
											<li class="nav-item dropdown<?php if($_SESSION["role"] != 1){echo ' d-none invisible';}?>">
												<a class="dropdown-item<?php if($current_file_name == "units.php"||$current_file_name == "unit.php"){echo ' active" aria-current="page';} ?>" href="/views/units.php" data-toggle="tooltip" data-placement="bottom" title="Blättere durch Maß-Einheiten">
													<i class="fa fa-fw fa-regular fa-ruler"></i> Einheiten
												</a>
											</li>
											<li class="nav-item dropdown<?php if($_SESSION["role"] != 1){echo ' d-none invisible';}?>">
												<a class="dropdown-item<?php if($current_file_name == "tools.php"||$current_file_name == "tool.php"){echo ' active" aria-current="page';} ?>" href="/views/tools.php" data-toggle="tooltip" data-placement="bottom" title="Blättere durch Bar Werkzeuge">
													<i class="fa fa-fw fa-regular fa-screwdriver-wrench"></i> Werkzeuge
												</a>
											</li>
											<li class="nav-item dropdown<?php if($_SESSION["role"] != 1){echo ' d-none invisible';}?>">
												<a class="dropdown-item<?php if($current_file_name == "debug.php"){echo ' active" aria-current="page';} ?>" href="/views/debug.php" data-toggle="tooltip" data-placement="bottom" title="Debugmenü">
													<i class="fa fa-fw fa-regular fa-bug"></i> Debugging
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-item">
										<a class="nav-link<?php if($current_file_name == "wikis.php"||$current_file_name == "wiki.php"){echo ' active" aria-current="page';} ?>" href="/views/wikis.php" data-toggle="tooltip" data-placement="bottom" title="Blättere durch das Wiki der App">
											<i class="fa fa-fw fa-brands fa-wikipedia-w"></i> Wiki
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link<?php if($current_file_name == "statistics.php"){echo ' active" aria-current="page';} ?>" href="/views/statistics.php" data-toggle="tooltip" data-placement="bottom" title="Blättere durch Statistiken der App">
											<i class="fa fa-fw fa-regular fa-chart-simple"></i> Statistiken
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link<?php if($current_file_name == "about.php"){echo ' active" aria-current="page';} ?>" href="/views/about.php" data-toggle="tooltip" data-placement="bottom" title="Blättere durch Infos über die App">
											<i class="fa fa-fw fa-regular fa-circle-question"></i> Über
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</nav>
			</div>
		</header>
		<main>
