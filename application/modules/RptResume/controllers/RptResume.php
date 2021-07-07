<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RptResume extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('RptResumeModel','mdl');
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
      		'machine'  =>  $machine,
      		'menu'		=> $this->MenuModel->akses_menu($this->session->userdata('id_user_level'))
		);

		$this->load->view('templates/Header');
		$this->template->load('template','RptResume',$data);
		$this->load->view('templates/Footer');
	}

	public function parse_tgl($i,$bulan){
		$tgl = '';
		if ($i<10) {
			$tgl = '0'.$i.'-'.$bulan;
		}else{
			$tgl = $i.'-'.$bulan;
		}
		$tgl = date("Y-m-d", strtotime($tgl));
		return $tgl;
	}

	public function RptResume_table(){
		$bulan = $this->input->post('bulan');
		$id_machine = $this->input->post('id_machine');
		date_default_timezone_set('Asia/Jakarta');
		if ($bulan){
			$bulan_cari = \DateTime::createFromFormat("m-Y", $bulan)->format("Y-m");
		}else{
			$bulan_cari = date('Y-m');
		}
		$bulan_name = date("F Y", strtotime($bulan_cari));


		$tabel="";

		$downtimeGroup_RT = 'RT';
		$dataRT = $this->mdl->data_resume($downtimeGroup_RT);
		$tabel.= '
				<tr>
					<td colspan="33" class="fixed-side"><b>1 RUN MESIN</b></td>
				</tr>
				';
		$sub_rt_1=$sub_rt_2=$sub_rt_3=$sub_rt_4=$sub_rt_5=$sub_rt_6=$sub_rt_7=$sub_rt_8=$sub_rt_9=$sub_rt_10=$sub_rt_11=$sub_rt_12=$sub_rt_13=$sub_rt_14=$sub_rt_15=0;
		$sub_rt_16=$sub_rt_17=$sub_rt_18=$sub_rt_19=$sub_rt_20=$sub_rt_21=$sub_rt_22=$sub_rt_23=$sub_rt_24=$sub_rt_25=$sub_rt_26=$sub_rt_27=$sub_rt_28=$sub_rt_29=$sub_rt_30=0;
		$sub_rt_31=0;
		$sub_rt_tt_all = 0;
		foreach ($dataRT as $RT) {
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$RT->id.'. '.$RT->downtimeCode.'. '.$RT->downtimeName.'</td>
								';
			$tot=0;
			$sub = array();
			for ($i=1; $i <= 31 ; $i++) { 
				$tgl = $this->parse_tgl($i,$bulan);
				$dt_RT = $this->mdl->downtime($tgl,$id_machine,$RT->id);
				$break = round($dt_RT->dt,2);
				$tabel.= '
						<td><center>'.$break.'</center></td>
				';
				$tot+=$break;
				$sub[] = round($dt_RT->dt,2);
			}
			$total = round($tot,2);
			$tabel.= '
					<td><center>'.round($tot,2).'</center></td>
	            </tr>
			';
			$sub_rt_1+=$sub[0]; $sub_rt_2+=$sub[1]; $sub_rt_3+=$sub[2]; $sub_rt_4+=$sub[3]; $sub_rt_5+=$sub[4]; $sub_rt_6+=$sub[5];
			$sub_rt_7+=$sub[6]; $sub_rt_8+=$sub[7]; $sub_rt_9+=$sub[8]; $sub_rt_10+=$sub[9]; $sub_rt_11+=$sub[10]; $sub_rt_12+=$sub[11];
			$sub_rt_13+=$sub[12];$sub_rt_14+=$sub[13];$sub_rt_15+=$sub[14];$sub_rt_16+=$sub[15];$sub_rt_17+=$sub[16];$sub_rt_18+=$sub[17];
			$sub_rt_19+=$sub[18];$sub_rt_20+=$sub[19];$sub_rt_21+=$sub[20];$sub_rt_22+=$sub[21];$sub_rt_23+=$sub[22];$sub_rt_24+=$sub[23];
			$sub_rt_25+=$sub[24];$sub_rt_26+=$sub[25];$sub_rt_27+=$sub[26];$sub_rt_28+=$sub[27];$sub_rt_29+=$sub[28];$sub_rt_30+=$sub[29];
			$sub_rt_31+=$sub[30];
			$sub_rt_tt_all += $total;
		}
		#akhir RT

		#mulai PDT
		$downtimeGroup_PDT = 'PDT';
		$dataPDT = $this->mdl->data_resume($downtimeGroup_PDT);
		$tabel.= '
				<tr>
					<td colspan="33" class="fixed-side"><b>2 PLANNED DOWN TIME (PDT)</b></td>
				</tr>
				';
		$sub_pdt_1=$sub_pdt_2=$sub_pdt_3=$sub_pdt_4=$sub_pdt_5=$sub_pdt_6=$sub_pdt_7=$sub_pdt_8=$sub_pdt_9=$sub_pdt_10=$sub_pdt_11=$sub_pdt_12=$sub_pdt_13=$sub_pdt_14=$sub_pdt_15=0;
		$sub_pdt_16=$sub_pdt_17=$sub_pdt_18=$sub_pdt_19=$sub_pdt_20=$sub_pdt_21=$sub_pdt_22=$sub_pdt_23=$sub_pdt_24=$sub_pdt_25=$sub_pdt_26=$sub_pdt_27=$sub_pdt_28=$sub_pdt_29=$sub_pdt_30=0;
		$sub_pdt_31=0;
		$sub_pdt_tt_all = 0;
		foreach ($dataPDT as $PDT) {
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$PDT->downtimeCode.'. '.$PDT->downtimeName.'</td>
								';
			$tot=0;
			$sub = array();
			for ($i=1; $i <= 31 ; $i++) { 
				$tgl = $this->parse_tgl($i,$bulan);
				$dt_RT = $this->mdl->downtime($tgl,$id_machine,$PDT->id);
				$break = round($dt_RT->dt,2);
				$tabel.= '
						<td><center>'.$break.'</center></td>
				';
				$tot+=$break;
				$sub[] = round($dt_RT->dt,2);
			}
			$total = round($tot,2);
			$tabel.= '
					<td><center>'.$total.'</center></td>
	            </tr>
			';
			$sub_pdt_1+=$sub[0]; $sub_pdt_2+=$sub[1]; $sub_pdt_3+=$sub[2]; $sub_pdt_4+=$sub[3]; $sub_pdt_5+=$sub[4]; $sub_pdt_6+=$sub[5];
			$sub_pdt_7+=$sub[6]; $sub_pdt_8+=$sub[7]; $sub_pdt_9+=$sub[8]; $sub_pdt_10+=$sub[9]; $sub_pdt_11+=$sub[10]; $sub_pdt_12+=$sub[11];
			$sub_pdt_13+=$sub[12];$sub_pdt_14+=$sub[13];$sub_pdt_15+=$sub[14];$sub_pdt_16+=$sub[15];$sub_pdt_17+=$sub[16];$sub_pdt_18+=$sub[17];
			$sub_pdt_19+=$sub[18];$sub_pdt_20+=$sub[19];$sub_pdt_21+=$sub[20];$sub_pdt_22+=$sub[21];$sub_pdt_23+=$sub[22];$sub_pdt_24+=$sub[23];
			$sub_pdt_25+=$sub[24];$sub_pdt_26+=$sub[25];$sub_pdt_27+=$sub[26];$sub_pdt_28+=$sub[27];$sub_pdt_29+=$sub[28];$sub_pdt_30+=$sub[29];
			$sub_pdt_31+=$sub[30];
			$sub_pdt_tt_all += $total;
		}
		$tabel.= '
				<tr>
					<td class="fixed-side"><b>SUBTOTAL</b></td>
					<td><center>'.round($sub_pdt_1,2).'</center></td> <td>'.round($sub_pdt_2,2).'</td> <td><center>'.round($sub_pdt_3,2).'</center></td> 
					<td><center>'.round($sub_pdt_4,2).'</center></td> <td><center>'.round($sub_pdt_5,2).'</center></td> <td><center>'.round($sub_pdt_6,2).'</center></td> 
					<td><center>'.round($sub_pdt_7,2).'</center></td> <td><center>'.round($sub_pdt_8,2).'</center></td> <td><center>'.round($sub_pdt_9,2).'</center></td> 
					<td><center>'.round($sub_pdt_10,2).'</center></td> <td><center>'.round($sub_pdt_11,2).'</center></td> <td><center>'.round($sub_pdt_12,2).'</center></td> 
					<td><center>'.round($sub_pdt_13,2).'</center></td> <td><center>'.round($sub_pdt_14,2).'</center></td> <td><center>'.round($sub_pdt_15,2).'</center></td>
					<td><center>'.round($sub_pdt_16,2).'</center></td> <td><center>'.round($sub_pdt_17,2).'</center></td> <td><center>'.round($sub_pdt_18,2).'</center></td> 
					<td><center>'.round($sub_pdt_19,2).'</center></td> <td><center>'.round($sub_pdt_20,2).'</center></td> <td><center>'.round($sub_pdt_21,2).'</center></td> 
					<td><center>'.round($sub_pdt_22,2).'</center></td> <td><center>'.round($sub_pdt_23,2).'</center></td> <td><center>'.round($sub_pdt_24,2).'</center></td> 
					<td><center>'.round($sub_pdt_25,2).'</center></td> <td><center>'.round($sub_pdt_26,2).'</center></td> <td><center>'.round($sub_pdt_27,2).'</center></td> 
					<td><center>'.round($sub_pdt_28,2).'</center></td> <td><center>'.round($sub_pdt_29,2).'</center></td> <td><center>'.round($sub_pdt_30,2).'</center></td> 
					<td><center>'.round($sub_pdt_31,2).'</center></td> 
					<td><center>'.round($sub_pdt_tt_all,2).'</center></td>
				</tr>
				';
		#akhir PDT

		#mulai UDT
		$downtimeGroup_UDT = 'UDT';
		$dataUDT = $this->mdl->data_resume($downtimeGroup_UDT);
		$tabel.= '
				<tr>
					<td colspan="33" class="fixed-side"><b>3.UNPLANNED DOWN TIME (UPDT)</b></td>
				</tr>
				';

		$sub_udt_1=$sub_udt_2=$sub_udt_3=$sub_udt_4=$sub_udt_5=$sub_udt_6=$sub_udt_7=$sub_udt_8=$sub_udt_9=$sub_udt_10=$sub_udt_11=$sub_udt_12=$sub_udt_13=$sub_udt_14=$sub_udt_15=0;
		$sub_udt_16=$sub_udt_17=$sub_udt_18=$sub_udt_19=$sub_udt_20=$sub_udt_21=$sub_udt_22=$sub_udt_23=$sub_udt_24=$sub_udt_25=$sub_udt_26=$sub_udt_27=$sub_udt_28=$sub_udt_29=$sub_udt_30=0;
		$sub_udt_31=0;
		$sub_udt_tt_all = 0;
		foreach ($dataUDT as $UDT) {
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$UDT->downtimeCode.'. '.$UDT->downtimeName.'</td>
								';
			$tot=0;
			$sub = array();
			for ($i=1; $i <= 31 ; $i++) { 
				$tgl = $this->parse_tgl($i,$bulan);
				$dt_RT = $this->mdl->downtime($tgl,$id_machine,$UDT->id);
				$break = round($dt_RT->dt,2);
				$tabel.= '
						<td><center>'.$break.'</center></td>
				';
				$tot+=$break;
				$sub[] = round($dt_RT->dt,2);
			}
			$total = round($tot,2);
			$tabel.= '
					<td><center>'.$total.'</center></td>
	            </tr>
			';
			$sub_udt_1+=$sub[0]; $sub_udt_2+=$sub[1]; $sub_udt_3+=$sub[2]; $sub_udt_4+=$sub[3]; $sub_udt_5+=$sub[4]; $sub_udt_6+=$sub[5];
			$sub_udt_7+=$sub[6]; $sub_udt_8+=$sub[7]; $sub_udt_9+=$sub[8]; $sub_udt_10+=$sub[9]; $sub_udt_11+=$sub[10]; $sub_udt_12+=$sub[11];
			$sub_udt_13+=$sub[12];$sub_udt_14+=$sub[13];$sub_udt_15+=$sub[14];$sub_udt_16+=$sub[15];$sub_udt_17+=$sub[16];$sub_udt_18+=$sub[17];
			$sub_udt_19+=$sub[18];$sub_udt_20+=$sub[19];$sub_udt_21+=$sub[20];$sub_udt_22+=$sub[21];$sub_udt_23+=$sub[22];$sub_udt_24+=$sub[23];
			$sub_udt_25+=$sub[24];$sub_udt_26+=$sub[25];$sub_udt_27+=$sub[26];$sub_udt_28+=$sub[27];$sub_udt_29+=$sub[28];$sub_udt_30+=$sub[29];
			$sub_udt_31+=$sub[30];
			$sub_udt_tt_all += $total;
		}
		$tabel.= '
				<tr>
					<td class="fixed-side"><b>SUBTOTAL</b></td>
					<td><center>'.round($sub_udt_1,2).'</center></td> <td>'.round($sub_udt_2,2).'</td> <td><center>'.round($sub_udt_3,2).'</center></td> 
					<td><center>'.round($sub_udt_4,2).'</center></td> <td><center>'.round($sub_udt_5,2).'</center></td> <td><center>'.round($sub_udt_6,2).'</center></td> 
					<td><center>'.round($sub_udt_7,2).'</center></td> <td><center>'.round($sub_udt_8,2).'</center></td> <td><center>'.round($sub_udt_9,2).'</center></td> 
					<td><center>'.round($sub_udt_10,2).'</center></td> <td><center>'.round($sub_udt_11,2).'</center></td> <td><center>'.round($sub_udt_12,2).'</center></td> 
					<td><center>'.round($sub_udt_13,2).'</center></td> <td><center>'.round($sub_udt_14,2).'</center></td> <td><center>'.round($sub_udt_15,2).'</center></td>
					<td><center>'.round($sub_udt_16,2).'</center></td> <td><center>'.round($sub_udt_17,2).'</center></td> <td><center>'.round($sub_udt_18,2).'</center></td> 
					<td><center>'.round($sub_udt_19,2).'</center></td> <td><center>'.round($sub_udt_20,2).'</center></td> <td><center>'.round($sub_udt_21,2).'</center></td> 
					<td><center>'.round($sub_udt_22,2).'</center></td> <td><center>'.round($sub_udt_23,2).'</center></td> <td><center>'.round($sub_udt_24,2).'</center></td> 
					<td><center>'.round($sub_udt_25,2).'</center></td> <td><center>'.round($sub_udt_26,2).'</center></td> <td><center>'.round($sub_udt_27,2).'</center></td> 
					<td><center>'.round($sub_udt_28,2).'</center></td> <td><center>'.round($sub_udt_29,2).'</center></td> <td><center>'.round($sub_udt_30,2).'</center></td> 
					<td><center>'.round($sub_udt_31,2).'</center></td> 
					<td><center>'.round($sub_udt_tt_all,2).'</center></td>
				</tr>
				';
		#akhir UDT

		#mulai IT
		$downtimeGroup_IT = 'IT';
		$dataIT = $this->mdl->data_resume($downtimeGroup_IT);
		$tabel.= '
				<tr>
					<td colspan="33" class="fixed-side"><b>4.WAITING/ IDLE TIME</b></td>
				</tr>
				';

		$sub_it_1=$sub_it_2=$sub_it_3=$sub_it_4=$sub_it_5=$sub_it_6=$sub_it_7=$sub_it_8=$sub_it_9=$sub_it_10=$sub_it_11=$sub_it_12=$sub_it_13=$sub_it_14=$sub_it_15=0;
		$sub_it_16=$sub_it_17=$sub_it_18=$sub_it_19=$sub_it_20=$sub_it_21=$sub_it_22=$sub_it_23=$sub_it_24=$sub_it_25=$sub_it_26=$sub_it_27=$sub_it_28=$sub_it_29=$sub_it_30=0;
		$sub_it_31=0;
		$sub_it_tt_all = 0;
		foreach ($dataIT as $IT) {
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$IT->downtimeCode.'. '.$IT->downtimeName.'</td>
								';
			$tot=0;
			$sub = array();
			for ($i=1; $i <= 31 ; $i++) { 
				$tgl = $this->parse_tgl($i,$bulan);
				$dt_RT = $this->mdl->downtime($tgl,$id_machine,$IT->id);
				$break = round($dt_RT->dt,2);
				$tabel.= '
						<td><center>'.$break.'</center></td>
				';
				$tot+=$break;
				$sub[] = round($dt_RT->dt,2);
			}
			$total = round($tot,2);
			$tabel.= '
					<td><center>'.$total.'</center></td>
	            </tr>
			';
			$sub_it_1+=$sub[0]; $sub_it_2+=$sub[1]; $sub_it_3+=$sub[2]; $sub_it_4+=$sub[3]; $sub_it_5+=$sub[4]; $sub_it_6+=$sub[5];
			$sub_it_7+=$sub[6]; $sub_it_8+=$sub[7]; $sub_it_9+=$sub[8]; $sub_it_10+=$sub[9]; $sub_it_11+=$sub[10]; $sub_it_12+=$sub[11];
			$sub_it_13+=$sub[12];$sub_it_14+=$sub[13];$sub_it_15+=$sub[14];$sub_it_16+=$sub[15];$sub_it_17+=$sub[16];$sub_it_18+=$sub[17];
			$sub_it_19+=$sub[18];$sub_it_20+=$sub[19];$sub_it_21+=$sub[20];$sub_it_22+=$sub[21];$sub_it_23+=$sub[22];$sub_it_24+=$sub[23];
			$sub_it_25+=$sub[24];$sub_it_26+=$sub[25];$sub_it_27+=$sub[26];$sub_it_28+=$sub[27];$sub_it_29+=$sub[28];$sub_it_30+=$sub[29];
			$sub_it_31+=$sub[30];
			$sub_it_tt_all += $total;
		}
		$tabel.= '
				<tr>
					<td class="fixed-side"><b>SUBTOTAL</b></td>
					<td><center>'.round($sub_it_1,2).'</center></td> <td>'.round($sub_it_2,2).'</td> <td><center>'.round($sub_it_3,2).'</center></td> 
					<td><center>'.round($sub_it_4,2).'</center></td> <td><center>'.round($sub_it_5,2).'</center></td> <td><center>'.round($sub_it_6,2).'</center></td> 
					<td><center>'.round($sub_it_7,2).'</center></td> <td><center>'.round($sub_it_8,2).'</center></td> <td><center>'.round($sub_it_9,2).'</center></td> 
					<td><center>'.round($sub_it_10,2).'</center></td> <td><center>'.round($sub_it_11,2).'</center></td> <td><center>'.round($sub_it_12,2).'</center></td> 
					<td><center>'.round($sub_it_13,2).'</center></td> <td><center>'.round($sub_it_14,2).'</center></td> <td><center>'.round($sub_it_15,2).'</center></td>
					<td><center>'.round($sub_it_16,2).'</center></td> <td><center>'.round($sub_it_17,2).'</center></td> <td><center>'.round($sub_it_18,2).'</center></td> 
					<td><center>'.round($sub_it_19,2).'</center></td> <td><center>'.round($sub_it_20,2).'</center></td> <td><center>'.round($sub_it_21,2).'</center></td> 
					<td><center>'.round($sub_it_22,2).'</center></td> <td><center>'.round($sub_it_23,2).'</center></td> <td><center>'.round($sub_it_24,2).'</center></td> 
					<td><center>'.round($sub_it_25,2).'</center></td> <td><center>'.round($sub_it_26,2).'</center></td> <td><center>'.round($sub_it_27,2).'</center></td> 
					<td><center>'.round($sub_it_28,2).'</center></td> <td><center>'.round($sub_it_29,2).'</center></td> <td><center>'.round($sub_it_30,2).'</center></td> 
					<td><center>'.round($sub_it_31,2).'</center></td> 
					<td><center>'.round($sub_it_tt_all,2).'</center></td>
				</tr>
				';
		#akhir IT

		#mulai UT
		$downtimeGroup_UT = 'UT';
		$dataUT = $this->mdl->data_resume($downtimeGroup_UT);
		$tabel.= '
				<tr>
					<td colspan="33" class="fixed-side"><b>5.UTILITY</b></td>
				</tr>
				';

		$sub_ut_1=$sub_ut_2=$sub_ut_3=$sub_ut_4=$sub_ut_5=$sub_ut_6=$sub_ut_7=$sub_ut_8=$sub_ut_9=$sub_ut_10=$sub_ut_11=$sub_ut_12=$sub_ut_13=$sub_ut_14=$sub_ut_15=0;
		$sub_ut_16=$sub_ut_17=$sub_ut_18=$sub_ut_19=$sub_ut_20=$sub_ut_21=$sub_ut_22=$sub_ut_23=$sub_ut_24=$sub_ut_25=$sub_ut_26=$sub_ut_27=$sub_ut_28=$sub_ut_29=$sub_ut_30=0;
		$sub_ut_31=0;
		$sub_ut_tt_all = 0;
		foreach ($dataUT as $UT) {
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$UT->downtimeCode.'. '.$UT->downtimeName.'</td>
								';
			$tot=0;
			$sub = array();
			for ($i=1; $i <= 31 ; $i++) { 
				$tgl = $this->parse_tgl($i,$bulan);
				$dt_RT = $this->mdl->downtime($tgl,$id_machine,$UT->id);
				$break = round($dt_RT->dt,2);
				$tabel.= '
						<td><center>'.$break.'</center></td>
				';
				$tot+=$break;
				$sub[] = round($dt_RT->dt,2);
			}
			$total = round($tot,2);
			$tabel.= '
					<td><center>'.$total.'</center></td>
	            </tr>
			';
			$sub_ut_1+=$sub[0]; $sub_ut_2+=$sub[1]; $sub_ut_3+=$sub[2]; $sub_ut_4+=$sub[3]; $sub_ut_5+=$sub[4]; $sub_ut_6+=$sub[5];
			$sub_ut_7+=$sub[6]; $sub_ut_8+=$sub[7]; $sub_ut_9+=$sub[8]; $sub_ut_10+=$sub[9]; $sub_ut_11+=$sub[10]; $sub_ut_12+=$sub[11];
			$sub_ut_13+=$sub[12];$sub_ut_14+=$sub[13];$sub_ut_15+=$sub[14];$sub_ut_16+=$sub[15];$sub_ut_17+=$sub[16];$sub_ut_18+=$sub[17];
			$sub_ut_19+=$sub[18];$sub_ut_20+=$sub[19];$sub_ut_21+=$sub[20];$sub_ut_22+=$sub[21];$sub_ut_23+=$sub[22];$sub_ut_24+=$sub[23];
			$sub_ut_25+=$sub[24];$sub_ut_26+=$sub[25];$sub_ut_27+=$sub[26];$sub_ut_28+=$sub[27];$sub_ut_29+=$sub[28];$sub_ut_30+=$sub[29];
			$sub_ut_31+=$sub[30];
			$sub_ut_tt_all += $total;
		}
		$tabel.= '
				<tr>
					<td class="fixed-side"><b>SUBTOTAL</b></td>
					<td><center>'.round($sub_ut_1,2).'</center></td> <td>'.round($sub_ut_2,2).'</td> <td><center>'.round($sub_ut_3,2).'</center></td> 
					<td><center>'.round($sub_ut_4,2).'</center></td> <td><center>'.round($sub_ut_5,2).'</center></td> <td><center>'.round($sub_ut_6,2).'</center></td> 
					<td><center>'.round($sub_ut_7,2).'</center></td> <td><center>'.round($sub_ut_8,2).'</center></td> <td><center>'.round($sub_ut_9,2).'</center></td> 
					<td><center>'.round($sub_ut_10,2).'</center></td> <td><center>'.round($sub_ut_11,2).'</center></td> <td><center>'.round($sub_ut_12,2).'</center></td> 
					<td><center>'.round($sub_ut_13,2).'</center></td> <td><center>'.round($sub_ut_14,2).'</center></td> <td><center>'.round($sub_ut_15,2).'</center></td>
					<td><center>'.round($sub_ut_16,2).'</center></td> <td><center>'.round($sub_ut_17,2).'</center></td> <td><center>'.round($sub_ut_18,2).'</center></td> 
					<td><center>'.round($sub_ut_19,2).'</center></td> <td><center>'.round($sub_ut_20,2).'</center></td> <td><center>'.round($sub_ut_21,2).'</center></td> 
					<td><center>'.round($sub_ut_22,2).'</center></td> <td><center>'.round($sub_ut_23,2).'</center></td> <td><center>'.round($sub_ut_24,2).'</center></td> 
					<td><center>'.round($sub_ut_25,2).'</center></td> <td><center>'.round($sub_ut_26,2).'</center></td> <td><center>'.round($sub_ut_27,2).'</center></td> 
					<td><center>'.round($sub_ut_28,2).'</center></td> <td><center>'.round($sub_ut_29,2).'</center></td> <td><center>'.round($sub_ut_30,2).'</center></td> 
					<td><center>'.round($sub_ut_31,2).'</center></td> 
					<td><center>'.round($sub_ut_tt_all,2).'</center></td>
				</tr>
				';

		$sub_tt_1 = $sub_rt_1+$sub_pdt_1+$sub_udt_1+$sub_it_1+$sub_ut_1;
		$sub_tt_2 = $sub_rt_2+$sub_pdt_2+$sub_udt_2+$sub_it_2+$sub_ut_2;
		$sub_tt_3 = $sub_rt_3+$sub_pdt_3+$sub_udt_3+$sub_it_3+$sub_ut_3;
		$sub_tt_4 = $sub_rt_4+$sub_pdt_4+$sub_udt_4+$sub_it_4+$sub_ut_4;
		$sub_tt_5 = $sub_rt_5+$sub_pdt_5+$sub_udt_5+$sub_it_5+$sub_ut_5;
		$sub_tt_6 = $sub_rt_6+$sub_pdt_6+$sub_udt_6+$sub_it_6+$sub_ut_6;
		$sub_tt_7 = $sub_rt_7+$sub_pdt_7+$sub_udt_7+$sub_it_7+$sub_ut_7;
		$sub_tt_8 = $sub_rt_8+$sub_pdt_8+$sub_udt_8+$sub_it_8+$sub_ut_8;
		$sub_tt_9 = $sub_rt_9+$sub_pdt_9+$sub_udt_9+$sub_it_9+$sub_ut_9;
		$sub_tt_10 = $sub_rt_10+$sub_pdt_10+$sub_udt_10+$sub_it_10+$sub_ut_10;
		$sub_tt_11 = $sub_rt_11+$sub_pdt_11+$sub_udt_11+$sub_it_11+$sub_ut_11;
		$sub_tt_12 = $sub_rt_12+$sub_pdt_12+$sub_udt_12+$sub_it_12+$sub_ut_12;
		$sub_tt_13 = $sub_rt_13+$sub_pdt_13+$sub_udt_13+$sub_it_13+$sub_ut_13;
		$sub_tt_14 = $sub_rt_14+$sub_pdt_14+$sub_udt_14+$sub_it_14+$sub_ut_14;
		$sub_tt_15 = $sub_rt_15+$sub_pdt_15+$sub_udt_15+$sub_it_15+$sub_ut_15;
		$sub_tt_16 = $sub_rt_16+$sub_pdt_16+$sub_udt_16+$sub_it_16+$sub_ut_16;
		$sub_tt_17 = $sub_rt_17+$sub_pdt_17+$sub_udt_17+$sub_it_17+$sub_ut_17;
		$sub_tt_18 = $sub_rt_18+$sub_pdt_18+$sub_udt_18+$sub_it_18+$sub_ut_18;
		$sub_tt_19 = $sub_rt_19+$sub_pdt_19+$sub_udt_19+$sub_it_19+$sub_ut_19;
		$sub_tt_20 = $sub_rt_20+$sub_pdt_20+$sub_udt_20+$sub_it_20+$sub_ut_20;
		$sub_tt_21 = $sub_rt_21+$sub_pdt_21+$sub_udt_21+$sub_it_21+$sub_ut_21;
		// echo $sub_tt_21;exit();
		$sub_tt_22 = $sub_rt_22+$sub_pdt_22+$sub_udt_22+$sub_it_22+$sub_ut_22;
		$sub_tt_23 = $sub_rt_23+$sub_pdt_23+$sub_udt_23+$sub_it_23+$sub_ut_23;
		$sub_tt_24 = $sub_rt_24+$sub_pdt_24+$sub_udt_24+$sub_it_24+$sub_ut_24;
		$sub_tt_25 = $sub_rt_25+$sub_pdt_25+$sub_udt_25+$sub_it_25+$sub_ut_25;
		$sub_tt_26 = $sub_rt_26+$sub_pdt_26+$sub_udt_26+$sub_it_26+$sub_ut_26;
		$sub_tt_27 = $sub_rt_27+$sub_pdt_27+$sub_udt_27+$sub_it_27+$sub_ut_27;
		$sub_tt_28 = $sub_rt_28+$sub_pdt_28+$sub_udt_28+$sub_it_28+$sub_ut_28;
		$sub_tt_29 = $sub_rt_29+$sub_pdt_29+$sub_udt_29+$sub_it_29+$sub_ut_29;
		$sub_tt_30 = $sub_rt_30+$sub_pdt_30+$sub_udt_30+$sub_it_30+$sub_ut_30;
		$sub_tt_31 = $sub_rt_31+$sub_pdt_31+$sub_udt_31+$sub_it_31+$sub_ut_31;
		$sub_tt_tt_all = $sub_rt_tt_all+$sub_pdt_tt_all+$sub_udt_tt_all+$sub_it_tt_all+$sub_ut_tt_all;

		$tabel.= '
				<tr>
					<td class="fixed-side"><b>TOTAL</b></td>
					<td><center>'.round($sub_tt_1,2).'</center></td> <td>'.round($sub_tt_2,2).'</td> <td><center>'.round($sub_tt_3,2).'</center></td> 
					<td><center>'.round($sub_tt_4,2).'</center></td> <td><center>'.round($sub_tt_5,2).'</center></td> <td><center>'.round($sub_tt_6,2).'</center></td> 
					<td><center>'.round($sub_tt_7,2).'</center></td> <td><center>'.round($sub_tt_8,2).'</center></td> <td><center>'.round($sub_tt_9,2).'</center></td> 
					<td><center>'.round($sub_tt_10,2).'</center></td> <td><center>'.round($sub_tt_11,2).'</center></td> <td><center>'.round($sub_tt_12,2).'</center></td> 
					<td><center>'.round($sub_tt_13,2).'</center></td> <td><center>'.round($sub_tt_14,2).'</center></td> <td><center>'.round($sub_tt_15,2).'</center></td>
					<td><center>'.round($sub_tt_16,2).'</center></td> <td><center>'.round($sub_tt_17,2).'</center></td> <td><center>'.round($sub_tt_18,2).'</center></td> 
					<td><center>'.round($sub_tt_19,2).'</center></td> <td><center>'.round($sub_tt_20,2).'</center></td> <td><center>'.round($sub_tt_21,2).'</center></td> 
					<td><center>'.round($sub_tt_22,2).'</center></td> <td><center>'.round($sub_tt_23,2).'</center></td> <td><center>'.round($sub_tt_24,2).'</center></td> 
					<td><center>'.round($sub_tt_25,2).'</center></td> <td><center>'.round($sub_tt_26,2).'</center></td> <td><center>'.round($sub_tt_27,2).'</center></td> 
					<td><center>'.round($sub_tt_28,2).'</center></td> <td><center>'.round($sub_tt_29,2).'</center></td> <td><center>'.round($sub_tt_30,2).'</center></td> 
					<td><center>'.round($sub_tt_31,2).'</center></td> 
					<td><center>'.round($sub_tt_tt_all,2).'</center></td>
				</tr>
				';
		#akhir UT


		$tabel.= '
         <script>

            $(document).ready(function() {
                jQuery(".main-table").clone(true).appendTo(".table-scroll").addClass("clone"); 
            });
         </script>
		';

		
		$respone = "sukses";
		$return = array('respone' => $respone, 'tabel' => $tabel, 'bulan_name' => $bulan_name );
		echo json_encode($return);
	}


























	public function download($bulan,$id_machine){
		$tabel="";

		$downtimeGroup_RT = 'RT';
		$dataRT = $this->mdl->data_resume($downtimeGroup_RT);
		$tabel.= '
				<tr>
					<td colspan="33" class="fixed-side"><b>1 RUN MESIN</b></td>
				</tr>
				';
		$sub_rt_1=$sub_rt_2=$sub_rt_3=$sub_rt_4=$sub_rt_5=$sub_rt_6=$sub_rt_7=$sub_rt_8=$sub_rt_9=$sub_rt_10=$sub_rt_11=$sub_rt_12=$sub_rt_13=$sub_rt_14=$sub_rt_15=0;
		$sub_rt_16=$sub_rt_17=$sub_rt_18=$sub_rt_19=$sub_rt_20=$sub_rt_21=$sub_rt_22=$sub_rt_23=$sub_rt_24=$sub_rt_25=$sub_rt_26=$sub_rt_27=$sub_rt_28=$sub_rt_29=$sub_rt_30=0;
		$sub_rt_31=0;
		$sub_rt_tt_all = 0;
		foreach ($dataRT as $RT) {
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$RT->id.'. '.$RT->downtimeCode.'. '.$RT->downtimeName.'</td>
								';
			$tot=0;
			$sub = array();
			for ($i=1; $i <= 31 ; $i++) { 
				$tgl = $this->parse_tgl($i,$bulan);
				$dt_RT = $this->mdl->downtime($tgl,$id_machine,$RT->id);
				$break = round($dt_RT->dt,2);
				$tabel.= '
						<td style="text-align:center !important">'.$break.'</td>
				';
				$tot+=$break;
				$sub[] = round($dt_RT->dt,2);
			}
			$total = round($tot,2);
			$tabel.= '
					<td style="text-align:center !important">'.round($tot,2).'</td>
	            </tr>
			';
			$sub_rt_1+=$sub[0]; $sub_rt_2+=$sub[1]; $sub_rt_3+=$sub[2]; $sub_rt_4+=$sub[3]; $sub_rt_5+=$sub[4]; $sub_rt_6+=$sub[5];
			$sub_rt_7+=$sub[6]; $sub_rt_8+=$sub[7]; $sub_rt_9+=$sub[8]; $sub_rt_10+=$sub[9]; $sub_rt_11+=$sub[10]; $sub_rt_12+=$sub[11];
			$sub_rt_13+=$sub[12];$sub_rt_14+=$sub[13];$sub_rt_15+=$sub[14];$sub_rt_16+=$sub[15];$sub_rt_17+=$sub[16];$sub_rt_18+=$sub[17];
			$sub_rt_19+=$sub[18];$sub_rt_20+=$sub[19];$sub_rt_21+=$sub[20];$sub_rt_22+=$sub[21];$sub_rt_23+=$sub[22];$sub_rt_24+=$sub[23];
			$sub_rt_25+=$sub[24];$sub_rt_26+=$sub[25];$sub_rt_27+=$sub[26];$sub_rt_28+=$sub[27];$sub_rt_29+=$sub[28];$sub_rt_30+=$sub[29];
			$sub_rt_31+=$sub[30];
			$sub_rt_tt_all += $total;
		}
		#akhir RT

		#mulai PDT
		$downtimeGroup_PDT = 'PDT';
		$dataPDT = $this->mdl->data_resume($downtimeGroup_PDT);
		$tabel.= '
				<tr>
					<td colspan="33" class="fixed-side"><b>2 PLANNED DOWN TIME (PDT)</b></td>
				</tr>
				';
		$sub_pdt_1=$sub_pdt_2=$sub_pdt_3=$sub_pdt_4=$sub_pdt_5=$sub_pdt_6=$sub_pdt_7=$sub_pdt_8=$sub_pdt_9=$sub_pdt_10=$sub_pdt_11=$sub_pdt_12=$sub_pdt_13=$sub_pdt_14=$sub_pdt_15=0;
		$sub_pdt_16=$sub_pdt_17=$sub_pdt_18=$sub_pdt_19=$sub_pdt_20=$sub_pdt_21=$sub_pdt_22=$sub_pdt_23=$sub_pdt_24=$sub_pdt_25=$sub_pdt_26=$sub_pdt_27=$sub_pdt_28=$sub_pdt_29=$sub_pdt_30=0;
		$sub_pdt_31=0;
		$sub_pdt_tt_all = 0;
		foreach ($dataPDT as $PDT) {
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$PDT->downtimeCode.'. '.$PDT->downtimeName.'</td>
								';
			$tot=0;
			$sub = array();
			for ($i=1; $i <= 31 ; $i++) { 
				$tgl = $this->parse_tgl($i,$bulan);
				$dt_RT = $this->mdl->downtime($tgl,$id_machine,$PDT->id);
				$break = round($dt_RT->dt,2);
				$tabel.= '
						<td style="text-align:center !important">'.$break.'</td>
				';
				$tot+=$break;
				$sub[] = round($dt_RT->dt,2);
			}
			$total = round($tot,2);
			$tabel.= '
					<td style="text-align:center !important">'.$total.'</td>
	            </tr>
			';
			$sub_pdt_1+=$sub[0]; $sub_pdt_2+=$sub[1]; $sub_pdt_3+=$sub[2]; $sub_pdt_4+=$sub[3]; $sub_pdt_5+=$sub[4]; $sub_pdt_6+=$sub[5];
			$sub_pdt_7+=$sub[6]; $sub_pdt_8+=$sub[7]; $sub_pdt_9+=$sub[8]; $sub_pdt_10+=$sub[9]; $sub_pdt_11+=$sub[10]; $sub_pdt_12+=$sub[11];
			$sub_pdt_13+=$sub[12];$sub_pdt_14+=$sub[13];$sub_pdt_15+=$sub[14];$sub_pdt_16+=$sub[15];$sub_pdt_17+=$sub[16];$sub_pdt_18+=$sub[17];
			$sub_pdt_19+=$sub[18];$sub_pdt_20+=$sub[19];$sub_pdt_21+=$sub[20];$sub_pdt_22+=$sub[21];$sub_pdt_23+=$sub[22];$sub_pdt_24+=$sub[23];
			$sub_pdt_25+=$sub[24];$sub_pdt_26+=$sub[25];$sub_pdt_27+=$sub[26];$sub_pdt_28+=$sub[27];$sub_pdt_29+=$sub[28];$sub_pdt_30+=$sub[29];
			$sub_pdt_31+=$sub[30];
			$sub_pdt_tt_all += $total;
		}
		$tabel.= '
				<tr>
					<td class="fixed-side"><b>SUBTOTAL</b></td>
					<td style="text-align:center !important">'.round($sub_pdt_1,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_2,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_3,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_4,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_5,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_6,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_7,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_8,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_9,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_10,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_11,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_12,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_13,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_14,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_15,2).'</td>
					<td style="text-align:center !important">'.round($sub_pdt_16,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_17,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_18,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_19,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_20,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_21,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_22,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_23,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_24,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_25,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_26,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_27,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_28,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_29,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_30,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_31,2).'</td> 
					<td style="text-align:center !important">'.round($sub_pdt_tt_all,2).'</td>
				</tr>
				';
		#akhir PDT

		#mulai UDT
		$downtimeGroup_UDT = 'UDT';
		$dataUDT = $this->mdl->data_resume($downtimeGroup_UDT);
		$tabel.= '
				<tr>
					<td colspan="33" class="fixed-side"><b>3.UNPLANNED DOWN TIME (UPDT)</b></td>
				</tr>
				';

		$sub_udt_1=$sub_udt_2=$sub_udt_3=$sub_udt_4=$sub_udt_5=$sub_udt_6=$sub_udt_7=$sub_udt_8=$sub_udt_9=$sub_udt_10=$sub_udt_11=$sub_udt_12=$sub_udt_13=$sub_udt_14=$sub_udt_15=0;
		$sub_udt_16=$sub_udt_17=$sub_udt_18=$sub_udt_19=$sub_udt_20=$sub_udt_21=$sub_udt_22=$sub_udt_23=$sub_udt_24=$sub_udt_25=$sub_udt_26=$sub_udt_27=$sub_udt_28=$sub_udt_29=$sub_udt_30=0;
		$sub_udt_31=0;
		$sub_udt_tt_all = 0;
		foreach ($dataUDT as $UDT) {
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$UDT->downtimeCode.'. '.$UDT->downtimeName.'</td>
								';
			$tot=0;
			$sub = array();
			for ($i=1; $i <= 31 ; $i++) { 
				$tgl = $this->parse_tgl($i,$bulan);
				$dt_RT = $this->mdl->downtime($tgl,$id_machine,$UDT->id);
				$break = round($dt_RT->dt,2);
				$tabel.= '
						<td style="text-align:center !important">'.$break.'</td>
				';
				$tot+=$break;
				$sub[] = round($dt_RT->dt,2);
			}
			$total = round($tot,2);
			$tabel.= '
					<td style="text-align:center !important">'.$total.'</td>
	            </tr>
			';
			$sub_udt_1+=$sub[0]; $sub_udt_2+=$sub[1]; $sub_udt_3+=$sub[2]; $sub_udt_4+=$sub[3]; $sub_udt_5+=$sub[4]; $sub_udt_6+=$sub[5];
			$sub_udt_7+=$sub[6]; $sub_udt_8+=$sub[7]; $sub_udt_9+=$sub[8]; $sub_udt_10+=$sub[9]; $sub_udt_11+=$sub[10]; $sub_udt_12+=$sub[11];
			$sub_udt_13+=$sub[12];$sub_udt_14+=$sub[13];$sub_udt_15+=$sub[14];$sub_udt_16+=$sub[15];$sub_udt_17+=$sub[16];$sub_udt_18+=$sub[17];
			$sub_udt_19+=$sub[18];$sub_udt_20+=$sub[19];$sub_udt_21+=$sub[20];$sub_udt_22+=$sub[21];$sub_udt_23+=$sub[22];$sub_udt_24+=$sub[23];
			$sub_udt_25+=$sub[24];$sub_udt_26+=$sub[25];$sub_udt_27+=$sub[26];$sub_udt_28+=$sub[27];$sub_udt_29+=$sub[28];$sub_udt_30+=$sub[29];
			$sub_udt_31+=$sub[30];
			$sub_udt_tt_all += $total;
		}
		$tabel.= '
				<tr>
					<td class="fixed-side"><b>SUBTOTAL</b></td>
					<td style="text-align:center !important">'.round($sub_udt_1,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_2,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_3,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_4,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_5,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_6,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_7,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_8,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_9,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_10,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_11,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_12,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_13,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_14,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_15,2).'</td>
					<td style="text-align:center !important">'.round($sub_udt_16,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_17,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_18,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_19,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_20,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_21,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_22,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_23,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_24,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_25,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_26,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_27,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_28,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_29,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_30,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_31,2).'</td> 
					<td style="text-align:center !important">'.round($sub_udt_tt_all,2).'</td>
				</tr>
				';
		#akhir UDT

		#mulai IT
		$downtimeGroup_IT = 'IT';
		$dataIT = $this->mdl->data_resume($downtimeGroup_IT);
		$tabel.= '
				<tr>
					<td colspan="33" class="fixed-side"><b>4.WAITING/ IDLE TIME</b></td>
				</tr>
				';

		$sub_it_1=$sub_it_2=$sub_it_3=$sub_it_4=$sub_it_5=$sub_it_6=$sub_it_7=$sub_it_8=$sub_it_9=$sub_it_10=$sub_it_11=$sub_it_12=$sub_it_13=$sub_it_14=$sub_it_15=0;
		$sub_it_16=$sub_it_17=$sub_it_18=$sub_it_19=$sub_it_20=$sub_it_21=$sub_it_22=$sub_it_23=$sub_it_24=$sub_it_25=$sub_it_26=$sub_it_27=$sub_it_28=$sub_it_29=$sub_it_30=0;
		$sub_it_31=0;
		$sub_it_tt_all = 0;
		foreach ($dataIT as $IT) {
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$IT->downtimeCode.'. '.$IT->downtimeName.'</td>
								';
			$tot=0;
			$sub = array();
			for ($i=1; $i <= 31 ; $i++) { 
				$tgl = $this->parse_tgl($i,$bulan);
				$dt_RT = $this->mdl->downtime($tgl,$id_machine,$IT->id);
				$break = round($dt_RT->dt,2);
				$tabel.= '
						<td style="text-align:center !important">'.$break.'</td>
				';
				$tot+=$break;
				$sub[] = round($dt_RT->dt,2);
			}
			$total = round($tot,2);
			$tabel.= '
					<td style="text-align:center !important">'.$total.'</td>
	            </tr>
			';
			$sub_it_1+=$sub[0]; $sub_it_2+=$sub[1]; $sub_it_3+=$sub[2]; $sub_it_4+=$sub[3]; $sub_it_5+=$sub[4]; $sub_it_6+=$sub[5];
			$sub_it_7+=$sub[6]; $sub_it_8+=$sub[7]; $sub_it_9+=$sub[8]; $sub_it_10+=$sub[9]; $sub_it_11+=$sub[10]; $sub_it_12+=$sub[11];
			$sub_it_13+=$sub[12];$sub_it_14+=$sub[13];$sub_it_15+=$sub[14];$sub_it_16+=$sub[15];$sub_it_17+=$sub[16];$sub_it_18+=$sub[17];
			$sub_it_19+=$sub[18];$sub_it_20+=$sub[19];$sub_it_21+=$sub[20];$sub_it_22+=$sub[21];$sub_it_23+=$sub[22];$sub_it_24+=$sub[23];
			$sub_it_25+=$sub[24];$sub_it_26+=$sub[25];$sub_it_27+=$sub[26];$sub_it_28+=$sub[27];$sub_it_29+=$sub[28];$sub_it_30+=$sub[29];
			$sub_it_31+=$sub[30];
			$sub_it_tt_all += $total;
		}
		$tabel.= '
				<tr>
					<td class="fixed-side"><b>SUBTOTAL</b></td>
					<td style="text-align:center !important">'.round($sub_it_1,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_2,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_3,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_4,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_5,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_6,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_7,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_8,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_9,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_10,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_11,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_12,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_13,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_14,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_15,2).'</td>
					<td style="text-align:center !important">'.round($sub_it_16,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_17,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_18,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_19,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_20,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_21,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_22,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_23,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_24,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_25,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_26,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_27,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_28,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_29,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_30,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_31,2).'</td> 
					<td style="text-align:center !important">'.round($sub_it_tt_all,2).'</td>
				</tr>
				';
		#akhir IT

		#mulai UT
		$downtimeGroup_UT = 'UT';
		$dataUT = $this->mdl->data_resume($downtimeGroup_UT);
		$tabel.= '
				<tr>
					<td colspan="33" class="fixed-side"><b>5.UTILITY</b></td>
				</tr>
				';

		$sub_ut_1=$sub_ut_2=$sub_ut_3=$sub_ut_4=$sub_ut_5=$sub_ut_6=$sub_ut_7=$sub_ut_8=$sub_ut_9=$sub_ut_10=$sub_ut_11=$sub_ut_12=$sub_ut_13=$sub_ut_14=$sub_ut_15=0;
		$sub_ut_16=$sub_ut_17=$sub_ut_18=$sub_ut_19=$sub_ut_20=$sub_ut_21=$sub_ut_22=$sub_ut_23=$sub_ut_24=$sub_ut_25=$sub_ut_26=$sub_ut_27=$sub_ut_28=$sub_ut_29=$sub_ut_30=0;
		$sub_ut_31=0;
		$sub_ut_tt_all = 0;
		foreach ($dataUT as $UT) {
			$tabel.= '
				<tr>
					<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;'.$UT->downtimeCode.'. '.$UT->downtimeName.'</td>
								';
			$tot=0;
			$sub = array();
			for ($i=1; $i <= 31 ; $i++) { 
				$tgl = $this->parse_tgl($i,$bulan);
				$dt_RT = $this->mdl->downtime($tgl,$id_machine,$UT->id);
				$break = round($dt_RT->dt,2);
				$tabel.= '
						<td style="text-align:center !important">'.$break.'</td>
				';
				$tot+=$break;
				$sub[] = round($dt_RT->dt,2);
			}
			$total = round($tot,2);
			$tabel.= '
					<td style="text-align:center !important">'.$total.'</td>
	            </tr>
			';
			$sub_ut_1+=$sub[0]; $sub_ut_2+=$sub[1]; $sub_ut_3+=$sub[2]; $sub_ut_4+=$sub[3]; $sub_ut_5+=$sub[4]; $sub_ut_6+=$sub[5];
			$sub_ut_7+=$sub[6]; $sub_ut_8+=$sub[7]; $sub_ut_9+=$sub[8]; $sub_ut_10+=$sub[9]; $sub_ut_11+=$sub[10]; $sub_ut_12+=$sub[11];
			$sub_ut_13+=$sub[12];$sub_ut_14+=$sub[13];$sub_ut_15+=$sub[14];$sub_ut_16+=$sub[15];$sub_ut_17+=$sub[16];$sub_ut_18+=$sub[17];
			$sub_ut_19+=$sub[18];$sub_ut_20+=$sub[19];$sub_ut_21+=$sub[20];$sub_ut_22+=$sub[21];$sub_ut_23+=$sub[22];$sub_ut_24+=$sub[23];
			$sub_ut_25+=$sub[24];$sub_ut_26+=$sub[25];$sub_ut_27+=$sub[26];$sub_ut_28+=$sub[27];$sub_ut_29+=$sub[28];$sub_ut_30+=$sub[29];
			$sub_ut_31+=$sub[30];
			$sub_ut_tt_all += $total;
		}
		$tabel.= '
				<tr>
					<td class="fixed-side"><b>SUBTOTAL</b></td>
					<td style="text-align:center !important">'.round($sub_ut_1,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_2,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_3,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_4,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_5,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_6,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_7,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_8,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_9,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_10,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_11,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_12,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_13,2).'</td> 

					<td style="text-align:center !important">'.round($sub_ut_14,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_15,2).'</td>
					<td style="text-align:center !important">'.round($sub_ut_16,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_17,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_18,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_19,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_20,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_21,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_22,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_23,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_24,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_25,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_26,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_27,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_28,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_29,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_30,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_31,2).'</td> 
					<td style="text-align:center !important">'.round($sub_ut_tt_all,2).'</td>
				</tr>
				';

		$sub_tt_1 = $sub_rt_1+$sub_pdt_1+$sub_udt_1+$sub_it_1+$sub_ut_1;
		$sub_tt_2 = $sub_rt_2+$sub_pdt_2+$sub_udt_2+$sub_it_2+$sub_ut_2;
		$sub_tt_3 = $sub_rt_3+$sub_pdt_3+$sub_udt_3+$sub_it_3+$sub_ut_3;
		$sub_tt_4 = $sub_rt_4+$sub_pdt_4+$sub_udt_4+$sub_it_4+$sub_ut_4;
		$sub_tt_5 = $sub_rt_5+$sub_pdt_5+$sub_udt_5+$sub_it_5+$sub_ut_5;
		$sub_tt_6 = $sub_rt_6+$sub_pdt_6+$sub_udt_6+$sub_it_6+$sub_ut_6;
		$sub_tt_7 = $sub_rt_7+$sub_pdt_7+$sub_udt_7+$sub_it_7+$sub_ut_7;
		$sub_tt_8 = $sub_rt_8+$sub_pdt_8+$sub_udt_8+$sub_it_8+$sub_ut_8;
		$sub_tt_9 = $sub_rt_9+$sub_pdt_9+$sub_udt_9+$sub_it_9+$sub_ut_9;
		$sub_tt_10 = $sub_rt_10+$sub_pdt_10+$sub_udt_10+$sub_it_10+$sub_ut_10;
		$sub_tt_11 = $sub_rt_11+$sub_pdt_11+$sub_udt_11+$sub_it_11+$sub_ut_11;
		$sub_tt_12 = $sub_rt_12+$sub_pdt_12+$sub_udt_12+$sub_it_12+$sub_ut_12;
		$sub_tt_13 = $sub_rt_13+$sub_pdt_13+$sub_udt_13+$sub_it_13+$sub_ut_13;
		$sub_tt_14 = $sub_rt_14+$sub_pdt_14+$sub_udt_14+$sub_it_14+$sub_ut_14;
		$sub_tt_15 = $sub_rt_15+$sub_pdt_15+$sub_udt_15+$sub_it_15+$sub_ut_15;
		$sub_tt_16 = $sub_rt_16+$sub_pdt_16+$sub_udt_16+$sub_it_16+$sub_ut_16;
		$sub_tt_17 = $sub_rt_17+$sub_pdt_17+$sub_udt_17+$sub_it_17+$sub_ut_17;
		$sub_tt_18 = $sub_rt_18+$sub_pdt_18+$sub_udt_18+$sub_it_18+$sub_ut_18;
		$sub_tt_19 = $sub_rt_19+$sub_pdt_19+$sub_udt_19+$sub_it_19+$sub_ut_19;
		$sub_tt_20 = $sub_rt_20+$sub_pdt_20+$sub_udt_20+$sub_it_20+$sub_ut_20;
		$sub_tt_21 = $sub_rt_21+$sub_pdt_21+$sub_udt_21+$sub_it_21+$sub_ut_21;
		// echo $sub_tt_21;exit();
		$sub_tt_22 = $sub_rt_22+$sub_pdt_22+$sub_udt_22+$sub_it_22+$sub_ut_22;
		$sub_tt_23 = $sub_rt_23+$sub_pdt_23+$sub_udt_23+$sub_it_23+$sub_ut_23;
		$sub_tt_24 = $sub_rt_24+$sub_pdt_24+$sub_udt_24+$sub_it_24+$sub_ut_24;
		$sub_tt_25 = $sub_rt_25+$sub_pdt_25+$sub_udt_25+$sub_it_25+$sub_ut_25;
		$sub_tt_26 = $sub_rt_26+$sub_pdt_26+$sub_udt_26+$sub_it_26+$sub_ut_26;
		$sub_tt_27 = $sub_rt_27+$sub_pdt_27+$sub_udt_27+$sub_it_27+$sub_ut_27;
		$sub_tt_28 = $sub_rt_28+$sub_pdt_28+$sub_udt_28+$sub_it_28+$sub_ut_28;
		$sub_tt_29 = $sub_rt_29+$sub_pdt_29+$sub_udt_29+$sub_it_29+$sub_ut_29;
		$sub_tt_30 = $sub_rt_30+$sub_pdt_30+$sub_udt_30+$sub_it_30+$sub_ut_30;
		$sub_tt_31 = $sub_rt_31+$sub_pdt_31+$sub_udt_31+$sub_it_31+$sub_ut_31;
		$sub_tt_tt_all = $sub_rt_tt_all+$sub_pdt_tt_all+$sub_udt_tt_all+$sub_it_tt_all+$sub_ut_tt_all;

		$tabel.= '
				<tr>
					<td class="fixed-side"><b>TOTAL</b></td>
					<td style="text-align:center !important">'.round($sub_tt_1,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_2,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_3,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_4,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_5,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_6,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_7,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_8,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_9,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_10,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_11,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_12,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_13,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_14,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_15,2).'</td>
					<td style="text-align:center !important">'.round($sub_tt_16,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_17,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_18,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_19,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_20,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_21,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_22,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_23,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_24,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_25,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_26,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_27,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_28,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_29,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_30,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_31,2).'</td> 
					<td style="text-align:center !important">'.round($sub_tt_tt_all,2).'</td>
				</tr>
				';
		#akhir UT


		// $tabel.= '
  //        <script>

  //           $(document).ready(function() {
  //               jQuery(".main-table").clone(true).appendTo(".table-scroll").addClass("clone"); 
  //           });
  //        </script>
		// ';

		return $tabel;
	}

	public function excel(){
		$bulan = $_REQUEST["bulan_table"];
		$id_machine = $_REQUEST["id_machine"];
		if ($bulan){
			$bulan_cari = \DateTime::createFromFormat("m-Y", $bulan)->format("Y-m");
		}else{
			$bulan_cari = date('Y-m');
		}
		$bulan_name = date("F Y", strtotime($bulan_cari));

		$kolom = 'id,machineName';
	    $tabel = 'mst_machine';
	    $where = 'WHERE id = '.$id_machine;
	    $join  = '';
	    $order = '';
	    $machine = $this->mdl->select_row($tabel,$join,$where,$kolom,$order);

		$jdl = 'REPORT RESUME : '.$machine->machineName;
		
		$data = array(
					'jdl'=>$jdl,
					'bulan_name'=>$bulan_name,
					'tabel' => $this->download($bulan,$id_machine)
					);

		// echo $type.' '.$tahun;exit();
		$filename =$jdl." ".$bulan_name.".xls";
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		$this->load->view('RptResume/RptResume_excel',$data);
		
		
	}

	public function pdf(){
		$bulan = $_REQUEST["bulan_table"];
		$id_machine = $_REQUEST["id_machine"];
		if ($bulan){
			$bulan_cari = \DateTime::createFromFormat("m-Y", $bulan)->format("Y-m");
		}else{
			$bulan_cari = date('Y-m');
		}
		$bulan_name = date("F Y", strtotime($bulan_cari));

		$kolom = 'id,machineName';
	    $tabel = 'mst_machine';
	    $where = 'WHERE id = '.$id_machine;
	    $join  = '';
	    $order = '';
	    $machine = $this->mdl->select_row($tabel,$join,$where,$kolom,$order);

		$jdl = 'REPORT RESUME : '.$machine->machineName;
		
		$data = array(
					'jdl'=>$jdl,
					'bulan_name'=>$bulan_name,
					'tabel' => $this->download($bulan,$id_machine)
					);

		
		$this->load->library('pdf');
		$this->load->view('RptResume/RptResume_pdf',$data);
		
	}
}