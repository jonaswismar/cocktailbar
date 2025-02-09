<?php include("header.php") ?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;">
				<div class="scrolling-wrapper-flexbox">
					<a href="/views/search.php?search=" class="btn btn-primary text-uppercase active" aria-current="page">
						<i class="fa fa-fw fa-solid fa-search"></i> Suchergebnisse
					</a>
				</div>
			</nav>
			<div class="accordion">
				<div class="accordion-item">
<?php
try {
	$stmt_sql_cocktails = mysqli_prepare($link, $sql_search_bool_cocktail);
	if($_SESSION["searchmode"] == "2"){
		$stmt_sql_cocktails = mysqli_prepare($link, $sql_search_nat_cocktail);
	}
	mysqli_stmt_bind_param($stmt_sql_cocktails, "s", $searchstring);
	mysqli_stmt_execute($stmt_sql_cocktails);
	$cocktails_all_res=mysqli_stmt_get_result($stmt_sql_cocktails);
	
	
	if(mysqli_num_rows($cocktails_all_res) > 0){
		$expandedCocktails = true;
	}
	else{
		$expandedCocktails = false;
	}
	?>
	
	
	<h2 class="accordion-header">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCocktails" aria-expanded="<?php if($expandedCocktails == true){echo "true";}else{echo "false";}?>" aria-controls="collapseCocktails">Cocktails</button>
					</h2>
					<div id="collapseCocktails" class="accordion-collapse collapse<?php if($expandedCocktails == true){echo " show";}?>">
						<div class="accordion-body">
							<div class="list-group flex-fill">
	<?php
	while($cocktails_all_rows= mysqli_fetch_array($cocktails_all_res, MYSQLI_ASSOC)){
		$stmtingred = mysqli_prepare($link, $sql_ingredients_from_cocktail);
		mysqli_stmt_bind_param($stmtingred, "ii", $_SESSION["bar"], $cocktails_all_rows['ID']);
		mysqli_stmt_execute($stmtingred);
		$ingred_all_res=mysqli_stmt_get_result($stmtingred);
		$ingredlist = "";
		$cockavail = 1;
		$cockbuy = 1;
		$cockfav = 0;
		if(mysqli_num_rows($ingred_all_res) > 0){
			while($ingred_all_rows= mysqli_fetch_array($ingred_all_res, MYSQLI_ASSOC)){
				$ingredlist = $ingredlist . $ingred_all_rows['ingredientname'] . ", ";
				if($ingred_all_rows['available'] == 0 and $ingred_all_rows['garnish'] == 0 and $ingred_all_rows['optional'] == 0){
					$cockavail = 0;
					if($ingred_all_rows['shoppable'] == 0){
						$cockbuy = 0;
					}
				}
			}
		}
		else{
			$cockavail = 0;
			$cockbuy = 0;
		}
		$ingredlist = rtrim($ingredlist, ' ');
		$ingredlist = rtrim($ingredlist, ',');
		$favorites_stmt = mysqli_prepare($link, $sql_cocktailfavorite);
		mysqli_stmt_bind_param($favorites_stmt, "i", $_SESSION["id"]);
		mysqli_stmt_execute($favorites_stmt);
		$favorites_all_res=mysqli_stmt_get_result($favorites_stmt);
		while($favorites_all_rows= mysqli_fetch_array($favorites_all_res, MYSQLI_ASSOC)){
			if($cocktails_all_rows['ID'] == $favorites_all_rows['cocktail']){
				$cockfav = 1;
			}
		}
?>
	<a href="/views/cocktail.php?cocktailid=<?php echo $cocktails_all_rows['ID'];?>" class="<?php if($cockavail == 0){echo "bg-secondary-subtle";}else{echo "bg-primary-subtle";} ?> list-group-item list-group-item-action d-flex gap-2 py-2 d-block<?php if(isset($cocktailid)){if($cocktails_all_rows['ID'] == $cocktailid){echo ' active" aria-current="true';}}?>">
						<picture>
<?php
	$currentfilepath = dirname(__DIR__, 1);
	if(file_exists($currentfilepath .'/img/cocktails/webp128/' . $cocktails_all_rows['image'] . '.webp')){
		echo '							<source srcset="../img/cocktails/webp128/' . $cocktails_all_rows['image'] . '.webp" type="image/webp" media="(min-width: 1600px)">
';
	}
	if(file_exists($currentfilepath .'/img/cocktails/webp64/' . $cocktails_all_rows['image'] . '.webp')){
		echo '							<source srcset="../img/cocktails/webp64/' . $cocktails_all_rows['image'] . '.webp" type="image/webp" media="(min-width: 960px)">
';
	}
	if(file_exists($currentfilepath .'/img/cocktails/webp48/' . $cocktails_all_rows['image'] . '.webp')){
		echo '							<source srcset="../img/cocktails/webp48/' . $cocktails_all_rows['image'] . '.webp" type="image/webp">
';
	}
	if(file_exists($currentfilepath .'/img/cocktails/png128/' . $cocktails_all_rows['image'] . '.png')){
		echo '							<source srcset="../img/cocktails/png128/' . $cocktails_all_rows['image'] . '.png" type="image/png" media="(min-width: 1600px)">
';
	}
	if(file_exists($currentfilepath .'/img/cocktails/png64/' . $cocktails_all_rows['image'] . '.png')){
		echo '							<source srcset="../img/cocktails/png64/' . $cocktails_all_rows['image'] . '.png" type="image/png" media="(min-width: 960px)">
';
	}
	if(file_exists($currentfilepath .'/img/cocktails/png48/' . $cocktails_all_rows['image'] . '.png')){
		echo '							<source srcset="../img/cocktails/png48/' . $cocktails_all_rows['image'] . '.png" type="image/png">
';
	}
	if(file_exists($currentfilepath .'/img/glassware/webp128/' . $cocktails_all_rows['glass'] . '.webp')){
		echo '							<source srcset="../img/glassware/webp128/' . $cocktails_all_rows['glass'] . '.webp" type="image/webp" media="(min-width: 1600px)">
';
	}
	if(file_exists($currentfilepath .'/img/glassware/webp64/' . $cocktails_all_rows['glass'] . '.webp')){
		echo '							<source srcset="../img/glassware/webp64/' . $cocktails_all_rows['glass'] . '.webp" type="image/webp" media="(min-width: 960px)">
';
	}
	if(file_exists($currentfilepath .'/img/glassware/webp48/' . $cocktails_all_rows['glass'] . '.webp')){
		echo '							<source srcset="../img/glassware/webp48/' . $cocktails_all_rows['glass'] . '.webp" type="image/webp">
';
	}
	if(file_exists($currentfilepath .'/img/glassware/jpg128/' . $cocktails_all_rows['glass'] . '.jpg')){
		echo '							<source srcset="../img/glassware/jpg128/' . $cocktails_all_rows['glass'] . '.jpg" type="image/jpg" media="(min-width: 1600px)">
';
	}
	if(file_exists($currentfilepath .'/img/glassware/jpg64/' . $cocktails_all_rows['glass'] . '.jpg')){
		echo '							<source srcset="../img/glassware/jpg64/' . $cocktails_all_rows['glass'] . '.jpg" type="image/jpg" media="(min-width: 960px)">
';
	}
	if(file_exists($currentfilepath .'/img/glassware/jpg48/' . $cocktails_all_rows['glass'] . '.jp')){
		echo '							<source srcset="../img/glassware/jpg48/' . $cocktails_all_rows['glass'] . '.jpg" type="image/jpg">
';
	}
?>
							<source srcset="../img/glassware/jpg128/6.jpg" type="image/jpg" media="(min-width: 1600px)">
							<source srcset="../img/glassware/jpg64/6.jpg" type="image/jpg" media="(min-width: 960px)">
							<source srcset="../img/glassware/jpg48/6.jpg" type="image/jpg">
							<img decoding = "async" loading="lazy" src="../img/glassware/jpg48/6.jpg" alt="<?php echo $cocktails_all_rows['cocktailname'];?>" class="text-dark border border-secondary rounded-circle shadow-4-strong bg-white flex-shrink-0" style="text-align: center;">
						</picture>
						<div class="flex-grow-1 d-flex gap-2 w-75 flex-nowrap">
							<div class="d-flex-column">
								<p class="mb-0 text-size-h6"><?php echo $cocktails_all_rows['cocktailname'];?></p>
								<p class="mb-0 text-size-h5 opacity-75 text-truncate textcalcoffset">
<?php 
	if(strlen(trim($ingredlist)) > 120){
	   $ingredlist = substr($ingredlist, 0, 120);
	   $ingredlist = substr($ingredlist, 0, strripos($ingredlist, ','));
	   $ingredlist = $ingredlist . "...";
	}
	echo $ingredlist;
?></p>
							</div>
						</div>
						<i class="bi text-primary text-size-h6-2x<?php if($cockavail == 1){echo " bi-check-lg";}else if($cockbuy == 1){echo " bi-cart";} ?>"></i>
						<i class="bi text-info bi-heart-fill text-size-h6-2x<?php if($cockfav == 0){echo " d-none";} ?>"></i>
					</a>
<?php	}
	}
	catch(Exception $e)
	{
}?>
		</div>
						</div>
					</div>
				</div>
				<div class="accordion-item">
					
