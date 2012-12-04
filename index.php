<?php
	require_once('config.php');
	if(isset($_GET['p'])) {
		$page=$_GET['p'];
		$pages = array('register','login','logout','home','addons','authors','help','about','melder');
		if(! in_array($page, $pages)) {
			$page='404';
		}
	} else {
		$page='home';
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Arcfolder Firefall Addon Repository - Home</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Styles -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<style type="text/css">
			body {
				padding-top: 60px;
				padding-bottom: 40px;
			}
		</style>
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Fav and touch icons -->
		<link rel="shortcut icon" href="assets/img/favicon.ico">
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#">Arcfolder</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li <?php if($page=='home') {echo 'class="active"';} ?>>
								<a href="<?php if($page=='home') {echo '#" onclick="return false;';} else {echo tpl::wr($_).'home';} ?>">Home</a>
							</li>
							<li <?php if($page=='addons') {echo 'class="active"';} ?> >
								<a href="<?php if($page=='addons') {echo '#" onclick="return false;';} else {echo tpl::wr($_).'addons';} ?>">Addons</a>
							</li>
							<li <?php if($page=='authors') {echo 'class="active"';} ?> >
								<a href="<?php if($page=='authors') {echo '#" onclick="return false;';} else {echo tpl::wr($_).'authors';} ?>">Authors</a>
							</li>
							<li <?php if($page=='help') {echo 'class="active"';} ?> >
								<a href="<?php if($page=='help') {echo '#" onclick="return false;';} else {echo tpl::wr($_).'help';} ?>">Help</a>
							</li>
							<li <?php if($page=='about') {echo 'class="active"';} ?> >
								<a href="<?php if($page=='about') {echo '#" onclick="return false;';} else {echo tpl::wr($_).'about';} ?>">About</a>
							</li>
							<li <?php if($page=='melder') {echo 'class="active"';} ?> >
								<a href="<?php if($page=='melder') {echo '#" onclick="return false;';} else {echo tpl::wr($_).'melder';} ?>">Melder</a>
							</li>
						</ul>
						<form class="navbar-form pull-right" name="login" action="<?php tpl::wr($_); ?>login" method="post">
							<input class="span2" type="text" placeholder="Email">
							<input class="span2" type="password" placeholder="Password">
							<button type="submit" class="btn"><?php echo $authLoc['login_form_submit']; ?></button>
							<input name="trigger_login" type="hidden" value="true">
						</form>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>

		<div class="container">

			<?php require_once($_['fs_root'].'includes/pages/'.$page.'.php'); ?>

			<hr>

			<footer>
				<p>A <a href="http://www.binaryheartbeat.net/">Binary Heartbeat</a> production.
				Themed with <a href="http://twitter.github.com/bootstrap/">Bootstrap</a>.</p>
			</footer>

		</div> <!-- /container -->

		<!-- Javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="assets/js/jquery-1.8.2.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
	</body>
</html>
