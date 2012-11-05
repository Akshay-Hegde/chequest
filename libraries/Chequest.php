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
	public static function add_context($slug, $description = '')
	{
		$this->ci->load->model('chequest/context_m');
		
		$data = array(
					'slug' => $slug,
					'description' => $description
				);
				
		$result = $this->ci->context_m->insert($data);
		
		return $result;
	}
}

/* End of file Activity.php */