<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class MstDeptModel extends CI_Model{
  
  public function selectAll() {
		$sql = "SELECT  a.id, a.DeptCode, a.DeptName, a.DeptCategory,b.CatName as Category From mstDept a,mst_category b where a.DeptCategory=b.CatId";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data){
        $this->db->insert('mstDept',$data);
	}
	
	public function getId($id){
        return $this->db->get_where('mstDept',array('id' => $id))->result();
	}
	
	public function edit($id, $data){
        $this->db->update('mstDept',$data, array('id' => $id));
	}

	public function delete($id){
        $this->db->delete('mstDept',array('id' => $id));
    }
 
}