<?php
try {
	$stmt_sql_ingredients = mysqli_prepare($link, $sql_search_bool_ingredient);
	if($_SESSION["searchmode"] == "2"){
		$stmt_sql_ingredients = mysqli_prepare($link, $sql_search_nat_ingredient);
	}
	mysqli_stmt_bind_param($stmt_sql_ingredients, "is", $_SESSION["bar"], $searchstring);
	mysqli_stmt_execute($stmt_sql_ingredients);
	$ingred_all_res=mysqli_stmt_get_result($stmt_sql_ingredients);
	if(mysqli_num_rows($ingred_all_res) > 0){
		$expandedIngredients = true;
	}
	else{
		$expandedIngredients = false;
	}
	?>
	
	<h2 class="accordion-header">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZutaten" aria-expanded="<?php if($expandedIngredients == true){echo "true";}else{echo "false";}?>" aria-controls="collapseZutaten">Zutaten</button>
					</h2>
					<div id="collapseZutaten" class="accordion-collapse collapse<?php if($expandedIngredients == true){echo " show";}?>">
						<div class="accordion-body">
							<div class="list-group flex-fill">
	
	<?php
	mysqli_stmt_bind_param($stmt_sql_ingredients, "is", $_SESSION["bar"], $searchstring);
	mysqli_stmt_execute($stmt_sql_ingredients);
	
	
	
	$sub_ingredients_show_quantity=false;
	$sub_ingredients_show_count=true;
	include("sublist_ingredients.php");
}
catch(Exception $e)
	{
}
?>
							</div>
						</div>
					</div>
				</div>
				<div class="accordion-item">
					
	<?php 
