<?php

/**
 * Friends Library
 * 
 * Record all user stored activities
 *
 * @version    v1.0
 * @author     Toni Haryanto
 * @license    MIT License
 * @copyright  2011 Toni Haryanto
 * @package    modules\chequest\libraries\Acivity
 */
 
class Friend {

	/**
	 * Loads in the config and sets the variables
	 */
	public function __construct()
	{
		$this->ci = get_instance();
		$this->ci->load->model('chequest/friends_m');
	}

	/**
	 * insert activity data
	 *
	 * @param string $data = array(
	 *	'user_id' => $user_id,	// user id who done activity
	 *	'content_id' => $content_id,	// id to detailed content
	 *	'content_type' => $content_type,	// type or activity
	 *	'title' => $title,	// title of activity
	 *	'content' => $content, //must be associative array, will be serialized
	 *	'uri' => $uri	// uri to detail content, ex: blog/2012/10/example-post
	 * );
	 */
	public static function add_activity($data = array())
	{
		$activity = array(
			'created_by' => $data['user_id'],
			'content_id' => $data['content_id'],
			'content_type' => $data['content_type'],
			'title' => $data['title'],
			'content' => json_encode($data['content']),
			'uri' => $data['uri']
		);
		$result = $this->ci->activity_m->add($activity);
		// delete cache first here!
		return $result;
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
	public static function delete_activity($content_id, $content_type)
	{
		$where = array(
					'content_id' => $content_id,
					'content_type' => $content_type
				);
		$result = $this->ci->activity_m->delete_by($where);
		// delete cache first here!
		return $result;
	}
}

/* End of file Activity.php */