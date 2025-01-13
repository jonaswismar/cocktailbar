<?php include("header.php") ?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px">
				<div class="scrolling-wrapper-flexbox">
					<a href="/views/units.php" class="btn btn-primary text-uppercase active" aria-current="page" data-toggle="tooltip" data-placement="bottom" title="Maß-Einheiten">
						<i class="fa fa-fw fa-solid fa-ruler"></i> Einheiten
					</a>
				</div>
			</nav>
			<div class="d-flex align-items-center justify-content-center">
				<div class="list-group flex-fill">
<?php 
	
	$stmt_sql_units = mysqli_prepare($link, $sql_units);
	mysqli_stmt_execute($stmt_sql_units);
	$units_all_res=mysqli_stmt_get_result($stmt_sql_units);
	while($units_all_rows= mysqli_fetch_array($units_all_res, MYSQLI_ASSOC))
	{
?>
						<a href="/views/unit.php?unitid=<?php echo $units_all_rows['ID'];?>" class="list-group-item list-group-item-action d-flex gap-3 py-3">
							<i class="fa-fw <?php echo $units_all_rows['icon'];?>"></i>
							<div class="d-flex gap-2 w-100 justify-content-between">
								<h6 class="mb-0"><?php echo $units_all_rows['unitname'];?></h6>
							</div>
						</a>
<?php
	}
	mysqli_stmt_close($stmt_sql_units);
?>
				</div>
			</div>
<?php include("footer.php") ?>