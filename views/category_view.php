<?php include("header.php") ?>
<?php 
	$categoryid = "";
	$categoryname = "";
	$categorydescription = "";
	$cocktail_count = "";
	$categoryimage = "";
	
	if(empty($_GET['categoryid']))
	{
		$categoryid = 0;
	}
	else
	{
		$categoryid = $_GET['categoryid'];
	}
	if($_SESSION["role"] != 1)
	{
		$edit = 0;
	}
	$stmt_sql_category = mysqli_prepare($link, $sql_category);
	mysqli_stmt_bind_param($stmt_sql_category, "i", $categoryid);
	mysqli_stmt_execute($stmt_sql_category);
	$category_all_res=mysqli_stmt_get_result($stmt_sql_category);
	while($category_all_rows= mysqli_fetch_array($category_all_res, MYSQLI_ASSOC))
	{
		$categoryid = $category_all_rows['ID'];
		$categoryname = $category_all_rows['categoryname'];
		$categorydescription = $category_all_rows['description'];
		$categoryimage = $category_all_rows['image'];
		$cocktail_count = $category_all_rows['cocktail_count'];
	}
	mysqli_stmt_close($stmt_sql_category);
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
				<div class="container-fluid justify-content-start">
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#newDialogCategory" data-toggle="tooltip" data-placement="bottom" title="Neu">
						<i class="fa-duotone fa-solid fa-file fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#editDialogCategory" data-toggle="tooltip" data-placement="bottom" title="Bearbeiten">
						<i class="fa-duotone fa-solid fa-pencil fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#deleteDialogCategory" data-toggle="tooltip" data-placement="bottom" title="Löschen">
						<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
					</button>
				</div>
			</nav>
			<div class="modal fade" id="newDialogCategory">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="category_edit" action="/views/category_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><strong>Neue Kategorie anlegen</strong></h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="categoryid" class="form-control" type="hidden" value="0" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="categoryimage" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="categoryname" class="form-control form-control-lg" type="text" placeholder="Name der Kategorie" data-toggle="tooltip" data-placement="bottom" title="Name der Kategorie">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<textarea name="categorydescription" class="form-control auto-resize" type="text" placeholder="Beschreibung der Kategorie" rows="25" data-toggle="tooltip" data-placement="bottom" title="Beschreibung der Kategorie"></textarea>
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
			<div class="modal fade" id="editDialogCategory">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="category_edit" action="/views/category_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><i class="<?php echo $categoryimage;?> fa-2x"></i><strong> <?php echo $categoryname;?></strong> bearbeiten</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="categoryid" class="form-control" type="hidden" value="<?php echo $categoryid;?>" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="categoryimage" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name" value="<?php echo $categoryimage;?>">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="categoryname" class="form-control form-control-lg" type="text" placeholder="Name der Kategorie" data-toggle="tooltip" data-placement="bottom" title="Name der Kategorie" value="<?php echo $categoryname;?>">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<textarea name="categorydescription" class="form-control auto-resize" type="text" placeholder="Beschreibung der Kategorie" data-toggle="tooltip" data-placement="bottom" title="Beschreibung der Kategorie" rows="25"><?php echo $categorydescription;?></textarea>
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
			<div class="modal fade" id="deleteDialogCategory">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="<?php echo $categoryimage;?> fa-2x"></i><strong> <?php echo $categoryname;?></strong> löschen</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						</div>
						<div class="modal-body">
							<p>Möchten Sie die Kategorie <strong><?php echo $categoryname;?></strong> wirklich löschen?</p>
							<p>Sie wird in <strong><?php echo $cocktail_count;?></strong> Cocktails verwendet.</p>
							<p>Wenn Sie <strong><?php echo $categoryname;?></strong> löschen, werden diese (einschließlich Cocktails) ebenfalls gelöscht! Diese Aktion kann nicht rückgängig gemacht werden!</p>
						</div>
						<div class="modal-footer">
							<a href="category_delete.php?categoryid=<?php echo $categoryid;?>" class="btn btn-danger<?php if($_SESSION["role"] != 1){echo ' disabled';}?>">Trotzdem löschen</a>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
						</div>
					</div>
				</div>
			</div>
			<form action="category_save.php" method="POST">
				<fieldset>
					<div class="d-flex gap-3 p-3 flex-row justify-content-center">
						<i class="<?php echo $categoryimage;?> fa-4x"></i>
						<input name="categoryimage" class="form-control" type="hidden" value="<?php echo $categoryimage;?>" autocomplete="off" spellcheck="false" readonly>
						<input name="categoryid" class="form-control" type="hidden" value="<?php echo $categoryid;?>" readonly>
						<input name="categoryname" class="form-control" type="text" placeholder="Name der Kategorie" value="<?php echo $categoryname;?>" readonly>
					</div>
					<div class="d-flex p-3 justify-content-around flex-wrap">
						<textarea name="categorydescription" class="form-control auto-resize" type="text" placeholder="Beschreibung der Kategorie" rows="25" readonly><?php echo $categorydescription;?></textarea>
					</div>
				</fieldset>
			</form>
			<div class="list-group">
				<li class="list-group-item list-group-item-primary">Cocktails</li>
				<?php
					$stmt_sql_cocktails = mysqli_prepare($link, $sql_category_usedin);
					mysqli_stmt_bind_param($stmt_sql_cocktails, "i", $categoryid);
					mysqli_stmt_execute($stmt_sql_cocktails);
					include("sublist_cocktails.php");
					mysqli_close($link);
				?>
			</div>
<?php include("footer.php") ?>