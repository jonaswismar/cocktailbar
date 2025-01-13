<?php include("header.php") ?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px">
				<div class="scrolling-wrapper-flexbox">
					<a href="categorys.php" class="btn btn-primary text-uppercase active" aria-current="page" data-toggle="tooltip" data-placement="bottom" title="Bar Werkzeuge">
						<i class="fa fa-fw fa-solid fa-screwdriver-wrench"></i> Werkzeuge
					</a>
				</div>
			</nav>
			<div class="d-flex align-items-center justify-content-center">
				<div class="list-group flex-fill">
<?php 
	$stmt_sql_tools = mysqli_prepare($link, $sql_tools);
	mysqli_stmt_execute($stmt_sql_tools);
	$tools_all_res=mysqli_stmt_get_result($stmt_sql_tools);
	while($tools_all_rows= mysqli_fetch_array($tools_all_res, MYSQLI_ASSOC))
	{
?>
						<a href="/views/tool.php?toolid=<?php echo $tools_all_rows['ID'];?>" class="list-group-item list-group-item-action d-flex gap-3 py-3">
							<i class="<?php echo $tools_all_rows['icon'];?> fa-fw"></i>
							<div class="d-flex gap-2 w-100 justify-content-between">
								<h6 class="mb-0"><?php echo $tools_all_rows['toolname'];?></h6>
							</div>
							<span style="width: 50px; display: block;" class="badge bg-primary rounded-pill" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tools_all_rows['total_cocktails'];?> Cocktails die <?php echo $tools_all_rows['toolname'];?> benötigen"><?php echo $tools_all_rows['total_cocktails'];?></span>
						</a>
<?php
	}
	mysqli_stmt_close($stmt_sql_tools);
?>
				</div>
			</div>
<?php include("footer.php") ?>