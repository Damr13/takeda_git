<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumption extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('ConsumptionModel','mdl');
		$this->load->model('MenuModel');
		$this->load->library('session');
        if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

		$akses= $this->MenuModel->akses_menu2('Consumption',$this->session->userdata('id_user_level'));
	    $this->create =  $akses->create;
	    $this->update =  $akses->update;
	    $this->delete =  $akses->delete;
	}

	public function index(){	
		$data = array(		
      		'menu'		=> $this->MenuModel->akses_menu($this->session->userdata('id_user_level'))
		);
		$this->load->view('templates/Header');
		$this->template->load('template','Consumption',$data);
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
		$type = $this->input->post('type_d');

		$kolom = 'count(*) as jml_d';
	    $tabel = 'consumption';
	    $where = 'where tahun = "'.$tahun.'" and type = "'.$type.'" ';
	    $join  = '';
	    $order = '';
	    $cek = $this->mdl->select_row($tabel,$join,$where,$kolom,$order);
	    // echo $cek->jml_d;exit();

	    if($cek->jml_d <= 0){
	    	$dt['tahun'] = $tahun;
            $dt['type'] = $type;
            $Consumption = $this->mdl->insert('consumption',$dt); /*insert ke table Consumption*/

            $dt_tar['id_consumption'] = $Consumption;
            $dt_tar['type_Consumption'] = 'Target';
            $target = $this->mdl->insert_det('consumption_det',$dt_tar); /*insert ke table Consumption_det u target*/

            $dt_act['id_consumption'] = $Consumption;
            $dt_act['type_consumption'] = 'Actual';
            $act = $this->mdl->insert_det('consumption_det',$dt_act); /*insert ke table Consumption_det u target*/

	    }
		
		$respone = "sukses";
		$return = array('respone' => $respone);
		echo json_encode($return);
	}

	public function table(){
		$tahun = $this->input->post('tahun');
		$type = $this->input->post('type_d');

		$tabel="";

		$sub_1=$sub_2=$sub_3=$sub_4=$sub_5=$sub_6=$sub_7=$sub_8=$sub_9=$sub_10=$sub_11=$sub_12=array();

		$kolom = 'b.id,a.tahun,a.type,b.type_consumption,b.apr,b.may,b.jun,b.jul,b.aug,b.sep,b.oct,b.nov,b.dec,b.jan,b.feb,b.mar';
	    $tabel = 'consumption a';
	    $join  = 'LEFT JOIN consumption_det b on a.id = b.id_consumption';
	    $where = 'WHERE a.tahun = "'.$tahun.'" and a.type = "'.$type.'" ';
	    $order = 'ORDER BY b.id ASC';
	    $data = $this->mdl->select_result($tabel,$join,$where,$kolom,$order);

	    $tot_persen=array();
			$btn = 'class="btn btn-info btn-md"';
		foreach ($data as $data) {
			$a = array($data->apr,$data->may,$data->jun,$data->jul,$data->aug,$data->sep,$data->oct,$data->nov,$data->dec,$data->jan,$data->feb,$data->mar);
			$tot = array_sum($a);
			$tot_persen[]=$tot;
			if($type == "CONS_CAR") $unit = " liters";
			if($type == "CONS_WATER") $unit = " m3";
			if($type == "CONS_ELECTRICITY") $unit = " kWh";
			$sub_1[]=$data->apr; $sub_2[]=$data->may; $sub_3[]=$data->jun; $sub_4[]=$data->jul; $sub_5[]=$data->aug; $sub_6[]=$data->sep;
			$sub_7[]=$data->oct; $sub_8[]=$data->nov; $sub_9[]=$data->dec; $sub_10[]=$data->jan; $sub_11[]=$data->feb; $sub_12[]=$data->mar;
			if($this->update == 1){
				$tabel.= '
					<tr>
						<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$data->type_consumption.'</td>
						<td><center><button '.$btn.' onclick="modal_update_val(\''.$data->type_consumption.'\',\''.$data->id.'\',\''.$data->apr.'\',\'apr\',\'April\')">'.$data->apr.$unit.'</button></center></td>						
						<td><center><button '.$btn.' onclick="modal_update_val(\''.$data->type_consumption.'\',\''.$data->id.'\',\''.$data->may.'\',\'may\',\'May\')">'.$data->may.$unit.'</button></center></td>						
						<td><center><button '.$btn.' onclick="modal_update_val(\''.$data->type_consumption.'\',\''.$data->id.'\',\''.$data->jun.'\',\'jun\',\'June\')">'.$data->jun.$unit.'</button></center></td>					
						<td><center><button '.$btn.' onclick="modal_update_val(\''.$data->type_consumption.'\',\''.$data->id.'\',\''.$data->jul.'\',\'jul\',\'July\')">'.$data->jul.$unit.'</button></center></td>					
						<td><center><button '.$btn.' onclick="modal_update_val(\''.$data->type_consumption.'\',\''.$data->id.'\',\''.$data->aug.'\',\'aug\',\'August\')">'.$data->aug.$unit.'</button></center></td>					
						<td><center><button '.$btn.' onclick="modal_update_val(\''.$data->type_consumption.'\',\''.$data->id.'\',\''.$data->sep.'\',\'sep\',\'September\')">'.$data->sep.$unit.'</button></center></td>			
						<td><center><button '.$btn.' onclick="modal_update_val(\''.$data->type_consumption.'\',\''.$data->id.'\',\''.$data->oct.'\',\'oct\',\'October\')">'.$data->oct.$unit.'</button></center></td>				
						<td><center><button '.$btn.' onclick="modal_update_val(\''.$data->type_consumption.'\',\''.$data->id.'\',\''.$data->nov.'\',\'nov\',\'November\')">'.$data->nov.$unit.'</button></center></td>				
						<td><center><button '.$btn.' onclick="modal_update_val(\''.$data->type_consumption.'\',\''.$data->id.'\',\''.$data->dec.'\',\'dec\',\'December\')">'.$data->dec.$unit.'</button></center></td>				
						<td><center><button '.$btn.' onclick="modal_update_val(\''.$data->type_consumption.'\',\''.$data->id.'\',\''.$data->jan.'\',\'jan\',\'January\')">'.$data->jan.$unit.'</button></center></td>				
						<td><center><button '.$btn.' onclick="modal_update_val(\''.$data->type_consumption.'\',\''.$data->id.'\',\''.$data->feb.'\',\'feb\',\'February\')">'.$data->feb.$unit.'</button></center></td>			
						<td><center><button '.$btn.' onclick="modal_update_val(\''.$data->type_consumption.'\',\''.$data->id.'\',\''.$data->mar.'\',\'mar\',\'March\')">'.$data->mar.$unit.'</button></center></td>					
						<td><center>'.$tot.$unit.'</center></td>
					</tr>
				';
			}else{
				$tabel.= '
					<tr>
						<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$data->type_consumption.'</td>
						<td><center>'.$data->apr.$unit.'</center></td>						
						<td><center>'.$data->may.$unit.'</center></td>						
						<td><center>'.$data->jun.$unit.'</center></td>					
						<td><center>'.$data->jul.$unit.'</center></td>					
						<td><center>'.$data->aug.$unit.'</center></td>					
						<td><center>'.$data->sep.$unit.'</center></td>			
						<td><center>'.$data->oct.$unit.'</center></td>				
						<td><center>'.$data->nov.$unit.'</center></td>				
						<td><center>'.$data->dec.$unit.'</center></td>				
						<td><center>'.$data->jan.$unit.'</center></td>				
						<td><center>'.$data->feb.$unit.'</center></td>			
						<td><center>'.$data->mar.$unit.'</center></td>					
						<td><center>'.$tot.$unit.'</center></td>
					</tr>
				';
			}
			
			$btn = 'class="btn btn-md" style="background-color:#e95753; color:white"';
		}

		// // print_r($sub_1);exit();

		// if($sub_1[0]<=0){
		// 	$tot_m1_persen = 0;
		// }else{
		// 	$tot_m1_persen = ($sub_1[1]/$sub_1[0])*100;
		// }

		// if($sub_2[0]<=0){
		// 	$tot_m2_persen = 0;
		// }else{
		// 	$tot_m2_persen = ($sub_2[1]/$sub_2[0])*100;
		// }

		// if($sub_3[0]<=0){
		// 	$tot_m3_persen = 0;
		// }else{
		// 	$tot_m3_persen = ($sub_3[1]/$sub_3[0])*100;
		// }

		// if($sub_4[0]<=0){
		// 	$tot_m4_persen = 0;
		// }else{
		// 	$tot_m4_persen = ($sub_4[1]/$sub_4[0])*100;
		// }

		// if($sub_5[0]<=0){
		// 	$tot_m5_persen = 0;
		// }else{
		// 	$tot_m5_persen = ($sub_5[1]/$sub_5[0])*100;
		// }

		// if($sub_6[0]<=0){
		// 	$tot_m6_persen = 0;
		// }else{
		// 	$tot_m6_persen = ($sub_6[1]/$sub_6[0])*100;
		// }

		// if($sub_7[0]<=0){
		// 	$tot_m7_persen = 0;
		// }else{
		// 	$tot_m7_persen = ($sub_7[1]/$sub_7[0])*100;
		// }

		// if($sub_8[0]<=0){
		// 	$tot_m8_persen = 0;
		// }else{
		// 	$tot_m8_persen = ($sub_8[1]/$sub_8[0])*100;
		// }

		// if($sub_9[0]<=0){
		// 	$tot_m9_persen = 0;
		// }else{
		// 	$tot_m9_persen = ($sub_9[1]/$sub_9[0])*100;
		// }

		// if($sub_10[0]<=0){
		// 	$tot_m10_persen = 0;
		// }else{
		// 	$tot_m10_persen = ($sub_10[1]/$sub_10[0])*100;
		// }

		// if($sub_11[0]<=0){
		// 	$tot_m11_persen = 0;
		// }else{
		// 	$tot_m11_persen = ($sub_11[1]/$sub_11[0])*100;
		// }

		// if($sub_12[0]<=0){
		// 	$tot_m12_persen = 0;
		// }else{
		// 	$tot_m12_persen = ($sub_12[1]/$sub_12[0])*100;
		// }
		


		// if($tot_persen[0]<=0){
		// 	$tot_all_persen = 0;
		// }else{
		// 	$tot_all_persen = ($tot_persen[1]/$tot_persen[0])*100;
		// }
		

		// $tabel.= '
		// 		<tr>
		// 			<td class="fixed-side">Percentage</td>
		// 			<td><center><b>'.round($tot_m1_persen,2).' %</b></center></td> 
		// 			<td><center><b>'.round($tot_m2_persen,2).' %</b></center></td> 
		// 			<td><center><b>'.round($tot_m3_persen,2).' %</b></center></td> 
		// 			<td><center><b>'.round($tot_m4_persen,2).' %</b></center></td> 
		// 			<td><center><b>'.round($tot_m5_persen,2).' %</b></center></td> 
		// 			<td><center><b>'.round($tot_m6_persen,2).' %</b></center></td>
		// 			<td><center><b>'.round($tot_m7_persen,2).' %</b></center></td> 
		// 			<td><center><b>'.round($tot_m8_persen,2).' %</b></center></td> 
		// 			<td><center><b>'.round($tot_m9_persen,2).' %</b></center></td>
		// 			<td><center><b>'.round($tot_m10_persen,2).' %</b></center></td> 
		// 			<td><center><b>'.round($tot_m11_persen,2).' %</b></center></td> 
		// 			<td><center><b>'.round($tot_m12_persen,2).' %</b></center></td>
		// 			<td><center>'.round($tot_all_persen,2).' %</center></td>
		// 		</tr>
		// 	';
		#akhir

		// echo $tabel;exit();

		// $tabel.= '
  //        <script>

  //           $(document).ready(function() {
  //               jQuery(".main-table").clone(true).appendTo(".table-scroll").addClass("clone"); 
  //           });
  //        </script>
		// ';
		
		// LINE CHART --ir 
		$month	= array('apr','may','jun','jul','aug','sep','oct','nov','dec','jan','feb','mar');

		$k 	= 0;
		$q	= '';
		for ($i=0; $i < count($month); $i++) { 
			$date = date_parse($month[$i]);
			if($date['month'] <= 9) $monthNum = "0".$date['month'];
			else $monthNum = $date['month'];
			if($i > 8) $date = ($tahun+1)."-".$monthNum;
			else $date = $tahun."-".$monthNum;

			$monthName = ucfirst($month[$i]);
			$q	.= "SELECT a.id, tahun, type, '$monthName' as month_name, '$date' as date, ";
			$q	.= "(SELECT b.$month[$i] FROM consumption a LEFT JOIN consumption_det b ON a.id = b.id_consumption WHERE type='$type' AND b.type_consumption = 'Target' LIMIT 1) as target, ";
			$q	.= "(SELECT b.$month[$i] FROM consumption a LEFT JOIN consumption_det b ON a.id = b.id_consumption WHERE type='$type' AND b.type_consumption = 'Actual' LIMIT 1) as actual ";
			$q	.= "FROM consumption a ";
			$q	.= "LEFT JOIN consumption_det b ON a.id = b.id_consumption ";
			if($i == (count($month) - 1)) $q	.= "WHERE type='$type' AND a.tahun = '$tahun' GROUP BY a.id ";
			else $q	.= "WHERE type='$type' AND a.tahun = '$tahun' GROUP BY a.id UNION ALL ";
		}
		//echo var_dump($q);
	    $grp = $this->mdl->select_result2($q);
		
		$respone = "sukses";
		$return = array('respone' => $respone, 'tabel' => $tabel, 'tahun' => $tahun, 'grp' => $grp, 'unit' => $unit);
		echo json_encode($return);
	}

	public function update_det(){
		$id = $this->input->post('id');
		$val = $this->input->post('val');
		$month = $this->input->post('month');

		// echo $month;exit();

		$data = array(
	        $month => $val,
	    );

	    $upd = $this->mdl->update('consumption_det',$data,$id);
	    // echo $cek->jml;exit();
	    if($upd){
	      $respone = "sukses";
	    }else{
	      $respone = "gagal";
	    }
	    
	    $return = array('respone' => $respone);
	    echo json_encode($return);
	}

	public function download($tahun,$type){
		$tabel="";

		$sub_1=$sub_2=$sub_3=$sub_4=$sub_5=$sub_6=$sub_7=$sub_8=$sub_9=$sub_10=$sub_11=$sub_12=array();

		$kolom = 'b.id,a.tahun,a.type,b.type_consumption,b.apr,b.may,b.jun,b.jul,b.aug,b.sep,b.oct,b.nov,b.dec,b.jan,b.feb,b.mar';
	    $tbl = 'consumption a';
	    $join  = 'LEFT JOIN consumption_det b on a.id = b.id_consumption';
	    $where = 'WHERE a.tahun = "'.$tahun.'" and a.type = "'.$type.'" ';
	    $order = 'ORDER BY b.id ASC';
	    $data = $this->mdl->select_result($tbl,$join,$where,$kolom,$order);

	    $tot_persen=array();
			$btn = 'class="btn btn-info btn-md"';
		foreach ($data as $data) {
			$a = array($data->apr,$data->may,$data->jun,$data->jul,$data->aug,$data->sep,$data->oct,$data->nov,$data->dec,$data->jan,$data->feb,$data->mar);
			$tot = array_sum($a);
			$tot_persen[]=$tot;
			if($type == "CONS_CAR") $unit = " liters";
			if($type == "CONS_WATER") $unit = " m3";
			if($type == "CONS_ELECTRICITY") $unit = " kWh";
			$sub_1[]=$data->apr; $sub_2[]=$data->may; $sub_3[]=$data->jun; $sub_4[]=$data->jul; $sub_5[]=$data->aug; $sub_6[]=$data->sep;
			$sub_7[]=$data->oct; $sub_8[]=$data->nov; $sub_9[]=$data->dec; $sub_10[]=$data->jan; $sub_11[]=$data->feb; $sub_12[]=$data->mar;
			
			$tabel.= '
				<tr>
					<td>'.$data->type_consumption.'</td>
					<td><center>'.$data->apr.$unit.'</center></td>						
					<td><center>'.$data->may.$unit.'</center></td>						
					<td><center>'.$data->jun.$unit.'</center></td>					
					<td><center>'.$data->jul.$unit.'</center></td>					
					<td><center>'.$data->aug.$unit.'</center></td>					
					<td><center>'.$data->sep.$unit.'</center></td>			
					<td><center>'.$data->oct.$unit.'</center></td>				
					<td><center>'.$data->nov.$unit.'</center></td>				
					<td><center>'.$data->dec.$unit.'</center></td>				
					<td><center>'.$data->jan.$unit.'</center></td>				
					<td><center>'.$data->feb.$unit.'</center></td>			
					<td><center>'.$data->mar.$unit.'</center></td>					
					<td><center>'.$tot.$unit.'</center></td>
				</tr>
			';
			
			
		}

		return $tabel;
	}

	public function excel(){
		$tahun = $_REQUEST["tahun"];
		$type = $_REQUEST["type"];

		// echo $aksi;exit();

		if($type=='CONS_CAR'){
			$jdl = 'FUEL CONSUMPTION (LITERS)';
		}elseif ($type=='CONS_WATER') {
			$jdl = 'WATER CONSUMPTION (M3)';
		}else{
			$jdl = 'ELECTRICITY CONSUMPTION (KWH)';
		}
		$data = array(
					'jdl'=>$jdl,
					'tahun'=>$tahun,
					'tabel' => $this->download($tahun,$type)
					);

		// echo $type.' '.$tahun;exit();
		$filename =$jdl." ".$tahun.".xls";
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		$this->load->view('Consumption/Consumption_excel',$data);
		
		
	}

	public function pdf(){
		$tahun = $_REQUEST["tahun"];
		$type = $_REQUEST["type"];

		// echo $aksi;exit();

		if($type=='CONS_CAR'){
			$jdl = 'FUEL CONSUMPTION (LITERS)';
		}elseif ($type=='CONS_WATER') {
			$jdl = 'WATER CONSUMPTION (M3)';
		}else{
			$jdl = 'ELECTRICITY CONSUMPTION (KWH)';
		}
		$data = array(
					'jdl'=>$jdl,
					'tahun'=>$tahun,
					'tabel' => $this->download($tahun,$type)
					);

		
		$this->load->library('pdf');
		$this->load->view('Consumption/Consumption_pdf',$data);
		
	}
}