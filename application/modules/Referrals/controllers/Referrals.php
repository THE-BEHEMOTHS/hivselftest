<?php

class Referrals extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->config('Map/map');
	}

	function index(){
		$data = [];

		$data['counties'] = $this->getCounties();
		$this->assets
				->addCss('https://fonts.googleapis.com/css?family=Raleway|Lato|Open+Sans', true)
				->addCss('dashboard/vendor/bootstrap/dist/css/bootstrap.css')
				->addCss('plugin/select2/css/select2.min.css')
				->addCss('dashboard/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css')
				->addCss('plugin/bootstrap3-editable/css/bootstrap-editable.css')
				->addJs('dashboard/vendor/bootstrap/dist/js/bootstrap.min.js')
				->addJs('dashboard/vendor/datatables/media/js/jquery.dataTables.min.js')
				->addJs('dashboard/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js')
				->addJs('plugin/select2/js/select2.min.js');
		$this->assets->setJavascript('Referrals/map_js');
		$this->template
				->setPartial('Referrals/index', $data)
				->frontEndTemplate();
	}

	function getfacilities(){
		if ($this->input->post()) {
			$response = [];
			$county = $this->input->post('county');
			if($county){
				$this->db->where('county_name', $county);
			}
			$facilities = $this->db->get('facilities')->result();
			if($facilities){
				$response['status'] = true;
				$counter = 1;
				$table = "";
				foreach ($facilities as $facility) {
					$response['map_data'][] = [
						'lat'			=>	$facility->latitude,
						'lng'			=>	$facility->longitude,
						'contentString'	=>	$facility->facility_name,
						'title'			=>	$facility->facility_name
					];

					$table .= "<tr>
					<td>{$counter}</td>
					<td>{$facility->facility_name}</td>
					<td>{$facility->description}</td>
					<td>{$facility->nearest_town}</td>
					<td><a href = '#' class = 'label label-success view_map' data-title = '{$facility->facility_name}' data-lat = '{$facility->latitude}' data-lng = '{$facility->longitude}'>View on Map</a></td>
					</tr>";

					$counter++;
				}
				$response['table']	= $table;
			}else{
				$response['status'] = false;
				$response['message'] = "There are no facilties for the selected county";
			}

			return $this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}
}