<?php $assets_url = $this->config->item('assets_url'); ?>
<!DOCTYPE html>
<html lang="en-US" class="js flexbox no-flexboxtweener skrollr skrollr-desktop">
	<head>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-97849436-1', 'auto');
			ga('send', 'pageview');

		</script>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta property="og:url"           content="http://<?= @$_SERVER['SERVER_NAME']; ?>/" />
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="BE SELF SURE" />
		<meta property="og:description"   content="The best thing one can do is to be self sure. We need you to know your status today" />
		<meta property="og:image"         content="http://www.besure.co.ke/assets/img/banners/banner-1600x900-4-purple.png" />

		<title>HIV Self Test :: Home</title>

		<link rel="stylesheet" href="<?= @$assets_url; ?>dist/css/bootstrap.min.css" type="text/css" media="all">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans:700%7CUbuntu:400,500,700,400italic&amp;subset=latin" type="text/css" media="all">
		<link rel="stylesheet" href="<?= @$assets_url; ?>font-icons/fontello/css/apalodi-fontello.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?= @$assets_url; ?>css/style.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?= @$assets_url; ?>css/style-custom.css" type="text/css" media="all">
		<?= @$page_css; ?>
		
		
		<style type="text/css">
		.aslider-home-modern .aslider-swiper-wrapper{min-height:95vh}.aslider-home-modern{background-color:#28353D}.aslider-home-modern .aslider-preloader-4{background-color:#9373DE}.aslider-home-modern .aslider-preloader-4::before{background-color:#28353D}.aslider-home-modern .aslider-no-slides{color:#9373DE}.aslider-home-modern .aslider-content{max-width:1180px}

		.aslider-home-modern .aslider-slide-0 .aslider-content-inner{max-width:700px}.aslider-home-modern .aslider-slide-0:not(.has-video) .aslider-media{background-image:url("<?= @$assets_url; ?>img/banners/banner-1600x900-1-purple.png");background-position:center center;background-size:cover;background-repeat:no-repeat}.aslider-home-modern .aslider-slide-0 .aslider-media-overlay{background-color:rgba(147,115,222,0)}.aslider-home-modern .aslider-slide-0 .aslider-button-primary{background-color:#fff;border-color:#fff;color:#9373DE}.aslider-home-modern .aslider-slide-0 .aslider-button-primary:hover{background-color:#28353D;border-color:#28353D;color:#fff}.aslider-home-modern .aslider-slide-0 .aslider-button-primary:before{background-color:#28353D}.aslider-home-modern .aslider-slide-0 .aslider-button-secondary{background-color:rgba(255,255,255,0);border-color:#fff;color:#fff}.aslider-home-modern .aslider-slide-0 .aslider-button-secondary:hover{background-color:#28353D;border-color:#28353D;color:#fff}.aslider-home-modern .aslider-slide-0 .aslider-button-secondary:before{background-color:#28353D}.aslider-home-modern .aslider-slide-0 .aslider-title{color:#fff}.aslider-home-modern .aslider-slide-0 .aslider-subtitle{color:rgba(255,255,255,.8)}.aslider-home-modern .aslider-slide-0 .aslider-description{color:#fff}.aslider-home-modern .aslider-slide-0 .aslider-content em{color:rgba(255,255,255,.8)}.aslider-home-modern .aslider-slide-0 .aslider-content a:not(.button){border-color:rgba(255,255,255,.1)}.aslider-home-modern .aslider-slide-0 .aslider-content a:not(.button):hover{background-color:rgba(255,255,255,.1)}


		.aslider-home-modern .aslider-slide-1 .aslider-content-inner{max-width:700px}.aslider-home-modern .aslider-slide-1:not(.has-video) .aslider-media{background-image:url("<?= @$assets_url; ?>img/banners/banner-1600x900-2-yellow.png");background-position:center center;background-size:cover;background-repeat:no-repeat}.aslider-home-modern .aslider-slide-1 .aslider-media-overlay{background-color:rgba(147,115,222,0)}.aslider-home-modern .aslider-slide-1 .aslider-button-primary{background-color:#fff;border-color:#fff;color:#9373DE}.aslider-home-modern .aslider-slide-1 .aslider-button-primary:hover{background-color:#28353D;border-color:#28353D;color:#fff}.aslider-home-modern .aslider-slide-1 .aslider-button-primary:before{background-color:#28353D}.aslider-home-modern .aslider-slide-1 .aslider-button-secondary{background-color:rgba(255,255,255,0);border-color:#fff;color:#fff}.aslider-home-modern .aslider-slide-1 .aslider-button-secondary:hover{background-color:#28353D;border-color:#28353D;color:#fff}.aslider-home-modern .aslider-slide-1 .aslider-button-secondary:before{background-color:#28353D}.aslider-home-modern .aslider-slide-1 .aslider-title{color:#fff}.aslider-home-modern .aslider-slide-1 .aslider-subtitle{color:rgba(255,255,255,.8)}.aslider-home-modern .aslider-slide-1 .aslider-description{color:#fff}.aslider-home-modern .aslider-slide-1 .aslider-content em{color:rgba(255,255,255,.8)}.aslider-home-modern .aslider-slide-1 .aslider-content a:not(.button){border-color:rgba(255,255,255,.1)}.aslider-home-modern .aslider-slide-1 .aslider-content a:not(.button):hover{background-color:rgba(255,255,255,.1)}

		.aslider-home-modern .aslider-slide-2 .aslider-content-inner{max-width:700px}.aslider-home-modern .aslider-slide-2:not(.has-video) .aslider-media{background-image:url("<?= @$assets_url; ?>img/banners/banner-1600x900-3-purple.png");background-position:center center;background-size:cover;background-repeat:no-repeat}.aslider-home-modern .aslider-slide-2 .aslider-media-overlay{background-color:rgba(147,115,222,0)}.aslider-home-modern .aslider-slide-2 .aslider-button-primary{background-color:#fff;border-color:#fff;color:#9373DE}.aslider-home-modern .aslider-slide-2 .aslider-button-primary:hover{background-color:#28353D;border-color:#28353D;color:#fff}.aslider-home-modern .aslider-slide-2 .aslider-button-primary:before{background-color:#28353D}.aslider-home-modern .aslider-slide-2 .aslider-button-secondary{background-color:rgba(255,255,255,0);border-color:#fff;color:#fff}.aslider-home-modern .aslider-slide-2 .aslider-button-secondary:hover{background-color:#28353D;border-color:#28353D;color:#fff}.aslider-home-modern .aslider-slide-2 .aslider-button-secondary:before{background-color:#28353D}.aslider-home-modern .aslider-slide-2 .aslider-title{color:#fff}.aslider-home-modern .aslider-slide-2 .aslider-subtitle{color:rgba(255,255,255,.8)}.aslider-home-modern .aslider-slide-2 .aslider-description{color:#fff}.aslider-home-modern .aslider-slide-2 .aslider-content em{color:rgba(255,255,255,.8)}.aslider-home-modern .aslider-slide-2 .aslider-content a:not(.button){border-color:rgba(255,255,255,.1)}.aslider-home-modern .aslider-slide-2 .aslider-content a:not(.button):hover{background-color:rgba(255,255,255,.1)}

		.aslider-home-modern .aslider-slide-3 .aslider-content-inner{max-width:700px}.aslider-home-modern .aslider-slide-3:not(.has-video) .aslider-media{background-image:url("<?= @$assets_url; ?>img/banners/banner-1600x900-4-yellow.png");background-position:center center;background-size:cover;background-repeat:no-repeat}.aslider-home-modern .aslider-slide-3 .aslider-media-overlay{background-color:rgba(147,115,222,0)}.aslider-home-modern .aslider-slide-3 .aslider-button-primary{background-color:#fff;border-color:#fff;color:#9373DE}.aslider-home-modern .aslider-slide-3 .aslider-button-primary:hover{background-color:#28353D;border-color:#28353D;color:#fff}.aslider-home-modern .aslider-slide-3 .aslider-button-primary:before{background-color:#28353D}.aslider-home-modern .aslider-slide-3 .aslider-button-secondary{background-color:rgba(255,255,255,0);border-color:#fff;color:#fff}.aslider-home-modern .aslider-slide-3 .aslider-button-secondary:hover{background-color:#28353D;border-color:#28353D;color:#fff}.aslider-home-modern .aslider-slide-3 .aslider-button-secondary:before{background-color:#28353D}.aslider-home-modern .aslider-slide-3 .aslider-title{color:#fff}.aslider-home-modern .aslider-slide-3 .aslider-subtitle{color:rgba(255,255,255,.8)}.aslider-home-modern .aslider-slide-3 .aslider-description{color:#fff}.aslider-home-modern .aslider-slide-3 .aslider-content em{color:rgba(255,255,255,.8)}.aslider-home-modern .aslider-slide-3 .aslider-content a:not(.button){border-color:rgba(255,255,255,.1)}.aslider-home-modern .aslider-slide-3 .aslider-content a:not(.button):hover{background-color:rgba(255,255,255,.1)}

		.aslider-home-modern .aslider-slide-4 .aslider-content-inner{max-width:700px}.aslider-home-modern .aslider-slide-4:not(.has-video) .aslider-media{background-image:url("<?= @$assets_url; ?>img/banners/banner-1600x900-5-purple.png");background-position:center center;background-size:cover;background-repeat:no-repeat}.aslider-home-modern .aslider-slide-4 .aslider-media-overlay{background-color:rgba(147,115,222,0)}.aslider-home-modern .aslider-slide-4 .aslider-button-primary{background-color:#fff;border-color:#fff;color:#9373DE}.aslider-home-modern .aslider-slide-4 .aslider-button-primary:hover{background-color:#28353D;border-color:#28353D;color:#fff}.aslider-home-modern .aslider-slide-4 .aslider-button-primary:before{background-color:#28353D}.aslider-home-modern .aslider-slide-4 .aslider-button-secondary{background-color:rgba(255,255,255,0);border-color:#fff;color:#fff}.aslider-home-modern .aslider-slide-4 .aslider-button-secondary:hover{background-color:#28353D;border-color:#28353D;color:#fff}.aslider-home-modern .aslider-slide-4 .aslider-button-secondary:before{background-color:#28353D}.aslider-home-modern .aslider-slide-4 .aslider-title{color:#fff}.aslider-home-modern .aslider-slide-4 .aslider-subtitle{color:rgba(255,255,255,.8)}.aslider-home-modern .aslider-slide-4 .aslider-description{color:#fff}.aslider-home-modern .aslider-slide-4 .aslider-content em{color:rgba(255,255,255,.8)}.aslider-home-modern .aslider-slide-4 .aslider-content a:not(.button){border-color:rgba(255,255,255,.1)}.aslider-home-modern .aslider-slide-4 .aslider-content a:not(.button):hover{background-color:rgba(255,255,255,.1)}


		.aslider-home-modern .aslider-title{font-size:40px}.aslider-home-modern .aslider-subtitle{font-size:12px;text-transform:uppercase}.aslider-home-modern .aslider-description{font-size:16px}.aslider-home-modern .aslider-button{font-size:12px;line-height:1;text-transform:uppercase}@media only screen and ( min-width : 660px ) {.aslider-home-modern .aslider-swiper-wrapper{min-height:95vh}.aslider-home-modern .aslider-title{font-size:45px}}@media only screen and ( min-width : 1025px ) {.aslider-home-modern .aslider-swiper-wrapper{min-height:95vh}.aslider-home-modern .aslider-title{font-size:55px}}
		</style>


		<style type="text/css">.custom-css-1488241484908{padding-top:90px;padding-bottom:90px}.custom-css-1488239830737{background-color:#fff;background-color:#fff}.custom-css-1488241938953{background-color:#28353d}.custom-css-1488244328363{padding:90px 20px 20px}.custom-css-1488245476729{padding-top:50px;padding-bottom:50px;background-color:#fff}.custom-css-1488041420143{background-color:#28353d;padding:80px 12%}.custom-css-1488041425297{padding:80px 12%}.custom-css-1488041385976{padding:80px 12%}.custom-css-1488239923758{border-color:#eee;border-style:solid;border-width:10px;padding:80px 12%}.custom-css-1488241686986{padding-top:200px}.custom-css-1488241607219{padding-top:200px}.custom-css-1488239923758{border-color:#eee;border-style:solid;border-width:10px;padding:80px 12%}.custom-css-1488242558389{padding:80px 12%}.custom-css-1488243026145{padding-top:200px}.custom-css-1488243053150{padding-top:200px}.custom-css-1488242590341{padding:80px 12%}.custom-css-1488245539123{background-color:rgba(255,255,255,0.01);*background-color:#fff;padding:0}.custom-css-1488423852758{padding-top:300px;}.custom-css-1488423872205{padding-top:50px;padding-right:12%;padding-bottom:50px;padding-left:12%;}.custom-css-1488422976635{padding-top:50px;padding-right:12%;padding-bottom:50px;padding-left:12%;background-color:#FFC107;}.custom-css-1488423931362{padding-top:200px;}.custom-css-1488423939872{padding-top:200px;}.custom-css-1488423223527{padding-top:50px;padding-right:12%;padding-bottom:50px;padding-left:12%;background-color:#9373de;

			</style>

			<style type="text/css">
				body{
					font-family: 'Raleway', sans-serif;
				}
				a:hover{
					text-decoration: none;
				}

				.social-icons ul{
					list-style-type: none;
					margin: 0;
					padding: 0;
					font-family: Raleway;
				}

				.social-icons ul li a {
					display: block;
				}
			</style>
	</head>
	<body class="header-transparent no-page-heading fluid-width no-top-content-padding no-bottom-content-padding">
		<div id="page" class="site">
			<header id="masthead" class="site-header header-resize is-light is-transparent" style="">
				<div class="site-header-container container">
					<div class="logo has-logo-light has-logo-dark" style="">
						<a href="<?= @base_url();?>" rel="home">
							<img class="logo-default"  src="<?= @$assets_url; ?>img/psk-logo.png" alt="Besure-Logo">
							<img class="logo-light"  src="<?= @$assets_url; ?>img/psk-logo.png" alt="Besure-Logo">
							<img class="logo-dark"  src="<?= @$assets_url; ?>img/psk-logo.png" alt="Besure-Logo">
						</a>
					</div>
					<div class="site-actions">
						<span class="mobile-menu-trigger hamburger-menu"><span></span></span>
						<span class="mobile-menu-close-trigger site-action-close slide-out-action-close is-active"><span></span></span>
						<span class="site-actions-overlay"></span>
					</div>
					<div class="site-header-inner">
						<div class="header-search-form">
							<form role="search" method="get" class="search-form" action="/">
								<label>
									<span class="screen-reader-text">Search for:</span>
									<input type="search" class="search-field" placeholder="Search" value="" name="s"/>
								</label>
								<button type="submit" class="search-submit"><span>Search</span></button>
							</form>
							<span class="header-search-form-close site-action-close"></span>
						</div>
						<div class="site-navigation-wrapper">
							<nav class="main-navigation">

							<ul class="site-nav">
								<li class="menu-item menu-item-has-children menu-no-link mega-menu mm-col-2 mega-menu-center"><a href="<?= @base_url('Home/');?>"><span><span class="menu-item-label">Home</span></span></a>
								</li>

								<li class="menu-item menu-item-has-children menu-no-link"><a href="<?= @base_url('Home/FAQ/');?>"><span><span class="menu-item-label">FAQs</span></span></a>
								</li>


								<li class="menu-item menu-item-has-children menu-no-link"><a href="<?= @base_url('Home/videos/');?>"><span><span class="menu-item-label">Conduct a Test</span></span></a>
								</li>



								

								<li class="menu-item menu-item-has-children menu-no-link">
									<a href="<?= @base_url('Map'); ?>"><span><span class="menu-item-label">Get a Kit</span></span></a>
								</li>

								<li class="menu-item menu-item-has-children menu-no-link">
									<a href="<?= @base_url('Referrals'); ?>"><span><span class="menu-item-label">Referral Sites</span></span></a>
								</li>

								<!-- <li class="menu-item menu-item-has-children menu-no-link"><a href="<?= @base_url('Home/Resources/');?>"><span><span class="menu-item-label">Resources</span></span></a></li> -->

								<li class="menu-item menu-item-has-children menu-no-link mega-menu mm-col-2 mega-menu-center is-mega-menu-centered"><a href="<?= @base_url('Home/Resources'); ?>"><span><span class="menu-item-label">Resources</span></span><i class="mobile-sub-menu-trigger apalodi-icon-right-circled-alt"></i></a>
									<ul class="sub-menu">
									<li class="menu-item menu-item-has-children menu-no-link menu-no-label"><a><span></span><i class="mobile-sub-menu-trigger apalodi-icon-right-circled-alt"></i></a>
									<ul class="sub-menu">
										<li class="menu-item"><a target="_blank" href="https://www.avert.org/" target="_blank"><span><span class="menu-item-label">Avert</span></span></a></li>
										<li class="menu-item"><a target="blank" href="http://www.one2onekenya.org/site/" target="_blank"><span><span class="menu-item-label">One2one Kenya</span></span></a></li>
										<li class="menu-item"><a target="_blank" href="http://nephak.or.ke/" target="_blank"><span><span class="menu-item-label">Nephak</span></span></a></li>
										<li class="menu-item"><a target="_blank" href="http://nacc.or.ke/" target="_blank"><span><span class="menu-item-label">Nacc</span></span></a></li>
									</ul>
									</li>
									<li class="menu-item menu-item-has-children menu-no-link menu-no-label"><a><span></span><i class="mobile-sub-menu-trigger apalodi-icon-right-circled-alt"></i></a>
									<ul class="sub-menu">
										<li class="menu-item"><a target="_blank" href="http://www.biolytical.com/" target="_blank"><span><span class="menu-item-label">Manufacturer Websites</span></span></a></li>
										<li class="menu-item"><a target="_blank" href="http://www.nascop.or.ke/" target="_blank"><span><span class="menu-item-label">Nascop</span></span></a></li>
										<li class="menu-item"><a target="_blank" href="http://whatisprep.org/" target="_blank"><span><span class="menu-item-label">Whatisprep</span></span></a></li>
									</ul>
									</li>
									</ul>
									</li>



								<li class="menu-item menu-font-icon menu-button"><a target="_blank" href="<?= @base_url('Dashboard'); ?>"><span><span class="menu-item-label">Login</span></span></a></li>
								<!-- <li>
									<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Launch demo modal</button>
							  	</li> -->
							</ul>

							</nav>
						</div>
					</div>
				</div>
			</header>

			<!-- Button trigger modal -->


<!-- Modal -->
<form method='POST' id="survey-form">

<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Please take your time to fill in this quick survey about yourself</h4>
      </div>
  	<div class="modal-body">
        
		  	<div class="form-group">
			    <label for="age">Age</label>
			    <input type="text" class="form-control" name="age" id="age" placeholder="Age" required="required"  />
	 	 	</div>

	 	 	<div class="form-group"> <label>Gender</label>
			  	<select name="gender" id="gender" class="form-control" required />
		  			<option value="">Select your gender</option>
			  		<!-- <option value="Male">Male</option>
			  		<option value="Female">Female</option> -->

			  		<?= @$gender; ?>
				</select>
			</div>

			<div class="form-group">
			  <label>Kit interested / Tested on</label>

				<?= @$kits; ?>

			</div>

			<div class="form-group">
				<label>Comments</label>
				<textarea name="comments" class="form-control" rows="3"></textarea>
			</div>
  		</div>
		<div class="modal-footer">
		  	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    <input type="submit" id="survey-submit" value="Submit" class="btn btn-primary">
		</div>

    </div>
  </div>
</div>
</form>


			<?= $this->load->view($partial, $partialData); ?>


			<footer id="colophon" class="site-footer">
				<div class="site-footer-container container">
					<div class="footer-logo">
						<a href="index.html" rel="home">
							<img src="<?= @$assets_url; ?>img/psk-logo.png" alt="PSK">
						</a>
					</div>
					<div class="footer-content">
						<nav class="footer-menu">
							<ul>
							<li class="menu-item"><a href="about-us.html">Do you need information, counseling or someone friendly to talk to about HIV & AIDS, Sex, STIs, Contraceptives, sexual and Gender Based Violence and other health, Teen or Youth related issues? SMS/CALL THE HELPLINE: 1190 Free from Safaricom line (Everyday 8am-8pm )</a></li>
							</ul>
						</nav>
						<div class="copyright">
							<p>© <a href="http://www.one2onekenya.org/site/" target="_blank">One 2 One</a> and <a href="" target="_blank">LVCTHealth</a></p>
						</div>
					</div>
					<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway|Lato|Open+Sans">
					<div class="footer-social" style="text-align: left;font-size: 1.5em;">
						<div class="social-icons" style = "float: left;">
							<ul>
								<li>
									<a href="<?= @$assets_url; ?>img/whatsapp.png" target="_blank">
										<!-- <img style="width:30px; height:30px;" src="<?= @$assets_url; ?>img/whatsapp.png"/> -->
										<i class = "fa fa-whatsapp"></i>&nbsp;&nbsp;0700-121-121
									</a>
								</li>

								<li>
									<a href="https://www.facebook.com/One2one-ke-144444975612410/?hc_location=ufi" target="_blank">
										<!-- <img style="width:30px; height:30px;" src="<?= @$assets_url; ?>img/facebook.png"/> -->
										<i class = "fa fa-facebook"></i>&nbsp;&nbsp;One2one ke
									</a>
								</li>

								<li>
									<a href="https://twitter.com/one2oneke?lang=en" target="_blank">
									<!-- <img style="width:30px; height:30px;" src="<?= @$assets_url; ?>img/twitter.png"/> -->
									<i class = "fa fa-twitter"></i>&nbsp;&nbsp;@one2oneKE</a>
								</li>

								<li>
									<a href="https://www.instagram.com/onetooneke/?hl=en" target="_blank">
									<!-- <img style="width:30px; height:30px;" src="<?= @$assets_url; ?>img/instagram.png"/> -->
									<i class = "fa fa-instagram"></i>&nbsp;&nbsp;onetoone Ke</a>
									</li>
							</ul>


						</div>
					</div>
				</div>
			</footer>


		</div>


		<button class="button back-to-top"></button>

		<link rel="stylesheet" href="<?= @$assets_url; ?>css/animate.min.css" type="text/css" media="all">

		<script type="text/javascript" src="<?= @$assets_url; ?>js/vendor/jquery.js"></script>
		<script type="text/javascript" src="<?= @$assets_url; ?>js/vendor/jquery-migrate.min.js"></script>
		<!-- <script type="text/javascript" src="<?= @$assets_url; ?>dist/js/bootstrap.min.js"></script> -->
		<script type="text/javascript" src="<?= @$assets_url; ?>js/vendor/modernizr.min.js"></script>
		<script type="text/javascript" src="<?= @$assets_url; ?>js/vendor/isotope.pkgd.min.js"></script>
		<script type="text/javascript">
			var base_url = "<?= @base_url(); ?>";
		</script>
		<script type="text/javascript" src="<?= @$assets_url; ?>js/plugins.js"></script>
		<script type="text/javascript" src="<?= @$assets_url; ?>js/main.js"></script>
		<?= @$page_js; ?>

		<?php if(isset($javascript_file)) { ?>
			<?php $this->load->view($javascript_file, $javascript_data); ?>
		<?php } ?>

		<?php
			if($this->router->fetch_class() == "Map" || $this->router->fetch_class() == "Referrals"){
		?>
			<script src="https://maps.googleapis.com/maps/api/js?key=<?= @$this->config->item('key'); ?>&callback=initMap" async defer></script>
			<script type="text/javascript" src = "<?= @$assets_url; ?>custom/markerclusterer.js"></script>
		<?php  } ?>

	</body>
</html>