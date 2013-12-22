<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class actor extends CI_Controller {

	// num of records per page
	private $limit = 10;

	
	function __construct()
	{
		parent::__construct();

        //echo "Inside actor controller";
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('actor_model','',TRUE);
	}
	
	function index($offset = 0)
	{
        $data['title'] = 'Actor Table';
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$actors = $this->actor_model->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('actor/index/');
 		$config['total_rows'] = $this->actor_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Name', 'Date of Birth (dd-mm-yyyy)','Place of Birth', 'First_movie','Operation');
		$i = 0 + $offset;
		foreach ($actors as $actor)
		{
			$this->table->add_row(++$i, $actor->a_name, date('d-m-Y',strtotime($actor->a_date_of_birth)),$actor->a_place_of_birth,$actor->a_first_movie,
				anchor('actor/view/'.$actor->a_id,'view',array('class'=>'view')).' '.
				anchor('actor/update/'.$actor->a_id,'update',array('class'=>'update')).' '.
				anchor('actor/delete/'.$actor->a_id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this actor?')"))
			);
		}
        $tmpl = array (
            'table_open'          => '<table border="0" cellpadding="4" cellspacing="0" id="list_table" class="list">');

        $this->table->set_template($tmpl);
        $data['table'] = $this->table->generate();
		
		// load view
        $this->load->view('header');
		$this->load->view('actorList', $data);
        $this->load->view('footer');
	}
	
	function add()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new actor';
		$data['message'] = '';
		$data['action'] = site_url('actor/addactor');
		$data['link_back'] = anchor('actor/index/','Back to list of actors',array('class'=>'back'));
	
		// load view
        $this->load->view('header');
		$this->load->view('actorEdit', $data);
        $this->load->view('footer');
	}
	
	function addactor()
	{
		// set common properties
		$data['title'] = 'Add new actor';
		$data['action'] = site_url('actor/addactor');
		$data['link_back'] = anchor('actor/index/','Back to list of actors',array('class'=>'back'));
		
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
			$actor = array('a_name' => $this->input->post('a_name'),
							'a_date_of_birth' => date('Y-m-d', strtotime($this->input->post('a_date_of_birth'))),
                            'a_place_of_birth' => $this->input->post('a_place_of_birth'),
                            'a_first_movie' => $this->input->post('a_first_movie'),
                            'a_language' => $this->input->post('a_language'),

            );
			$id = $this->actor_model->save($actor);
			
			// set user message
			$data['message'] = '<div class="success">add new actor success</div>';
		}
		
		// load view
        $this->load->view('header');
		$this->load->view('actorEdit', $data);
        $this->load->view('footer');
	}
	
	function view($id)
	{
		// set common properties
		$data['title'] = 'Actor Details';
		$data['link_back'] = anchor('actor/index/','Back to list of actors',array('class'=>'back'));
		
		// get actor details
		$data['actor'] = $this->actor_model->get_by_id($id)->row();
		
		// load view
        $this->load->view('header');
		$this->load->view('actorView', $data);
        $this->load->view('footer');
	}
	
	function update($id)
	{
		// set validation properties
		$this->_set_rules();
		
		// prefill form values
		$actor = $this->actor_model->get_by_id($id)->row();

        $this->form_data = new stdClass();
		$this->form_data->a_id = $actor->a_id;
		$this->form_data->a_name = $actor->a_name;
		$this->form_data->a_date_of_birth = date('d-m-Y',strtotime($actor->a_date_of_birth));
        $this->form_data->a_place_of_birth = $actor->a_place_of_birth;
        $this->form_data->a_first_movie = $actor->a_first_movie;
		
		// set common properties
		$data['title'] = 'Update actor';
		$data['message'] = '';
		$data['action'] = site_url('actor/updateactor');
		$data['link_back'] = anchor('actor/index/','Back to list of actors',array('class'=>'back'));
	
		// load view
        $this->load->view('header');
		$this->load->view('actorEdit', $data);
        $this->load->view('footer');
	}
	
	function updateactor()
	{
		// set common properties
		$data['title'] = 'Update actor';
		$data['action'] = site_url('actor/updateactor');
		$data['link_back'] = anchor('actor/index/','Back to list of actors',array('class'=>'back'));
		
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
			$id = $this->input->post('a_id');
			$actor = array('a_name' => $this->input->post('a_name'),
							'a_date_of_birth' => date('Y-m-d', strtotime($this->input->post('a_date_of_birth'))),
                           'a_place_of_birth' => $this->input->post('a_place_of_birth'),
                            'a_first_movie' => $this->input->post('a_first_movie')

            );
			$this->actor_model->update($id,$actor);
			
			// set user message
			$data['message'] = '<div class="success">update actor success</div>';
		}
		
		// load view
        $this->load->view('header');
		$this->load->view('actorEdit', $data);
        $this->load->view('footer');
	}
	
	function delete($id)
	{
		// delete actor
		$this->actor_model->delete($id);
		
		// redirect to actor list page
		redirect('actor/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
        $this->form_data = new stdClass();

		$this->form_data->a_id = '';
		$this->form_data->a_name = '';
		$this->form_data->a_date_of_birth = '';
		$this->form_data->a_place_of_birth = '';
        $this->form_data->a_first_movie = '';
        $this->form_data->a_language='';
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('a_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('a_date_of_birth', 'Date of birth (dd-mm-yyyy)', '');
        $this->form_validation->set_rules('a_place_of_birth', 'Place of Birth', '');
        $this->form_validation->set_rules('a_first_movie', 'First Movie', '');

		
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