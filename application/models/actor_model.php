<?php
class actor_model extends CI_Model {
	
	private $actor= 'actor';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('a_id','asc');
		return $this->db->get($actor);
	}
	
	function count_all(){
		return $this->db->count_all($this->actor);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('a_id','asc');
		return $this->db->get($this->actor, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('a_id', $id);
		return $this->db->get($this->actor);
	}
	
	function save($actor){
		$this->db->insert($this->actor, $actor);
		return $this->db->insert_id();
	}
	
	function update($id, $actor){
		$this->db->where('a_id', $id);
		$this->db->update($this->actor, $actor);
	}
	
	function delete($id){
		$this->db->where('a_id', $id);
		$this->db->delete($this->actor);
	}
}
?>