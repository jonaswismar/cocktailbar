<?php 
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$db_error=false;
		$con = mysqli_connect($_POST['dbhost'], $_POST['dbusername'], $_POST['dbpassword']);
		if(!@$con)
		{
            $db_error = true;
            $database_err = "Sorry, these details are not correct.";
		}
		if(!$db_error and !@mysqli_select_db($con, $_POST['dbname']))
		{
            $db_error = true;
            $database_err = "The dbhost, dbusername and dbpassword are correct. 
            But something is wrong with the given database.";
		}
		if(!$db_error){
            $connect_code="<?php
            define('DB_SERVER','".$_POST['dbhost']."');
            define('DB_USERNAME','".$_POST['dbusername']."');
            define('DB_PASSWORD','".$_POST['dbpassword']."');
            define('DB_NAME','".$_POST['dbname']."');
            \$base = '".$_POST['fullurl']."';
            \$siteTitle = '".$_POST['title']."';
            \$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            ?>";
            $fp = fopen(__DIR__ . '/conf.php','a');
            fwrite($fp,$connect_code);
            fclose($fp);
		    //Import SQL FIle
			$filename = 'db.sql';
			// Temporary variable, used to store current query
			$templine = '';
			// Read in entire file
			$lines = file($filename);
			// Loop through each line
			foreach ($lines as $line)
			{
			// Skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == '')
			    continue;

			// Add this line to the current segment
			$templine .= $line;
			// If it has a semicolon at the end, it's the end of the query
				if (substr(trim($line), -1, 1) == ';'){
				    // Perform the query
				    if(!mysqli_query($con, $templine)){echo 'Error performing query \'<strong>' . $templine . '\': ' . mysqli_error() . '<br /><br />';}
				    // Reset temp variable to empty
				    $templine = '';
				}
			}
			header('location: '. $_SERVER['REQUEST_URI']);
		}
	}else{
		include("header_login.php")
?>
			<form method="post">
				<fieldset>
					<legend>Datenbank:</legend>
					<div class="form-floating">
						<input type="texttop" name="dbhost" class="form-control <?php echo (!empty($database_err)) ? 'is-invalid' : ''; ?>" id="dbhost" placeholder="localhost">
						<label for="dbhost">Hostname</label>
						<span class="invalid-feedback"><?php echo $database_err; ?></span>
					</div>
					<div class="form-floating">
						<input type="textmiddle" name="dbname" class="form-control <?php echo (!empty($database_err)) ? 'is-invalid' : ''; ?>" id="dbname" placeholder="dbname">
						<label for="dbname">Datenbank</label>
						<span class="invalid-feedback"><?php echo $database_err; ?></span>
					</div>
					<div class="form-floating">
						<input type="textmiddle" name="dbusername" class="form-control <?php echo (!empty($database_err)) ? 'is-invalid' : ''; ?>" id="dbusername" placeholder="username">
						<label for="dbusername">Benutzer</label>
						<span class="invalid-feedback"><?php echo $database_err; ?></span>
					</div>
					<div class="form-floating">
						<input type="password" name="dbpassword" class="form-control <?php echo (!empty($database_err)) ? 'is-invalid' : ''; ?>" id="dbpassword" placeholder="password">
						<label for="dbpassword">Passwort</label>
						<span class="invalid-feedback"><?php echo $database_err; ?></span>
					</div>
				</fieldset>
				<fieldset>
					<legend>App:</legend>
					<div class="form-floating">
						<input type="texttop" name="apptitel" class="form-control" id="apptitel" placeholder="Cocktailbar Web App">
						<label for="apptitel">Titel</label>
					</div>
					<div class="form-floating">
						<input type="textmiddle" name="appusername" class="form-control" id="appusername" placeholder="username">
						<label for="appusername">Benutzer</label>
					</div>
					<div class="form-floating">
						<input type="password" name="apppassword" class="form-control" id="apppassword" placeholder="password">
						<label for="apppassword">Passwort</label>
					</div>
					<div class="form-check text-start my-3">
						<input class="form-check-input" type="checkbox" value="remember-me" id="appdataimport">
						<label class="form-check-label" for="appdataimport">Datenimport durchführen</label>
					</div>
				</fieldset>
				<button class="btn btn-primary w-100 py-2" type="submit">Installieren</button>
			</form>
<?php 
}
include("footer_login.php") ?>