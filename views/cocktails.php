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
	if(empty($_GET['cocktailid']))
	{
		$cocktailid = 0;
	}
	else
	{
		$cocktailid = $_GET['cocktailid'];
	}
?>
			<nav class="navbar navbar-dark bg-primary py-1" style="margin-top: -17px;">
				<div class="container-fluid justify-content-start">
					<a href="cocktails.php?view=my" class="btn btn-primary text-uppercase<?php if($view == "my"){echo ' active" aria-current="page';}?>">
						<i class="fa-solid fa-fw fa-martini-glass-citrus"></i>Meine Cocktails
					</a>
					<a href="cocktails.php?view=all" class="btn btn-primary text-uppercase<?php if($view == "all"){echo ' active" aria-current="page';}?>">
						<i class="fa-solid fa-fw fa-martini-glass"></i>Alle Cocktails
					</a>
					<a href="cocktails.php?view=fav" class="btn btn-primary text-uppercase<?php if($view == "fav"){echo ' active" aria-current="page';}?>">
						<i class="fa-solid fa-fw fa-heart"></i>Favoriten
					</a>
				</div>
			</nav>
			<div class="list-group">
<?php
				if($view == "my")
				{
					$stmt_sql_cocktails = mysqli_prepare($link, $sql_my_cocktails);
				}
				else if($view == "all")
				{
					$stmt_sql_cocktails = mysqli_prepare($link, $sql_all_cocktails);
				}
				else if($view == "fav")
				{
					$stmt_sql_cocktails = mysqli_prepare($link, $sql_fav_cocktails);
					mysqli_stmt_bind_param($stmt_sql_cocktails, "i", $_SESSION["id"]);
				}
				else
				{
					$stmt_sql_cocktails = mysqli_prepare($link, $sql_all_cocktails);
				}
				mysqli_stmt_execute($stmt_sql_cocktails);
				$cocktails_all_res=mysqli_stmt_get_result($stmt_sql_cocktails);
				while($cocktails_all_rows= mysqli_fetch_array($cocktails_all_res, MYSQLI_ASSOC))
				{
					$stmtingred = mysqli_prepare($link, $sql_ingredients_from_cocktail);
					mysqli_stmt_bind_param($stmtingred, "i", $cocktails_all_rows['ID']);
					mysqli_stmt_execute($stmtingred);
					$ingred_all_res=mysqli_stmt_get_result($stmtingred);
					
					$ingredlist = "";
					$cockavail = 1;
					$cockbuy = 1;
					$cockfav = 0;
					if(mysqli_num_rows($ingred_all_res) > 0)
					{
						while($ingred_all_rows= mysqli_fetch_array($ingred_all_res, MYSQLI_ASSOC))
						{
							$ingredlist = $ingredlist . $ingred_all_rows['ingredientname'] . ", ";
							if($ingred_all_rows['available'] == 0 and $ingred_all_rows['garnish'] == 0 and $ingred_all_rows['optional'] == 0)
							{
								$cockavail = 0;
								if($ingred_all_rows['shoppable'] == 0)
								{
									$cockbuy = 0;
								}
							}
						}
					}
					else
					{
						$cockavail = 0;
						$cockbuy = 0;
					}
					$ingredlist = rtrim($ingredlist, ' ');
					$ingredlist = rtrim($ingredlist, ',');
					$favorites_stmt = mysqli_prepare($link, $sql_cocktailfavorites);
					mysqli_stmt_bind_param($favorites_stmt, "i", $_SESSION["id"]);
					mysqli_stmt_execute($favorites_stmt);
					$favorites_all_res=mysqli_stmt_get_result($favorites_stmt);
					while($favorites_all_rows= mysqli_fetch_array($favorites_all_res, MYSQLI_ASSOC))
					{
						if($cocktails_all_rows['ID'] == $favorites_all_rows['cocktail'])
						{
							$cockfav = 1;
						}
					}?>
						<a href="cocktail.php?cocktailid=<?php echo $cocktails_all_rows['ID'];?>" class="<?php if($cockavail == 0){echo "bg-secondary-subtle";}else{echo "bg-primary-subtle";} ?> list-group-item list-group-item-action d-flex gap-2 py-2 d-block<?php if($cocktails_all_rows['ID'] == $cocktailid){echo ' active" aria-current="true';}?>">
							<img loading="lazy" class="text-dark border border-secondary rounded-circle shadow-4-strong bg-white flex-shrink-0" src="../img/cocktails/png64/<?php echo $cocktails_all_rows['image'];?>" alt="<?php echo $cocktails_all_rows['cocktailname'];?>" width="48" height="48" style="text-align: center;">
							<div class="flex-grow-1 d-flex gap-2 w-80 flex-nowrap">
								<div class="d-flex-column">
									<h6 class="mb-0"><?php echo $cocktails_all_rows['cocktailname'];?></h6>
									<p class="mb-0 opacity-75 text-truncate textcalcoffset"><?php echo $ingredlist;?></p>
								</div>
							</div>
							<div class="d-flex-column align-items-stretch">
								<i class="bi text-primary <?php if($cockavail == 1){echo "bi-check-lg";}else if($cockbuy == 1){echo "bi-cart";} ?>" style="font-size:32px;"></i>
								<i class="bi text-info bi-heart-fill<?php if($cockfav == 0){echo " d-none";} ?>" style="font-size:14px;"></i>
							</div>
						</a>
<?php
				}
			?>
</div>
<?php include("footer.php") ?>