<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soundfiles extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model("games_model");
		$this->load->model("soundfiles_model");
		$this->load->model("login_model");
		$this->load->helper("url_helper");
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
	}
	
	public function index(){
		$data['platforms'] = $this->games_model->get_platforms();
		$data['title'] = 'VGM Edits - Home';
		$this->load->view('template/header', $data);
		$this->load->view('template/empty');
		$this->load->view('template/footer');
	
	}
	
	public function insertSoundfile($game = NULL){
		if(isset($_SESSION['cd_Level']) && $_SESSION['cd_Level'] > 0){
		$this->load->helper('form');
		$this->load->library('form_validation');
	
	
		$data['platforms'] = $this->games_model->get_platforms();
		$data['title'] = 'VGM Edits - Insert Soundfile';
		$data['error'] = '';
		$data['game'] = $this->games_model->get_singlegame($game);
	
		$filename = url_title($this->input->post('name'), 'dash', TRUE);
		$filename = $filename . '-' . $this->input->post('game');		
		
		$config['upload_path']          = './files/soundfiles/';
		$config['allowed_types']        = 'mid|sf2|dls';
		$config['max_size']             = 30000;
		$config['file_name']            = $filename;
		
		$this->form_validation->set_rules('name', 'Name', 'required');
	
	
		$this->load->library('upload', $config);
	
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('soundfiles/insertsoundfile');
			$this->load->view('template/footer');
		}
		else
		if (!$this->upload->do_upload('soundfile')){
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('template/header', $data);
			$this->load->view('soundfiles/insertsoundfile', $error);
			$this->load->view('template/footer');
		} else {
			$this->soundfiles_model->set_soundfiles($filename);
			$this->load->view('template/header', $data);
			$this->load->view('soundfiles/insertsoundfile');
			$this->load->view('template/footer');
		}
			
		} else {
			$data['platforms'] = $this->games_model->get_platforms();
			$data['title'] = 'VGM Edits - Unauthorized';
			$this->load->view('template/header', $data);
			$this->load->view('template/empty');
			$this->load->view('template/footer');
		}
	}
	
	public function editSoundfiles($game = NULL){
		if(isset($_SESSION['cd_Level']) && $_SESSION['cd_Level'] > 0){
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['platforms'] = $this->games_model->get_platforms();
		$data['game'] = $this->games_model->get_singlegame($game);
		$data['soundfiles'] = $this->soundfiles_model->get_soundfiles($game);
		$data['title'] = 'VGM Edits - Edit Soundfiles';
		$oldfilename = $this->input->post('filename');
		$oldfileext = $this->input->post('oldfileext');
		$checker = 'op';
		
		$filename = url_title($this->input->post('name'), 'dash', TRUE);
		$filename = $filename . '-' . $this->input->post('game');
		$config['upload_path']          = './files/soundfiles/';
		$config['allowed_types']        = 'mid|sf2|dls';
		$config['max_size']             = 30000;
		$config['file_name']            = $filename;
		$config['overwrite']            = true;
		
		$this->form_validation->set_rules('name', 'Name', 'required');
		
		$this->load->library('upload', $config);
		
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('games/gamepage');
			$this->load->view('soundfiles/soundfileedit');
			$this->load->view('template/footer');
		} else
		if(!isset($_FILES['soundfile']) || $_FILES['soundfile']['error'] == UPLOAD_ERR_NO_FILE) {
			rename(FCPATH . "/files/soundfiles/" . $oldfilename . $oldfileext, FCPATH . "/files/soundfiles/" . $filename . $oldfileext);
			$this->soundfiles_model->update_soundfile($oldfilename, $filename);
			$this->load->view('template/header', $data);
			$this->load->view('games/gamepage');
			$this->load->view('soundfiles/soundfileedit');
			$this->load->view('template/footer');
			redirect(uri_string());	
		} else		
		if (!$this->upload->do_upload('soundfile')){
			$error = array('error' => $this->upload->display_errors());
	
			$this->load->view('template/header', $data);
			$this->load->view('games/gamepage');
			$this->load->view('soundfiles/soundfileedit', $error);
			$this->load->view('template/footer');
			
		} else {
			if($oldfilename !== $filename){
				unlink(FCPATH . "/files/soundfiles/" . $oldfilename . $oldfileext);
			}
			$this->soundfiles_model->update_soundfile($oldfilename, $filename, $checker);
			$this->load->view('template/header', $data);
			$this->load->view('games/gamepage');
			$this->load->view('soundfiles/soundfileedit');
			$this->load->view('template/footer');
			redirect(uri_string());
		}
	
		} else {
			$data['platforms'] = $this->games_model->get_platforms();
			$data['title'] = 'VGM Edits - Unauthorized';
			$this->load->view('template/header', $data);
			$this->load->view('template/empty');
			$this->load->view('template/footer');
					
		}
	}	
}