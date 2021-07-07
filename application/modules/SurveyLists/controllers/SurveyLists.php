<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SurveyLists extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('SurveyListsModel');
// 		$this->load->model('MstSurvey/MstSurveyModel');
		$this->load->model('MenuModel');
		$this->load->model('GeneralMdl');
		$this->load->library('form_validation');
		$this->tableSurveys = 'do_surveys';
		$this->tables = array('do_surveys', 'do_pages', 'do_questions', 'do_answers', 'do_responses');
		$this->load->library('session');
        if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}
	}

	public function index() {
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
		$data['akses'] = $this->MenuModel->akses_menu2("SurveyLists", $this->session->userdata('id_user_level'));
		$data['view'] = false;
		$this->load->view('SurveyLists/templates/Header');
		$this->template->load('template','SurveyLists', $data);
		$this->load->view('SurveyLists/templates/Footer');
		$this->load->view('SurveyLists/templates/ChartLib');
	}

	public function listTerminal(){
		$id = $this->input->post('id');
		$listTerminal 	= $this->SurveyListsModel->listTerminal($id);
		$listTerminal 	= json_decode(json_encode($listTerminal), true);
		echo json_encode($listTerminal);
	}

	public function getDataChart(){
		$basedQ 	= $this->input->post('basedQ');
		$chart 		= $this->input->post('chart');
		$id 			= $this->input->post('id');
		$idQ 			= $this->input->post('idQ');
		$idChart 	= $this->input->post('idChart');
		$custom 	= $this->input->post('custom');

		$getName 	= "getDataChart".ucfirst($chart);
		// echo $chart;exit();
		$$getName = $this->SurveyListsModel->$getName($basedQ, $id, $idQ, $idChart, $custom);
		$data			= json_decode(json_encode($$getName), true);
		
		echo json_encode($data);
	}

	public function getDataChart2(){
		$basedQ 	= $this->input->post('basedQ');
		$chart 		= $this->input->post('chart');
		$id 			= $this->input->post('id');
		$idQ 			= $this->input->post('idQ');

		if($chart == "GG1") $funcName = "Gauges";

		$getName 	= "get".ucfirst($chart);
		$$getName = $this->SurveyListsModel->$getName($basedQ, $id);
		$data			= json_decode(json_encode($$getName), true);
		
		echo json_encode($data);
	}

	public function changeTerminal(){
		$basedQ 	= $this->input->post('basedQ');
		$id 			= $this->input->post('id');

		if($id == "27") $get = array('getResponden', 'getGraphAge', 'getTypeOfResp', 'getRatingChart', 'getSatisfaction',
		 'getTagCloud', 'getTagCloud2', 'getFreqApp', 'getmoneySpent', 'getTagCloudHope', 'getTagCloudHope2', 'getTagCloudHope3');
		else if($id == "28") $get = array('getResponden', 'getFiveValue', 'getGraphAge', 'getVehicle', 'getRoute', 'getRequest');
		else $get = array('getResponden', 'getGraphAge', 'getFiveValuePO', 'getVehiclePO', 'getRoutePO', 'getDeparturePO', 'getArrivalPO', 'getOccupancyPO', 'getDecreasePO');

		for ($x=0; $x < count($get); $x++) { 
			$getName = $get[$x];
			$$getName = $this->SurveyListsModel->$getName($basedQ, $id);
			$data[$getName] = json_decode(json_encode($$getName), true);		
		}
		echo json_encode($data);
	}

	public function updateOptChart(){
		$where = array(
			'id'	=> $this->input->post('id')
		);


		if($this->input->post('modalOpt') == "main"){
			$data = array(
				'typeChart'	=> $this->input->post('typeChart'),
				'basedQ' 		=> $this->input->post('basedQ'),
				'listAns' 	=> $this->input->post('listAns'),
				'minResp' 	=> $this->input->post('minResp'),
				'opt'		 		=> $this->input->post('optChart'),
			);
			if ($this->GeneralMdl->update($this->input->post('table'), $data, $where)) {
				$response = "success";
			}else $response = "failed";
		}else{
			$data = array(
				'survey'				=> $this->input->post('id'),
				'typeChart'			=> $this->input->post('typeChart'),
				'basedQ' 				=> $this->input->post('basedQ'),
				'listAns' 			=> $this->input->post('listAns'),
				'minResp'			 	=> $this->input->post('minResp'),
				'target' 				=> $this->input->post('maxResp'),
				'opt'		 				=> $this->input->post('optChart'),
				'title'		 			=> $this->input->post('titleChart'),
				'subtitle'			=> $this->input->post('subtitleChart'),
				'buttonTitle'		=> $this->input->post('buttonTitleChart'),
				'cardCol'		 		=> $this->input->post('cardColChart'),
			);
			if($this->input->post('actionOpt') == "create"){
				if ($this->GeneralMdl->insert($this->input->post('table'), $data)) {
					$response = "success";
				}else $response = "failed";
			}else{
				$where = array(
					'id'	=> $this->input->post('idChart')
				);
				if ($this->GeneralMdl->update($this->input->post('table'), $data, $where)) {
					$response = "success";
				}else $response = "failed";
			}
		}

		echo json_encode($response);
	}

	private function rules(){
		return[
			['field' => 'name', 'label' => 'name', 'rules'=>'required'],
			['field' => 'role', 'label' => 'role', 'rules'=>'required'],
			['field' => 'shift', 'label' => 'shift', 'rules'=>'required']
		];
	}

	public function tes_email(){
		$this->GeneralMdl->sendMail('rayci232@gmail.com','judul','isi tes2');
	}
}