<?php include("header.php") ?>
<?php
	if(empty($_GET['view'])){
		$view = "ordered";
	}
	else{
		$view = $_GET['view'];
	}
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px">
				<div class="scrolling-wrapper-flexbox">
					<a href="/views/orders.php?view=ordered" class="btn btn-primary text-uppercase <?php if($view == "ordered"){echo ' active" aria-current="page';}?>" data-toggle="tooltip" data-placement="bottom" title="Deine Bestellungen des aktuellen Besuches">
						<i class="fa fa-fw fa-solid fa-bag-shopping"></i> Bestellt
					</a>
					<a href="/views/orders.php?view=prepared" class="btn btn-primary text-uppercase <?php if($view == "prepared"){echo ' active" aria-current="page';}?>" data-toggle="tooltip" data-placement="bottom" title="Deine Bestellungen in Zubereitung">
						<i class="fa fa-fw fa-solid fa-hourglass-half"></i> In Zubereitung
					</a>
					<a href="/views/orders.php?view=history" class="btn btn-primary text-uppercase <?php if($view == "history"){echo ' active" aria-current="page';}?>" data-toggle="tooltip" data-placement="bottom" title="Deine Bestellhistorie">
						<i class="fa fa-fw fa-solid fa-calendar"></i> Historie
					</a>
				</div>
			</nav>
			<div class="list-group">
<?php
	$orderstatus = 1;
	if($view == "ordered"){
		$stmt_sql_orders = mysqli_prepare($link, $sql_orders);
		$orderstatus = 1;
	}
	else if($view == "prepared"){
		$stmt_sql_orders = mysqli_prepare($link, $sql_orders);
		$orderstatus = 0;
	}
	else if($view == "history"){
		$stmt_sql_orders = mysqli_prepare($link, $sql_orders_hist);
		$orderstatus = 0;
	}
	else{
		$stmt_sql_orders = mysqli_prepare($link, $sql_orders);
		$orderstatus = 1;
	}
	mysqli_stmt_bind_param($stmt_sql_orders, "ii", $_SESSION["id"], $orderstatus);
	mysqli_stmt_execute($stmt_sql_orders);
	include("sublist_orders.php")
?>
			</div>
<?php include("footer.php") ?>