<div class="text-center m-b-md">
	<h3>PLEASE LOGIN TO APP</h3>
	<small>If you do not have an account, contact the admin</small>
</div>
<div class="hpanel">
	<div class="panel-body">
		<form action="<?= @base_url('Auth/authenticate'); ?>" method = "POST" id="loginForm">
			<div class="form-group">
				<label class="control-label" for="username">Username</label>
				<input type="text" placeholder="example@gmail.com" title="Please enter you username" required="" value="" name="username" id="username" class="form-control">
				<span class="help-block small">Your unique username to app</span>
			</div>
			<div class="form-group">
				<label class="control-label" for="password">Password</label>
				<input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
				<span class="help-block small">Your strong password</span>
			</div>
			<a class="ladda-button btn btn-success btn-block" data-style="zoom-in" id = "login">Login</a>
		</form>
	</div>
</div>