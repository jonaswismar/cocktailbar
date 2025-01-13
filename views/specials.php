<?php include("header.php") ?>
<?php
	$orderid = 0;
	if(empty($_GET['view'])){
		$view = "day";
	}
	else{
		$view = $_GET['view'];
	}
	if($view == "rand"){
		$stmt_sql_favorite = mysqli_prepare($link, $sql_my_cocktails_random);
		mysqli_stmt_execute($stmt_sql_favorite);
		$favorite_all_res=mysqli_stmt_get_result($stmt_sql_favorite);
		while($favorite_all_rows= mysqli_fetch_array($favorite_all_res, MYSQLI_ASSOC)){
			$cocktailid = $favorite_all_rows['ID'];
		}
		mysqli_stmt_close($stmt_sql_favorite);
	}
	else if($view == "day"){
		$stmt_sql_favorite = mysqli_prepare($link, $sql_my_cocktails_day);
		mysqli_stmt_execute($stmt_sql_favorite);
		$favorite_all_res=mysqli_stmt_get_result($stmt_sql_favorite);
		while($favorite_all_rows= mysqli_fetch_array($favorite_all_res, MYSQLI_ASSOC)){
			$cocktailid = $favorite_all_rows['ID'];
		}
		mysqli_stmt_close($stmt_sql_favorite);
	}
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;">
				<div class="scrolling-wrapper-flexbox">
					<a href="/views/specials.php?view=day" class="btn btn-primary text-uppercase<?php if($view == "day"){echo ' active" aria-current="page';}?>">
						<i class="fa-solid fa-calendar-days fa-fw"></i> Tagestipp
					</a>
					<a href="/views/specials.php?view=rand" class="btn btn-primary text-uppercase<?php if($view == "rand"){echo ' active" aria-current="page';}?>">
						<i class="bi bi-dice-<?php echo rand(1, 6)?> fa-fw"></i> Zufällig
					</a>
				</div>
			</nav>
<?php include("subview_cocktail.php") ?>
<?php include("footer.php") ?>