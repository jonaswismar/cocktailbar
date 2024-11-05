<?php
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
				<a href="cocktail_view.php?cocktailid=<?php echo $cocktails_all_rows['ID'];?>" class="<?php if($cockavail == 0){echo "bg-secondary-subtle";}else{echo "bg-primary-subtle";} ?> list-group-item list-group-item-action d-flex gap-2 py-2 d-block<?php if(isset($cocktailid)){if($cocktails_all_rows['ID'] == $cocktailid){echo ' active" aria-current="true';}}?>">
					<picture><?php
				$currentfilepath = dirname(__DIR__, 1);
				if(file_exists($currentfilepath .'/img/cocktails/webp128/' . $cocktails_all_rows['image'] . '.webp'))
				{
					echo '
						<source srcset="../img/cocktails/webp128/' . $cocktails_all_rows['image'] . '.webp" type="image/webp" media="(min-width: 1600px)">';
				}
				if(file_exists($currentfilepath .'/img/cocktails/webp64/' . $cocktails_all_rows['image'] . '.webp'))
				{
					echo '
						<source srcset="../img/cocktails/webp64/' . $cocktails_all_rows['image'] . '.webp" type="image/webp" media="(min-width: 960px)">';
				}
				if(file_exists($currentfilepath .'/img/cocktails/webp48/' . $cocktails_all_rows['image'] . '.webp'))
				{
					echo '
						<source srcset="../img/cocktails/webp48/' . $cocktails_all_rows['image'] . '.webp" type="image/webp">';
				}
				if(file_exists($currentfilepath .'/img/cocktails/png128/' . $cocktails_all_rows['image'] . '.png'))
				{
					echo '
						<source srcset="../img/cocktails/png128/' . $cocktails_all_rows['image'] . '.png" type="image/png" media="(min-width: 1600px)">';
				}
				if(file_exists($currentfilepath .'/img/cocktails/png64/' . $cocktails_all_rows['image'] . '.png'))
				{
					echo '
						<source srcset="../img/cocktails/png64/' . $cocktails_all_rows['image'] . '.png" type="image/png" media="(min-width: 960px)">';
				}
				if(file_exists($currentfilepath .'/img/cocktails/png48/' . $cocktails_all_rows['image'] . '.png'))
				{
					echo '
						<source srcset="../img/cocktails/png48/' . $cocktails_all_rows['image'] . '.png" type="image/png">';
				}
				if(file_exists($currentfilepath .'/img/glassware/webp128/' . $cocktails_all_rows['glass'] . '.webp'))
				{
					echo '
						<source srcset="../img/glassware/webp128/' . $cocktails_all_rows['glass'] . '.webp" type="image/webp" media="(min-width: 1600px)">';
				}
				if(file_exists($currentfilepath .'/img/glassware/webp64/' . $cocktails_all_rows['glass'] . '.webp'))
				{
					echo '
						<source srcset="../img/glassware/webp64/' . $cocktails_all_rows['glass'] . '.webp" type="image/webp" media="(min-width: 960px)">';
				}
				if(file_exists($currentfilepath .'/img/glassware/webp48/' . $cocktails_all_rows['glass'] . '.webp'))
				{
					echo '
						<source srcset="../img/glassware/webp48/' . $cocktails_all_rows['glass'] . '.webp" type="image/webp">';
				}
				if(file_exists($currentfilepath .'/img/glassware/jpg128/' . $cocktails_all_rows['glass'] . '.jpg'))
				{
					echo '
						<source srcset="../img/glassware/jpg128/' . $cocktails_all_rows['glass'] . '.jpg" type="image/jpg" media="(min-width: 1600px)">';
				}
				if(file_exists($currentfilepath .'/img/glassware/jpg64/' . $cocktails_all_rows['glass'] . '.jpg'))
				{
					echo '
						<source srcset="../img/glassware/jpg64/' . $cocktails_all_rows['glass'] . '.jpg" type="image/jpg" media="(min-width: 960px)">';
				}
				if(file_exists($currentfilepath .'/img/glassware/jpg48/' . $cocktails_all_rows['glass'] . '.jp'))
				{
					echo '
						<source srcset="../img/glassware/jpg48/' . $cocktails_all_rows['glass'] . '.jpg" type="image/jpg">';
				}?>

						<source srcset="../img/glassware/jpg128/6.jpg" type="image/jpg" media="(min-width: 1600px)">
						<source srcset="../img/glassware/jpg64/6.jpg" type="image/jpg" media="(min-width: 960px)">
						<source srcset="../img/glassware/jpg48/6.jpg" type="image/jpg">
						<img decoding = "async" loading="lazy" src="../img/glassware/jpg48/6.jpg" alt="<?php echo $cocktails_all_rows['cocktailname'];?>" class="text-dark border border-secondary rounded-circle shadow-4-strong bg-white flex-shrink-0" style="text-align: center;">
					</picture>
					<div class="flex-grow-1 d-flex gap-2 w-80 flex-nowrap">
						<div class="d-flex-column">
							<p class="mb-0 text-size-h6"><?php echo $cocktails_all_rows['cocktailname'];?></p>
							<p class="mb-0 text-size-h5 opacity-75 text-truncate textcalcoffset"><?php echo $ingredlist;?></p>
						</div>
					</div>
					<i class="bi text-primary text-size-h6-2x<?php if($cockavail == 1){echo " bi-check-lg";}else if($cockbuy == 1){echo " bi-cart";} ?>"></i>
					<i class="bi text-info bi-heart-fill text-size-h6-2x<?php if($cockfav == 0){echo " d-none";} ?>"></i>
				</a>
<?php
	} ?>