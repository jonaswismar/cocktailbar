<?php include("header.php") ?>
<?php 
	$id = "";
	$typename = "";
	$color = "";
	$description = "";
	$icon = "";
	$ingredient_count = 0;
	
	if(empty($_GET['ingredienttypeid']))
	{
		$ingredienttypeid = 0;
	}
	else
	{
		$ingredienttypeid = $_GET['ingredienttypeid'];
	}
	if(empty($_GET['edit']))
	{
		$edit = 0;
	}
	else
	{
		$edit = $_GET['edit'];
	}
	if($_SESSION["role"] != 1)
	{
		$edit = 0;
	}
	$stmt_sql_ingredienttype = mysqli_prepare($link, $sql_ingredienttype);
	mysqli_stmt_bind_param($stmt_sql_ingredienttype, "i", $ingredienttypeid);
	mysqli_stmt_execute($stmt_sql_ingredienttype);
	$ingredienttype_all_res=mysqli_stmt_get_result($stmt_sql_ingredienttype);
	while($ingredienttype_all_rows= mysqli_fetch_array($ingredienttype_all_res, MYSQLI_ASSOC))
	{
		$id = $ingredienttype_all_rows['ID'];
		$typename = $ingredienttype_all_rows['typename'];
		$description = $ingredienttype_all_rows['description'];
		$icon = $ingredienttype_all_rows['icon'];
		$ingredient_count = $ingredienttype_all_rows['ingredient_count'];
	}
	mysqli_stmt_close($stmt_sql_ingredienttype);
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
				<div class="container-fluid justify-content-start">
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#newDialogIngredienttype" data-toggle="tooltip" data-placement="bottom" title="Neu">
						<i class="fa-duotone fa-solid fa-file fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#editDialogIngredienttype" data-toggle="tooltip" data-placement="bottom" title="Bearbeiten">
						<i class="fa-duotone fa-solid fa-pencil fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#deleteDialogIngredienttype" data-toggle="tooltip" data-placement="bottom" title="Löschen">
						<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
					</button>
				</div>
			</nav>
			<div class="modal fade" id="newDialogIngredienttype">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="ingredienttype_edit" action="/api/ingredienttype_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><strong>Neuen Zutatentyp anlegen</strong></h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="ingredienttypeid" class="form-control" type="hidden" value="0" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="ingredienttypeicon" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="ingredienttypename" class="form-control form-control-lg" type="text" placeholder="Name des Zutatentyp" data-toggle="tooltip" data-placement="bottom" title="Name des Zutatentyp" required>
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<textarea name="ingredienttypedescription" class="form-control auto-resize" type="text" placeholder="Beschreibung des Zutatentyp" rows="25" data-toggle="tooltip" data-placement="bottom" title="Beschreibung des Zutatentyp"></textarea>
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
			<div class="modal fade" id="editDialogIngredienttype">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="ingredienttype_edit" action="/api/ingredienttype_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><i class="<?php echo $icon;?> fa-2x"></i><strong> <?php echo $typename;?></strong> bearbeiten</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="ingredienttypeid" class="form-control" type="hidden" value="<?php echo $id;?>" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="ingredienttypeicon" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name" value="<?php echo $image;?>">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="ingredienttypename" class="form-control form-control-lg" type="text" placeholder="Name des Zutatentyp" data-toggle="tooltip" data-placement="bottom" title="Name des Zutatentyp" value="<?php echo $typename;?>" required>
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<textarea name="ingredientdescription" class="form-control auto-resize" type="text" placeholder="Beschreibung des Zutatentyp" rows="25" data-toggle="tooltip" data-placement="bottom" title="Beschreibung des Zutatentyp"><?php echo $description;?></textarea>
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
			<div class="modal fade" id="deleteDialogIngredienttype">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="<?php echo $icon;?> fa-2x"></i><strong> <?php echo $typename;?></strong> löschen</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						</div>
						<div class="modal-body">
							<p>Möchten Sie den Zutatentyp <strong><?php echo $typename;?></strong> wirklich löschen?</p>
							<p>Sie wird von <strong><?php echo $ingredient_count;?></strong> Zutaten verwendet.</p>
							<p>Wenn Sie <strong><?php echo $typename;?></strong> löschen, werden diese (einschließlich Zutaten) ebenfalls gelöscht! Diese Aktion kann nicht rückgängig gemacht werden!</p>
						</div>
						<div class="modal-footer">
							<a href="/api/ingredienttype_delete.php?ingredienttypeid=<?php echo $id;?>" class="btn btn-danger<?php if($_SESSION["role"] != 1){echo ' disabled';}?>">Trotzdem löschen</a>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
						</div>
					</div>
				</div>
			</div>
			<form action="ingredienttype_save.php" method="POST">
				<fieldset>
					<div class="d-flex gap-3 p-3 flex-row justify-content-center">
						<i class="<?php echo $icon;?> fa-4x" id="IconPreview"></i>
						<input name="icon" class="form-control" type="hidden" value="<?php echo $icon;?>" autocomplete="off" spellcheck="false"<?php if($edit == 0){echo ' readonly';}?>/>
						<input name="ingredienttypeid" class="form-control" type="hidden" value="<?php echo $id;?>"<?php if($edit == 0){echo ' readonly';}?>>
						<input name="typename" class="form-control" type="text" placeholder="Name des Zutatentyp" value="<?php echo $typename;?>"<?php if($edit == 0){echo ' readonly';}?>>
					</div>
					<div class="d-flex p-3 justify-content-around flex-wrap">
						<textarea name="description" class="form-control auto-resize" type="text" placeholder="Beschreibung des Zutatentyp" rows="25"<?php if($edit == 0){echo ' readonly';}?>><?php echo $description;?></textarea>
					</div>
					<div class="d-flex p-3 justify-content-around flex-wrap">
						<input class="btn btn-primary" type="submit"<?php if($edit == 0){echo ' hidden';}?>>
					</div>
				</fieldset>
			</form>
		<div class="list-group">
			<li class="list-group-item list-group-item-primary">Zutaten</li>
<?php
	$stmt_sql_ingredients = mysqli_prepare($link, $sql_ingredients_from_type);
	mysqli_stmt_bind_param($stmt_sql_ingredients, "ii", $_SESSION["bar"], $id);
	mysqli_stmt_execute($stmt_sql_ingredients);
	$sub_ingredients_show_quantity=false;
	$sub_ingredients_show_count=true;
	include("sublist_ingredients.php")
?>
			</div>
<?php include("footer.php") ?>