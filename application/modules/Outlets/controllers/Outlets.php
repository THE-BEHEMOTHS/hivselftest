<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outlets extends MY_Controller{
	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->assets->setJavascript('Outlets/participating_js');
		$data['participating_mason'] = $this->createParticipatingMason();
		$this->template
			->setPartial('Outlets/participating', $data)
			->frontEndTemplate();
	}

	function createParticipatingMason(){
		$mason = "";

		$this->db->where('pharmacy_latitude IS NOT NULL', NULL, FALSE);
		$this->db->where('pharmacy_longitude IS NOT NULL', NULL, FALSE);
		$this->db->order_by('pharmacy_name', 'ASC');
		$pharmacies = $this->db->get('pharmacies')->result();

		foreach ($pharmacies as $pharmacy) {
			$string = '<div class="masonry-item column col-xs-12 col-sm-6 col-md-4 col-lg-4" style="">
			<div class="content-element team-wrapper team-align-left team-boxed">
			<div class="team-info">
			<h5 class="team-name">%pharmacy_name%</h5>
			<span class="team-desc">%pharmacy_location%</span>
			<p>%pharmacy_contact_person% [%pharmacy_phone%]</p>
			<button style = "width: 100%;" class="button button-secondary button-rounded button-size-md"><i class="icon apalodi-icon-right-circled-alt"></i><span class="button-text">View Pharmacist on Map</span></button>
			</div>
			</div>
			</div>';
			$search = array('%image%', '%pharmacy_name%', '%pharmacy_location%', '%pharmacy_phone%', '%pharmacy_contact_person%');
			$replace = array('https://s-media-cache-ak0.pinimg.com/736x/25/af/d1/25afd17925ff4a5aa5a53e42b20ede0e.jpg', $pharmacy->pharmacy_name, $pharmacy->pharmacy_location, $pharmacy->pharmacy_phone, $pharmacy->pharmacy_contact_person);
			$new_string = str_replace($search, $replace, $string);
			$mason .= $new_string;
		}

		return $mason;
	}
}