<?php include("header.php") ?>
<?php 
	$id = "";
	$ingredientname = "";
	$available = "";
	$shoppable = "";
	$description = "";
	$image = "";
	$type = "";
	$favorite = 0;
	if(empty($_GET['ingredientid'])){
		$ingredientid = 0;
	}
	else{
		$ingredientid = $_GET['ingredientid'];
	}
	$stmt_sql_ingredient = mysqli_prepare($link, $sql_ingredient);
	mysqli_stmt_bind_param($stmt_sql_ingredient, "ii", $_SESSION["bar"], $ingredientid);
	mysqli_stmt_execute($stmt_sql_ingredient);
	$ingredient_all_res=mysqli_stmt_get_result($stmt_sql_ingredient);
	while($ingredient_all_rows= mysqli_fetch_array($ingredient_all_res, MYSQLI_ASSOC)){
		$id = $ingredient_all_rows['ingredient_ID'];
		$ingredientname = $ingredient_all_rows['ingredientname'];
		$available = $ingredient_all_rows['available'];
		$shoppable = $ingredient_all_rows['shoppable'];
		$description = $ingredient_all_rows['description'];
		$image = $ingredient_all_rows['image'];
		$type = $ingredient_all_rows['type'];
	}
	mysqli_stmt_close($stmt_sql_ingredient);
	$stmt_sql_favorite = mysqli_prepare($link, $sql_favorite_ingredient);
	mysqli_stmt_bind_param($stmt_sql_favorite, "ii", $_SESSION["id"], $id);
	mysqli_stmt_execute($stmt_sql_favorite);
	$favorite_all_res=mysqli_stmt_get_result($stmt_sql_favorite);
	while($favorite_all_rows= mysqli_fetch_array($favorite_all_res, MYSQLI_ASSOC)){
		$favorite = 1;
	}
	mysqli_stmt_close($stmt_sql_favorite);
	$countfavorites = 0;
	$countratings = 0;
	$countingredients = 0;
	$stmt_sql_favorite = mysqli_prepare($link, $sql_count_all_ingredientfavorite);
	mysqli_stmt_bind_param($stmt_sql_favorite, "i", $id);
	mysqli_stmt_execute($stmt_sql_favorite);
	$favorite_all_res=mysqli_stmt_get_result($stmt_sql_favorite);
	while($favorite_all_rows= mysqli_fetch_array($favorite_all_res, MYSQLI_ASSOC)){
		$countfavorites = $countfavorites + 1;
	}
	mysqli_stmt_close($stmt_sql_favorite);
	$stmt_sql_favorite = mysqli_prepare($link, $sql_count_all_ingredientrating);
	mysqli_stmt_bind_param($stmt_sql_favorite, "i", $id);
	mysqli_stmt_execute($stmt_sql_favorite);
	$favorite_all_res=mysqli_stmt_get_result($stmt_sql_favorite);
	while($favorite_all_rows= mysqli_fetch_array($favorite_all_res, MYSQLI_ASSOC)){
		$countratings = $countratings + 1;
	}
	mysqli_stmt_close($stmt_sql_favorite);
	$stmt_ingredientcount_usedin = mysqli_prepare($link, $sql_ingredientcount_usedin);
	mysqli_stmt_bind_param($stmt_ingredientcount_usedin, "i", $id);
	mysqli_stmt_execute($stmt_ingredientcount_usedin);
	$ingredientcount_usedin_all_res=mysqli_stmt_get_result($stmt_ingredientcount_usedin);
	$ingredientcount_usedin_all_rows= mysqli_fetch_assoc($ingredientcount_usedin_all_res);
	if (mysqli_num_rows($ingredientcount_usedin_all_res) == 1){
		$countingredients = $ingredientcount_usedin_all_rows['total'];
	}
	mysqli_stmt_close($stmt_ingredientcount_usedin);
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
				<div class="container-fluid justify-content-start">
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#newDialogIngredient" data-toggle="tooltip" data-placement="bottom" title="Neu">
						<i class="fa-duotone fa-solid fa-file fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#editDialogIngredient" data-toggle="tooltip" data-placement="bottom" title="Bearbeiten">
						<i class="fa-duotone fa-solid fa-pencil fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#deleteDialogIngredient" data-toggle="tooltip" data-placement="bottom" title="Löschen">
						<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
					</button>
				</div>
			</nav>
			<div class="modal fade" id="newDialogIngredient">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="ingredient_edit" action="/api/ingredient_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><strong>Neue Zutat anlegen</strong></h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="ingredientid" class="form-control" type="hidden" value="0" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="ingredientname" class="form-control form-control-lg" type="text" placeholder="Name der Zutat" data-toggle="tooltip" data-placement="bottom" title="Name der Zutat">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="ingredientimage" class="form-control form-control-lg" type="text" placeholder="Bildname der Zutat" data-toggle="tooltip" data-placement="bottom" title="Bildname der Zutat">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<select id="input-tags-ingredienttype-new" name="ingredienttype[]" multiple autocomplete="off" class="form-control w-100" data-toggle="tooltip" data-placement="bottom" title="Zutatentyp">
