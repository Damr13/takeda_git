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
        $data['dataScreening'] = $this->mdl->selectAll();
		$kolom = 'category';
	    $tabel = 'category';
	    $where = '';
	    $join  = '';
	    $order = '';
	    $category = $this->mdl->select_result2($tabel,$where,$kolom,$order);
		$data = array(	
			'category'	=> $category,
			'menu'		=> $this->MenuModel->akses_menu($this->session->userdata('id_user_level'))
	  	);
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

	public function screening_table(){

		$bulan = $this->input->post('bulan');
		$category = $this->input->post('category');
		$tabel="";

		$tabel.=$this->screening_table2($bulan,$category);
		
		$respone = "sukses";
		$return = array('respone' => $respone, 'tabel' => $tabel, 'bulan' => $bulan);
		echo json_encode($return);
	}

	public function screening_table2($bulan,$category){
		
		$tabel='';

				$kolom = 'a.tgl, a.idResponse,a.category, a.Nama, a.Company, a.total_risk, a.total_tracing,a.judgement';
			    $tbl = 'screening a';
			    $where = 'WHERE DATE_FORMAT(a.tgl, "%m-%Y") = "'.$bulan .'" and a.category = "'.$category .'" ';
			    $order = 'ORDER BY a.tgl DESC';
			    $data = $this->mdl->select_result($kolom,$tbl,$where,$order);
			    $no = 1;
			    foreach ($data as $data) {
			    	$tabel.= '
						<tr>
							<td><center>'.$no.'</center></td>
							<td>'.$data->tgl.'</td>
							<td>'.$data->idResponse.'</td>
							<td><center>'.$data->category.'</center></td>
							<td><center>'.$data->Nama.'</center></td>
							<td><center>'.$data->Company.'</center></td>
							<td><center>'.$data->total_risk.'</center></td>
							<td><center>'.$data->total_tracing.'</center></td>
							<td><center>'.$data->judgement.'</center></td>';

					$tabel.= '
							</td>
						</tr>
						';

			    	$no++;
			    }

		return $tabel;
	}

	
}