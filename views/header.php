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

$current_file_name = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="de" data-bs-theme="auto">
	<head>
		<title>Cocktailbar Web App</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Cocktailbar Web App">
		<meta name="author" content="Jonas Wismar">
		<link rel="icon" type="image/x-icon" href="../favicon.ico">
		<link rel="icon" type="image/png" href="../favicon.png">
		<link rel="stylesheet" href="../assets/css/bootstrap.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-icons.min.css">
		<link rel="stylesheet" href="../assets/css/css@3.css">
		<link rel="stylesheet" href="../assets/css/fontawesome.css">
		<link rel="stylesheet" href="../assets/css/fontawesome-sharp-duotone-solid.css">
		<link rel="stylesheet" href="../assets/css/fontawesome-sharp-light.css">
		<link rel="stylesheet" href="../assets/css/fontawesome-sharp-regular.css">
		<link rel="stylesheet" href="../assets/css/fontawesome-sharp-solid.css">
		<link rel="stylesheet" href="../assets/css/fontawesome-sharp-thin.css">
		<link rel="stylesheet" href="../assets/css/iconpicker.css" />
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
		<style>
			.bd-placeholder-img {
				font-size: 1.125rem;
				text-anchor: middle;
				-webkit-user-select: none;
				-moz-user-select: none;
				user-select: none;
			}
			@media (min-width: 768px) {
				.bd-placeholder-img-lg {
					font-size: 3.5rem;
				}
			}
			.b-example-divider {
				width: 100%;
				height: 3rem;
				background-color: rgba(0, 0, 0, .1);
				border: solid rgba(0, 0, 0, .15);
				border-width: 1px 0;
				box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
			}
			.b-example-vr {
				flex-shrink: 0;
				width: 1.5rem;
				height: 100vh;
			}
			.bi {
				vertical-align: -.125em;
				fill: currentColor;
			}
			.nav-scroller {
				position: relative;
				z-index: 2;
				height: 2.75rem;
				overflow-y: hidden;
			}
			.nav-scroller .nav {
				display: flex;
				flex-wrap: nowrap;
				padding-bottom: 1rem;
				margin-top: -1px;
				overflow-x: auto;
				text-align: center;
				white-space: nowrap;
				-webkit-overflow-scrolling: touch;
			}
			.btn-bd-primary {
				--bd-blue-bg: #712cf9;
				--bd-blue-rgb: 112.520718, 44.062154, 249.437846;
				--bs-btn-font-weight: 600;
				--bs-btn-color: var(--bs-white);
				--bs-btn-bg: var(--bd-blue-bg);
				--bs-btn-border-color: var(--bd-blue-bg);
				--bs-btn-hover-color: var(--bs-white);
				--bs-btn-hover-bg: #6528e0;
				--bs-btn-hover-border-color: #6528e0;
				--bs-btn-focus-shadow-rgb: var(--bd-blue-rgb);
				--bs-btn-active-color: var(--bs-btn-hover-color);
				--bs-btn-active-bg: #5a23c8;
				--bs-btn-active-border-color: #5a23c8;
			}
			.bd-mode-toggle {
				z-index: 1500;
			}
			.bd-mode-toggle .dropdown-menu .active .bi {
				display: block !important;
			}
		</style>
	</head>
	<body>
		<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
			<symbol id="check2" viewBox="0 0 16 16">
				<path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
			</symbol>
			<symbol id="circle-half" viewBox="0 0 16 16">
				<path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
			</symbol>
			<symbol id="moon-stars-fill" viewBox="0 0 16 16">
				<path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
				<path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
			</symbol>
			<symbol id="sun-fill" viewBox="0 0 16 16">
				<path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
			</symbol>
		</svg>
				<header>
			<div class="fixed-top">
				<nav class="navbar navbar-dark bg-primary bg-gradient" aria-label="Offcanvas navbar large">
					<div class="container-fluid">
						<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						
						
						
						<div class="btn-group ms-auto">
  <a href="javascript:history.go(-1)" type="button" class="btn btn-primary dropdown-toggle navbutton" role="button">
  <i class="fa fa-fw fa-regular fa-filter"></i> Kein Filter
  </a>
</div>
						
						
						
						
						
						
						
						
						<div class="btn-group ms-auto">
  <a href="javascript:history.go(-1)" type="button" class="btn btn-primary navbutton" role="button">
  <i class="fa fa-fw fa-regular fa-left-long"></i>
  </a>
