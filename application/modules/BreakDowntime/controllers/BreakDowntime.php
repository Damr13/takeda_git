<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BreakDowntime extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('BreakDowntimeModel','mdl');
		$this->load->model('MenuModel');
		$this->load->library('session');
        if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}
	}

	public function index(){	
		$kolom = 'id,machineName';
	    $tabel = 'mst_machine';
	    $where = '';
	    $join  = '';
	    $order = '';
	    $machine = $this->mdl->select_result2($tabel,$join,$where,$kolom,$order);

	    $data = array(		
      		'machine'  	=>  $machine,
      		'menu'		=> $this->MenuModel->akses_menu($this->session->userdata('id_user_level'))
		);

		$this->load->view('templates/Header');
		$this->template->load('template','BreakDowntime',$data);
		$this->load->view('templates/Footer');
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

	public function BreakDowntime_table(){
		$id_machine = $this->input->post('id_machine');
		$group_downtime = $this->input->post('group_downtime');
		$tahun = $this->input->post('tahun');

		// $jdl='';
		$tabel="";
		if($group_downtime == 'PDT'){
			$jdl='Planned Down Time';
		}elseif ($group_downtime == 'UDT') {
			$jdl='Unplanned Down Time';
		}elseif ($group_downtime == 'IT') {
			$jdl='Idle Time';
		}elseif ($group_downtime == 'UT') {
			$jdl='Utility';
		}

		#mulai
		$downtimeGroup = $group_downtime;
		$data = $this->mdl->data_resume($downtimeGroup);
		$tabel.= '
				<tr>
					<td colspan="14" class="fixed-side"><h5><b>'.$jdl.'</b></h5></td>
				</tr>
				';

		$sub_tt_all = 0;
		$sub_1=$sub_2=$sub_3=$sub_4=$sub_5=$sub_6=$sub_7=$sub_8=$sub_9=$sub_10=$sub_11=$sub_12=0;
		foreach ($data as $data) {
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$data->downtimeCode.'. '.$data->downtimeName.'</td>
			';
			$tot=0;
			$cat = array();
			for ($i=1; $i <=12 ; $i++) { 
				$bln = $this->parse_bln($i,$tahun);
				$data_break = $this->mdl->downtime($bln,$downtimeGroup,$id_machine,$data->id_dg);
				$break = round($data_break->dt,2);
				$tabel.= '
					<td><center>'.$break.'</center></td>
				';
				$tot+= $break;
				$cat[] = round($data_break->dt,2);
			}
			
			$total = round($tot,2);
			$tabel.= '
					<td><center>'.$total.'</center></td>
				</tr>';
			$sub_1+=$cat[0]; $sub_2+=$cat[1]; $sub_3+=$cat[2]; $sub_4+=$cat[3]; $sub_5+=$cat[4]; $sub_6+=$cat[5];
			$sub_7+=$cat[6]; $sub_8+=$cat[7]; $sub_9+=$cat[8]; $sub_10+=$cat[9]; $sub_11+=$cat[10]; $sub_12+=$cat[11];
			$sub_tt_all += $total;

			
		}
		$tabel.= '
				<tr>
					<td class="fixed-side"><b>SUBTOTAL</b></td>
					<td><center><b>'.round($sub_1,2).'</b></center></td> <td><center><b>'.round($sub_2,2).'</b></center></td> <td><center><b>'.round($sub_3,2).'</b></center></td> 

					<td><center><b>'.round($sub_4,2).'</b></center></td> <td><center><b>'.round($sub_5,2).'</b></center></td> <td><center><b>'.round($sub_6,2).'</b></center></td>

					<td><center><b>'.round($sub_7,2).'</b></center></td> <td><center><b>'.round($sub_8,2).'</b></center></td> <td><center><b>'.round($sub_9,2).'</b></center></td>

					<td><center><b>'.round($sub_10,2).'</b></center></td> <td><center><b>'.round($sub_11,2).'</b></center></td> <td><center><b>'.round($sub_12,2).'</b></center></td>

					<td><center>'.round($sub_tt_all,2).'</center></td>
				</tr>
				';
		#akhir

		// echo $tabel;exit();

		// $tabel.= '
  //        <script>

  //           $(document).ready(function() {
  //               jQuery(".main-table").clone(true).appendTo(".table-scroll").addClass("clone"); 
  //           });
  //        </script>
		// ';
		$d_chart = array(
						'Jan' => round($sub_1,2), 
						'Feb' => round($sub_2,2),
						'Mar' => round($sub_3,2),
						'Apr' => round($sub_4,2),
						'May' => round($sub_5,2),
						'Jun' => round($sub_6,2),
						'Jul' => round($sub_7,2),
						'Aug' => round($sub_8,2),
						'Sep' => round($sub_9,2),
						'Oct' => round($sub_10,2),
						'Nov' => round($sub_11,2),
						'Des' => round($sub_12,2),           
						);

		
		$respone = "sukses";
		$return = array('respone' => $respone, 'tabel' => $tabel, 'tahun' => $tahun, 'jdl' => $jdl, 'd_chart' => $d_chart );
		echo json_encode($return);
	}





	public function download($id_machine,$group_downtime,$tahun){

		$tabel="";
		if($group_downtime == 'PDT'){
			$jdl='Planned Down Time';
		}elseif ($group_downtime == 'UDT') {
			$jdl='Unplanned Down Time';
		}elseif ($group_downtime == 'IT') {
			$jdl='Idle Time';
		}elseif ($group_downtime == 'UT') {
			$jdl='Utility';
		}

		#mulai
		$downtimeGroup = $group_downtime;
		$data = $this->mdl->data_resume($downtimeGroup);
		$tabel.= '
				<tr>
					<td colspan="14" class="fixed-side"><h5><b>'.$jdl.'</b></h5></td>
				</tr>
				';

		$sub_tt_all = 0;
		$sub_1=$sub_2=$sub_3=$sub_4=$sub_5=$sub_6=$sub_7=$sub_8=$sub_9=$sub_10=$sub_11=$sub_12=0;
		foreach ($data as $data) {
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$data->downtimeCode.'. '.$data->downtimeName.'</td>
			';
			$tot=0;
			$cat = array();
			for ($i=1; $i <=12 ; $i++) { 
				$bln = $this->parse_bln($i,$tahun);
				$data_break = $this->mdl->downtime($bln,$downtimeGroup,$id_machine,$data->id_dg);
				$break = round($data_break->dt,2);
				$tabel.= '
					<td style="text-align:center !important">'.$break.'</td>
				';
				$tot+= $break;
				$cat[] = round($data_break->dt,2);
			}
			
			$total = round($tot,2);
			$tabel.= '
					<td style="text-align:center !important">'.$total.'</td>
				</tr>';
			$sub_1+=$cat[0]; $sub_2+=$cat[1]; $sub_3+=$cat[2]; $sub_4+=$cat[3]; $sub_5+=$cat[4]; $sub_6+=$cat[5];
			$sub_7+=$cat[6]; $sub_8+=$cat[7]; $sub_9+=$cat[8]; $sub_10+=$cat[9]; $sub_11+=$cat[10]; $sub_12+=$cat[11];
			$sub_tt_all += $total;

			
		}
		$tabel.= '
				<tr>
					<td class="fixed-side"><b>SUBTOTAL</b></td>
					<td style="text-align:center !important"><b>'.round($sub_1,2).'</b></td> 
					<td style="text-align:center !important"><b>'.round($sub_2,2).'</b></td> 
					<td style="text-align:center !important"><b>'.round($sub_3,2).'</b></td> 

					<td style="text-align:center !important"><b>'.round($sub_4,2).'</b></td> 
					<td style="text-align:center !important"><b>'.round($sub_5,2).'</b></td> 
					<td style="text-align:center !important"><b>'.round($sub_6,2).'</b></td>

					<td style="text-align:center !important"><b>'.round($sub_7,2).'</b></td> 
					<td style="text-align:center !important"><b>'.round($sub_8,2).'</b></td> 
					<td style="text-align:center !important"><b>'.round($sub_9,2).'</b></td>

					<td style="text-align:center !important"><b>'.round($sub_10,2).'</b></td> 
					<td style="text-align:center !important"><b>'.round($sub_11,2).'</b></td> 
					<td style="text-align:center !important"><b>'.round($sub_12,2).'</b></td>

					<td style="text-align:center !important">'.round($sub_tt_all,2).'</td>
				</tr>
				';
		#akhir

		return $tabel;
	}

	public function excel(){
		$tahun = $_REQUEST["tahun"];
		$group_downtime = $_REQUEST["group_downtime"];
		$id_machine = $_REQUEST["id_machine"];

		$kolom = 'id,machineName';
	    $tabel = 'mst_machine';
	    $where = 'WHERE id = '.$id_machine;
	    $join  = '';
	    $order = '';
	    $machine = $this->mdl->select_row($tabel,$join,$where,$kolom,$order);

	    
		$machine = 'Machine : '.$machine->machineName;

		if($group_downtime == 'PDT'){
			$jdl = 'DOWNTIME CATEGORY : Planned Down Time';
		}elseif ($group_downtime == 'UDT') {
			$jdl = 'DOWNTIME CATEGORY : Unplanned Down Time';
		}elseif ($group_downtime == 'IT') {
			$jdl = 'DOWNTIME CATEGORY : Idle Time';
		}else{
			$jdl = 'DOWNTIME CATEGORY : Utility';
		}
		
		
		$data = array(
					'jdl'=>$jdl,
					'tahun'=>$tahun,
					'machine'=>$machine,
					'tabel' => $this->download($id_machine,$group_downtime,$tahun)
					);

		// echo $type.' '.$tahun;exit();
		$filename =$jdl." ".$machine." ".$tahun.".xls";
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		$this->load->view('BreakDowntime/BreakDowntime_excel',$data);
		
		
	}

	public function pdf(){
		$tahun = $_REQUEST["tahun"];
		$group_downtime = $_REQUEST["group_downtime"];
		$id_machine = $_REQUEST["id_machine"];

		$kolom = 'id,machineName';
	    $tabel = 'mst_machine';
	    $where = 'WHERE id = '.$id_machine;
	    $join  = '';
	    $order = '';
	    $machine = $this->mdl->select_row($tabel,$join,$where,$kolom,$order);

	    
		$machine = 'Machine : '.$machine->machineName;

		if($group_downtime == 'PDT'){
			$jdl = 'DOWNTIME CATEGORY : Planned Down Time';
		}elseif ($group_downtime == 'UDT') {
			$jdl = 'DOWNTIME CATEGORY : Unplanned Down Time';
		}elseif ($group_downtime == 'IT') {
			$jdl = 'DOWNTIME CATEGORY : Idle Time';
		}else{
			$jdl = 'DOWNTIME CATEGORY : Utility';
		}
		
		
		$data = array(
					'jdl'=>$jdl,
					'tahun'=>$tahun,
					'machine'=>$machine,
					'tabel' => $this->download($id_machine,$group_downtime,$tahun)
					);

		
		$this->load->library('pdf');
		$this->load->view('BreakDowntime/BreakDowntime_pdf',$data);
		
	}
}