<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lyricist extends CI_Controller {

	// num of records per page
	private $limit = 10;

	
	function __construct()
	{
		parent::__construct();

        //echo "Inside lyricist controller";
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('lyricist_model','',TRUE);
	}
	
	function index($offset = 0)
	{
        $data['title'] = 'Lyricist Table';
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$lyricists = $this->lyricist_model->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('lyricist/index/');
 		$config['total_rows'] = $this->lyricist_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Name', 'Date of Birth (dd-mm-yyyy)','Place of Birth', 'first_song','Operation');
		$i = 0 + $offset;
		foreach ($lyricists as $lyricist)
		{
			$this->table->add_row(++$i, $lyricist->l_name, date('d-m-Y',strtotime($lyricist->l_date_of_birth)),$lyricist->l_place_of_birth,$lyricist->l_first_song,
				anchor('lyricist/view/'.$lyricist->l_id,'view',array('class'=>'view')).' '.
				anchor('lyricist/update/'.$lyricist->l_id,'update',array('class'=>'update')).' '.
				anchor('lyricist/delete/'.$lyricist->l_id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this lyricist?')"))
			);
		}
        $tmpl = array (
            'table_open'          => '<table border="0" cellpadding="4" cellspacing="0" id="list_table" class="list">');

        $this->table->set_template($tmpl);
        $data['table'] = $this->table->generate();
		
		// load view
        $this->load->view('header');
		$this->load->view('lyricistList', $data);
        $this->load->view('footer');
	}
	
	function add()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new lyricist';
		$data['message'] = '';
		$data['action'] = site_url('lyricist/addlyricist');
		$data['link_back'] = anchor('lyricist/index/','Back to list of lyricists',array('class'=>'back'));
	
		// load view
        $this->load->view('header');
		$this->load->view('lyricistEdit', $data);
        $this->load->view('footer');
	}
	
	function addlyricist()
	{
		// set common properties
		$data['title'] = 'Add new lyricist';
		$data['action'] = site_url('lyricist/addlyricist');
		$data['link_back'] = anchor('lyricist/index/','Back to list of lyricists',array('class'=>'back'));
		
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
			$lyricist = array('l_name' => $this->input->post('l_name'),
							'l_date_of_birth' => date('Y-m-d', strtotime($this->input->post('l_date_of_birth'))),
                            'l_place_of_birth' => $this->input->post('l_place_of_birth'),
                            'l_first_song' => $this->input->post('l_first_song'),
                            'l_language' => $this->input->post('l_language'),

            );
			$id = $this->lyricist_model->save($lyricist);
			
			// set user message
			$data['message'] = '<div class="success">add new lyricist success</div>';
		}
		
		// load view
        $this->load->view('header');
		$this->load->view('lyricistEdit', $data);
        $this->load->view('footer');
	}
	
	function view($id)
	{
		// set common properties
		$data['title'] = 'Lyricist Details';
		$data['link_back'] = anchor('lyricist/index/','Back to list of lyricists',array('class'=>'back'));
		
		// get lyricist details
		$data['lyricist'] = $this->lyricist_model->get_by_id($id)->row();
		
		// load view
        $this->load->view('header');
		$this->load->view('lyricistView', $data);
        $this->load->view('footer');
	}
	
	function update($id)
	{
		// set validation properties
		$this->_set_rules();
		
		// prefill form values
		$lyricist = $this->lyricist_model->get_by_id($id)->row();

        $this->form_data = new stdClass();
		$this->form_data->l_id = $lyricist->l_id;
		$this->form_data->l_name = $lyricist->l_name;
		$this->form_data->l_date_of_birth = date('d-m-Y',strtotime($lyricist->l_date_of_birth));
        $this->form_data->l_place_of_birth = $lyricist->l_place_of_birth;
        $this->form_data->l_first_song = $lyricist->l_first_song;
		
		// set common properties
		$data['title'] = 'Update lyricist';
		$data['message'] = '';
		$data['action'] = site_url('lyricist/updatelyricist');
		$data['link_back'] = anchor('lyricist/index/','Back to list of lyricists',array('class'=>'back'));
	
		// load view
        $this->load->view('header');
		$this->load->view('lyricistEdit', $data);
        $this->load->view('footer');
	}
	
	function updatelyricist()
	{
		// set common properties
		$data['title'] = 'Update lyricist';
		$data['action'] = site_url('lyricist/updatelyricist');
		$data['link_back'] = anchor('lyricist/index/','Back to list of lyricists',array('class'=>'back'));
		
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
			$id = $this->input->post('l_id');
			$lyricist = array('l_name' => $this->input->post('l_name'),
							'l_date_of_birth' => date('Y-m-d', strtotime($this->input->post('l_date_of_birth'))),
                           'l_place_of_birth' => $this->input->post('l_place_of_birth'),
                            'l_first_song' => $this->input->post('l_first_song')

            );
			$this->lyricist_model->update($id,$lyricist);
			
			// set user message
			$data['message'] = '<div class="success">update lyricist success</div>';
		}
		
		// load view
        $this->load->view('header');
		$this->load->view('lyricistEdit', $data);
        $this->load->view('footer');
	}
	
	function delete($id)
	{
		// delete lyricist
		$this->lyricist_model->delete($id);
		
		// redirect to lyricist list page
		redirect('lyricist/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
        $this->form_data = new stdClass();

		$this->form_data->l_id = '';
		$this->form_data->l_name = '';
		$this->form_data->l_date_of_birth = '';
		$this->form_data->l_place_of_birth = '';
        $this->form_data->l_first_song = '';
        $this->form_data->l_language='';
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('l_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('l_date_of_birth', 'Date of birth (dd-mm-yyyy)', '');
        $this->form_validation->set_rules('l_place_of_birth', 'Place of Birth', '');
        $this->form_validation->set_rules('l_first_song', 'First Movie', '');

		
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