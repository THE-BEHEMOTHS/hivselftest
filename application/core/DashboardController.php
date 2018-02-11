<?php

class DashboardController extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->module('Auth');
		$this->auth->checkLogin();
	}

	function getCounties($numerical = false){
		$data = [];
		$counties = $this->db->get('county')->result();
		foreach ($counties as $county) {
			$id = ($numerical == true) ? $county->id : $county->county_name;
			$data[] = [
				'id'	=>	$id,
				'text'	=>	$county->county_name
			];
		}

		return json_encode($data);
	}
}