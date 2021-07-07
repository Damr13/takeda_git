<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class MstShiftModel extends CI_Model{
  
  public function selectAll() {
		$sql = "SELECT * FROM mst_time_shift";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data){
        $this->db->insert('mst_time_shift',$data);
	}
	
	public function getId($id){
        return $this->db->get_where('mst_time_shift',array('codeShift' => $id))->result();
	}
	
	public function edit($id, $data){
        $this->db->update('mst_time_shift',$data, array('codeShift' => $id));
	}

	public function delete($id){
        $this->db->delete('mst_time_shift',array('codeShift' => $id));
    }
 
}