<?php 
	$stmt_sql_ingredienttypes = mysqli_prepare($link, $sql_ingredienttypes);
	mysqli_stmt_execute($stmt_sql_ingredienttypes);
	$ingredienttypes_all_res=mysqli_stmt_get_result($stmt_sql_ingredienttypes);
	while($ingredienttypes_all_rows= mysqli_fetch_array($ingredienttypes_all_res, MYSQLI_ASSOC)){
		$typeid = $ingredienttypes_all_rows['ID'];
		$typename = $ingredienttypes_all_rows['typename'];
		$typeicon = $ingredienttypes_all_rows['icon'];
?>
											<option value="<?php echo $typeid;?>" data-src="<?php echo $typeicon;?>"><?php echo $typename;?></option>
<?php 
	}
	mysqli_stmt_close($stmt_sql_ingredienttypes);
?>
										</select>
									</div>
									<div class="d-flex gap-3 p-3 flex-row justify-content-center">
										<select id="input-tags-ingredienttaste-new" name="ingredienttaste[]" autocomplete="off" multiple class="form-control w-100" data-toggle="tooltip" data-placement="bottom" title="Geschmacksrichtung">
<?php 
	$stmt_sql_tastes = mysqli_prepare($link, $sql_tastes);
	mysqli_stmt_execute($stmt_sql_tastes);
	$tastes_all_res=mysqli_stmt_get_result($stmt_sql_tastes);
	while($tastes_all_rows= mysqli_fetch_array($tastes_all_res, MYSQLI_ASSOC)){
		$tasteid = $tastes_all_rows['ID'];
		$tastename = $tastes_all_rows['taste'];
		$tasteicon = $tastes_all_rows['icon'];
?>
											<option value="<?php echo $tasteid . ",";?>" data-src="<?php echo $tasteicon;?>"><?php echo $tastename;?></option>
<?php
	}
	mysqli_stmt_close($stmt_sql_tastes);
?>
										</select>
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<textarea name="description" class="form-control auto-resize" type="text" placeholder="Beschreibung der Zutat" rows="25" data-toggle="tooltip" data-placement="bottom" title="Beschreibung der Zutat"></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<input class="btn btn-primary" type="submit" name="save" value="Speichern">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			<div class="modal fade" id="editDialogIngredient">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="ingredient_edit" action="/api/ingredient_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title">
										<picture>
<?php
	$currentfilepath = dirname(__DIR__, 1);
	if(file_exists($currentfilepath .'/img/ingredients/webp48/' . $image . '.webp')){
		echo '											<source srcset="../img/ingredients/webp48/' . $image . '.webp" type="image/webp">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png48/' . $image . '.png')){
		echo '											<source srcset="../img/ingredients/png48/' . $image . '.png" type="image/png">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png48/unbekannt.png')){
		echo '											<source srcset="../img/ingredients/png48/unbekannt.png" type="image/png">
';
	}
