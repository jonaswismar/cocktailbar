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
				$sub_ingredients_show_quantity=false;
				$sub_ingredients_show_count=true;
				include("sublist_ingredients.php")
			?>
</div>
<?php include("footer.php") ?>