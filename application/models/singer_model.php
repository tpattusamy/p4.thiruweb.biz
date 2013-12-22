<?php
class singer_model extends CI_Model {
	
	private $singer= 'singer';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('s_id','asc');
		return $this->db->get($singer);
	}
	
	function count_all(){
		return $this->db->count_all($this->singer);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('s_id','asc');
		return $this->db->get($this->singer, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('s_id', $id);
		return $this->db->get($this->singer);
	}
	
	function save($singer){
		$this->db->insert($this->singer, $singer);
		return $this->db->insert_id();
	}
	
	function update($id, $singer){
		$this->db->where('s_id', $id);
		$this->db->update($this->singer, $singer);
	}
	
	function delete($id){
		$this->db->where('s_id', $id);
		$this->db->delete($this->singer);
	}
}
?>