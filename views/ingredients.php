<?php include("header.php") ?>
<?php
	if(empty($_GET['view']))
	{
		$view = "my";
	}
	else
	{
		$view = $_GET['view'];
	}
	if(empty($_GET['ingredientid']))
	{
		$ingredientid = 0;
	}
	else
	{
		$ingredientid = $_GET['ingredientid'];
	}
?>
			<nav class="navbar navbar-dark bg-primary py-1" style="margin-top: -17px;">
				<div class="container-fluid justify-content-start">
					<a href="ingredients.php?view=my" class="btn btn-primary text-uppercase<?php if($view == "my"){echo ' active" aria-current="page';}?>">
						<i class="fa-solid fa-lemon fa-fw"></i>Meine Zutaten
					</a>
					<a href="ingredients.php?view=all" class="btn btn-primary text-uppercase<?php if($view == "all"){echo ' active" aria-current="page';}?>">
						<i class="fa-solid fa-cubes-stacked fa-fw"></i>Alle Zutaten
					</a>
					<a href="ingredients.php?view=fav" class="btn btn-primary text-uppercase<?php if($view == "fav"){echo ' active" aria-current="page';}?>">
						<i class="fa-solid fa-heart fa-fw"></i>Favoriten
					</a>
				</div>
			</nav>
			<div class="list-group">
			<?php
				if($view == "my")
				{
					$stmt_sql_ingredients = mysqli_prepare($link, $sql_my_ingredients);
				}
				else if($view == "all")
				{
					$stmt_sql_ingredients = mysqli_prepare($link, $sql_all_ingredients);
				}
				else if($view == "fav")
				{
					$stmt_sql_ingredients = mysqli_prepare($link, $sql_fav_ingredients);
					mysqli_stmt_bind_param($stmt_sql_ingredients, "i", $_SESSION["id"]);
				}
				else
				{
					$stmt_sql_ingredients = mysqli_prepare($link, $sql_all_ingredients);
				}
				mysqli_stmt_execute($stmt_sql_ingredients);
				$ingredients_all_res=mysqli_stmt_get_result($stmt_sql_ingredients);
				while($ingredients_all_rows= mysqli_fetch_array($ingredients_all_res, MYSQLI_ASSOC))
				{
			?>
	<a href="ingredient.php?ingredientid=<?php echo $ingredients_all_rows['ingredients_ID'];?>" class="<?php if($ingredients_all_rows['available'] == 0){echo "bg-secondary-subtle";}else{echo "bg-primary-subtle";} ?> list-group-item list-group-item-action d-flex gap-2 py-2 d-block<?php if($ingredients_all_rows['ingredients_ID'] == $ingredientid){echo ' active" aria-current="true';}?>">
					<img loading="lazy" class="text-dark border border-secondary rounded-circle shadow-4-strong bg-white flex-shrink-0" src="../img/ingredients/png64/<?php echo $ingredients_all_rows['image'];?>" alt="<?php echo $ingredients_all_rows['ingredientname'];?>" width="48" height="48" style="text-align: center;">
					<div class="flex-grow-1 d-flex w-80 flex-nowrap align-items-center">
						<div class="d-flex-column">
							<h6><?php echo $ingredients_all_rows['ingredientname'];?></h6>
						</div>
					</div>
					<div class="ml-auto d-flex align-items-center">
						<span class="badge bg-primary rounded-pill align-items-center"><?php
							$stmt_ingredientcount_usedin = mysqli_prepare($link, $sql_ingredientcount_usedin);
							mysqli_stmt_bind_param($stmt_ingredientcount_usedin, "i", $ingredients_all_rows['ingredients_ID']);
							mysqli_stmt_execute($stmt_ingredientcount_usedin);
							$ingredientcount_usedin_all_res=mysqli_stmt_get_result($stmt_ingredientcount_usedin);
							$ingredientcount_usedin_all_rows= mysqli_fetch_assoc($ingredientcount_usedin_all_res);
							if (mysqli_num_rows($ingredientcount_usedin_all_res) == 1)
							{
								echo $ingredientcount_usedin_all_rows['total'];}?></span>
					</div>
					<div class="d-flex align-items-end">
						<i class="text-primary <?php if($ingredients_all_rows['available'] == 1){echo "fa-duotone fa-solid fa-check";}else if($ingredients_all_rows['shoppable'] == 1){echo "fa-regular fa-cart-shopping";} ?>" style="font-size:32px;"></i>
					</div>
				</a>
			<?php
				}
			?>
</div>
<?php include("footer.php") ?>