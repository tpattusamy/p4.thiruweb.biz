<?php
class lyricist_model extends CI_Model {
	
	private $lyricist= 'lyricist';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('l_id','asc');
		return $this->db->get($lyricist);
	}
	
	function count_all(){
		return $this->db->count_all($this->lyricist);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('l_id','asc');
		return $this->db->get($this->lyricist, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('l_id', $id);
		return $this->db->get($this->lyricist);
	}
	
	function save($lyricist){
		$this->db->insert($this->lyricist, $lyricist);
		return $this->db->insert_id();
	}
	
	function update($id, $lyricist){
		$this->db->where('l_id', $id);
		$this->db->update($this->lyricist, $lyricist);
	}
	
	function delete($id){
		$this->db->where('l_id', $id);
		$this->db->delete($this->lyricist);
	}
}
?>