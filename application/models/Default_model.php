<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Default_model extends CI_Model {
//modellerin sonunda her zaman _model yazılmalıdır


	public function get_all($tableName, $where = array(),$order)//orders ORDER BY sıralamasıdır
	{
		return $this->db->where($where)->order_by($order)->get($tableName)->result();//Çoklu veri çekmek için row kullanılır
	}


	public function get($tableName, $where = array())
	{
		return $this->db->where($where)->get($tableName)->row();//tek veri çekmek için row kullanılır
	}


	public function insert($tableName, $data = array())//veri tabanına veri eklememizi sağlar
	{
		return $this->db->insert($tableName, $data);
	}


	//update modeli
	public function update($tableName, $where = array(), $data = array() )//birden fazla where koşulu olabilir $data= neyi değiştirecez
	{
		return $this->db->where($where)->update($tableName, $data);
	}
	
	public function delete($tableName, $where = array())//Silme işlemi içindir
	{
		return $this->db->where($where)->delete($tableName);
	}
}
