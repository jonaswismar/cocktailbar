<?php include("header.php") ?>
			<?php 
				$id = "";
				$image = "";
				$taste = "";
				$description = "";
				
				if(empty($_GET['tasteid']))
				{
					$tasteid = 0;
				}
				else
				{
					$tasteid = $_GET['tasteid'];
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
				$stmt_sql_taste = mysqli_prepare($link, $sql_taste);
				mysqli_stmt_bind_param($stmt_sql_taste, "i", $tasteid);
				mysqli_stmt_execute($stmt_sql_taste);
				$taste_all_res=mysqli_stmt_get_result($stmt_sql_taste);
				while($taste_all_rows= mysqli_fetch_array($taste_all_res, MYSQLI_ASSOC))
				{
					$id = $taste_all_rows['ID'];
					$image = $taste_all_rows['image'];
					$taste = $taste_all_rows['taste'];
					$description = $taste_all_rows['description'];
				}
				mysqli_stmt_close($stmt_sql_taste);
				mysqli_close($link);
			?>
				<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px"<?php
								if($_SESSION["role"] != 1)
								{
									echo ' hidden';
								}
							?>>
					<div class="container-fluid justify-content-start">
						<a href="taste.php?tasteid=0&edit=2" class="btn btn-primary<?php
								if($_SESSION["role"] != 1)
								{
									echo ' disabled';
								}
								else
								{
									if($edit == 1 || $edit == 2)
									{
										echo ' disabled';
									}
								}
							?>">
							<i class="fa-duotone fa-solid fa-file fa-fw"></i>
						</a>
						<a href="taste.php?tasteid=<?php
								echo $id . '&edit=';
								if($_SESSION["role"] != 1)
								{
									echo '0';
								}
								else
								{
									if($edit == 1)
									{
										echo '0';
									}
									else
									{
										echo '1';
									}
								} ?>" class="btn btn-primary<?php
									if($edit == 2)
									{
										echo ' disabled';
									}?>">
							<i class="fa-duotone fa-solid fa-pencil fa-fw<?php
								if($_SESSION["role"] != 1)
								{
									echo ' fa-swap-opacity';
								}
								else
								{
									if($edit == 1)
									{
										echo ' fa-swap-opacity';
									}
								} ?>"></i>
						</a>
						<a href="taste_delete.php?tasteid=<?php echo $id;?>" class="btn btn-primary<?php
								if($_SESSION["role"] != 1)
								{
									echo ' disabled';
								}
								else
								{
									if($edit == 1 || $edit == 2)
									{
										echo ' disabled';
									}
								} ?>">
							<i class="fa-duotone fa-solid fa-trash fa-fw"></i>
						</a>
					</div>
				</nav>
				<form action="taste_save.php" method="POST">
					<fieldset>
						<div class="d-flex gap-3 p-3 flex-row justify-content-center">
							<i class="<?php echo $image;?> fa-4x" id="IconPreview"></i>
							<button class="btn btn-primary" type="button" id="GetIconPicker" data-iconpicker-input="input#IconInput" data-iconpicker-preview="i#IconPreview"<?php if($edit == 0){echo ' hidden';}?>>Icon ändern</button>
							<input name="image" class="form-control" type="hidden" value="<?php echo $image;?>" id="IconInput" autocomplete="off" spellcheck="false"<?php if($edit == 0){echo ' readonly';}?>/>
							<input name="tasteid" class="form-control" type="hidden" value="<?php echo $id;?>"<?php if($edit == 0){echo ' readonly';}?>>
							<input name="taste" class="form-control" type="text" placeholder="Name des Geschmacks" value="<?php echo $taste;?>"<?php if($edit == 0){echo ' readonly';}?>>
						</div>
						<div class="d-flex p-3 justify-content-around flex-wrap">
							<textarea name="description" class="form-control auto-resize" type="text" placeholder="Beschreibung des Geschmacks" rows="25"<?php if($edit == 0){echo ' readonly';}?>><?php echo $description;?></textarea>
						</div>
						<div class="d-flex p-3 justify-content-around flex-wrap">
							<input class="btn btn-primary" type="submit"<?php if($edit == 0){echo ' hidden';}?>>
					</fieldset>
				</form>
<?php include("footer.php") ?>