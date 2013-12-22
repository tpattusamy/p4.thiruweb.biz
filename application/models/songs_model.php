<?php
class songs_model extends CI_Model {
	
	private $songs= 'songs';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
        $this->db->select('songs.*,l_name,s_name');
        $this->db->join('singer','so_singer1 = s_id','left');
        $this->db->join('lyricist','so_lyrics = l_id','left');
        $this->db->order_by('so_id','asc');
		return $this->db->get($songs);
	}
	
	function count_all(){
		return $this->db->count_all($this->songs);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
        $this->db->select('songs.*,l_name,s_name');
        $this->db->join('singer','so_singer1 = s_id','left');
        $this->db->join('lyricist','so_lyrics = l_id','left');
        $this->db->order_by('so_id','asc');
		return $this->db->get($this->songs, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('so_id', $id);
		return $this->db->get($this->songs);
	}
	
	function save($songs){
		$this->db->insert($this->songs, $songs);
		return $this->db->insert_id();
	}
	
	function update($id, $songs){
		$this->db->where('so_id', $id);
		$this->db->update($this->songs, $songs);
	}
	
	function delete($id){
		$this->db->where('so_id', $id);
		$this->db->delete($this->songs);
	}
    public function get_singer_online_select() {
        $this->db->select('s_id, s_name'); //change this to the two main values you want to use
        $this->db->from('singer');
        //$this->db->where('category_online', 1);
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $data[$row['s_id']]=$row['s_name'];
        }
        return $data;
    }
    public function get_lyricist_online_select() {
        $this->db->select('l_id, l_name'); //change this to the two main values you want to use
        $this->db->from('lyricist');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $data[$row['l_id']]=$row['l_name'];
        }
        return $data;
    }
}
?>