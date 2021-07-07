<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class MstSurveyModel extends CI_Model{
  
	public function checkSurvey($surveyTitle){
		$q = "SELECT COUNT('title') AS title
			FROM $this->tableSurveys
			WHERE title = '$surveyTitle'
		LIMIT 1";
		$rs = $this->db->query($q)->row();
		return $rs;
	}
  
	public function query($q){
		$rs = $this->db->query($q);
		return $rs;
	}

	public function insert($table, $data){
		$this->db->insert($table,$data);
		return true;
	}

	public function addField($table, $data){
		$this->db->query("ALTER TABLE $table ADD $data datetime(6) NULL");
		return true;
	}

	public function update($table, $data, $where){
		$this->db->update($table, $data, $where);
		return true;
	}
	
	public function delete($table, $where){
		$this->db->delete($table,$where);
		return true;
  	}

  	public function delete_ans($table, $survey, $page, $question){
		// $this->db->delete($table,$where);
		$sql="DELETE FROM ".$table." WHERE survey = ".$survey." AND page = ".$page." AND question = ".$question;
		// echo $sql;exit();
        $query=$this->db->query($sql);
		return $query;
  	}

  	public function cek_level($user_level){
      $sql = "SELECT nama_level,max_survey,max_responden,price 
              FROM tbl_user_level
              WHERE id_user_level = ".$user_level;
        // echo $sql;exit();
      $query = $this->db->query($sql)->row();
      return $query;
    }

    public function cek_survey_bln($id_user,$bln){
      $sql = "SELECT count(*) as jml_d
				FROM do_surveys
				WHERE id_user = ".$id_user."
				AND SUBSTR(date,1,7) = '".$bln."' ";
        // echo $sql;exit();
      $query = $this->db->query($sql)->row();
      return $query;
    }
 
}