<?php
class Soundfiles_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	public function set_soundfiles($filename = FALSE) {
		$this->load->helper('url');
	
		$data = array(
				'cd_Game' => $this->input->post('game'),
				'cd_Filename' => $filename,
				'ds_Name' => $this->input->post('name'),
				'ds_Size' => $this->upload->data('file_size'),
				'ds_Extension' => $this->upload->data('file_ext')
		);
	
		return $this->db->insert('soundfile', $data);
	}
	
	public function get_soundfiles($game = FALSE) {
		$this->db->where('cd_Game', $game);
		
		$query = $this->db->get('soundfile');
		 
		return $query->result_array();
	}
	
	public function update_soundfile($oldfilename = FALSE, $filename = FALSE, $checker = FALSE) {
		$this->load->helper('url');
		
		if($checker !== FALSE){
			$data = array(
					'cd_Game' => $this->input->post('game'),
					'cd_Filename' => $filename,
					'ds_Name' => $this->input->post('name'),
					'ds_Size' => $this->upload->data('file_size'),
					'ds_Extension' => $this->upload->data('file_ext')
			);
		} else {
			$data = array(
					'cd_Game' => $this->input->post('game'),
					'cd_Filename' => $filename,
					'ds_Name' => $this->input->post('name')
			);
		}
		
		$this->db->where('cd_Filename', $oldfilename);
		$this->db->update('soundfile', $data);
	}
}