<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_Database');	
		$this->load->library('form_validation');
	}


	public function register(){
		$this->form_validation->set_rules('form-name', 'Name', 'required');
		$this->form_validation->set_rules('form-email', 'Email', 'required');
		$this->form_validation->set_rules('form-username', 'Username', 'required');
		$this->form_validation->set_rules('form-password', 'Password', 'required');
<<<<<<< HEAD
		$this->form_validation->set_rules('user', 'User', 'required');
=======
>>>>>>> 4b77225bdb79aaadb6eb4c913f8ab2d89404e7af

		if($this->form_validation->run() == FALSE){
			$this->load->view('user/login');
		} 
		else{
<<<<<<< HEAD
			if($this->input->post('user')=='Customer'){
=======
			if($this->input->post('user')==''){
				$result = "";
				$data = array(
					'error_message' => 'Please Select Your Role');
				$this->load->view('user/login', $data);
			}
			else if($this->input->post('user')=='Customer'){
>>>>>>> 4b77225bdb79aaadb6eb4c913f8ab2d89404e7af
				$data = array(
				'C_username' => $this->input->post('form-username'),
				'C_password' => $this->input->post('form-password'),
				'C_email' => $this->input->post('form-email'),
				'C_nama' => $this->input->post('form-name'),
				);
				$result = $this->Login_Database->Registration_insertcus($data);
				$session_data = $data['C_username'];
						$this->session->set_userdata('customer', $session_data);
<<<<<<< HEAD
			}
			elseif($this->input->post('user')=='EO'){
=======
						redirect('display/index');
			}
			else if($this->input->post('user')=='EO'){
>>>>>>> 4b77225bdb79aaadb6eb4c913f8ab2d89404e7af
				$data = array(
				'E_username' => $this->input->post('form-username'),
				'E_password' => $this->input->post('form-password'),
				'E_email' => $this->input->post('form-email'),
				'E_nama' => $this->input->post('form-name'),
				);
				$result = $this->Login_Database->Registration_inserteo($data);
				$session_data = $data['E_username'];
						$this->session->set_userdata('eo', $session_data);
<<<<<<< HEAD
			}
			$this->load->view('index');
=======
						redirect('display/index');
			}
			else $this->load->view('salah');
>>>>>>> 4b77225bdb79aaadb6eb4c913f8ab2d89404e7af
		}
	}


	public function login()
	{
		$this->form_validation->set_rules('form-username', 'Username', 'required');
		$this->form_validation->set_rules('form-password', 'Password', 'required');
<<<<<<< HEAD
		$this->form_validation->set_rules('user', 'User', 'required');
		
		if($this->form_validation->run() == false){
			if(isset($this->session->userdata['customer'])){
				$this->load->view('dashboard_cus');
			}
			elseif (isset($this->session->userdata['eo'])){
				$this->load->view('dashboard_eo');
			}
			else{
=======
		if($this->form_validation->run() == false){
			
			if(isset($this->session->userdata['customer']))
				redirect('display/Dashboard_cus');
			else if (isset($this->session->userdata['eo']))
				redirect('display/Dashboard_eo');
			else
>>>>>>> 4b77225bdb79aaadb6eb4c913f8ab2d89404e7af
				$this->load->view('user/login');
		}

		else {
			$data = array(
				"username" => $this->input->post('form-username'),
				"password" => $this->input->post('form-password')
			);
			
			if($this->input->post('user')==''){
				$result = "";
				$data = array(
					'error_message' => 'Please Select Your Role');
				$this->load->view('user/login', $data);
			}
			else if($this->input->post('user')=='Customer')
				$result = $this->Login_Database->login_customer($data);
			else if($this->input->post('user')=='EO')
				$result = $this->Login_Database->login_eo($data);
			else {
				$data = array(
					'error_message' => 'Invalid Username or Password');
				$this->load->view('user/login', $data);
			}

<<<<<<< HEAD
			if($result == false){
				$data = array(
					'error_message' => 'Invalid Username or Password');
				$this->load->view('user/login', $data);
			} 
				$this->load->view('user/login');

			else if ($result == true){
=======
			if ($result == true){
>>>>>>> 4b77225bdb79aaadb6eb4c913f8ab2d89404e7af
				if ($result != false) {
					$session_data = $data['username'];
					if($this->input->post('user')=='Customer'){
						$this->session->set_userdata('customer', $session_data);
						redirect('display/index');
					}
					else{ 
						$this->session->set_userdata('eo', $session_data);
						redirect('display/index'); 
					}
				}
				redirect('display/Dashboard_eo');
			}
<<<<<<< HEAD
=======
			else {
				$data = array(
					'error_message' => 'Invalid Username or Password');
				$this->load->view('user/login', $data);
			}
>>>>>>> 4b77225bdb79aaadb6eb4c913f8ab2d89404e7af
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('display/index');
	}
}