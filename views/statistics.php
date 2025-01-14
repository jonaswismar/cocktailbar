<?php include("header.php") ?>
<?php 
	$count_cocktail = 0;
	$stmt_count_cocktail = mysqli_prepare($link, $sql_stats_count_cocktail);
	mysqli_stmt_execute($stmt_count_cocktail);
	$count_cocktail_all_res=mysqli_stmt_get_result($stmt_count_cocktail);
	while($count_cocktail_all_rows= mysqli_fetch_array($count_cocktail_all_res, MYSQLI_ASSOC)){
		$count_cocktail = $count_cocktail_all_rows['SUM'];
	}
	mysqli_stmt_close($stmt_count_cocktail);
	$count_ingredient = 0;
	$stmt_count_ingredient = mysqli_prepare($link, $sql_stats_count_ingredient);
	mysqli_stmt_execute($stmt_count_ingredient);
	$count_ingredient_all_res=mysqli_stmt_get_result($stmt_count_ingredient);
	while($count_ingredient_all_rows= mysqli_fetch_array($count_ingredient_all_res, MYSQLI_ASSOC)){
		$count_ingredient = $count_ingredient_all_rows['SUM'];
	}
	mysqli_stmt_close($stmt_count_ingredient);
	$count_category = 0;
	$stmt_count_category = mysqli_prepare($link, $sql_stats_count_category);
	mysqli_stmt_execute($stmt_count_category);
	$count_category_all_res=mysqli_stmt_get_result($stmt_count_category);
	while($count_category_all_rows= mysqli_fetch_array($count_category_all_res, MYSQLI_ASSOC)){
		$count_category = $count_category_all_rows['SUM'];
	}
	mysqli_stmt_close($stmt_count_category);
	$count_ingredienttype = 0;
	$stmt_count_ingredienttype = mysqli_prepare($link, $sql_stats_count_ingredienttype);
	mysqli_stmt_execute($stmt_count_ingredienttype);
	$count_ingredienttype_all_res=mysqli_stmt_get_result($stmt_count_ingredienttype);
	while($count_ingredienttype_all_rows= mysqli_fetch_array($count_ingredienttype_all_res, MYSQLI_ASSOC)){
		$count_ingredienttype = $count_ingredienttype_all_rows['SUM'];
	}
	mysqli_stmt_close($stmt_count_ingredienttype);
	$count_taste = 0;
	$stmt_count_taste = mysqli_prepare($link, $sql_stats_count_taste);
	mysqli_stmt_execute($stmt_count_taste);
	$count_taste_all_res=mysqli_stmt_get_result($stmt_count_taste);
	while($count_taste_all_rows= mysqli_fetch_array($count_taste_all_res, MYSQLI_ASSOC)){
		$count_taste = $count_taste_all_rows['SUM'];
	}
	mysqli_stmt_close($stmt_count_taste);
	$count_user = 0;
	$stmt_count_user = mysqli_prepare($link, $sql_stats_count_user);
	mysqli_stmt_execute($stmt_count_user);
	$count_user_all_res=mysqli_stmt_get_result($stmt_count_user);
	while($count_user_all_rows= mysqli_fetch_array($count_user_all_res, MYSQLI_ASSOC)){
		$count_user = $count_user_all_rows['SUM'];
	}
	mysqli_stmt_close($stmt_count_user);
	$count_order = 0;
	$stmt_count_order = mysqli_prepare($link, $sql_stats_count_order);
	mysqli_stmt_execute($stmt_count_order);
	$count_order_all_res=mysqli_stmt_get_result($stmt_count_order);
	while($count_order_all_rows= mysqli_fetch_array($count_order_all_res, MYSQLI_ASSOC)){
		$count_order = $count_order_all_rows['SUM'];
	}
	mysqli_stmt_close($stmt_count_order);
?><nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;">
				<div class="scrolling-wrapper-flexbox">
					<a href="/views/statistics.php" class="btn btn-primary text-uppercase active" aria-current="page">
						<i class="fa fa-fw fa-solid fa-chart-simple"></i> Allgemein
					</a>
				</div>
			</nav>
			<style>
				.container {
					margin-top: 100px
				}
				.counter-box {
					display: block;
					background: #f6f6f6;
					padding: 40px 20px 37px;
					text-align: center
				}
				.counter-box p {
					margin: 5px 0 0;
					padding: 0;
					color: #909090;
					font-size: 18px;
					font-weight: 500
				}
				.counter-box i {
					font-size: 60px;
					margin: 0 0 15px;
					color: #d2d2d2
				}
				.counter {
					display: block;
					font-size: 32px;
					font-weight: 700;
					color: #666;
					line-height: 28px
				}
				.counter-box.colored {
					background: #3acf87
				}
				.counter-box.colored p,
				.counter-box.colored i,
				.counter-box.colored .counter {
					color: #fff
				}
			</style>
			<div class="container">
				<div class="p-2 row">
					<div class="four col-md-3">
						<div class="counter-box"> <i class="fa fa-fw fa-regular fa-martini-glass-citrus"></i> <span class="counter"><?php echo $count_cocktail;?></span>
							<p>Cocktails</p>
						</div>
					</div>
					<div class="four col-md-3">
						<div class="counter-box"> <i class="fa fa-fw fa-regular fa-lemon"></i> <span class="counter"><?php echo $count_ingredient;?></span>
							<p>Zutaten</p>
						</div>
					</div>
					<div class="four col-md-3">
						<div class="counter-box"> <i class="fa fa-fw fa-regular fa-filter-list"></i> <span class="counter"><?php echo $count_category;?></span>
							<p>Kategorien</p>
						</div>
					</div>
					<div class="four col-md-3">
						<div class="counter-box"> <i class="fa fa-fw fa-regular fa-cubes-stacked"></i> <span class="counter"><?php echo $count_ingredienttype;?></span>
							<p>Zutatentypen</p>
						</div>
					</div>
				</div>
				<div class="p-2 row">
					<div class="four col-md-3">
						<div class="counter-box"> <i class="fa fa-fw fa-regular fa-lemon"></i> <span class="counter"><?php echo $count_taste;?></span>
							<p>Geschmacksrichtungen</p>
						</div>
					</div>
					<div class="four col-md-3">
						<div class="counter-box"> <i class="fa fa-fw fa-regular fa-users"></i> <span class="counter"><?php echo $count_user;?></span>
							<p>Benutzer</p>
						</div>
					</div>
					<div class="four col-md-3">
						<div class="counter-box"> <i class="fa fa-fw fa-regular fa-bags-shopping"></i> <span class="counter"><?php echo $count_order;?></span>
							<p>Bestellungen</p>
						</div>
					</div>
				</div>
			</div>
<?php include("footer.php") ?>