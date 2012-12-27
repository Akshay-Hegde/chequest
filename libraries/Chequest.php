<?php

/**
 * Global Chequest Library
 * 
 * Record all user stored activities
 *
 * @version    v1.0
 * @author     Toni Haryanto
 * @license    MIT License
 * @copyright  2011 Toni Haryanto
 * @package    modules\chequest\libraries\Acivity
 */
 
class Chequest {

	/**
	 * Loads in the config and sets the variables
	 */
	public function __construct()
	{
		$this->ci = get_instance();
		$this->ci->load->model('chequest/context_m');
	}
	
	/**
	 * delete activity data
	 *
	 * only remove_contents role or the content owner can do this
	 * 
	 * @param integer $content_id
	 * @param string $content_type
	 *
	 */
	public function add_context($slug, $description = '', $order = 0, $parent_slug = false)
	{
		$data = array(
					'context_slug' => $slug,
					'description' => $description,
					'parent' => ($parent_slug)? $this->ci->context_m->get_parent($parent_slug)->id : 0,
					'order' => $order,
					'created'=>date("Y-m-d H:i:s"), 
					'created_by'=>$this->ci->current_user->id, 
					'ordering_count'=>0
				);
				
		$result = $this->ci->context_m->insert($data);
		
		return $result;
	}

	function set_context_menu()
	{
		$data['navs'] = $this->ci->context_m->get_context();

		// set partial menu
		$this->ci->template
				 ->set_partial('context', 'context_menu.php', $data);
	}

	function set_subcontext_menu($parent_slug = null, $subcontexts = array())
	{
		if(count($subcontexts)==0)
			$data['navs'] = $this->ci->context_m->get_subcontext($parent_slug);
		else
			$data['navs'] = $subcontexts;

		// set partial menu
		$this->ci->template
				 ->set_partial('subcontext', 'subcontext_menu.php', $data);
	}

}

/* End of file Activity.php */