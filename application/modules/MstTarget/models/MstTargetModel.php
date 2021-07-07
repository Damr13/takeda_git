<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class MstTargetModel extends CI_Model{
  
  public function selectAll() {
		$sql = "SELECT * FROM mst_target";

		$data = $this->db->query($sql);

		return $data->result();
	}

  public function checkYear() {
		$sql = "SELECT MAX(year) as prevYear FROM mst_target";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function add($table,$data){
				$this->db->insert($table,$data);
	}

	public function update($table, $data, $id){
		$this->db->update($table,$data, array('id' => $id));
    return True;
	}
}