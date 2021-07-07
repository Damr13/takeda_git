<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('LogModel');
		$this->load->library('session');
        if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}
	}

	public function index(){
		$downtimeLists	= $this->LogModel->downtimeLists();
		// print_r($downtimeLists['dtGroup']);exit();
		$logbookLists		= $this->LogModel->logbookLists();
		$picLists				= $this->LogModel->picLists();
		$shiftLists			= $this->LogModel->shiftLists();

		$data = array(			
			'dtGroup' 				=> 	$downtimeLists['dtGroup'],
			'dtGroup0' 				=> 	$downtimeLists['dtGroup0'],
			'dtGroup1' 				=> 	$downtimeLists['dtGroup1'],
			'dtGroup2' 				=> 	$downtimeLists['dtGroup2'],
			'dtGroup3' 				=> 	$downtimeLists['dtGroup3'],
			'dtGroup4' 				=> 	$downtimeLists['dtGroup4'],
			'logbook1' 				=> 	$logbookLists['logbook1'],
			'logbook2' 				=> 	$logbookLists['logbook2'],
			'logbook3' 				=> 	$logbookLists['logbook3'],
			'pic' 					=> 	$picLists,
			'shiftLists' 			=> 	$shiftLists,
		);	

		// print_r($data['shiftLists']);exit();	
		// echo $data;exit();

		// exit();
		$this->load->view('templates/Header');
		$this->template->load('template','Log',$data);
		$this->load->view('templates/Footer');
	}
}