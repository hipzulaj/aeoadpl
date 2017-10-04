<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->model('Login_Database');	
		$this->load->library('form_validation');
		//$this->load->library('../controllers/display');
	}

	public function login()
	{
		$this->form_validation->set_rules('form-username', 'Username', 'required');
		$this->form_validation->set_rules('form-password', 'Password', 'required');
		$this->form_validation->set_rules('user', 'User', 'required');
		if($this->form_validation->run() == false){
			
			if(isset($this->session->userdata['customer'])){
				//redirect('display/Dashboard_cus');
				$this->load->view('display/Dashboard_cus');
			}
			elseif (isset($this->session->userdata['eo'])){
				//redirect('display/Dashboard_eo');
				$this->load->view('display/Dashboard_eo');
			}
			else{
				$this->load->view('user/login');
			}
		}

		else {
			$data = array(
				"username" => $this->input->post('form-username'),
				"password" => $this->input->post('form-username')
			);
			
			if($this->input->post('user')=='Customer')
				$result = $this->Login_Database->login_customer($data);
			elseif($this->input->post('user')=='EO')
				$result = $this->Login_Database->login_eo($data);

			if($result == false) 
				$this->load->view('user/login');

			else if ($result == true){
				if ($result != false) {
					$session_data = $data['username'];
					if($this->input->post('user')=='Customer'){
						$this->session->set_userdata('customer', $session_data);
					}
					else{ 
						$this->session->set_userdata('eo', $session_data);
					}
				}
			}
			redirect('display/index');
		}
	}

	function logout(){
		$this->session->sess_destroy();
		$this->load->view('user/login');;
	}
}