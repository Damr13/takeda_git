<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuditTrail extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('AuditTrailModel','mdl');
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

		$kolom = 'id,machineName';
	    $tabel = 'mst_machine';
	    $where = '';
	    $join  = '';
	    $order = '';
	    $machine = $this->mdl->select_result2($tabel,$join,$where,$kolom,$order);
		$data = array(	
			'machine'	=> $machine,
			'menu'		=> $this->MenuModel->akses_menu($this->session->userdata('id_user_level'))
	  	);
		$this->load->view('AuditTrail/templates/Header');
		$this->template->load('template','AuditTrail', $data);
		$this->load->view('AuditTrail/templates/Footer');
		$this->load->view('AuditTrail/_cjs');
		$this->load->view('AuditTrail/_mjs');
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

	public function Audit_Trail_table(){

		$id_machine = $this->input->post('id_machine');
		$bulan = $this->input->post('bulan');
		$tabel="";

		$tabel.=$this->Audit_Trail_table2($bulan,$id_machine);
		
		$respone = "sukses";
		$return = array('respone' => $respone, 'tabel' => $tabel, 'bulan' => $bulan, 'machine' => $id_machine);
		echo json_encode($return);
	}

	public function Audit_Trail_table2($bulan,$id_machine){
		
		$tabel='';

				$kolom = 'c.machineName, a.date, a.time, a.full_name, a.shift, b.downtimeCode, b.downtimeName, b.downtimeGroup';
			    $tbl = 'audit_trail a';
			    $where = 'WHERE DATE_FORMAT(a.date, "%m-%Y") = "'.$bulan .'" and a.machine = "'.$id_machine .'" ';
			    $join  = 'INNER JOIN mst_downtime b ON a.code = b.id
						  INNER JOIN mst_machine c on a.machine=c.id';
			    $order = 'ORDER BY a.date, c.machineName DESC';
			    $data = $this->mdl->select_result($kolom,$tbl,$join,$where,$order);
			    $no = 1;
			    foreach ($data as $data) {
			    	$tabel.= '
						<tr>
							<td><center>'.$no.'</center></td>
							<td>'.$data->machineName.'</td>
							<td>'.$data->date.'</td>
							<td>'.$data->time.'</td>
							<td><center>'.$data->full_name.'</center></td>
							<td><center>'.$data->shift.'</center></td>
							<td><center>'.$data->downtimeCode.'</center></td>
							<td><center>'.$data->downtimeName.'</center></td>
							<td><center>'.$data->downtimeGroup.'</center></td>';

					$tabel.= '
							</td>
						</tr>
						';

			    	$no++;
			    }

		return $tabel;
	}

	
}