<style type="text/css">.custom-css-1488398861560{padding-top:50px;padding-right:40px;padding-bottom:50px;padding-left:40px;background-color:#ffffff;}.custom-css-1488398881957{padding-top:50px;padding-right:40px;padding-bottom:50px;padding-left:40px;background-color:#9373de;}</style>
<style type="text/css">
	.table {
		width: 100%;
		max-width: 100%;
		margin-bottom: 1rem;
	}

	table{
		border-collapse: collapse;
		background-color: transparent;
	}

	.table thead th {
		vertical-align: bottom;
		border-bottom: 2px solid #eceeef;
	}

	.table td, .table th {
		padding: .75rem;
		vertical-align: top;
		border-top: 1px solid #eceeef;
	}

	th {
		text-align: left;
		text-transform: uppercase;
	}

	.table-striped tbody tr:nth-of-type(odd) {
		background-color: rgba(0,0,0,.05);
	}

	table thead th{
		color: #555 !important;
	}

	.row{
		margin-top: 15px !important;
	}

	#content{
		font-family: 'Raleway', sans-serif;
	}
</style>
<div id="content" class="site-content container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="content">
				<div class="row-wrapper">
					<div class = "row-container container row-full-width row-no-padding">
						<div class="row">
							<div class="column col-sm-12">
								<div class="column-inner">
									<div class="column-content">
										<div class="content-element google-map-wrapper">
											<div id="map" class = "google-map gmap-ratio-4-1 is-ready" style="position: relative; overflow: hidden;height: 500px;"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-wrapper">
					<div class="row-container container">
						<div class="row columns-equal-height columns-no-margins">
							<div class="column col-sm-12">
								<div class="column-inner">
									<div class="column-content">
										<div data-animation="fadeInUp" class="animate-element animate-stagger is-animated fadeInUp">
											<h2 style="margin-bottom: 15px;">
												Referral Sites
											</h2>
											<div class="form-group">
												<select class = "form-control" name="county" placeholder = "Please pick a county to continue">
													<option value="">Select a County to continue</option>
													<?= @$counties; ?>
												</select>
											</div>
											
											<div class="row">
												<div class="col-sm-12">
													<div class="table-responsive">
														<table class="table table-bodered" style="color: #555 !important;" id = "facilities_table">
															<thead>
																<th>#</th>
																<th>Facility Name</th>
																<th>Nearest Town</th>
																<th>Description</th>
																<th>Map</th>
															</thead>
															<tbody>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</div>
<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script> -->
<!-- <div id="map"></div> -->