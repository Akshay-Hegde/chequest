<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity_m extends MY_Model
{

	protected $_table = 'chequest_activity';

	function __construct(){
		parent::__construct();
	}
	
	public function get_many($id){
		return $this->db->select('a.*, p.display_name')
						->from($this->_table. ' a')
						->join('profiles p', 'a.created_by = p.id')
						->where('a.created_by', $id)
						->get()->result();
	}

	public function get_many_by($where){
		return $this->db->select('a.*, u.username, p.display_name')
						->from($this->_table. ' a')
						->join('profiles p', 'a.created_by = p.id')
						->join('users u', 'a.created_by = u.id')
						->where($where)
						->get()->result();
	}
	
	public function add($data){		
		return $this->insert($data);
	}
	
	public function delete_by($where){		
		$this->db->where($where)->delete($_table);
		return $this->db->affected_rows();
	}

}
