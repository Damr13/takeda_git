<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class RptResumeModel extends CI_Model{
 
  // public function shiftLists() {

  //   $q  = "SELECT * FROM mst_time_shift";
  //   $rs = $this->db->query($q)->result();

  //   return $rs;
  // }

	public function data_resume($downtimeGroup){
		$sql = "SELECT id,downtimeCode,downtimeName,downtimeGroup from mst_downtime
				WHERE downtimeGroup = '".$downtimeGroup."'
				ORDER BY downtimeCode ASC ";
		// echo $sql;exit();
        return $this->db->query($sql)->result();
	}

	public function select_result2($tabel,$join='',$where='',$kolom='',$order=''){
	    $q  = "SELECT ".$kolom." FROM ".$tabel." ".$join." ".$where." ".$order."";
	    // echo $q;exit();
	    $rs = $this->db->query($q)->result();

	    return $rs;
	}

	public function select_row($tabel,$join='',$where='',$kolom='',$order=''){
	    $q  = "SELECT ".$kolom." FROM ".$tabel." ".$join." ".$where." ".$order."";
	    // echo $q;exit();
	    $rs = $this->db->query($q)->row();

	    return $rs;
	}

	public function downtime($tgl,$id_machine,$id){
		$sql = "SELECT report_resume('".$tgl."',".$id_machine.",".$id.") as dt FROM DUAL";
        return $this->db->query($sql)->row();
	}
}