<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class eo extends CI_Controller {
	public function __construct(){

		parent::__construct();
		$this->load->model('Model_products');
		$this->load->model('Model_booking');
		$this->load->library('form_validation');
	}

	public function Transaksi_booking(){
		if(isset($this->session->userdata['eo'])){
    		$data['booking'] = $this->Model_booking->Get_all_book();
    		$this->load->view('eo/Booking_eo', $data);
		}
		else
			redirect('display/login');
	
	}

	public function Tambah_produk_form(){
		if(isset($this->session->userdata['eo'])){
    		$this->load->view('eo/Tambah_produk_form');
		}
		else
			redirect('display/login');
	}
}