?>
											<img loading="lazy" src="../img/ingredients/png48/unbekannt.png" alt="<?php echo $ingredientname;?>" class="border border-secondary text-dark rounded-circle bg-white flex-shrink-0" style="text-align: center;">
										</picture>
										<strong><?php echo $ingredientname;?></strong> bearbeiten
									</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="ingredientid" class="form-control" type="hidden" value="<?php echo $id;?>" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="ingredientname" class="form-control form-control-lg" type="text" placeholder="Name der Zutat" data-toggle="tooltip" data-placement="bottom" title="Name der Zutat" value="<?php echo $ingredientname;?>">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="ingredientimage" class="form-control form-control-lg" type="text" placeholder="Bildname der Zutat" data-toggle="tooltip" data-placement="bottom" title="Bildname der Zutat"value="<?php echo $image;?>">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<select id="input-tags-ingredienttype-edit" name="ingredienttype[]" multiple autocomplete="off" class="form-control w-100" data-toggle="tooltip" data-placement="bottom" title="Zutatentyp">
<?php 
	$stmt_sql_ingredienttypes = mysqli_prepare($link, $sql_ingredienttypes);
	mysqli_stmt_execute($stmt_sql_ingredienttypes);
	$ingredienttypes_all_res=mysqli_stmt_get_result($stmt_sql_ingredienttypes);
	while($ingredienttypes_all_rows= mysqli_fetch_array($ingredienttypes_all_res, MYSQLI_ASSOC)){
		$typeid = $ingredienttypes_all_rows['ID'];
		$typename = $ingredienttypes_all_rows['typename'];
		$typeicon = $ingredienttypes_all_rows['icon'];
?>
											<option value="<?php echo $typeid;?>" data-src="<?php echo $typeicon;?>"<?php if($typeid == $type){echo ' selected';}?>><?php echo $typename;?></option>
<?php 
	}
	mysqli_stmt_close($stmt_sql_ingredienttypes);
?>
										</select>
									</div>
									<div class="d-flex gap-3 p-3 flex-row justify-content-center">
										<select id="input-tags-ingredienttaste-edit" name="ingredienttaste[]" autocomplete="off" multiple class="form-control w-100" data-toggle="tooltip" data-placement="bottom" title="Geschmacksrichtung">
<?php 
	$stmt_sql_tastes = mysqli_prepare($link, $sql_tastes);
	mysqli_stmt_execute($stmt_sql_tastes);
	$tastes_all_res=mysqli_stmt_get_result($stmt_sql_tastes);
	while($tastes_all_rows= mysqli_fetch_array($tastes_all_res, MYSQLI_ASSOC)){
		$tasteid = $tastes_all_rows['ID'];
		$tastename = $tastes_all_rows['taste'];
		$tasteicon = $tastes_all_rows['icon'];
		$stmt_sql_ingredienttastelist = mysqli_prepare($link, $sql_ingredienttastelist);
		mysqli_stmt_bind_param($stmt_sql_ingredienttastelist, "ii", $id, $tasteid);
		mysqli_stmt_execute($stmt_sql_ingredienttastelist);
		$ingredienttastelist_all_res=mysqli_stmt_get_result($stmt_sql_ingredienttastelist);
		$ingredienttastes = 0;
		while($ingredienttastelist_all_rows= mysqli_fetch_array($ingredienttastelist_all_res, MYSQLI_ASSOC)){
			$ingredienttastes = 1;
		}
		mysqli_stmt_close($stmt_sql_ingredienttastelist);
?>
											<option value="<?php echo $tasteid . ",";?>" data-src="<?php echo $tasteicon;?>"<?php if($ingredienttastes == 1){echo ' selected';}?>><?php echo $tastename;?></option>
<?php
	}
	mysqli_stmt_close($stmt_sql_tastes);
?>
										</select>
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<textarea name="description" class="form-control auto-resize" type="text" placeholder="Beschreibung der Zutat" rows="25" data-toggle="tooltip" data-placement="bottom" title="Beschreibung der Zutat"><?php echo $description;?></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<input class="btn btn-primary" type="submit" name="save" value="Speichern">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			<div class="modal fade" id="deleteDialogIngredient">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">
								<picture>
