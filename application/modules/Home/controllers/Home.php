<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('Home_m');
	}
	
	public function index()
	{
		$this->assets
				->addCss('css/aslider.css')
				->addCss('css/viba-portfolio.css')
				->addCss('css/viba-portfolio-custom.css')
				->addCss("plugin/sweetalert/sweetalert.css");
		$this->assets
				->addJs('js/vendor/aslider.js')
				->addJs('js/vendor/viba-portfolio.js')
				->addJs('js/vendor/owl.carousel.min.js')
				->addJs('js/vendor/isotope.pkgd.min.js')
				->addJs('js/vendor/jquery-3.2.1.min.js')
				->addJs('dist/js/bootstrap.min.js')
				->addJs('js/vendor/jquery.validate.js')
				->addJs('js/vendor/jquery.swiper.min.js')
                ->addJs("plugin/sweetalert/sweetalert.min.js");
		$this->assets->setJavascript('Home/survey_js');
		$this->template->setPageTitle('BeSure::HIV Self Test')->setPartial('home_v2')->frontEndTemplate();
	}

	public function videos()
	{
		$this->template->setPageTitle('Videos')->setPartial('videos_v')->frontEndTemplate();
	}

	public function FAQ()
	{
		$this->template->setPageTitle('FAQ')->setPartial('faq_v')->frontEndTemplate();
	}

	public function Resources()
	{
		$this->template->setPageTitle('Resources')->setPartial('resources_v')->frontEndTemplate();
	}

	public function Survey()
	{
		if($this->input->post()){
			$age = $this->input->post('age');
			$gender = $this->input->post('gender');
			$comments = $this->input->post('comments');

			//$kits = implode(', ', $kit);

			

			

			$survey_insert = [
				'age'			=>	$age,
				'gender'			=>	$gender,
				'comments'	=>	$comments
			];

			$this->db->insert('survey', $survey_insert);
			$id = $this->db->insert_id();

			$kits = $this->input->post('kit');
			//echo "<pre>";print_r($kits);echo "</pre>";die();

			$kit_insert = [];
			if($kits){
				foreach ($kits as $kit_id) {
					$kit_insert[] = [
						'id'	=>	$id,
						'kit_id'		=>	$kit_id
					];
				}

				$this->db->insert_batch('user_kit_results', $kit_insert);
			}
			
			$json_data = [
				"type"				=>	"success",
				"title"				=>	"Survey Sent",
             	"message"			=>	"Thank you for carrying out the survey"
           	];
		}else{
			$json_data = [
				"type"				=>	"error",
				"title"				=>	"Survey Error",
             	"message"			=>	"There was a problem submitting the survey"
           	];
		}


		return $this->output->set_content_type('application/json')->set_output(json_encode($json_data));

		
	}

}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */