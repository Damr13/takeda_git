<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RptOEE extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('RptOEEModel','mdl');
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
		$this->template->load('template','RptOEE',$data);
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

	public function tgl_akhir_bulan($periode)
	{
		// echo $periode.' ';
		$kalender = CAL_GREGORIAN;
		$bulan = substr($periode,5,2);
		$tahun = substr($periode,0,4);

		// echo $bulan.' ';
		// echo $tahun.' ';
		// exit();
		$jml_hari = cal_days_in_month($kalender, $bulan, $tahun);
		return $jml_hari;
	}

	public function RptOEE_table(){
		$id_machine = $this->input->post('id_machine');
		$bulan = $this->input->post('bulan');
		date_default_timezone_set('Asia/Jakarta');
		if ($bulan){
			$bulan_cari = \DateTime::createFromFormat("m-Y", $bulan)->format("Y-m");
		}else{
			$bulan_cari = date('Y-m');
		}
		$bulan_name = date("F Y", strtotime($bulan_cari));

		$tgl_akhir = $this->tgl_akhir_bulan($bulan_cari);

		$thead="";
		$thead.='
			<tr>
              <th scope="col" class="fixed-side"><b>NO</b></th>
              <th scope="col" class="fixed-side"><b>KATEGORI</b></th>
              <th scope="col" class="fixed-side"><b>SATUAN</b></th>
              <th scope="col" class="fixed-side" scope="col"><b>KALKULASI</b></th>';

              for ($i=1; $i <= $tgl_akhir; $i++) {
        $thead.='<th colspan="3"><center><b>'.$i.'</b></center></th>';
              }
        $thead.='
              <th scope="col" rowspan="2"><center><b>TOTAL</b></center></th>
            </tr>
			
		';

		$tabel="";

		$tabel.=$this->shift($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->tanggal($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->mesin($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->produk($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->operator($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->plan_operating_time($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->pdt($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->updt($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->idle($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->utility($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->machine_operating_time($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->speed_ideal($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->good_pieces($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->reject($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->total_output($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->availability($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->performance($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->quality($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->overall_oee($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->target_oee($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->freq_bd($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->mtbf_min($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->mttr_min($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->availability2($bulan,$id_machine,$tgl_akhir);
		// $tabel.=$this->mtbf_min_ytd($bulan,$id_machine);
		// $tabel.=$this->mttr_min_ytd($bulan,$id_machine);
		// $tabel.=$this->availability2_ytd($bulan,$id_machine);

		$tabel.= '
			<script>

			$(document).ready(function() {
			    jQuery(".main-table").clone(true).appendTo(".table-scroll").addClass("clone"); 
			});
			</script>
		';

		
		$respone = "sukses";
		$return = array('respone' => $respone, 'thead' => $thead, 'tabel' => $tabel, 'bulan_name' => $bulan_name );
		echo json_encode($return);
	}

	public function shift($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">1</td>
						<td class="fixed-side">Shift</td> 
						<td class="fixed-side"><center>-</center></td> 
						<td class="fixed-side"><center>-</center></td> ';
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.product_name';
			    $tabel_db = 'log_book a';
			    $join  = 'LEFT JOIN mst_product b ON a.product = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			   
			    if($cek_lb->jml >= 1){
			    	$tabel.='
						<td><center>Shift '.$shift.'</center></td>
					';
			    }else{
			    	$tabel.='
						<td><center> </center></td>
					';
			    }

				
			}
			
		}
						
		$tabel.='
						
						<td><center>-</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function tanggal($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">2</td>
						<td class="fixed-side">Tanggal</td> 
						<td class="fixed-side"><center>-</center></td> 
						<td class="fixed-side"><center>-</center></td>';
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.product_name';
			    $tabel_db = 'log_book a';
			    $join  = 'LEFT JOIN mst_product b ON a.product = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			   
			    if($cek_lb->jml >= 1){
			    	$tabel.='
						<td><center>Shift '.$i.'</center></td>
					';
			    }else{
			    	$tabel.='
						<td><center> </center></td>
					';
			    }
			}
			
		}
		

		$tabel.='
						
						<td><center>-</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function mesin($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">3</td>
						<td class="fixed-side">Mesin</td> 
						<td class="fixed-side"><center>-</center></td> 
						<td class="fixed-side"><center>-</center></td> 
						';
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    	$tabel.='
						<td><center>'.$lb->name_machine.'</center></td>
					';
			    }else{
			    	$tabel.='
						<td><center> </center></td>
					';
			    }

			    // $tabel.='<td><center>-</center></td>';
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>-</center></td>
                    </tr>
				';
		// echo $tabel;exit();
		return $tabel;
	}

	public function produk($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">4</td>
						<td class="fixed-side">Produk</td> 
						<td class="fixed-side"><center>-</center></td> 
						<td class="fixed-side"><center>-</center></td> 
						';
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.product_name';
			    $tabel_db = 'log_book a';
			    $join  = 'LEFT JOIN mst_product b ON a.product = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    // echo 'SELECT '.$kolom.' from '.$tabel_db.' '.$join.' '.$where;exit();
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    	$tabel.='
						<td><center>';
						$kolom_pr = 'a.id,a.id_log_book,b.product_name';
					    $tabel_pr = 'log_book_det_product a';
					    $join_pr  = 'LEFT JOIN mst_product b on a.id_product = b.id';
					    $where_pr = 'WHERE a.id_log_book ='.$lb->id;
					    $order_pr = 'ORDER BY a.id ASC';
					    $get_pr = $this->mdl->select_result2($tabel_pr,$join_pr,$where_pr,$kolom_pr,$order_pr);
					    foreach ($get_pr as $get_pr) {
					    	$tabel.=$get_pr->product_name.' ';
					    }
					$tabel.='
						</center></td>
					';
			    }else{
			    	$tabel.='
						<td><center> </center></td>
					';
			    }

			    // $tabel.='<td><center>-</center></td>';
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>-</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function operator($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">5</td>
						<td class="fixed-side">Operator</td> 
						<td class="fixed-side"><center>-</center></td> 
						<td class="fixed-side"><center>-</center></td> ';
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    	$kolom_op = 'a.id,a.id_log_book,a.id_pic,b.name';
				    $tabel_op = 'log_book_det_operator a';
				    $join_op  = 'LEFT JOIN mst_pic b on a.id_pic = b.id';
				    $where_op = 'WHERE a.id_log_book = '.$lb->id;
				    $order_op = 'ORDER BY a.id_pic ASC';
				    $cek_lb= $this->mdl->select_count($tabel_op,$join_op,$where_op,$kolom_op,$order_op);
				    $op = ' ';
				    if($cek_lb->jml >= 1){
				    	$get_op = $this->mdl->select_result2($tabel_op,$join_op,$where_op,$kolom_op,$order_op);
					    foreach ($get_op as $get_op) {
					    	$op.=$get_op->name.'-';
					    }
				    }
				    
			    	$tabel.='
						<td><center>'.substr($op, 0, -1).'</center></td>
					';
			    }else{
			    	$tabel.='
						<td><center> </center></td>
					';
			    }

			    // $tabel.='<td><center>-</center></td>';
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>-</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function plan_operating_time($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">6</td>
						<td class="fixed-side">Plan Operating Time</td> 
						<td class="fixed-side"><center>menit</center></td> 
						<td class="fixed-side"><center>A</center></td> ';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = ' ';
			    $tabel_db = 'log_book a';
			    $join  = '	LEFT JOIN log_book_det_time b ON a.id = b.id_log_book
							LEFT JOIN mst_downtime c on b.code = c.id ';
			    // $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.' 
			    // 			AND c.downtimeGroup = "RT" ';

				$where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.' 
			    			AND (c.downtimeGroup = "RT" or c.downtimeGroup = "PDT" or c.downtimeGroup = "UDT" or c.downtimeGroup = "IT" or c.downtimeGroup = "UT") ';

				// $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.' ';
			    $order = '';
			    
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    	$tot += $cek_lb->jml*5;
			    	$tabel.='
						<td><center>'.($cek_lb->jml*5).'</center></td>
					';
			    }else{
			    	$tot += 0;
			    	$tabel.='
						<td><center> </center></td>
					';
			    }
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.$tot.'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function pdt($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">7</td>
						<td class="fixed-side">Plan Downtime (PDT)</td> 
						<td class="fixed-side"><center>menit</center></td> 
						<td class="fixed-side"><center>B</center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){

					$kolom_dt = ' ';
				    $tabel_dt = 'log_book a';
				    $join_dt  = '	LEFT JOIN log_book_det_time b ON a.id = b.id_log_book
								LEFT JOIN mst_downtime c on b.code = c.id ';
				    $where_dt = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.' 
				    			AND c.downtimeGroup = "PDT" ';
				    $order_dt = '';
				    $cek_lb_dt= $this->mdl->select_count($tabel_dt,$join_dt,$where_dt,$kolom_dt,$order_dt);
				    if($cek_lb_dt->jml >= 1){
				    	$tot += $cek_lb_dt->jml*5;
				    	$tabel.='
							<td><center>'.($cek_lb_dt->jml*5).'</center></td>
						';
				    }else{
				    	$tot += 0;
				    	$tabel.='
							<td><center>0</center></td>
						';
				    }
				}else{
					$tot += 0;
					$tabel.='
							<td><center> </center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.$tot.'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function updt($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">8</td>
						<td class="fixed-side">UnPlan Downtime (UDT)</td> 
						<td class="fixed-side"><center>menit</center></td> 
						<td class="fixed-side"><center>C</center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){

					$kolom_dt = ' ';
				    $tabel_dt = 'log_book a';
				    $join_dt  = '	LEFT JOIN log_book_det_time b ON a.id = b.id_log_book
								LEFT JOIN mst_downtime c on b.code = c.id ';
				    $where_dt = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.' 
				    			AND c.downtimeGroup = "UDT" ';
				    $order_dt = '';
				    $cek_lb_dt= $this->mdl->select_count($tabel_dt,$join_dt,$where_dt,$kolom_dt,$order_dt);
				    if($cek_lb_dt->jml >= 1){
				    	$tot += $cek_lb_dt->jml*5;
				    	$tabel.='
							<td><center>'.($cek_lb_dt->jml*5).'</center></td>
						';
				    }else{
				    	$tabel.='
							<td><center>0</center></td>
						';
				    }
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.$tot.'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function idle($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">9</td>
						<td class="fixed-side">Idle/Waiting Time</td> 
						<td class="fixed-side"><center>menit</center></td> 
						<td class="fixed-side"><center>D</center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){

					$kolom_dt = ' ';
				    $tabel_dt = 'log_book a';
				    $join_dt  = '	LEFT JOIN log_book_det_time b ON a.id = b.id_log_book
								LEFT JOIN mst_downtime c on b.code = c.id ';
				    $where_dt = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.' 
				    			AND c.downtimeGroup = "IT" ';
				    $order_dt = '';
				    $cek_lb_dt= $this->mdl->select_count($tabel_dt,$join_dt,$where_dt,$kolom_dt,$order_dt);
				    if($cek_lb_dt->jml >= 1){
				    	$tot += $cek_lb_dt->jml*5;
				    	$tabel.='
							<td><center>'.($cek_lb_dt->jml*5).'</center></td>
						';
				    }else{
				    	$tabel.='
							<td><center>0</center></td>
						';
				    }
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.$tot.'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function utility($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">10</td>
						<td class="fixed-side">Utility Time</td> 
						<td class="fixed-side"><center>menit</center></td> 
						<td class="fixed-side"><center>U</center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){

					$kolom_dt = ' ';
				    $tabel_dt = 'log_book a';
				    $join_dt  = '	LEFT JOIN log_book_det_time b ON a.id = b.id_log_book
								LEFT JOIN mst_downtime c on b.code = c.id ';
				    $where_dt = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.' 
				    			AND c.downtimeGroup = "UT" ';
				    $order_dt = '';
				    $cek_lb_dt= $this->mdl->select_count($tabel_dt,$join_dt,$where_dt,$kolom_dt,$order_dt);
				    if($cek_lb_dt->jml >= 1){
				    	$tot += $cek_lb_dt->jml*5;
				    	$tabel.='
							<td><center>'.($cek_lb_dt->jml*5).'</center></td>
						';
				    }else{
				    	$tabel.='
							<td><center>0</center></td>
						';
				    }
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.$tot.'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function hist_down($tgl,$shift,$id_machine,$dg){
		$kolom_dt = ' ';
	    $tabel_dt = 'log_book a';
	    $join_dt  = '	LEFT JOIN log_book_det_time b ON a.id = b.id_log_book
					LEFT JOIN mst_downtime c on b.code = c.id ';
	    $where_dt = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.' 
	    			AND c.downtimeGroup = "'.$dg.'" ';
	    $order_dt = '';
	    $cek_lb_dt= $this->mdl->select_count($tabel_dt,$join_dt,$where_dt,$kolom_dt,$order_dt);

	    return $cek_lb_dt->jml;
	}

	public function plan_down_t($tgl,$shift,$id_machine){
		$kolom_dt = ' ';
	    $tabel_dt = 'log_book a';
	    $join_dt  = 'LEFT JOIN log_book_det_time b ON a.id = b.id_log_book
					LEFT JOIN mst_downtime c on b.code = c.id ';
	    // $where_dt = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.' 
	    // 			AND c.downtimeGroup = "'.$dg.'" ';
	    $where_dt = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.' 
			    			AND (c.downtimeGroup = "RT" or c.downtimeGroup = "PDT" or c.downtimeGroup = "UDT" or c.downtimeGroup = "IT" or c.downtimeGroup = "UT") ';
		// $where_dt = '';
	    $order_dt = '';
	    $cek_lb_dt= $this->mdl->select_count($tabel_dt,$join_dt,$where_dt,$kolom_dt,$order_dt);

	    // echo $cek_lb_dt->jml.' '.$tgl.' '.$shift.' '.$id_machine.' : ';
	    $return = $cek_lb_dt->jml;
	    // if($return <= 0){
	    // 	$return = 480;
	    // }

	    return $return;
	}

	public function machine_operating_time($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">11</td>
						<td class="fixed-side">Machine Operating Time</td> 
						<td class="fixed-side"><center>menit</center></td> 
						<td class="fixed-side"><center>I=A-(B+C+D)</center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){

				    // $rt = $this->hist_down($tgl,$shift,$id_machine,'RT');
				    $rt = $this->plan_down_t($tgl,$shift,$id_machine);
				    $pdt = $this->hist_down($tgl,$shift,$id_machine,'PDT');
				    $udt = $this->hist_down($tgl,$shift,$id_machine,'UDT');
				    $it = $this->hist_down($tgl,$shift,$id_machine,'IT');
				    $mot = ($rt-($pdt+$udt+$it))*5;
				    $tabel.='
							<td><center>'.($mot).'</center></td>
						';
					$tot += $mot;
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.$tot.'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function spd($bulan,$id_machine){
		return 1000;
	}

	public function speed_ideal($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">12</td>
						<td class="fixed-side">Speed Ideal</td> 
						<td class="fixed-side"><center>tab/mnt</center></td> 
						<td class="fixed-side"><center>E</center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(a.speed,0) as speed';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
				    $mot = $lb->speed;
				    $tabel.='
							<td><center>'.($mot).'</center></td>
						';
					$tot += $mot;
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.$tot.'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function good_pieces($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">13</td>
						<td class="fixed-side">Good Pieces</td> 
						<td class="fixed-side"><center>tablet</center></td> 
						<td class="fixed-side"><center>F</center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(SUM(c.product_good*d.spq),0) as product_good';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id LEFT JOIN log_book_det_product c ON c.id_log_book = a.id
			    			LEFT JOIN mst_product d ON c.id_product=d.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    // echo 'SELECT '.$kolom.' from '.$tabel_db.' '.$join.' '.$where;exit();
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
				    $mot = $lb->product_good;
				    $tabel.='
							<td><center>'.($mot).'</center></td>
						';
					$tot += $mot;
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.$tot.'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function reject($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">14</td>
						<td class="fixed-side">Reject</td> 
						<td class="fixed-side"><center>tablet</center></td> 
						<td class="fixed-side"><center>G</center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(SUM(c.product_reject),0) as product_reject';
				$tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id LEFT JOIN log_book_det_product c ON c.id_log_book = a.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    // echo $kolom.' '.$tabel_db.' '.$join.' '.$where;exit();
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
				    $mot = $lb->product_reject;
				    $tabel.='
							<td><center>'.($mot).'</center></td>
						';
					$tot += $mot;
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.$tot.'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function total_output($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">15</td>
						<td class="fixed-side">Total Output</td> 
						<td class="fixed-side"><center>tablet</center></td> 
						<td class="fixed-side"><center>J=F+G</center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(SUM(c.product_good*d.spq),0) as product_good,ifnull(SUM(c.product_reject),0) as product_reject';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id LEFT JOIN log_book_det_product c ON c.id_log_book = a.id LEFT JOIN mst_product d ON d.id = c.id_product';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
				    $mot = $lb->product_good+$lb->product_reject;
				    $tabel.='
							<td><center>'.($mot).'</center></td>
						';
					$tot += $mot;
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.$tot.'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function availability($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">16</td>
						<td class="fixed-side"><i>Availability</i></td> 
						<td class="fixed-side"><center>%</center></td> 
						<td class="fixed-side"><center>K=(I/A).100</center></td>';
		$tot = 0;
		$j=0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) {
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    	
				    // $rt = $this->hist_down($tgl,$shift,$id_machine,'RT');
				    $rt = $this->plan_down_t($tgl,$shift,$id_machine);
				    $pdt = $this->hist_down($tgl,$shift,$id_machine,'PDT');
				    $udt = $this->hist_down($tgl,$shift,$id_machine,'UDT');
				    $it = $this->hist_down($tgl,$shift,$id_machine,'IT');
				    $data_i = ($rt-($pdt+$udt+$it))*5;
				    if($rt<=0){
				    	$mot = 0;
				    }else{
				    	$mot = ($data_i/($rt*5))*100;
				    }
				    
				    if($mot<70){
				    	$bc = 'style="background-color: red;"';
				    }elseif ($mot>=70 and $mot< 75) {
				    	$bc = 'style="background-color: yellow;"';
				    }else{
				    	$bc = 'style="background-color: green;"';
				    }
				    $tabel.='
							<td '.$bc.'><center>'.(round($mot,2)).'</center></td>
						';
					$tot += $mot;
					if($mot>0){
						$j+=1;
					}
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		if ($j <= 0){
			$tabel.='		
								
						<td><center>0</center></td>
                    </tr>
				';
		}else{
			if(($tot/$j)<70){
		    	$bc = 'style="background-color: red;"';
		    }elseif (($tot/$j)>=70 and ($tot/$j)< 75) {
		    	$bc = 'style="background-color: yellow;"';
		    }else{
		    	$bc = 'style="background-color: green;"';
		    }
			$tabel.='		
								
						<td '.$bc.'><center>'.(round(($tot/$j),2)).'</center></td>
                    </tr>
				';
		}
		
		
		return $tabel;
	}

	public function performance($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		
		$tabel.= '
					<tr>
						<td class="fixed-side">17</td>
						<td class="fixed-side"><i>Performance</i></td> 
						<td class="fixed-side"><center>%</center></td> 
						<td class="fixed-side"><center>L=(J.100)/(I.E)</center></td>';
		$tot = 0;
		$j=0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(SUM(c.product_good*d.spq),0) as product_good,ifnull(SUM(c.product_reject),0) as product_reject,ifnull(a.speed,0) as speed';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id LEFT JOIN log_book_det_product c ON c.id_log_book = a.id
			    			LEFT JOIN mst_product d ON c.id_product=d.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    // echo 'SELECT '.$kolom.' from '.$tabel_db.' '.$join.' '.$where;exit();
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
				    // $rt = $this->hist_down($tgl,$shift,$id_machine,'RT');
				    $rt = $this->plan_down_t($tgl,$shift,$id_machine);
				    $pdt = $this->hist_down($tgl,$shift,$id_machine,'PDT');
				    $udt = $this->hist_down($tgl,$shift,$id_machine,'UDT');
				    $it = $this->hist_down($tgl,$shift,$id_machine,'IT');
				    $data_i = ($rt-($pdt+$udt+$it))*5;
				    if($lb->speed > 0){
				    	if(($data_i * $lb->speed) > 0){
				    		$mot = ((($lb->product_good + $lb->product_reject)*100)/($data_i * $lb->speed));
				    	}else{
				    		$mot = 0;
				    	}
				    }else{
				    	$mot = 0;
				    }

				    if($mot<70){
				    	$bc = 'style="background-color: red;"';
				    }elseif ($mot>=70 and $mot< 75) {
				    	$bc = 'style="background-color: yellow;"';
				    }else{
				    	$bc = 'style="background-color: green;"';
				    }

				    $tabel.='
							<td '.$bc.'><center>'.(round($mot,2)).'</center></td>
						';
					$tot += $mot;
					if($mot>0){
						$j+=1;
					}
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}

		if ($j <= 0){
			$tabel.='		
								
						<td><center>0</center></td>
                    </tr>
				';
		}else{
			if(($tot/$j)<70){
		    	$bc = 'style="background-color: red;"';
		    }elseif (($tot/$j)>=70 and ($tot/$j)< 75) {
		    	$bc = 'style="background-color: yellow;"';
		    }else{
		    	$bc = 'style="background-color: green;"';
		    }
			$tabel.='		
								
						<td '.$bc.'><center>'.(round(($tot/$j),2)).'</center></td>
                    </tr>
				';
		}

		// $tabel.='		
								
		// 				<td><center>'.(round(($tot),2)).'</center></td>
  //                   </tr>
		// 		';
		return $tabel;
	}

	public function quality($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">18</td>
						<td class="fixed-side"><i>Quality</i></td> 
						<td class="fixed-side"><center>%</center></td> 
						<td class="fixed-side"><center>M=(F/J).100</center></td>';
		$tot = 0;
		$j=0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(SUM(c.product_good*d.spq),0) as product_good,ifnull(SUM(c.product_reject),0) as product_reject';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id LEFT JOIN log_book_det_product c ON c.id_log_book = a.id
			    			LEFT JOIN mst_product d ON c.id_product=d.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    	$tt = $lb->product_good+$lb->product_reject;
			    	if($tt <= 0){
			    		$mot = 0;
			    	}else{
			    		$mot = ($lb->product_good / $tt)*100;
			    	}

			    	if($mot<70){
				    	$bc = 'style="background-color: red;"';
				    }elseif ($mot>=70 and $mot< 75) {
				    	$bc = 'style="background-color: yellow;"';
				    }else{
				    	$bc = 'style="background-color: green;"';
				    }
				    
				    $tabel.='
							<td '.$bc.'><center>'.(round($mot,2)).'</center></td>
						';
					$tot += $mot;
					if($mot>0){
						$j+=1;
					}
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		if ($j <= 0){
			$tabel.='		
								
						<td><center>0</center></td>
                    </tr>
				';
		}else{
			if(($tot/$j)<70){
		    	$bc = 'style="background-color: red;"';
		    }elseif (($tot/$j)>=70 and ($tot/$j)< 75) {
		    	$bc = 'style="background-color: yellow;"';
		    }else{
		    	$bc = 'style="background-color: green;"';
		    }

			$tabel.='		
								
						<td '.$bc.'><center>'.(round(($tot/$j),2)).'</center></td>
                    </tr>
				';
		}
		return $tabel;
	}

	public function overall_oee($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$bc = 'style="background-color: green;"';
		$tabel.= '
					<tr>
						<td class="fixed-side">19</td>
						<td class="fixed-side"><i>Overall OEE</i></td> 
						<td class="fixed-side"><center>%</center></td> 
						<td class="fixed-side"><center>N=K.L.M</center></td>';
		$tot = 0;
		$j=0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(SUM(c.product_good*d.spq),0) as product_good,ifnull(SUM(c.product_reject),0) as product_reject,ifnull(a.speed,0) as speed';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id LEFT JOIN log_book_det_product c ON c.id_log_book = a.id
			    			LEFT JOIN mst_product d ON c.id_product=d.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    	// $rt = $this->hist_down($tgl,$shift,$id_machine,'RT');
			    	$rt = $this->plan_down_t($tgl,$shift,$id_machine);
				    $pdt = $this->hist_down($tgl,$shift,$id_machine,'PDT');
				    $udt = $this->hist_down($tgl,$shift,$id_machine,'UDT');
				    $it = $this->hist_down($tgl,$shift,$id_machine,'IT');
				    $data_i = ($rt-($pdt+$udt+$it))*5;

				    if($rt<=0){
				    	$av = 0;
				    }else{
				    	$av = (round(($data_i/($rt*5))*100,2));
				    }
			    	
			    	if($lb->speed > 0){
			    		if(($data_i * $lb->speed) > 0){
				    		$prf = (round(((($lb->product_good + $lb->product_reject)*100)/($data_i * $lb->speed)),2));
				    	}else{
				    		$prf = 0;
				    	}
				    }else{
				    	$prf = 0;
				    }

			    	$tt = $lb->product_good+$lb->product_reject;
			    	if($tt <= 0){
			    		$qly = 0;
			    	}else{
			    		$qly = (round(($lb->product_good / $tt)*100,2));
			    	}


				    $dd = $av*$prf*$qly;
				    $mot = $dd/10000;

				    if($mot<70){
				    	$bc = 'style="background-color: red;"';
				    }elseif ($mot>=70 and $mot< 75) {
				    	$bc = 'style="background-color: yellow;"';
				    }else{
				    	$bc = 'style="background-color: green;"';
				    }

				    
				    $tabel.='
							<td '.$bc.'><center>'.(round($mot,2)).'</center></td>
						';
					$tot += $mot;
					if($mot>0){
						$j+=1;
					}
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		if ($j <= 0){
			$tabel.='		
								
						<td><center>0</center></td>
                    </tr>
				';
		}else{

			if(($tot/$j)<70){
		    	$bc = 'style="background-color: red;"';
		    }elseif (($tot/$j)>=70 and ($tot/$j)< 75) {
		    	$bc = 'style="background-color: yellow;"';
		    }else{
		    	$bc = 'style="background-color: green;"';
		    }

			$tabel.='		
								
						<td '.$bc.'><center>'.(round(($tot/$j),2)).'</center></td>
                    </tr>
				';
		}
		return $tabel;
	}

	public function parse_bln_name($bln){
		if($bln=='01'){
			$val = 'jan';
		}elseif ($bln=='02') {
			$val = 'feb';
		}elseif ($bln=='03') {
			$val = 'mar';
		}elseif ($bln=='04') {
			$val = 'apr';
		}elseif ($bln=='05') {
			$val = 'may';
		}elseif ($bln=='06') {
			$val = 'jun';
		}elseif ($bln=='07') {
			$val = 'jul';
		}elseif ($bln=='08') {
			$val = 'aug';
		}elseif ($bln=='09') {
			$val = 'sep';
		}elseif ($bln=='10') {
			$val = 'oct';
		}elseif ($bln=='11') {
			$val = 'nov';
		}elseif ($bln=='12') {
			$val = 'dec';
		}

		return $val;
	}

	public function parse_target_oee($bulan){
		// echo $bulan;exit();
		$thn = substr($bulan, 3,4);
		$bln_name = $this->parse_bln_name(substr($bulan, 0,2)); 
		// echo $bln_name;exit();

		$kolom = 'ifnull(a.'.$bln_name.',0) as oee_target';
	    $tabel_db = 'mst_target_oee a';
	    $join  = '';
	    $where = 'where a.year = "'.$thn.'" ';
	    $order = '';
	    // echo 'SELECT '.$kolom.' from '.$tabel_db.' '.$join.' '.$where;exit();
	    $cek = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
	    return $cek->oee_target;
	}

	public function target_oee($bulan,$id_machine,$tgl_akhir){
		
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">20</td>
						<td class="fixed-side"><i>Target OEE</i></td> 
						<td class="fixed-side"><center>%</center></td> 
						<td class="fixed-side"><center>O</center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = '';
			    $tabel_db = 'log_book a';
			    $join  = '';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    // echo 'SELECT '.$kolom.' '.$tabel_db.' '.$join.' '.$where;exit();
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    // $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    $mot = $this->parse_target_oee($bulan);
			   	// $mot = $lb->oee_target;
				    $tabel.='
							<td><center>'.(round($mot,2)).'</center></td>
						';
					$tot += $mot;
					
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.(round($tot,2)).'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function freq_bd($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">21</td>
						<td class="fixed-side"><i>Frequency Breakdown</i></td> 
						<td class="fixed-side"><center>SATUAN</center></td> 
						<td class="fixed-side"><center>P</center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(a.freq_bd,0) as freq_bd';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);

			    // echo 'SELECT '.$kolom.' from '.$tabel_db.' '.$join.' '.$where;exit();
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);

			    if($cek_lb->jml >= 1){
			   	$mot = $lb->freq_bd;
				    $tabel.='
							<td><center>'.(round($mot,2)).'</center></td>
						';
					$tot += $mot;
					
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.(round($tot,2)).'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function mtbf_min($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">22</td>
						<td class="fixed-side"><i>MTBF MIN</i></td> 
						<td class="fixed-side"><center>MIN</center></td> 
						<td class="fixed-side"><center>Q=I/P</center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(a.freq_bd,0) as freq_bd';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    	// $rt = $this->hist_down($tgl,$shift,$id_machine,'RT');
			    	$rt = $this->plan_down_t($tgl,$shift,$id_machine);
				    $pdt = $this->hist_down($tgl,$shift,$id_machine,'PDT');
				    $udt = $this->hist_down($tgl,$shift,$id_machine,'UDT');
				    $it = $this->hist_down($tgl,$shift,$id_machine,'IT');
				    $data_i = ($rt-($pdt+$udt+$it))*5;
				    if($lb->freq_bd > 0){
				    	$mot = $data_i/$lb->freq_bd;
				    }else{
				    	$mot =$data_i;
				    }
			   		
				    $tabel.='
							<td><center>'.(round($mot,2)).'</center></td>
						';
					$tot += $mot;
					
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.(round($tot,2)).'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function mttr_min($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">23</td>
						<td class="fixed-side"><i>MTTR MIN</i></td> 
						<td class="fixed-side"><center>MIN</center></td> 
						<td class="fixed-side"><center>R=C/P</center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(a.freq_bd,0) as freq_bd';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
				    $udt = $this->hist_down($tgl,$shift,$id_machine,'UDT');
				    if($lb->freq_bd > 0){
				    	$mot = ($udt*5)/$lb->freq_bd;
				    }else{
				    	$mot =$udt;
				    }
			   		
				    $tabel.='
							<td><center>'.(round($mot,2)).'</center></td>
						';
					$tot += $mot;
					
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.(round($tot,2)).'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function availability2($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">24</td>
						<td class="fixed-side"><i>Availability</i></td> 
						<td class="fixed-side"><center>%</center></td> 
						<td class="fixed-side"><center>S=Q/(Q+R)</center></td>';
		$tot = 0;
		$j=0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(a.freq_bd,0) as freq_bd';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    	// $rt = $this->hist_down($tgl,$shift,$id_machine,'RT');
			    	$rt = $this->plan_down_t($tgl,$shift,$id_machine);
				    $pdt = $this->hist_down($tgl,$shift,$id_machine,'PDT');
				    $udt = $this->hist_down($tgl,$shift,$id_machine,'UDT');
				    $it = $this->hist_down($tgl,$shift,$id_machine,'IT');
				    $data_i = ($rt-($pdt+$udt+$it))*5;
				    if($lb->freq_bd > 0){
				    	$mtbr = $data_i/$lb->freq_bd;
				    	$mttr = ($udt*5)/$lb->freq_bd;

				    	if(($mtbr+$mttr)<=0){
				    	    $mot = 0;
					    }else{
					    	$mot = ($mtbr/($mtbr+$mttr))*100;
					    }
				    	
				    }else{
				    	// $mot = 0;
				    	$mtbr =$data_i;
				    	$mttr = ($udt*5);
				    	// $mot = ($mtbr/($mtbr+$mttr))*100;
				    	if(($mtbr+$mttr)<=0){
				    	    $mot = 0;
					    }else{
					    	$mot = ($mtbr/($mtbr+$mttr))*100;
					    }
				    }

				    // echo $i.' '.$shift.' '.$mtbr.' v '.$mtbr.' '.$mttr.' '.$mot.'|';
			   		
				    $tabel.='
							<td><center>'.(round($mot,2)).'</center></td>
						';
					$tot += $mot;
					if($mot>0){
						$j+=1;
					}
					
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		if ($j <= 0){
			$tabel.='		
								
						<td><center>0</center></td>
                    </tr>
				';
		}else{
			$tabel.='		
								
						<td><center>'.(round(($tot/$j),2)).'</center></td>
                    </tr>
				';
		}
		return $tabel;
	}

	public function mtbf_min_ytd($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">25</td>
						<td class="fixed-side"><i>MTBF (min) YTD</i></td> 
						<td class="fixed-side"><center></center></td> 
						<td class="fixed-side"><center> </center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(a.freq_bd,0) as freq_bd';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    	// $rt = $this->hist_down($tgl,$shift,$id_machine,'RT');
			    	$rt = $this->plan_down_t($tgl,$shift,$id_machine);
				    $pdt = $this->hist_down($tgl,$shift,$id_machine,'PDT');
				    $udt = $this->hist_down($tgl,$shift,$id_machine,'UDT');
				    $it = $this->hist_down($tgl,$shift,$id_machine,'IT');
				    $data_i = ($rt-($pdt+$udt+$it))*5;
				    if($lb->freq_bd > 0){
				    	$mot = $data_i/$lb->freq_bd;
				    }else{
				    	$mot = 0;
				    }
			   		
				    $tabel.='
							<td><center>'.(round($mot,2)).'</center></td>
						';
					$tot += $mot;
					
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.(round($tot,2)).'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function mttr_min_ytd($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">26</td>
						<td class="fixed-side"><i>MTTR (min) YTD</i></td> 
						<td class="fixed-side"><center></center></td> 
						<td class="fixed-side"><center> </center></td>';
		$tot = 0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(a.freq_bd,0) as freq_bd';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
				    $udt = $this->hist_down($tgl,$shift,$id_machine,'UDT');
				    if($lb->freq_bd > 0){
				    	$mot = ($udt*5)/$lb->freq_bd;
				    }else{
				    	$mot = 0;
				    }
			   		
				    $tabel.='
							<td><center>'.(round($mot,2)).'</center></td>
						';
					$tot += $mot;
					
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		$tabel.='		
								
						<td><center>'.(round($tot,2)).'</center></td>
                    </tr>
				';
		return $tabel;
	}

	public function availability2_ytd($bulan,$id_machine,$tgl_akhir){
		$tabel="";
		$tabel.= '
					<tr>
						<td class="fixed-side">27</td>
						<td class="fixed-side"><i>Availability (%) YTD</i></td> 
						<td class="fixed-side"><center> </center></td> 
						<td class="fixed-side"><center> </center></td>';
		$tot = 0;
		$j=0;
		for ($i=1; $i <= $tgl_akhir ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan);
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(a.freq_bd,0) as freq_bd';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->mdl->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->mdl->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    	// $rt = $this->hist_down($tgl,$shift,$id_machine,'RT');
			    	$rt = $this->plan_down_t($tgl,$shift,$id_machine);
				    $pdt = $this->hist_down($tgl,$shift,$id_machine,'PDT');
				    $udt = $this->hist_down($tgl,$shift,$id_machine,'UDT');
				    $it = $this->hist_down($tgl,$shift,$id_machine,'IT');
				    $data_i = ($rt-($pdt+$udt+$it))*5;
				    if($lb->freq_bd > 0){
				    	$mtbr = $data_i/$lb->freq_bd;
				    	$mttr = ($udt*5)/$lb->freq_bd;
				    	$mot = ($mtbr/($mtbr+$mttr))*100;
				    }else{
				    	$mot = 0;
				    }
			   		
				    $tabel.='
							<td><center>'.(round($mot,2)).'</center></td>
						';
					$tot += $mot;
					if($mot>0){
						$j+=1;
					}
					
				}else{
					$tabel.='
							<td><center></center></td>
						';
				}
				
			}
			
		}
		
		if ($j <= 0){
			$tabel.='		
								
						<td><center>0</center></td>
                    </tr>
				';
		}else{
			$tabel.='		
								
						<td><center>'.(round(($tot/$j),2)).'</center></td>
                    </tr>
				';
		}
		return $tabel;
	}

	public function download($bulan,$id_machine){
		date_default_timezone_set('Asia/Jakarta');
		if ($bulan){
			$bulan_cari = \DateTime::createFromFormat("m-Y", $bulan)->format("Y-m");
		}else{
			$bulan_cari = date('Y-m');
		}
		$bulan_name = date("F Y", strtotime($bulan_cari));

		$tgl_akhir = $this->tgl_akhir_bulan($bulan_cari);

		$tabel="";

		$tabel.=$this->shift($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->tanggal($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->mesin($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->produk($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->operator($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->plan_operating_time($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->pdt($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->updt($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->idle($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->utility($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->machine_operating_time($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->speed_ideal($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->good_pieces($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->reject($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->total_output($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->availability($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->performance($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->quality($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->overall_oee($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->target_oee($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->freq_bd($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->mtbf_min($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->mttr_min($bulan,$id_machine,$tgl_akhir);
		$tabel.=$this->availability2($bulan,$id_machine,$tgl_akhir);
		// $tabel.=$this->mtbf_min_ytd($bulan,$id_machine);
		// $tabel.=$this->mttr_min_ytd($bulan,$id_machine);
		// $tabel.=$this->availability2_ytd($bulan,$id_machine);

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
		$tgl_akhir = $this->tgl_akhir_bulan($bulan_cari);

		$kolom = 'id,machineName';
	    $tabel = 'mst_machine';
	    $where = 'WHERE id = '.$id_machine;
	    $join  = '';
	    $order = '';
	    $machine = $this->mdl->select_row($tabel,$join,$where,$kolom,$order);

		$jdl = 'OEE MACHINE : '.$machine->machineName;
		
		$data = array(
					'jdl'=>$jdl,
					'bulan_name'=>$bulan_name,
					'tgl_akhir' => $tgl_akhir,
					'tabel' => $this->download($bulan,$id_machine)
					);

		// echo $type.' '.$tahun;exit();
		$filename =$jdl." ".$bulan_name.".xls";
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		$this->load->view('RptOEE/RptOEE_excel',$data);
		
		
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
		$tgl_akhir = $this->tgl_akhir_bulan($bulan_cari);

		$kolom = 'id,machineName';
	    $tabel = 'mst_machine';
	    $where = 'WHERE id = '.$id_machine;
	    $join  = '';
	    $order = '';
	    $machine = $this->mdl->select_row($tabel,$join,$where,$kolom,$order);

		$jdl = 'OEE MACHINE : '.$machine->machineName;
		
		$data = array(
					'jdl'=>$jdl,
					'bulan_name'=>$bulan_name,
					'tgl_akhir' => $tgl_akhir,
					'tabel' => $this->download($bulan,$id_machine)
					);

		
		$this->load->library('pdf');
		$this->load->view('RptOEE/RptOEE_pdf',$data);
		
	}
}