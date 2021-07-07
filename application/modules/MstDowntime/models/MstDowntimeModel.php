<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class MstDowntimeModel extends CI_Model{
  
  public function selectAll() {
		$sql = "SELECT * FROM mst_downtime";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data){
        $this->db->insert('mst_downtime',$data);
	}
	
	public function getId($id){
        return $this->db->get_where('mst_downtime',array('id' => $id))->result();
	}
	
	public function edit($id, $data){
        $this->db->update('mst_downtime',$data, array('id' => $id));
	}

	public function delete($id){
        $this->db->delete('mst_downtime',array('id' => $id));
    }
}