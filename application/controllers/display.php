<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class display extends CI_Controller {
	public function __construct(){

		parent::__construct();
		$this->load->model('Model_products');
		$this->load->model('Model_booking');
	}
	
	public function index(){

		$data['products'] = $this->Model_products->Get_products();
		$this->load->view('homepage/home', $data);
	}
	
	public function categorize($jenis){

		$data['products'] = $this->Model_products->kategori($jenis);
		$this->load->view('homepage/home', $data);
	}

	public function dashboard()
	{
		//if($this->session->userdata['admin'] != '1')
		if(isset($this->session->userdata['admin']))
    		$this->load->view('admin/index');
		else
			$this->load->view('login/login');
	}

	public function Dashboard_cus()
	{
		//if($this->session->userdata['logged_in'] != '1')
		if(isset($this->session->userdata['customer'])){
			$cus = $this->session->userdata('customer');
			$data['booking'] = $this->Model_booking->Get_booking($cus);
    		$this->load->view('user/index',$data);
    	}
		else
			$this->load->view('user/login');
	}

	public function Dashboard_eo()
	{
		//if($this->session->userdata['logged_in'] != '1')
		if(isset($this->session->userdata['eo'])){
			$data['products'] = $this->Model_products->Get_products();
    		$this->load->view('eo/index', $data);
		}
		else
			$this->load->view('user/login');
	}

	public function login_mimin(){
		if(isset($this->session->userdata['admin']))
				$this->load->view('admin/index');
			else
				$this->load->view('login/login');
	}

	public function login(){
		if(isset($this->session->userdata['customer']))
			redirect('display/Dashboard_cus');
		else if(isset($this->session->userdata['eo']))
			redirect('display/Dashboard_eo');
		else
			$this->load->view('user/login');
	}
}