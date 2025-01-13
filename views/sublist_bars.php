<?php
	$bars_all_res=mysqli_stmt_get_result($stmt_sql_bars);
	while($bars_all_rows= mysqli_fetch_array($bars_all_res, MYSQLI_ASSOC)){
		$barid = $bars_all_rows['ID'];
		$barname = $bars_all_rows['barname'];
		$baricon = $bars_all_rows['icon'];
?>
				<a href="/views/bar.php?barid=<?php echo $barid; ?>" class="list-group-item list-group-item-action d-flex gap-2 py-2 d-block">
					<i class="fa fa-fw fa-solid <?php echo $baricon; ?> fa-4x"></i>
					<div class="flex-grow-1 d-flex gap-2 w-75 flex-nowrap">
						<div class="d-flex-column">
							<p class="mb-0 text-size-h6"><?php echo $barname; ?></p>
						</div>
					</div>
				</a>
<?php
	}
?>