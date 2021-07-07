<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capability extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('CapabilityModel','mdl');
		$this->load->model('MenuModel');
		$this->load->library('session');
        if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

		$akses= $this->MenuModel->akses_menu2('Capability',$this->session->userdata('id_user_level'));
	    $this->create =  $akses->create;
	    $this->update =  $akses->update;
	    $this->delete =  $akses->delete;
	}

	public function index(){	
		$data = array(		
      		'menu'		=> $this->MenuModel->akses_menu($this->session->userdata('id_user_level'))
		);
		$this->load->view('templates/Header');
		$this->template->load('template','Capability',$data);
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
	    $tabel = 'capability';
	    $where = 'where tahun = "'.$tahun.'" and type = "'.$type.'" ';
	    $join  = '';
	    $order = '';
	    $cek = $this->mdl->select_row($tabel,$join,$where,$kolom,$order);
	    // echo $cek->jml_d;exit();

	    if($cek->jml_d <= 0){
	    	$dt['tahun'] = $tahun;
            $dt['type'] = $type;
            $Capability = $this->mdl->insert('capability',$dt); /*insert ke table Capability*/

            $dt_tar['id_capability'] = $Capability;
            $dt_tar['type_capability'] = 'Total Capa';
            $target = $this->mdl->insert_det('capability_det',$dt_tar); /*insert ke table Capability_det u total capa*/

            $dt_act['id_capability'] = $Capability;
            $dt_act['type_capability'] = 'Extain';
            $act = $this->mdl->insert_det('capability_det',$dt_act); /*insert ke table Capability_det u extain*/

            $dt_act['id_capability'] = $Capability;
            $dt_act['type_capability'] = 'Closed';
            $act = $this->mdl->insert_det('capability_det',$dt_act); /*insert ke table Capability_det u closed*/

            $dt_act['id_capability'] = $Capability;
            $dt_act['type_capability'] = 'Overdue';
            $act = $this->mdl->insert_det('capability_det',$dt_act); /*insert ke table Capability_det u overdue*/
						
						$dt_act['id_capability'] = $Capability;
            $dt_act['type_capability'] = 'Target Percentage';
            $act = $this->mdl->insert_det('capability_det',$dt_act); /*insert ke table Capability_det u target Percentage*/

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

		$kolom = 'b.id,a.tahun,a.type,b.type_capability,b.apr,b.may,b.jun,b.jul,b.aug,b.sep,b.oct,b.nov,b.dec,b.jan,b.feb,b.mar';
	    $tabel = 'capability a';
	    $join  = 'LEFT JOIN capability_det b on a.id = b.id_capability';
	    $where = 'WHERE a.tahun = "'.$tahun.'" and a.type = "'.$type.'" ';
	    $order = 'ORDER BY b.id ASC';
	    $data = $this->mdl->select_result($tabel,$join,$where,$kolom,$order);

	    $tot_persen=array();
		foreach ($data as $data) {
			$a = array($data->apr,$data->may,$data->jun,$data->jul,$data->aug,$data->sep,$data->oct,$data->nov,$data->dec,$data->jan,$data->feb,$data->mar);
			$tot = array_sum($a);
			$sub_1[]=$data->apr; $sub_2[]=$data->may; $sub_3[]=$data->jun; $sub_4[]=$data->jul; $sub_5[]=$data->aug; $sub_6[]=$data->sep;
			$sub_7[]=$data->oct; $sub_8[]=$data->nov; $sub_9[]=$data->dec; $sub_10[]=$data->jan; $sub_11[]=$data->feb; $sub_12[]=$data->mar;
			$z = ''; $k = 0;
			$btn = "btn-primary";
			if($data->type_capability == "Target Percentage") { 
				if($data->apr > 0) $k++; if($data->may > 0) $k++; if($data->jun > 0) $k++; if($data->jul > 0) $k++; if($data->aug > 0) $k++; if($data->sep > 0) $k++;
				if($data->oct > 0) $k++; if($data->nov > 0) $k++; if($data->dec > 0) $k++; if($data->jan > 0) $k++; if($data->feb > 0) $k++; if($data->mar > 0) $k++;
				if($tot > 0) $tot = round($tot/$k,2);
				else $tot = 0;
				$z = " %";
				$btn = "btn-info";
			};
			$tot_persen[]=$tot;
			if($this->update == 1){
				$tabel.= '
					<tr>
						<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$data->type_capability.'</td>
						<td><center><button class="btn '.$btn.' btn-md" onclick="modal_update_val(\''.$data->type_capability.'\',\''.$data->id.'\',\''.$data->apr.'\',\'apr\',\'April\')">'.$data->apr.$z.'</button></center></td>
						<td><center><button class="btn '.$btn.' btn-md" onclick="modal_update_val(\''.$data->type_capability.'\',\''.$data->id.'\',\''.$data->may.'\',\'may\',\'May\')">'.$data->may.$z.'</button></center></td>
						<td><center><button class="btn '.$btn.' btn-md" onclick="modal_update_val(\''.$data->type_capability.'\',\''.$data->id.'\',\''.$data->jun.'\',\'jun\',\'June\')">'.$data->jun.$z.'</button></center></td>
						<td><center><button class="btn '.$btn.' btn-md" onclick="modal_update_val(\''.$data->type_capability.'\',\''.$data->id.'\',\''.$data->jul.'\',\'jul\',\'July\')">'.$data->jul.$z.'</button></center></td>
						<td><center><button class="btn '.$btn.' btn-md" onclick="modal_update_val(\''.$data->type_capability.'\',\''.$data->id.'\',\''.$data->aug.'\',\'aug\',\'August\')">'.$data->aug.$z.'</button></center></td>
						<td><center><button class="btn '.$btn.' btn-md" onclick="modal_update_val(\''.$data->type_capability.'\',\''.$data->id.'\',\''.$data->sep.'\',\'sep\',\'September\')">'.$data->sep.$z.'</button></center></td>
						<td><center><button class="btn '.$btn.' btn-md" onclick="modal_update_val(\''.$data->type_capability.'\',\''.$data->id.'\',\''.$data->oct.'\',\'oct\',\'October\')">'.$data->oct.$z.'</button></center></td>
						<td><center><button class="btn '.$btn.' btn-md" onclick="modal_update_val(\''.$data->type_capability.'\',\''.$data->id.'\',\''.$data->nov.'\',\'nov\',\'November\')">'.$data->nov.$z.'</button></center></td>
						<td><center><button class="btn '.$btn.' btn-md" onclick="modal_update_val(\''.$data->type_capability.'\',\''.$data->id.'\',\''.$data->dec.'\',\'dec\',\'December\')">'.$data->dec.$z.'</button></center></td>
						<td><center><button class="btn '.$btn.' btn-md" onclick="modal_update_val(\''.$data->type_capability.'\',\''.$data->id.'\',\''.$data->jan.'\',\'jan\',\'January\')">'.$data->jan.$z.'</button></center></td>
						<td><center><button class="btn '.$btn.' btn-md" onclick="modal_update_val(\''.$data->type_capability.'\',\''.$data->id.'\',\''.$data->feb.'\',\'feb\',\'February\')">'.$data->feb.$z.'</button></center></td>
						<td><center><button class="btn '.$btn.' btn-md" onclick="modal_update_val(\''.$data->type_capability.'\',\''.$data->id.'\',\''.$data->mar.'\',\'mar\',\'March\')">'.$data->mar.$z.'</button></center></td>
						<td><center>'.$tot.'</center></td>
					</tr>
				';
			}else{
				$tabel.= '
					<tr>
						<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$data->type_capability.'</td>
						<td><center>'.$data->apr.$z.'</center></td>
						<td><center>'.$data->may.$z.'</center></td>
						<td><center>'.$data->jun.$z.'</center></td>
						<td><center>'.$data->jul.$z.'</center></td>
						<td><center>'.$data->aug.$z.'</center></td>
						<td><center>'.$data->sep.$z.'</center></td>
						<td><center>'.$data->oct.$z.'</center></td>
						<td><center>'.$data->nov.$z.'</center></td>
						<td><center>'.$data->dec.$z.'</center></td>
						<td><center>'.$data->jan.$z.'</center></td>
						<td><center>'.$data->feb.$z.'</center></td>
						<td><center>'.$data->mar.$z.'</center></td>
						<td><center>'.$tot.'</center></td>
					</tr>
				';
			}
			
		}

		// // print_r($sub_1);exit();

		if($sub_1[0]<=0){
			$tot_m1_persen = 0;
		}else{
			$tot_m1_persen = ($sub_1[2]/$sub_1[0])*100;
		}

		if($sub_2[0]<=0){
			$tot_m2_persen = 0;
		}else{
			$tot_m2_persen = ($sub_2[2]/$sub_2[0])*100;
		}

		if($sub_3[0]<=0){
			$tot_m3_persen = 0;
		}else{
			$tot_m3_persen = ($sub_3[2]/$sub_3[0])*100;
		}

		if($sub_4[0]<=0){
			$tot_m4_persen = 0;
		}else{
			$tot_m4_persen = ($sub_4[2]/$sub_4[0])*100;
		}

		if($sub_5[0]<=0){
			$tot_m5_persen = 0;
		}else{
			$tot_m5_persen = ($sub_5[2]/$sub_5[0])*100;
		}

		if($sub_6[0]<=0){
			$tot_m6_persen = 0;
		}else{
			$tot_m6_persen = ($sub_6[2]/$sub_6[0])*100;
		}

		if($sub_7[0]<=0){
			$tot_m7_persen = 0;
		}else{
			$tot_m7_persen = ($sub_7[2]/$sub_7[0])*100;
		}

		if($sub_8[0]<=0){
			$tot_m8_persen = 0;
		}else{
			$tot_m8_persen = ($sub_8[2]/$sub_8[0])*100;
		}

		if($sub_9[0]<=0){
			$tot_m9_persen = 0;
		}else{
			$tot_m9_persen = ($sub_9[2]/$sub_9[0])*100;
		}

		if($sub_10[0]<=0){
			$tot_m10_persen = 0;
		}else{
			$tot_m10_persen = ($sub_10[2]/$sub_10[0])*100;
		}

		if($sub_11[0]<=0){
			$tot_m11_persen = 0;
		}else{
			$tot_m11_persen = ($sub_11[2]/$sub_11[0])*100;
		}

		if($sub_12[0]<=0){
			$tot_m12_persen = 0;
		}else{
			$tot_m12_persen = ($sub_12[2]/$sub_12[0])*100;
		}
		
		if($tot_persen[0]<=0){
			$tot_all_persen = 0;
		}else{
			$tot_all_persen = ($tot_persen[2]/$tot_persen[0])*100;
		}
		
		// DECLARE ACTUAL PERCENTAGE AND EACH INDICATOR PER MONTH --ir
		$tabel.= '
				<tr>
					<td class="fixed-side"> Actual Percentage</td>
		';
		$sub1 = $sub_1[4]; $sub2 = $sub_2[4]; $sub3 = $sub_3[4]; $sub4 = $sub_4[4]; $sub5 = $sub_5[4]; $sub6 = $sub_6[4]; 
		$sub7 = $sub_7[4]; $sub8 = $sub_8[4]; $sub9 = $sub_9[4]; $sub10 = $sub_10[4]; $sub11 = $sub_11[4]; $sub12 = $sub_12[4]; 
		$tarPersen = $tot_persen[4];
		for ($i=0; $i <= 12; $i++) { 
			if($i < 12){
				$targetPercentage = "sub".($i+1);
				$totPercentage 		= "tot_m".($i+1)."_persen";
				$targetPercentage = $$targetPercentage;
				$totPercentage 		= $$totPercentage;
			}else{
				$targetPercentage = $tarPersen;
				$totPercentage 		= $tot_all_persen;
			}
			$targetPercentage = round($targetPercentage,2);
			$totPercentage 		= round($totPercentage,2);

			if($totPercentage < $targetPercentage) $sign = '&nbsp;&nbsp<span class="label label-danger"><i class="fa fa-angle-double-down"></i></span>';
			else if($totPercentage == $targetPercentage && $totPercentage > 0) $sign = '&nbsp;&nbsp<span class="label label-primary"><i class="fa fa-check"></i></span>';
			else if($totPercentage == 0) $sign = '';
			else if($totPercentage > $targetPercentage) $sign = '&nbsp;&nbsp<span class="label label-success"><i class="fa fa-angle-double-up"></i></span>';
			if($i < 12){
				$tabel	.='
					<td><center><button class="btn btn-md" style="background-color:#e95753; color:white" disabled><b>'.$totPercentage.'  %</b></button>'.$sign.'</center></td> 
				';
			}else{
				$tabel	.='
						<td><center>'.$totPercentage.' %'.$sign.'</center></td>
				';
			}
		}
		$tabel.= '
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
			$q	.= "(SELECT b.$month[$i] FROM capability a LEFT JOIN capability_det b ON a.id = b.id_capability WHERE type='$type' AND b.type_capability = 'Total Capa' LIMIT 1) as total_capa, ";
			$q	.= "(SELECT b.$month[$i] FROM capability a LEFT JOIN capability_det b ON a.id = b.id_capability WHERE type='$type' AND b.type_capability = 'Extain' LIMIT 1) as extain, ";
			$q	.= "(SELECT b.$month[$i] FROM capability a LEFT JOIN capability_det b ON a.id = b.id_capability WHERE type='$type' AND b.type_capability = 'Closed' LIMIT 1) as closed, ";
			$q	.= "(SELECT b.$month[$i] FROM capability a LEFT JOIN capability_det b ON a.id = b.id_capability WHERE type='$type' AND b.type_capability = 'Overdue' LIMIT 1) as overdue, ";
			$q	.= "(SELECT b.$month[$i] FROM capability a LEFT JOIN capability_det b ON a.id = b.id_capability WHERE type='$type' AND b.type_capability = 'Target Percentage' LIMIT 1) as target_percentage ";
			$q	.= "FROM capability a ";
			$q	.= "LEFT JOIN capability_det b ON a.id = b.id_capability ";
			if($i == (count($month) - 1)) $q	.= "WHERE type='$type' AND a.tahun = '$tahun' GROUP BY a.id ";
			else $q	.= "WHERE type='$type' AND a.tahun = '$tahun' GROUP BY a.id UNION ALL ";
		}
// 		echo var_dump($q);
		$grp = $this->mdl->select_result2($q);
		
		// CONVERT STDCLASS OBJECT TO ARRAY --ir
		$grp = json_decode(json_encode($grp), true);

		// ADD ACTUAL PERCENTAGE TO ARRAY --ir 
		for ($i=0; $i < count($grp); $i++) { 
			$actualPercentage = "tot_m".($i+1)."_persen";
			$actualPercentage = $$actualPercentage;
			$grp[$i]['actual_percentage'] = round($actualPercentage,2);
		}
		// echo var_dump($grp[0]['actual_percentage']);
		
		$respone = "sukses";
		$return = array('respone' => $respone, 'tabel' => $tabel, 'tahun' => $tahun, 'grp' => $grp);
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

	    $upd = $this->mdl->update('capability_det',$data,$id);
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

		$kolom = 'b.id,a.tahun,a.type,b.type_capability,b.apr,b.may,b.jun,b.jul,b.aug,b.sep,b.oct,b.nov,b.dec,b.jan,b.feb,b.mar';
	    $tbl = 'capability a';
	    $join  = 'LEFT JOIN capability_det b on a.id = b.id_capability';
	    $where = 'WHERE a.tahun = "'.$tahun.'" and a.type = "'.$type.'" ';
	    $order = 'ORDER BY b.id ASC';
	    $data = $this->mdl->select_result($tbl,$join,$where,$kolom,$order);

	    $tot_persen=array();
		foreach ($data as $data) {
			$a = array($data->apr,$data->may,$data->jun,$data->jul,$data->aug,$data->sep,$data->oct,$data->nov,$data->dec,$data->jan,$data->feb,$data->mar);
			$tot = array_sum($a);
			$sub_1[]=$data->apr; $sub_2[]=$data->may; $sub_3[]=$data->jun; $sub_4[]=$data->jul; $sub_5[]=$data->aug; $sub_6[]=$data->sep;
			$sub_7[]=$data->oct; $sub_8[]=$data->nov; $sub_9[]=$data->dec; $sub_10[]=$data->jan; $sub_11[]=$data->feb; $sub_12[]=$data->mar;
			$z = ''; $k = 0;
			$btn = "btn-primary";
			if($data->type_capability == "Target Percentage") { 
				if($data->apr > 0) $k++; if($data->may > 0) $k++; if($data->jun > 0) $k++; if($data->jul > 0) $k++; if($data->aug > 0) $k++; if($data->sep > 0) $k++;
				if($data->oct > 0) $k++; if($data->nov > 0) $k++; if($data->dec > 0) $k++; if($data->jan > 0) $k++; if($data->feb > 0) $k++; if($data->mar > 0) $k++;
				if($tot > 0) $tot = round($tot/$k,2);
				else $tot = 0;
				$z = " %";
				$btn = "btn-info";
			};
			$tot_persen[]=$tot;
			
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$data->type_capability.'</td>
					<td><center>'.$data->apr.$z.'</center></td>
					<td><center>'.$data->may.$z.'</center></td>
					<td><center>'.$data->jun.$z.'</center></td>
					<td><center>'.$data->jul.$z.'</center></td>
					<td><center>'.$data->aug.$z.'</center></td>
					<td><center>'.$data->sep.$z.'</center></td>
					<td><center>'.$data->oct.$z.'</center></td>
					<td><center>'.$data->nov.$z.'</center></td>
					<td><center>'.$data->dec.$z.'</center></td>
					<td><center>'.$data->jan.$z.'</center></td>
					<td><center>'.$data->feb.$z.'</center></td>
					<td><center>'.$data->mar.$z.'</center></td>
					<td><center>'.$tot.'</center></td>
				</tr>
			';
			
		}

		// // print_r($sub_1);exit();

		if($sub_1[0]<=0){
			$tot_m1_persen = 0;
		}else{
			$tot_m1_persen = ($sub_1[2]/$sub_1[0])*100;
		}

		if($sub_2[0]<=0){
			$tot_m2_persen = 0;
		}else{
			$tot_m2_persen = ($sub_2[2]/$sub_2[0])*100;
		}

		if($sub_3[0]<=0){
			$tot_m3_persen = 0;
		}else{
			$tot_m3_persen = ($sub_3[2]/$sub_3[0])*100;
		}

		if($sub_4[0]<=0){
			$tot_m4_persen = 0;
		}else{
			$tot_m4_persen = ($sub_4[2]/$sub_4[0])*100;
		}

		if($sub_5[0]<=0){
			$tot_m5_persen = 0;
		}else{
			$tot_m5_persen = ($sub_5[2]/$sub_5[0])*100;
		}

		if($sub_6[0]<=0){
			$tot_m6_persen = 0;
		}else{
			$tot_m6_persen = ($sub_6[2]/$sub_6[0])*100;
		}

		if($sub_7[0]<=0){
			$tot_m7_persen = 0;
		}else{
			$tot_m7_persen = ($sub_7[2]/$sub_7[0])*100;
		}

		if($sub_8[0]<=0){
			$tot_m8_persen = 0;
		}else{
			$tot_m8_persen = ($sub_8[2]/$sub_8[0])*100;
		}

		if($sub_9[0]<=0){
			$tot_m9_persen = 0;
		}else{
			$tot_m9_persen = ($sub_9[2]/$sub_9[0])*100;
		}

		if($sub_10[0]<=0){
			$tot_m10_persen = 0;
		}else{
			$tot_m10_persen = ($sub_10[2]/$sub_10[0])*100;
		}

		if($sub_11[0]<=0){
			$tot_m11_persen = 0;
		}else{
			$tot_m11_persen = ($sub_11[2]/$sub_11[0])*100;
		}

		if($sub_12[0]<=0){
			$tot_m12_persen = 0;
		}else{
			$tot_m12_persen = ($sub_12[2]/$sub_12[0])*100;
		}
		
		if($tot_persen[0]<=0){
			$tot_all_persen = 0;
		}else{
			$tot_all_persen = ($tot_persen[2]/$tot_persen[0])*100;
		}
		
		// DECLARE ACTUAL PERCENTAGE AND EACH INDICATOR PER MONTH --ir
		$tabel.= '
				<tr>
					<td class="fixed-side"> Actual Percentage</td>
		';
		$sub1 = $sub_1[4]; $sub2 = $sub_2[4]; $sub3 = $sub_3[4]; $sub4 = $sub_4[4]; $sub5 = $sub_5[4]; $sub6 = $sub_6[4]; 
		$sub7 = $sub_7[4]; $sub8 = $sub_8[4]; $sub9 = $sub_9[4]; $sub10 = $sub_10[4]; $sub11 = $sub_11[4]; $sub12 = $sub_12[4]; 
		$tarPersen = $tot_persen[4];
		for ($i=0; $i <= 12; $i++) { 
			if($i < 12){
				$targetPercentage = "sub".($i+1);
				$totPercentage 		= "tot_m".($i+1)."_persen";
				$targetPercentage = $$targetPercentage;
				$totPercentage 		= $$totPercentage;
			}else{
				$targetPercentage = $tarPersen;
				$totPercentage 		= $tot_all_persen;
			}
			$targetPercentage = round($targetPercentage,2);
			$totPercentage 		= round($totPercentage,2);

			
			$tabel	.='
					<td><center>'.$totPercentage.' %</center></td>
			';
		}
		$tabel.= '
				</tr>
			';

		return $tabel;
	}

	public function excel(){
		$tahun = $_REQUEST["tahun"];
		$type = $_REQUEST["type"];

		// echo $aksi;exit();

		if($type=='CAPA_QA'){
			$jdl = 'CAPABILITY QUALITY';
		}else{
			$jdl = 'CAPABILITY EHS';
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
		$this->load->view('Capability/Capability_excel',$data);
		
		
	}

	public function pdf(){
		$tahun = $_REQUEST["tahun"];
		$type = $_REQUEST["type"];

		// echo $aksi;exit();

		if($type=='CAPA_QA'){
			$jdl = 'CAPABILITY QUALITY';
		}else{
			$jdl = 'CAPABILITY EHS';
		}
		$data = array(
					'jdl'=>$jdl,
					'tahun'=>$tahun,
					'tabel' => $this->download($tahun,$type)
					);

		
		$this->load->library('pdf');
		$this->load->view('Capability/Capability_pdf',$data);
		
	}
}