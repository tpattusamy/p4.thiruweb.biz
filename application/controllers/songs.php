<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class songs extends CI_Controller {

	// num of records per page
	private $limit = 10;

	
	function __construct()
	{
		parent::__construct();

        //echo "Inside songs controller";
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('songs_model','',TRUE);
	}
	
	function index($offset = 0)
	{
        $data['title'] = 'Songs Table';
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$songss = $this->songs_model->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('songs/index/');
 		$config['total_rows'] = $this->songs_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Song Title', 'Song Movie','Singer','Lyricist','Language','Operation');
		$i = 0 + $offset;
		foreach ($songss as $songs)
		{
			$this->table->add_row(++$i, $songs->so_title,$songs->so_movie,$songs->s_name,$songs->l_name,$songs->so_language,

				anchor('songs/view/'.$songs->so_id,'view',array('class'=>'view')).' '.
				anchor('songs/update/'.$songs->so_id,'update',array('class'=>'update')).' '.
				anchor('songs/delete/'.$songs->so_id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this songs?')"))
			);
		}
        $tmpl = array (
            'table_open'          => '<table border="0" cellpadding="4" cellspacing="0" id="list_table" class="list">');

        $this->table->set_template($tmpl);
        $data['table'] = $this->table->generate();
		
		// load view
        $this->load->view('header');
		$this->load->view('songsList', $data);
        $this->load->view('footer');
	}
	
	function add()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new songs';
		$data['message'] = '';
		$data['action'] = site_url('songs/addsongs');
		$data['link_back'] = anchor('songs/index/','Back to list of songss',array('class'=>'back'));
        $data['select_options_singer']=$this->songs_model->get_singer_online_select();
        $data['select_options_lyricist']=$this->songs_model->get_lyricist_online_select();

	
		// load view
        $this->load->view('header');
		$this->load->view('songsEdit', $data);
        $this->load->view('footer');
	}
	
	function addsongs()
	{
		// set common properties
		$data['title'] = 'Add new songs';
		$data['action'] = site_url('songs/addsongs');
		$data['link_back'] = anchor('songs/index/','Back to list of songss',array('class'=>'back'));
        $data['select_options_singer']=$this->songs_model->get_singer_online_select();
        $data['select_options_lyricist']=$this->songs_model->get_lyricist_online_select();
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();


		// run validation
		if ($this->form_validation->run() == FALSE)
		{

			$data['message'] = '';

		}
		else
		{

			// save data
			$songs = array('so_title' => $this->input->post('so_title'),
							'so_movie' => $this->input->post('so_movie'),
                            'so_singer1' => $this->input->post('so_singer1'),
                            'so_singer2' => $this->input->post('so_singer2'),
                            'so_lyrics' => $this->input->post('so_lyrics'),
                            'so_language' => $this->input->post('so_language')

            );

			$id = $this->songs_model->save($songs);
			
			// set user message
			$data['message'] = '<div class="success">add new songs success</div>';
		}
		
		// load view
        $this->load->view('header');
		$this->load->view('songsEdit', $data);
        $this->load->view('footer');
	}
	
	function view($id)
	{
		// set common properties
		$data['title'] = 'songs Details';
		$data['link_back'] = anchor('songs/index/','Back to list of songss',array('class'=>'back'));
		
		// get songs details
		$data['songs'] = $this->songs_model->get_by_id($id)->row();
        $data['select_options_singer']=$this->songs_model->get_singer_online_select();
        $data['select_options_lyricist']=$this->songs_model->get_lyricist_online_select();
		
		// load view
        $this->load->view('header');
		$this->load->view('songsView', $data);
        $this->load->view('footer');
	}
	
	function update($id)
	{
		// set validation properties
		$this->_set_rules();
		
		// prefill form values
		$songs = $this->songs_model->get_by_id($id)->row();

        $this->form_data = new stdClass();

		$this->form_data->so_id                 = $songs->so_id;
		$this->form_data->so_title              = $songs->so_title;
		$this->form_data->so_movie              = $songs->so_movie ;
        $this->form_data->so_singer1            = $songs->so_singer1;
        $this->form_data->so_singer2            = $songs->so_singer2 ;
        $this->form_data->so_lyrics           = $songs->so_lyrics ;
        $this->form_data->so_language           = $songs->so_language  ;


		
		// set common properties
		$data['title'] = 'Update songs';
		$data['message'] = '';
		$data['action'] = site_url('songs/updatesongs');
		$data['link_back'] = anchor('songs/index/','Back to list of songss',array('class'=>'back'));
        $data['select_options_singer']=$this->songs_model->get_singer_online_select();
        $data['select_options_lyricist']=$this->songs_model->get_lyricist_online_select();
	
		// load view
        $this->load->view('header');
		$this->load->view('songsEdit', $data);
        $this->load->view('footer');
	}
	
	function updatesongs()
	{
		// set common properties
		$data['title'] = 'Update songs';
		$data['action'] = site_url('songs/updatesongs');
		$data['link_back'] = anchor('songs/index/','Back to list of songss',array('class'=>'back'));
        $data['select_options_singer']=$this->songs_model->get_singer_online_select();
        $data['select_options_lyricist']=$this->songs_model->get_lyricist_online_select();


		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$id = $this->input->post('so_id');

			$songs = array(
                            'so_id'           =>      $this->input->post('so_id'),
                            'so_title'         =>      $this->input->post('so_title'),
                            'so_movie'        =>      $this->input->post('so_movie'),
                            'so_singer1'       =>      $this->input->post('so_singer1'),
                            'so_singer2'      =>      $this->input->post('so_singer2'),
                            'so_lyrics'      =>      $this->input->post('so_lyrics'),
                            'so_language'    =>      $this->input->post('so_language'),

            );

			$this->songs_model->update($id,$songs);
			
			// set user message
			$data['message'] = '<div class="success">update songs success</div>';
		}

		// load view
        $this->load->view('header');
		$this->load->view('songsEdit', $data);
        $this->load->view('footer');
	}
	
	function delete($id)
	{
		// delete songs
		$this->songs_model->delete($id);
		
		// redirect to songs list page
		redirect('songs/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
        $this->form_data = new stdClass();

        $this->form_data->so_id              = '';
        $this->form_data->so_title           = '';
        $this->form_data->so_movie           = '';
        $this->form_data->so_singer1         = '';
        $this->form_data->so_singer2         = '';
        $this->form_data->so_lyrics        = '';
        $this->form_data->so_language        = '';

	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('so_title', 'Title', 'required');
        $this->form_validation->set_rules('so_movie', 'Song Movie', '');
        $this->form_validation->set_rules('so_singer1', 'Singer 1', '');
        $this->form_validation->set_rules('so_singer2', 'Singer 2', '');
        $this->form_validation->set_rules('so_lyrics','Lyricist',' ');
        $this->form_validation->set_rules('so_language','Language','');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	// date_validation callback
	function valid_date($str)
	{
		//match the format of the date
		if (preg_match ("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/", $str, $parts))
		{
			//check weather the date is valid of not
			if(checkdate($parts[2],$parts[1],$parts[3]))
				return true;
			else
				return false;
		}
		else
			return false;
	}
}
?>