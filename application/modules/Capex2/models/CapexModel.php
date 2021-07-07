<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class CapexModel extends CI_Model{
 
  // public function shiftLists() {

  //   $q  = "SELECT * FROM mst_time_shift";
  //   $rs = $this->db->query($q)->result();

  //   return $rs;
  // }

	public function data_resume($downtimeGroup){
		$sql = "SELECT id as id_dg,downtimeCode,downtimeName,downtimeGroup from mst_downtime
				WHERE downtimeGroup = '".$downtimeGroup."'
				ORDER BY downtimeCode ASC ";
		// echo $sql;exit();
        return $this->db->query($sql)->result();
	}

	public function select_row($tabel,$join='',$where='',$kolom='',$order=''){
	    $q  = "SELECT ".$kolom." FROM ".$tabel." ".$join." ".$where." ".$order."";
	    // echo $q;exit();
	    $rs = $this->db->query($q)->row();

	    return $rs;
	}

	public function select_result($tabel,$join='',$where='',$kolom='',$order=''){
	    $q  = "SELECT ".$kolom." FROM ".$tabel." ".$join." ".$where." ".$order."";
	    // echo $q;exit();
	    $rs = $this->db->query($q)->result();

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

	public function update($tabel,$data,$id){
		$run = $this->db->update($tabel, $data, array('id' => $id)); 
		return True;
	}

	public function update_2($tabel,$data,$param){
		$run = $this->db->update($tabel, $data, $param); 
		return True;
	}

	public function plan_ytd($id_budget,$month,$plan){
	    $q  = "SELECT plan_ytd(".$id_budget.",".$month.",".$plan.") as plan_ytd FROM DUAL";
	    // echo $q;exit();
	    $rs = $this->db->query($q)->row();

	    return $rs;
	}

	public function actual_ytd($id_budget,$month,$actual){
	    $q  = "SELECT actual_ytd(".$id_budget.",".$month.",".$actual.") as actual_ytd FROM DUAL";
	    // echo $q;exit();
	    $rs = $this->db->query($q)->row();

	    return $rs;
	}

	public function downtime($bln,$dg,$id_machine,$id_downtime){
		$sql = "SELECT report_breakdown ('".$bln."', '".$dg."',".$id_machine.",".$id_downtime.")/60 as dt from DUAL ";
        return $this->db->query($sql)->row();
	}

}