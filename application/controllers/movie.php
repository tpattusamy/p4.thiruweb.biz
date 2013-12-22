<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class movie extends CI_Controller {

	// num of records per page
	private $limit = 10;

	
	function __construct()
	{
		parent::__construct();

        //echo "Inside movie controller";
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('movie_model','',TRUE);
	}
	
	function index($offset = 0)
	{
        $data['title'] = 'Movie Table';
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$movies = $this->movie_model->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('movie/index/');
 		$config['total_rows'] = $this->movie_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Title', 'Director','Actor','Music Director','Release Year','Operation');
		$i = 0 + $offset;
		foreach ($movies as $movie)
		{
			$this->table->add_row(++$i, $movie->mv_title,$movie->d_name,$movie->a_name,$movie->m_name,$movie->mv_release_year,

				anchor('movie/view/'.$movie->mv_id,'view',array('class'=>'view')).' '.
				anchor('movie/update/'.$movie->mv_id,'update',array('class'=>'update')).' '.
				anchor('movie/delete/'.$movie->mv_id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this movie?')"))
			);
		}
        $tmpl = array (
            'table_open'          => '<table border="0" cellpadding="4" cellspacing="0" id="list_table" class="list">');

        $this->table->set_template($tmpl);
        $data['table'] = $this->table->generate();
		
		// load view
        $this->load->view('header');
		$this->load->view('movieList', $data);
        $this->load->view('footer');
	}
	
	function add()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new movie';
		$data['message'] = '';
		$data['action'] = site_url('movie/addmovie');
		$data['link_back'] = anchor('movie/index/','Back to list of movies',array('class'=>'back'));
        $data['select_options_actor']=$this->movie_model->get_actor_online_select();
        $data['select_options_director']=$this->movie_model->get_director_online_select();
        $data['select_options_music_director']=$this->movie_model->get_music_director_online_select();
	
		// load view
        $this->load->view('header');
		$this->load->view('movieEdit', $data);
        $this->load->view('footer');
	}
	
	function addmovie()
	{
		// set common properties
		$data['title'] = 'Add new movie';
		$data['action'] = site_url('movie/addmovie');
		$data['link_back'] = anchor('movie/index/','Back to list of movies',array('class'=>'back'));
        $data['select_options_actor']=$this->movie_model->get_actor_online_select();
        $data['select_options_director']=$this->movie_model->get_director_online_select();
        $data['select_options_music_director']=$this->movie_model->get_music_director_online_select();
		
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
			$movie = array('mv_title' => $this->input->post('mv_title'),
							'mv_actor' => $this->input->post('mv_actor'),
                            'mv_director' => $this->input->post('mv_director'),
                            'mv_music_director' => $this->input->post('mv_music_director'),
                            'mv_cinematographer' => $this->input->post('mv_cinematographer'),
                            'mv_editor' => $this->input->post('mv_editor'),
                            'mv_producer' => $this->input->post('mv_producer'),
                            'mv_release_year' => $this->input->post('mv_release_year'),
                            'mv_language' => $this->input->post('mv_language'),

            );

			$id = $this->movie_model->save($movie);
			
			// set user message
			$data['message'] = '<div class="success">add new movie success</div>';
		}
		
		// load view
        $this->load->view('header');
		$this->load->view('movieEdit', $data);
        $this->load->view('footer');
	}
	
	function view($id)
	{
		// set common properties
        $data['title'] = 'Movie Table';
		$data['link_back'] = anchor('movie/index/','Back to list of movies',array('class'=>'back'));
		
		// get movie details
		$data['movie'] = $this->movie_model->get_by_id($id)->row();
        $data['select_options_actor']=$this->movie_model->get_actor_online_select();
        $data['select_options_director']=$this->movie_model->get_director_online_select();
        $data['select_options_music_director']=$this->movie_model->get_music_director_online_select();
		
		// load view
        $this->load->view('header');
		$this->load->view('movieView', $data);
        $this->load->view('footer');
	}
	
	function update($id)
	{
		// set validation properties
		$this->_set_rules();
		
		// prefill form values
		$movie = $this->movie_model->get_by_id($id)->row();

        $this->form_data = new stdClass();

		$this->form_data->mv_id                 = $movie->mv_id;
		$this->form_data->mv_title              = $movie->mv_title;
		$this->form_data->mv_director           = $movie->mv_director;
        $this->form_data->mv_actor              = $movie->mv_actor;
        $this->form_data->mv_music_director     = $movie->mv_music_director;
        $this->form_data->mv_producer           = $movie->mv_producer;
        $this->form_data->mv_cinematographer    = $movie->mv_cinematographer;
        $this->form_data->mv_editor             = $movie->mv_editor;
        $this->form_data->mv_release_year       = $movie->mv_release_year;
        $this->form_data->mv_language           = $movie->mv_language;

		
		// set common properties
		$data['title'] = 'Update movie';
		$data['message'] = '';
		$data['action'] = site_url('movie/updatemovie');
		$data['link_back'] = anchor('movie/index/','Back to list of movies',array('class'=>'back'));
        $data['select_options_actor']=$this->movie_model->get_actor_online_select();
        $data['select_options_director']=$this->movie_model->get_director_online_select();
        $data['select_options_music_director']=$this->movie_model->get_music_director_online_select();
	
		// load view
        $this->load->view('header');
		$this->load->view('movieEdit', $data);
        $this->load->view('footer');
	}
	
	function updatemovie()
	{
		// set common properties
		$data['title'] = 'Update movie';
		$data['action'] = site_url('movie/updatemovie');
		$data['link_back'] = anchor('movie/index/','Back to list of movies',array('class'=>'back'));
        $data['select_options_actor']=$this->movie_model->get_actor_online_select();
        $data['select_options_director']=$this->movie_model->get_director_online_select();
        $data['select_options_music_director']=$this->movie_model->get_music_director_online_select();


		
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
			$id = $this->input->post('mv_id');

			$movie = array(
                            'mv_id'                 =>      $this->input->post('mv_id'),
                            'mv_title'              =>      $this->input->post('mv_title'),
                            'mv_director'           =>      $this->input->post('mv_director'),
                            'mv_actor'              =>      $this->input->post('mv_actor'),
                            'mv_music_director'     =>      $this->input->post('mv_music_director'),
                            'mv_producer'           =>      $this->input->post('mv_producer'),
                            'mv_cinematographer'    =>      $this->input->post('mv_cinematographer'),
                            'mv_editor'             =>      $this->input->post('mv_editor'),
                            'mv_release_year'       =>      $this->input->post('mv_release_year'),
                            'mv_language'           =>      $this->input->post('mv_language')
            );

			$this->movie_model->update($id,$movie);
			
			// set user message
			$data['message'] = '<div class="success">update movie success</div>';
		}

		// load view
        $this->load->view('header');
		$this->load->view('movieEdit', $data);
        $this->load->view('footer');
	}
	
	function delete($id)
	{

		// delete movie
		$this->movie_model->delete($id);
		
		// redirect to movie list page
		redirect('movie/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
        $this->form_data = new stdClass();

        $this->form_data->mv_id                     = '';
        $this->form_data->mv_title                  = '';
        $this->form_data->mv_director               = '';
        $this->form_data->mv_actor                  = '';
        $this->form_data->mv_music_director         = '';
        $this->form_data->mv_producer               = '';
        $this->form_data->mv_cinematographer        = '';
        $this->form_data->mv_editor                 = '';
        $this->form_data->mv_release_year           = '';
        $this->form_data->mv_language               = '';
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('mv_title', 'Title', '');
        $this->form_validation->set_rules('mv_director', 'Director', '');
        $this->form_validation->set_rules('mv_actor', 'Actor', '');
        $this->form_validation->set_rules('mv_music_director', 'Music Director', '');
        $this->form_validation->set_rules('mv_producer','Producer',' ');
        $this->form_validation->set_rules('mv_cinematographer','Cinematographer','');
        $this->form_validation->set_rules('mv_editor','Editor','');
        $this->form_validation->set_rules('mv_release_year','Release year','');
        $this->form_validation->set_rules('mv_language','Language','');
		
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