<?php include("header.php") ?>
<?php 
	if(empty($_GET['orderid'])){
		$orderid = 0;
	}
	else{
		$orderid = $_GET['orderid'];
	}
	$cocktailid = 0;
	$orderstatus = 0;
	$stmt_sql_ordered_cocktaildata = mysqli_prepare($link, $sql_ordered_cocktaildata);
	mysqli_stmt_bind_param($stmt_sql_ordered_cocktaildata, "i", $orderid);
	mysqli_stmt_execute($stmt_sql_ordered_cocktaildata);
	$ordered_cocktaildata_all_res=mysqli_stmt_get_result($stmt_sql_ordered_cocktaildata);
	while($ordered_cocktaildata_all_rows= mysqli_fetch_array($ordered_cocktaildata_all_res, MYSQLI_ASSOC)){
		$cocktailid = $ordered_cocktaildata_all_rows['cocktail'];
		$orderstatus = $ordered_cocktaildata_all_rows['status'];
	}
	mysqli_stmt_close($stmt_sql_ordered_cocktaildata);
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
				<div class="container-fluid justify-content-start">
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] == 3 || $orderstatus == 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#orderFinishDialog" data-toggle="tooltip" data-placement="bottom" title="Ausliefern">
						<i class="fa-duotone fa-solid fa-fw fa-bags-shopping"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#newDialogCocktail" data-toggle="tooltip" data-placement="bottom" title="Neu">
						<i class="fa-duotone fa-solid fa-fw fa-file"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#editDialogCocktail" data-toggle="tooltip" data-placement="bottom" title="Bearbeiten">
						<i class="fa-duotone fa-solid fa-fw fa-pencil"></i>
					</button>
					<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#deleteDialogCocktail" data-toggle="tooltip" data-placement="bottom" title="Löschen">
						<i class="fa-duotone fa-solid fa-fw fa-trash"></i>
					</button>
				</div>
			</nav>
<?php include("subview_cocktail.php") ?>
<?php include("footer.php") ?>