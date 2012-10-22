<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Front_activity extends Public_Controller {
	
	public function __construct()
    {
        parent::__construct();
		
		// Load libraries
		$this->load->driver('Streams');
		$this->lang->load('chequest');
		$this->load->model('activity_m');
		$this->load->model('products_m');
		$this->load->model('streams_core/row_m');
		$this->load->library('files/files');

		// Load css/js
		$this->template->append_css('module::chequest.css')
					   ->append_js('module::chequest.js');
	}
	
	public function index($id = null)
	{
		if(!$id) $id = $this->session->userdata('user_id');
		elseif(! is_int($id)) $activities = $this->activity_m->get_many_by(array('username'=>$id));
	 		else $activities = $this->activity_m->get_many($id);

		// Build Page
		$this->template->set_breadcrumb($this->data->product['title'], '/product/' . $this->data->product['slug'])
					   ->title($this->data->product['title'])
					   ->set($this->data);

		// Build page
		$this->template->build('product');
	}
    
}

