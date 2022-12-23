<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Default_model extends CI_Model {

	public function get_all($tableName, $where = array(),$order)
	{
		return $this->db->where($where)->order_by($order)->get($tableName)->result();
	}
	public function get($tableName, $where = array())
	{
		return $this->db->where($where)->get($tableName)->row();
	}
	public function join($join = array(), $select=""){
		$this->db->select($select);
		$this->db->from($join["from"]);
		$this->db->join($join["table"], $join["condition"]);
		return $this->db->where($join["column"],$join["value"])->get()->result();
	}


	public function insert($tableName, $data = array())
	{
		return $this->db->insert($tableName, $data);
	}
	public function delete($tableName, $where = array())
	{
		return $this->db->where($where)->delete($tableName);
	}
    public function count($tableName,$where = array())
    {
        return $this->db->where($where)->count_all_results($tableName);
    }
	
}
