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