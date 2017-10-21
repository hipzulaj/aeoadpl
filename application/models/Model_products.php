<?php 
	Class Model_products extends CI_Model{

		public function Get_products(){
			$hasil = $this->db->get('produk');
			if($hasil->num_rows()>0){
				return $hasil->result();
			}
			else return array();
		}

		public function find($id){
			$result = $this->db->where('id', $id)
							   ->limit(1)
							   ->get('produk');
			if($result->num_rows()>0)
				return $result->row();
			else return array();
		}

		public function kategori($jenis){
			$hasil = $this->db->where('jenis', $jenis)
							   ->get('produk');
			if($hasil->num_rows()>0)
				return $hasil->result();
			else return array();
		}

		public function Add_products($data_products){
			$this->db->insert('produk', $data_products);
		}

		public function Edit_products($id, $data_products){
			$this->db->where('id', $id)
					 ->update('produk', $data_products);
		}

		public function Delete_products($id){
			$this->db->where('id', $id)
					 ->delete('produk');
			$this->db->affected_rows();
		}

		//Line below for testing purpose
		public function testing_purpose(){
			$test = $this->db->get('produk');
			return $test->num_rows();
		}

		public function testing_purpose_find($id){
			$result = $this->db->where('id', $id)
							   ->get('produk');
			return $this->db->affected_rows();
		}

		//Line below for reset database
		public function testing_reset_purpose_oppose_add_products($id){
			$this->db->where('id', $id)
					 ->delete('produk');
		}

		//belom kelar KERJAIIINNN!!!!
		public function testing_reset_purpose_oppose_edit(){

		}

		public function testing_reset_purpose_oppose_delete($id){
			$data = [
            'id' => 7,
            'nama_produk' => 'Testing Delete',
            'jenis' => 'Wedding',
            'deskripsi' => 'YIHAA',
            'biaya' => '1'
        ];
	        $hasil = $this->db->where('id',$id)
	        		 ->get('produk');
	        if($hasil->num_rows==0){
	        	$this->db->insert('produk', $data);
	        }
	        else return false;
		}
	}
?>