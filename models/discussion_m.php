<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discussion_m extends MY_Model
{

	protected $_group_table = 'chequest_discussion_group';
	protected $_topic_table = 'chequest_discussion_topic';
	protected $_post_table = 'chequest_discussion_post';
	protected $_moderator_table = 'chequest_discussion_moderator';

	function __construct(){
		parent::__construct();
	}
	
	public function get_groups($limit = 10){
		return $this->db->from($this->_group_table)
						->where('status', 1)
						->limit($limit)
						->get()->result();
	}
	public function get_topics($limit = 10){
		return $this->db->from($this->_topic_table .' t')
						->join($this->_group_table .' g', 'g.id = t.group_id')
						->where('t.status', 1)
						->limit($limit)
						->order_by('t.updated','desc')
						->get()->result();
	}
	public function get_threads($limit = 10){
		return $this->db->from($this->_post_table)
						->where('status', 1)
						->limit($limit)
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
