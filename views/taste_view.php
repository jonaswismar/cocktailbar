<?php include("header.php") ?>
<?php 
	$tasteid = "";
	$tasteimage = "";
	$tastename = "";
	$ingredient_count = "";
	$cocktail_count = "";
	$tastedescription = "";
	
	if(empty($_GET['tasteid']))
	{
		$tasteid = 0;
	}
	else
	{
		$tasteid = $_GET['tasteid'];
	}
	if($_SESSION["role"] != 1)
	{
		$edit = 0;
	}
	$stmt_sql_taste = mysqli_prepare($link, $sql_taste);
	mysqli_stmt_bind_param($stmt_sql_taste, "i", $tasteid);
	mysqli_stmt_execute($stmt_sql_taste);
	$taste_all_res=mysqli_stmt_get_result($stmt_sql_taste);
	while($taste_all_rows= mysqli_fetch_array($taste_all_res, MYSQLI_ASSOC))
	{
		$tasteid = $taste_all_rows['ID'];
		$tasteimage = $taste_all_rows['image'];
		$tastename = $taste_all_rows['taste'];
		$ingredient_count = $taste_all_rows['ingredient_count'];
		$cocktail_count = $taste_all_rows['cocktail_count'];
		$tastedescription = $taste_all_rows['description'];
	}
	mysqli_stmt_close($stmt_sql_taste);
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
				<div class="container-fluid justify-content-start">
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#newDialogTaste" data-toggle="tooltip" data-placement="bottom" title="Neu">
						<i class="fa-duotone fa-solid fa-file fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#editDialogTaste" data-toggle="tooltip" data-placement="bottom" title="Bearbeiten">
						<i class="fa-duotone fa-solid fa-pencil fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#deleteDialogTaste" data-toggle="tooltip" data-placement="bottom" title="Löschen">
						<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
					</button>
				</div>
			</nav>
			<div class="modal fade" id="newDialogTaste">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="taste_edit" action="/views/taste_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><strong>Neue Geschmacksrichtung anlegen</strong></h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="tasteid" class="form-control" type="hidden" value="0" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="tasteimage" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="tastename" class="form-control form-control-lg" type="text" placeholder="Name der Geschmacksrichtung" data-toggle="tooltip" data-placement="bottom" title="Name der Geschmacksrichtung">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<textarea name="tastedescription" class="form-control auto-resize" type="text" placeholder="Beschreibung der Geschmacksrichtung" rows="25" data-toggle="tooltip" data-placement="bottom" title="Beschreibung der Geschmacksrichtung"></textarea>
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
			<div class="modal fade" id="editDialogTaste">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="taste_edit" action="/views/taste_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><i class="<?php echo $tasteimage;?> fa-2x"></i><strong> <?php echo $tastename;?></strong> bearbeiten</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="tasteid" class="form-control" type="hidden" value="<?php echo $tasteid;?>" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="tasteimage" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name" value="<?php echo $tasteimage;?>">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="tastename" class="form-control form-control-lg" type="text" placeholder="Name der Geschmacksrichtung" data-toggle="tooltip" data-placement="bottom" title="Name der Geschmacksrichtung" value="<?php echo $tastename;?>">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<textarea name="tastedescription" class="form-control auto-resize" type="text" placeholder="Beschreibung der Geschmacksrichtung" rows="25" data-toggle="tooltip" data-placement="bottom" title="Beschreibung der Geschmacksrichtung"><?php echo $tastedescription;?></textarea>
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
			<div class="modal fade" id="deleteDialogTaste">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="<?php echo $tasteimage;?> fa-2x"></i><strong> <?php echo $tastename;?></strong> löschen</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						</div>
						<div class="modal-body">
							<p>Möchten Sie die Geschmacksrichtung <strong><?php echo $tastename;?></strong> wirklich löschen?</p>
							<p>Sie wird in <strong><?php echo $cocktail_count;?></strong> Cocktails verwendet.</p>
							<p>Sie wird in <strong><?php echo $ingredient_count;?></strong> Zutaten verwendet.</p>
							<p>Wenn Sie <strong><?php echo $tastename;?></strong> löschen, werden diese (einschließlich Cocktails/Zutaten) ebenfalls gelöscht! Diese Aktion kann nicht rückgängig gemacht werden!</p>
						</div>
						<div class="modal-footer">
							<a href="taste_delete.php?tasteid=<?php echo $tasteid;?>" class="btn btn-danger<?php if($_SESSION["role"] != 1){echo ' disabled';}?>">Trotzdem löschen</a>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
						</div>
					</div>
				</div>
			</div>
			<form action="taste_save.php" method="POST">
				<fieldset>
					<div class="d-flex gap-3 p-3 flex-row justify-content-center">
						<i class="<?php echo $tasteimage;?> fa-4x"></i>
						<input name="tasteimage" class="form-control" type="hidden" value="<?php echo $tasteimage;?>" autocomplete="off" spellcheck="false" readonly>
						<input name="tasteid" class="form-control" type="hidden" value="<?php echo $tasteid;?>" readonly>
						<input name="tastename" class="form-control" type="text" placeholder="Name des Geschmacks" value="<?php echo $tastename;?>" readonly>
					</div>
					<div class="d-flex p-3 justify-content-around flex-wrap">
						<textarea name="tastedescription" class="form-control auto-resize" type="text" placeholder="Beschreibung des Geschmacks" rows="25" readonly><?php echo $tastedescription;?></textarea>
					</div>
				</fieldset>
			</form>
			<div class="list-group">
				<li class="list-group-item list-group-item-primary">Cocktails</li>
<?php
	$stmt_sql_cocktails = mysqli_prepare($link, $sql_taste_usedin_cocktails);
	mysqli_stmt_bind_param($stmt_sql_cocktails, "i", $tasteid);
	mysqli_stmt_execute($stmt_sql_cocktails);
	include("sublist_cocktails.php");
?>
				<li class="list-group-item list-group-item-primary">Zutaten</li>
<?php
	$stmt_sql_ingredients = mysqli_prepare($link, $sql_taste_usedin_ingredients);
	mysqli_stmt_bind_param($stmt_sql_ingredients, "ii", $_SESSION["bar"], $tasteid);
	mysqli_stmt_execute($stmt_sql_ingredients);
	include("sublist_ingredients.php");
?>
			</div>
<?php include("footer.php") ?>