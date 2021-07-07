<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class General extends CI_Controller {	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('generalMdl','mdl');
		$this->load->library('session');
  //       if ($this->session->userdata('id_users')) {
		// 	$session_data       = $this->session->userdata('id_users');
		// }else{
		// 	redirect(base_url().'Login', 'refresh');
		// }
	}

	// GET ALL SURVEY LISTS BY AUTHOR --ir
	function surveyLists(){
		$author = $this->input->post('author');
		$surveyLists = $this->mdl->surveyLists($this->session->userdata('id_users'));
		$surveyLists = json_decode(json_encode($surveyLists), true);
		echo json_encode($surveyLists);
	}

	// GET TYPES OF QUESTION --ir
	function listTypeAns(){
		$listTypeAns = $this->mdl->listTypeAns();
		$listTypeAns = json_decode(json_encode($listTypeAns), true);
		echo json_encode($listTypeAns);
	}

	// GET PAGES --ir
	function surveyPages(){
		$id 					= $this->input->post('id');
		$surveyPages 	= $this->mdl->surveyPages($id);
		$surveyPages 	= json_decode(json_encode($surveyPages), true);
		echo json_encode($surveyPages);
	}

	// GET ALL QUESTIONS BASED ON SURVEY --ir
	function surveyQuestions(){
		$id 				= $this->input->post('id');
		$surveyQuestions 	= $this->mdl->surveyQuestions($id);
		$surveyQuestions 	= json_decode(json_encode($surveyQuestions), true);
		$datetime = array("title" => "Respons Date");
		$surveyQuestions[] = $datetime;
		echo json_encode($surveyQuestions);
	}
	
	// GET ALL RESPONSES BASED ON SURVEY --ir
	function surveyResponses(){
		$id 				= $this->input->post('id');
		$surveyResponses 	= $this->mdl->surveyResponses($id, "ess");
		$surveyQuestions 	= $this->mdl->surveyQuestions($id, "ess");
		// $a= 0;
		$ArrayResp = array();
		foreach ($surveyResponses as $res) {
			$idResponse = $res->idResponse;
			$ArrayResp[$idResponse] = $idResponse;
			$ArrayAns = array();
			foreach ($surveyQuestions as $que) {
				$idQ 			= $que->id;
				
				if($que->type=="image") {
					$title = $que->title."IMAGE";
					$ansValue = $this->mdl->dbGet_img("do_responses", "response", "question = '$idQ' AND idResponse = '$idResponse'", "");
				}else{
					$title 		= $que->title;
					$ansValue = $this->mdl->dbGet("do_responses", "response", "question = '$idQ' AND idResponse = '$idResponse'", "");
				}
				// $ansId  	= $this->mdl->dbGet("do_responses", "answer", "question = '$idQ' AND idResponse = '$idResponse'", "");
				
				$ArrayAns[$title] = $ansValue;
			}
			$ansTime = $this->mdl->dbGet("do_responses", "timestamps", "question = '$idQ' AND idResponse = '$idResponse'", "");
			$ArrayAns["Date Responses"] = $ansTime;
			$ArrayResp[$idResponse] = $ArrayAns;
			// var_dump($a++);
		}

		// print_r($ArrayResp);
		
		$ArrayResp 	= json_decode(json_encode($ArrayResp), true);
		echo json_encode($ArrayResp);
	}

	// GET QUESTIONS --ir
	function pageQuestions(){
		$idPage 			= $this->input->post('idPage');
		$pageQuestions 	= $this->mdl->getQuestions($idPage);
		$pageQuestions 	= json_decode(json_encode($pageQuestions), true);
		echo json_encode($pageQuestions);
	}

	// GET QUESTIONS & ANSWERS --ir
	function pageQuestionsAnswers(){
		$idPage 			= $this->input->post('idPage');
		// echo $idPage;exit();
		$pageQuestions 	= $this->mdl->getQuestions($idPage);
		$pageQuestions 	= json_decode(json_encode($pageQuestions), true);

		for ($i=0; $i <count($pageQuestions) ; $i++) { 
			$idQ = $pageQuestions[$i]['id'];
			$qAnswers 	= $this->mdl->getAnswers2($idQ,'',$idPage);
			$qAnswers 	= json_decode(json_encode($qAnswers), true);
			$pageQuestions[$i]['answer'] = $qAnswers;
		}
		// print_r($pageQuestions);exit();
		echo json_encode($pageQuestions);
	}

	// SET THE SURVEY --ir
	function setSurvey(){
		$id 		= $this->input->post('id');
		$surveyLists = $this->mdl->surveyLists_det($id);
		$survArr 	= json_decode(json_encode($surveyLists), true);
		foreach ($surveyLists as $survey) {
			$pageArr 		= array();
			$getPages 	= $this->mdl->getPages($survey->id);
			$getPages 	= json_decode(json_encode($getPages), true);
			for ($page=0; $page < count($getPages) ; $page++) { 
				$qArr = array();
				$pageArr[$getPages[$page]['title']] = $getPages[$page];
				$getQuestions 	= $this->mdl->getQuestions($getPages[$page]['id']);
				$getQuestions 	= json_decode(json_encode($getQuestions), true);
				for ($q=0; $q < count($getQuestions) ; $q++) { 
					$ansArr = array();
					$qArr[$getQuestions[$q]['title']] = $getQuestions[$q];
					$getAnswers 	= $this->mdl->getAnswers($getQuestions[$q]['id'], $getQuestions[$q]['type']);
					$getAnswers 	= json_decode(json_encode($getAnswers), true);
					for ($ans=0; $ans < count($getAnswers) ; $ans++) { 
						$ansArr[$getAnswers[$ans]['title']] = $getAnswers[$ans];
					}
					$qArr[$getQuestions[$q]['title']]['answers'] = $ansArr;
				}
				$pageArr[$getPages[$page]['title']]['questions'] = $qArr;
			}
			$survArr[0]['pages'] = $pageArr;
		}
		echo json_encode($survArr);
	}

	// GET ALL SURVEY LISTS BY AUTHOR --ir
	function getQSurvey(){
		$author = $this->input->post('author');
		$survey = $this->input->post('survey');
		$type 	= $this->input->post('type');
		$getQSurvey = $this->mdl->getQSurvey($survey, $type);
		$getQSurvey = json_decode(json_encode($getQSurvey), true);
		echo json_encode($getQSurvey);
	}

	// GET ALL ANSWERS LISTS BY QUESTIONS --ir
	function questionAnswers(){
		$idQ = $this->input->post('idQ');
		$questionAnswers = $this->mdl->dbResult("do_answers", "title", "question = '$idQ'", "");
		$questionAnswers = json_decode(json_encode($questionAnswers), true);
		echo json_encode($questionAnswers);
	}

	// GET ROWS --ir
	function dbRow(){
		$table 	= $this->input->post('table');
		$column = $this->input->post('column');
		$where 	= $this->input->post('where');
		$order 	= $this->input->post('order');
		$dbRow = $this->mdl->dbRow($table, $column, $where, $order);
		$dbRow = json_decode(json_encode($dbRow), true);
		echo json_encode($dbRow);
	}

	// GET RESULT --ir
	function dbResult(){
		$table 	= $this->input->post('table');
		$column = $this->input->post('column');
		$where 	= $this->input->post('where');
		$order 	= $this->input->post('order');
		$dbResult = $this->mdl->dbResult($table, $column, $where, $order);
		$dbResult = json_decode(json_encode($dbResult), true);
		echo json_encode($dbResult);
	}

	// GET COLUMN --ir
	function dbGet(){
		$table 	= $this->input->post('table');
		$column = $this->input->post('column');
		$where 	= $this->input->post('where');
		$order 	= $this->input->post('order');
		$dbGet = $this->mdl->dbGet($table, $column, $where, $order);
		$dbGet = json_decode(json_encode($dbGet), true);
		echo json_encode($dbGet);
	}

	// DELETE ROWS --ir
	function dbDeleteRow(){
		$table 	= $this->input->post('table');
		$where 	= $this->input->post('where');
		$dbDeleteRow = $this->mdl->deleteRows($table, $where);
		echo $dbDeleteRow;
	}
}
