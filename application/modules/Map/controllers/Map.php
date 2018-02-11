<?php
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends MY_Controller{
	protected $client;
	function __construct(){
		parent::__construct();
		$this->load->config('map');
	}

	function index(){
		$data['pharmacy_table'] = $this->getPharmaciesList();
		$data['counties'] = $this->getCountiesList();

		$this->assets
				->addCss('https://fonts.googleapis.com/css?family=Raleway|Lato|Open+Sans', true)
				->addCss('dashboard/vendor/bootstrap/dist/css/bootstrap.css')
				->addCss('plugin/select2/css/select2.min.css')
				->addCss('dashboard/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css');

		$this->assets
				->addJs('dashboard/vendor/bootstrap/dist/js/bootstrap.min.js')
				->addJs('dashboard/vendor/datatables/media/js/jquery.dataTables.min.js')
				->addJs('dashboard/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js')
				->addJs('plugin/select2/js/select2.min.js');

		$this->assets->setJavascript('Map/map_js');
		$this->template
				->setPartial('Map/index_v', $data)
				->frontEndTemplate();
	}

	function getPharmacies(){
		$this->db->where('pharmacy_latitude IS NOT NULL', NULL, FALSE);
		$this->db->where('pharmacy_longitude IS NOT NULL', NULL, FALSE);
		$pharmacies = $this->db->get('pharmacies')->result();
		$response = [];
		foreach ($pharmacies as $pharmacy) {
			// $response[] = [
			// 	'latitude'			=>	$pharmacy->pharmacy_latitude,
			// 	'longitude'			=>	$pharmacy->pharmacy_longitude,
			// 	'content_string'	=>	"<b>$pharmacy->pharmacy_name</b><br/><b>Name: </b>$pharmacy->pharmacy_location<br/><b>Contact Person: </b>$pharmacy->pharmacy_contact_person<br/><b>Phone: </b>$pharmacy->pharmacy_phone",
			// 	'name'				=>	$pharmacy->pharmacy_name
			// ];
			$response[] = [
				'latitude'			=>	$pharmacy->pharmacy_latitude,
				'longitude'			=>	$pharmacy->pharmacy_longitude,
				'content_string'	=>	"<b>$pharmacy->pharmacy_name</b><br/><b>Name: </b>$pharmacy->pharmacy_location<br/><b>Contact Person: </b>$pharmacy->pharmacy_contact_person<br/>",
				'name'				=>	$pharmacy->pharmacy_name
			];
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	function getCountiesList(){
		$option_string = "";
		$counties = $this->db->get('county')->result();

		if($counties){
			foreach ($counties as $county) {
				$coordinates_json = $county->county_coordinates;
				$coordinates_array = json_decode($coordinates_json);
				$coordinates = $coordinates_array[0][0][1];

				$option_string .= "<option data-lng = '{$coordinates[0]}' data-lat = '{$coordinates[1]}' value = '{$county->id}'>{$county->county_name}</option>";
			}
		}


		return $option_string;
	}

	function getPharmaciesList(){
		$this->db->where('p.pharmacy_latitude IS NOT NULL', NULL, FALSE);
		$this->db->where('p.pharmacy_longitude IS NOT NULL', NULL, FALSE);
		$this->db->from('pharmacies p');
		$this->db->join('county c', 'c.id = p.county_id', 'left');
		if ($this->input->post('county')) {
			$county = $this->input->post('county');
			$this->db->where('c.id', $county);
		}
		$pharmacies = $this->db->get()->result();
		$pharmacies_table = "";
		$map_data = [];
		if($pharmacies){
			$counter = 1;
			foreach ($pharmacies as $pharmacy) {
				$pharmacies_table .= "<tr>";
				$pharmacies_table .= "<td>{$counter}</td>";
				$pharmacies_table .= "<td>".strtoupper($pharmacy->pharmacy_name)."</td>";
				// $pharmacies_table .= "<td>".strtoupper($pharmacy->pharmacy_contact_person)."</td>";
				// $pharmacies_table .= "<td>".strtoupper($pharmacy->pharmacy_phone)."</td>";
				$pharmacies_table .= "<td>".strtoupper($pharmacy->pharmacy_location)."</td>";
				$pharmacies_table .= "<td>".strtoupper($pharmacy->county_name)."</td>";
				$pharmacies_table .= "<td><a class = 'label label-success pin-on-map' href = '#' data-lat = '{$pharmacy->pharmacy_latitude}' data-lng = '{$pharmacy->pharmacy_longitude}' data-title = '{$pharmacy->pharmacy_name}'>Pin on Map</a></td>";
				$pharmacies_table .= "</tr>";

				$map_data[] = [
					'latitude'			=>	$pharmacy->pharmacy_latitude,
					'longitude'			=>	$pharmacy->pharmacy_longitude,
					'content_string'	=>	"<b>$pharmacy->pharmacy_name</b><br/><b>Name: </b>$pharmacy->pharmacy_location<br/><b>Contact Person: </b>$pharmacy->pharmacy_contact_person<br/>",
					'name'				=>	$pharmacy->pharmacy_name
				];
				$counter++;
			}
		}
		else{
			if(!$this->input->is_ajax_request()){
				$pharmacies_table .= "<tr>
					<td colspan = '6'>No Pharmacies Registered Yet</td>
				</tr>";
			}
		}
		if(!$this->input->is_ajax_request()){
			return $pharmacies_table;
		}else{
			$response = [
				'data'		=>	$pharmacies_table,
				'map_data'	=>	$map_data
			];

			return $this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}
}