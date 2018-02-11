<div class="text-center m-b-md">
	<h3>CHANGE YOUR PASSWORD</h3>
	<small>Please change the password for your account in order to login</small>
</div>
<div class="hpanel">
	<?php if($this->session->flashdata('error')){?>
	<div class="alert alert-error">
		<?= @$this->session->flashdata('error'); ?>
	</div>
	<?php } ?>
	<div class="panel-body">
		<form method = "POST" id="resetPassword">
			<div class="form-group">
				<label class="control-label">New Password</label>
				<input type="password" id = "new_password" name="new_password" class = "form-control">
			</div>
			<div class="form-group">
				<label class="control-label">Confirm Password</label>
				<input type="password" id = "confirm_password" name="confirm_password" class = "form-control">
			</div>

			<button class="btn btn-primary btn-block">Change Password</button>
		</form>
	</div>
</div>