<?php
	$currentfilepath = dirname(__DIR__, 1);
	if(file_exists($currentfilepath .'/img/ingredients/webp48/' . $image . '.webp')){
		echo '									<source srcset="../img/ingredients/webp48/' . $image . '.webp" type="image/webp">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png48/' . $image . '.png')){
		echo '									<source srcset="../img/ingredients/png48/' . $image . '.png" type="image/png">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png48/unbekannt.png')){
		echo '									<source srcset="../img/ingredients/png48/unbekannt.png" type="image/png">
';
	}
?>
									<img loading="lazy" src="../img/ingredients/png48/unbekannt.png" alt="<?php echo $ingredientname;?>" class="border border-secondary text-dark rounded-circle bg-white flex-shrink-0" style="text-align: center;">
								</picture>
								<strong> <?php echo $ingredientname;?></strong> löschen?
							</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						</div>
						<div class="modal-body">
							<p>Möchten Sie die Zutat <strong><?php echo $ingredientname;?></strong> wirklich löschen?</p>
							<p>Sie wird in <strong><?php echo $countingredients;?></strong> Cocktails verwendet.</p>
							<p>Sie verfügt außerdem über <strong><?php echo $countratings;?></strong> Bewertungen, sowie <strong><?php echo $countfavorites;?></strong> Favoriten.</p>
							<p>Wenn Sie <strong><?php echo $ingredientname;?></strong> löschen, werden diese (einschließlich Cocktails) ebenfalls gelöscht! Diese Aktion kann nicht rückgängig gemacht werden!</p>
						</div>
						<div class="modal-footer">
							<a href="/api/ingredient_delete.php?ingredientid=<?php echo $id;?>" class="btn btn-danger<?php if($_SESSION["role"] != 1){echo ' disabled';}?>">Trotzdem löschen</a>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
						</div>
					</div>
				</div>
			</div>
			<form>
				<fieldset>
					<div class="d-flex gap-3 p-3 flex-row justify-content-center">
						<input name="ingredientid" class="form-control" type="hidden" value="<?php echo $id;?>" readonly>
						<input name="available" class="form-control" type="hidden" value="<?php echo $available;?>" readonly>
						<input name="shoppable" class="form-control" type="hidden" value="<?php echo $shoppable;?>" readonly>
						<input name="favorite" class="form-control" type="hidden" value="<?php echo $favorite;?>" readonly>
						<input name="ingredientname" class="form-control form-control-lg" type="text" placeholder="Name der Zutat" value="<?php echo $ingredientname;?>" readonly>
						<div class="btn-group">
							<a href="/api/ingredient_save.php?ingredientid=<?php echo $id;?>&available=<?php if($available == 0){echo '1';}else{echo '0';}?>" class="btn btn-primary"><i class="fa-fw fa-2x <?php if($available == 0){echo 'fa-regular fa-square';}else{echo 'fa-duotone fa-solid fa-square-check';}?>"></i></a>
							<a href="/api/ingredient_save.php?ingredientid=<?php echo $id;?>&shoppable=<?php if($shoppable == 0){echo '1';}else{echo '0';}?>" class="btn btn-primary"><i class="fa-fw fa-2x <?php if($shoppable == 0){echo 'fa-regular fa-cart-shopping';}else{echo 'fa-duotone fa-solid fa-cart-shopping';}?>"></i></a>
							<a href="/api/ingredient_save.php?ingredientid=<?php echo $id;?>&favorite=<?php if($favorite == 0){echo '1';}else{echo '0';}?>" class="btn btn-primary"><i class="fa-fw fa-2x <?php if($favorite == 0){echo 'fa-regular fa-heart';}else{echo 'fa-solid fa-heart';}?>"></i></a>
						</div>
					</div>
					<div class="d-flex justify-content-center">
						<input name="image" class="form-control" type="hidden" value="<?php echo $image;?>" readonly>
						<picture>
