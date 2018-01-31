<?php 
class user_models extends CI_Model {
	public function getAlluser() {
		$query = $this->db->get('users');
		return $query->result();
	}

	public function adduser($user) {
		return $this->db->insert('users', $user);
	}

	public function show($userView) {
		return $this->db->get('users', $userView);
	}

	public function delete($id) {
		$this->db->delete('users', array('id' => $id));
	}

	public function getuser($id) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function update($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('users', $data);  
	}
}
}
?>
