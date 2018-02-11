<?php

class Sites extends DashboardController{
	function __construct()
	{
		parent::__construct();
		$this->load->library('Excel');
	}

	// pharmacies sub section

	function pharmacies(){
		$js_data['counties'] = $this->getCounties(true);
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
				->addJs('plugin/bootstrap3-editable/js/bootstrap-editable.min.js');

		$this->assets->setJavascript('Dashboard/sites/sites_js', $js_data);
		$this->template
					->setPartial('Dashboard/sites/pharmacies_v')
					->adminTemplate();
	}

	function getPharmacyCountyListing(){
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

	function addPharmacy(){
		if ($this->input->post()) {
			$insertData = [
				'pharmacy_name'	=>	$this->input->post('pharmacy_name'),
				'pharmacy_contact_person'	=>	$this->input->post('contact_person'),
				'pharmacy_phone'	=>	$this->input->post('pharmacy_phone'),
				'pharmacy_location'	=>	$this->input->post('pharmacy_location'),
				'pharmacy_longitude'	=>	$this->input->post('pharmacy_longitude'),
				'pharmacy_latitude'	=>	$this->input->post('pharmacy_latitude'),
				'county_id'			=>	$this->input->post('pharmacy_county')
			];

			$insert = $this->db->insert('pharmacies', $insertData);

			redirect('Dashboard/Sites/pharmacies');
		}
	}

	

	// end of pharmacies sub section

	// referrals sub section
	function referrals(){
		$js_data['counties'] = $this->getCounties();
		$this->assets
				->addCss('dashboard/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css')
				->addCss('plugin/bootstrap3-editable/css/bootstrap-editable.css')
				->addCss('plugin/select2/css/select2.min.css');

		$this->assets
				->addJs('plugin/select2/js/select2.full.min.js')
				->addJs('dashboard/vendor/datatables/media/js/jquery.dataTables.min.js')
				->addJs('dashboard/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js')
				->addJs("dashboard/vendor/pdfmake/build/pdfmake.min.js")
				->addJs("dashboard/vendor/pdfmake/build/vfs_fonts.js")
				->addJs('dashboard/vendor/datatables.net-buttons/js/buttons.html5.min.js')
				->addJs('dashboard/vendor/datatables.net-buttons/js/buttons.print.min.js')
				->addJs('dashboard/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')
				->addJs('dashboard/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')
				->addJs('plugin/bootstrap3-editable/js/bootstrap-editable.min.js');

		$this->assets->setJavascript('Dashboard/sites/sites_js', $js_data);
		$this->template
					->setPartial('Dashboard/sites/referrals_v')
					->adminTemplate();
	}

	function importFacilities(){
		$file_path = './docs/facilites_geo_codes.xlsx';
		// $file_path = './docs/eHealth_facilities.xls';
		$data = $this->excel->readExcel($file_path);
		if (count($data) > 0) {
			foreach ($data as $item => $itemData) {

				// echo "<pre>"; print_r($itemData);echo "</pre>";die();
				$headers = $itemData[0];
				$dbColumns = $this->getDbColumnNames($item);
				$cleaned_headers = array_replace($headers, $dbColumns);
				$insertData = [];

				for ($i=1; $i < count($itemData); $i++) { 
					if ($itemData[$i][1] != "" && is_numeric($itemData[$i][1])) {
						$rowData = array_combine($cleaned_headers, $itemData[$i]);
						array_push($insertData, $rowData);
					}
				}

				if (count($insertData)) {
					if ($item == "facilities") {
						$this->db->insert_batch('facilities', $insertData);
					}
				}
			}
		}
	}

	function importUpdateFacilities(){
		// $file_path = './docs/facilites_geo_codes.xlsx';
		$file_path = './docs/eHealth_facilities.xls';
		$data = $this->excel->readExcel($file_path);
		if (count($data) > 0) {
			foreach ($data as $item => $itemData) {
				foreach ($itemData as $key => $value) {
					
					if ($key != 0) {
						// echo "<pre>"; print_r($value[0]);echo "</pre>";die();
						$this->db->where('facility_code', $value[0]);
						
						$this->db->set('description', $value[2]);
						$this->db->set('nearest_town', $value[3]);

						$this->db->update('facilities');
						// $this->db->insert_batch('facilities', $insertData);
					}
				}
				
			}
		}
	}

	function getDbColumnNames($table = 'facilities'){
		$dbColumns = [];
		switch ($table) {
			case 'facilities':
				$dbColumns = [
					0	=>	'dhis_code',
					1	=>	'facility_code',
					2	=>	'facility_name',
					3	=>	'longitude',
					4	=>	'latitude',
					5	=>	'county_name'
				];
				
			break;
			default:
				# code...
				break;
		}

		return $dbColumns;
	}

	// end of referrals sub section
}