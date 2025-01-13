<?php include("header.php") ?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px">
				<div class="scrolling-wrapper-flexbox">
					<a href="/views/tastes.php" class="btn btn-primary text-uppercase active" aria-current="page" data-toggle="tooltip" data-placement="bottom" title="Geschmackrichtungen für Cocktails und Zutaten">
						<i class="fa fa-fw fa-solid fa-lemon"></i> Geschmacksrichtungen
					</a>
				</div>
			</nav>
			<div class="d-flex align-items-center justify-content-center">
				<div class="list-group flex-fill">
<?php 
	$stmt_sql_tastes = mysqli_prepare($link, $sql_tastes);
	mysqli_stmt_execute($stmt_sql_tastes);
	$tastes_all_res=mysqli_stmt_get_result($stmt_sql_tastes);
	while($tastes_all_rows= mysqli_fetch_array($tastes_all_res, MYSQLI_ASSOC))
	{
?>
					<a href="/views/taste.php?tasteid=<?php echo $tastes_all_rows['ID'];?>" class="list-group-item list-group-item-action d-flex gap-3 py-3">
						<i class="<?php echo $tastes_all_rows['icon'];?> fa-fw"></i>
						<div class="d-flex gap-2 w-100 justify-content-between">
							<h6 class="mb-0"><?php echo $tastes_all_rows['taste'];?></h6>
						</div>
						<span style="width: 50px; display: block;" class="badge bg-primary rounded-pill" data-toggle="tooltip" data-placement="bottom" title="Cocktails"><?php echo $tastes_all_rows['cocktail_count'];?></span>
						<span style="width: 50px; display: block;" class="badge bg-secondary rounded-pill" data-toggle="tooltip" data-placement="bottom" title="Zutaten"><?php echo $tastes_all_rows['ingredient_count'];?></span>
					</a>
<?php
	}
	mysqli_stmt_close($stmt_sql_tastes);
?>
				</div>
			</div>
<?php include("footer.php") ?>