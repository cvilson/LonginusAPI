<?php
Class Category_model extends CI_Model {


	public function getAll($page = 0, $limit = 10) {
		$query = $this->db->get('categories', $limit, ($page <= 0 ? 0 : $page*$limit));
		return $query->result_array();
	}

	public function getById($id) {
		$query = $this->db
			->select('*')
			->from('categories')
			->where(array('id' => $id))
			->get();
		if(count($query->result_array()) > 0)
		{
			return $query->result_array()[0];
		}else{
            return NULL;
		}
	}

	public function save($category) {
		if (isset($category['id'])) {
			return update($category);
		}

		return insert($category);
	}

	public function insert($category) {
		$category['create_date'] = date('Y-m-d H:i:s');
		return $this->db->insert('categories', $category);
	}

	public function update($category) {
		$category['update_date'] = date('Y-m-d H:i:s');
		return $this->db->update('categories', $category, array('id' => $category['id']));
	}

	public function delete($category_id) {
		$this->db->set('delete_date', date('Y-m-d H:i:s'));
		$this->db->where('id', $category['id']);
		return $this->db->update('categories');
	}

}
?>
