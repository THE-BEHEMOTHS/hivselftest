<?php

class Dashboard extends DashboardController{
	function __construct()
	{
		parent::__construct();
		$this->load->library('GAnalytics');
	}

	function index(){
		$data['stats']	= $this->getInHouseCounters();

		$this->assets
					->addJs('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js', true)
					->addJs('dashboard/vendor/daterangepicker/daterangepicker.js')
					->addJs('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js', true)
					->addJs('dashboard/google-analytics/view-selector2.js')
					->addJs('dashboard/google-analytics/date-range-selector.js')
					->addJs('dashboard/google-analytics/active-users.js');
		$this->assets
				->addCss('dashboard/vendor/daterangepicker/daterangepicker.css')
				->addCss('dashboard/google-analytics/chartjs-visualizations.css');
		$this->assets->setJavascript('Dashboard/dashboard/dashboard_js');
		$this->template
				->setPartial('Dashboard/dashboard/dashboard_v', $data)
				->adminTemplate();
	}

	function getSessions(){
		$sessions = $this->ganalytics->getResults();

		$response = [
			'type'	=>	true,
			'data'	=>	[
				'views'	=>	$sessions
			]
		];

		$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
	}

	function getInHouseCounters(){
		$surveys = $this->db->get('survey')->num_rows();
		$pharmacies = $this->db->get('pharmacies')->num_rows();
		$referrals = $this->db->get('facilities')->num_rows();

		return [
			'surveys'		=>	$surveys,
			'pharmacies'	=>	$pharmacies,
			'referrals'		=>	$referrals
		];
	}
}