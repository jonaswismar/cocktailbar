<?php include("header.php") ?>
<?php 
	$unitid = "";
	$unitimage = "";
	$unitname = "";
	$unitshort = "";
	$unitshortX = "";
	$unitdescription = "";
	
	if(empty($_GET['unitid'])){
		$unitid = 0;
	}
	else{
		$unitid = $_GET['unitid'];
	}
	if($_SESSION["role"] != 1){
		$edit = 0;
	}
	$stmt_sql_unit = mysqli_prepare($link, $sql_unit);
	mysqli_stmt_bind_param($stmt_sql_unit, "i", $unitid);
	mysqli_stmt_execute($stmt_sql_unit);
	$unit_all_res=mysqli_stmt_get_result($stmt_sql_unit);
	while($unit_all_rows= mysqli_fetch_array($unit_all_res, MYSQLI_ASSOC)){
		$unitid = $unit_all_rows['ID'];
		$unitimage = $unit_all_rows['image'];
		$unitname = $unit_all_rows['unitname'];
		$unitshort = $unit_all_rows['unitshort'];
		$unitshortX = $unit_all_rows['unitshortX'];
		$unitdescription = $unit_all_rows['description'];
	}
	mysqli_stmt_close($stmt_sql_unit);
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
				<div class="container-fluid justify-content-start">
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#newDialogUnit" data-toggle="tooltip" data-placement="bottom" title="Neu">
						<i class="fa-duotone fa-solid fa-file fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#editDialogUnit" data-toggle="tooltip" data-placement="bottom" title="Bearbeiten">
						<i class="fa-duotone fa-solid fa-pencil fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#deleteDialogUnit" data-toggle="tooltip" data-placement="bottom" title="Löschen">
						<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
					</button>
				</div>
			</nav>
			<div class="modal fade" id="newDialogUnit">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="unit_edit" action="/views/unit_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><strong>Neue Einheit anlegen</strong></h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="unitid" class="form-control" type="hidden" value="0" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="unitimage" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="unitname" class="form-control form-control-lg" type="text" placeholder="Name der Einheit" data-toggle="tooltip" data-placement="bottom" title="Name der Einheit">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="unitshort" class="form-control form-control-lg" type="text" placeholder="Kürzel (Einzahl)" data-toggle="tooltip" data-placement="bottom" title="Kürzel (Einzahl)" value="<?php echo $unitshort;?>">
										<input name="unitshortX" class="form-control form-control-lg" type="text" placeholder="Kürzel (Mehrzahl)" data-toggle="tooltip" data-placement="bottom" title="Kürzel (Mehrzahl)" value="<?php echo $unitshortX;?>">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<textarea name="unitdescription" class="form-control auto-resize" type="text" placeholder="Beschreibung der Einheit" rows="25" data-toggle="tooltip" data-placement="bottom" title="Beschreibung der Einheit"></textarea>
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
			<div class="modal fade" id="editDialogUnit">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="unit_edit" action="/views/unit_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><i class="<?php echo $unitimage;?> fa-2x"></i><strong> <?php echo $unitname;?></strong> bearbeiten</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="unitid" class="form-control" type="hidden" value="<?php echo $unitid;?>" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="unitimage" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name" value="<?php echo $unitimage;?>">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="unitname" class="form-control form-control-lg" type="text" placeholder="Name der Einheit" data-toggle="tooltip" data-placement="bottom" title="Name der Einheit" value="<?php echo $unitname;?>">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="unitshort" class="form-control form-control-lg" type="text" placeholder="Kürzel (Einzahl)" data-toggle="tooltip" data-placement="bottom" title="Kürzel (Einzahl)" value="<?php echo $unitshort;?>">
										<input name="unitshortX" class="form-control form-control-lg" type="text" placeholder="Kürzel (Mehrzahl)" data-toggle="tooltip" data-placement="bottom" title="Kürzel (Mehrzahl)" value="<?php echo $unitshortX;?>">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<textarea name="unitdescription" class="form-control auto-resize" type="text" placeholder="Beschreibung der Einheit" rows="25" data-toggle="tooltip" data-placement="bottom" title="Beschreibung der Einheit"><?php echo $unitdescription;?></textarea>
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
			<div class="modal fade" id="deleteDialogUnit">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="<?php echo $unitimage;?> fa-2x"></i><strong> <?php echo $unitname;?></strong> löschen</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						</div>
						<div class="modal-body">
							<p>Möchten Sie die Einheit <strong><?php echo $unitname;?></strong> wirklich löschen?</p>
							<p>Wenn Sie <strong><?php echo $unitname;?></strong> löschen, werden diese (einschließlich Cocktails/Zutaten) ebenfalls gelöscht! Diese Aktion kann nicht rückgängig gemacht werden!</p>
						</div>
						<div class="modal-footer">
							<a href="unit_delete.php?unitid=<?php echo $unitid;?>" class="btn btn-danger<?php if($_SESSION["role"] != 1){echo ' disabled';}?>">Trotzdem löschen</a>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
						</div>
					</div>
				</div>
			</div>
			<form action="unit_save.php" method="POST">
				<fieldset>
					<div class="d-flex gap-3 p-3 flex-row justify-content-center">
						<i class="<?php echo $unitimage;?> fa-4x"></i>
						<input name="unitimage" class="form-control" type="hidden" value="<?php echo $unitimage;?>" autocomplete="off" spellcheck="false" readonly>
						<input name="unitid" class="form-control" type="hidden" value="<?php echo $unitid;?>" readonly>
						<input name="unitname" class="form-control" type="text" placeholder="Name der Einheit" value="<?php echo $unitname;?>" readonly>
					</div>
					<div class="d-flex gap-3 p-3 flex-row justify-content-center">
						<input name="unitshort" class="form-control" type="text" placeholder="Kürzel (Einzahl)" value="<?php echo $unitshort;?>" readonly>
						<input name="unitshortX" class="form-control" type="text" placeholder="Kürzel (Mehrzahl)" value="<?php echo $unitshortX;?>" readonly>
					</div>
					<div class="d-flex p-3 justify-content-around flex-wrap">
						<textarea name="unitdescription" class="form-control auto-resize" type="text" placeholder="Beschreibung der Einheit" rows="25" readonly><?php echo $unitdescription;?></textarea>
					</div>
				</fieldset>
			</form>
<?php include("footer.php") ?>