try {
	$stmt_sql_categorys = mysqli_prepare($link, $sql_search_bool_category);
	if($_SESSION["searchmode"] == "2"){
		$stmt_sql_categorys = mysqli_prepare($link, $sql_search_nat_category);
	}
	mysqli_stmt_bind_param($stmt_sql_categorys, "s", $searchstring);
	mysqli_stmt_execute($stmt_sql_categorys);
	$categorys_all_res=mysqli_stmt_get_result($stmt_sql_categorys);
		if(mysqli_num_rows($categorys_all_res) > 0){
		$expandedCategorys = true;
	}
	else{
		$expandedCategorys = false;
	}
	?>
	<h2 class="accordion-header">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKategorie" aria-expanded="<?php if($expandedCategorys == true){echo "true";}else{echo "false";}?>" aria-controls="collapseKategorie">Kategorie</button>
					</h2>
					<div id="collapseKategorie" class="accordion-collapse collapse<?php if($expandedCategorys == true){echo " show";}?>">
						<div class="accordion-body">
							<div class="list-group flex-fill">
	
	<?php 
	while($categorys_all_rows= mysqli_fetch_array($categorys_all_res, MYSQLI_ASSOC))
	{
?>
						<a href="/views/category.php?categoryid=<?php echo $categorys_all_rows['ID'];?>" class="list-group-item list-group-item-action d-flex gap-3 py-3">
							<i class="<?php echo $categorys_all_rows['icon'];?> fa-fw"></i>
							<div class="d-flex gap-2 w-100 justify-content-between">
								<h6 class="mb-0"><?php echo $categorys_all_rows['categoryname'];?></h6>
							</div>
							<span style="width: 50px; display: block;" class="badge bg-primary rounded-pill" data-toggle="tooltip" data-placement="bottom" title="<?php echo $categorys_all_rows['cocktail_count'];?> Cocktails der Kategorie <?php echo $categorys_all_rows['categoryname'];?>"><?php echo $categorys_all_rows['cocktail_count'];?></span>
						</a>
<?php
	}
	mysqli_stmt_close($stmt_sql_categorys);
	}
	catch(Exception $e)
	{
}
?>
							</div>
						</div>
					</div>
				</div>
				<div class="accordion-item">
					
