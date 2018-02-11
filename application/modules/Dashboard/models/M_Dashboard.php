<?php

class M_Dashboard extends CI_Model{
	function __construct()
	{
		parent::__construct();
	}

	function getGender(){
		return $this->db->get('gender')->result();
	}

	function getPreferredKit(){
		$sql = "SELECT kit,MAX(number) as number FROM (SELECT k.kit, count(ukr.id) as `number` FROM user_kit_results ukr
		JOIN kits k ON k.id = ukr.kit_id
		GROUP BY k.id) b;";

		return $this->db->query($sql)->row();
	}

	function getAgeKitNumbers(){
		$this->db->select('k.kit');
		$this->db->select_max('s.age', 'oldest');
		$this->db->select_min('s.age', 'youngest');
		$this->db->from('survey s');
		$this->db->join('user_kit_results ukr', 'ukr.id = s.id');
		$this->db->join('kits k', 'k.id = ukr.kit_id');
		$this->db->group_by('k.id');

		return $this->db->get()->result();
	}

	function getGenderKitNumbers($kit_id, $gender_id){
		$this->db->select('count(DISTINCT(s.id)) as numbers');
		$this->db->from('survey s');
		$this->db->join('user_kit_results ukr', 'ukr.id = s.id');
		$this->db->join('kits k', 'k.id = ukr.kit_id');
		$this->db->join('gender g', 'g.id = s.gender');
		$this->db->where('k.id', $kit_id);
		$this->db->where('g.id', $gender_id);
		$this->db->group_by('g.id');

		return $this->db->get()->row();
	}

	function getSurveyMedianAge(){
		$sql = "SELECT avg(t1.age) as median_age FROM (
		SELECT @rownum:=@rownum+1 as `row_number`, s.age
		  FROM survey s,  (SELECT @rownum:=0) r
		  WHERE 1
		  -- put some where clause here
		  ORDER BY s.age
		) as t1, 
		(
		  SELECT count(*) as total_rows
		  FROM survey s
		  WHERE 1
		  -- put same where clause here
		) as t2
		WHERE 1
		AND t1.row_number in ( floor((total_rows+1)/2), floor((total_rows+2)/2) );";

		return $this->db->query($sql)->row();
	}
}