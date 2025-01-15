<?php include("header.php") ?>
<?php 
	$wikiid = "";
	$wikiname = "";
	$wikicontent = "";
	$wikiicon = "";
	$wikisearch;
	
	if(empty($_GET['wikiid'])){
		$wikiid = 0;
	}
	else{
		$wikiid = $_GET['wikiid'];
	}
	$stmt_sql_wiki = mysqli_prepare($link, $sql_wiki);
	mysqli_stmt_bind_param($stmt_sql_wiki, "i", $wikiid);
	mysqli_stmt_execute($stmt_sql_wiki);
	$wiki_all_res=mysqli_stmt_get_result($stmt_sql_wiki);
	while($wiki_all_rows= mysqli_fetch_array($wiki_all_res, MYSQLI_ASSOC))
	{
		$wikiid = $wiki_all_rows['ID'];
		$wikiname = $wiki_all_rows['wikiname'];
		$wikicontent = $wiki_all_rows['content'];
		$wikiicon = $wiki_all_rows['icon'];
		$wikisearch = $wiki_all_rows['subsearch'];
	}
	mysqli_stmt_close($stmt_sql_wiki);
?>
			<nav class="navbar navbar-dark fixed-top bg-primary text-white" style="z-index: 900; margin-top: 56px">
				<div class="scrolling-wrapper-flexbox">
					<a href="wiki.php" class="btn btn-primary text-uppercase active" aria-current="page" data-toggle="tooltip" data-placement="bottom" title="<?php echo $wikiname;?>">
						<i class="fa fa-fw <?php echo $wikiicon;?>"></i> <?php echo $wikiname;?>
					</a>
				</div>
			</nav>
			<div class="list-group flex-fill">
				<label class="list-group-item d-flex gap-3">
					<p><?php echo $wikicontent;?></p>
				</label>
			</div>
			<div class="list-group flex-fill">
<?php 
if(!empty($wikisearch)){
	if($wikisearch == 'tools')	{
		$stmt_sql_wikisub = mysqli_prepare($link, $sql_wiki_tools);
	}
	else if($wikisearch == 'preperations')	{
		$stmt_sql_wikisub = mysqli_prepare($link, $sql_wiki_preperations);
	}
	else if($wikisearch == 'categorys')	{
		$stmt_sql_wikisub = mysqli_prepare($link, $sql_wiki_categorys);
	}
	mysqli_stmt_execute($stmt_sql_wikisub);
	$wikisub_all_res=mysqli_stmt_get_result($stmt_sql_wikisub);
	while($wikisub_all_rows= mysqli_fetch_array($wikisub_all_res, MYSQLI_ASSOC)){
?>
				<div class="list-group-item d-flex gap-3 py-3">
<?php 
	if(!empty($wikisub_all_rows['icon'])){
?>
					<i class="fa fa-fw fa-2x <?php echo $wikisub_all_rows['icon'];?>"></i>
<?php 
	}
?>
					<div class="d-flex gap-2 w-100 justify-content-between">
					<div>
						<h6 class="mb-0"><b><?php echo $wikisub_all_rows['name'];?></b></h6>
						<p class="mb-0"><?php echo $wikisub_all_rows['description'];?></p>
					</div>
				</div>
			</div>
<?php
	}
	mysqli_stmt_close($stmt_sql_wikisub);
	}
?>
		</div>
<?php include("footer.php") ?>