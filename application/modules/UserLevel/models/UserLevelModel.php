<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class UserLevelModel extends CI_Model{
 
      public function selectAll() {
        $sql = "SELECT * FROM tbl_user_level";
    
        $data = $this->db->query($sql);
    
        return $data->result();
      }

      public function insert($data){
        $this->db->insert('tbl_user_level',$data);
      }
      
      public function getId($id){
            return $this->db->get_where('tbl_user_level',array('id_user_level' => $id))->result();
      }
      
      public function edit($id, $data){
            $this->db->update('tbl_user_level',$data, array('id_user_level' => $id));
      }

      public function delete($id){
            $this->db->delete('tbl_user_level',array('id_user_level' => $id));
      }
 
}