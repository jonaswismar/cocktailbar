		<?php include("header.php") ?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px">
				<div class="scrolling-wrapper-flexbox">
					<a href="userprefs.php" class="btn btn-primary text-uppercase active" aria-current="page" data-toggle="tooltip" data-placement="bottom" title="Benutzereinstellungen ändern">
						<i class="fa-solid fa-user-gear fa-fw"></i> Einstellungen
					</a>
				</div>
			</nav>
			<form action="/api/userprefs_save.php" method="POST">
				<fieldset>
					<div class="list-group mb-5 shadow">
						<div class="list-group-item">
							<div class="row align-items-center">
								<div class="col">
									<i class="fa fa-fw fa-duotone fa-solid fa-icons"></i><strong class="mb-0"> Benutzer Symbol</strong>
									<p class="text-muted mb-0">Fontawesome Name für Benutzer Symbol.</p>
								</div>
								<div class="col-auto">
									<div class="form-check form-switch">
										<input type="text" class="form-control" id="icon" name="icon" value="<?php echo $_SESSION["icon"];?>" data-toggle="tooltip" data-placement="bottom" title="Alle Fontawesome 6.6.0 Pro Symbole verfügbar">
									</div>
								</div>
							</div>
						</div>
						<div class="list-group-item">
							<div class="row align-items-center">
								<div class="col">
									<i class="fa fa-fw fa-duotone fa-solid fa-shelves"></i><strong class="mb-0"> Bar</strong>
									<p class="text-muted mb-0">Auswahl der Bar in der du dich befindest.</p>
								</div>
								<div class="col-auto">
									<select type="bar" name="bar" class="form-select"  data-toggle="tooltip" data-placement="bottom" title="Wähle die Bar aus in der du dich befindest">
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
									<i class="fa fa-fw fa-duotone fa-solid fa-martini-glass-citrus"></i><strong class="mb-0"> Garnierung ignorieren</strong>
									<p class="text-muted mb-0">Die Garnierung der Cocktails ist immer optional.</p>
								</div>
								<div class="col-auto">
									<div class="form-check form-switch">
										<input type="checkbox" class="form-check-input" id="garnish" name="garnish"  data-toggle="tooltip" data-placement="bottom" title="Auswahl ob Ganierungen als optional behandelt werden sollen" <?php if($_SESSION["ignoregarnish"] == 1){echo ' checked';} ?>>
										<span class="form-check-label"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="list-group-item">
							<div class="row align-items-center">
								<div class="col">
									<i class="fa fa-fw fa-duotone fa-solid fa-page"></i><strong class="mb-0"> App Startbildschirm</strong>
									<p class="text-muted mb-0">Auswahl welche Seite als Startseite dient.</p>
								</div>
								<div class="col-auto">
									<select type="startpage" name="startpage" class="form-select" id="floatingDrop" data-toggle="tooltip" data-placement="bottom" title="Auswahl welche Seite dir als Startseite dient">
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
									<i class="fa fa-fw fa-duotone fa-solid fa-language"></i><strong class="mb-0"> Sprache</strong>
									<p class="text-muted mb-0">Auswahl in welcher Sprache die App läuft.</p>
								</div>
								<div class="col-auto">
									<select type="language" name="language" class="form-select" id="floatingDrop" data-toggle="tooltip" data-placement="bottom" title="Auswahl in welcher Sprache die App läuft">
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
									<i class="fa fa-fw fa-duotone fa-solid fa-ruler"></i><strong class="mb-0"> Metrisches System benutzen</strong>
									<p class="text-muted mb-0">Wenn nicht anders markiert wird das Imperiale (US) Einheitensystem verwendet.</p>
								</div>
								<div class="col-auto">
									<div class="form-check form-switch">
										<input type="checkbox" class="form-check-input" id="metric" name="metric" data-toggle="tooltip" data-placement="bottom" title="Auswahl ob du z.B. Unzen anstelle ml verwenden möchtest" <?php if($_SESSION["metricunits"] == 1){echo ' checked';} ?>>
										<span class="form-check-label"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="list-group-item">
							<div class="row align-items-center">
								<div class="col">
									<i class="fa fa-fw fa-duotone fa-solid fa-magnifying-glass"></i><strong class="mb-0"> Suchmodus</strong>
									<p class="text-muted mb-0">Auswahl welcher Modus in der Suche verwendet wird.</p>
								</div>
								<div class="col-auto">
									<select type="searchmode" name="searchmode" class="form-select" id="floatingDrop" data-toggle="tooltip" data-placement="bottom" title="Auswahl in welcher Sprache die App läuft">
										<option value="1"<?php if($_SESSION["searchmode"] == "1"){echo ' selected';} ?>>Boolean Modus</option>
										<option value="2"<?php if($_SESSION["searchmode"] == "2"){echo ' selected';} ?>>Natürlicher Modus</option>
									</select>
								</div>
							</div>
						</div>
						
						
						
						<div class="list-group-item">
							<div class="row align-items-center">
								<div class="col">
									<i class="fa fa-fw fa-duotone fa-solid fa-lightbulb"></i><strong class="mb-0"> Dunkelmodus</strong>
									<p class="text-muted mb-0">Auswahl ob die App Hell oder Dunkel dargestellt werden soll.</p>
								</div>
								<div class="col-auto">
									<select type="darkmode" name="darkmode" class="form-select" id="floatingDrop" data-toggle="tooltip" data-placement="bottom" title="Auswahl ob die App Hell oder Dunkel dargestellt werden soll">
										<option value="light"<?php if($_SESSION["darkmode"] == "light"){echo ' selected';} ?>>Hell</option>
										<option value="dark"<?php if($_SESSION["darkmode"] == "dark"){echo ' selected';} ?>>Dunkel</option>
										<option value="auto"<?php if($_SESSION["darkmode"] == "auto"){echo ' selected';} ?>>Auto</option>
									</select>
								</div>
							</div>
						</div>
						<div class="list-group-item">
							<div class="row align-items-center">
								<div class="col">
									<i class="fa fa-fw fa-duotone fa-solid fa-paint-roller"></i><strong class="mb-0"> Theme</strong>
									<p class="text-muted mb-0">Auswahl in welchen Theme die App dargestellt werden soll.</p>
								</div>
								<div class="col-auto">
									<select type="theme" name="theme" class="form-select" id="floatingDrop" data-toggle="tooltip" data-placement="bottom" title="Auswahl in welchen Theme die App dargestellt werden soll">
										<option value="default"<?php if($_SESSION["theme"] == "default"){echo ' selected';} ?>>Standard</option>
										<option value="cerulean"<?php if($_SESSION["theme"] == "cerulean"){echo ' selected';} ?>>Cerulean</option>
										<option value="cosmo"<?php if($_SESSION["theme"] == "cosmo"){echo ' selected';} ?>>Cosmo</option>
										<option value="cyborg"<?php if($_SESSION["theme"] == "cyborg"){echo ' selected';} ?>>Cyborg</option>
										<option value="darkly"<?php if($_SESSION["theme"] == "darkly"){echo ' selected';} ?> disabled>Darkly</option>
										<option value="flatly"<?php if($_SESSION["theme"] == "flatly"){echo ' selected';} ?> disabled>Flatly</option>
										<option value="journal"<?php if($_SESSION["theme"] == "journal"){echo ' selected';} ?>>Journal</option>
										<option value="litera"<?php if($_SESSION["theme"] == "litera"){echo ' selected';} ?>>Litera</option>
										<option value="lumen"<?php if($_SESSION["theme"] == "lumen"){echo ' selected';} ?>>Lumen</option>
										<option value="lux"<?php if($_SESSION["theme"] == "lux"){echo ' selected';} ?> disabled>Lux</option>
										<option value="materia"<?php if($_SESSION["theme"] == "materia"){echo ' selected';} ?> disabled>Materia</option>
										<option value="minty"<?php if($_SESSION["theme"] == "minty"){echo ' selected';} ?>>Minty</option>
										<option value="morph"<?php if($_SESSION["theme"] == "morph"){echo ' selected';} ?> disabled>Morph</option>
										<option value="pulse"<?php if($_SESSION["theme"] == "pulse"){echo ' selected';} ?> disabled>Pulse</option>
										<option value="quartz"<?php if($_SESSION["theme"] == "quartz"){echo ' selected';} ?> disabled>Quartz</option>
										<option value="sandstone"<?php if($_SESSION["theme"] == "sandstone"){echo ' selected';} ?>>Sandstone</option>
										<option value="simplex"<?php if($_SESSION["theme"] == "simplex"){echo ' selected';} ?>>Simplex</option>
										<option value="sketchy"<?php if($_SESSION["theme"] == "sketchy"){echo ' selected';} ?>>Sketchy</option>
										<option value="slate"<?php if($_SESSION["theme"] == "slate"){echo ' selected';} ?>>Slate</option>
										<option value="solar"<?php if($_SESSION["theme"] == "solar"){echo ' selected';} ?>>Solar</option>
										<option value="spacelab"<?php if($_SESSION["theme"] == "spacelab"){echo ' selected';} ?>>Spacelab</option>
										<option value="superhero"<?php if($_SESSION["theme"] == "superhero"){echo ' selected';} ?>>Superhero</option>
										<option value="united"<?php if($_SESSION["theme"] == "united"){echo ' selected';} ?>>United</option>
										<option value="vapor"<?php if($_SESSION["theme"] == "vapor"){echo ' selected';} ?>>Vapor</option>
										<option value="yeti"<?php if($_SESSION["theme"] == "yeti"){echo ' selected';} ?>>Yeti</option>
										<option value="zephyr"<?php if($_SESSION["theme"] == "zephyr"){echo ' selected';} ?>>Zephyr</option>
									</select>
								</div>
							</div>
						</div>
						<div class="d-flex p-3 justify-content-around flex-wrap">
							<input class="btn btn-primary" type="submit">
						</div>
						<div class="list-group-item disabled<?php if($_SESSION["role"] != 1){echo ' d-none invisible';}?>">
							<div class="row align-items-center">
								<div class="col">
									<i class="fa fa-fw fa-duotone fa-solid fa-file-export"></i><strong class="mb-0"> Exportiere Datenbank</strong>
									<p class="text-muted mb-0">Erstellt ein Datenbank Backup</p>
								</div>
								<div class="col-auto">
									<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Erstelle ein Backup der App Daten">Exportieren</button>
								</div>
							</div>
						</div>
						<div class="list-group-item disabled<?php if($_SESSION["role"] != 1){echo ' d-none invisible';}?>">
							<div class="row align-items-center">
								<div class="col">
									<i class="fa fa-fw fa-duotone fa-solid fa-file-import"></i><strong class="mb-0"> Importiere Datenbank</strong>
									<p class="text-muted mb-0">Spielt ein Datenbank Backup ein</p>
								</div>
								<div class="col-auto">
									<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Importiere ein Backup der App Daten">Importieren</button>
								</div>
							</div>
						</div>
				</fieldset>
			</form>
<?php include("footer.php") ?>