<?php
	$currentfilepath = dirname(__DIR__, 1);
	if(file_exists($currentfilepath .'/img/ingredients/webp700/' . $image . '.webp')){
		echo '							<source srcset="../img/ingredients/webp700/' . $image . '.webp" type="image/webp" media="(min-width: 3840px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/webp512/' . $image . '.webp')){
		echo '							<source srcset="../img/ingredients/webp512/' . $image . '.webp" type="image/webp" media="(min-width: 1600px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/webp256/' . $image . '.webp')){
		echo '							<source srcset="../img/ingredients/webp256/' . $image . '.webp" type="image/webp" media="(min-width: 960px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/webp128/' . $image . '.webp')){
		echo '							<source srcset="../img/ingredients/webp128/' . $image . '.webp" type="image/webp">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png700/' . $image . '.png')){
		echo '							<source srcset="../img/ingredients/png700/' . $image . '.png" type="image/png" media="(min-width: 3840px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png512/' . $image . '.png')){
		echo '							<source srcset="../img/ingredients/png512/' . $image . '.png" type="image/png" media="(min-width: 1600px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png256/' . $image . '.png')){
		echo '							<source srcset="../img/ingredients/png256/' . $image . '.png" type="image/png" media="(min-width: 960px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png128/' . $image . '.png')){
		echo '							<source srcset="../img/ingredients/png128/' . $image . '.png" type="image/png">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png700/unbekannt.png')){
		echo '							<source srcset="../img/ingredients/png700/unbekannt.png" type="image/png" media="(min-width: 3840px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png512/unbekannt.png')){
		echo '							<source srcset="../img/ingredients/png512/unbekannt.png" type="image/png" media="(min-width: 1600px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png256/unbekannt.png')){
		echo '							<source srcset="../img/ingredients/png256/unbekannt.png" type="image/png" media="(min-width: 960px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png128/unbekannt.png')){
		echo '							<source srcset="../img/ingredients/png128/unbekannt.png" type="image/png">
';
	}
?>
							<img loading="lazy" src="../img/ingredients/png128/unbekannt.png" alt="<?php echo $ingredientname;?>" class="border border-secondary text-dark rounded-circle bg-white flex-shrink-0" style="text-align: center;">
						</picture>
					</div>
					<div class="d-flex gap-3 p-3 flex-row justify-content-center">
						<select id="input-tags-ingredienttype-view" name="ingredienttype[]" multiple autocomplete="off" class="form-control w-50" disabled>
<?php 
	$stmt_sql_ingredienttypes = mysqli_prepare($link, $sql_ingredienttypes);
	mysqli_stmt_execute($stmt_sql_ingredienttypes);
	$ingredienttypes_all_res=mysqli_stmt_get_result($stmt_sql_ingredienttypes);
	while($ingredienttypes_all_rows= mysqli_fetch_array($ingredienttypes_all_res, MYSQLI_ASSOC)){
		$typeid = $ingredienttypes_all_rows['ID'];
		$typename = $ingredienttypes_all_rows['typename'];
		$typeicon = $ingredienttypes_all_rows['icon'];
?>
							<option value="<?php echo $typeid;?>" data-src="<?php echo $typeicon;?>"<?php if($typeid == $type){echo ' selected';}?>><?php echo $typename;?></option>
<?php 
	}
	mysqli_stmt_close($stmt_sql_ingredienttypes);
?>
						</select>
					</div>
					<div class="d-flex gap-3 p-3 flex-row justify-content-center">
						<select id="input-tags-ingredienttaste-view" name="ingredienttaste[]" autocomplete="off" multiple class="form-control w-50" disabled>
<?php 
	$stmt_sql_tastes = mysqli_prepare($link, $sql_tastes);
	mysqli_stmt_execute($stmt_sql_tastes);
	$tastes_all_res=mysqli_stmt_get_result($stmt_sql_tastes);
	while($tastes_all_rows= mysqli_fetch_array($tastes_all_res, MYSQLI_ASSOC)){
		$tasteid = $tastes_all_rows['ID'];
		$tastename = $tastes_all_rows['taste'];
		$tasteicon = $tastes_all_rows['icon'];
		$stmt_sql_ingredienttastelist = mysqli_prepare($link, $sql_ingredienttastelist);
		mysqli_stmt_bind_param($stmt_sql_ingredienttastelist, "ii", $id, $tasteid);
		mysqli_stmt_execute($stmt_sql_ingredienttastelist);
		$ingredienttastelist_all_res=mysqli_stmt_get_result($stmt_sql_ingredienttastelist);
		$ingredienttastes = 0;
		while($ingredienttastelist_all_rows= mysqli_fetch_array($ingredienttastelist_all_res, MYSQLI_ASSOC)){
			$ingredienttastes = 1;
		}
		mysqli_stmt_close($stmt_sql_ingredienttastelist);
?>
							<option value="<?php echo $tasteid . ",";?>" data-src="<?php echo $tasteicon;?>"<?php if($ingredienttastes == 1){echo ' selected';}?>><?php echo $tastename;?></option>
<?php
	}
	mysqli_stmt_close($stmt_sql_tastes);
