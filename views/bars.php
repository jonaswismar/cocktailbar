<?php include("header.php") ?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px">
				<div class="scrolling-wrapper-flexbox">
					<a href="/views/bars.php" class="btn btn-primary text-uppercase active" aria-current="page" data-toggle="tooltip" data-placement="bottom" title="Alle Bars in der App">
						<i class="fa fa-fw fa-solid fa-map-location-dot"></i> Bars
					</a>
				</div>
			</nav>
			<div class="list-group">
<?php
	if($_SESSION["role"] == 1||$_SESSION["role"] == 2){
		if($_SESSION["role"] == 1){
			$stmt_sql_bars = mysqli_prepare($link, $sql_bars);
		}
		else if($_SESSION["role"] == 2){
		
		}
		mysqli_stmt_execute($stmt_sql_bars);
		include("sublist_bars.php");
	}
	else{
		header("location: /views/index.php");
	}
?>
			</div>
<?php include("footer.php") ?>