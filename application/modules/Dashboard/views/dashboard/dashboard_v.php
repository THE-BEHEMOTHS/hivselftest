<style type="text/css">
	select.FormField{
		display: block;
		width: 100%;
		height: 34px;
		padding: 6px 12px;
		font-size: 14px;
		line-height: 1.42857143;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
		-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
		-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
		transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
	}

	.Dashboard-footer, .Dashboard-header {
		margin: -1.5em -1.5em 1.5em;
		padding: 1.5em;
	}

	.Dashboard-header {
		border-bottom: 1px solid #d4d2d0;
	}

	@media (min-width: 1024px){
		.FlexGrid {
			margin: 0 0 -2em -2em !important;
		}
	}

	.FlexGrid {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-flex-wrap: wrap;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
		list-style: none;
		margin: 0 0 -1.5em -1.5em;
		padding: 0;
	}

	@media (min-width: 1024px){
		.FlexGrid-item {
			margin: 0 0 2em 2em !important;
		}
	}

	@media (min-width: 570px){
		.FlexGrid-item {
			-webkit-flex-basis: 200px !important;
			-ms-flex-preferred-size: 200px !important;
			flex-basis: 200px !important;
		}
	}

	.FlexGrid-item {
		-webkit-box-flex: 1;
		-webkit-flex: 1 0 -webkit-calc(100% - 1.5em);
		-ms-flex: 1 0 calc(100% - 1.5em);
		flex: 1 0 calc(100% - 1.5em);
		margin: 0 0 1.5em 1.5em;
		float: left;
	}

	.FlexGrid-item--fixed {
		-webkit-box-flex: 0!important;
		-webkit-flex: 0 0 auto!important;
		-ms-flex: 0 0 auto!important;
		flex: 0 0 auto!important;
	}

	.Titles {
		font-weight: 300;
		line-height: 1.2;
		margin: 0 0 1.5em;
	}

	.Titles-main {
		font-size: 1.4em !important;
	}

	.Titles-main, .Titles-sub {
		color: inherit;
		font: inherit;
		margin: 0;
	}

	.Titles-sub {
		opacity: .6;
		margin-top: .2em;
	}
	@media (min-width: 570px){
		.ViewSelector, .ViewSelector2 {
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			margin: 0 0 -1em -1em;
			width: -webkit-calc(100% + 1em);
			width: calc(100% + 1em);
		}
	}

	@media (min-width: 570px){
		.ViewSelector2-item, .ViewSelector table {
			-webkit-box-flex: 1;
			-webkit-flex: 1 1 -webkit-calc(100%/3 - 1em);
			-ms-flex: 1 1 calc(100%/3 - 1em);
			flex: 1 1 calc(100%/3 - 1em);
			margin-left: 1em;
		}
	}

	.ViewSelector2-item, .ViewSelector table {
		display: block;
		margin-bottom: 1em;
		width: 100%;
	}

	.ViewSelector2-item>label, .ViewSelector td:first-child {
		font-weight: 700;
		margin: 0 .25em .25em 0;
		display: block;
	}
</style>
<script>
(function(w,d,s,g,js,fs){
	g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
	js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
	js.src='https://apis.google.com/js/platform.js';
	fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
}(window,document,'script'));

gapi.analytics.ready(function() {
	var CLIENT_ID = '<?= @$this->config->item('client_id'); ?>';

	gapi.analytics.auth.authorize({
		container: 'embed-api-auth-container',
		clientid: CLIENT_ID,
	});
});
</script>
<!-- <div class="row">
	<div class="col-lg-12">

		<div class="hpanel">
		
			<div class="panel-heading">
				<div class="panel-tools">
					<a class="showhide"><i class="fa fa-chevron-up"></i></a>
					<a class="closebox"><i class="fa fa-times"></i></a>
				</div>
				Dashboard information and statistics
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-3 text-center">
						<div class="small">
							<i class="fa fa-bolt"></i> Page views
						</div>
						<div>
						<h1 class="font-extra-bold m-t-xl m-b-xs">
							<span class = "google_numbers">226,802</span>
						</h1>
						<small>Page views in <span class = "number_of_days">Last 7 Days</span></small>
						</div>
					</div>
					<div class="col-md-6">
						<div class="text-center small">
							<i class="fa fa-laptop"></i> Active users in current month (<?= @date('F'); ?>)
						</div>
						<div class="flot-chart" style="height: 160px">
							
						</div>
					</div>
					<div class="col-md-3 text-center">
						<div class="small">
							<i class="fa fa-calendar-o"></i> Statistics duration
						</div>
						<div>
							<h1 class="font-extra-bold m-t-xl m-b-xs">
								7 Days
							</h1>
							<small>Data From Google Analytics</small>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->
