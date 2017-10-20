<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_Database');	
		$this->load->library('form_validation');
		$this->load->helper('security');
	}


	public function register(){
		$this->form_validation->set_rules('form-name', 'Name', 'trim|required');
		$this->form_validation->set_rules('form-email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('form-username', 'Username', 'trim|required');
		$this->form_validation->set_rules('form-password', 'Password', 'trim|required');
		$this->form_validation->set_rules('user', 'User', 'trim|required');

		if($this->form_validation->run() == FALSE){
			if($this->session->has_userdata('customer')){
				redirect('dashboard_cus');}

			elseif ($this->session->has_userdata('eo')){
				redirect('dashboard_eo');}
			else{
				$this->load->view('user/login');
			}
		} 
		else{
			if($this->input->post('user')=='Customer'){
				$data = array(
					'C_username' => $this->input->post('form-username'),
					'C_password' => md5($this->input->post('form-password')),
					'C_email' => $this->input->post('form-email'),
					'C_nama' => $this->input->post('form-name'),
				);

				$result = $this->Login_Database->Registration_insertcus($data);

				if($result == false){
					$data = array(
						'error_regist' => 'Username or Email Already Registered');
					$this->load->view('user/login', $data);
					}

				else{
					$session_data = $data['C_username'];
					$this->session->set_userdata('customer', $session_data);
					redirect('display/index');}
			}

			elseif($this->input->post('user')=='EO'){
				$data = array(
					'E_username' => $this->input->post('form-username'),
					'E_password' => md5($this->input->post('form-password')),
					'E_email' => $this->input->post('form-email'),
					'E_nama' => $this->input->post('form-name'),
				);
				$result = $this->Login_Database->Registration_inserteo($data);

				if($result == false){
					$data = array(
						'error_regist' => 'Username or Email Already Registered');
					$this->load->view('user/login', $data);
					} 

				else{
					$session_data = $data['E_username'];
					$this->session->set_userdata('eo', $session_data);
					redirect('display/index');}
				}
			}
		}


	public function login()
	{
		$this->form_validation->set_rules('username-login', 'Username', 'trim|required');
		$this->form_validation->set_rules('password-login', 'Password', 'trim|required');
		$this->form_validation->set_rules('user', 'User', 'trim|required');
		
		if($this->form_validation->run() == false){
			if($this->session->has_userdata('customer')){
				redirect('dashboard_cus');}

			elseif ($this->session->has_userdata('eo')){
				redirect('dashboard_eo');}
			else{
				$this->load->view('user/login');
			}
		}

		else {
			$data = array(
				"username" => $this->input->post('username-login'),
				"password" => md5($this->input->post('password-login'))
			);
			
			if($this->input->post('user')=='Customer'){
				$result = $this->Login_Database->login_customer($data);
			}
			elseif($this->input->post('user')=='EO'){
				$result = $this->Login_Database->login_eo($data);
			}

			if($result == false){
				$data = array(
					'error_message' => 'Invalid Username or Password');
				$this->load->view('user/login', $data);
			}

			else if ($result == true){
				$session_data = $data['username'];
				if($this->input->post('user')=='Customer'){
					$this->session->set_userdata('customer', $session_data);
					redirect('display/Dashboard_cus');}
				else{ 
					$this->session->set_userdata('eo', $session_data);
					redirect('display/Dashboard_eo');
				}}}}

	function logout(){
		$this->session->unset_userdata('customer');
		$this->session->unset_userdata('eo');
		$this->session->sess_destroy();
		$this->load->view('user/login');;
	}
}