<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MstSurvey extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MstSurveyModel');
		$this->load->model('MenuModel');
		$this->load->model('GeneralMdl');
		$this->load->library('form_validation');
		$this->tableSurveys = 'do_surveys';
		$this->tables = array('do_surveys', 'do_pages', 'do_questions', 'do_answers', 'do_responses');
		$this->colSurvey 		= array("title", "beginDate", "endDate", "author", "welcomeTitle", "welcomeText", "welcomeBtn", "thanksTitle", "thanksText", "thanksBtn");
		$this->colPages	 		= array("title", "sort");
		$this->colQuestion 	= array("title", "type", "sort", "req");
		$this->colAns 			= array("title", "page", "type", "sort");

		$this->load->library('session');
        if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}
	}

	function checkDate($date){
		if($date != '0000-00-00') return $date;
		else return NULL;
	}

	function dmys2ymd($date){
		if ($date!=""){
			list($day, $month, $year) = explode('/', $date);		
			return $year."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-".str_pad($day, 2, "0", STR_PAD_LEFT);
		} else {
			return "0000-00-00";
		}
	}
	
	public function index() {
		if(!(isset($_GET['id']))) $id='';
		else $id = $_GET['id'];

		$data['id'] = $id;
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
		$data['akses'] = $this->MenuModel->akses_menu2("MstSurvey", $this->session->userdata('id_user_level'));
		$data['view'] = false;
		$this->load->view('MstSurvey/templates/Header');
		$this->template->load('template','MstSurvey', $data);
		$this->load->view('MstSurvey/templates/Footer');
	}

	public function duplicate(){
		$id 			= $this->input->post('id');
		$idSurvey 		= $this->input->post('idSurvey');
		$idPage 		= $this->input->post('idPage');
		$idQ 			= $this->input->post('idQ');
		$obj 			= $this->input->post('obj');

		if($obj == "survey"){
			$above = "url";
			$table = $this->tables[0];
			$col = $this->colSurvey;
		} else if($obj == "page"){
			$above = "survey";
			$table = $this->tables[1];
			$col = $this->colPages;
		} else if($obj == "question"){
			$above = "page";
			$table = $this->tables[2];
			$col = $this->colQuestion;
		}

		$col2 = $col;
		unset($col2[0]);
		if($obj == "survey" || $obj == "page") $q = "INSERT INTO $table (".implode(", ", $col).", $above) SELECT CONCAT($col[0], ' (Duplicate)'), ".implode(", ", $col2).", $above FROM $table WHERE id='$id'";
		else $q = "INSERT INTO $table (".implode(", ", $col).", $above, survey) SELECT CONCAT($col[0], ' (Duplicate)'), ".implode(", ", $col2).", $above, $idSurvey as survey FROM $table WHERE id='$id'";
		
		$this->MstSurveyModel->query($q);
		
		if($obj == "question"){
			$fkIdMax 		= $this->GeneralMdl->dbRow($this->tables[2], "MAX(id) as question", "survey = '$idSurvey' AND page = '$idPage'", "");
			$table			= $this->tables[3];
			$tableAbove	= $this->tables[2];
			$fkCol			= "question";
			$fkId				= $idQ;
			$fkIdMax		= $fkIdMax->question;
			$cols				= $this->colAns;
			$act				= "answer";
		}
		if($obj == "page"){
			$fkIdMax 		= $this->GeneralMdl->dbRow($this->tables[1], "MAX(id) as page", "survey = '$idSurvey'", "");
			$table			= $this->tables[2];
			$tableAbove	= $this->tables[1];
			$fkCol			= "page";
			$fkId				= $idPage;
			$fkIdMax		= $fkIdMax->page;
			$cols				= $this->colQuestion;
			$act				= "question";
		}
		if($obj == "survey"){
			$fkIdMax 		= $this->GeneralMdl->dbRow($this->tables[0], "MAX(id) as survey", "1 = 1", "");
			$table			= $this->tables[1];
			$tableAbove	= $this->tables[0];
			$fkCol			= "survey";
			$fkId				= $idSurvey;
			$fkIdMax		= $fkIdMax->survey;
			$cols				= $this->colPages;
			$act				= "page";
		}

		if ($this->duplicateBelow($table, $tableAbove, $fkCol, $fkId, $fkIdMax, $cols, $act, $idSurvey, $idPage, $idQ)) {
			$response = "success";
		}else $response = "failed";

		echo json_encode($response);
	}

	public function duplicateBelow($table, $tableAbove, $fkCol, $fkId, $fkIdMax, $cols, $act, $idSurvey, $idPage, $idQ){
		$listsId = $this->GeneralMdl->dbResult($table, "id", "$fkCol = '$fkId'", "");
		foreach ($listsId as $listsId) {
			if($act == "page") $q = "INSERT INTO $table (".implode(", ", $cols).", $fkCol) SELECT ".implode(", ", $cols).", $fkIdMax as $fkCol FROM $table WHERE id='$listsId->id'";
			else $q = "INSERT INTO $table (".implode(", ", $cols).", $fkCol, survey) SELECT ".implode(", ", $cols).", $fkIdMax as $fkCol, $idSurvey as survey FROM $table WHERE id='$listsId->id'";
			if ($this->MstSurveyModel->query($q)) {
				$response = true;
			}else $response = false;
			if($act == "answer") continue;
			if($act == "question"){
				$q_idQ 				= $idQ;
				$q_idSurvey 	= $idSurvey;
				$q_idPage 		= $this->GeneralMdl->dbRow($this->tables[1], "MAX(id) as page", "survey = '$q_idSurvey'", "")->page;
				$q_fkIdMax 		= $this->GeneralMdl->dbRow($this->tables[2], "MAX(id) as question", "survey = '$q_idSurvey' AND page = '$q_idPage'", "");
				$q_table			= $this->tables[3];
				$q_tableAbove	= $this->tables[2];
				$q_fkCol			= "question";
				$q_fkId				= $listsId->id;
				$q_fkIdMax		= $q_fkIdMax->question;
				$q_cols				= $this->colAns;
				$q_act				= "answer";
				if ($this->duplicateBelow($q_table, $q_tableAbove, $q_fkCol, $q_fkId, $q_fkIdMax, $q_cols, $q_act, $q_idSurvey, $q_idPage, $q_idQ)) {
					$response = true;
				}else $response = false;
			}
			if($act == "page"){
				$p_idQ 				= $idQ;
				$p_idPage 		= $idPage;
				$p_idSurvey		= $this->GeneralMdl->dbRow($this->tables[0], "MAX(id) as survey", "1 = 1", "")->survey;
				$p_fkIdMax 		= $this->GeneralMdl->dbRow($this->tables[1], "MAX(id) as page", "survey = '$p_idSurvey'", "");
				$p_table			= $this->tables[2];
				$p_tableAbove	= $this->tables[1];
				$p_fkCol			= "page";
				$p_fkId				= $listsId->id;
				$p_fkIdMax		= $p_fkIdMax->page;
				$p_cols				= $this->colQuestion;
				$p_act				= "question";
				if ($this->duplicateBelow($p_table, $p_tableAbove, $p_fkCol, $p_fkId, $p_fkIdMax, $p_cols, $p_act, $p_idSurvey, $p_idPage, $p_idQ)) {
					$response = true;
				}else $response = false;
			}

		}
		return true;
	}

	// UPDATE OR CREATE SURVEY --ir
	public function updateSurvey(){
		// echo $this->session->userdata('id_users');exit();
		date_default_timezone_set('Asia/Jakarta');
		$action = $this->input->post('action');
		$where 	= array(
			'id'	=> $this->input->post('id')
		);
		$data = array(
			'title'			=> $this->input->post('title'),
			// 'date' 			=> $this->dmys2ymd(date("y/m/d")),
			'date' 			=> date('Y-m-d'),
			'beginDate' => $this->checkDate($this->input->post('surveyBegin')),
			'endDate' 	=> $this->checkDate($this->input->post('surveyEnd')),
			'category'				=> $this->input->post('category'),
			'url'				=> $this->input->post('url'),
			'target'		=> $this->input->post('target'),
			'id_user'	=> $this->session->userdata('id_users')
		);

		if ($action == "create") {
			$checkSurvey = $this->MstSurveyModel->checkSurvey($this->input->post('title'));
			if($checkSurvey->title > 0) $response = "duplicate";
			else{
				#cek mak survey
				$usr_lvl = $this->MstSurveyModel->cek_level($this->session->userdata('id_user_level'));
				if($usr_lvl->max_survey > 0){
					#cek survey bulan ini
					$svy = $this->MstSurveyModel->cek_survey_bln($this->session->userdata('id_users'),date('Y-m'));
					#jika jumlah survey belum lewat batas maksimal
					if($svy->jml_d < $usr_lvl->max_survey){
						if ($this->MstSurveyModel->insert($this->tableSurveys, $data)) {
							$response = "success";
						}else $response = "failed";
					}else{
						$response = "failed";
					}
				}else{
					if ($this->MstSurveyModel->insert($this->tableSurveys, $data)) {
						$response = "success";
					}else $response = "failed";
				}
			}
		}else{
			if ($this->MstSurveyModel->update($this->tableSurveys, $data, $where)) {
				$response = "success";
			}else $response = "failed";
		}

		echo json_encode($response);
	}

	// UPDATE OR CREATE PAGE --ir
	public function updatePage(){
		$page = $this->input->post('page');
		
		if($page == "welcome" || $page == "thanks"){
			$where 	= array(
				'id'	=> $this->input->post('id')
			);
			$table = $this->tables[0];
			$data = array(
				$page.'Title'	=> $this->input->post('titlePage'),
				$page.'Text' 	=> $this->input->post('textPage'),
				$page.'Btn' 	=> $this->input->post('btnPage'),
			);
		}else{
			$where 	= array(
				'id'			=> $this->input->post('idPage'),
				'survey'	=> $this->input->post('id')
			);
			$table = $this->tables[1];
			$data = array(
				'survey'	=> $this->input->post('id'),
				'title' 	=> $this->input->post('titlePage'),
				'desc'  	=> $this->input->post('textPage'),
			);
		}

		if($page != "create"){
			if ($this->MstSurveyModel->update($table, $data, $where)) {
				$response = "success";
			}else $response = "failed";
		}else{
			if ($this->MstSurveyModel->insert($table, $data)) {
				$response = "success";
			}else $response = "failed";
		}

		echo json_encode($response);
	}

	// UPDATE OR CREATE QUESTIONS --ir
	public function updateQ(){
		$action = $this->input->post('q');
		$where 	= array(
			'id'		 => $this->input->post('idQ'),
			// 'survey' => $this->input->post('id'),
			// 'page'	 => $this->input->post('idPage')
		);
		
		if ($action == "create") {
			$data = array(
				'survey'    => $this->input->post('id'),
				'page'	    => $this->input->post('idPage'),
				'title'			=> $this->input->post('titleQ'),
				'desc'			=> $this->input->post('textQ'),
				'type'			=> $this->input->post('typeAns'),
				'req'			  => $this->input->post('reqQ'),
				'cat_risk'			  => $this->input->post('cat_risk'),
			);
			if ($this->MstSurveyModel->insert($this->tables[2], $data)) {
				$response = "success";
			}else $response = "failed";
		}else{
			$data = array(
				'title'			=> $this->input->post('titleQ'),
				'desc'			=> $this->input->post('textQ'),
				'type'			=> $this->input->post('typeAns'),
				'req'				=> $this->input->post('reqQ'),
				'cat_risk'			  => $this->input->post('cat_risk'),
			);
			// print_r($data);exit();
			if ($this->MstSurveyModel->update($this->tables[2], $data, $where)) {
				$response = "success";
			}else $response = "failed";
		}

		echo json_encode($response);
	}

	// UPDATE OR CREATE ANSWERS --ir
	public function updateAns(){
		$action = $this->input->post('q');
		$answerCount = $this->input->post('answerCount');
		// $where 	= array(
		// 	'id'		 => $this->input->post('idAns'),
		// );
		$where 	= array(
			'survey' 		=> $this->input->post('id'),
			'page'	 		=> $this->input->post('idPage'),
			'question'	=> $this->input->post('idQ'),
		);

		if ($this->MstSurveyModel->delete($this->tables[3], $where)) {
			for ($i=0; $i <= $answerCount ; $i++) { 
				if($this->input->post('titleAns'.$i) == '') continue;
				$data = array(
					'survey'    => $this->input->post('id'),
					'page'	    => $this->input->post('idPage'),
					'question'	=> $this->input->post('idQ'),
					'title'		=> $this->input->post('titleAns'.$i),
					'skor'		=> $this->input->post('skorAns'.$i),
					'rightAns'	=> $this->input->post('rightAns'.$i),
					'type'		=> $this->input->post('typeAns'),
				);
				// print_r($data);exit();
				if ($this->MstSurveyModel->insert($this->tables[3], $data)) {
					$response = "success";
				}else $response = "failed";
			}
		}

		echo json_encode($response);
	}

	public function changeStatus(){
		if($this->input->post('type') == "survey") $table = $this->tables[0];
		else if($this->input->post('type') == "page") $table = $this->tables[1];
		else $table = $this->tables[2];
		$where = array(
			'id'	=> $this->input->post('id')
		);
		
		if($this->input->post('status') == "1") $value = 0; else $value = 1;

		$data = array(
			'status' => $value,
		);
		
		if ($this->MstSurveyModel->update($table, $data, $where)) {
			$response = "success";
		}else $response = "failed";

		echo json_encode($response);
	}

	public function delSurvey(){
		for ($y=0; $y < count($this->tables); $y++) { 
			if($y == 0) $field = 'id'; else $field = 'survey';
			$where	= array(
				$field	=> $this->input->post("id")
			);
			
			if ($this->MstSurveyModel->delete($this->tables[$y], $where)) {
				$response = "success";
			}else $response = "failed";
		}
		echo json_encode($response);
	}

	public function delRow(){
		$idSurvey	= $this->input->post("idSurvey");
		$idPage	  = $this->input->post("idPage");
		$idQ	    = $this->input->post("idQ");
		$act	    = $this->input->post("type");

		if ($act == "survey") {
			$a = 0;
			$id = $idSurvey;
			$col = "survey";
		}	else if ($act == "page") {
			$a = 1;
			$id = $idPage;
			$col = "page";
		}	else if ($act == "question") {
			$a = 2;
			$id = $idQ;
			$col = "question";
		}

		for ($y=$a; $y < count($this->tables); $y++) { 
			if($y == $a) $field = 'id'; else $field = $col;
			$where	= array(
				$field	=> $id
			);
			
			if ($this->MstSurveyModel->delete($this->tables[$y], $where)) {
				$response = "success";
			}else $response = "failed";
		}
		echo json_encode($response);
	}

	function changeOrder(){
		$id  	 = $this->input->post('id');
		$table  = $this->input->post('table');
		$value = $this->input->post('value');
		
		$where = array('id' => $id);
		$data  = array('sort' => $value);
		if($table == "page") $tables = $this->tables[1];
		else $tables = $this->tables[2];
		// var_dump($table,$where, $data, $tables);
		$changeOrder = $this->MstSurveyModel->update($tables, $data, $where);

		echo json_encode($changeOrder);
	}

	private function rules(){
		return[
			['field' => 'name', 'label' => 'name', 'rules'=>'required'],
			['field' => 'role', 'label' => 'role', 'rules'=>'required'],
			['field' => 'shift', 'label' => 'shift', 'rules'=>'required']
		];
	}
}