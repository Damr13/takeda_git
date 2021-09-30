<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardEhs extends CI_Controller {

	public function __construct(){
		parent::__construct();   
		date_default_timezone_set('Asia/Jakarta');
			$this->load->model('DashboardModelEhs');
			$this->load->model('MenuModel');
				$this->load->library('session');
				if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}
	}
	public function Index(){
		date_default_timezone_set('Asia/Jakarta');
		$bulanA 	= date("d-m-Y");
		
		// COUNT ALL EMPLOYEE
		$kolom 		= 'count(a.Nama) totemp';
		$tbl 		= 'mstemployee a';
		$join		= 'LEFT JOIN mstdept b ON a.idDept = b.id';
		$where 		= 'WHERE b.DeptCategory = 1';
		$totalEmp 	= $this->DashboardModelEhs->getCountEmp($kolom,$tbl,$join,$where);

		// COUNT ALL OUTSOURCING
		$kolom 		= 'count(a.Nama) totout';
		$tbl 		= 'mstemployee a';
		$join		= 'LEFT JOIN mstdept b ON a.idDept = b.id';
		$where 		= 'WHERE b.DeptCategory = 2';
		$totalOut 	= $this->DashboardModelEhs->getCountOut($kolom,$tbl,$join,$where);

		// GET EMPLOYEE
		$kolom 		= 'ifnull( count( DISTINCT Nama ), 0 ) emp ';
		$tbl 		= 'screening';
		$where 		= 'WHERE DATE_FORMAT(tgl,"%d-%m-%Y") IN ("'.$bulanA .'")
						AND category = "Karyawan" AND Nama IS NOT NULL AND Nama != "" ';
		$order 		= '';
		$employee 	= $this->DashboardModelEhs->getemployee($kolom,$tbl,$where,$order);
		
		// GET Contractor
		$kolom 		= 'ifnull( count( DISTINCT Nama ), 0 ) con ';
		$tbl 		= 'screening';
		$where 		= 'WHERE DATE_FORMAT(tgl,"%d-%m-%Y") IN ("'.$bulanA .'")
						AND category = "Contractor" AND Nama IS NOT NULL AND Nama != "" ';
		$order 		= '';
		$contractor = $this->DashboardModelEhs->getcontractor($kolom,$tbl,$where,$order);
		
		// GET Visitor
		$kolom 		= 'ifnull( count( DISTINCT Nama ), 0 ) vstr ';
		$tbl 		= 'screening';
		$where 		= 'WHERE DATE_FORMAT(tgl,"%d-%m-%Y") IN ("'.$bulanA .'")
						AND category = "Tamu" AND Nama IS NOT NULL AND Nama != "" ';
		$order 		= '';
		$visitor 	= $this->DashboardModelEhs->getvisitor($kolom,$tbl,$where,$order);
		
		// GET Oursourcing
		$kolom 		= 'ifnull( count( DISTINCT Nama ), 0 ) outs ';
		$tbl 		= 'screening';
		$where 		= 'WHERE DATE_FORMAT(tgl,"%d-%m-%Y") IN ("'.$bulanA .'")
						AND category = "Outsourcing" AND Nama IS NOT NULL AND Nama != "" ';
		$order 		= '';
		$outsourcing = $this->DashboardModelEhs->getoutsourcing($kolom,$tbl,$where,$order);

		$data = array(
			'visitor'					=>	$visitor,
			'contractor'				=>	$contractor,
			'employee'					=>	$employee,
			'outsourcing'				=>	$outsourcing,
			'totalEmp'					=>	$totalEmp,
			'totalOut'					=>	$totalOut
		);
		$this->load->view('DashboardEhs/templates/Header');
		$this->template->load('templateDashboard','DashboardEhs',$data);
		$this->load->view('DashboardEhs/templates/Footer');
		$this->load->view('DashboardEhs/_cjs');
		$this->load->view('DashboardEhs/_mjs');
		$this->load->view('DashboardEhs/_data_js');
	}
	public function getPieValue(){
	    $startDate = $this->input->post('startDate');
	    $endDate = $this->input->post('endDate');
	    $col = $this->input->post('col');
	    
	    $get   = $this->DashboardModelEhs->getPieValue($col,$startDate,$endDate);

        if($get){
            $respone = "sukses";
        }else $response = "gagal";
		
		$return = array('respone' => $respone,'pieValue' => $get);
		echo json_encode($return);
	}
	public function getJudgementValue(){
	    $startDate = $this->input->post('startDate');
	    $endDate = $this->input->post('endDate');
	    $get   = $this->DashboardModelEhs->getJudgementVal($startDate,$endDate);

        if($get){
            $response = "sukses";
        }else $response = "gagal";
		
		$return = array('respone' => $response,'judgementVal' => $get);
		echo json_encode($return);
	}
	public function getDeptValue(){
	    $startDate = $this->input->post('startDate');
	    $endDate = $this->input->post('endDate');
	    $get   = $this->DashboardModelEhs->getDeptValue($startDate,$endDate);

        if($get){
            $response = "sukses";
        }else{
			$response = "gagal";
		}
		$return = array('respone' => $response,'deptVal' => $get);
		echo json_encode($return);
	}
	public function getPieValueUncheck(){
	    $cols = $this->input->post('cols');
	    $get   = $this->DashboardModelEhs->getPieValueUncheck($cols);
        if($get){
        	$respone = "sukses";
        }else $response = "gagal";
		$return = array('respone' => $respone,'pieValues' => $get);
		echo json_encode($return);
	}
	public function getStatusByPeople(){
		$startDate = $this->input->post('startDate');
	    $endDate = $this->input->post('endDate');
	    $people = $this->input->post('people');
	    $status = $this->input->post('status');
	    
	    $get   = $this->DashboardModelEhs->getStatusByPeople($status,$people,$startDate,$endDate);

        if($get){
            $response = "sukses";
        }else $response = "gagal";
		
		$return = array('respone' => $response,'listDetail' => $get);
		echo json_encode($return);
	}
	public function getStatusByPeoples(){
	    $peoples = $this->input->post('peoples');
	    $statuss = $this->input->post('statuss');

		if($statuss == 'Have not filled out the form'){
	    	$get   = $this->DashboardModelEhs->get_uncheck($statuss,$peoples);
	    }else{
	    	$get   = $this->DashboardModelEhs->get_check($statuss,$peoples);
	    }
        if($get){
            $response = "sukses";
        }else $response = "gagal";
		
		$return = array('respone' => $response,'listDetails' => $get);
		echo json_encode($return);
	}
}
