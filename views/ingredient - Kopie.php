<?php include("header.php") ?>
			<?php 
				$id = "";
				$ingredientname = "";
				$available = "";
				$shoppable = "";
				$description = "";
				$image = "";
				$type = "";
				
				if(empty($_GET['ingredientid']))
				{
					$ingredientid = 0;
				}
				else
				{
					$ingredientid = $_GET['ingredientid'];
				}
				if(empty($_GET['edit']))
				{
					$edit = 0;
				}
				else
				{
					$edit = $_GET['edit'];
				}
				if($_SESSION["role"] != 1)
				{
					$edit = 0;
				}
				$stmt_sql_ingredient = mysqli_prepare($link, $sql_ingredient);
				mysqli_stmt_bind_param($stmt_sql_ingredient, "i", $ingredientid);
				mysqli_stmt_execute($stmt_sql_ingredient);
				$ingredient_all_res=mysqli_stmt_get_result($stmt_sql_ingredient);
				while($ingredient_all_rows= mysqli_fetch_array($ingredient_all_res, MYSQLI_ASSOC))
				{
					$id = $ingredient_all_rows['ingredients_ID'];
					$ingredientname = $ingredient_all_rows['ingredientname'];
					$available = $ingredient_all_rows['available'];
					$shoppable = $ingredient_all_rows['shoppable'];
					$description = $ingredient_all_rows['description'];
					$image = $ingredient_all_rows['image'];
					$type = $ingredient_all_rows['type'];
				}
				mysqli_stmt_close($stmt_sql_ingredient);
			?>
				<nav class="navbar navbar-dark bg-primary py-1" style="margin-top: -17px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
					<div class="container-fluid justify-content-start">
						<a href="ingredient.php?ingredientid=0&edit=2" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}else{if($edit == 1 || $edit == 2){echo ' disabled';}}?>">
							<i class="fa-duotone fa-solid fa-file fa-fw"></i>
						</a>
						<a href="ingredient.php?ingredientid=<?php echo $id . '&edit=';if($_SESSION["role"] != 1){echo '0';}else{if($edit == 1){echo '0';}else{echo '1';}} ?>" class="btn btn-primary<?php if($edit == 2){echo ' disabled';}?>">
							<i class="fa-duotone fa-solid fa-pencil fa-fw<?php if($_SESSION["role"] != 1){echo ' fa-swap-opacity';}else{if($edit == 1){echo ' fa-swap-opacity';}} ?>"></i>
						</a>
						<a href="ingredient_delete.php?ingredientid=<?php echo $id;?>" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}else{if($edit == 1 || $edit == 2){echo ' disabled';}} ?>">
							<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
						</a>
					</div>
				</nav>
				<form action="ingredient_save.php" method="POST">
					<fieldset>
						<div class="d-flex gap-3 p-3 flex-row justify-content-center">
							<input name="ingredientid" class="form-control" type="hidden" value="<?php echo $id;?>"<?php if($edit == 0){echo ' readonly';}?>>
							<input name="available" class="form-control" type="hidden" value="<?php echo $available;?>"<?php if($edit == 0){echo ' readonly';}?>>
							<input name="shoppable" class="form-control" type="hidden" value="<?php echo $shoppable;?>"<?php if($edit == 0){echo ' readonly';}?>>
							<input name="ingredientname" class="form-control form-control-lg" type="text" placeholder="Name der Zutat" value="<?php echo $ingredientname;?>"<?php if($edit == 0){echo ' readonly';}?>>
							<div class="btn-group">
								<a href="ingredient_save.php?ingredientid=<?php echo $id;?>&available=<?php if($available == 0){echo '1';}else{echo '0';}?>" class="btn btn-primary"><i class="fa-fw fa-2x <?php if($available == 0){echo 'fa-regular fa-square';}else{echo 'fa-duotone fa-solid fa-square-check';}?>"></i></a>
								<a href="ingredient_save.php?ingredientid=<?php echo $id;?>&shoppable=<?php if($shoppable == 0){echo '1';}else{echo '0';}?>" class="btn btn-primary"><i class="fa-fw fa-2x <?php if($shoppable == 0){echo 'fa-regular fa-cart-shopping';}else{echo 'fa-duotone fa-solid fa-cart-shopping';}?>"></i></a>
							</div>
						</div>
						<div class="d-flex justify-content-center">
							<input name="image" class="form-control" type="hidden" value="<?php echo $image;?>"<?php if($edit == 0){echo ' readonly';}?>>
							<img loading="lazy" class="text-dark rounded-circle bg-white flex-shrink-0" src="../img/ingredients/<?php echo $image;?>" alt="<?php echo $ingredientname;?>" width="128" height="128" style="text-align: center;">
						</div>
						<div class="d-flex gap-3 p-3 flex-row justify-content-center">
							<select id="input-tags-ingredienttype" name="ingredienttype" multiple autocomplete="off" class="form-control w-25"<?php if($edit == 0){echo ' disabled';}?>>
							<?php 
								$stmt_sql_ingredienttypes = mysqli_prepare($link, $sql_ingredienttypes);
								mysqli_stmt_execute($stmt_sql_ingredienttypes);
								$ingredienttypes_all_res=mysqli_stmt_get_result($stmt_sql_ingredienttypes);
								while($ingredienttypes_all_rows= mysqli_fetch_array($ingredienttypes_all_res, MYSQLI_ASSOC))
								{
									$typeid = $ingredienttypes_all_rows['ID'];
									$typename = $ingredienttypes_all_rows['typename'];
									$typeimage = $ingredienttypes_all_rows['image'];
									
							?>
								<option value="<?php echo $typeid;?>" data-src="<?php echo $typeimage;?>"<?php if($typeid == $type){echo ' selected';}?>><?php echo $typename;?></option>
							<?php 
				}
				mysqli_stmt_close($stmt_sql_ingredienttypes);
				?>
				</select>
						</div>
						<div class="d-flex p-3 justify-content-around flex-wrap">
							<textarea name="description" class="form-control auto-resize" type="text" placeholder="Beschreibung der Kategorie" rows="25"<?php if($edit == 0){echo ' readonly';}?>><?php echo $description;?></textarea>
						</div>
						<div class="d-flex p-3 justify-content-around flex-wrap">
							<input class="btn btn-primary" type="submit"<?php if($edit == 0){echo ' hidden';}?>>
					</fieldset>
				</form>
				<div class="list-group"><?php
						$stmt_sql_ingredient_usedin = mysqli_prepare($link, $sql_ingredient_usedin);
						mysqli_stmt_bind_param($stmt_sql_ingredient_usedin, "i", $ingredientid);
						mysqli_stmt_execute($stmt_sql_ingredient_usedin);
						$ingredient_usedin_all_res=mysqli_stmt_get_result($stmt_sql_ingredient_usedin);
						while($ingredient_usedin_all_rows= mysqli_fetch_array($ingredient_usedin_all_res, MYSQLI_ASSOC))
						{
							$stmt_sql_cocktail = mysqli_prepare($link, $sql_cocktail);
							mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $ingredient_usedin_all_rows['ID']);
							mysqli_stmt_execute($stmt_sql_cocktail);
							$cocktail_all_res=mysqli_stmt_get_result($stmt_sql_cocktail);
							while($cocktail_all_rows= mysqli_fetch_array($cocktail_all_res, MYSQLI_ASSOC))
							{
								
								$stmtingred = mysqli_prepare($link, $sql_ingredients_from_cocktail);
								mysqli_stmt_bind_param($stmtingred, "i", $ingredient_usedin_all_rows['ID']);
								mysqli_stmt_execute($stmtingred);
								$ingred_all_res=mysqli_stmt_get_result($stmtingred);
								
								$ingredlist = "";
								$cockavail = 1;
								$cockbuy = 1;
								$cockfav = 0;
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
								$ingredlist = rtrim($ingredlist, ' ');
								$ingredlist = rtrim($ingredlist, ',');
								$favorites_stmt = mysqli_prepare($link, $sql_cocktailfavorites);
								mysqli_stmt_bind_param($favorites_stmt, "i", $_SESSION["id"]);
								mysqli_stmt_execute($favorites_stmt);
								$favorites_all_res=mysqli_stmt_get_result($favorites_stmt);
								while($favorites_all_rows= mysqli_fetch_array($favorites_all_res, MYSQLI_ASSOC))
								{
									if($ingredient_usedin_all_rows['ID'] == $favorites_all_rows['cocktail'])
									{
										$cockfav = 1;
									}
								}?>

								<a href="cocktail.php?&cocktailid=<?php echo $ingredient_usedin_all_rows['ID'];?>" class="<?php if($cockavail == 0){echo "bg-secondary-subtle";}else{echo "bg-primary-subtle";} ?> list-group-item list-group-item-action d-flex gap-2 py-2 d-block">
									<img loading="lazy" class="text-dark border border-secondary rounded-circle shadow-4-strong bg-white flex-shrink-0" src="../img/cocktails/<?php echo $cocktail_all_rows['image'];?>" alt="<?php echo $cocktail_all_rows['cocktailname'];?>" width="48" height="48">
									<div class="flex-grow-1 d-flex gap-2 w-80 flex-nowrap">
										<div class="d-flex-column">
											<h6 class="mb-0"><?php echo $cocktail_all_rows['cocktailname'];?></h6>
											<p class="mb-0 opacity-75 text-truncate textcalcoffset"><?php echo $ingredlist;?></p>
										</div>
									</div>
									<div class="d-flex-column align-items-stretch">
										<i class="bi text-primary <?php if($cockavail == 1){echo "bi-check-lg";}else if($cockbuy == 1){echo "bi-cart";} ?>" style="font-size:32px;"></i>
										<i class="bi text-info bi-heart-fill<?php if($cockfav == 0){echo " d-none";} ?>" style="font-size:14px;"></i>
									</div>
						</a><?php } }?>
				</div>
				
<?php include("footer.php") ?>