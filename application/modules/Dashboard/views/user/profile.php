<?php $assets_url = $this->config->item('assets_url');?>
<style type="text/css">
	#image-holder{
		cursor: pointer;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-position: center;
	}

	#image-holder #image-backdrop{
		background-color: rgba(0,0,0,0.5);
		width: 100%;
		height: inherit;
		border-radius: 100%;
		display: none;
	}

	#image-backdrop div{
		color: #fff;
		line-height: 78px;
	}

	/*.toast-message{
		color: black !important;
	}*/
</style>
<div class="row">
	<div class="col-md-4">
		<div class="hpanel hgreen">
			<div class="panel-body">
				<div class="pull-right text-right">
					<form id = "inputForm" method="POST">
						<input type="file" name="user_avatar" style="position:absolute;margin-top: -10000px;">
						<input type="hidden" name="user" value="<?= @$user_details->uuid; ?>">
						<button id= "save-changes" class = "ladda-button btn btn-xs btn-primary" data-style="zoom-in" style="display: none;" type="submit">Save Changes</button>
					</form>
				</div>
				<div id = "image-holder" class = "img-circle m-b m-t-md" style="width: 76px;height:76px; background-image: url('<?php if($user_details->user_avatar == NULL){?><?= @$assets_url; ?>dashboard/images/no_profile.png<?php } else { echo base_url($user_details->user_avatar); } ?>')">
						<div id="image-backdrop" class = "text-center">							
							<div>
								<i class = "fa fa-camera fa-2x"></i>
							</div>
						</div>
				</div>
				<h3><a href="#"><?= @$user_details->user_firstname; ?> <?= @$user_details->user_lastname; ?></a></h3>
				<div class="text-muted font-bold m-b-xs"><?= @$user_details->user_email; ?></div>
				<a class = "btn btn-primary btn-block" id = "reset_password">Request Password Reset</a>
			</div>
		</div>
	</div>

	<div class="col-md-8">
		<div class="hpanel hgreen">
			<?php if($this->session->flashdata('success')){ ?>
				<div class = "alert alert-success">
					<?= @$this->session->flashdata('success'); ?>
				</div>
			<?php }elseif($this->session->flashdata('error')) {?>
				<div class = "alert alert-error">
					<?= @$this->session->flashdata('error'); ?>
				</div>
			<?php } ?>
			<div class="panel-body">
				<form method="POST" id = "userdetailsForm">
					<div class="form-group">
						<div class="col-md-6">
							<label>First Name</label>
							<input type="text" name="user_firstname" class="form-control" value = "<?= @$user_details->user_firstname; ?>" required />
						</div>
						<div class="col-md-6">
							<label>Last Name</label>
							<input type="text" name="user_lastname" class="form-control" value = "<?= @$user_details->user_lastname; ?>" required />
						</div>
					</div>

					<div class="form-group">
						<div class = "col-md-6">
							<label class="control-label">Username</label>
							<input type="text" name="user_username" class = "form-control" value = "<?= @$user_details->user_username; ?>" >
						</div>

						<div class="col-md-6">
							<label class="control-label">Email</label>
							<input type="email" name="user_email" class = "form-control" value = "<?= @$user_details->user_email; ?>" required autocomplete = "false"/>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-6 col-sm-offset-4">
							<a class="btn btn-default">Cancel</a>
							<button class="btn btn-primary" type="submit">Save changes</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>