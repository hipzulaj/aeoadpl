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

		public function testing_purpose(){
			$test = $this->db->get('booking');
			return $test->num_rows();
		}

		public function testing_purpose_find($id){
			$result = $this->db->where('id', $id)
							   ->get('booking');
			return $this->db->affected_rows();
		}

		public function testing_reset_purpose_oppose_cancel_booking($id){
			$data = [
            'id' => 1,
            'cus_name' => 'customer',
            'produk' => 'Ayam Goreng',
            'jenis' => 'Wedding',
            'biaya' => '20000',
        ];
	        $hasil = $this->db->where('id',$id)
	        		 ->get('booking');
	        if($hasil->num_rows==0){
	        	$this->db->insert('booking', $data);
	        }
	        else return false;
		}

		//Yang bawah belom kelar
		public function testing_reset_purpose_oppose_booking($id){
			$this->db->where('id', $id)
					 ->delete('booking');
		}
	}

?>