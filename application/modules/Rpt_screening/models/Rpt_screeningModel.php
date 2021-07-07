<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Rpt_screeningModel extends CI_Model{

  public function selectAll() {
    $sql = "SELECT * FROM screening";

    $data = $this->db->query($sql);

    return $data->result();
  }

  // public function select_result($kolom='',$tabel,$where='',$order=''){
  //   $q  = "SELECT ".$kolom." FROM ".$tabel." ".$where." ".$order."";
  //   //echo $q;exit();
  //   $rs = $this->db->query($q)->result();
  //   //var_dump($q);
  //   return $rs;
  // }
  // public function select_result2(){
  //   $q  = "SELECT ".$kolom." FROM ".$tabel." ".$where." ".$order."";
  //   //echo $q;exit();
  //   //var_dump($q);
  //   $rs = $this->db->query($q)->result();

  //   return $rs;
  // }
  // public function select_row($tabel,$where='',$kolom='',$order=''){
  //   $q  = "SELECT ".$kolom." FROM ".$tabel." ".$where." ".$order."";
  //   //echo $q;exit();
  //   var_dump($q);
  //   $rs = $this->db->query($q)->row();

  //   return $rs;
  // }
}