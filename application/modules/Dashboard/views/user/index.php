<div class="hpanel">
	<div class ="panel-heading hbuilt">
		User Profiles

		<div class="pull-right">
			<a class="btn btn-default btn-xs" id="add-user" data-toggle="modal" data-target="#userModal">Add User</a>
		</div>
	</div>
	<?php if($this->session->flashdata('success')) { ?>
		<div class="alert alert-success">
			<i class="fa fa-check-circle"></i> <?= $this->session->flashdata('success'); ?>
		</div>
	<?php } else if($this->session->flashdata('error')){?>
		<div class="alert alert-danger">
			<i class="fa fa-exclamation-circle"></i> <?= $this->session->flashdata('error'); ?>
		</div>
	<?php } ?>
	
	<div class="panel-body">
		<table class = "table table-bordered" id = "user_table">
			<thead>
				<th style="width: 4%;">#</th>
				<th style="width: 40px;"></th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email Address</th>
				<th>User Type</th>
				<th>Status</th>
				<th>Actions</th>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade hmodal-danger" id="userModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id = 'add-user-form' class = "form-horizontal" action = "<?= @base_url('Dashboard/User/create/'); ?>" method = "POST">
				<!-- <div class="color-line"></div> -->
				<div class="modal-header">
					<h4 class="modal-title">Add User</h4>
					<small class="font-bold">Add a new user</small>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label" for="user_firstname">First Name</label>
						<input class="form-control" id = "user_firstname" name = "user_firstname"></input>					
					</div>

					<div class="form-group">
						<label class = "control-label" for = "user_lastname">Last Name</label>
						<input class="form-control" id = "user_lastname" name = "user_lastname"></input>
					</div>

					<div class="form-group">
						<label class = "control-label" for = "email">Email</label>
						<input class="form-control" id = "email" name = "email" autocomplete="false"></input>
					</div>

					<div class="form-group">
						<label>Select User Type</label>
						<select class = "form-control" name = "user_type">
							<option>Select a user type</option>
							<option value = "superadmin">Super Admin</option>
							<option value = "admin">Admin</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
					<button class="btn btn-primary" id = "save-changes">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>