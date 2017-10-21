<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class customer extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_booking');
		$this->load->model('Model_products');
		$this->load->library('form_validation');	
	}

	public function booking($id){
		if($this->session->has_userdata('customer')){
			$find = $this->Model_products->find($id);
			if($find!=null){
	    		$book_data = array(
				'cus_name' => $this->input->post('user'),
				'produk' => $find->nama_produk,
				'jenis' => $find->jenis,
				'biaya' => $find->biaya,
				);
				$this->Model_booking->book($book_data);
					redirect('display/Dashboard_cus');}
			else show_404();}
		else{
			redirect('display/login');}}
	
	public function Cancel_booking($id){
	if($this->session->has_userdata('customer')){

		if($this->Model_booking->testing_purpose_find($id)==1){
			$this->Model_booking->Delete_book($id);
			redirect('display/Dashboard_cus');}
		else {
			show_404();}}
	else{
		redirect('display/login');}}
}