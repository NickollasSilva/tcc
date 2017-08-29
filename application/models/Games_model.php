<?php
class Games_model extends CI_Model {

        public function __construct() {
                $this->load->database();
        }
        public function get_platforms() {
        	$query = $this->db->get('platform');
        	return $query->result_array();
        }
        
        public function get_singleplatform($platform = FALSE) {
        	$query = $this->db->get_where('platform', array('cd_Platform' => $platform));
        	return $query->row_array();
        }
        
        public function get_games($platform = FALSE, $letter = false){
        	$this->db->where('cd_Platform', $platform);
        	if($letter !== FALSE){
        		$this->db->like('cd_Game', $letter, 'after');
        	}
        	$query = $this->db->get('game');
        	
        	return $query->result_array();
        }
        
        public function get_singlegame($game = FALSE){
        	$query = $this->db->get_where('game', array('cd_Game' => $game));
        	return $query->row_array();
        }
        
        public function set_games() {
        	$this->load->helper('url');
        
        	$cdgame = url_title($this->input->post('name'), 'dash', TRUE);
        
        	$data = array(
        			'cd_Game' => $cdgame,
        			'cd_Platform' => $this->input->post('platform'),
        			'ds_Name' => $this->input->post('name'),
        			'ds_Year' => $this->input->post('year'),
        			'ds_Developer' => $this->input->post('developer'),
        			'ds_Composer' => $this->input->post('composer'),
        			'ds_Description' => $this->input->post('description'),
        			'lk_Image' => $this->upload->data('file_name')
        	);
        
        	return $this->db->insert('game', $data);
        }
        
        public function update_game($game = FALSE, $imglink = FALSE) {
        	$this->load->helper('url');
        	
        	$cdgame = url_title($this->input->post('name'), 'dash', TRUE);
        	
        	if($imglink !== FALSE){
        		$data = array(
        				'cd_Game' => $cdgame,
        				'ds_Name' => $this->input->post('name'),
        				'cd_Platform' => $this->input->post('platform'),
        				'ds_Year' => $this->input->post('year'),
        				'ds_Developer' => $this->input->post('developer'),
        				'ds_Composer' => $this->input->post('composer'),
        				'ds_Description' => $this->input->post('description'),
        				'lk_Image' => $imglink
        		);
        	} else {
	        	$data = array(
	        			'cd_Game' => $cdgame,
	        			'ds_Name' => $this->input->post('name'),
	        			'cd_Platform' => $this->input->post('platform'),
	        			'ds_Year' => $this->input->post('year'),
	        			'ds_Developer' => $this->input->post('developer'),
	        			'ds_Composer' => $this->input->post('composer'),
	        			'ds_Description' => $this->input->post('description') 			
	        	);
        	}
        	
        	$this->db->where('cd_Game', $game);
        	$this->db->update('game', $data);
        }

		public function delete_game($game = FALSE){
			$this->db->where('cd_Game', $game);
			$this->db->delete('game');
			$this->db->where('cd_Game', $game);
			$this->db->delete('soundfile');
		}
}