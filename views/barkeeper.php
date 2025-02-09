<?php include("header.php") ?>
<?php 
	$barid = 0;
	if(empty($_GET['barid'])){
		$barid = 0;
	}
	else{
		$barid = $_GET['barid'];
	}
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
				<div class="container-fluid justify-content-start">
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#newDialogBarkeeper" data-toggle="tooltip" data-placement="bottom" title="Neu">
						<i class="fa-duotone fa-solid fa-file fa-fw"></i>
					</button>
				</div>
			</nav>
			<div class="modal fade" id="newDialogBarkeeper">
				<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
					<div class="modal-content">
						<form id="cocktailingredient_edit" action="/api/barkeeper_save.php">
							<fieldset>
								<div class="modal-header">
									<h4 class="modal-title"><strong>Neuen Barkeeper zuordnen</strong></h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<div class="d-flex p-3 justify-content-around flex-wrap">
										<input name="barkeeperid" class="form-control" type="hidden" value="0" readonly>
										<input name="barid" class="form-control" type="hidden" value="<?php echo $barid;?>" readonly>
										<select name="userid" autocomplete="off" class="form-control w-100" data-toggle="tooltip" data-placement="bottom" title="Benutzer" required>
<?php 
	$stmt_sql_barkeepers = mysqli_prepare($link, $sql_users_barkeeper);
	mysqli_stmt_execute($stmt_sql_barkeepers);
	$barkeepers_all_res=mysqli_stmt_get_result($stmt_sql_barkeepers);
	while($barkeepers_all_rows= mysqli_fetch_array($barkeepers_all_res, MYSQLI_ASSOC)){
		$userid = $barkeepers_all_rows['id'];
		$username = $barkeepers_all_rows['username'];
?>
												<option value="<?php echo $userid;?>"><?php echo $username;?></option>
<?php
	}
	mysqli_stmt_close($stmt_sql_barkeepers);
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
			<div class="list-group">
				<li class="list-group-item list-group-item-primary">Barkeeper</li>
<?php
	$stmt_sql_barkeepers = mysqli_prepare($link, $sql_barkeeper_bar);
	mysqli_stmt_bind_param($stmt_sql_barkeepers, "i", $barid);
	mysqli_stmt_execute($stmt_sql_barkeepers);
	$barkeepers_all_res=mysqli_stmt_get_result($stmt_sql_barkeepers);
	while($barkeepers_all_rows= mysqli_fetch_array($barkeepers_all_res, MYSQLI_ASSOC)){
?>
				<div class="list-group-item list-group-item-action d-flex gap-2 py-2 d-block">
					<i class="<?php echo $barkeepers_all_rows['icon'];?> fa-fw fa-4x"></i>
					<p class="mb-0 align-self-center text-size-h6"><?php echo $barkeepers_all_rows['username'];?></p>
					<div class="flex-grow-1 d-flex gap-2 w-25 flex-nowrap"></div>
					<form class="align-self-center" action="/api/barkeeper_save.php">
						<fieldset class="row">
							<div class="align-self-center gap-0">
								<input name="barid" class="form-control" type="hidden" value="<?php echo $barid;?>" readonly>
								<input name="barkeeperid" class="form-control" type="hidden" value="<?php echo $barkeepers_all_rows['id'];?>" readonly>
								<input name="userid" class="form-control" type="hidden" value="<?php echo $ingred_all_rows['user'];?>" readonly>
							</div>
							<div class="align-self-center gap-0 col-2">
								<a href="/api/barkeeper_delete.php?barkeeperid=<?php echo $barkeepers_all_rows['id'];?>" class="btn btn-danger">Löschen</a>
							</div>
						</fieldset>
					</form>
				</div>
				<?php
} ?>
			</div>
<?php include("footer.php") ?>