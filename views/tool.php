<?php include("header.php") ?>
<?php 
	$toolid = "";
	$toolname = "";
	$tooldescription = "";
	$cocktail_count = "";
	$toolicon = "";
	
	if(empty($_GET['toolid'])){
		$toolid = 0;
	}
	else{
		$toolid = $_GET['toolid'];
	}
	$stmt_sql_tool = mysqli_prepare($link, $sql_tool);
	mysqli_stmt_bind_param($stmt_sql_tool, "i", $toolid);
	mysqli_stmt_execute($stmt_sql_tool);
	$tool_all_res=mysqli_stmt_get_result($stmt_sql_tool);
	while($tool_all_rows= mysqli_fetch_array($tool_all_res, MYSQLI_ASSOC))
	{
		$toolid = $tool_all_rows['ID'];
		$toolname = $tool_all_rows['toolname'];
		$tooldescription = $tool_all_rows['description'];
		$toolicon = $tool_all_rows['icon'];
		$cocktail_count = $tool_all_rows['cocktail_count'];
	}
	mysqli_stmt_close($stmt_sql_tool);
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
				<div class="container-fluid justify-content-start">
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#newDialogTool" data-toggle="tooltip" data-placement="bottom" title="Neu">
						<i class="fa-duotone fa-solid fa-file fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#editDialogTool" data-toggle="tooltip" data-placement="bottom" title="Bearbeiten">
						<i class="fa-duotone fa-solid fa-pencil fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#deleteDialogTool" data-toggle="tooltip" data-placement="bottom" title="Löschen">
						<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
					</button>
				</div>
			</nav>
			<div class="modal fade" id="newDialogTool">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="tool_edit" action="/api/tool_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><strong>Neues Bar Werkzeuge anlegen</strong></h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="toolid" class="form-control" type="hidden" value="0" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="toolicon" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name" required>
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="toolname" class="form-control form-control-lg" type="text" placeholder="Name des Bar Werkzeug" data-toggle="tooltip" data-placement="bottom" title="Name des Bar Werkzeug" required>
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<textarea name="tooldescription" class="form-control auto-resize" type="text" placeholder="Beschreibung des Bar Werkzeug" rows="25" data-toggle="tooltip" data-placement="bottom" title="Beschreibung des Bar Werkzeug"></textarea>
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
			<div class="modal fade" id="editDialogTool">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="tool_edit" action="/api/tool_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><i class="<?php echo $toolicon;?> fa-2x"></i><strong> <?php echo $toolname;?></strong> bearbeiten</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="toolid" class="form-control" type="hidden" value="<?php echo $toolid;?>" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="toolicon" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name" value="<?php echo $toolicon;?>" required>
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="toolname" class="form-control form-control-lg" type="text" placeholder="Name des Bar Werkzeug" data-toggle="tooltip" data-placement="bottom" title="Name des Bar Werkzeug" value="<?php echo $toolname;?>" required>
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<textarea name="tooldescription" class="form-control auto-resize" type="text" placeholder="Beschreibung des Bar Werkzeug" data-toggle="tooltip" data-placement="bottom" title="Beschreibung des Bar Werkzeug" rows="25"><?php echo $tooldescription;?></textarea>
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
			<div class="modal fade" id="deleteDialogTool">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="<?php echo $toolicon;?> fa-2x"></i><strong> <?php echo $toolname;?></strong> löschen</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						</div>
						<div class="modal-body">
							<p>Möchten Sie das Bar Werkzeug <strong><?php echo $toolname;?></strong> wirklich löschen?</p>
							<p>Es wird in <strong><?php echo $cocktail_count;?></strong> Cocktails verwendet.</p>
							<p>Wenn Sie <strong><?php echo $toolname;?></strong> löschen, wird dieses (einschließlich Cocktails) ebenfalls gelöscht! Diese Aktion kann nicht rückgängig gemacht werden!</p>
						</div>
						<div class="modal-footer">
							<a href="tool_delete.php?toolid=<?php echo $toolid;?>" class="btn btn-danger<?php if($_SESSION["role"] != 1){echo ' disabled';}?>">Trotzdem löschen</a>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
						</div>
					</div>
				</div>
			</div>
			<form action="/api/tool_save.php" method="POST">
				<fieldset>
					<div class="d-flex gap-3 p-3 flex-row justify-content-center">
						<i class="<?php echo $toolicon;?> fa-4x"></i>
						<input name="toolicon" class="form-control" type="hidden" value="<?php echo $toolicon;?>" autocomplete="off" spellcheck="false" readonly>
						<input name="toolid" class="form-control" type="hidden" value="<?php echo $toolid;?>" readonly>
						<input name="toolname" class="form-control" type="text" placeholder="Name des Bar Werkzeug" value="<?php echo $toolname;?>" readonly>
					</div>
					<div class="d-flex p-3 justify-content-around flex-wrap">
						<textarea name="tooldescription" class="form-control auto-resize" type="text" placeholder="Beschreibung des Bar Werkzeug" rows="25" readonly><?php echo $tooldescription;?></textarea>
					</div>
				</fieldset>
			</form>
			<div class="list-group">
				<li class="list-group-item list-group-item-primary">Cocktails</li>
				<!--?php
					$stmt_sql_cocktails = mysqli_prepare($link, $sql_tool_usedin);
					mysqli_stmt_bind_param($stmt_sql_cocktails, "i", $toolid);
					mysqli_stmt_execute($stmt_sql_cocktails);
					include("sublist_cocktails.php");
				?>-->
			</div>
<?php include("footer.php") ?>