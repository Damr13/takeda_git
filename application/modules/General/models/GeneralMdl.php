<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GeneralMdl extends CI_Model {
  function __construct() {
    parent::__construct();
		$this->tableSurveys = 'do_surveys';
		$this->tablePages   = 'do_pages';
		$this->tableQ   		= 'do_questions';
		$this->tableAns   	= 'do_answers';
		$this->tableResp 		= 'do_responses';
		$this->tableTypeAns = 'do_type_answer';
	}

	public function dbGet($table, $column, $where, $order) {
		$sql = "SELECT $column FROM $table WHERE $where $order";
		// echo $sql;exit();
		$data = $this->db->query($sql);
		return $data->row($column);
	}

	public function dbGet_img($table, $column, $where, $order) {
		$sql = "SELECT url as $column FROM $table WHERE $where $order";
		// echo $sql;exit();
		$data = $this->db->query($sql);
		return $data->row($column);
	}

	public function dbRow($table, $column, $where, $order) {
		$sql = "SELECT $column FROM $table WHERE $where $order";
		// var_dump($sql);
		$data = $this->db->query($sql);
		return $data->row();
	}
	
	public function dbResult($table, $column, $where, $order) {
		$sql = "SELECT $column FROM $table WHERE $where $order";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function query($q){
		$rs = $this->db->query($q);
		return $rs;
	}

	public function insert($table, $data){
		$this->db->insert($table,$data);
		return true;
	}

	public function update($table, $data, $where){
		$this->db->update($table, $data, $where);
		return true;
	}
	
	public function deleteRows($table, $where){
		$this->db->delete($table,$where);
		return true;
  }

	// GET PART GROUPING BY DEPT --ir
	function surveyLists($id_user){
		// echo $this->session->userdata('id_user_level');exit();
		// if(!($id)) $where = "";
		// else $where = "WHERE id = '$id'";
		if($this->session->userdata('id_user_level')==1) {
			$where = "";
		}else{
			// $where = "WHERE id_user = '$id_user'";
			$where = "";
		};
		$q = "SELECT *, 
						DATE_FORMAT(date, '%Y-%m-%d') as date, 
						DATE_FORMAT(beginDate, '%Y-%m-%d') as beginDate, 
						DATE_FORMAT(endDate, '%Y-%m-%d') as endDate 
					FROM $this->tableSurveys $where 
					ORDER BY id ASC";
		// echo $q;exit();
		$result = $this->db->query($q)->result();
		return $result;
	}

	function surveyLists_det($id){
		if(!($id)) $where = "";
		else $where = "WHERE id = '$id'";
		$q = "SELECT sv.*, 
				DATE_FORMAT(date, '%Y-%m-%d') as date, 
				DATE_FORMAT(beginDate, '%Y-%m-%d') as beginDate, 
				DATE_FORMAT(endDate, '%Y-%m-%d') as endDate ,
			usr.full_name,lvl.nama_level,lvl.max_responden
			FROM $this->tableSurveys sv 
			LEFT JOIN tbl_user usr on sv.id_user = usr.id_users
			LEFT JOIN tbl_user_level lvl on usr.id_user_level = lvl.id_user_level
			$where 
			ORDER BY id ASC";
		// echo $q;exit();
		$result = $this->db->query($q)->result();
		return $result;
	}

	// GET TYPES OF QUESTION --ir
	function listTypeAns(){
		$where = '';
		$q = "SELECT * FROM $this->tableTypeAns $where ORDER BY id ASC";
		$result = $this->db->query($q)->result();
		return $result;
	}

	function surveyPages($id){
		$leftJoin = "LEFT JOIN $this->tablePages b ON a.id = b.survey";
		$where = "WHERE a.id = '$id'";
		$q = "SELECT *, a.id as id, b.id as idPage, b.sort,
				b.title as titlePage, a.title as title, 
				DATE_FORMAT(beginDate, '%Y-%m-%d') as beginDate, DATE_FORMAT(endDate, '%Y-%m-%d') as endDate,
				b.status as statusPage, a.status as status
			FROM $this->tableSurveys a 
			$leftJoin 
			$where 
			ORDER BY b.sort ASC";
		$result = $this->db->query($q)->result();
// 		var_dump($q);
		return $result;
	}
	
	// GET ALL QUESTIONS BASED ON SURVEY --ir
	function surveyQuestions($id){
		$leftJoin = "LEFT JOIN $this->tableSurveys b ON a.survey = b.id";
		$where = "WHERE a.survey = '$id'";
		$q = "SELECT a.title, a.id, a.type, a.sort
			FROM $this->tableQ a 
			$leftJoin 
			$where 
			ORDER BY a.id ASC";
		$result = $this->db->query($q)->result();
		return $result;
	}

	// GET ALL RESPONSES BASED ON SURVEY --ir
	function surveyResponses($id, $ess = ''){
	    $todayS = date("d-m-Y");
		if($ess) $select = 'SELECT a.idResponse';
		else $select = 'SELECT a.*';
		$leftJoin = "LEFT JOIN $this->tableSurveys b ON a.survey = b.id";
		$where = "WHERE a.survey = '$id' and DATE_FORMAT(a.timestamps, '%d-%m-%Y') = '".$todayS."' ";
		$q = "$select
			FROM $this->tableResp a 
			$leftJoin 
			$where 
			GROUP BY a.idResponse
			ORDER BY a.id ASC";
			// var_dump($q); die();
		$result = $this->db->query($q)->result();
		return $result;
	}

	// GET PART GROUPING BY DEPT --ir
	function getPages($id){
		$leftJoin = "LEFT JOIN $this->tableSurveys b ON a.survey = b.id";
		$where = "WHERE a.survey = '$id' AND a.status = '1'";
		$q = "SELECT a.title, a.id, a.desc
			FROM $this->tablePages a 
			$leftJoin 
			$where 
			ORDER BY a.sort ASC";
		$result = $this->db->query($q)->result();
		return $result;
	}
	
	// GET QUESTIONS BASED ON PAGE --ir
	function getQuestions($idPage, $ess = ''){
		if($ess) $select = 'SELECT a.id, a.title, a.type';
		else $select = 'SELECT *, a.id as id, b.id as idType, a.req as reqQ,a.cat_risk';
		$leftJoin = "LEFT JOIN $this->tableTypeAns b ON a.type = b.type";
		$where = "WHERE a.page = '$idPage'";
		$q = "$select
			FROM $this->tableQ a 
			$leftJoin
			$where 
			ORDER BY a.sort ASC";
		// echo $q;exit();
		$result = $this->db->query($q)->result();
		return $result;
	}

	// GET ANSWERS BASED ON QUESTIONS --ir
	function getAnswers($idQ, $type=''){
		if($type == "rating") $order = "DESC"; else $order = "ASC";
		$leftJoin = "LEFT JOIN $this->tableQ b ON a.question = b.id";
		$where = "WHERE a.question = '$idQ'";
		$q = "SELECT a.title, a.id, a.rightAns
			FROM $this->tableAns a 
			$leftJoin
			$where 
			ORDER BY a.id ASC";
		// echo $q;exit();
		$result = $this->db->query($q)->result();
		return $result;
	}

	function getAnswers2($idQ, $type='',$idPage=''){
		if($type == "rating") $order = "DESC"; else $order = "ASC";
		$leftJoin = "LEFT JOIN $this->tableQ b ON a.question = b.id";
		$where = "WHERE a.question = '$idQ' and a.page = '$idPage' ";
		// $q = "SELECT a.title, a.id, a.rightAns,
		// 	CASE
		// 	    WHEN a.skor = 5 THEN 'High Risk'
		// 	    WHEN a.skor = 4 THEN 'Severe/Medium High'
		// 	    WHEN a.skor = 3 THEN 'Medium Risk'
		// 	    WHEN a.skor = 2 THEN 'Medium Low'
		// 	    ELSE 'Low'
		// 	END as risk
		// 	FROM $this->tableAns a 
		// 	$leftJoin
		// 	$where 
		// 	ORDER BY a.id ASC";

		$q = "SELECT a.title, a.id, a.rightAns,
			a.skor as risk
			FROM $this->tableAns a 
			$leftJoin
			$where 
			ORDER BY a.id ASC";
			
		// echo $q;exit();
		$result = $this->db->query($q)->result();
		return $result;
	}

	// GET Q BASED ON SURVEY --ir
	function getQSurvey($id, $type=''){
		$where 	= "WHERE survey = '$id'";
		if($type) $type = "AND type = '$type'";
		$q = "SELECT *
					FROM $this->tableQ $where $type
					ORDER BY id ASC";
		$result = $this->db->query($q)->result();
		return $result;
	}
}
