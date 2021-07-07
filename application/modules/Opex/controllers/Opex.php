<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opex extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('OpexModel','mdl');
		$this->load->model('MenuModel');
		$this->load->library('session');
        if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

		$akses= $this->MenuModel->akses_menu2('Opex',$this->session->userdata('id_user_level'));
	    $this->create =  $akses->create;
	    $this->update =  $akses->update;
	    $this->delete =  $akses->delete;
	}

	public function index(){	
		$data = array(		
      		'menu'		=> $this->MenuModel->akses_menu($this->session->userdata('id_user_level'))
		);
		$this->load->view('templates/Header');
		$this->template->load('template','Opex',$data);
		$this->load->view('templates/Footer');
		$this->load->view('templates/_data_js');
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

	public function cek(){
		$tahun = $this->input->post('tahun');
		$compare = $this->input->post('compare');
		$type = 'OPEX';

		$checkTot = $this->mdl->checkTot($type, $compare, $tahun);

		$kolom = 'count(*) as jml_d';
	    $tabel = 'budget';
	    $where = 'where tahun = "'.$tahun.'" and type = "'.$type.'" and compare = "'.$compare.'" ';
	    $join  = '';
	    $order = '';
	    $cek = $this->mdl->select_row($tabel,$join,$where,$kolom,$order);
	    // echo $cek->jml_d;exit();

	    if($this->create == 1){
		    if($cek->jml_d <= 0){
		    	$dt['tahun'] = $tahun;
	            $dt['type'] = $type;
	            $dt['compare'] = $compare;
	            $Budget = $this->mdl->insert('budget',$dt); /*insert ke table budget*/

	            $dt_4['id_budget'] = $Budget;
	            $dt_4['month'] = 4;
	            $_4 = $this->mdl->insert_det('budget_det',$dt_4); 

	            $dt_5['id_budget'] = $Budget;
	            $dt_5['month'] = 5;
	            $_5 = $this->mdl->insert_det('budget_det',$dt_5);

	            $dt_6['id_budget'] = $Budget;
	            $dt_6['month'] = 6;
	            $_6 = $this->mdl->insert_det('budget_det',$dt_6);

	            $dt_7['id_budget'] = $Budget;
	            $dt_7['month'] = 7;
	            $_7 = $this->mdl->insert_det('budget_det',$dt_7);

	            $dt_8['id_budget'] = $Budget;
	            $dt_8['month'] = 8;
	            $_8 = $this->mdl->insert_det('budget_det',$dt_8);

	            $dt_9['id_budget'] = $Budget;
	            $dt_9['month'] = 9;
	            $_9 = $this->mdl->insert_det('budget_det',$dt_9);

	            $dt_10['id_budget'] = $Budget;
	            $dt_10['month'] = 10;
	            $_10 = $this->mdl->insert_det('budget_det',$dt_10);

	            $dt_11['id_budget'] = $Budget;
	            $dt_11['month'] = 11;
	            $_11 = $this->mdl->insert_det('budget_det',$dt_11);

	            $dt_12['id_budget'] = $Budget;
	            $dt_12['month'] = 12;
	            $_12 = $this->mdl->insert_det('budget_det',$dt_12);

	            $dt_1['id_budget'] = $Budget;
	            $dt_1['month'] = 1;
	            $_1 = $this->mdl->insert_det('budget_det',$dt_1);

	            $dt_2['id_budget'] = $Budget;
	            $dt_2['month'] = 2;
	            $_2 = $this->mdl->insert_det('budget_det',$dt_2);

	            $dt_3['id_budget'] = $Budget;
	            $dt_3['month'] = 3;
	            $_3 = $this->mdl->insert_det('budget_det',$dt_3);

		    }
		}
		
		$respone = "sukses";
		$return = array('respone' => $respone);
		echo json_encode($return);
	}

	public function format_angkat($angka){
		$hasil = number_format($angka,0,',','.');
		return $hasil;
	}

	public function table(){
		$tahun = $this->input->post('tahun');
		$compare = $this->input->post('compare');
		$type = 'OPEX';
		
		$checkTot = $this->mdl->checkTot($type, $compare, $tahun);

		$kolom = 'fyb';
	    $tabel = 'budget';
	    $where = 'where tahun = "'.$tahun.'" and type = "'.$type.'" and compare = "'.$compare.'" ';
	    $join  = '';
	    $order = '';
	    $budget = $this->mdl->select_row($tabel,$join,$where,$kolom,$order);

		$tabel="";

		$kolom = 'b.id,a.tahun,a.type,a.fyb,b.month,
				CASE 
						WHEN b.`month` = 1 THEN "Jan"
						WHEN b.`month` = 2 THEN "Feb"
						WHEN b.`month` = 3 THEN "Mar"
						WHEN b.`month` = 4 THEN "Apr"
						WHEN b.`month` = 5 THEN "May"
						WHEN b.`month` = 6 THEN "Jun"
						WHEN b.`month` = 7 THEN "Jul"
						WHEN b.`month` = 8 THEN "Aug"
						WHEN b.`month` = 9 THEN "Sep"
						WHEN b.`month` = 10 THEN "Oct"
						WHEN b.`month` = 11 THEN "Nov"
						ELSE "Des"
					END as month_name,
					CASE
						WHEN b.`month` <= 3 THEN CONCAT(a.tahun+1, "-", "0",b.`month`)
						WHEN b.`month` > 3 AND b.`month` < 10 THEN CONCAT(a.tahun, "-", "0",b.`month`)
						ELSE CONCAT(a.tahun, "-",b.`month`)
					END as th_bl,
					b.plan,
					b.actual,
					b.id_budget'
					;
	    $tabel = 'budget a';
	    $join  = 'LEFT JOIN budget_det b on a.id = b.id_budget';
	    $where = 'WHERE a.tahun = "'.$tahun.'" and a.type = "'.$type.'" and a.compare = "'.$compare.'" ';
	    $order = 'ORDER BY b.id ASC';
	    $data = $this->mdl->select_result($tabel,$join,$where,$kolom,$order);
	    $grp = $data;
	    

	    $urut = 11;
	    $total_plan = 0;
	    $total_actual = 0;
		foreach ($data as $data) {
			$bln = $this->parse_bln($data->month,$tahun);
			$variance = $data->actual-$data->plan;
			if($data->month==4){
				$ytd_plan = $data->plan;
				$ytd_actual = $data->actual;
				$param = array('id' => $data->id);
				$data_upd = array(
			        'ytd_plan' => $ytd_plan,
			        'ytd_actual' => $ytd_actual,
			    );
			    $upd_ytd_plan = $this->mdl->update_2('budget_det',$data_upd,$param);
			}else{
				$get_plan_ytd = $this->mdl->plan_ytd($data->id_budget,$data->month,$data->plan);
				$ytd_plan = $get_plan_ytd->plan_ytd;

				$get_actual_ytd = $this->mdl->actual_ytd($data->id_budget,$data->month,$data->actual);
				$ytd_actual = $get_actual_ytd->actual_ytd;

				$param = array('id' => $data->id);
				$data_upd = array(
			        'ytd_plan' => $ytd_plan,
			        'ytd_actual' => $ytd_actual,
			    );
			    $upd_ytd_plan = $this->mdl->update_2('budget_det',$data_upd,$param);
				
			}
			$ytd_variance = $ytd_actual-$ytd_plan;
			$rm_budget = $checkTot->fyb-$ytd_actual;
			if($urut==0){
				$run_rate = 0;
			}else{
				$run_rate = $rm_budget/$urut;
			}
			if($this->update == 1){
				$tabel.= '
					<tr>
						<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$data->month_name.'</td>
						<td style="text-align:right !important"><button class="btn btn-info btn-md" onclick="modal_update_val(\''.$data->id.'\',\''.$data->plan.'\',\'plan\')">'.$this->format_angkat($data->plan).'</button></td>
						<td style="text-align:right !important"><button class="btn btn-md" style="background-color:#e95753; color:white" onclick="modal_update_val(\''.$data->id.'\',\''.$data->actual.'\',\'actual\')">'.$this->format_angkat($data->actual).'</button></td>
						<td style="text-align:right !important">'.$this->format_angkat($variance).' &nbsp;&nbsp;'.$this->label($variance).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($ytd_plan).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($ytd_actual).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($ytd_variance).' &nbsp;&nbsp;'.$this->label($ytd_variance).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($checkTot->fyb).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($rm_budget).' &nbsp;&nbsp;'.$this->label_rm($rm_budget,$checkTot->fyb).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($run_rate).'</td>
						<td><center>'.$urut.'</center></td>
					</tr>
				';
			}else{
				$tabel.= '
					<tr>
						<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$data->month_name.'</td>
						<td style="text-align:right !important">'.$this->format_angkat($data->plan).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($data->actual).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($variance).' &nbsp;&nbsp;'.$this->label($variance).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($ytd_plan).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($ytd_actual).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($ytd_variance).' &nbsp;&nbsp;'.$this->label($ytd_variance).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($checkTot->fyb).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($rm_budget).' &nbsp;&nbsp;'.$this->label_rm($rm_budget,$checkTot->fyb).'</td>
						<td style="text-align:right !important">'.$this->format_angkat($run_rate).'</td>
						<td><center>'.$urut.'</center></td>
					</tr>
				';
			}
			$total_plan += $data->plan;
			$total_actual += $data->actual;
			$urut--;
		}

		$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</td>
					<td style="text-align:right !important">'.$this->format_angkat($total_plan).'</td>
					<td style="text-align:right !important">'.$this->format_angkat($total_actual).'</td>
					<td colspan="8"></td>
				</tr>
			';

		// print_r($grp);exit();


		// $tabel.= '
  //        <script>

  //           $(document).ready(function() {
  //               jQuery(".main-table").clone(true).appendTo(".table-scroll").addClass("clone"); 
  //           });
  //        </script>
		// ';
		

		
		$respone = "sukses";
		$return = array('respone' => $respone, 'tabel' => $tabel, 'tahun' => $tahun, 'fyb' => $budget->fyb, 'grp'=>$grp);
		echo json_encode($return);
	}

	public function label($angka){
		$lbl='';
		if($angka == 0){
			$lbl='<span class="label label-primary"><i class="fa fa-check"></i></span>';
		}else if($angka > 0){
			$lbl='<span class="label label-danger"><i class="fa fa-angle-double-down"></i></span>';
		}else{
			$lbl='<span class="label label-success"><i class="fa fa-angle-double-up"></i></span>';
		}

		return $lbl;
	}

	public function label_rm($rm_budget,$fyb){
		if($rm_budget == 0 || $fyb == 0){
			$persen = 0;
		}else{
			$persen = ($rm_budget/$fyb)*100;
		}
		

		$lbl='';
		if($persen == 0){
			$lbl='<span class="label label-primary"><i class="fa fa-check"></i></span>';
		}else if($persen <= 10){
			$lbl='<span class="label label-danger"><i class="fa fa-angle-double-down"></i></span>';
		}else{
			$lbl='<span class="label label-success"><i class="fa fa-angle-double-up"></i></span>';
		}

		return $lbl;
	}

	public function update_det(){
		$id = $this->input->post('id');
		$val = $this->input->post('val');
		$f_det = $this->input->post('f_det');

		$compare 	= $this->input->post('compare');
		$tahun 		= $this->input->post('tahun');
		$type 		= "OPEX";

		// echo $month;exit();

		$data = array(
	    $f_det => $val,
		);
		
		$upd = $this->mdl->update('budget_det',$data,$id);

		$checkTot = $this->mdl->checkTot($type, $compare, $tahun);

		$where = array('type' => $type, 'tahun' => $tahun, 'compare' => $compare);

		$data = array(
	    'fyb' => $checkTot->fyb,
	  );

	  $upd2 = $this->mdl->update_2('budget',$data,$where);
	  // echo $cek->jml;exit();
	  if($upd && $upd2){
	    $respone = "sukses";
	  }else{
	    $respone = "gagal";
	  }
	  
	  $return = array('respone' => $respone);
	  echo json_encode($return);
	}

	public function update_fyb(){
		$tahun = $this->input->post('tahun');
		$type = 'OPEX';
		$fyb = $this->input->post('fyb');

		// echo $month;exit();

		$param = array('type' => $type, 'tahun' => $tahun);

		$data = array(
	        'fyb' => $fyb,
	    );

	    $upd = $this->mdl->update_2('budget',$data,$param);
	    // echo $cek->jml;exit();
	    if($upd){
	      $respone = "sukses";
	    }else{
	      $respone = "gagal";
	    }
	    
	    $return = array('respone' => $respone);
	    echo json_encode($return);
	}

	public function download($tahun,$compare){
		$type = 'OPEX';
		
		$checkTot = $this->mdl->checkTot($type, $compare, $tahun);

		$kolom = 'fyb';
	    $tbl = 'budget';
	    $where = 'where tahun = "'.$tahun.'" and type = "'.$type.'" and compare = "'.$compare.'" ';
	    $join  = '';
	    $order = '';
	    $budget = $this->mdl->select_row($tbl,$join,$where,$kolom,$order);

		$tabel="";

		$kolom = 'b.id,a.tahun,a.type,a.fyb,b.month,
				CASE 
						WHEN b.`month` = 1 THEN "Jan"
						WHEN b.`month` = 2 THEN "Feb"
						WHEN b.`month` = 3 THEN "Mar"
						WHEN b.`month` = 4 THEN "Apr"
						WHEN b.`month` = 5 THEN "May"
						WHEN b.`month` = 6 THEN "Jun"
						WHEN b.`month` = 7 THEN "Jul"
						WHEN b.`month` = 8 THEN "Aug"
						WHEN b.`month` = 9 THEN "Sep"
						WHEN b.`month` = 10 THEN "Oct"
						WHEN b.`month` = 11 THEN "Nov"
						ELSE "Des"
					END as month_name,
					CASE
						WHEN b.`month` <= 3 THEN CONCAT(a.tahun+1, "-", "0",b.`month`)
						WHEN b.`month` > 3 AND b.`month` < 10 THEN CONCAT(a.tahun, "-", "0",b.`month`)
						ELSE CONCAT(a.tahun, "-",b.`month`)
					END as th_bl,
					b.plan,
					b.actual,
					b.id_budget'
					;
	    $tabl = 'budget a';
	    $join  = 'LEFT JOIN budget_det b on a.id = b.id_budget';
	    $where = 'WHERE a.tahun = "'.$tahun.'" and a.type = "'.$type.'" and a.compare = "'.$compare.'" ';
	    $order = 'ORDER BY b.id ASC';
	    $data = $this->mdl->select_result($tabl,$join,$where,$kolom,$order);
	    $grp = $data;
	    

	    $urut = 11;
	    $total_plan = 0;
	    $total_actual = 0;
		foreach ($data as $data) {
			$bln = $this->parse_bln($data->month,$tahun);
			$variance = $data->actual-$data->plan;
			if($data->month==4){
				$ytd_plan = $data->plan;
				$ytd_actual = $data->actual;
				$param = array('id' => $data->id);
				$data_upd = array(
			        'ytd_plan' => $ytd_plan,
			        'ytd_actual' => $ytd_actual,
			    );
			    $upd_ytd_plan = $this->mdl->update_2('budget_det',$data_upd,$param);
			}else{
				$get_plan_ytd = $this->mdl->plan_ytd($data->id_budget,$data->month,$data->plan);
				$ytd_plan = $get_plan_ytd->plan_ytd;

				$get_actual_ytd = $this->mdl->actual_ytd($data->id_budget,$data->month,$data->actual);
				$ytd_actual = $get_actual_ytd->actual_ytd;

				$param = array('id' => $data->id);
				$data_upd = array(
			        'ytd_plan' => $ytd_plan,
			        'ytd_actual' => $ytd_actual,
			    );
			    $upd_ytd_plan = $this->mdl->update_2('budget_det',$data_upd,$param);
				
			}
			$ytd_variance = $ytd_actual-$ytd_plan;
			$rm_budget = $checkTot->fyb-$ytd_actual;
			if($urut==0){
				$run_rate = 0;
			}else{
				$run_rate = $rm_budget/$urut;
			}
			
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$data->month_name.'</td>
					<td style="text-align:right !important">'.$this->format_angkat($data->plan).'</td>
					<td style="text-align:right !important">'.$this->format_angkat($data->actual).'</td>
					<td style="text-align:right !important">'.$this->format_angkat($variance).'</td>
					<td style="text-align:right !important">'.$this->format_angkat($ytd_plan).'</td>
					<td style="text-align:right !important">'.$this->format_angkat($ytd_actual).'</td>
					<td style="text-align:right !important">'.$this->format_angkat($ytd_variance).'</td>
					<td style="text-align:right !important">'.$this->format_angkat($checkTot->fyb).'</td>
					<td style="text-align:right !important">'.$this->format_angkat($rm_budget).'</td>
					<td style="text-align:right !important">'.$this->format_angkat($run_rate).'</td>
					<td style="text-align:center !important">'.$urut.'</td>
				</tr>
			';
			
			$total_plan += $data->plan;
			$total_actual += $data->actual;
			$urut--;
		}

		$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</td>
					<td style="text-align:right !important">'.$this->format_angkat($total_plan).'</td>
					<td style="text-align:right !important">'.$this->format_angkat($total_actual).'</td>
					<td colspan="8"></td>
				</tr>
			';
		return $tabel;
	}

	public function excel(){
		$tahun = $_REQUEST["tahun"];
		$compare = $_REQUEST["compare"];

		// echo $aksi;exit();

		if($compare=='plan'){
			$jdl = 'Opex PLAN';
			$ft = 'PLAN';
		}elseif ($compare=='myc') {
			$jdl = 'Opex MYC';
			$ft = 'MYC';
		}else{
			$jdl = 'Opex LBE';
			$ft = 'LBE';
		}
		$data = array(
					'jdl'=>$jdl,
					'tahun'=>$tahun,
					'tabel' => $this->download($tahun,$compare),
					'ft' => $ft
					);

		// echo $type.' '.$tahun;exit();
		$filename =$jdl." ".$tahun.".xls";
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		$this->load->view('Opex/Opex_excel',$data);
		
		
	}

	public function pdf(){
		$tahun = $_REQUEST["tahun"];
		$compare = $_REQUEST["compare"];

		// echo $aksi;exit();

		if($compare=='plan'){
			$jdl = 'Opex PLAN';
			$ft = 'PLAN';
		}elseif ($compare=='myc') {
			$jdl = 'Opex MYC';
			$ft = 'MYC';
		}else{
			$jdl = 'Opex LBE';
			$ft = 'LBE';
		}
		$data = array(
					'jdl'=>$jdl,
					'tahun'=>$tahun,
					'tabel' => $this->download($tahun,$compare),
					'ft' => $ft
					);

		
		$this->load->library('pdf');
		$this->load->view('Opex/Opex_pdf',$data);
		
	}
}