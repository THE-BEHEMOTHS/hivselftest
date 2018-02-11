<?php $assets_url = $this->config->item('assets_url') . "dashboard/"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>BESURE APP LOGIN</title>

	<link rel="stylesheet" href="<?= @$assets_url; ?>vendor/fontawesome/css/font-awesome.css" />
	<link rel="stylesheet" href="<?= @$assets_url; ?>vendor/metisMenu/dist/metisMenu.css" />
	<link rel="stylesheet" href="<?= @$assets_url; ?>vendor/animate.css/animate.css" />
	<link rel="stylesheet" href="<?= @$assets_url; ?>vendor/bootstrap/dist/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?= @$assets_url; ?>vendor/sweetalert/lib/sweet-alert.css">
	<link rel="stylesheet" href="<?= @$assets_url; ?>vendor/ladda/dist/ladda-themeless.min.css" />
	<link rel="stylesheet" href="<?= @$assets_url; ?>vendor/toastr/build/toastr.min.css" />

	<!-- App styles -->
	<link rel="stylesheet" href="<?= @$assets_url; ?>fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
	<link rel="stylesheet" href="<?= @$assets_url; ?>fonts/pe-icon-7-stroke/css/helper.css" />
	<link rel="stylesheet" href="<?= @$assets_url; ?>styles/style.css">

	<?= @$page_css;?>
</head>
<body class = "blank">
	<div class="login-container">
		<div class="row">
			<div class="col-md-12">
				<?= @$this->load->view($partial); ?>
			</div>
		</div>	
	</div>

	<script type="text/javascript">
		var base_url = "<?= @base_url(); ?>";
	</script>

	<script src="<?= @$assets_url; ?>vendor/jquery/dist/jquery.min.js"></script>
	<script src="<?= @$assets_url; ?>vendor/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?= @$assets_url; ?>vendor/slimScroll/jquery.slimscroll.min.js"></script>
	<script src="<?= @$assets_url; ?>vendor/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?= @$assets_url; ?>vendor/metisMenu/dist/metisMenu.min.js"></script>
	<script src="<?= @$assets_url; ?>vendor/iCheck/icheck.min.js"></script>
	<script src="<?= @$assets_url; ?>vendor/ladda/dist/spin.min.js"></script>
	<script src="<?= @$assets_url; ?>vendor/ladda/dist/ladda.min.js"></script>
	<script src="<?= @$assets_url; ?>vendor/ladda/dist/ladda.jquery.min.js"></script>
	<script src="<?= @$assets_url; ?>vendor/sparkline/index.js"></script>
	<script src="<?= @$assets_url; ?>vendor/sweetalert/lib/sweet-alert.min.js"></script>
	<script src="<?= @$assets_url; ?>vendor/toastr/build/toastr.min.js"></script>

	<script src="<?= @$assets_url; ?>scripts/login.js"></script>
	<script src="<?= @$assets_url; ?>scripts/homer.js"></script>

	<?= @$page_js; ?>
	<?php if(isset($javascript_file)) { ?>
		<?php $this->load->view($javascript_file, $javascript_data); ?>
	<?php } ?>
</body>
</html>