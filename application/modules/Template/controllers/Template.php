<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MX_Controller {
	protected $asset_url;

	protected $pageTitle;
	protected $pageDescription;
	protected $contentView;
	protected $contentViewData;
	protected $metaData;
	protected $modalView;
	protected $modalData;
	protected $modalTitle;

	function __construct(){
		$this->asset_url = $this->config->item('assets_url');
		$this->load->library('Assets', $this->config);
	}
	function adminTemplate(){
		$data['page_css'] = $this->assets->css;
		$data['page_js'] = $this->assets->js;

		// $this->load->model('Auth/auth_m');
		$user_details = $this->db->get_where('user', ['uuid'	=>	$this->session->userdata('user_id'), 'user_is_active'	=>	1])->row();
		if($user_details){
			if(!$this->session->userdata('type')){
				$this->session->set_userdata('type', $user_details->user_type);
			}
			$data['javascript_file'] = $this->assets->javascript_file;
			$data['javascript_data'] = $this->assets->javascript_data;
			$data['user_details'] = $user_details;
			$data['menu'] = $this->createSideBar();
			$data['pagetitle'] = $this->pageTitle;
			$data['pagedescription'] = $this->pageDescription;
			$data['modalView'] = $this->modalView;
			$data['modalData'] = $this->modalData;
			$data['modalTitle'] = $this->modalTitle;
			$data['partial'] = $this->contentView;
			$data['partialData'] = $this->contentViewData;
		}else{
			$this->load->module('Auth');
			$this->auth->signout();
		}

		$this->load->view('Template/backend_template_v', $data);
	}

	function auth(){
		$data['page_css'] = $this->assets->css;
		$data['page_js'] = $this->assets->js;


		$data['javascript_file'] = $this->assets->javascript_file;
		$data['javascript_data'] = $this->assets->javascript_data;
		
		$data['pagetitle'] = $this->pageTitle;
		$data['pagedescription'] = $this->pageDescription;
		$data['partial'] = $this->contentView;
		$data['partialData'] = $this->contentViewData;

		$this->load->view('Template/besure_auth_template_v', $data);
	}


	function authTemplate(){
		$data['page_css'] = $this->assets->css;
		$data['page_js'] = $this->assets->js;


		$data['javascript_file'] = $this->assets->javascript_file;
		$data['javascript_data'] = $this->assets->javascript_data;
		
		$data['pagetitle'] = $this->pageTitle;
		$data['pagedescription'] = $this->pageDescription;
		$data['partial'] = $this->contentView;
		$data['partialData'] = $this->contentViewData;

		$this->load->view('Template/auth_template_v', $data);
	}

	function frontEndTemplate(){
		$data['metadata'] = $this->metaData;

		$data['page_css'] = $this->assets->css;
		$data['page_js'] = $this->assets->js;

		$data['pagetitle'] = $this->pageTitle;
		$data['pagedescription'] = $this->pageDescription;

		$data['partial'] = $this->contentView;
		$data['partialData'] = $this->contentViewData;

		$data['kits'] = $this->getKits();
		$data['gender'] = $this->getGender();

		$data['javascript_file'] = $this->assets->javascript_file;
		$data['javascript_data'] = $this->assets->javascript_data;
		$this->load->view('Template/frontend_template_v_2', $data);
	}

	function createSideBar($selected = null){

		$class = $this->router->class;
		$menus = [];
		$menu_list = "";

		$menus = [
			'dashboard'	=> [
				'text'	=>	'Dashboard',
				'link'	=>	'Dashboard',
				'users'	=>	['superadmin', 'admin']
			],
			'surveys'	=>	[
				'text'	=>	'Surveys',
				'link'	=>	'Dashboard/Surveys',
				'users'	=>	['superadmin', 'admin']
			],
			'pharmacies'	=> [
				'text'	=>	'Pharmacies',
				'link'	=>	'Dashboard/Sites/pharmacies',
				'users'	=>	['superadmin', 'admin']
			],
			'referral_sites'	=> [
				'text'	=>	'Referral Sites',
				'link'	=>	'Dashboard/Sites/referrals',
				'users'	=>	['superadmin', 'admin']
			],
			'profile'	=>	[
				'text'	=>	'My Profile',
				'link'	=>	'Dashboard/User/profile',
				'users'	=>	['superadmin', 'admin']
			],
			'users'		=>	[
				'text'	=>	'Users',
				'link'	=>	'Dashboard/User',
				'users'	=>	['superadmin']
			],
			'logout'	=>	[
				'text'	=>	'Logout',
				'link'	=>	'Auth/signout',
				'users'	=>	['superadmin', 'admin']
			]
		];

		if (count($menus) > 0) {
			foreach ($menus as $key => $item) {
				if(in_array($this->session->userdata('type'), $item['users'])){
					$active = "";
					if ($key == strtolower($class)) {
						$active = "active";
					}

					if(isset($item['sublist']) && is_array($item['sublist'])){
						$menu_list .= "<li class = 'nav-item nav-dropdown'>
							<a class = 'nav-link nav-dropdown-toggle' href = '#'>
								<i class = '{$item['icon']}'></i> {$item['text']}
							</a>
							<ul class = 'nav-dropdown-items'>";
						foreach($item['sublist'] as $sub_item){
							$menu_list .= "
								<li class = 'nav-item'>
									<a class = 'nav-link' href = '".base_url($sub_item['link'])."'>{$sub_item['text']}</a>
								</li>
							";
						}
						$menu_list .= "</ul></li>";
					}
					else{
					$menu_list .= "<li class = 'nav-item'>
						<a class = 'nav-link' href = '".base_url($item['link'])."'>{$item['text']}</a>
					</li>";
					}
				}
			}
		}

		return $menu_list;
	}

	function setPageTitle($page_title = ""){
		$this->pageTitle = $page_title;

		return $this;
	}

	function setPageDescription($pageDescription){
		$this->pageDescription = $pageDescription;

		return $this;
	}

	function setPartial($view, $data = []){
		$this->contentView = $view;
		$this->contentViewData = $data;

		return $this;
	}

	function setModal($view, $title ,$data =[]){
		$this->modalView = $view;
		$this->modalData = $data;
		$this->modalTitle = $title;

		return $this;
	}

	function setMetaData($key, $value){
		$metadata_string = "";

		$metadata_string = "<meta property = '{$key}' content = '{$value}'>\r\n";

		$this->metaData .= $metadata_string;

		return $this;
	}

	function getKits(){
		$counter = 0;

        $this->db->where('status', 1);
        $kits = $this->db->get('kits')->result();

        $kit_view = '';

        foreach ($kits as $key => $kit) {
            //echo '<pre>';print_r($kit);echo '</pre>';die();
            $counter ++;           
            $kit_view .= '<div class="checkbox">
				  <label> 
				    <input type="checkbox" name="kit[]" value="'.$kit->id.'">
				    &nbsp;&nbsp;
				    '.$kit->kit.'
				    &nbsp;&nbsp;&nbsp;&nbsp;
				  </label>
			  	</div>';
        }


        return $kit_view;
	}

	function getGender(){
		$counter = 0;

		$this->db->where('status',1);
        $genders = $this->db->get('gender')->result();

        $gender_view = '';

        foreach ($genders as $key => $gender) {
            //echo '<pre>';print_r($gender);echo '</pre>';die();
            $counter ++;           
            $gender_view .= '<option value="'.$gender->id.'">'.$gender->gender.'</option>';
        }


        return $gender_view;
	}
}

/* End of file Template.php */
/* Location: ./application/modules/Template/controllers/Template.php */