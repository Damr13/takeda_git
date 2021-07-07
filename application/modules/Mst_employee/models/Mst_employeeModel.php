<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Mst_employeeModel extends CI_Model{
    
    public function selectAll() {
         $sql = "SELECT a.*, b.DeptName 
                  FROM mstEmployee a
                  LEFT JOIN mstDept b ON a.idDept = b.id ";
    
         $data = $this->db->query($sql);
    
        return $data->result();
       }
    

      public function getDept() {
        $sql = "SELECT * FROM mstDept";
    
        $data = $this->db->query($sql);
    
        return $data->result();
      }

      public function insert($data){
        $this->db->insert('mstEmployee',$data);
      }
      
      public function getId($id){
            return $this->db->get_where('mstEmployee',array('id' => $id))->result();
      }
      
      public function edit($id, $data){
            $this->db->update('mstEmployee',$data, array('id' => $id));
      }

      public function delete($id){
            $this->db->delete('mstEmployee',array('id' => $id));
      }
 
}