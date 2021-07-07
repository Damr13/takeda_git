<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class MstLineModel extends CI_Model{
  
  public function selectAll() {
		$sql = "SELECT * FROM mst_line";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data){
        $this->db->insert('mst_line',$data);
	}
	
	public function getId($id){
        return $this->db->get_where('mst_line',array('id' => $id))->result();
	}
	
	public function edit($id, $data){
        $this->db->update('mst_line',$data, array('id' => $id));
	}

	public function delete($id){
        $this->db->delete('mst_line',array('id' => $id));
    }
 
}