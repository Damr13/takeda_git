<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class SurveyModel extends CI_Model{
  public function countResponse(){
		$q = "SELECT MAX(idResponse) AS idResponse
			FROM do_responses
		LIMIT 1";
		$rs = $this->db->query($q)->row('idResponse');
		return $rs;
	}

  public function countTotResp($id){
		$q = "SELECT idResponse FROM do_responses WHERE survey = '".$id."' GROUP BY idResponse";
		$rs = $this->db->query($q)->num_rows();
		return $rs;
	}

  public function insert($table, $data){
		$this->db->insert($table,$data);
		return true;
	}

  public function update($table, $data, $where){
		$this->db->update($table,$data,$where);
		return true;
	}
}