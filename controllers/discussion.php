<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Discussion extends Public_Controller {
	
	public function __construct()
    {
        parent::__construct();
		
		 // check if user has login
        if(!isset($this->current_user->id))
        	redirect('users/login');

		$this->load->model('chequest/discussion_m');
		$this->load->library('chequest');
		$this->lang->load('chequest');
		
		// Load css/js
		$this->template
			 ->append_css('module::chequest.css')
			 ->append_js('module::chequest.js')
			 ->append_js('module::holder.js')
			 ->set('context', 'discussion');
		
		$this->chequest->set_context_menu(); // Set context menu
		$this->chequest
			 ->set_subcontext_menu('discussion', 
			 	array(
			 		array('context_slug'=>'newest', 'description'=>'Newest Items', 'context_uri'=>null),
			 		array('context_slug'=>'mine', 'description'=>'Mine', 'context_uri'=>null)
				)); // Set subcontext menu
	}
	
	public function index($id = 1)
	{
		if(!$id) $id = $this->session->userdata('user_id');
		
	 	$newest_threads = $this->discussion_m->get_threads(6);
	 	$newest_topics = $this->discussion_m->get_topics(6);
	 	$newest_groups = $this->discussion_m->get_groups(6);

		$this->template->set('subcontext', 'newest')
					->set('threads', $newest_threads)
					->set('topics', $newest_topics)
					->set('groups', $newest_groups)
					->set_partial('content', 'discussion/index.php');
			 
		self::build();
	}
	
	function build($layout = 'layout'){
		$this->template->build($layout);
	}
    
}

