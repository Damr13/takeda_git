<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpt_screening extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Rpt_screeningModel','mdl');
		$this->load->model('MenuModel');
		$this->load->library('form_validation');
		$this->load->library('session');
        if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}
	}

	public function index() {
		
		$data['data'] = $this->mdl->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		// $kolom = 'category';
	    // $tabel = 'category';
	    // $where = '';
	    // $join  = '';
	    // $order = '';
	    // $category = $this->mdl->select_result2($tabel,$where,$kolom,$order);
		// $data = array(	
		// 	'category'	=> $category,
		// 	'menu'		=> $this->MenuModel->akses_menu($this->session->userdata('id_user_level'))
	  	// );
		$this->load->view('Rpt_screening/templates/Header');
		$this->template->load('template','Rpt_screening', $data);
		$this->load->view('Rpt_screening/templates/Footer');
		$this->load->view('Rpt_screening/_cjs');
		$this->load->view('Rpt_screening/_mjs');
	}

	public function parse_bln($bulan,$tahun){
		date_default_timezone_set('Asia/Jakarta');
		$bln = '';
		if ($bulan < 10) {
			$bln = $tahun.'-0'.$bulan;
		}else{
			$bln = $tahun.'-'.$bulan;
		}
		return $bln;
	}

	public function download(){
		$data['data'] = $this->mdl->selectAll();
		// $tabel="";

		// $tabel.=$this->$data;
		$this->load->view('Rpt_screening', $data);
		
		return $data;
	}

	public function excel(){
		// $bulan = $_REQUEST["bulan"];
		// $bulan = $this->input->get('bulan', TRUE);
		// // echo $bulan;exit();
		// if ($bulan){
		// 	$bulan_cari = \DateTime::createFromFormat("m-Y", $bulan)->format("Y-m");
		// }else{
		// 	$bulan_cari = date('Y-m');
		// }
		// $bulan_name = date("F Y", strtotime($bulan_cari));

		// echo $bulan.' '.$bulan_name;exit();

		$jdl = 'REPORT SCREENING';
		
		$data = array(
					'jdl'=>$jdl,
					// 'bulan_name'=>$bulan_name,
					'tabel' => $this->download()
					);

		// echo $type.' '.$tahun;exit();
		$filename =$jdl.".xls";
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		$this->load->view('Rpt_screening/Rpt_screening_excel',$data);
		
		
	}

	// public function pdf(){
	// 	$bulan = $_REQUEST["bulan_table"];
	// 	$id_machine = $_REQUEST["id_machine"];
	// 	if ($bulan){
	// 		$bulan_cari = \DateTime::createFromFormat("m-Y", $bulan)->format("Y-m");
	// 	}else{
	// 		$bulan_cari = date('Y-m');
	// 	}
	// 	$bulan_name = date("F Y", strtotime($bulan_cari));

	// 	$kolom = 'id,machineName';
	//     $tabel = 'mst_machine';
	//     $where = 'WHERE id = '.$id_machine;
	//     $join  = '';
	//     $order = '';
	//     $machine = $this->mdl->select_row($tabel,$join,$where,$kolom,$order);

	// 	$jdl = 'REPORT RESUME : '.$machine->machineName;
		
	// 	$data = array(
	// 				'jdl'=>$jdl,
	// 				'bulan_name'=>$bulan_name,
	// 				'tabel' => $this->download($bulan,$id_machine)
	// 				);

		
	// 	$this->load->library('pdf');
	// 	$this->load->view('RptResume/RptResume_pdf',$data);
		
	// }

	// public function screening_table(){
	// 	$bulan = $this->input->post('bulan');
	// 	$category = $this->input->post('category');
	// 	$judgement = $this->input->post('judgement');
	// 	$tabel="";

	// 	$tabel.=$this->screening_table2($bulan,$category,$judgement);
		
	// 	$respone = "sukses";
	// 	$return = array('respone' => $respone, 'tabel' => $tabel, 'bulan' => $bulan, 'judgement' => $judgement);
	// 	echo json_encode($return);
	// }

	// public function screening_table2($bulan,$category,$judgement){
		
	// 	$tabel='';

	// 			$kolom = 'a.tgl, a.idResponse,a.category, a.Nama, a.Company, a.total_risk, a.total_tracing,a.judgement';
	// 		    $tbl = 'screening a';
	// 		    $where = 'WHERE DATE_FORMAT(a.tgl, "%m-%Y") = "'.$bulan .'" and a.category = "'.$category .'" and a.judgement = "'.$judgement .'"';
	// 		    if($judgement == ''){
	// 				$where='WHERE DATE_FORMAT(a.tgl, "%m-%Y") = "'.$bulan .'" and a.category = "'.$category .'"';
	// 			}
	// 			$order = 'ORDER BY a.tgl DESC';
	// 		    $data = $this->mdl->select_result($kolom,$tbl,$where,$order);
	// 		    $no = 1;
	// 		    foreach ($data as $data) {
	// 		    	$tabel.= '
	// 					<tr>
	// 						<td><center>'.$no.'</center></td>
	// 						<td>'.$data->tgl.'</td>
	// 						<td>'.$data->idResponse.'</td>
	// 						<td><center>'.$data->category.'</center></td>
	// 						<td><center>'.$data->Nama.'</center></td>
	// 						<td><center>'.$data->Company.'</center></td>
	// 						<td><center>'.$data->total_risk.'</center></td>
	// 						<td><center>'.$data->total_tracing.'</center></td>
	// 						<td><center>'.$data->judgement.'</center></td>';

	// 				$tabel.= '
	// 						</td>
	// 					</tr>
	// 					';

	// 		    	$no++;
	// 		    }

	// 	return $tabel;
	// }

	
}