<?php include("header.php") ?>
<?php 
	$userid = 0;
	$username = "";
	$usericon = "";
	$userrole = 0;
	if(empty($_GET['userid'])){
		$userid = 0;
	}
	else{
		$userid = $_GET['userid'];
	}
	$stmt_sql_user = mysqli_prepare($link, $sql_users_singlebyid);
	mysqli_stmt_bind_param($stmt_sql_user, "i", $userid);
	mysqli_stmt_execute($stmt_sql_user);
	$user_all_res=mysqli_stmt_get_result($stmt_sql_user);
	while($user_all_rows= mysqli_fetch_array($user_all_res, MYSQLI_ASSOC)){
		$userid = $user_all_rows['id'];
		$username = $user_all_rows['username'];
		$usericon = $user_all_rows['icon'];
		$userrole = $user_all_rows['role'];
	}
	mysqli_stmt_close($stmt_sql_user);
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
				<div class="container-fluid justify-content-start">
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#newDialogUser" data-toggle="tooltip" data-placement="bottom" title="Neu">
						<i class="fa-duotone fa-solid fa-file fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#editDialogUser" data-toggle="tooltip" data-placement="bottom" title="Bearbeiten">
						<i class="fa-duotone fa-solid fa-pencil fa-fw"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1||$userid==1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#deleteDialogUser" data-toggle="tooltip" data-placement="bottom" title="Löschen">
						<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
					</button>
				</div>
			</nav>
			<div class="modal fade" id="newDialogUser">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="user_edit" action="/api/user_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><strong>Neuen Benutzer anlegen</strong></h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="categoryid" class="form-control" type="hidden" value="0" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="usericon" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="username" class="form-control form-control-lg" type="text" placeholder="Name des Benutzers" data-toggle="tooltip" data-placement="bottom" title="Name des Benutzers">
									</div>
						<select name="userrole" autocomplete="off" class="form-control w-100" data-toggle="tooltip" data-placement="bottom" title="Benutzerrolle">
<?php 
	$stmt_sql_roles = mysqli_prepare($link, $sql_roles);
	mysqli_stmt_execute($stmt_sql_roles);
	$roles_all_res=mysqli_stmt_get_result($stmt_sql_roles);
	while($roles_all_rows= mysqli_fetch_array($roles_all_res, MYSQLI_ASSOC)){
		$roleid = $roles_all_rows['id'];
		$rolename = $roles_all_rows['rolename'];
		$roleicon = $roles_all_rows['icon'];
?>
											<option value="<?php echo $roleid;?>"><?php echo $rolename;?></option>
<?php 
	}
	mysqli_stmt_close($stmt_sql_roles);
?>
							</select>
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
			<div class="modal fade" id="editDialogUser">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="user_edit" action="/api/user_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><i class="<?php echo $usericon;?> fa-2x"></i><strong> <?php echo $username;?></strong> bearbeiten</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<input name="userid" class="form-control" type="hidden" value="<?php echo $userid;?>" readonly>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="usericon" class="form-control form-control-lg" type="text" placeholder="Fontawesome 6.6.0 Pro Icon Name" data-toggle="tooltip" data-placement="bottom" title="Fontawesome 6.6.0 Pro Icon Name" value="<?php echo $userimage;?>">
									</div>
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="username" class="form-control form-control-lg" type="text" placeholder="Name des Benutzers" data-toggle="tooltip" data-placement="bottom" title="Name des Benutzers" value="<?php echo $username;?>">
									</div>
						<select name="userrole" autocomplete="off" class="form-control w-100" data-toggle="tooltip" data-placement="bottom" title="Benutzerrolle">
<?php 
	$stmt_sql_roles = mysqli_prepare($link, $sql_roles);
	mysqli_stmt_execute($stmt_sql_roles);
	$roles_all_res=mysqli_stmt_get_result($stmt_sql_roles);
	while($roles_all_rows= mysqli_fetch_array($roles_all_res, MYSQLI_ASSOC)){
		$roleid = $roles_all_rows['id'];
		$rolename = $roles_all_rows['rolename'];
		$roleicon = $roles_all_rows['icon'];
?>
											<option value="<?php echo $roleid;?>"<?php if($roleid == $userrole){echo ' selected';}?>><?php echo $rolename;?></option>
<?php 
	}
	mysqli_stmt_close($stmt_sql_roles);
?>
							</select>
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
			<div class="modal fade" id="deleteDialogUser">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"><i class="<?php echo $usericon;?> fa-2x"></i><strong> <?php echo $username;?></strong> löschen</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						</div>
						<div class="modal-body">
							<p>Möchten Sie den Benutzer <strong><?php echo $username;?></strong> wirklich löschen?</p>
							<p>Wenn Sie <strong><?php echo $username;?></strong> löschen, kann diese Aktion nicht rückgängig gemacht werden!</p>
						</div>
						<div class="modal-footer">
							<a href="user_delete.php?userid=<?php echo $userid;?>" class="btn btn-danger<?php if($_SESSION["role"] != 1){echo ' disabled';}?>">Trotzdem löschen</a>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
						</div>
					</div>
				</div>
			</div>
			<form action="/api/user_save.php" method="POST">
				<fieldset>
					<div class="d-flex gap-3 p-3 flex-row justify-content-center">
						<i class="<?php echo $userimage;?> fa-4x"></i>
						<input name="usericon" class="form-control" type="hidden" value="<?php echo $usericon;?>" autocomplete="off" spellcheck="false" readonly>
						<input name="userid" class="form-control" type="hidden" value="<?php echo $userid;?>" readonly>
						<input name="username" class="form-control" type="text" placeholder="Name des Benutzers" value="<?php echo $username;?>" readonly>
					</div>
					<div class="d-flex p-3 justify-content-around flex-wrap">
						<select name="userrole" autocomplete="off" class="form-control w-100" data-toggle="tooltip" data-placement="bottom" title="Benutzerrolle" disabled>
<?php 
	$stmt_sql_roles = mysqli_prepare($link, $sql_roles);
	mysqli_stmt_execute($stmt_sql_roles);
	$roles_all_res=mysqli_stmt_get_result($stmt_sql_roles);
	while($roles_all_rows= mysqli_fetch_array($roles_all_res, MYSQLI_ASSOC)){
		$roleid = $roles_all_rows['id'];
		$rolename = $roles_all_rows['rolename'];
		$roleicon = $roles_all_rows['icon'];
?>
											<option value="<?php echo $roleid;?>"<?php if($roleid == $userrole){echo ' selected';}?>><?php echo $rolename;?></option>
<?php 
	}
	mysqli_stmt_close($stmt_sql_roles);
?>
							</select>
						</div>
				</fieldset>
			</form>
<?php include("footer.php") ?>