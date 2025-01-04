<?php include("header.php") ?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px">
				<div class="scrolling-wrapper-flexbox">
					<a href="debug.php" class="btn btn-primary text-uppercase active" aria-current="page" data-toggle="tooltip" data-placement="bottom" title="Debug Infos der App">
						<i class="fa fa-fw fa-solid fa-bug"></i> Debug
					</a>
				</div>
			</nav>
			<div class="accordion">
				<div class="accordion-item">
					<h2 class="accordion-header">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" data-toggle="tooltip" data-placement="bottom" title="PHP Session Info Array">Session Infos</button>
					</h2>
					<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
						<div class="accordion-body">
							<pre>
<?php echo print_r($_SESSION, TRUE); ?>
							</pre>
						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" data-toggle="tooltip" data-placement="bottom" title="Browser Infos">Browser Info</button>
					</h2>
					<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
						<div class="accordion-body">
							<pre>
<?php echo $_SERVER['HTTP_USER_AGENT'];?>
							</pre>
							<pre>
<?php echo print_r(get_browser(null, true), TRUE); ?>
							</pre>
						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" data-toggle="tooltip" data-placement="bottom" title="PHP Info Seite">PHP Info</button>
					</h2>
					<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
						<div class="accordion-body">
							<?php ob_start();
							phpinfo();
							$pinfo = ob_get_contents();
							ob_end_clean();
							 
							
							$config = array(
           'indent'         => true,
           'output-xhtml'   => true,
           'wrap'           => 200);
		   
		   $tidy = new tidy;
$tidy->parseString($pinfo, $config, 'utf8');
$tidy->cleanRepair();
							$tidy = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$tidy);
							echo $tidy; ?>
						</div>
					</div>
				</div>
			</div>
<?php include("footer.php") ?>