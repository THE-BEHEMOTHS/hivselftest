<?php

class API extends MY_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_API');
		$this->load->config('Dashboard/dashboardconfig');
	}

	function getFacilities(){
		$columns = [];
		$limit = $offset = $search_value = $order = $order_direction = NULL;

		if($this->input->is_ajax_request()){
			$columns = [
				1	=>	"facility_code",
				2	=>	"facility_name",
				3	=>	"county_name",
			];

			$limit = $_REQUEST['length'];
			$offset = $_REQUEST['start'];
			$search_value = $_REQUEST['search']['value'];
			$order = $columns[$_REQUEST['order'][0]['column']];
			$order_direction = $_REQUEST['order'][0]['dir'];
		}
		
		$facilities = $this->M_API->searchFacility($search_value, $limit, $offset, $order, $order_direction);

		$data = [];

		if ($facilities) {
			$counter = $offset + 1;
			foreach ($facilities as $facility) {
				$data[] = [
					$counter,
					$facility->facility_code,
					$facility->facility_name,
					"<span data-value = '{$facility->county_name}' class = 'facility_county' data-type = 'select2' data-pk = '{$facility->uuid}' data-url = '".base_url('Dashboard/API/updateFacility')."' data-name = 'county_name' data-title = 'Select a County'>$facility->county_name</span>",
					"<span class = 'facility_latitude' data-type = 'text' data-pk = '{$facility->uuid}' data-url = '".base_url('Dashboard/API/updateFacility')."' data-name = 'latitude' data-title = 'Enter the latitude of the facility'>$facility->latitude</span>",
					"<span class = 'facility_longitude' data-type = 'text' data-pk = '{$facility->uuid}' data-url = '".base_url('Dashboard/API/updateFacility')."' data-name = 'longitude' data-title = 'Enter the longitude of the facility'>$facility->longitude</span>",
					"<span class = 'facility_nearest_town' data-type = 'text' data-pk = '{$facility->uuid}' data-url = '".base_url('Dashboard/API/updateFacility')."' data-name = 'nearest_town' data-title = 'Enter the nearest town of the facility'>$facility->nearest_town</span>",
					"<span class = 'facility_description' data-type = 'text' data-pk = '{$facility->uuid}' data-url = '".base_url('Dashboard/API/updateFacility')."' data-name = 'description' data-title = 'Enter the description of the facility'>$facility->description</span>"
				];

				$counter++;
			}
		}

		if($this->input->is_ajax_request()){
			$allfacilities = $this->M_API->searchFacility();
			$total_data = count($allfacilities);
			$data_total = count($facilities);

			$json_data = [
				"draw"				=>	intval( $_REQUEST['draw']),
				"recordsTotal"		=>	intval($total_data),
				"recordsFiltered"	=>	intval(count($this->M_API->searchFacility($search_value))),
				"data"				=>	$data	
			];

			return $this->output->set_content_type('application/json')->set_output(json_encode($json_data));
		}
	}

	function getPharmacies(){
		$columns = [];
		$limit = $offset = $search_value = $order = $order_direction = NULL;

		if($this->input->is_ajax_request()){
			$columns = [
				1	=>	"pharmacy_name",
				2	=>	"pharmacy_contact_person",
				4	=>	"pharmacy_location"
			];

			$limit = $_REQUEST['length'];
			$offset = $_REQUEST['start'];
			$search_value = $_REQUEST['search']['value'];
			$order = $columns[$_REQUEST['order'][0]['column']];
			$order_direction = $_REQUEST['order'][0]['dir'];
		}

		$pharmacies = $this->M_API->searchPharmacy($search_value, $limit, $offset, $order, $order_direction);
		$data = [];
		if ($pharmacies) {
			$counter = $offset + 1;
			foreach ($pharmacies as $pharmacy) {
				$data[] = [
					$counter,
					"<span data-type = 'text' class = 'pharmacy_name' data-pk = '{$pharmacy->id}' data-url = '".base_url('Dashboard/API/updatePharmacy')."' data-name = 'pharmacy_name' data-title = 'Enter Pharmacy Name'>$pharmacy->pharmacy_name</span>",
					"<span data-type = 'text' class = 'pharmacy_contact_person' data-pk = '{$pharmacy->id}' data-url = '".base_url('Dashboard/API/updatePharmacy')."' data-name = 'pharmacy_contact_person' data-title = 'Enter Pharmacy Contact Person'>$pharmacy->pharmacy_contact_person</span>",
					"<span data-type = 'text' class = 'pharmacy_phone' data-pk = '{$pharmacy->id}' data-url = '".base_url('Dashboard/API/updatePharmacy')."' data-name = 'pharmacy_phone' data-title = 'Enter Pharmacy Phone Number'>$pharmacy->pharmacy_phone</span>",
					"<span data-value = '{$pharmacy->county_id}' class = 'sel_pharmacy_county' data-type = 'select2' data-pk = '{$pharmacy->id}' data-url = '".base_url('Dashboard/API/updatePharmacy')."' data-name = 'county_id' data-title = 'Select a County'>{$pharmacy->county_name}</span>",
					"<span data-type = 'text' class = 'pharmacy_location' data-pk = '{$pharmacy->id}' data-url = '".base_url('Dashboard/API/updatePharmacy')."' data-name = 'pharmacy_location' data-title = 'Enter Pharmacy Location'>$pharmacy->pharmacy_location</span>",
					"<span data-type = 'text' class = 'pharmacy_latitude' data-pk = '{$pharmacy->id}' data-url = '".base_url('Dashboard/API/updatePharmacy')."' data-name = 'pharmacy_latitude' data-title = 'Enter Pharmacy Latitude'>$pharmacy->pharmacy_latitude</span>",
					"<span data-type = 'text' class = 'pharmacy_longitude' data-pk = '{$pharmacy->id}' data-url = '".base_url('Dashboard/API/updatePharmacy')."' data-name = 'pharmacy_longitude' data-title = 'Enter Pharmacy Longitude'>$pharmacy->pharmacy_longitude</span>"
				];

				$counter++;
			}
		}

		if($this->input->is_ajax_request()){
			$allpharmacies = $this->M_API->searchPharmacy();
			$total_data = count($allpharmacies);
			$data_total = count($pharmacies);

			$json_data = [
				"draw"				=>	intval( $_REQUEST['draw']),
				"recordsTotal"		=>	intval($total_data),
				"recordsFiltered"	=>	intval(count($this->M_API->searchPharmacy($search_value))),
				"data"				=>	$data	
			];

			return $this->output->set_content_type('application/json')->set_output(json_encode($json_data));
		}
	}

	function getUsers(){
		$columns = [];
		$limit = $offset = $search_value = $order = $order_direction = NULL;

		if($this->input->is_ajax_request()){
			$columns = [
				2	=>	"user_firstname",
				3	=>	"user_lastname",
				4	=>	"user_email",
				5	=>	"user_username"
			];

			$limit = $_REQUEST['length'];
			$offset = $_REQUEST['start'];
			$search_value = $_REQUEST['search']['value'];
			$order = $columns[$_REQUEST['order'][0]['column']];
			$order_direction = $_REQUEST['order'][0]['dir'];
		}

		$users = $this->M_API->searchUser($search_value, $limit, $offset, $order, $order_direction);

		$data = [];

		if ($users) {
			$counter = $offset + 1;
			foreach ($users as $user) {
				if($user->uuid != $this->session->userdata('user_id')){
					$avatar = ($user->user_avatar == NULL) ? $this->config->item('assets_url') . 'dashboard/images/no_profile.png' : base_url($user->user_avatar);
					$status_label = ($user->user_is_active == 1) ? "<span class = 'badge badge-success'>Active</span>" : "<span class = 'badge badge-danger'>Inactive</span>";

					$activation = "";
					if ($user->user_is_active == 1 && $user->user_reset_token == NULL) {
						$activation = "<li><a href='".base_url('Dashboard/User/deactivate/')."{$user->uuid}'>Deactivate Account</a></li>";
					}else if($user->user_is_active == 0 && $user->user_reset_token == NULL){
						$activation = "<li><a href='".base_url('Dashboard/User/activate/')."{$user->uuid}'>Activate Account</a></li>";
					}
					$data[] = [
						$counter,
						"<img style='width: 38px;height:38px;' src='{$avatar}' class='img-circle m-b' alt='logo'>",
						"<span class = 'user_firstname' data-type = 'text' data-pk = '{$user->uuid}' data-url = '".base_url('Dashboard/API/updateUser')."' data-name = 'user_firstname' data-title = 'First Name'>{$user->user_firstname}</span>",
						"<span class = 'user_lastname' data-type = 'text' data-pk = '{$user->uuid}' data-url = '".base_url('Dashboard/API/updateUser')."' data-name = 'user_lastname' data-title = 'Last Name'>$user->user_lastname</span>",
						"<span class = 'user_email' data-type = 'text' data-pk = '{$user->uuid}' data-url = '".base_url('Dashboard/API/updateUser')."' data-name = 'user_email' data-title = 'Email Address'>$user->user_email</span>",
						"<span class = 'user_type' data-type = 'select2' data-pk = '{$user->uuid}' data-url = '".base_url('Dashboard/API/updateUser')."' data-name = 'user_type' data-title = 'User Type'>$user->user_type</span>",
						"<center>{$status_label}</center>",
						'<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle" aria-expanded="false">Action <span class="caret"></span></button>
							<ul class="dropdown-menu">
								'.$activation.'
								<li><a href="'.base_url('Dashboard/User/resetpass/'). $user->uuid.'">Send Reset Link</a></li>
							</ul>
	                </div>'
					];
					$counter++;
				}
			}
		}

		if($this->input->is_ajax_request()){
			$allusers = $this->M_API->searchUser();
			$total_data = count($allusers);
			$data_total = count($users);

			$json_data = [
				"draw"				=>	intval( $_REQUEST['draw']),
				"recordsTotal"		=>	intval($total_data),
				"recordsFiltered"	=>	intval(count($this->M_API->searchUser($search_value))),
				"data"				=>	$data	
			];

			return $this->output->set_content_type('application/json')->set_output(json_encode($json_data));
		}
	}


	function getSurveyRawData(){
		$columns = [];
		$limit = $offset = $search_value = $order = $order_direction = NULL;

		if($this->input->is_ajax_request()){
			$columns = [
				2	=>	"age",
				5	=>	"date_of_entry"
			];

			$limit = $_REQUEST['length'];
			$offset = $_REQUEST['start'];
			$search_value = $_REQUEST['search']['value'];
			$order = $columns[$_REQUEST['order'][0]['column']];
			$order_direction = $_REQUEST['order'][0]['dir'];
		}

		$surveys = $this->M_API->searchSurvey($search_value, $limit, $offset, $order, $order_direction);

		$data = [];

		if ($surveys) {
			$counter = $offset + 1;
			foreach ($surveys as $survey) {
				$date = new DateTime($survey->date_of_entry, new DateTimeZone($this->config->item('timezone')));
				$data[] = [
					$counter,
					$survey->gender,
					$survey->age,
					$survey->kits,
					$survey->comments,
					date_format($date, 'dS F, Y \a\t h:i a')
				];

				$counter++;
			}
		}

		if($this->input->is_ajax_request()){
			$allsurveys = $this->M_API->searchSurvey();
			$total_data = count($allsurveys);
			$data_total = count($surveys);

			$json_data = [
				"draw"				=>	intval( $_REQUEST['draw']),
				"recordsTotal"		=>	intval($total_data),
				"recordsFiltered"	=>	intval(count($this->M_API->searchSurvey($search_value))),
				"data"				=>	$data	
			];

			return $this->output->set_content_type('application/json')->set_output(json_encode($json_data));
		}
	}

	function updateFacility(){
		$response = [];
		$update_data = [
			$this->input->post('name')	=>	$this->input->post('value')
		];

		$this->db->where('uuid', $this->input->post('pk'));

		$update = $this->db->update('facilities', $update_data);

		if ($update) {
			$response = [
				'message'	=>	'Successfully updated data'
			];
		}else{
			$this->output->set_status_header(500);
			$response = [
				'message'	=>	'There was an error trying to update this data'
			];
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	function updatePharmacy(){
		$response = [];
		$update_data = [
			$this->input->post('name')	=>	$this->input->post('value')
		];

		$this->db->where('id', $this->input->post('pk'));

		$update = $this->db->update('pharmacies', $update_data);

		if ($update) {
			$response = [
				'message'	=>	'Successfully updated data'
			];
		}else{
			$this->output->set_status_header(500);
			$response = [
				'message'	=>	'There was an error trying to update this data'
			];
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	function updateUser(){
		$response = [];
		$update_data = [
			$this->input->post('name')	=>	$this->input->post('value')
		];
		$this->db->where('uuid', $this->input->post('pk'));

		$update = $this->db->update('user', $update_data);

		if ($update) {
			$response = [
				'message'	=>	'Successfully updated data'
			];
		}else{
			$this->output->set_status_header(500);
			$response = [
				'message'	=>	'There was an error trying to update this data'
			];
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	function checkEmailExists(){
		$email = (isset($_REQUEST['email'])) ? $_REQUEST['email'] : $_REQUEST['user_email'];

		$this->db->where('user_email', $email);
		if(isset($_REQUEST['user_email'])){
			$this->db->where('uuid != ', $this->session->userdata('user_id'));
		}
		$user = $this->db->get('user')->row();

		$response = [];

		if ($user) {
			echo 'false';
		}else{
			echo 'true';
		}
	}

	function checkUsernameExists(){
		$username = $_REQUEST['user_username'];

		$this->db->where('user_username', $username);
		$this->db->where('uuid != ',$this->session->userdata('user_id'));
		$user = $this->db->get('user')->row();

		if ($user) {
			echo 'false';
		}else{
			echo 'true';
		}
	}

	function uploadUserImage(){
		$status = 200;
		$message = "";
		if ($this->input->post()) {
			if($_FILES){
				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 100000000;
				$config['encrypt_name']			= TRUE;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('user_avatar')){
					$status = 400;
					$message = $this->upload->display_errors();
				}else{
					$data = array('upload_data' => $this->upload->data());
					$user = new StdClass;

					$user->user_avatar = 'uploads/' . $data['upload_data']['file_name'];
					$this->db->where('uuid', $this->session->userdata('user_id'));
					if($this->db->update('user', $user)){
						$message = "Successfully updated profile picture";
					}else{
						$status = 400;
						$message = "Database error"; 
					}
				}
			}
		}else{
			$status = 405;
			$message = "Your request could not be completed";
		}

		$this->output->set_status_header($status);
		$response['message'] = $message;
		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}