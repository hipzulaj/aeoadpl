<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class customer extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_booking');
		$this->load->library('form_validation');
$this->load->model('Login_Database');
	}

	public function booking(){
		if(isset($this->session->userdata['customer'])){
    		$book_data = array(
			'cus_name' => $this->input->post('user'),
			'produk' => $this->input->post('name'),
			'jenis' => $this->input->post('jenis'),
			'biaya' => $this->input->post('biaya'),
			);
			$this->Model_booking->book($book_data);
				redirect('display/Dashboard_cus');
		}
		else
			redirect('display/login');
	}

	public function Cancel_booking($id){
		$this->Model_booking->Delete_book($id);
			redirect('display/Dashboard_cus');
	}
}