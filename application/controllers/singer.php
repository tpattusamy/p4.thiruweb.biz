<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class singer extends CI_Controller {

	// num of records per page
	private $limit = 10;

	
	function __construct()
	{
		parent::__construct();

        //echo "Inside singer controller";
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('singer_model','',TRUE);
	}
	
	function index($offset = 0)
	{
        $data['title'] = 'Singers Table';
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$singers = $this->singer_model->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('singer/index/');
 		$config['total_rows'] = $this->singer_model->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Name', 'Date of Birth (dd-mm-yyyy)','Place of Birth', 'first_song','Operation');
		$i = 0 + $offset;
		foreach ($singers as $singer)
		{
			$this->table->add_row(++$i, $singer->s_name, date('d-m-Y',strtotime($singer->s_date_of_birth)),$singer->s_place_of_birth,$singer->s_first_song,
				anchor('singer/view/'.$singer->s_id,'view',array('class'=>'view')).' '.
				anchor('singer/update/'.$singer->s_id,'update',array('class'=>'update')).' '.
				anchor('singer/delete/'.$singer->s_id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this singer?')"))
			);
		}
        $tmpl = array (
            'table_open'          => '<table border="0" cellpadding="4" cellspacing="0" id="list_table" class="list">');

        $this->table->set_template($tmpl);
        $data['table'] = $this->table->generate();
		
		// load view
        $this->load->view('header');
		$this->load->view('singerList', $data);
        $this->load->view('footer');
	}
	
	function add()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new singer';
		$data['message'] = '';
		$data['action'] = site_url('singer/addsinger');
		$data['link_back'] = anchor('singer/index/','Back to list of singers',array('class'=>'back'));
	
		// load view
        $this->load->view('header');
		$this->load->view('singerEdit', $data);
        $this->load->view('footer');
	}
	
	function addsinger()
	{
		// set common properties
		$data['title'] = 'Add new singer';
		$data['action'] = site_url('singer/addsinger');
		$data['link_back'] = anchor('singer/index/','Back to list of singers',array('class'=>'back'));
		
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
			$singer = array('s_name' => $this->input->post('s_name'),
							's_date_of_birth' => date('Y-m-d', strtotime($this->input->post('s_date_of_birth'))),
                            's_place_of_birth' => $this->input->post('s_place_of_birth'),
                            's_first_song' => $this->input->post('s_first_song'),
                            's_language' => $this->input->post('s_language'),

            );
			$id = $this->singer_model->save($singer);
			
			// set user message
			$data['message'] = '<div class="success">add new singer success</div>';
		}
		
		// load view
        $this->load->view('header');
		$this->load->view('singerEdit', $data);
        $this->load->view('footer');
	}
	
	function view($id)
	{
		// set common properties
		$data['title'] = 'singer Details';
		$data['link_back'] = anchor('singer/index/','Back to list of singers',array('class'=>'back'));
		
		// get singer details
		$data['singer'] = $this->singer_model->get_by_id($id)->row();
		
		// load view
        $this->load->view('header');
		$this->load->view('singerView', $data);
        $this->load->view('footer');
	}
	
	function update($id)
	{
		// set validation properties
		$this->_set_rules();
		
		// prefill form values
		$singer = $this->singer_model->get_by_id($id)->row();

        $this->form_data = new stdClass();
		$this->form_data->s_id = $singer->s_id;
		$this->form_data->s_name = $singer->s_name;
		$this->form_data->s_date_of_birth = date('d-m-Y',strtotime($singer->s_date_of_birth));
        $this->form_data->s_place_of_birth = $singer->s_place_of_birth;
        $this->form_data->s_first_song = $singer->s_first_song;
		
		// set common properties
		$data['title'] = 'Update singer';
		$data['message'] = '';
		$data['action'] = site_url('singer/updatesinger');
		$data['link_back'] = anchor('singer/index/','Back to list of singers',array('class'=>'back'));
	
		// load view
        $this->load->view('header');
		$this->load->view('singerEdit', $data);
        $this->load->view('footer');
	}
	
	function updatesinger()
	{
		// set common properties
		$data['title'] = 'Update singer';
		$data['action'] = site_url('singer/updatesinger');
		$data['link_back'] = anchor('singer/index/','Back to list of singers',array('class'=>'back'));
		
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
			$id = $this->input->post('s_id');
			$singer = array('s_name' => $this->input->post('s_name'),
							's_date_of_birth' => date('Y-m-d', strtotime($this->input->post('s_date_of_birth'))),
                           's_place_of_birth' => $this->input->post('s_place_of_birth'),
                            's_first_song' => $this->input->post('s_first_song')

            );
			$this->singer_model->update($id,$singer);
			
			// set user message
			$data['message'] = '<div class="success">update singer success</div>';
		}
		
		// load view
        $this->load->view('header');
		$this->load->view('singerEdit', $data);
        $this->load->view('footer');
	}
	
	function delete($id)
	{
		// delete singer
		$this->singer_model->delete($id);
		
		// redirect to singer list page
		redirect('singer/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
        $this->form_data = new stdClass();

		$this->form_data->s_id = '';
		$this->form_data->s_name = '';
		$this->form_data->s_date_of_birth = '';
		$this->form_data->s_place_of_birth = '';
        $this->form_data->s_first_song = '';
        $this->form_data->s_language='';
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('s_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('s_date_of_birth', 'Date of birth (dd-mm-yyyy)', '');
        $this->form_validation->set_rules('s_place_of_birth', 'Place of Birth', '');
        $this->form_validation->set_rules('s_first_song', 'First Movie', '');

		
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