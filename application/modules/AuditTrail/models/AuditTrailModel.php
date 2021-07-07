<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class AuditTrailModel extends CI_Model{

  public function select_result($kolom='',$tabel,$join='',$where='',$order=''){
    $q  = "SELECT ".$kolom." FROM ".$tabel." ".$join." ".$where." ".$order."";
    // echo $q;exit();
    $rs = $this->db->query($q)->result();
     //var_dump($q);
    return $rs;
  }
  public function select_result2($tabel,$join='',$where='',$kolom='',$order=''){
    $q  = "SELECT ".$kolom." FROM ".$tabel." ".$join." ".$where." ".$order."";
    //echo $q;exit();
    //var_dump($q);
    $rs = $this->db->query($q)->result();

    return $rs;
}

  public function select_row($tabel,$join='',$where='',$kolom='',$order=''){
    $q  = "SELECT ".$kolom." FROM ".$tabel." ".$join." ".$where." ".$order."";
    // echo $q;exit();
    $rs = $this->db->query($q)->row();

    return $rs;
  }

}