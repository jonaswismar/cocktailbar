<?php include("header.php") ?>
				<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px">
					<div class="scrolling-wrapper-flexbox">
						<a href="preferences.php" class="btn btn-primary text-uppercase active" aria-current="page">
							<i class="fa-solid fa-user-gear fa-fw"></i> Einstellungen
						</a>
					</div>
				</nav>
				<form action="preferences_save.php" method="POST">
					<fieldset>
						<div class="list-group mb-5 shadow">
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
													echo '<option value=' . $barid . '>' . $barname . '</option>';
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
											<input type="checkbox" class="form-check-input" id="garnish" name="garnish" checked/>
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
											<option value="1" selected>welcome</option>
											<option value="2">specials</option>
											<option value="3">cocktails</option>
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
											<option value="1" selected>Deutsch</option>
											<option value="2">English</option>
											<option value="3">Français</option>
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
											<input type="checkbox" class="form-check-input" id="metric" name="metric" checked/>
											<span class="form-check-label"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="d-flex p-3 justify-content-around flex-wrap">
								<input class="btn btn-primary" type="submit">
							</div>
					</fieldset>
				</form>
<?php include("footer.php") ?>