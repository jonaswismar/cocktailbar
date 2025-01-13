<?php include("header.php") ?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px">
				<div class="scrolling-wrapper-flexbox">
					<a href="/views/users.php" class="btn btn-primary text-uppercase active" aria-current="page" data-toggle="tooltip" data-placement="bottom" title="Benutzer">
						<i class="fa fa-fw fa-solid fa-users"></i> Benutzer
					</a>
				</div>
			</nav>
			<div class="d-flex align-items-center justify-content-center">
				<div class="list-group flex-fill">
<?php 
	if($_SESSION["role"] == 1){
		$stmt_sql_users = mysqli_prepare($link, $sql_users);
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
			</div>
<?php include("footer.php") ?>