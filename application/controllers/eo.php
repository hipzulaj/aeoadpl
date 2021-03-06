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
		if($this->session->has_userdata('eo')){
    		$data['booking'] = $this->Model_booking->Get_all_book();
    		$this->load->view('eo/Booking_eo', $data);
		}
		else
			redirect('display/login');
	
	}

	public function Tambah_produk_form(){
		if($this->session->has_userdata('eo')){
    		$this->load->view('eo/Tambah_produk_form');
		}
		else
			redirect('display/login');
	}

	public function Tambah_produk(){
		if($this->session->has_userdata('eo')){
    		$this->load->view('eo/Tambah_produk_form');
		}
		else{
			redirect('display/login');}

		$this->form_validation->set_rules('nama', 'Nama Produk', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis Produk', 'required');

		if($this->form_validation->run() == false)
			$this->load->view('eo/Tambah_produk_form');
		else {
			$data_products = array(
				'nama_produk' => set_value('nama'),
				'biaya' => set_value('harga'),
				'deskripsi' => set_value('deskripsi'),
				'jenis' => set_value('jenis'), 
				);
			$this->Model_products->Add_products($data_products);
			redirect('display/Dashboard_eo');}}

	public function Edit_produk($id){

		$find = $this->Model_products->find($id);
		if($find!=null){
			$this->form_validation->set_rules('nama', 'Nama Produk', 'required');
			$this->form_validation->set_rules('harga', 'Harga', 'required');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
			$this->form_validation->set_rules('jenis', 'Jenis Produk', 'required');

			if($this->form_validation->run() == false){
				if($this->session->has_userdata('eo')){
	    			$data['produk'] = $this->Model_products->find($id);
					$this->load->view('eo/Edit_produk_form', $data);
				}
				else
					redirect('display/login');}

			else {
					$data_products = array(
						'nama_produk' => set_value('nama'),
						'biaya' => set_value('harga'),
						'deskripsi' => set_value('deskripsi'),
						'jenis' => set_value('jenis'), 
						);
					$this->Model_products->Edit_products($id, $data_products);
					redirect('display/Dashboard_eo');}}

		else show_404();}

	public function Hapus_produk($id){
		if($this->session->has_userdata('eo')){

			if($this->Model_products->testing_purpose_find($id)==1){
				$this->Model_products->Delete_products($id);
				redirect('display/Dashboard_eo');}
			else{
				show_404();}}
		else{
			redirect('display/login');}}
}