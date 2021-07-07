<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class LogModel extends CI_Model{


 
  public function downtimeLists() {
    $result  = array();
    $dtGroup = array("RT", "PDT", "UDT", "IT", "UT");

    for ($i=0; $i < count($dtGroup); $i++) { 
      $q  = "SELECT * FROM mst_downtime WHERE downtimeGroup = '$dtGroup[$i]'";
      // echo $q;
      $rs = $this->db->query($q)->result();
			$result["dtGroup".$i] = $rs;
    }
    // exit();
    // print_r($result);exit();
    $q  = "SELECT * FROM mst_downtime";
    $rs = $this->db->query($q)->result();
		$result["dtGroup"] = $rs;

    return $result;
  }

  public function logbookLists() {
    $result  = array();

    for ($i=1; $i <= 4; $i++) { 
      $q  = "SELECT * FROM log_book WHERE shift = $i";
      $rs = $this->db->query($q)->row();
			$result["logbook".$i] = $rs;
    }

    // print_r($result);exit();

    return $result;
  }

  // ===================================

  public function logbookLists_dn($tgl,$shift,$id_machine) {
      $q  = "SELECT a.*,a.note,b.name as nm_leader FROM log_book a LEFT JOIN mst_pic b on a.leader = b.id 
            WHERE a.date = '".$tgl."' and a.shift = '".$shift."' and a.machine = ".$id_machine." ";
      // echo $q;exit();
      $rs = $this->db->query($q)->row();

    return $rs;
  }

  public function insert($tabel,$data){
    $run = $this->db->insert($tabel, $data); 
    
    return $this->db->insert_id();   
  }

  public function insert_det($tabel,$data){
    $run = $this->db->insert($tabel, $data); 
    return $run;   
  }

  public function count($tabel,$where=''){
    $q  = "SELECT count(*) as jml FROM ".$tabel." WHERE ".$where." ";
    // echo $q;exit();
    $rs = $this->db->query($q)->row();

    return $rs;
  }

  public function select_result($tabel,$join='',$where='',$kolom='',$order=''){
    $q  = "SELECT ".$kolom." FROM ".$tabel.$join." WHERE ".$where." ".$order."";
    // echo $q;exit();
    $rs = $this->db->query($q)->result();

    return $rs;
  }

  public function select_result2($tabel,$join='',$where='',$kolom='',$order=''){
    $q  = "SELECT ".$kolom." FROM ".$tabel." ".$join." ".$where." ".$order."";
    // echo $q;exit();
    $rs = $this->db->query($q)->result();

    return $rs;
  }

  public function select_row($tabel,$where='',$kolom=''){
    $q  = "SELECT ".$kolom." FROM ".$tabel." WHERE ".$where." ";
    // echo $q;exit();
    $rs = $this->db->query($q)->row();

    return $rs;
  }

  public function update($tabel,$data,$id){
    $run = $this->db->update($tabel, $data, array('id' => $id)); 
    return True;
  }

  public function updateRange($tabel,$data,$where){
    $run = $this->db->update($tabel, $data, $where); 
    return True;
  }

  public function get_pic($shift,$role){
    $q  = "SELECT id,name,role,shift from mst_pic WHERE role ='".$role."'";
    // echo $q;exit();
    $rs = $this->db->query($q)->result();

    return $rs;
  }

  // GET PRODUCTS --ir
  public function getProducts(){
    $q  = "SELECT * FROM mst_product";
    $rs = $this->db->query($q)->result();

    return $rs;
  }

  public function delete($tabel,$data){
    $run = $this->db->delete($tabel,$data); 
// print_r($run);
    return $run;   
  }

  public function report_daily($tgl,$grp,$id_machine){
    $q  = "SELECT
            id,
            CONCAT(SUBSTR(downtimeCode,-1,1),'. ',downtimeName) as name,
            downtimeCode,
            downtimeName,
            downtimeGroup,
            report_daily('".$tgl."',id,1,".$id_machine.") as shift1,
            report_daily('".$tgl."',id,2,".$id_machine.") as shift2,
            report_daily('".$tgl."',id,3,".$id_machine.") as shift3
          FROM
            mst_downtime
          WHERE downtimeGroup = '".$grp."'
          ORDER BY id";
    // echo $q;exit();
    $rs = $this->db->query($q)->result();
    return $rs;
  }

  public function report_result_daily($tgl,$grp,$id_machine){
    $q  = "SELECT
            a.id,c.codeShift,b.product_name,d.product_batch,d.product_good,d.product_reject
          FROM
            log_book a
          LEFT JOIN mst_time_shift c on a.shift = c.id
          LEFT JOIN log_book_det_product d on a.id = d.id_log_book
          LEFT JOIN mst_product b on d.id_product = b.id
          WHERE
            a.machine = ".$id_machine."
          AND date = '".$tgl."'
          ORDER BY a.shift ASC";
    // echo $q;exit();
    $rs = $this->db->query($q)->result();
    return $rs;
  }

  // ===================================

  public function picLists() {

    $q  = "SELECT * FROM mst_pic";
    $rs = $this->db->query($q)->result();

    return $rs;
  }

  public function shiftLists() {

    $q  = "SELECT * FROM mst_time_shift";
    $rs = $this->db->query($q)->result();

    return $rs;
  }


}