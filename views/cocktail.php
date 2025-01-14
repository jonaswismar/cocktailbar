<?php include("header.php") ?>
			<?php 
				$id = "";
				$cocktailname = "";
				$description = "";
				$glass = "";
				$instruction = "";
				$image = "";
				$ordered = 0;
				$favorite = 0;
				
				if(empty($_GET['cocktailid']))
				{
					$cocktailid = 0;
				}
				else
				{
					$cocktailid = $_GET['cocktailid'];
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
				$stmt_sql_cocktail = mysqli_prepare($link, $sql_cocktail);
				mysqli_stmt_bind_param($stmt_sql_cocktail, "i", $cocktailid);
				mysqli_stmt_execute($stmt_sql_cocktail);
				$cocktail_all_res=mysqli_stmt_get_result($stmt_sql_cocktail);
				while($cocktail_all_rows= mysqli_fetch_array($cocktail_all_res, MYSQLI_ASSOC))
				{
					$id = $cocktail_all_rows['ID'];
					$cocktailname = $cocktail_all_rows['cocktailname'];
					$description = $cocktail_all_rows['description'];
					$glass = $cocktail_all_rows['glass'];
					$instruction = $cocktail_all_rows['instruction'];
					$image = $cocktail_all_rows['image'];
				}
				mysqli_stmt_close($stmt_sql_cocktail);
				$stmt_sql_favorite = mysqli_prepare($link, $sql_favorite_cocktail);
				mysqli_stmt_bind_param($stmt_sql_favorite, "ii", $_SESSION["id"], $cocktailid);
				mysqli_stmt_execute($stmt_sql_favorite);
				$favorite_all_res=mysqli_stmt_get_result($stmt_sql_favorite);
				while($favorite_all_rows= mysqli_fetch_array($favorite_all_res, MYSQLI_ASSOC))
				{
					$favorite = 1;
				}
				mysqli_stmt_close($stmt_sql_favorite);
				
				
				$stmt_sql_ordered = mysqli_prepare($link, $sql_ordered_cocktail);
				mysqli_stmt_bind_param($stmt_sql_ordered, "ii", $_SESSION["id"], $cocktailid);
				mysqli_stmt_execute($stmt_sql_ordered);
				$ordered_all_res=mysqli_stmt_get_result($stmt_sql_ordered);
				while($ordered_all_rows= mysqli_fetch_array($ordered_all_res, MYSQLI_ASSOC))
				{
					$ordered = 1;
				}
				mysqli_stmt_close($stmt_sql_ordered);
				?>
				<nav class="navbar navbar-dark bg-primary py-1" style="margin-top: -17px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
					<div class="container-fluid justify-content-start">
						<a href="cocktail.php?cocktailid=0&edit=2" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}else{if($edit == 1 || $edit == 2){echo ' disabled';}}?>">
							<i class="fa-duotone fa-solid fa-file fa-fw"></i>
						</a>
						<a href="cocktail.php?cocktailid=<?php echo $id . '&edit=';if($_SESSION["role"] != 1){echo '0';}else{if($edit == 1){echo '0';}else{echo '1';}} ?>" class="btn btn-primary<?php if($edit == 2){echo ' disabled';}?>">
							<i class="fa-duotone fa-solid fa-pencil fa-fw<?php if($_SESSION["role"] != 1){echo ' fa-swap-opacity';}else{if($edit == 1){echo ' fa-swap-opacity';}} ?>"></i>
						</a>
						<a href="cocktail_delete.php?cocktailid=<?php echo $id;?>" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}else{if($edit == 1 || $edit == 2){echo ' disabled';}} ?>">
							<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
						</a>
					</div>
				</nav>
				<form action="cocktail_save.php" method="POST">
					<fieldset>
						<div class="d-flex gap-3 p-3 flex-row justify-content-center">
							<input name="userid" class="form-control" type="hidden" value="<?php echo $_SESSION["id"];?>" readonly>
							<input name="cocktailid" class="form-control" type="hidden" value="<?php echo $id;?>"<?php if($edit == 0){echo ' readonly';}?>>
							<input name="ordered" class="form-control" type="hidden" value="<?php echo $ordered;?>"<?php if($edit == 0){echo ' readonly';}?>>
							<input name="favorite" class="form-control" type="hidden" value="<?php echo $favorite;?>"<?php if($edit == 0){echo ' readonly';}?>>
							<input name="cocktailname" class="form-control form-control-lg" type="text" placeholder="Name des Cocktails" value="<?php echo $cocktailname;?>"<?php if($edit == 0){echo ' readonly';}?>>
							<div class="btn-group">
								<a href="cocktail_save.php?cocktailid=<?php echo $id;?>&ordered=<?php if($ordered == 0){echo '1';}else{echo '0';}?>" class="btn btn-primary"><i class="fa-fw fa-2x <?php if($ordered == 0){echo 'fa-regular fa-bag-shopping';}else{echo 'fa-solid fa-bag-shopping';}?>"></i></a>
								<a href="cocktail_save.php?cocktailid=<?php echo $id;?>&favorite=<?php if($favorite == 0){echo '1';}else{echo '0';}?>" class="btn btn-primary"><i class="fa-fw fa-2x <?php if($favorite == 0){echo 'fa-regular fa-heart';}else{echo 'fa-solid fa-heart';}?>"></i></a>
							</div>
						</div>
						<div class="d-flex justify-content-center">
							<input name="image" class="form-control" type="hidden" value="<?php echo $image;?>"<?php if($edit == 0){echo ' readonly';}?>>
							<picture>
								<source srcset="../img/cocktails/webp700/<?php echo $image;?>.webp" type="image/webp" media="(min-width: 3840px)">
								<source srcset="../img/cocktails/webp512/<?php echo $image;?>.webp" type="image/webp" media="(min-width: 1600px)">
								<source srcset="../img/cocktails/webp256/<?php echo $image;?>.webp" type="image/webp" media="(min-width: 960px)">
								<source srcset="../img/cocktails/webp128/<?php echo $image;?>.webp" type="image/webp">
								<source srcset="../img/cocktails/png700/<?php echo $image;?>.png" type="image/png" media="(min-width: 3840px)">
								<source srcset="../img/cocktails/png512/<?php echo $image;?>.png" type="image/png" media="(min-width: 1600px)">
								<source srcset="../img/cocktails/png256/<?php echo $image;?>.png" type="image/png" media="(min-width: 960px)">
								<source srcset="../img/cocktails/png128/<?php echo $image;?>.png" type="image/png">
								<source srcset="../img/cocktails/webp700/<?php echo $glass;?>.webp" type="image/webp" media="(min-width: 3840px)">
								<source srcset="../img/cocktails/webp512/<?php echo $glass;?>.webp" type="image/webp" media="(min-width: 1600px)">
								<source srcset="../img/cocktails/webp256/<?php echo $glass;?>.webp" type="image/webp" media="(min-width: 960px)">
								<source srcset="../img/cocktails/webp128/<?php echo $glass;?>.webp" type="image/webp">
								<source srcset="../img/cocktails/jpg700/<?php echo $glass;?>.jpg" type="image/jpg" media="(min-width: 3840px)">
								<source srcset="../img/cocktails/jpg512/<?php echo $glass;?>.jpg" type="image/jpg" media="(min-width: 1600px)">
								<source srcset="../img/cocktails/jpg256/<?php echo $glass;?>.jpg" type="image/jpg" media="(min-width: 960px)">
								<source srcset="../img/cocktails/jpg128/<?php echo $glass;?>.jpg" type="image/jpg">
								<img loading="lazy" src="../img/glassware/jpg128/<?php echo $glass;?>.jpg" alt="<?php echo $cocktailname;?>" class="border border-secondary text-dark rounded-circle bg-white flex-shrink-0" style="text-align: center;">
							</picture>
						</div>
						<div class="d-flex gap-3 p-3 flex-row justify-content-center">
							<select id="input-tags-cocktailcategory" name="cocktailcategory[]" autocomplete="off" multiple class="form-control w-50"<?php if($edit == 0){echo ' disabled';}?>>
							<?php 
							$stmt_sql_categorys = mysqli_prepare($link, $sql_categorys);
							mysqli_stmt_execute($stmt_sql_categorys);
							$categorys_all_res=mysqli_stmt_get_result($stmt_sql_categorys);
							while($categorys_all_rows= mysqli_fetch_array($categorys_all_res, MYSQLI_ASSOC))
							{
								$categoryid = $categorys_all_rows['ID'];
								$categoryname = $categorys_all_rows['categoryname'];
								$categoryimage = $categorys_all_rows['image'];
								
								$stmt_sql_cocktailcategorylist = mysqli_prepare($link, $sql_cocktailcategorylist);
								mysqli_stmt_bind_param($stmt_sql_cocktailcategorylist, "ii", $id, $categoryid);
								mysqli_stmt_execute($stmt_sql_cocktailcategorylist);
								$cocktailcategorylist_all_res=mysqli_stmt_get_result($stmt_sql_cocktailcategorylist);
								$cocktailcategory = 0;
								while($cocktailcategorylist_all_rows= mysqli_fetch_array($cocktailcategorylist_all_res, MYSQLI_ASSOC))
								{
									$cocktailcategory = 1;
									
								}
								mysqli_stmt_close($stmt_sql_cocktailcategorylist);
								?>
									<option value="<?php echo $categoryid;?>" data-src="<?php echo $categoryimage;?>"<?php if($cocktailcategory == 1){echo ' selected';}?>><?php echo $categoryname;?></option>
								<?php
								
							 
							}
							mysqli_stmt_close($stmt_sql_categorys);
							?>
							</select>
						</div>
						<div class="d-flex gap-3 p-3 flex-row justify-content-center">
							<select id="input-tags-cocktailtaste" name="cocktailtaste[]" autocomplete="off" multiple class="form-control w-50"<?php if($edit == 0){echo ' disabled';}?>>
							<?php 
							$stmt_sql_tastes = mysqli_prepare($link, $sql_tastes);
							mysqli_stmt_execute($stmt_sql_tastes);
							$tastes_all_res=mysqli_stmt_get_result($stmt_sql_tastes);
							while($tastes_all_rows= mysqli_fetch_array($tastes_all_res, MYSQLI_ASSOC))
							{
								$tasteid = $tastes_all_rows['ID'];
								$tastename = $tastes_all_rows['taste'];
								$tasteimage = $tastes_all_rows['image'];
								
								$stmt_sql_cocktailtastelist = mysqli_prepare($link, $sql_cocktailtastelist);
								mysqli_stmt_bind_param($stmt_sql_cocktailtastelist, "ii", $id, $tasteid);
								mysqli_stmt_execute($stmt_sql_cocktailtastelist);
								$cocktailtastelist_all_res=mysqli_stmt_get_result($stmt_sql_cocktailtastelist);
								$cocktailtastes = 0;
								while($cocktailtastelist_all_rows= mysqli_fetch_array($cocktailtastelist_all_res, MYSQLI_ASSOC))
								{
									$cocktailtastes = 1;
								}
								mysqli_stmt_close($stmt_sql_cocktailtastelist);
								?>
									<option value="<?php echo $tasteid . ",";?>" data-src="<?php echo $tasteimage;?>"<?php if($cocktailtastes == 1){echo ' selected';}?>><?php echo $tastename;?></option>
								<?php
								
							 
							}
							mysqli_stmt_close($stmt_sql_tastes);
							?>
							</select>
						</div>
						<div class="d-flex gap-3 p-3 flex-row justify-content-center">
							<?php 
								$cocktailrating_all = 0;
								$stmt_sql_ratings = mysqli_prepare($link, $sql_ratings_all);
								mysqli_stmt_bind_param($stmt_sql_ratings, "i", $id);
								mysqli_stmt_execute($stmt_sql_ratings);
								$ratings_all_res=mysqli_stmt_get_result($stmt_sql_ratings);
								while($ratings_all_rows= mysqli_fetch_array($ratings_all_res, MYSQLI_ASSOC))
								{
									$cocktailrating_all = $ratings_all_rows['rating'];
								}
								mysqli_stmt_close($stmt_sql_ratings);
								$cocktailrating_my = 0;
								$stmt_sql_rating = mysqli_prepare($link, $sql_rating_my);
								mysqli_stmt_bind_param($stmt_sql_rating, "ii", $id, $_SESSION["id"]);
								mysqli_stmt_execute($stmt_sql_rating);
								$rating_all_res=mysqli_stmt_get_result($stmt_sql_rating);
								while($rating_all_rows= mysqli_fetch_array($rating_all_res, MYSQLI_ASSOC))
								{
									$cocktailrating_my = $rating_all_rows['rating'];
								}
								mysqli_stmt_close($stmt_sql_rating);
							?>
							<div class="rating-wrapper-all">
								<?php 
									for ($i = 1; $i <= 5; $i++) {
										if($cocktailrating_all < $i && $cocktailrating_all > ($i-1)){
											echo '<i class="fa-duotone fa-solid fa-star-half-stroke text-primary" style="--fa-secondary-color: #6c757d; --fa-secondary-opacity: 1;"></i>';
										}
										else if($cocktailrating_all >= $i){
											echo '<i class="fa-solid fa-star text-primary"></i>';
										}
										else{
											echo '<i class="fa-regular fa-star text-secondary"></i>';
										}
										echo '
										';
									}
								?>
							</div>
							<div class="rating-wrapper-my" data-id="<?php echo $id;?>" data-user="<?php echo $_SESSION["id"];?>">
								<i class="fa-regular fa-do-not-enter text-danger"></i>
								<?php 
									for ($i = 1; $i <= 5; $i++) {
										if($cocktailrating_my < $i && $cocktailrating_my > ($i-1)){
											echo '<i class="fa-duotone fa-solid fa-star-half-stroke text-primary" style="--fa-secondary-color: #6c757d; --fa-secondary-opacity: 1;"></i>';
										}
										else if($cocktailrating_my >= $i){
											echo '<i class="fa-solid fa-star text-primary"></i>';
										}
										else{
											echo '<i class="fa-regular fa-star text-secondary"></i>';
										}
										echo '
										';
									}
								?>
							</div>
						</div>
						<div class="d-flex p-3 justify-content-around flex-wrap<?php if(empty($description)){echo ' d-none';}?>">
							<textarea name="description" class="form-control auto-resize" type="text" placeholder="Beschreibung des Cocktails" rows="25"<?php if($edit == 0){echo ' readonly';}?>><?php echo $description;?></textarea>
						</div>
						<div class="d-flex p-3 justify-content-around flex-wrap<?php if(empty($instruction)){echo ' d-none';}?>">
							<textarea name="instruction" class="form-control auto-resize" type="text" placeholder="Anleitung des Cocktails" rows="25"<?php if($edit == 0){echo ' readonly';}?>><?php echo $instruction;?></textarea>
						</div>
						<div class="d-flex p-3 justify-content-around flex-wrap">
							<input class="btn btn-primary" type="submit" name="save" <?php if($edit == 0){echo ' hidden';}?>>
					</fieldset>
				</form>
				<div class="list-group">
					<?php
					
						$stmtingred = mysqli_prepare($link, $sql_ingredients_from_cocktail);
						mysqli_stmt_bind_param($stmtingred, "i", $id);
						mysqli_stmt_execute($stmtingred);
						$ingred_all_res=mysqli_stmt_get_result($stmtingred);
						
						$ingredlist = "";
						$cockavail = 1;
						$cockbuy = 1;
						$cockfav = 0;
						while($ingred_all_rows= mysqli_fetch_array($ingred_all_res, MYSQLI_ASSOC))
						{
					?>
						<a href="ingredient.php?&ingredientid=<?php echo $ingred_all_rows['ingredient_ID'];?>" class="<?php if($ingred_all_rows['available'] == 0){echo "bg-secondary-subtle";}else{echo "bg-primary-subtle";} ?> list-group-item list-group-item-action d-flex gap-2 py-2 d-block">
							<img class="text-dark border border-secondary rounded-circle shadow-4-strong bg-white flex-shrink-0" src="../img/ingredients/png64/<?php echo $ingred_all_rows['image'];?>" alt="<?php echo $ingred_all_rows['ingredientname'];?>" width="48" height="48">
							<div class="flex-grow-1 d-flex gap-2 w-80 flex-nowrap">
								<div class="d-flex-column">
									<h6 class="mb-0"><?php echo $ingred_all_rows['ingredientname'];?></h6>
								</div>
							</div>
							<p class="align-self-center"><?php echo floatval($ingred_all_rows['quantity']);?> <?php 
							
							$stmtunit = mysqli_prepare($link, $sql_unit);
						mysqli_stmt_bind_param($stmtunit, "i", $ingred_all_rows['unit']);
						mysqli_stmt_execute($stmtunit);
						$unit_all_res=mysqli_stmt_get_result($stmtunit);
						$unit_all_rows= mysqli_fetch_assoc($unit_all_res);
						if (mysqli_num_rows($unit_all_res) == 1)
						{
							if(floatval($ingred_all_rows['quantity'])>1)
							{
								echo $unit_all_rows['unitshortX'];
							}
							else
							{
								echo $unit_all_rows['unitshort'];
							}
						}
							?></p>
							<div class="d-flex-column align-items-stretch">
								<i class="bi text-primary <?php if($ingred_all_rows['available'] == 1){echo "bi-check-lg";}else if($ingred_all_rows['shoppable']){echo "bi-cart";} ?>" style="font-size:32px;"></i>
							</div>
						</a>
						<?php
						}?>
					</div>
<?php include("footer.php") ?>