<?php 
try {
	$stmt_sql_ingredienttypes = mysqli_prepare($link, $sql_search_bool_ingredienttype);
	if($_SESSION["searchmode"] == "2"){
		$stmt_sql_ingredienttypes = mysqli_prepare($link, $sql_search_nat_ingredienttype);
	}
	mysqli_stmt_bind_param($stmt_sql_ingredienttypes, "s", $searchstring);
	mysqli_stmt_execute($stmt_sql_ingredienttypes);
	$ingredienttypes_all_res=mysqli_stmt_get_result($stmt_sql_ingredienttypes);
	
	if(mysqli_num_rows($ingredienttypes_all_res) > 0){
		$expandedIngredienttypes = true;
	}
	else{
		$expandedIngredienttypes = false;
	}
	?>
	
	<h2 class="accordion-header">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZutatentyp" aria-expanded="<?php if($expandedIngredienttypes == true){echo "true";}else{echo "false";}?>" aria-controls="collapseZutatentyp">Zutatentyp</button>
					</h2>
					<div id="collapseZutatentyp" class="accordion-collapse collapse<?php if($expandedIngredienttypes == true){echo " show";}?>">
						<div class="accordion-body">
							<div class="list-group flex-fill">
	
	<?php 
	while($ingredienttypes_all_rows= mysqli_fetch_array($ingredienttypes_all_res, MYSQLI_ASSOC))
	{
?>
					<a href="/views/ingredienttype.php?ingredienttypeid=<?php echo $ingredienttypes_all_rows['ID'];?>" class="list-group-item list-group-item-action d-flex gap-3 py-3">
						<i class="<?php echo $ingredienttypes_all_rows['icon'];?> fa-fw"></i>
						<div class="d-flex gap-2 w-100 justify-content-between">
							<h6 class="mb-0"><?php echo $ingredienttypes_all_rows['typename'];?></h6>
						</div>
						<span style="width: 50px; display: block;" class="badge bg-primary rounded-pill"><?php echo $ingredienttypes_all_rows['ingredient_count'];?></span>
					</a>
<?php
	}
	mysqli_stmt_close($stmt_sql_ingredienttypes);
	}
	catch(Exception $e)
	{
}
?>
							</div>
						</div>
					</div>
				</div>
				<div class="accordion-item">
					
<?php 
try {
	$stmt_sql_tastes = mysqli_prepare($link, $sql_search_bool_taste);
	if($_SESSION["searchmode"] == "2"){
		$stmt_sql_tastes = mysqli_prepare($link, $sql_search_nat_taste);
	}
	mysqli_stmt_bind_param($stmt_sql_tastes, "s", $searchstring);
	mysqli_stmt_execute($stmt_sql_tastes);
	$tastes_all_res=mysqli_stmt_get_result($stmt_sql_tastes);
	
	if(mysqli_num_rows($tastes_all_res) > 0){
		$expandedTastes = true;
	}
	else{
		$expandedTastes = false;
	}
	?>
	<h2 class="accordion-header">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGeschmacksrichtung" aria-expanded="<?php if($expandedTastes == true){echo "true";}else{echo "false";}?>" aria-controls="collapseGeschmacksrichtung">Geschmacksrichtung</button>
					</h2>
					<div id="collapseGeschmacksrichtung" class="accordion-collapse collapse<?php if($expandedTastes == true){echo " show";}?>">
						<div class="accordion-body">
							<div class="list-group flex-fill">
	
	<?php 
	while($tastes_all_rows= mysqli_fetch_array($tastes_all_res, MYSQLI_ASSOC))
	{
?>
					<a href="/views/taste.php?tasteid=<?php echo $tastes_all_rows['ID'];?>" class="list-group-item list-group-item-action d-flex gap-3 py-3">
						<i class="<?php echo $tastes_all_rows['icon'];?> fa-fw"></i>
						<div class="d-flex gap-2 w-100 justify-content-between">
							<h6 class="mb-0"><?php echo $tastes_all_rows['taste'];?></h6>
						</div>
						<span style="width: 50px; display: block;" class="badge bg-primary rounded-pill" data-toggle="tooltip" data-placement="bottom" title="Cocktails"><?php echo $tastes_all_rows['cocktail_count'];?></span>
						<span style="width: 50px; display: block;" class="badge bg-secondary rounded-pill" data-toggle="tooltip" data-placement="bottom" title="Zutaten"><?php echo $tastes_all_rows['ingredient_count'];?></span>
					</a>
<?php
	}
	mysqli_stmt_close($stmt_sql_tastes);
	}
	catch(Exception $e)
	{
}
?>
							</div>
						</div>
					</div>
				</div>
				<div class="accordion-item">
					
