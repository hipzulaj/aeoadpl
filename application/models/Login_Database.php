<?php
Class Login_Database extends CI_Model{

public function Registration_insertcus($data){
		$condition = "C_username =" . "'" . $data['C_username'] . "' AND " . "C_email =" . "'" .$data['C_email']."'";
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows()==0){
			$this->db->insert('customer', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} 
		else return false;
	}

		public function Registration_inserteo($data){
		$condition = "E_username =" . "'" . $data['E_username'] . "' AND " . "E_email =" . "'" .$data['E_email']."'";
		$this->db->select('*');
		$this->db->from('eo');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows()==0){
			$this->db->insert('eo', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} 
		else return false;
	}
?>