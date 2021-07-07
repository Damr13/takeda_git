<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class AuditTrailModel extends CI_Model{
 
      public function selectAll() {
        $sql = "SELECT * FROM audit_trail a INNER JOIN mst_downtime b ON a.code = b.id
            WHERE a.date LIKE '%2021-03%' ORDER BY a.date DESC ";
    
        $data = $this->db->query($sql);
    
        return $data->result();
      }

      // public function getLevel() {
      //   $sql = "SELECT * FROM tbl_user_level";
    
      //   $data = $this->db->query($sql);
    
      //   return $data->result();
      // }

      // // public function insert($data){
      // //   $this->db->insert('tbl_user',$data);
      // // }
      
      // // public function getId($id){
      // //       return $this->db->get_where('tbl_user',array('id_users' => $id))->result();
      // // }
      
      // // public function edit($id, $data){
      // //       $this->db->update('tbl_user',$data, array('id_users' => $id));
      // // }

      // // public function delete($id){
      // //       $this->db->delete('tbl_user',array('id_users' => $id));
      // // }
 
}