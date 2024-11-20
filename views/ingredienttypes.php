<?php include("header.php") ?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px">
			<div class="scrolling-wrapper-flexbox">
				<a href="ingredienttypes.php" class="btn btn-primary text-uppercase active" aria-current="page">
					<i class="fa fa-fw fa-solid fa-cubes-stacked"></i> Zutatentypen
				</a>
			</div>
		</nav>
			<div class="d-flex align-items-center justify-content-center">
				<div class="list-group flex-fill">
					<?php 
						$stmt_sql_ingredienttypes = mysqli_prepare($link, $sql_ingredienttypes);
						mysqli_stmt_execute($stmt_sql_ingredienttypes);
						$ingredienttypes_all_res=mysqli_stmt_get_result($stmt_sql_ingredienttypes);
						while($ingredienttypes_all_rows= mysqli_fetch_array($ingredienttypes_all_res, MYSQLI_ASSOC))
						{
					?>
						<a href="ingredienttype.php?ingredienttypeid=<?php echo $ingredienttypes_all_rows['ID'];?>" class="list-group-item list-group-item-action d-flex gap-3 py-3">
							<i class="<?php echo $ingredienttypes_all_rows['image'];?> fa-fw"></i>
							<div class="d-flex gap-2 w-100 justify-content-between">
								<h6 class="mb-0"><?php echo $ingredienttypes_all_rows['typename'];?></h6>
							</div>
							<span class="badge bg-primary rounded-pill"><?php echo $ingredienttypes_all_rows['total_ingredients'];?></span>
						</a>
					<?php
						}
						mysqli_stmt_close($stmt_sql_ingredienttypes);
						mysqli_close($link);
					?>
				</div>
			</div>
<?php include("footer.php") ?>