<div class="row">
	<div class="col-lg-3">
		<div class="hpanel">
			<div class="panel-body h-200">
				<div class="stats-title pull-left">
					<h4>Page Views</h4>
				</div>
				<div class="stats-icon pull-right">
					<i class="pe-7s-monitor fa-4x"></i>
				</div>
				<div class="m-t-xl">
					<h1 class="text-success"><span class = "google_numbers">860k+</span></h1>
					<span class="font-bold no-margins">
						Users
					</span>
					<br>
					<small>
						There are statistics from Google Analytics.<br>
						Data from last 7 Days
					</small>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="hpanel">
			<div class="panel-body h-200">
				<div class="stats-title pull-left">
					<h4>Surveys</h4>
				</div>
				<div class="stats-icon pull-right">
					<i class="pe-7s-news-paper fa-4x"></i>
				</div>
				<div class="m-t-xl">
					<h1 class="text-success"><span id = "numbers"><?= @$stats['surveys']; ?></span></h1>
					<span class="font-bold no-margins">
						Users
					</span>
					<br>
					<small>
						Users have filled in some surveys<br>
						Data from last 7 Days
					</small>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="hpanel">
			<div class="panel-body h-200">
				<div class="stats-title pull-left">
					<h4>PHARMACIES</h4>
				</div>
				<div class="stats-icon pull-right">
					<i class="fa fa-medkit fa-4x"></i>
				</div>
				<div class="m-t-xl">
					<h1 class="text-success"><span id = "numbers"><?= @$stats['pharmacies']; ?></span></h1>
					<span class="font-bold no-margins">
						Available
					</span>
					<br>
					<small>
						These are the total number of pharmacies where the patients can find the test kits
					</small>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="hpanel">
			<div class="panel-body h-200">
				<div class="stats-title pull-left">
					<h4>REFERAL SITES</h4>
				</div>
				<div class="stats-icon pull-right">
					<i class="fa fa-hospital-o fa-4x"></i>
				</div>
				<div class="m-t-xl">
					<h1 class="text-success"><span id = "numbers"><?= @$stats['referrals']; ?></span></h1>
					<span class="font-bold no-margins">
						Available
					</span>
					<br>
					<small>
						These are the total number of facilities that the users can visit
					</small>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="hpanel">
			<div class="panel-body h-200">
				<header class = "Dashboard-header">
					<ul class="FlexGrid">
						<li class="FlexGrid-item">
							<div class="Titles">
								<h1 class="Titles-main" id="view-name"></h1>
								<div class="Titles-sub">Various visualizations</div>
							</div>
						</li>
						<li class="FlexGrid-item FlexGrid-item--fixed">
							<div id="active-users-container"></div>
						</li>
					</ul>
					<div id="view-selector-container"></div>
					<div class = "row">
						<div class = "col-md-8">
						</div>
						<div class = "col-md-4">
							<div class = "form-group">
								<input type = 'text' name = 'date-ranges' class = 'form-control'/>
							</div>
						</div>
					</div>
				</header>
				<div class="row">
					<div class="col-md-6">
						<h3>This Week vs Last Week (by sessions)</h3>
						<figure class="Chartjs-figure" id="chart-1-container"></figure>
						<ol class="Chartjs-legend" id="legend-1-container"></ol>
					</div>
					<div class="col-md-6">
						<h3>This Year vs Last Year (by users)</h3>
						<figure class="Chartjs-figure" id="chart-2-container"></figure>
						<ol class="Chartjs-legend" id="legend-2-container"></ol>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<h3>Top Browsers (by pageview)</h3>
						<figure class="Chartjs-figure" id="chart-3-container"></figure>
						<ol class="Chartjs-legend" id="legend-3-container"></ol>
					</div>
					<div class="col-md-6">
						<h3>Top Countries (by sessions)</h3>
						<figure class="Chartjs-figure" id="chart-4-container"></figure>
						<ol class="Chartjs-legend" id="legend-4-container"></ol>
					</div>
				</div>
				
			</div>

			<div class="panel-footer">
				<div id="embed-api-auth-container"></div>
				<button id = 'auth-logout'>Logout</button>
			</div>
		</div>	
	</div>
</div>