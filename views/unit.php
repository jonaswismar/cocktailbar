<?php include("header.php") ?>
			<?php 
				$id = "";
				$unitname = "";
				$unitshort = "";
				$unitshortX = "";
				$description = "";
				$image = "";
				
				if(empty($_GET['unitid']))
				{
					$unitid = 0;
				}
				else
				{
					$unitid = $_GET['unitid'];
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
				$stmt_sql_unit = mysqli_prepare($link, $sql_unit);
				mysqli_stmt_bind_param($stmt_sql_unit, "i", $unitid);
				mysqli_stmt_execute($stmt_sql_unit);
				$unit_all_res=mysqli_stmt_get_result($stmt_sql_unit);
				while($unit_all_rows= mysqli_fetch_array($unit_all_res, MYSQLI_ASSOC))
				{
					$id = $unit_all_rows['ID'];
					$unitname = $unit_all_rows['unitname'];
					$unitshort = $unit_all_rows['unitshort'];
					$unitshortX = $unit_all_rows['unitshortX'];
					$description = $unit_all_rows['description'];
					$image = $unit_all_rows['image'];
				}
				mysqli_stmt_close($stmt_sql_unit);
				mysqli_close($link);
			?>
				<nav class="navbar navbar-dark bg-primary py-1" style="margin-top: -17px;"<?php
								if($_SESSION["role"] != 1)
								{
									echo ' hidden';
								}
							?>>
					<div class="container-fluid justify-content-start">
						<a href="unit.php?unitid=0&edit=2" class="btn btn-primary<?php
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
						<a href="unit.php?unitid=<?php
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
						<a href="unit_delete.php?unitid=<?php echo $id;?>" class="btn btn-primary<?php
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
				<form action="unit_save.php" method="POST">
					<fieldset>
						<div class="d-flex gap-3 p-3 flex-row justify-content-center">
							<i class="<?php echo $image;?> fa-4x" id="IconPreview"></i>
							<button class="btn btn-primary" type="button" id="GetIconPicker" data-iconpicker-input="input#IconInput" data-iconpicker-preview="i#IconPreview"<?php if($edit == 0){echo ' hidden';}?>>Icon ändern</button>
							<input name="image" class="form-control" type="hidden" value="<?php echo $image;?>" id="IconInput" autocomplete="off" spellcheck="false"<?php if($edit == 0){echo ' readonly';}?>/>
							<input name="unitid" class="form-control" type="hidden" value="<?php echo $id;?>"<?php if($edit == 0){echo ' readonly';}?>>
							<input name="unitname" class="form-control" type="text" placeholder="Name der Einheit" value="<?php echo $unitname;?>"<?php if($edit == 0){echo ' readonly';}?>>
						</div>
						<div class="d-flex gap-3 p-3 flex-row justify-content-center">
							<input name="unitshort" class="form-control" type="text" placeholder="Einzahl" value="<?php echo $unitshort;?>"<?php if($edit == 0){echo ' readonly';}?>>
							<input name="unitshortX" class="form-control" type="text" placeholder="Mehrzahl" value="<?php echo $unitshortX;?>"<?php if($edit == 0){echo ' readonly';}?>>
						</div>
						<div class="d-flex p-3 justify-content-around flex-wrap">
							<textarea name="description" class="form-control auto-resize" type="text" placeholder="Beschreibung der Einheit" rows="25"<?php if($edit == 0){echo ' readonly';}?>><?php echo $description;?></textarea>
						</div>
						<div class="d-flex p-3 justify-content-around flex-wrap">
							<input class="btn btn-primary" type="submit"<?php if($edit == 0){echo ' hidden';}?>>
					</fieldset>
				</form>
<?php include("footer.php") ?>