<?php 
	
try {
	$stmt_sql_units = mysqli_prepare($link, $sql_search_bool_unit);
	if($_SESSION["searchmode"] == "2"){
		$stmt_sql_units = mysqli_prepare($link, $sql_search_nat_unit);
	}
	mysqli_stmt_bind_param($stmt_sql_units, "s", $searchstring);
	mysqli_stmt_execute($stmt_sql_units);
	$units_all_res=mysqli_stmt_get_result($stmt_sql_units);
	
	if(mysqli_num_rows($units_all_res) > 0){
		$expandedUnits = true;
	}
	else{
		$expandedUnits = false;
	}
	?>
	<h2 class="accordion-header">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEinheit" aria-expanded="<?php if($expandedUnits == true){echo "true";}else{echo "false";}?>" aria-controls="collapseEinheit">Einheit</button>
					</h2>
					<div id="collapseEinheit" class="accordion-collapse collapse<?php if($expandedUnits == true){echo " show";}?>">
						<div class="accordion-body">
							<div class="list-group flex-fill">
	<?php
	while($units_all_rows= mysqli_fetch_array($units_all_res, MYSQLI_ASSOC)){
?>
						<a href="/views/unit.php?unitid=<?php echo $units_all_rows['ID'];?>" class="list-group-item list-group-item-action d-flex gap-3 py-3">
							<i class="fa-fw <?php echo $units_all_rows['icon'];?>"></i>
							<div class="d-flex gap-2 w-100 justify-content-between">
								<h6 class="mb-0"><?php echo $units_all_rows['unitname'];?></h6>
							</div>
						</a>
<?php
	}
	mysqli_stmt_close($stmt_sql_units);
	}
	catch(Exception $e)
	{
}
?>							</div>
						</div>
					</div>
				</div>
				<div class="accordion-item">
					
<?php 
	
	$stmt_sql_wikis = mysqli_prepare($link, $sql_search_bool_wiki);
	if($_SESSION["searchmode"] == "2"){
		$stmt_sql_wikis = mysqli_prepare($link, $sql_search_nat_wiki);
	}
	mysqli_stmt_bind_param($stmt_sql_wikis, "sss", $searchstring, $searchstring, $searchstring);
	mysqli_stmt_execute($stmt_sql_wikis);
	$wikis_all_res=mysqli_stmt_get_result($stmt_sql_wikis);
	
	
	if(mysqli_num_rows($wikis_all_res) > 0){
		$expandedWiki = true;
	}
	else{
		$expandedWiki = false;
	}
	
	?>
	<h2 class="accordion-header">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWiki" aria-expanded="<?php if($expandedWiki == true){echo "true";}else{echo "false";}?>" aria-controls="collapseWiki">Wiki</button>
					</h2>
					<div id="collapseWiki" class="accordion-collapse collapse<?php if($expandedWiki == true){echo " show";}?>">
						<div class="accordion-body">
							<div class="list-group flex-fill">
	<?php 
	while($wikis_all_rows= mysqli_fetch_array($wikis_all_res, MYSQLI_ASSOC)){
?>
						<a href="/views/wiki.php?wikiid=<?php echo $wikis_all_rows['ID'];?>" class="list-group-item list-group-item-action d-flex gap-3 py-3">
							<i class="fa-fw <?php echo $wikis_all_rows['icon'];?>"></i>
							<div class="d-flex gap-2 w-100 justify-content-between">
								<h6 class="mb-0"><?php echo $wikis_all_rows['wikiname'];?></h6>
							</div>
						</a>
<?php
	}
	mysqli_stmt_close($stmt_sql_wikis);
	
?>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php include("footer.php") ?>