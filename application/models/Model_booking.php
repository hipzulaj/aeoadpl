<?php 
	Class Model_booking extends CI_Model{

		public function Get_all_book(){
			$hasil = $this->db->get('booking');
			if($hasil->num_rows()>0)
				return $hasil->result();
			else return array();
		}

		public function Get_booking($cus){
			$hasil = $this->db->where('cus_name', $cus)
							   ->get('booking');
			if($hasil->num_rows()>0)
				return $hasil->result();
			else return array();
		}

		public function book($book_data){
			$this->db->insert('booking', $book_data);
		}

		public function Delete_book($id){
			$this->db->where('id', $id)
					 ->delete('booking');
		}
	}

?>