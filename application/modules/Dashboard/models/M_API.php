<?php

class M_API extends CI_Model{
	function __construct()
	{
		parent::__construct();
	}

	function searchFacility($search_value = NULL, $limit = NULL, $offset = NULL, $order = NULL, $order_direction = NULL){

		if (isset($search_value)) {
			$this->db->like('facility_name', $search_value);
			$this->db->or_like('facility_code', $search_value);
			$this->db->or_like('county_name', $search_value);
		}

		if (isset($limit) && isset($offset) && $limit != -1) {
			$this->db->limit($limit, $offset);
		}

		if (isset($order) && isset($order_direction)) {
			$this->db->order_by($order, $order_direction);
		}

		$query = $this->db->get("facilities");

		return $query->result();
	}

	function searchPharmacy($search_value = NULL, $limit = NULL, $offset = NULL, $order = NULL, $order_direction = NULL){
		if (isset($search_value)) {
			$this->db->like('p.pharmacy_name', $search_value);
			$this->db->or_like('p.pharmacy_contact_person', $search_value);
			$this->db->or_like('p.pharmacy_location', $search_value);
			$this->db->or_like('c.county_name', $search_value);
		}

		if (isset($limit) && isset($offset) && $limit != -1) {
			$this->db->limit($limit, $offset);
		}

		if (isset($order) && isset($order_direction)) {
			$this->db->order_by($order, $order_direction);
		}

		$this->db->select('p.*, c.county_name');
		$this->db->from('pharmacies p');
		$this->db->join('county c', 'c.id = p.county_id', 'left');

		$query = $this->db->get();

		return $query->result();
	}

	function searchUser($search_value = NULL, $limit = NULL, $offset = NULL, $order = NULL, $order_direction = NULL){
		if (isset($search_value)) {
			$this->db->like('user_email', $search_value);
			$this->db->or_like('user_username', $search_value);
			$this->db->or_like('CONCAT(user_firstname, " ", user_lastname)', $search_value);
			$this->db->or_like('user_firstname', $search_value);
			$this->db->or_like('user_lastname', $search_value);
		}

		if (isset($limit) && isset($offset) && $limit != -1) {
			$this->db->limit($limit, $offset);
		}

		if (isset($order) && isset($order_direction)) {
			$this->db->order_by($order, $order_direction);
		}

		$this->db->select('CONCAT(user_firstname, " ", user_lastname) AS user_fullname, uuid, id, user_email, user_username, user_avatar, user_is_active, user_firstname, user_lastname, user_type, user_reset_token');

		$query = $this->db->get("user");

		return $query->result();
	}

	function searchSurvey($search_value = NULL, $limit = NULL, $offset = NULL, $order = NULL, $order_direction = NULL){
		if (isset($search_value)) {
			$this->db->like('age', $search_value);
			$this->db->or_like('gender', $search_value);
			$this->db->or_like('kits', $search_value);
		}

		if (isset($limit) && isset($offset) && $limit != -1) {
			$this->db->limit($limit, $offset);
		}

		if (isset($order) && isset($order_direction)) {
			$this->db->order_by($order, $order_direction);
		}

		$query = $this->db->get('survey_v');

		return $query->result();
	}
}