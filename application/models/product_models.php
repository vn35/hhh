<?php 
class product_models extends CI_Model {
	public function getAllproduct() {
		$query = $this->db->get('product');
		return $query->result();
	}

	public function addProduct($product) {
		return $this->db->insert('product', $product);
	}

	public function show($productView) {
		return $this->db->get('product', $productView);
	}

	public function delete($id) {
		$this->db->delete('product', array('id' => $id));
	}

	public function getProduct($id) {
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function update($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('product', $data);  
	}
}





?>
