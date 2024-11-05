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
						<a href="cocktail_edit.php?cocktailid=0" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>">
							<i class="fa-duotone fa-solid fa-file fa-fw"></i>
						</a>
						<a href="cocktail_edit.php?cocktailid=<?php echo $id;?>" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>">
							<i class="fa-duotone fa-solid fa-pencil fa-fw"></i>
						</a>
						<a href="cocktail_delete.php?cocktailid=<?php echo $id;?>" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>">
							<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
						</a>
					</div>
				</nav>
				<form>
					<fieldset>
						<div class="d-flex gap-3 p-3 flex-row justify-content-center">
							<input name="userid" class="form-control" type="hidden" value="<?php echo $_SESSION["id"];?>" readonly>
							<input name="cocktailid" class="form-control" type="hidden" value="<?php echo $id;?>" readonly>
							<input name="ordered" class="form-control" type="hidden" value="<?php echo $ordered;?>" readonly>
							<input name="favorite" class="form-control" type="hidden" value="<?php echo $favorite;?>" readonly>
							<input name="cocktailname" class="form-control form-control-lg" type="text" placeholder="Name des Cocktails" value="<?php echo $cocktailname;?>" readonly>
							<div class="btn-group">
								<a href="cocktail_save.php?cocktailid=<?php echo $id;?>&ordered=<?php if($ordered == 0){echo '1';}else{echo '0';}?>" class="btn btn-primary"><i class="fa-fw fa-2x <?php if($ordered == 0){echo 'fa-regular fa-bag-shopping';}else{echo 'fa-solid fa-bag-shopping';}?>"></i></a>
								<a href="cocktail_save.php?cocktailid=<?php echo $id;?>&favorite=<?php if($favorite == 0){echo '1';}else{echo '0';}?>" class="btn btn-primary"><i class="fa-fw fa-2x <?php if($favorite == 0){echo 'fa-regular fa-heart';}else{echo 'fa-solid fa-heart';}?>"></i></a>
							</div>
						</div>
						<div class="d-flex justify-content-center">
							<input name="image" class="form-control" type="hidden" value="<?php echo $image;?>" readonly>
							<picture><?php
				$currentfilepath = dirname(__DIR__, 1);
				if(file_exists($currentfilepath .'/img/cocktails/webp700/' . $image . '.webp'))
				{
					echo '
						<source srcset="../img/cocktails/webp700/' . $image . '.webp" type="image/webp" media="(min-width: 3840px)">';
				}
				if(file_exists($currentfilepath .'/img/cocktails/webp512/' . $image . '.webp'))
				{
					echo '
						<source srcset="../img/cocktails/webp512/' . $image . '.webp" type="image/webp" media="(min-width: 1600px)">';
				}
				if(file_exists($currentfilepath .'/img/cocktails/webp256/' . $image . '.webp'))
				{
					echo '
						<source srcset="../img/cocktails/webp256/' . $image . '.webp" type="image/webp" media="(min-width: 960px)">';
				}
				if(file_exists($currentfilepath .'/img/cocktails/webp128/' . $image . '.webp'))
				{
					echo '
						<source srcset="../img/cocktails/webp128/' . $image . '.webp" type="image/webp">';
				}
				if(file_exists($currentfilepath .'/img/cocktails/png700/' . $image . '.png'))
				{
					echo '
						<source srcset="../img/cocktails/png700/' . $image . '.png" type="image/png" media="(min-width: 3840px)">';
				}
				if(file_exists($currentfilepath .'/img/cocktails/png512/' . $image . '.png'))
				{
					echo '
						<source srcset="../img/cocktails/png512/' . $image . '.png" type="image/png" media="(min-width: 1600px)">';
				}
				if(file_exists($currentfilepath .'/img/cocktails/png256/' . $image . '.png'))
				{
					echo '
						<source srcset="../img/cocktails/png256/' . $image . '.png" type="image/png" media="(min-width: 960px)">';
				}
				if(file_exists($currentfilepath .'/img/cocktails/png128/' . $image . '.png'))
				{
					echo '
						<source srcset="../img/cocktails/png128/' . $image . '.png" type="image/png">';
				}
				if(file_exists($currentfilepath .'/img/glassware/webp700/' . $glass . '.webp'))
				{
					echo '
						<source srcset="../img/glassware/webp700/' . $glass . '.webp" type="image/webp" media="(min-width: 3840px)">';
				}
				if(file_exists($currentfilepath .'/img/glassware/webp512/' . $glass . '.webp'))
				{
					echo '
						<source srcset="../img/glassware/webp512/' . $glass . '.webp" type="image/webp" media="(min-width: 1600px)">';
				}
				if(file_exists($currentfilepath .'/img/glassware/webp256/' . $glass . '.webp'))
				{
					echo '
						<source srcset="../img/glassware/webp256/' . $glass . '.webp" type="image/webp" media="(min-width: 960px)">';
				}
				if(file_exists($currentfilepath .'/img/glassware/webp128/' . $glass . '.webp'))
				{
					echo '
						<source srcset="../img/glassware/webp128/' . $glass . '.webp" type="image/webp">';
				}
				if(file_exists($currentfilepath .'/img/glassware/jpg700/' . $glass . '.jpg'))
				{
					echo '
						<source srcset="../img/glassware/jpg700/' . $glass . '.jpg" type="image/jpg" media="(min-width: 3840px)">';
				}
				if(file_exists($currentfilepath .'/img/glassware/jpg512/' . $glass . '.jpg'))
				{
					echo '
						<source srcset="../img/glassware/jpg512/' . $glass . '.jpg" type="image/jpg" media="(min-width: 1600px)">';
				}
				if(file_exists($currentfilepath .'/img/glassware/jpg256/' . $glass . '.jpg'))
				{
					echo '
						<source srcset="../img/glassware/jpg256/' . $glass . '.jpg" type="image/jpg" media="(min-width: 960px)">';
				}
				if(file_exists($currentfilepath .'/img/glassware/jpg128/' . $glass . '.jp'))
				{
					echo '
						<source srcset="../img/glassware/jpg128/' . $glass . '.jpg" type="image/jpg">';
				}?>

						<source srcset="../img/glassware/jpg700/6.jpg" type="image/jpg" media="(min-width: 3840px)">
						<source srcset="../img/glassware/jpg512/6.jpg" type="image/jpg" media="(min-width: 1600px)">
						<source srcset="../img/glassware/jpg256/6.jpg" type="image/jpg" media="(min-width: 960px)">
						<source srcset="../img/glassware/jpg128/6.jpg" type="image/jpg">
								<img loading="lazy" src="../img/glassware/jpg128/6.jpg" alt="<?php echo $cocktailname;?>" class="border border-secondary text-dark rounded-circle bg-white flex-shrink-0" style="text-align: center;">
							</picture>
						</div>
						<div class="d-flex gap-3 p-3 flex-row justify-content-center">
							<select id="input-tags-cocktailcategory" name="cocktailcategory[]" autocomplete="off" multiple class="form-control w-50" disabled>
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
							<select id="input-tags-cocktailtaste" name="cocktailtaste[]" autocomplete="off" multiple class="form-control w-50" disabled>
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
								$stmt_sql_ratings = mysqli_prepare($link, $sql_cocktailratings_all);
								mysqli_stmt_bind_param($stmt_sql_ratings, "i", $id);
								mysqli_stmt_execute($stmt_sql_ratings);
								$ratings_all_res=mysqli_stmt_get_result($stmt_sql_ratings);
								while($ratings_all_rows= mysqli_fetch_array($ratings_all_res, MYSQLI_ASSOC))
								{
									$cocktailrating_all = $ratings_all_rows['rating'];
								}
								mysqli_stmt_close($stmt_sql_ratings);
								$cocktailrating_my = 0;
								$stmt_sql_rating = mysqli_prepare($link, $sql_cocktailrating_my);
								mysqli_stmt_bind_param($stmt_sql_rating, "ii", $id, $_SESSION["id"]);
								mysqli_stmt_execute($stmt_sql_rating);
								$rating_all_res=mysqli_stmt_get_result($stmt_sql_rating);
								while($rating_all_rows= mysqli_fetch_array($rating_all_res, MYSQLI_ASSOC))
								{
									$cocktailrating_my = $rating_all_rows['rating'];
								}
								mysqli_stmt_close($stmt_sql_rating);
							?>
							<div class="cocktailrating-wrapper-all">
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
							<div class="cocktailrating-wrapper-my" data-id="<?php echo $id;?>" data-user="<?php echo $_SESSION["id"];?>">
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
							<textarea name="description" class="form-control auto-resize" type="text" placeholder="Beschreibung des Cocktails" rows="25" readonly><?php echo $description;?></textarea>
						</div>
						<div class="d-flex p-3 justify-content-around flex-wrap<?php if(empty($instruction)){echo ' d-none';}?>">
							<textarea name="instruction" class="form-control auto-resize" type="text" placeholder="Anleitung des Cocktails" rows="25" readonly><?php echo $instruction;?></textarea>
						</div>
					</fieldset>
				</form>
				<div class="list-group">
					<?php 
	$stmt_sql_ingredients = mysqli_prepare($link, $sql_ingredients_from_cocktail);
	mysqli_stmt_bind_param($stmt_sql_ingredients, "i", $id);
	mysqli_stmt_execute($stmt_sql_ingredients);
	$sub_ingredients_show_quantity=true;
	$sub_ingredients_show_count=false;
	include("sublist_ingredients.php") ?>
				</div>
<?php include("footer.php") ?>