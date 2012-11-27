<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Chequest extends Module {
	
	public $version = '0.1';
	public $language_file = 'chequest/chequest';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function information()
	{

		$info = array(
			'name' => array(
				'en' => 'cheQuest'
			),
			'description' => array(
				'en' => 'Social Network for PyroCMS'
			),
			'frontend'	=> TRUE,
			'backend'	=> TRUE,
			'is_core'	=> TRUE,
			'menu'	   	=> 'cheQuest',
			'author'   	=> 'Toni Haryanto',
			'roles' => array(
				'view_contents', 'edit_contents', 'block_contents', 'remove_contents',
				'block_users', 'block_groups', 'view_stats', 'edit_settings'
			),
			'sections' => array(
				'dashboard' => array(
					'name'	=> 'chequest:sections:dashboard',
					'uri'	=> 'admin/chequest'
				)
			)
		);
		
		if (group_has_role('chequest', 'view_contents')) {
			$info['sections']['contents'] = array(
				'name'   => 'chequest:sections:contents',
				'uri' 	 => 'admin/chequest/contents'
			);
		}
		if (group_has_role('chequest', 'view_users')) {
			$info['sections']['users'] = array(
				'name' => 'chequest:sections:users',
				'uri'  => 'admin/chequest/users'
			);
		}
		if (group_has_role('chequest', 'view_groups')) {
			$info['sections']['groups'] = array(
				'name' => 'chequest:sections:groups',
				'uri'  => 'admin/chequest/groups'
			);
		}
		if (group_has_role('chequest', 'view_stats')) {
			$info['sections']['stats'] = array(
				'name' => 'chequest:sections:stats',
				'uri'  => 'admin/chequest/stats'
			);
		}
		if (group_has_role('chequest', 'edit_settings')) {
			$info['sections']['settings'] = array(
				'name' => 'chequest:sections:settings',
				'uri'  => 'admin/settings#chequest'
			);
		}
		
		return $info;
	}
	
	public function install()
	{
		
		// Load required items
		$this->load->driver('Streams');
		$this->load->language('chequest/chequest');
		$this->load->library('chequest/chequest');
		
		################
		##  CONTEXT  ##
		################
		
		// Create context stream
		if( !$this->streams->streams->add_stream('Context', 'context', 'cq_context', 'chequest_', NULL) ) return FALSE;
		
		// Get stream data
		$activity = $this->streams->streams->get_stream('context', 'cq_context');
	
		// Add fields
		$fields   = array();
		$template = array('namespace' => 'cq_context', 'assign' => 'context', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
		$fields[] = array('name' => 'Context Slug', 'slug' => 'context_slug', 'extra' => array('max_length' => 50));
		$fields[] = array('name' => 'Context Description', 'slug' => 'description', 'extra' => array('max_length' => 255));
		$fields[] = array('name' => 'Parent', 'slug' => 'parent', 'type'=>'integer', 'null'=>false, 'default'=>0);
		$fields[] = array('name' => 'Order', 'slug' => 'order', 'type'=>'integer', 'null'=>false, 'default'=>0);

		// Combine
		foreach( $fields AS $key => $field ) { $fields[$key] = array_merge($template, $field); }
	
		// Add fields to stream
		$this->streams->fields->add_fields($fields);

		################
		##  ACTIVITY  ##
		################
		
		// Create activity stream
		if( !$this->streams->streams->add_stream(lang('chequest:sections:activity'), 'activity', 'cq_activity', 'chequest_', NULL) ) return FALSE;
		
		// Get stream data
		$activity = $this->streams->streams->get_stream('activity', 'cq_activity');
	
		// Add fields
		$fields   = array();
		$template = array('namespace' => 'cq_activity', 'assign' => 'activity', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
		$fields[] = array('name' => 'lang:chequest:label_content_id', 'slug' => 'content_id', 'type' => 'integer');
		$fields[] = array('name' => 'lang:chequest:label_type', 'slug' => 'content_type', 'extra' => array('max_length' => 50));
		$fields[] = array('name' => 'lang:chequest:label_title', 'slug' => 'title', 'extra' => array('max_length' => 255));
		$fields[] = array('name' => 'lang:chequest:label_content', 'slug' => 'content', 'type' => 'textarea');
		$fields[] = array('name' => 'lang:chequest:label_uri', 'slug' => 'uri');

		// Combine
		foreach( $fields AS $key => $field ) { $fields[$key] = array_merge($template, $field); }
	
		// Add fields to stream
		$this->streams->fields->add_fields($fields);

		// add context entry for activity
		$this->chequest->add_context('activity', 'activity context', 0);

		// add subcontext entry for activity
		$this->chequest->add_context('all_activity', 'all activity feeds', 0, 'activity');

		################
		## Discussion ##
		################
		
		// add context entry for discussion
		$this->chequest->add_context('discussion', 'discussion context', 1);


		################
		##   FRIEND   ##
		################
		
		// Create friend stream
		if( !$this->streams->streams->add_stream(lang('chequest:sections:friend'), 'friend', 'cq_friend', 'chequest_', NULL) ) return FALSE;
		
		// Get stream data
		$friend = $this->streams->streams->get_stream('friend', 'cq_friend');
	
		// Add fields
		$fields   = array();
		$template = array('namespace' => 'cq_friend', 'assign' => 'friend', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
		$fields[] = array('name' => 'lang:chequest:label_friend_id', 'slug' => 'friend_id', 'type' => 'integer');
		$fields[] = array('name' => 'lang:chequest:label_approved', 'slug' => 'approved', 'type' => 'integer', 'extra' => array('default_value'=>1));

		// Combine
		foreach( $fields AS $key => $field ) { $fields[$key] = array_merge($template, $field); }
	
		// Add fields to stream
		$this->streams->fields->add_fields($fields);

		// add context entry for friend
		$this->chequest->add_context('friends', 'friends context', 2);

		################
		##   Profile  ##
		################
		
		

		################
		##  SETTINGS  ##
		################
		
		// Create user_setting stream
		if( !$this->streams->streams->add_stream(lang('chequest:sections:settings'), 'settings', 'cq_settings', 'chequest_', NULL) ) return FALSE;
		
		// Get stream data
		$user_setting = $this->streams->streams->get_stream('settings', 'cq_settings');
	
		// Add fields
		$fields   = array();
		$template = array('namespace' => 'cq_settings', 'assign' => 'settings', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
		$fields[] = array('name' => 'lang:chequest:label_setting_name', 'slug' => 'setting_name');
		$fields[] = array('name' => 'lang:chequest:label_setting_value', 'slug' => 'setting_value');
		$fields[] = array('name' => 'lang:chequest:label_is_required', 'slug' => 'is_required');
		// Combine
		foreach( $fields AS $key => $field ) { $fields[$key] = array_merge($template, $field); }
	
		// Add fields to stream
		$this->streams->fields->add_fields($fields);

		// add context entry for activity
		$this->chequest->add_context('settings', 'settings context', 99);
		
		return TRUE;
	}

	public function uninstall()
	{
	
		// Load required items
		$this->load->driver('Streams');
	
		// Remove settings
		// $this->settings('remove');

		// Remove email templates
		// $this->templates('remove');
		
		// Remove streams
		$this->streams->utilities->remove_namespace('cq_context');
		$this->streams->utilities->remove_namespace('cq_activity');
		$this->streams->utilities->remove_namespace('cq_friend');
		$this->streams->utilities->remove_namespace('cq_settings');
		
		// Return
		return TRUE;
	}

	public function upgrade($old_version)
	{

		// Add settings
		$this->settings('remove');
		$this->settings('add');

		return TRUE;
	}

	public function help()
	{

		return "Some Help Stuff";
	}
	
	public function settings($action)
	{
	
		// Variables
		$return     = TRUE;
		$settings   = array();
		
		// Tax
		$settings[] = array(
			'slug' 		  	=> 'chequest_tax',
			'title' 	  	=> 'Tax Percentage',
			'description' 	=> 'The percentage of tax to be applied to the products',
			'default'		=> '20',
			'value'			=> '20',
			'type' 			=> 'text',
			'options'		=> '',
			'is_required' 	=> 1,
			'is_gui'		=> 1,
			'module' 		=> 'chequest'
		);

		// Perform	
		if( $action == 'add' )
		{
			if( !$this->db->insert_batch('settings', $settings) )
			{
				$return = FALSE;
			}
		}
		elseif( $action == 'remove' )
		{
			// we do not delete all settings with module = chequest because
			// we don't want other chequest addon module settings deleted
			foreach ($settings as $setting)
			{
				if( !$this->db->delete('settings', array('slug' => $setting['slug'])) )
				{
					$return = FALSE;
				}
			}
		}
		
		return $return;	
	}

	public function templates($action)
	{

		$templates = array('order-complete-admin', 'order-complete-user');
		$sql = "INSERT INTO `" . SITE_REF . "_email_templates` (`slug`, `name`, `description`, `subject`, `body`, `lang`, `is_default`, `module`) VALUES
				('order-complete-admin', 'Order Complete (Admin)', 'Sent to the site admin once an order has been completed', '{{ settings:site_name }} :: An order has been complete', 'Email body', 'en', 0, ''),
				('order-complete-user', 'Order Complete (User)', 'Sent to the user once an order has been completed', '{{ settings:site_name }} :: Your Order Confirmation', 'Email body', 'en', 0, '');";

		if( $action == 'add' )
		{
			$this->db->query($sql);
		}
		else
		{
			$this->db->where_in('slug', $templates)->delete('email_templates');
		}

	}

	public function info()
	{
		return $this->information();
	}

}
