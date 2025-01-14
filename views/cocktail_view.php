<?php include("header.php") ?>
			<?php 
				if(empty($_GET['cocktailid']))
				{
					$cocktailid = 0;
				}
				else
				{
					$cocktailid = $_GET['cocktailid'];
				}
				
				 ?>

				<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
					<div class="container-fluid justify-content-start">
						<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#newDialog">
							<i class="fa-duotone fa-solid fa-file fa-fw"></i>
						</button>
						<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#editDialog">
							<i class="fa-duotone fa-solid fa-pencil fa-fw"></i>
						</button>
						<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#deleteDialog">
							<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
						</button>
					</div>
				</nav>
				
<?php include("subview_cocktail.php") ?>
<?php include("footer.php") ?>