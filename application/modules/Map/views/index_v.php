<style type="text/css">.custom-css-1488398861560{padding-top:50px;padding-right:40px;padding-bottom:50px;padding-left:40px;background-color:#ffffff;}.custom-css-1488398881957{padding-top:50px;padding-right:40px;padding-bottom:50px;padding-left:40px;background-color:#9373de;}</style>
<style type="text/css">
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
										<p>Contact phone at <a href="http://www.haltons.co.ke/"> Haltons Pharmacy</a></p>
											<h2 style="margin-bottom: 15px;">
												Pharmacies List
											</h2>

											<div class="form-group">
												<label class = 'control-label'>Counties</label>
												<select name = 'county' class="form-control" id = 'county_list'>
													<option value = ''>Please select a county to view pharmacies</option>
													<?= @$counties; ?>
												</select>
											</div>

											<div class="row">
												<div class="col-sm-12">
													<div class="table-responsive">
														<table id="pharmacy_table" class="table table-bodered" style="color: #555 !important;">
															<thead>
																<th>#</th>
																<th>Pharmacy Name</th>
																<th>Location</th>
																<th>County</th>
																<th>Map</th>
															</thead>
															<tbody>
																<?= @$pharmacy_table; ?>
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