<?php $assets_url = $this->config->item('assets_url');?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>HIV Self-Test::<?= @$pagetitle; ?></title>
	<link rel="stylesheet" href="<?= @$assets_url; ?>dashboard/vendor/fontawesome/css/font-awesome.css" />
	<link rel="stylesheet" href="<?= @$assets_url; ?>dashboard/vendor/metisMenu/dist/metisMenu.css" />
	<link rel="stylesheet" href="<?= @$assets_url; ?>dashboard/vendor/animate.css/animate.css" />
	<link rel="stylesheet" href="<?= @$assets_url; ?>dashboard/vendor/bootstrap/dist/css/bootstrap.css" />
	<link rel="stylesheet" href="<?= @$assets_url; ?>dashboard/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
	<link rel="stylesheet" href="<?= @$assets_url; ?>dashboard/fonts/pe-icon-7-stroke/css/helper.css" />
	<link rel="stylesheet" href="<?= @$assets_url; ?>dashboard/styles/style.css">

	<?= @$page_css; ?>

	<!-- <style type="text/css">
		div.dataTables_processing { z-index: 9999999999999999999999999999999999999; }
	</style> -->
	
</head>
<body class="fixed-navbar sidebar-scroll">
	<!-- Header -->
	<div id="header">
		<div class="color-line"></div>
		<div id="logo" class="light-version">
			<span>
			BE SELF SURE
			</span>
		</div>
		<nav role="navigation">
			<div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
			<div class="small-logo">
				<span class="text-primary">BE SELF SURE</span>
			</div>
			<form role="search" class="navbar-form-custom" method="post" action="#">
				<div class="form-group">
					<input type="text" placeholder="Search something special" class="form-control" name="search">
				</div>
			</form>
			<div class="mobile-menu">
				<button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
					<i class="fa fa-chevron-down"></i>
				</button>
				<div class="collapse mobile-navbar" id="mobile-collapse">
					<ul class="nav navbar-nav">
						<li>
							<a class="" href="#">Profile</a>
						</li>
						<li>
							<a class="" href="<?= @base_url('Auth/signout'); ?>">Logout</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="navbar-right">
			<ul class="nav navbar-nav no-borders">
				<li class="dropdown">
					<a href="<?= @base_url('Auth/signout'); ?>">
						<i class="pe-7s-upload pe-rotate-90"></i>
					</a>
				</li>
			</ul>
			</div>
		</nav>
	</div>

	<!-- Navigation -->
	<aside id="menu">
		<div id="navigation">
			<div class="profile-picture">
				<a href="#">
					<img style="width: 76px;height:76px;" src="<?php if($user_details->user_avatar == NULL){?><?= @$assets_url; ?>dashboard/images/no_profile.png<?php } else { echo base_url($user_details->user_avatar); } ?>" class="img-circle m-b" alt="logo">
				</a>

				<div class="stats-label text-color">
					<span class="font-extra-bold font-uppercase"><?= @$user_details->user_firstname; ?> <?= @$user_details->user_lastname; ?></span>

					<div class="dropdown">
						<a class="dropdown-toggle" href="#" data-toggle="dropdown">
							<small class="text-muted"><?= @$user_details->user_type; ?> <b class="caret"></b></small>
						</a>
						<ul class="dropdown-menu animated flipInX m-t-xs">
							<li><a href="#">Profile</a></li>
							<li><a href="#">Analytics</a></li>
							<li class="divider"></li>
							<li><a href="<?= @base_url('Auth/signout'); ?>">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>

			<ul class="nav" id="side-menu">
				<?= @$menu; ?>
			</ul>
		</div>
	</aside>

	<!-- Main Wrapper -->
	<div id="wrapper">

	<div class="content animate-panel">
		<?= @$this->load->view($partial, $partialData); ?>
	</div>

	<!-- Footer-->
	<footer class="footer">
		<span class="pull-right">
			Pharmaceutical Society of Kenya
		</span>
		&copy; <?= @date("Y");?>
	</footer>

	</div>

	<!-- Vendor scripts -->

	<script src="<?= @$assets_url; ?>dashboard/vendor/jquery/dist/jquery.min.js"></script>
	<script src="<?= @$assets_url; ?>dashboard/vendor/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?= @$assets_url; ?>dashboard/vendor/slimScroll/jquery.slimscroll.min.js"></script>
	<script src="<?= @$assets_url; ?>dashboard/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?= @$assets_url; ?>dashboard/vendor/metisMenu/dist/metisMenu.min.js"></script>
	<script src="<?= @$assets_url; ?>dashboard/vendor/iCheck/icheck.min.js"></script>
	<script src="<?= @$assets_url; ?>dashboard/vendor/peity/jquery.peity.min.js"></script>
	<script src="<?= @$assets_url; ?>dashboard/vendor/sparkline/index.js"></script>
	<!-- App scripts -->
	<script src="<?= @$assets_url; ?>dashboard/scripts/homer.js"></script>
	<script src="<?= @$assets_url; ?>dashboard/scripts/charts.js"></script>
	<?= @$page_js; ?>

	<?php if(isset($javascript_file)) { ?>
		<?php $this->load->view($javascript_file, $javascript_data); ?>
	<?php } ?>
</body>
</html>