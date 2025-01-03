<?php include("header.php") ?>
				<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px">
					<div class="scrolling-wrapper-flexbox">
						<a href="user_view.php" class="btn btn-primary text-uppercase active" aria-current="page">
							<i class="fa-solid fa-user-gear fa-fw"></i> Einstellungen
						</a>
					</div>
				</nav>
				<form action="user_save.php" method="POST">
					<fieldset>
						<div class="list-group mb-5 shadow">
							<div class="list-group-item">
								<div class="row align-items-center">
									<div class="col">
										<strong class="mb-0"><i class="fa fa-fw fa-duotone fa-solid fa-icons"></i> Benutzer Symbol</strong>
										<p class="text-muted mb-0">Fontawesome Name für Benutzer Symbol</p>
									</div>
									<div class="col-auto">
										<div class="form-check form-switch">
											<input type="text" class="form-control" id="image" name="image" value="<?php echo $_SESSION["image"];?>">
										</div>
									</div>
								</div>
							</div>
							<div class="list-group-item">
								<div class="row align-items-center">
									<div class="col">
										<strong class="mb-0"><i class="fa fa-fw fa-duotone fa-solid fa-shelves"></i> Bar</strong>
										<p class="text-muted mb-0">Auswahl der Bar in der du dich befindest.</p>
									</div>
									<div class="col-auto">
										<select type="bar" name="bar" class="form-select">
											<?php 
												$stmt_sql_bars = mysqli_prepare($link, $sql_bars);
												mysqli_stmt_execute($stmt_sql_bars);
												$bars_all_res=mysqli_stmt_get_result($stmt_sql_bars);
												while($bars_all_rows= mysqli_fetch_array($bars_all_res, MYSQLI_ASSOC))
												{
													$barid = $bars_all_rows['ID'];
													$barname = $bars_all_rows['barname'];
													if($_SESSION["bar"] == $barid)
													{
														echo '<option value=' . $barid . ' selected>' . $barname . '</option>';
													}
													else
													{
														echo '<option value=' . $barid . '>' . $barname . '</option>';
													}
												}
												mysqli_stmt_close($stmt_sql_bars);
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="list-group-item">
								<div class="row align-items-center">
									<div class="col">
										<strong class="mb-0"><i class="fa fa-fw fa-duotone fa-solid fa-martini-glass-citrus"></i> Garnierung ignorieren</strong>
										<p class="text-muted mb-0">Die Garnierung der Cocktails ist immer optional.</p>
									</div>
									<div class="col-auto">
										<div class="form-check form-switch">
											<input type="checkbox" class="form-check-input" id="garnish" name="garnish"<?php if($_SESSION["ignoregarnish"] == 1){echo ' checked';} ?>>
											<span class="form-check-label"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="list-group-item">
								<div class="row align-items-center">
									<div class="col">
										<strong class="mb-0"><i class="fa fa-fw fa-duotone fa-solid fa-page"></i> App Startbildschirm</strong>
										<p class="text-muted mb-0">Auswahl welche Seite als Startseite dient.</p>
									</div>
									<div class="col-auto">
										<select type="startpage" name="startpage" class="form-select" id="floatingDrop" aria-label="Default select example">
											<option value="welcome.php"<?php if($_SESSION["startpage"] == "welcome.php"){echo ' selected';} ?>>Startseite</option>
											<option value="specials.php"<?php if($_SESSION["startpage"] == "specials.php"){echo ' selected';} ?>>Specials</option>
											<option value="cocktails.php"<?php if($_SESSION["startpage"] == "cocktails.php"){echo ' selected';} ?>>Cocktails</option>
										</select>
									</div>
								</div>
							</div>
							<div class="list-group-item">
								<div class="row align-items-center">
									<div class="col">
										<strong class="mb-0"><i class="fa fa-fw fa-duotone fa-solid fa-language"></i> Sprache</strong>
										<p class="text-muted mb-0">Auswahl in welcher Sprache die App läuft.</p>
									</div>
									<div class="col-auto">
										<select type="language" name="language" class="form-select" id="floatingDrop" aria-label="Default select example">
											<option value="de"<?php if($_SESSION["language"] == "de"){echo ' selected';} ?>>Deutsch</option>
											<option value="en"<?php if($_SESSION["language"] == "en"){echo ' selected';} ?>>English</option>
											<option value="fr"<?php if($_SESSION["language"] == "fr"){echo ' selected';} ?>>Français</option>
										</select>
									</div>
								</div>
							</div>
							<div class="list-group-item">
								<div class="row align-items-center">
									<div class="col">
										<strong class="mb-0"><i class="fa fa-fw fa-duotone fa-solid fa-ruler"></i> Metrisches System benutzen</strong>
										<p class="text-muted mb-0">Wenn nicht anders markiert wird das Imperiale (US) Einheitensystem verwendet.</p>
									</div>
									<div class="col-auto">
										<div class="form-check form-switch">
											<input type="checkbox" class="form-check-input" id="metric" name="metric"<?php if($_SESSION["metricunits"] == 1){echo ' checked';} ?>>
											<span class="form-check-label"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="d-flex p-3 justify-content-around flex-wrap">
								<input class="btn btn-primary" type="submit">
							</div>
							<div class="list-group-item disabled<?php if($_SESSION["role"] != 1){echo ' d-none invisible';}?>">
								<div class="row align-items-center">
									<div class="col">
										<strong class="mb-0"><i class="fa fa-fw fa-duotone fa-solid fa-file-export"></i> Exportiere Datenbank</strong>
										<p class="text-muted mb-0">Erstellt ein Datenbank Backup</p>
									</div>
									<div class="col-auto">
										<button type="button" class="btn btn-primary">Exportieren</button>
									</div>
								</div>
							</div>
							<div class="list-group-item disabled<?php if($_SESSION["role"] != 1){echo ' d-none invisible';}?>">
								<div class="row align-items-center">
									<div class="col">
										<strong class="mb-0"><i class="fa fa-fw fa-duotone fa-solid fa-file-import"></i> Importiere Datenbank</strong>
										<p class="text-muted mb-0">Spielt ein Datenbank Backup ein</p>
									</div>
									<div class="col-auto">
										<button type="button" class="btn btn-primary">Importieren</button>
									</div>
								</div>
							</div>
					</fieldset>
				</form>
<?php include("footer.php") ?>