<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mimin_perih extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_Database');	
		$this->load->library('form_validation');
	}

	public function login()
	{
		$this->form_validation->set_rules('u', 'Username', 'required');
		$this->form_validation->set_rules('p', 'Password', 'required');
		if($this->form_validation->run() == false){
			
			if(isset($this->session->userdata['admin']))
				$this->load->view('admin/index');

			else
				$this->load->view('login/login');
		}

		else {
			$data = array(
				"username" => $this->input->post('u'),
				"password" => $this->input->post('p')
			);
			
			$result = $this->Login_Database->login_admin($data);

			if ($result == true){
				if ($result != false) {
					$session_data = $data['username'];
					$this->session->set_userdata('admin', $session_data);
					$this->load->view('admin/index');
				}
			}
			else {
				$data = array(
					'error_message' => 'Invalid Username or Password');
				$this->load->view('login/login', $data);
			}
		}
	}

	function logout(){
		$this->session->sess_destroy();
		$this->load->view('login/login');
	}
}