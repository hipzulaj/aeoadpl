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
	}
?>