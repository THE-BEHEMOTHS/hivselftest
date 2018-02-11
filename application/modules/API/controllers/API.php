<?php

class API extends MY_Controller{
	function __construct()
	{
		parent::__construct();
	}
	function index(){
		
	}
	function loadPage(){
		$response = [];

		$response['type'] = 'success';
		$response['html'] = $this->load->view('API/page_v', NULL, TRUE);
		echo json_encode($response);
	}

	function getData(){
		// Get Counties
		$this->db->select('id, county_name');
		$counties = $this->db->get('county')->result();

		// Get Pharmacies
		$this->db->select('id, pharmacy_name, pharmacy_location, pharmacy_longitude, pharmacy_latitude, county_id');
		$pharmacies = $this->db->get('pharmacies')->result();

		// Get Facilities
		$this->db->select('id, facility_code, facility_name, longitude, latitude, county_name');
		$facilities = $this->db->get('facilities')->result();

                // Get Faqs
		$this->db->select('id, question, answer, imagepath, status');
		$faqs = $this->db->get('faqs')->result();

		$response = [];

		$response['status'] = true;
		$response['data'] = [
			'counties'		=>	$counties,
			'pharmacies'	=>	$pharmacies,
			'facilities'	=>	$facilities,
                        'faqs'	=>	$faqs
		];

		$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
	}

	function getResources($type = null){
		$response = [];
		$this->load->module('Resources');
		$resource_data = (!$type) ? $this->resources->get() : $this->resources->get($type);

		if($resource_data){
			$response['status'] = true;
			$response['data'] = $resource_data;
		}else{
			$response['status'] = false;
			$response['message'] = "No resources found";
		}

		$response = ($type == "videos") ? $response['data'] : $response;
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
	}
}