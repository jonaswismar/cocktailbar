<?php
	$ingred_all_res=mysqli_stmt_get_result($stmt_sql_ingredients);
	while($ingred_all_rows= mysqli_fetch_array($ingred_all_res, MYSQLI_ASSOC)){
?>
				<a href="ingredient_view.php?&ingredientid=<?php echo $ingred_all_rows['ingredient_ID'];?>" class="<?php if($ingred_all_rows['available'] == 0){echo "bg-secondary-subtle";}else{echo "bg-primary-subtle";} ?> list-group-item list-group-item-action d-flex gap-2 py-2 d-block">
					<picture>
<?php
	$currentfilepath = dirname(__DIR__, 1);
	if(file_exists($currentfilepath .'/img/ingredients/webp128/' . $ingred_all_rows['image'] . '.webp')){
		echo '						<source srcset="../img/ingredients/webp128/' . $ingred_all_rows['image'] . '.webp" type="image/webp" media="(min-width: 1600px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/webp64/' . $ingred_all_rows['image'] . '.webp')){
		echo '						<source srcset="../img/ingredients/webp64/' . $ingred_all_rows['image'] . '.webp" type="image/webp" media="(min-width: 960px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/webp48/' . $ingred_all_rows['image'] . '.webp')){
		echo '						<source srcset="../img/ingredients/webp48/' . $ingred_all_rows['image'] . '.webp" type="image/webp">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png128/' . $ingred_all_rows['image'] . '.png')){
		echo '						<source srcset="../img/ingredients/png128/' . $ingred_all_rows['image'] . '.png" type="image/png" media="(min-width: 1600px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png64/' . $ingred_all_rows['image'] . '.png')){
		echo '						<source srcset="../img/ingredients/png64/' . $ingred_all_rows['image'] . '.png" type="image/png" media="(min-width: 960px)">
';
	}
	if(file_exists($currentfilepath .'/img/ingredients/png48/' . $ingred_all_rows['image'] . '.png')){
		echo '						<source srcset="../img/ingredients/png48/' . $ingred_all_rows['image'] . '.png" type="image/png">
';
	}
?>
						<img decoding = "async" loading="lazy" src="../img/ingredients/png48/unbekannt.png" alt="<?php echo $ingred_all_rows['ingredientname'];?>" class="text-dark border border-secondary rounded-circle shadow-4-strong bg-white flex-shrink-0" style="text-align: center;">
					</picture>
					<p class="mb-0 align-self-center text-size-h6"><?php echo $ingred_all_rows['ingredientname'];?></p>
					<div class="flex-grow-1 d-flex gap-2 w-25 flex-nowrap"></div>
<?php
	if(!empty($sub_ingredients_show_count)){
		if($sub_ingredients_show_count==true){
			echo '					<div class="ml-auto d-flex align-items-center">
						<span style="width: 50px; display: block;" class="badge bg-primary rounded-pill align-items-center">';
			$stmt_ingredientcount_usedin = mysqli_prepare($link, $sql_ingredientcount_usedin);
			mysqli_stmt_bind_param($stmt_ingredientcount_usedin, "i", $ingred_all_rows['ingredient_ID']);
			mysqli_stmt_execute($stmt_ingredientcount_usedin);
			$ingredientcount_usedin_all_res=mysqli_stmt_get_result($stmt_ingredientcount_usedin);
			$ingredientcount_usedin_all_rows= mysqli_fetch_assoc($ingredientcount_usedin_all_res);
			if (mysqli_num_rows($ingredientcount_usedin_all_res) == 1){
				echo $ingredientcount_usedin_all_rows['total'];}
				echo '</span>
					</div>';
		}
	}
	if(!empty($sub_ingredients_show_quantity)){
		if($sub_ingredients_show_quantity==true){
			echo '					<p class="mb-0 align-self-center text-size-h6">' . floatval($ingred_all_rows['quantity']) . ' ';
			$stmtunit = mysqli_prepare($link, $sql_unit);
			mysqli_stmt_bind_param($stmtunit, "i", $ingred_all_rows['unit']);
			mysqli_stmt_execute($stmtunit);
			$unit_all_res=mysqli_stmt_get_result($stmtunit);
			$unit_all_rows= mysqli_fetch_assoc($unit_all_res);
			if (mysqli_num_rows($unit_all_res) == 1){
				if(floatval($ingred_all_rows['quantity'])>1){
					echo $unit_all_rows['unitshortX'];
				}
				else{
					echo $unit_all_rows['unitshort'];
				}
			}
			echo '</p>';
		}
	}?>

					<i class="align-self-center bi text-primary text-size-h6-2x<?php if($ingred_all_rows['available'] == 1){echo " bi-check-lg";}else if($ingred_all_rows['shoppable']){echo " bi-cart";} ?>"></i>
				</a>
<?php
} ?>