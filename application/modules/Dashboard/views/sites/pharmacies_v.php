<div class="hpanel">
	<div class="panel-heading hbuilt">
		Pharmacy Listing
		<div class="pull-right">
			<a class="btn btn-default btn-xs" id="add-pharmacy" data-toggle="modal" data-target="#myModal10">Add Pharmacy</a>
		</div>
	</div>
	<div class="panel-body">
		<table class = "table table-bordered" id = "pharmacy_list">
			<thead>
				<th>#</th>
				<th>Pharmacy Name</th>
				<th>Contact Person</th>
				<th>Phone</th>
				<th style="width: 20%;">County</th>
				<th>Location</th>
				<th>Latitude</th>
				<th>Longitude</th>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>


<div class="modal fade hmodal-danger" id="myModal10" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class = "form-horizontal" action = "<?= @base_url('Dashboard/Sites/addPharmacy'); ?>" method = "POST">
				<!-- <div class="color-line"></div> -->
				<div class="modal-header">
					<h4 class="modal-title">Add Pharmacy</h4>
					<small class="font-bold">Add a new pharmacy to the pharmacy listing</small>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label" for="pharmacy_name">Pharmacy Name</label>
						<div class="input-group m-b">
							<span class="input-group-addon"><i class = "fa fa-hospital-o"></i></span>
							<input class="form-control" id = "pharmacy_name" name = "pharmacy_name"></input>
						</div>						
					</div>

					<div class="form-group">
						<label class = "control-label" for = "contact_person">Contact Person</label>
						<div class="input-group m-b">
							<span class="input-group-addon"><i class = "fa fa-user"></i></span>
							<input class="form-control" id = "contact_person" name = "contact_person"></input>
						</div>
					</div>

					<div class="form-group">
						<label class = "control-label" for = "pharmacy_phone">Pharmacy Phone</label>
						<div class="input-group m-b">
							<span class="input-group-addon"><i class = "fa fa-phone"></i></span>
							<input class="form-control" id = "pharmacy_phone" name = "pharmacy_phone"></input>
						</div>
					</div>

					<div class="form-group">
						<label class = "control-label" for = "pharmacy_location">Pharmacy County</label>
						<div class="input-group m-b">
							<span class="input-group-addon"><i class = "fa fa-globe"></i></span>
							<select class = "form-control" id = "pharmacy_county" name = "pharmacy_county"></select>
						</div>
					</div>

					<div class="form-group">
						<label class = "control-label" for = "pharmacy_location">Pharmacy Location</label>
						<div class="input-group m-b">
							<span class="input-group-addon"><i class = "fa fa-globe"></i></span>
							<input class="form-control" id = "pharmacy_location" name = "pharmacy_location"></input>
						</div>
					</div>

					<div class="form-group">
						<label class = "control-label" for = "pharmacy_longitude">Longitude</label>
						<div class="input-group m-b">
							<span class="input-group-addon"><i class = "fa fa-map-marker"></i></span>
							<input class="form-control" id = "pharmacy_longitude" name = "pharmacy_longitude"></input>
						</div>
					</div>

					<div class="form-group">
						<label class = "control-label" for = "pharmacy_latitude">Latitude</label>
						<div class="input-group m-b">
							<span class="input-group-addon"><i class = "fa fa-map-marker"></i></span>
							<input class="form-control" id = "pharmacy_latitude" name = "pharmacy_latitude"></input>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
					<button class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>