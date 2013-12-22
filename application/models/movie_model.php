<?php
class movie_model extends CI_Model {
	
	private $movie= 'movie';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
        $this->db->select('movie.*,a_name,m_name,d_name');
        $this->db->from('movie');
        $this->db->join('actor','mv_actor = a_id','left');
        $this->db->join('director','mv_director = d_id','left');
        $this->db->join('music_director','mv_music_director = m_id','left');
        $this->db->order_by('mv_id','asc');
		return $this->db->get($movie);
	}
	
	function count_all(){
		return $this->db->count_all($this->movie);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
        $this->db->select('movie.*,a_name,m_name,d_name');
        //$this->db->from('movie');
        $this->db->join('actor','mv_actor = a_id','left');
        $this->db->join('director','mv_director = d_id','left');
        $this->db->join('music_director','mv_music_director = m_id','left');
        $this->db->order_by('mv_id','asc');
		return $this->db->get($this->movie, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('mv_id', $id);
		return $this->db->get($this->movie);
	}
	
	function save($movie){
		$this->db->insert($this->movie, $movie);
		return $this->db->insert_id();
	}
	
	function update($id, $movie){
		$this->db->where('mv_id', $id);
		$this->db->update($this->movie, $movie);
	}
	
	function delete($id){
		$this->db->where('mv_id', $id);
		$this->db->delete($this->movie);
	}
    public function get_actor_online_select() {
        $this->db->select('a_id, a_name'); //change this to the two main values you want to use
        $this->db->from('actor');
        //$this->db->where('category_online', 1);
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $data[$row['a_id']]=$row['a_name'];
        }
        return $data;
    }
    public function get_director_online_select() {
        $this->db->select('d_id, d_name'); //change this to the two main values you want to use
        $this->db->from('director');
        //$this->db->where('category_online', 1);
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $data[$row['d_id']]=$row['d_name'];
        }
        return $data;
    }
    public function get_music_director_online_select() {
        $this->db->select('m_id, m_name'); //change this to the two main values you want to use
        $this->db->from('music_director');
        //$this->db->where('category_online', 1);
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $data[$row['m_id']]=$row['m_name'];
        }
        return $data;
    }
}
?>