?>
						</select>
					</div>
					<div class="d-flex gap-3 p-3 flex-row justify-content-center">
<?php 
	$ingredientrating_all = 0;
	$stmt_sql_ratings = mysqli_prepare($link, $sql_ingredientrating_all);
	mysqli_stmt_bind_param($stmt_sql_ratings, "i", $id);
	mysqli_stmt_execute($stmt_sql_ratings);
	$ratings_all_res=mysqli_stmt_get_result($stmt_sql_ratings);
	while($ratings_all_rows= mysqli_fetch_array($ratings_all_res, MYSQLI_ASSOC)){
		$ingredientrating_all = $ratings_all_rows['rating'];
	}
	mysqli_stmt_close($stmt_sql_ratings);
	$ingredientrating_my = 0;
	$stmt_sql_rating = mysqli_prepare($link, $sql_ingredientrating_my);
	mysqli_stmt_bind_param($stmt_sql_rating, "ii", $id, $_SESSION["id"]);
	mysqli_stmt_execute($stmt_sql_rating);
	$rating_all_res=mysqli_stmt_get_result($stmt_sql_rating);
	while($rating_all_rows= mysqli_fetch_array($rating_all_res, MYSQLI_ASSOC)){
		$ingredientrating_my = $rating_all_rows['rating'];
	}
	mysqli_stmt_close($stmt_sql_rating);
?>
						<div class="ingredientrating-wrapper-all">
<?php 
	for ($i = 1; $i <= 5; $i++){
		if($ingredientrating_all < $i && $ingredientrating_all > ($i-1)){
			echo '							<i class="fa-duotone fa-solid fa-star-half-stroke text-primary" style="--fa-secondary-color: #6c757d; --fa-secondary-opacity: 1;"></i>';
		}
		else if($ingredientrating_all >= $i){
			echo '							<i class="fa-solid fa-star text-primary"></i>';
		}
		else{
			echo '							<i class="fa-regular fa-star text-secondary"></i>';
		}
		echo '
';
	}
?>
						</div>
						<div class="ingredientrating-wrapper-my" data-id="<?php echo $id;?>" data-user="<?php echo $_SESSION["id"];?>">
							<i class="fa-regular fa-do-not-enter text-danger"></i>
<?php 
	for ($i = 1; $i <= 5; $i++){
		if($ingredientrating_my < $i && $ingredientrating_my > ($i-1)){
			echo '							<i class="fa-duotone fa-solid fa-star-half-stroke text-primary" style="--fa-secondary-color: #6c757d; --fa-secondary-opacity: 1;"></i>';
		}
		else if($ingredientrating_my >= $i){
			echo '							<i class="fa-solid fa-star text-primary"></i>';
		}
		else{
			echo '							<i class="fa-regular fa-star text-secondary"></i>';
		}
		echo '
';
	}
?>
						</div>
					</div>
					<div class="d-flex p-3 justify-content-around flex-wrap">
						<textarea name="description" class="form-control auto-resize" type="text" placeholder="Beschreibung der Zutat" rows="25" readonly><?php echo $description;?></textarea>
					</div>
				</fieldset>
			</form>
			<div class="list-group">
<?php
	$stmt_sql_cocktails = mysqli_prepare($link, $sql_ingredient_usedin);
	mysqli_stmt_bind_param($stmt_sql_cocktails, "i", $ingredientid);
	mysqli_stmt_execute($stmt_sql_cocktails);
	include("sublist_cocktails.php")
?>
			</div>
<?php include("footer.php") ?>