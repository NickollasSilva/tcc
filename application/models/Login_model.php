<?php
class Login_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	public function dologin(){
		$this->db->where('cd_Login', $this->input->post('login'));
		$this->db->where('cd_Password', $this->input->post('password'));
		
		$query = $this->db->get('staff');
			
		return $query->row_array();
	}
}