<?php include("header.php") ?>
<?php 
	$orderid = 0;
	if(empty($_GET['cocktailid'])){
		$cocktailid = 0;
	}
	else{
		$cocktailid = $_GET['cocktailid'];
	}
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
				<div class="container-fluid justify-content-start">
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#newDialogCocktailingredient" data-toggle="tooltip" data-placement="bottom" title="Neu">
						<i class="fa-duotone fa-solid fa-file fa-fw"></i>
					</button>
				</div>
			</nav>
			<div class="modal fade" id="newDialogCocktailingredient">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="cocktailingredient_edit" action="/api/cocktailingredient_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><strong>Neuen Zutat zuordnen</strong></h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="cocktailid" class="form-control" type="hidden" value="<?php echo $cocktailid;?>" readonly>
										<select id="input-tags-ingredient-new" name="ingredientid[]" autocomplete="off" multiple class="form-control w-100" data-toggle="tooltip" data-placement="bottom" title="Zutat">
<?php 
	$stmt_sql_allingredients = mysqli_prepare($link, $sql_all_ingredients);
	mysqli_stmt_bind_param($stmt_sql_allingredients, "i", $_SESSION["bar"]);
	mysqli_stmt_execute($stmt_sql_allingredients);
	$allingredients_all_res=mysqli_stmt_get_result($stmt_sql_allingredients);
	while($allingredients_all_rows= mysqli_fetch_array($allingredients_all_res, MYSQLI_ASSOC)){
		$ingredientid = $allingredients_all_rows['ingredient_ID'];
		$ingredientname = $allingredients_all_rows['ingredientname'];
		$ingredientimage = $allingredients_all_rows['image'];
?>
												<option value="<?php echo $ingredientid;?>" data-src="<?php echo $ingredientimage;?>"><?php echo $ingredientname;?></option>
<?php
	}
	mysqli_stmt_close($stmt_sql_allingredients);
?>
											</select>
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="ingredientquantity" class="form-control form-control-lg" type="number" step="0.1" data-toggle="tooltip" data-placement="bottom" title="Menge der Zutat">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<select name="ingredientunit" class="form-select form-select-lg" data-toggle="tooltip" data-placement="bottom" title="Einheit">
<?php 
	$stmt_sql_units = mysqli_prepare($link, $sql_units);
	mysqli_stmt_execute($stmt_sql_units);
	$units_all_res=mysqli_stmt_get_result($stmt_sql_units);
	while($units_all_rows= mysqli_fetch_array($units_all_res, MYSQLI_ASSOC)){
?>
											<option value="<?php echo $units_all_rows['ID'];?>"><?php echo $units_all_rows['unitname'];?></option>
<?php
	}
	mysqli_stmt_close($stmt_sql_units);
?>
										</select>
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<label class="form-check-label" for="ingredientgarnish">Garnierung</label>
										<input name="ingredientgarnish" id="ingredientgarnish"class="form-check-input" type="checkbox" data-toggle="tooltip" data-placement="bottom" title="Garnierung">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<label class="form-check-label" for="ingredientoptional">Optional</label>
										<input name="ingredientoptional" id="ingredientoptional"class="form-check-input" type="checkbox" data-toggle="tooltip" data-placement="bottom" title="Optional">
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
			<div class="list-group">
				<li class="list-group-item list-group-item-primary">Zutaten</li>
