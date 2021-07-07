<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class UserModel extends CI_Model{
 
      public function selectAll() {
        $sql = "SELECT * FROM tbl_user";
    
        $data = $this->db->query($sql);
    
        return $data->result();
      }

      public function getLevel() {
        $sql = "SELECT * FROM tbl_user_level";
    
        $data = $this->db->query($sql);
    
        return $data->result();
      }

      public function insert($data){
        $this->db->insert('tbl_user',$data);
      }
      
      public function getId($id){
            return $this->db->get_where('tbl_user',array('id_users' => $id))->result();
      }
      
      public function edit($id, $data){
            $this->db->update('tbl_user',$data, array('id_users' => $id));
      }

      public function delete($id){
            $this->db->delete('tbl_user',array('id_users' => $id));
      }
 
}