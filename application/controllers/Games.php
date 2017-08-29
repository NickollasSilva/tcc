<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Games extends CI_Controller {
	
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
	
	public function login(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['platforms'] = $this->games_model->get_platforms();
		$data['title'] = 'VGM Edits - Login';
		$data['error'] = '';
		$data['lasturl'] = $this->input->get("lurl");
		
		$this->form_validation->set_rules('login', 'Login', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('login/loginpage');
			$this->load->view('template/footer');
		} else
		if (!empty($this->login_model->dologin())){
			$logdata = $this->login_model->dologin();
			$this->session->set_userdata($logdata);
			redirect($this->input->post("lasturl"));	
		} else {
			$data['error'] = 'login failed';
			$this->load->view('template/header', $data);
			$this->load->view('login/loginpage');
			$this->load->view('template/footer');
		}
	}
	
	public function logout(){
		$array_items = array('cd_Login', 'cd_Password', 'cd_Level');		
		$this->session->unset_userdata($array_items);
		redirect($this->input->get("lurl"));
	}
	
	public function deleteGame($game = NULL){
		if(isset($_SESSION['cd_Level']) && $_SESSION['cd_Level'] > 0){
			$data['platforms'] = $this->games_model->get_platforms();
			$data['game'] = $this->games_model->get_singlegame($game);
			$data['title'] = "Delete " . $data['game']['ds_Name'] . "?";

			if(!empty($this->input->post("valid"))) {
				$soundfiles = $this->soundfiles_model->get_soundfiles($game);
				foreach ($soundfiles as $soundfile){
					unlink(FCPATH . "/files/soundfiles/" . $soundfile['cd_Filename'] . $soundfile['ds_Extension']);		
				}
				$this->games_model->delete_game($game);
			} else {
				$this->load->view('template/header', $data);
				$this->load->view('games/deletegame');
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

	public function listGames($platform = NULL, $letter = NULL){
		$data['platforms'] = $this->games_model->get_platforms();
		$title = $this->games_model->get_singleplatform($platform);
		$data['platform'] = $title['cd_Platform'];
		$title = $title['ds_Name'];
		
		if($letter !== NULL){
			$data['games'] = $this->games_model->get_games($platform, $letter);
		} else {
			$data['games'] = $this->games_model->get_games($platform);
		}
		
		
		$data['title'] = 'VGM Edits - ' . $title;
		
		
		$this->load->view('template/header', $data);
		
		if (empty($data['games'])){
			$this->load->view('template/empty');
		} else {
			$this->load->view('games/gamelist');
		}
		
		$this->load->view('template/footer');
		
	}
	
	
	
	public function showGamepage($game = NULL){
		$data['platforms'] = $this->games_model->get_platforms();
		$data['game'] = $this->games_model->get_singlegame($game);
		$data['soundfiles'] = $this->soundfiles_model->get_soundfiles($game);
		$data['title'] = 'VGM Edits - ' . $data['game']['ds_Name'];
		
		$this->load->view('template/header', $data);
		
		if (empty($data['game'])){
			$this->load->view('template/empty');
		} else {
			$this->load->view('games/gamepage');
			$this->load->view('soundfiles/soundfilelist');
		}
		
		$this->load->view('template/footer');
	}
	
	public function insertGames($platform = NULL){
		if(isset($_SESSION['cd_Level']) && $_SESSION['cd_Level'] > 0){
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		
		$data['platforms'] = $this->games_model->get_platforms();
		$data['title'] = 'VGM Edits - Insert Game';
		$data['error'] = '';
		$data['test'] = url_title($this->input->post('name'), 'dash', TRUE);
		$data['success'] = '';
		
		$cdgame = url_title($this->input->post('name'), 'dash', TRUE);
		
		$this->form_validation->set_rules('name', 'Name', 'required|is_unique[game.ds_Name]');
		
		$config['upload_path']          = './files/images/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;
		$config['file_name']            = $cdgame;
		
		
		$this->load->library('upload', $config);
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('games/insertgames');
			$this->load->view('template/footer');
		}
		else
		if (!$this->upload->do_upload('image')){
			$error = array('error' => $this->upload->display_errors());
		
			$this->load->view('template/header', $data);
			$this->load->view('games/insertgames', $error);
			$this->load->view('template/footer');
		} else {
			$this->games_model->set_games();
			$data['success'] = site_url('games/' . $this->input->post("platform") . '/' . $cdgame);
			$this->load->view('template/header', $data);
			$this->load->view('games/insertgames');
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
	
	public function editGame($game = NULL){
		if(isset($_SESSION['cd_Level']) && $_SESSION['cd_Level'] > 0){
		$this->load->helper('form');
		$this->load->library('form_validation');
		
	
	
		$data['platforms'] = $this->games_model->get_platforms();
		$data['game'] = $this->games_model->get_singlegame($game);
		$data['title'] = 'VGM Edits - Edit ' . $data['game']['ds_Name'];
		
		$data['error'] = '';
		$data['test'] = url_title($this->input->post('name'), 'dash', TRUE);
		
		$this->form_validation->set_rules('name', 'Name', 'required');
	
		$cdgame = url_title($this->input->post('name'), 'dash', TRUE);
	
		$config['upload_path']          = './files/images/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;
		$config['file_name']            = $cdgame;
		$config['overwrite']            = true;
	
		$this->load->library('upload', $config);
	
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('games/editgame');
			$this->load->view('template/footer');
		} else
		if(!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
			$this->games_model->update_game($game);
			redirect('games/' . $this->input->post("platform") . '/' . $cdgame . '/edit');			
		} else 
		if (!$this->upload->do_upload('image')){
			$error = array('error' => $this->upload->display_errors());
		
			$this->load->view('template/header', $data);
			$this->load->view('games/insertgames', $error);
			$this->load->view('template/footer');
		} else {
			$imglink = $this->upload->data('file_name');
			$this->games_model->update_game($game, $imglink);			
			redirect('games/' . $this->input->post("platform") . '/' . $cdgame . '/edit');
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
