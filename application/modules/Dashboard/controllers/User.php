<?php

class User extends DashboardController{
	function __construct(){
		parent::__construct();
		$this->load->library('Mailer');
	}

	function index(){
		$this->assets
				->addCss('dashboard/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css')
				->addCss('plugin/bootstrap3-editable/css/bootstrap-editable.css')
				->addCss('plugin/select2/css/select2.min.css');

		$this->assets
				->addJs('plugin/select2/js/select2.full.min.js')
				->addJs('dashboard/vendor/datatables/media/js/jquery.dataTables.min.js')
				->addJs('dashboard/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js')
				->addJs('dashboard/vendor/datatables.net-buttons/js/buttons.html5.min.js')
				->addJs('dashboard/vendor/datatables.net-buttons/js/buttons.print.min.js')
				->addJs('dashboard/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')
				->addJs('dashboard/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')
				->addJs('plugin/bootstrap3-editable/js/bootstrap-editable.min.js')
				->addJs("dashboard/vendor/jquery-validation/jquery.validate.min.js");
				
		$this->assets->setJavascript('Dashboard/user/user_js');
		$this->template
				->setPartial('Dashboard/user/index')
				->adminTemplate();
	}

	function profile(){
		if(!$this->input->post()){
			$this->assets
					->addCss('dashboard/vendor/sweetalert/lib/sweet-alert.css')
					->addCss('dashboard/vendor/ladda/dist/ladda-themeless.min.css')
					->addCss('dashboard/vendor/toastr/build/toastr.min.css')
					->addCss('dashboard/styles/static_custom.css');
			$this->assets
					->addJs('dashboard/vendor/sweetalert/lib/sweet-alert.min.js')
					->addJs('dashboard/vendor/ladda/dist/spin.min.js')
					->addJs('dashboard/vendor/ladda/dist/ladda.min.js')
					->addJs('dashboard/vendor/ladda/dist/ladda.jquery.min.js')
					->addJs('dashboard/vendor/toastr/build/toastr.min.js')
					->addJs("dashboard/vendor/jquery-validation/jquery.validate.min.js");
			$this->assets->setJavascript('Dashboard/user/user_js');
			$this->template
					->setPartial('Dashboard/user/profile')
					->adminTemplate();
		}else{
			$user = new StdClass;

			$user->user_firstname = $this->input->post('user_firstname');
			$user->user_lastname = $this->input->post('user_lastname');
			$user->user_username = ($this->input->post('user_username') == "") ? NULL : $this->input->post('user_username');
			$user->user_email = $this->input->post('user_email');

			$this->db->where('uuid', $this->session->userdata('user_id'));
			$update = $this->db->update('user', $user);

			if($this->db->affected_rows()){
				$this->session->set_flashdata('success', "Successfully updated details");
			}else{
				$this->session->set_flashdata('error', "There was an error updating your details");
			}

			redirect('Dashboard/User/profile');
		}
	}

	function activate($uuid){
		$user = $this->confirmUser($uuid);

		$update_data = [
			'user_is_active'	=>	1
		];

		$this->db->where('uuid', $uuid);
		$update = $this->db->update('user', $update_data);

		$this->session->set_flashdata('success', "Successfully activated $user->user_firstname $user->user_lastname's account");
		redirect('Dashboard/User');
	}

	function deactivate($uuid){
		$user = $this->confirmUser($uuid);

		$update_data = [
			'user_is_active'	=>	0
		];

		$this->db->where('uuid', $uuid);
		$update = $this->db->update('user', $update_data);

		$this->session->set_flashdata('success', "Successfully deactivated $user->user_firstname $user->user_lastname's account");
		redirect('Dashboard/User');
	}

	function resetpass($uuid){
		$user = $this->confirmUser($uuid);

		$token = md5($this->hash->generateToken());
		$this->db->where('id', $user->id);
		$this->db->update('user', ['user_reset_token'=>$token, 'user_is_active' => 0]);

		$this->db->where('id', $user->id);
		$user = $this->db->get('user')->row();

		$data['user'] = $user;

		$html = $this->load->view('Dashboard/user/reset_email_v', $data, true);

		$this->mailer->sendMail($user->user_email, "Password Reset", $html);
		
		$this->session->set_flashdata('success', "Sent a reset link to $user->user_firstname $user->user_lastname");
		redirect('Dashboard/User');
	}

	function create(){
		if ($this->input->post()) {
			$user_firstname = $this->input->post('user_firstname');
			$user_lastname = $this->input->post('user_lastname');
			$user_email = $this->input->post('email');
			$user_type = $this->input->post('user_type');

			$user = new StdClass;

			$user->user_firstname = $user_firstname;
			$user->user_lastname = $user_lastname;
			$user->user_email = $user_email;
			$user->user_type = $user_type;
			$user->user_is_active = 0;
			$user->user_activation_token = md5($this->hash->generateToken());

			$data['user'] = $user;
			$html = $this->load->view('Auth/activate_account_v', $data, true);

			$this->mailer->sendMail($user->user_email, "Besure Account Created", $html);

			$this->db->insert('user', $user);

			$this->session->set_flashdata('success', "Sent an activation link to $user->user_firstname $user->user_lastname");
			redirect('Dashboard/User');
		}
	}

	function confirmUser($uuid){
		$user = $this->db->get_where('user', ['uuid'	=>	$uuid])->row();

		if($user){
			return $user;
		}
		redirect('Dashboard/User');
	}
}