<?php

class Surveys extends DashboardController{
	protected $gender;
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Dashboard');

		$this->gender = $this->M_Dashboard->getGender();
	}

	function index(){

		$data = [
			'preferred_kit'		=>	$this->getMostPreferredKit(),
			'table'				=>	$this->createAgeKitTable(),
			'gender_header'		=>	$this->createGenderHeader(),
			'totals'			=>	$this->getInHouseSurveyCounters()
		];

		$this->assets
				->addCss('dashboard/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css');
		$this->assets
				->addJs('dashboard/vendor/datatables/media/js/jquery.dataTables.min.js')
				->addJs('dashboard/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js')
				->addJs('dashboard/vendor/datatables.net-buttons/js/buttons.html5.min.js')
				->addJs('dashboard/vendor/datatables.net-buttons/js/buttons.print.min.js')
				->addJs('dashboard/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')
				->addJs('dashboard/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')
				->addJs('dashboard/vendor/jquery-flot/jquery.flot.js')
				->addJs('dashboard/vendor/jquery-flot/jquery.flot.pie.js')
				->addJs('dashboard/vendor/chartjs/Chart.min.js')
				->setJavascript('Dashboard/surveys/survey_js');
		$this->template
				->setPartial('Dashboard/surveys/index_v', $data)
				->adminTemplate();
	}

	function getTotalSurveys(){
		$query = $this->db->get('survey');
	}

	function getMostPreferredKit(){
		$numbers = $this->M_Dashboard->getPreferredKit();

		if ($numbers) {
			return $numbers;
		}

		show_404();
	}

	function createAgeKitTable(){
		$age_kit_numbers = $this->M_Dashboard->getAgeKitNumbers();
		$table = [];
		$age_kit_table = $gender_kit_table = '';
		if ($age_kit_numbers) {
			foreach ($age_kit_numbers as $number) {
				$age_kit_table .= "<tr>
					<td>$number->kit</td>
					<td>$number->oldest</td>
					<td>$number->youngest</td>
				</tr>";
			}
		}

		$kits = $this->db->get('kits')->result();
		$gender = $this->db->get('gender')->result();
		if ($kits) {
			foreach ($kits as $kit) {
				$gender_kit_table .= '<tr>';
				$gender_kit_table .= "<td>{$kit->kit}</td>";
				foreach ($gender as $sex) {
					$gender_kit_numbers = $this->M_Dashboard->getGenderKitNumbers($kit->id, $sex->id);
					if($gender_kit_numbers){
						$gender_kit_table .= "<td>{$gender_kit_numbers->numbers}</td>";
					}else{
						$gender_kit_table .= "<td>0</td>";
					}
				}				
				$gender_kit_table .= '</tr>';
			}
		}

		$table = [
			'age_kit_table' 	=> $age_kit_table,
			'gender_kit_table'	=>	$gender_kit_table
		];

		return $table;
	}

	function createGenderHeader(){
		$gender = $this->db->get('gender')->result();
		$gender_header = "";
		foreach ($gender as $sex) {
			$gender_header .= "<th>{$sex->gender}</th>";
		}

		return $gender_header;
	}

	function getInHouseSurveyCounters(){
		$surveys = $this->db->get('survey')->num_rows();

		$this->db->where('gender', 1);
		$male_count = $this->db->get('survey')->num_rows();

		$this->db->where('gender', 2);
		$female_count = $this->db->get('survey')->num_rows();

		return [
			'surveys'		=>	$surveys,
			'males'			=>	$male_count,
			'females'		=>	$female_count
		];
	}

	function getAnalyticsData(){
		$response = $monthly_count_data = $gender_data = $average_age_data = $gendernos = $monthly_curve_data = [];
		// get number of users grouped by gender
		$this->db->select('g.gender, g.color, count(s.age) as age');
		$this->db->from('survey s');
		$this->db->join('gender g', 'g.id=s.gender', 'right');
		$this->db->group_by('g.gender');
		$gender_counts = $this->db->get()->result();

		if ($gender_counts) {
			foreach ($gender_counts as $gender_count) {
				$count = ($gender_count->age == null) ? 0 : $gender_count->age;
				$gender_data[] = [
					'label'	=>	$gender_count->gender,
					'data'	=>	$count,
					'color'	=>	$gender_count->color	
				];

				$gendernos[$gender_count->gender] = $count;
			}
		}

		// getting average age of users grouped by users
		$this->db->select('g.gender');
		$this->db->select_avg('s.age');
		$this->db->from('survey s');
		$this->db->join('gender g', 'g.id=s.gender', 'right');
		$this->db->group_by('g.gender');

		$average_ages = $this->db->get()->result();

		if ($average_ages) {
			$total_age_averages = 0;
			$number_of_gender = 0;
			foreach ($average_ages as $gender_age) {
				$average_age = ($gender_age->age == null) ? 0 : $gender_age->age;
				if($average_age != NULL){
					$total_age_averages += $average_age;
					$number_of_gender++;
				}

				$average_age_data[$gender_age->gender] = $average_age;
			}

			$number_of_gender = ($number_of_gender == 0) ? 1 : $number_of_gender;

			$response['data']['overall_average'] = round($total_age_averages / $number_of_gender, 0);
		}

		$monthly_counts = $this->db->query("SELECT g.gender, count(s.id) as age FROM survey s
			RIGHT JOIN gender g ON g.id = s.gender AND MONTH(s.date_of_entry) = " . date('n') ."
			GROUP BY g.gender")->result();

		if ($monthly_counts) {
			$total_monthly_count = 0;
			foreach ($monthly_counts as $monthly_count) {
				$count = ($monthly_count->age == null) ? 0 : $monthly_count->age;
				$total_monthly_count += $count;
				$monthly_count_data[$monthly_count->gender] = $count;
			}

			$response['data']['monthly_total'] = $total_monthly_count;
		}

		// getting data for months
		$from_date = date("Y-m-01", strtotime("-6months"));
		$to_date = date('Y-m-d');

		$sql = "SELECT 
					DATE_FORMAT(date_of_entry, '%M %Y') as `month`,
					count(id) as surveys
				FROM survey
				GROUP BY DATE_FORMAT(date_of_entry, '%M %Y')
				ORDER BY date_of_entry ASC
				LIMIT 12;";

		$monthly_data = $this->db->query($sql)->result();
		
		// echo "<pre>";print_r($monthly_data);die;

		if ($monthly_data) {
			$outer_key = 0;
			$data_set = [];
			foreach ($monthly_data as $month) {
				$monthly_curve_data['labels'][] = $month->month;
				$data_set[] = $month->surveys;
				$outer_key++;
			}

			$monthly_curve_data['datasets'][] = [
				"label"					=>	"Surveys",
				"backgroundColor"		=>	"rgba(254,223,0,0.5)",
				"data"					=>	$data_set,
				"lineTension"			=>	0,
				"pointBorderWidth"		=>	1,
				"pointBackgroundColor"	=>	"rgba(254,223,0,1)",
				"pointRadius"			=>	3,
				"pointBorderColor"		=>	"#ffffff",
				"borderWidth"			=>	1
			];
		}

		$response['data']['monthly_curve_data']	= $monthly_curve_data;
		$response['data']['average_ages'] = $average_age_data;
		$response['data']['gender_counts'] = $gender_data;
		$response['data']['gendernos'] = $gendernos;
		$response['data']['monthly_count'] = $monthly_count_data;
		$response['data']['median_age'] = $this->M_Dashboard->getSurveyMedianAge()->median_age;

		//echo "<pre>";print_r($response);echo "</pre>";die();

		return $this->output->set_content_type('application/json')->set_output(json_encode($response, JSON_NUMERIC_CHECK));
	}
}