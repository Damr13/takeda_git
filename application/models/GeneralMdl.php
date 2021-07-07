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
		$data = $this->db->query($sql);
		return $data->row($column);
	}

	public function dbRow($table, $column, $where, $order) {
		$sql = "SELECT $column FROM $table WHERE $where $order";
		$data = $this->db->query($sql);
		return $data->row();
	}
	
	public function dbResult($table, $column, $where, $order) {
		$sql = "SELECT $column FROM $table WHERE $where $order";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function dbResultArray($table, $column, $where, $order) {
		$sql = "SELECT $column FROM $table WHERE $where $order";
		$data = $this->db->query($sql);
		return $data->result_array();
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

	// GET PART GROUPING BY DEPT --ir
	function surveyLists($id){
		if(!($id)) $where = "";
		else $where = "WHERE id = '$id'";
		$q = "SELECT *, 
						DATE_FORMAT(date, '%Y-%m-%d') as date, 
						DATE_FORMAT(beginDate, '%Y-%m-%d') as beginDate, 
						DATE_FORMAT(endDate, '%Y-%m-%d') as endDate 
					FROM $this->tableSurveys $where 
					ORDER BY id ASC";
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
		if($ess) $select = 'SELECT a.idResponse';
		else $select = 'SELECT a.*';
		$leftJoin = "LEFT JOIN $this->tableSurveys b ON a.survey = b.id";
		$where = "WHERE a.survey = '$id'";
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
		else $select = 'SELECT *, a.id as id, b.id as idType, a.req as reqQ';
		$leftJoin = "LEFT JOIN $this->tableTypeAns b ON a.type = b.type";
		$where = "WHERE a.page = '$idPage'";
		$q = "$select
			FROM $this->tableQ a 
			$leftJoin
			$where 
			ORDER BY a.sort ASC";
		$result = $this->db->query($q)->result();
		return $result;
	}

	// GET ANSWERS BASED ON QUESTIONS --ir
	function getAnswers($idQ, $type=''){
		if($type == "rating") $order = "DESC"; else $order = "ASC";
		$leftJoin = "LEFT JOIN $this->tableQ b ON a.question = b.id";
		$where = "WHERE a.question = '$idQ'";
		$q = "SELECT a.title, a.id
			FROM $this->tableAns a 
			$leftJoin
			$where 
			ORDER BY a.id ASC";
		$result = $this->db->query($q)->result();
		return $result;
	}

	public function sendMail($emailto, $judul, $isi) 
    {
        // $config = Array(
        //   'protocol' => 'smtp',
        //   'smtp_host' => 'ssl://smtp.gmail.com',
        //   'smtp_port' => 465,
        //   'smtp_user' => 'system@inagro.co.id', //isi dengan gmailmu!
        //   'smtp_pass' => '**', //isi dengan password gmailmu!
        //   'charset' => 'utf-8',
        //   'mailtype' => 'html',
        //   'charset' => 'iso-8859-1',
        //   'wordwrap' => TRUE
        // );


        $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'mail.dosurveys.id',
          'smtp_port' => 587,
          'smtp_user' => 'admin@dosurveys.id', //isi dengan gmailmu!
          'smtp_pass' => 'Admin@99', //isi dengan password gmailmu!
          'charset' => 'utf-8',
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('admin@dosurveys.id');
        $this->email->to($emailto); //email tujuan. Isikan dengan emailmu!
        $this->email->subject($judul);
        $this->email->message($isi);
        if($this->email->send())
        {
          return true;
        }
        else
        {
          show_error($this->email->print_debugger());
        }
        return false;
    }

}
