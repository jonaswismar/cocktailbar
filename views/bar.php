<?php include("header.php") ?>
<?php 
	$barid = 0;
	$barname = "";
	$baricon = "";
	
	if(empty($_GET['barid'])){
		$barid = 0;
	}
	else{
		$barid = $_GET['barid'];
	}
	$stmt_sql_bar = mysqli_prepare($link, $sql_currentbar_data);
	mysqli_stmt_bind_param($stmt_sql_bar, "i", $barid);
	mysqli_stmt_execute($stmt_sql_bar);
	$bar_all_res=mysqli_stmt_get_result($stmt_sql_bar);
	while($bar_all_rows= mysqli_fetch_array($bar_all_res, MYSQLI_ASSOC))
	{
		$barid = $bar_all_rows['ID'];
		$barname = $bar_all_rows['barname'];
		$baricon = $bar_all_rows['icon'];
	}
	mysqli_stmt_close($stmt_sql_bar);
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
				<div class="container-fluid justify-content-start">
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#newDialogBar" data-toggle="tooltip" data-placement="bottom" title="Neu">
						<i class="fa-duotone fa-solid fa-file fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#editDialogBar" data-toggle="tooltip" data-placement="bottom" title="Bearbeiten">
						<i class="fa-duotone fa-solid fa-pencil fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#deleteDialogBar" data-toggle="tooltip" data-placement="bottom" title="Löschen">
						<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
					</button>
				</div>
			</nav>
			<div class="modal fade" id="newDialogBar">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="bar_edit" action="/api/bar_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><strong>Neue Bar anlegen</strong></h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="categoryid" class="form-control" type="hidden" value="0" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="baricon" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="barname" class="form-control form-control-lg" type="text" placeholder="Name der Bar" data-toggle="tooltip" data-placement="bottom" title="Name der Bar" required>
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
			<div class="modal fade" id="editDialogBar">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="bar_edit" action="/api/bar_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><i class="<?php echo $baricon;?> fa-2x"></i><strong> <?php echo $barname;?></strong> bearbeiten</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="barid" class="form-control" type="hidden" value="<?php echo $barid;?>" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="baricon" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name" value="<?php echo $barimage;?>">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="barname" class="form-control form-control-lg" type="text" placeholder="Name der Bar" data-toggle="tooltip" data-placement="bottom" title="Name der Bar" value="<?php echo $barname;?>" required>
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
			<div class="modal fade" id="deleteDialogBar">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="<?php echo $baricon;?> fa-2x"></i><strong> <?php echo $barname;?></strong> löschen</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						</div>
						<div class="modal-body">
							<p>Möchten Sie die Bar <strong><?php echo $barname;?></strong> wirklich löschen?</p>
							<p>Wenn Sie <strong><?php echo $barname;?></strong> löschen, werden diese (einschließlich Cocktails) ebenfalls gelöscht! Diese Aktion kann nicht rückgängig gemacht werden!</p>
						</div>
						<div class="modal-footer">
							<a href="bar_delete.php?barid=<?php echo $barid;?>" class="btn btn-danger<?php if($_SESSION["role"] != 1){echo ' disabled';}?>">Trotzdem löschen</a>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
						</div>
					</div>
				</div>
			</div>
			<form action="/api/bar_save.php" method="POST">
				<fieldset>
					<div class="d-flex gap-3 p-3 flex-row justify-content-center">
						<i class="<?php echo $baricon;?> fa-4x"></i>
						<input name="baricon" class="form-control" type="hidden" value="<?php echo $baricon;?>" autocomplete="off" spellcheck="false" readonly>
						<input name="barid" class="form-control" type="hidden" value="<?php echo $barid;?>" readonly>
						<input name="barname" class="form-control" type="text" placeholder="Name der Bar" value="<?php echo $barname;?>" readonly>
					</div>
				</fieldset>
			</form>
			<div class="list-group flex-fill">
				<li class="list-group-item list-group-item-primary">Barkeeper<a href="/views/barkeeper.php?barid=<?php echo $barid;?>" class="btn btn-primary float-end<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-toggle="tooltip" data-placement="bottom" title="Bearbeiten"><i class="fa-duotone fa-solid fa-pencil fa-fw"></i></a></li>
				
				
				
				<?php 
	if($_SESSION["role"] == 1){
		$stmt_sql_users = mysqli_prepare($link, $sql_barkeeper_bar);
		mysqli_stmt_bind_param($stmt_sql_users, "i", $barid);
		mysqli_stmt_execute($stmt_sql_users);
		$users_all_res=mysqli_stmt_get_result($stmt_sql_users);
		while($users_all_rows= mysqli_fetch_array($users_all_res, MYSQLI_ASSOC)){
?>
					<a href="/views/user.php?userid=<?php echo $users_all_rows['id'];?>" class="list-group-item list-group-item-action d-flex gap-3 py-3">
						<i class="<?php echo $users_all_rows['icon'];?> fa-fw"></i>
						<div class="d-flex gap-2 w-100 justify-content-between">
							<h6 class="mb-0 align-self-center"><?php echo $users_all_rows['username'];?></h6>
						</div>
						<span style="width: 90px; display: block;" class="badge bg-primary rounded-pill" data-toggle="tooltip" data-placement="bottom" title="Rolle des Benutzers">
<?php 
		$stmt_sql_roles = mysqli_prepare($link, $sql_roles_single);
		mysqli_stmt_bind_param($stmt_sql_roles, "i", $users_all_rows['role']);
		mysqli_stmt_execute($stmt_sql_roles);
		$roles_all_res=mysqli_stmt_get_result($stmt_sql_roles);
		while($roles_all_rows= mysqli_fetch_array($roles_all_res, MYSQLI_ASSOC)){
			echo '							<i class="' . $roles_all_rows['icon'] . ' fa-fw"></i>' . $roles_all_rows['rolename'];
		}
		mysqli_stmt_close($stmt_sql_roles);
?>

						</span>
					</a>
<?php
		}
		mysqli_stmt_close($stmt_sql_users);
	}
	else{
		header("location: /views/index.php");
	}
?>
			</div>
<?php include("footer.php") ?>