<?php
	$stmt_sql_ingredients = mysqli_prepare($link, $sql_ingredients_from_cocktail);
	mysqli_stmt_bind_param($stmt_sql_ingredients, "ii", $_SESSION["bar"], $cocktailid);
	mysqli_stmt_execute($stmt_sql_ingredients);
	$sub_ingredients_show_quantity=true;
	$sub_ingredients_show_count=false;
	$ingred_all_res=mysqli_stmt_get_result($stmt_sql_ingredients);
	while($ingred_all_rows= mysqli_fetch_array($ingred_all_res, MYSQLI_ASSOC)){
?>
				<div class="<?php if($ingred_all_rows['available'] == 0){echo "bg-secondary-subtle";}else{echo "bg-primary-subtle";} ?> list-group-item list-group-item-action d-flex gap-2 py-2 d-block">
					<picture>
<?php
	$currentfilepath = dirname(__DIR__, 1);
	if(file_exists($currentfilepath .'/img/ingredients/webp128/' . $ingred_all_rows['image'] . '.webp')){
		echo '						<source srcset="../img/ingredients/webp128/' . $ingred_all_rows['image'] . '.webp" type="image/webp" media="(min-width: 1600px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/webp64/' . $ingred_all_rows['image'] . '.webp')){
		echo '						<source srcset="../img/ingredients/webp64/' . $ingred_all_rows['image'] . '.webp" type="image/webp" media="(min-width: 960px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/webp48/' . $ingred_all_rows['image'] . '.webp')){
		echo '						<source srcset="../img/ingredients/webp48/' . $ingred_all_rows['image'] . '.webp" type="image/webp">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png128/' . $ingred_all_rows['image'] . '.png')){
		echo '						<source srcset="../img/ingredients/png128/' . $ingred_all_rows['image'] . '.png" type="image/png" media="(min-width: 1600px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png64/' . $ingred_all_rows['image'] . '.png')){
		echo '						<source srcset="../img/ingredients/png64/' . $ingred_all_rows['image'] . '.png" type="image/png" media="(min-width: 960px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png48/' . $ingred_all_rows['image'] . '.png')){
		echo '						<source srcset="../img/ingredients/png48/' . $ingred_all_rows['image'] . '.png" type="image/png">
';
	}
?>
						<img decoding = "async" loading="lazy" src="../img/ingredients/png48/unbekannt.png" alt="<?php echo $ingred_all_rows['ingredientname'];?>" class="text-dark border border-secondary rounded-circle shadow-4-strong bg-white flex-shrink-0" style="text-align: center;">
					</picture>
					<p class="mb-0 align-self-center text-size-h6"><?php echo $ingred_all_rows['ingredientname'];?></p>
					<div class="flex-grow-1 d-flex gap-2 w-25 flex-nowrap"></div>
					<form class="align-self-center" action="/api/cocktailingredient_save.php">
						<fieldset class="row">
							<div class="align-self-center gap-0 col-4">
								<input name="cocktailid" class="form-control" type="hidden" value="<?php echo $cocktailid;?>" readonly>
								<input name="cocktailingredientid" class="form-control" type="hidden" value="<?php echo $ingred_all_rows['cocktailingredientlist_ID'];?>" readonly>
								<input name="ingredientid" class="form-control" type="hidden" value="<?php echo $ingred_all_rows['ingredient_ID'];?>" readonly>
								<input name="quantity" class="form-control form-control-lg" type="number" step="0.1" placeholder="0" value="<?php echo $ingred_all_rows['quantity'];?>">
							</div>
							<div class="align-self-center gap-0 col-4">
								<select name="unit" class="align-self-center form-select form-select-lg">
<?php 
	$stmt_sql_units = mysqli_prepare($link, $sql_units);
	mysqli_stmt_execute($stmt_sql_units);
	$units_all_res=mysqli_stmt_get_result($stmt_sql_units);
	while($units_all_rows= mysqli_fetch_array($units_all_res, MYSQLI_ASSOC)){
?>
									<option value="<?php echo $units_all_rows['ID'];?>"<?php if($ingred_all_rows['unit'] == $units_all_rows['ID']){echo ' selected';}?>><?php echo $units_all_rows['unitname'];?></option>
<?php
	}
	mysqli_stmt_close($stmt_sql_units);
?>
								</select>
							</div>
							<div class="align-self-center gap-0 col-2">
								<input class="align-self-center btn btn-primary" type="submit" name="save" value="Speichern">
							</div>
							<div class="align-self-center gap-0 col-2">
								<a href="/api/cocktailingredient_delete.php?cocktailid=<?php echo $cocktailid;?>&ingredientid=<?php echo $ingred_all_rows['ingredient_ID'];?>" class="btn btn-danger">Löschen</a>
							</div>
						</fieldset>
					</form>
				</div>
				<?php
} ?>
			</div>
<?php include("footer.php") ?>