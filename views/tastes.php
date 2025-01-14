<?php include("header.php") ?>
			<div class="d-flex align-items-center justify-content-center">
				<div class="list-group flex-fill">
					<?php 
						$stmt_sql_tastes = mysqli_prepare($link, $sql_tastes);
						mysqli_stmt_execute($stmt_sql_tastes);
						$tastes_all_res=mysqli_stmt_get_result($stmt_sql_tastes);
						while($tastes_all_rows= mysqli_fetch_array($tastes_all_res, MYSQLI_ASSOC))
						{
					?>
						<a href="taste.php?tasteid=<?php echo $tastes_all_rows['ID'];?>" class="list-group-item list-group-item-action d-flex gap-3 py-3">
							<i class="<?php echo $tastes_all_rows['image'];?> fa-fw"></i>
							<div class="d-flex gap-2 w-100 justify-content-between">
								<h6 class="mb-0"><?php echo $tastes_all_rows['taste'];?></h6>
							</div>
							<span class="badge bg-primary rounded-pill"><?php echo $tastes_all_rows['total_cocktails'];?></span>
						</a>
					<?php
						}
						mysqli_stmt_close($stmt_sql_tastes);
						mysqli_close($link);
					?>
				</div>
			</div>
<?php include("footer.php") ?>