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

				<nav class="navbar navbar-dark bg-primary py-1" style="margin-top: -17px;"<?php if($_SESSION["role"] != 1){echo ' hidden';}?>>
					<div class="container-fluid justify-content-start">
						<a href="cocktail_edit.php?cocktailid=0" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>">
							<i class="fa-duotone fa-solid fa-file fa-fw"></i>
						</a>
						<a href="cocktail_edit.php?cocktailid=<?php echo $cocktailid;?>" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>">
							<i class="fa-duotone fa-solid fa-pencil fa-fw"></i>
						</a>
						<button type="button" class="btn btn-primary<?php if($_SESSION["role"] != 1){echo ' disabled';}?>" data-bs-toggle="modal" data-bs-target="#deleteQuestion">
							<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
						</button>
					</div>
				</nav>
				
<?php include("subview_cocktail.php") ?>
<?php include("footer.php") ?>