</div><div class="btn-group<?php if($_SESSION["role"] != 1){echo ' d-none invisible';}?>">
  <button type="button" class="btn btn-primary dropdown-toggle navbutton" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <i class="fa fa-fw fa-regular fa-ellipsis-stroke-vertical"></i>
  </button>
  <div class="dropdown-menu dropdown-menu-end">
    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-regular fa-lemon"></i> Neue Zutat</a>
    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-regular fa-martini-glass-citrus"></i> Neuer Cocktail</a>
    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-regular fa-filter-list"></i> Neue Kategorie</a>
    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-regular fa-cubes-stacked"></i> Neuer Zutatentyp</a>
    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-regular fa-lemon"></i> Neue Geschmacksrichtung</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Separated link</a>
  </div>
</div>
						<div class="offcanvas offcanvas-start text-bg-dark bg-primary" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
							<div class="offcanvas-header">
								<h5 class="offcanvas-title" id="offcanvasNavbar2Label"><i class="fa-duotone fa-solid fa-bars"></i> Menü</h5>
								<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<div class="offcanvas-body">
								<ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-fw <?php echo $_SESSION["image"];?>"></i> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item<?php if($current_file_name == "preferences.php"){echo ' active" aria-current="page';} ?>" href="preferences.php"><i class="fa fa-fw fa-regular fa-user-gear"></i></i> Einstellungen</a></li>
											<li><a class="dropdown-item<?php if($current_file_name == "password.php"){echo ' active" aria-current="page';} ?>" href="password.php"><i class="fa fa-fw fa-regular fa-user-lock"></i> Passwort ändern</a></li>
											<li><a class="dropdown-item" href="logout.php"><i class="fa fa-fw fa-regular fa-person-to-door"></i> Abmelden</a></li>
										</ul>
									</li>
									<li class="nav-item">
										<a class="nav-link<?php if($current_file_name == "ingredients.php"||$current_file_name == "ingredient_view.php"){echo ' active" aria-current="page';} ?>" href="ingredients.php?view=my"><i class="fa fa-fw fa-regular fa-lemon"></i> Zutaten</a>
									</li>
									<li class="nav-item">
										<a class="nav-link<?php if($current_file_name == "cocktails.php"||$current_file_name == "cocktail_view.php"){echo ' active" aria-current="page';} ?>" href="cocktails.php?view=my"><i class="fa fa-fw fa-regular fa-martini-glass-citrus"></i> Cocktails</a>
									</li>
									<li class="nav-item">
										<a class="nav-link<?php if($current_file_name == "specials.php"||$current_file_name == "special.php"){echo ' active" aria-current="page';} ?>" href="specials.php?view=rand"><i class="fa fa-fw fa-regular fa-dice-<?php $dice=array("one","two","three","four","five", "six"); echo $dice[rand(0,5)]; ?>"></i> Specials</a>
									</li>
									
									<li class="nav-item dropdown<?php if($_SESSION["role"] != 1){echo ' d-none invisible';}?>">
										<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-auto-close="false" data-bs-toggle="dropdown" aria-expanded="<?php if($current_file_name == "categorys.php"||$current_file_name == "category.php"||$current_file_name == "ingredienttypes.php"||$current_file_name == "ingredienttype.php"||$current_file_name == "tastes.php"||$current_file_name == "taste.php"){echo 'true';}else{echo 'false';} ?>"><i class="fa fa-fw fa-regular fa-hammer"></i> Admin</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item<?php if($current_file_name == "categorys.php"||$current_file_name == "category.php"){echo ' active" aria-current="page';} ?>" href="categorys.php"><i class="fa fa-fw fa-regular fa-filter-list"></i> Kategorien</a></li>
											<li><a class="dropdown-item<?php if($current_file_name == "ingredienttypes.php"||$current_file_name == "ingredienttype.php"){echo ' active" aria-current="page';} ?>" href="ingredienttypes.php"><i class="fa fa-fw fa-regular fa-cubes-stacked"></i> Zutatentypen</a></li>
											<li><a class="dropdown-item<?php if($current_file_name == "tastes.php"||$current_file_name == "taste.php"){echo ' active" aria-current="page';} ?>" href="tastes.php"><i class="fa fa-fw fa-regular fa-lemon"></i> Geschmacksrichtungen</a></li>
											<li><a class="dropdown-item<?php if($current_file_name == "debug.php"){echo ' active" aria-current="page';} ?>" href="debug.php"><i class="fa fa-fw fa-regular fa-bug"></i> Debugging</a></li>
										</ul>
									</li>
									<li class="nav-item">
										<a class="nav-link<?php if($current_file_name == "about.php"){echo ' active" aria-current="page';} ?>" href="about.php"><i class="fa fa-fw fa-regular fa-circle-question"></i> Über</a>
									</li>
								</ul>
								<form class="d-flex mt-3 mt-lg-0" role="search">
									<input class="form-control me-2" type="search" placeholder="Suchen" aria-label="Suchen">
									<button class="btn btn-secondary" type="submit">Suchen</button>
								</form>
							</div>
						</div>
					</div>
				</nav>
			</div>
				</header>
		<main>