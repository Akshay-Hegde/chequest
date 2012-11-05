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
	
	public function delete_by($where){		
		$this->db->where($where)->delete($_table);
		return $this->db->affected_rows();
	}

}
