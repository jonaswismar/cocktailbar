<?php include("header.php") ?>
<?php
	$orderid = 0;
	if(empty($_GET['view'])){
		$view = "my";
	}
	else{
		$view = $_GET['view'];
	}
	if(empty($_GET['cocktailid'])){
		$cocktailid = 0;
	}
	else{
		$cocktailid = $_GET['cocktailid'];
	}
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;">
				<div class="scrolling-wrapper-flexbox">
					<a href="cocktails.php?view=my" class="btn btn-primary text-uppercase<?php if($view == "my"){echo ' active" aria-current="page';}?>" data-toggle="tooltip" data-placement="bottom" title="Cocktails sortiert nach Verfügbarkeit in Bar">
						<i class="fa-solid fa-fw fa-martini-glass-citrus"></i> Meine Cocktails
					</a>
					<a href="cocktails.php?view=all" class="btn btn-primary text-uppercase<?php if($view == "all"){echo ' active" aria-current="page';}?>" data-toggle="tooltip" data-placement="bottom" title="Alle Cocktails">
						<i class="fa-solid fa-fw fa-martini-glass"></i> Alle Cocktails
					</a>
					<a href="cocktails.php?view=fav" class="btn btn-primary text-uppercase<?php if($view == "fav"){echo ' active" aria-current="page';}?>" data-toggle="tooltip" data-placement="bottom" title="Meine favorisierten Cocktails">
						<i class="fa-solid fa-fw fa-heart"></i> Favoriten
					</a>
				</div>
			</nav>
			<div class="list-group">
<?php
	if($view == "my"){
		$stmt_sql_cocktails = mysqli_prepare($link, $sql_my_cocktails);
	}
	else if($view == "all"){
		$stmt_sql_cocktails = mysqli_prepare($link, $sql_all_cocktails);
	}
	else if($view == "fav"){
		$stmt_sql_cocktails = mysqli_prepare($link, $sql_fav_cocktails);
		mysqli_stmt_bind_param($stmt_sql_cocktails, "i", $_SESSION["id"]);
	}
	else{
		$stmt_sql_cocktails = mysqli_prepare($link, $sql_all_cocktails);
	}
	mysqli_stmt_execute($stmt_sql_cocktails);
	include("sublist_cocktails.php")
?>
			</div>
<?php include("footer.php") ?>