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
		$this->form_validation->set_rules('form-name', 'Name', 'required');
		$this->form_validation->set_rules('form-email', 'Email', 'required');
		$this->form_validation->set_rules('form-username', 'Username', 'required');
		$this->form_validation->set_rules('form-password', 'Password', 'required');
		$this->form_validation->set_rules('user', 'User', 'required');

		if($this->form_validation->run() == FALSE){
			$this->load->view('user/login');
		} 
		else{
			if($this->input->post('user')=='Customer'){
				$data = array(
				'C_username' => $this->input->post('form-username'),
				'C_password' => md5($this->input->post('form-password')),
				'C_email' => $this->input->post('form-email'),
				'C_nama' => $this->input->post('form-name'),
				);

				//$data = $this->security->xss_clean($data);
				if ($this->security->xss_clean($data, TRUE) === FALSE)
				{
				      $this->load->view('user/login');  
				}

				else
					$result = $this->Login_Database->Registration_insertcus($data);

				if($result == false){
				$data = array(
					'error_regist' => 'Username or Email Already Registered');
				$this->load->view('user/login', $data);
				}

				else{
				$session_data = $data['C_username'];
				$this->session->set_userdata('customer', $session_data);
				redirect('display/index');
				}
			}

			elseif($this->input->post('user')=='EO'){
				$data = array(
				'E_username' => $this->input->post('form-username'),
				'E_password' => md5($this->input->post('form-password')),
				'E_email' => $this->input->post('form-email'),
				'E_nama' => $this->input->post('form-name'),
				);

				//$data = $this->security->xss_clean($data);

				if ($this->security->xss_clean($data, TRUE) === FALSE)
				{
				      $this->load->view('user/login');  
				}
				
				else
					$result = $this->Login_Database->Registration_inserteo($data);

				if($result == false){
				$data = array(
					'error_regist' => 'Username or Email Already Registered');
				$this->load->view('user/login', $data);
				} 
				else{
					$session_data = $data['E_username'];
					$this->session->set_userdata('eo', $session_data);
					redirect('display/index');
				}
			}
		}
	}


	public function login()
	{
		$this->form_validation->set_rules('form-username', 'Username', 'required');
		$this->form_validation->set_rules('form-password', 'Password', 'required');
		$this->form_validation->set_rules('user', 'User', 'required');
		
		if($this->form_validation->run() == false){
			if(isset($this->session->userdata['customer'])){
				$this->load->view('dashboard_cus');
			}
			elseif (isset($this->session->userdata['eo'])){
				$this->load->view('dashboard_eo');
			}
			else{
				$this->load->view('user/login');
			}
		}

		else {
			$data = array(
				"username" => $this->input->post('form-username'),
				"password" => md5($this->input->post('form-password'))
			);
			
			if($this->input->post('user')=='Customer')
				$result = $this->Login_Database->login_customer($data);
			elseif($this->input->post('user')=='EO')
				$result = $this->Login_Database->login_eo($data);

			if($result == false){
				$data = array(
					'error_message' => 'Invalid Username or Password');
				$this->load->view('user/login', $data);
			} 
				//$this->load->view('user/login');

			else if ($result == true){
				if ($result != false) {
					$session_data = $data['username'];
					if($this->input->post('user')=='Customer'){
						$this->session->set_userdata('customer', $session_data);
						redirect('display/Dashboard_cus');
					}
					else{ 
						$this->session->set_userdata('eo', $session_data);
						redirect('display/Dashboard_eo');
					}
				}
			}
		}
	}

	function logout(){
		$this->session->sess_destroy();
		$this->load->view('user/login');;
	}
}