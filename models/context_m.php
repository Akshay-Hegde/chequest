<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Context_m extends MY_Model
{

	protected $_table = 'chequest_context';

	function __construct(){
		parent::__construct();
	}
	
	public function add($data){		
		return $this->insert($data);
	}

	public function get_context(){
		return $this->db
					->where('parent', 0)
					->order_by('order', 'asc')->get($this->_table)->result();
	}

	public function get_subcontext($parent_slug){
		$parent = $this->get_parent($parent_slug);

		if(isset($parent->id))
			return $this->db
						->where('parent', $parent->id)
						->order_by('order', 'asc')->get($this->_table)->result();

		return false;
	}

	public function get_parent($parent_slug){
		$data = $this->db->where('context_slug', $parent_slug)->get($this->_table)->row();
		if(count($data) == 0)
			$data->id = 0;

		return $data;
	}

	public function get_parent_id($parent_slug){
		$data = $this->get_parent($parent_slug);
		return $data->id;
	}
	
	public function delete_by($where){		
		$this->db->where($where)->delete($_table);
		return $this->db->affected_rows();
	}

}
