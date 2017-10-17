<?php
Class Login_Database extends CI_Model{

	public function Registration_insertcus($data){
		$condition = "C_username =" . "'" . $data['C_username'] . "' OR " . "C_email =" . "'" .$data['C_email']."'";
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
		$condition = "E_username =" . "'" . $data['E_username'] . "' OR " . "E_email =" . "'" .$data['E_email']."'";
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

	public function login_admin($data){
		
		$condition = "username =" ."'" . $data['username']. "' AND " . "password =" ."'" .$data['password']."'";
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows()==1){
			return true;
		}
		else return false;
	}

	public function login_customer($data){
		
		$condition = "C_username =" ."'" . $data['username']. "' AND " . "C_password =" ."'" .$data['password']."'";
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows()==1){
			return true;
		}
		else return false;
	}

	public function login_eo($data){
		
		$condition = "E_username =" ."'" . $data['username']. "' AND " . "E_password =" ."'" .$data['password']."'";
		$this->db->select('*');
		$this->db->from('eo');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows()==1){
			return true;
		}
		else return false;
	}		
}

?>