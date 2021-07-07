<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public function __construct() {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
		$this->tbl_lb = 'log_book';
		$this->tbl_lb_det_time = 'log_book_det_time';
		$this->load->model('LogModel');
    $this->load->model('MenuModel');
		$this->load->library('session');
    if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

    $akses= $this->MenuModel->akses_menu2('Log',$this->session->userdata('id_user_level'));
    $this->create =  $akses->create;
    $this->update =  $akses->update;
    $this->delete =  $akses->delete;
	}

	public function index(){
		$downtimeLists	= $this->LogModel->downtimeLists();
		// print_r($downtimeLists['dtGroup']);exit();
		// $logbookLists		= $this->LogModel->logbookLists();
		$picLists				= $this->LogModel->picLists();
		$shiftLists			= $this->LogModel->shiftLists();

    $kolom = 'id,machineName';
    $tabel = 'mst_machine';
    $where = '';
    $join  = '';
    $order = '';
    $machine = $this->LogModel->select_result2($tabel,$join,$where,$kolom,$order);
    // print_r($machine);exit();

		$data = array(			
			'dtGroup' 				=> 	$downtimeLists['dtGroup'],
			'dtGroup0' 				=> 	$downtimeLists['dtGroup0'],
			'dtGroup1' 				=> 	$downtimeLists['dtGroup1'],
			'dtGroup2' 				=> 	$downtimeLists['dtGroup2'],
			'dtGroup3' 				=> 	$downtimeLists['dtGroup3'],
			'dtGroup4' 				=> 	$downtimeLists['dtGroup4'],
			// 'logbook1' 				=> 	$logbookLists['logbook1'],
			// 'logbook2' 				=> 	$logbookLists['logbook2'],
			// 'logbook3' 				=> 	$logbookLists['logbook3'],
			'pic' 					  => 	$picLists,
			'shiftLists' 			=> 	$shiftLists,
      'machine'         =>  $machine,
      'menu'            => $this->MenuModel->akses_menu($this->session->userdata('id_user_level'))
		);	

		// print_r($data['shiftLists']);exit();	
		// echo $data;exit();

		// exit();
		$this->load->view('templates/Header');
		$this->template->load('template','Log',$data);
		$this->load->view('templates/Footer');
	}

	public function cek_data(){
    $id_machine = $this->input->post('id_machine');
    $kolom_m = 'id,machineName';
    $tabel_m = 'mst_machine';
    $where_m = 'id = '.$id_machine;
    $machine = $this->LogModel->select_row($tabel_m,$where_m,$kolom_m);

		$date = $this->input->post('date');
		date_default_timezone_set('Asia/Jakarta');
		$tgl = date("Y-m-d", strtotime($date));
    $bulan_name = date("d F Y", strtotime($tgl));

		$picLists			= $this->LogModel->picLists();
		$shiftLists			= $this->LogModel->shiftLists();
		$pic  				= $picLists;	

    // if(date("Y-m-d") == $tgl){  /*start input tanggal hari ini*/


      $i = 1;
      foreach ($shiftLists as $shiftLists) { 
        $logbookLists   = $this->LogModel->logbookLists_dn($tgl,$i,$id_machine);
        $logbook      = $logbookLists;
        if(empty($logbook)){
          // echo $i;
          // INITIATE START AND END TIME SHIFT FROM MASTER SHIFT --ir
            $startTimeShift = date("H:i", strtotime($shiftLists->startShift));
            $endTimeShift   = date("H:i", strtotime($shiftLists->endShift));

            // GET HOUR AND MINUTES --ir
            $hour           = date("H", strtotime($startTimeShift));
            $minutes        = date("i", strtotime($startTimeShift));
            $time           = $hour.":".$minutes;
            $code           = "1";

            $dt_lb['date'] = $tgl;
            $dt_lb['shift'] = $i;
            $dt_lb['machine'] = $id_machine;
            $dt_lb['state'] = 'open';

            $minute = $time;
            if($this->create == 1){
              $log_book = $this->LogModel->insert($this->tbl_lb,$dt_lb); /*insert ke table log book*/
              for ($k=1; $k <= 96; $k++) {

                $time = $hour.":".$minutes;
                // echo $i.') ';echo $time;
                // echo '      ';
                $dt_det['id_log_book'] = $log_book;
                $dt_det['time'] = $time;
                $dt_det['code'] = $code;
                $this->LogModel->insert_det($this->tbl_lb_det_time,$dt_det); /*insert ke table log book detail time*/

                $minutes    = date('i', strtotime("+5 minutes", strtotime($time)));
                if($minutes == 00) {
                  $hour     = date('H', strtotime("+1 hour", strtotime($time))); 
                  $minutes  = date("i",strtotime($hour.":00"));
                };
              }
            }
          }
        $i++;
        }



    // } /*end input tanggal hari ini*/

    $respone = "sukses";
		
		$return = array('respone' => $respone,'bulan_name'=>$bulan_name,'machine_name'=>$machine->machineName);
		echo json_encode($return);
	}

  public function show_data(){
    $id_machine = $this->input->post('id_machine');
    $date = $this->input->post('date');
    date_default_timezone_set('Asia/Jakarta');

    $shift = $this->input->post('shift');
    $tgl = date("Y-m-d", strtotime($date));
    $bulan_name = date("d F Y", strtotime($tgl));

    $tab = '';

    $logbookLists   = $this->LogModel->logbookLists_dn($tgl,$shift,$id_machine);
    $logbook      = $logbookLists;

    if(!empty($logbook)){
      
      $ld = $this->LogModel->get_pic($shift,'Leader');
      $tab .= "
      <div class='full-height-scroll'> ";

      $tab .= "
        <div class='col-lg-8'>
          <div class='m-t-md'>
            <div class='row'>";
        if ($logbook->state == 'open') {
          if($this->create == 1){
            $tab.="
              <button type='button' class='btn btn-success btn-rounded btn-block' onClick='openModalProduct(\"".$logbook->id."\",\"".$logbook->shift."\")'><i class='fa fa-plus'> Add Product Shift".$shift."</i></button>";
          }
          
        }else{
          $tab.="
              <div class='col-lg-4' style='padding:0; padding-right:10px;'></div>
                <div class='col-lg-4'>
                  <center><span class='badge badge-warning'>Locked</span></center>
                </div>
              <div class='col-lg-4'></div>";
        }
        $tab.="
              <br/><br/>
              <table class='table table-striped table-hover'>
                <thead>
                  <tr class='header'>
                    <th style='background-color: #404E67;color: white;'><div><center>Product</center></div></th>
                    <th style='background-color: #404E67;color: white;'><div><center>Batch</center></div></th>
                    <th style='background-color: #404E67;color: white;'><div><center>OK</center></div></th>
                    <th style='background-color: #404E67;color: white;'><div><center>NG</center></div></th>
                    <th style='background-color: #404E67;color: white;'><div><center>Aksi</center></div></th>
                  </tr>
                </thead>
                <tbody>
                  ";
          $kolom = 'a.id,b.product_name,a.product_batch,a.product_good,a.product_reject';
          $tabel = 'log_book_det_product a';
          $where = 'a.id_log_book='.$logbook->id;
          $join  = ' left join mst_product b on a.id_product = b.id';
          $order = ' ';

          $product = $this->LogModel->select_result($tabel,$join,$where,$kolom,$order);
          foreach ($product as $product) {
            $tab.="<tr>
                    <td><center>".$product->product_name."</center></td>
                    <td><center>".$product->product_batch."</center></td>
                    <td><center>".$product->product_good."</center></td>
                    <td><center>".$product->product_reject."</center></td>";
            if ($logbook->state == 'open') {
              if($this->delete == 1){
                $tab.="
                    <td><center><button class='btn btn-outline btn-danger' onClick='delProduct(".$product->id.")'><i class='fa fa-trash'></i></button></center></td>
                  </tr>
                    ";
              }else{
                $tab.="
                    <td> </td>
                  </tr>
                    ";
              }
              
            }else{
              $tab.="
                    <td><center><button class='btn btn-outline btn-danger'><i class='fa fa-trash'></i></button></center></td>
                  </tr>
                    ";
            }
            
          }
          
          $tab.="
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class='col-lg-4'>
          <div class='m-t-md'>
            <div class='row' style='padding:0; padding-left:10px;'>";
        if ($logbook->state == 'open') {
          if($this->create == 1){
            $tab.="
                <button type='button' class='btn btn-success btn-rounded btn-block' onClick='tambah_operator(\"".$logbook->id."\",\"".$logbook->shift."\")'><i class='fa fa-plus'> Operator Shift ".$shift."</i></button>";
          }
        }else{
          $tab.="
              <div class='col-lg-4'></div>
                <div class='col-lg-4'>
                  <center><span class='badge badge-warning'>Locked</span></center>
                </div>
              <div class='col-lg-4'></div>";
        }
        $tab.="
              <br/><br/>
              <table class='table table-striped table-hover'>
                <thead>
                  <tr class='header'>
                    <th style='background-color: #404E67;color: white;'><div><center>Operator</center></div></th>
                    <th style='background-color: #404E67;color: white;'><div><center>Aksi</center></div></th>
                  </tr>
                </thead>
                <tbody>
                  ";
          $kolom = 'a.id,b.name';
          $tabel = 'log_book_det_operator a';
          $where = 'a.id_log_book='.$logbook->id;
          $join  = ' left join mst_pic b on a.id_pic = b.id';
          $order = ' ';

          $operator = $this->LogModel->select_result($tabel,$join,$where,$kolom,$order);
          foreach ($operator as $operator2) {
            $tab.="<tr>
                    <td><center>".$operator2->name."</center></td>";
            if ($logbook->state == 'open') {
              if($this->delete == 1){
                $tab.="
                    <td><center><button class='btn btn-outline btn-danger' onClick='hapus_hist_op(".$operator2->id.")'><i class='fa fa-trash'></i></button></center></td>
                  </tr>
                    ";
              }else{
                $tab.="
                    <td></td>
                  </tr>
                    ";
              }
            }else{
              $tab.="
                    <td><center><button class='btn btn-outline btn-danger'><i class='fa fa-trash'></i></button></center></td>
                  </tr>
                    ";
            }
            
          }
          
          $tab.="
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>";

      //   $tab .= "
      //   <div class='col-lg-12'>
      //     <div class='m-t-md'>
      //       <div class='row'>
      //         <div class='form-group' style='margin:0; width:100% !important;'>
      //           <label class='font-noraml' style='font-weight:bold'>Shift Leader ".$shift." :</label>";
      // if ($logbook->state == 'open') {
      //   $tab.="
      //           <div class='input-group'>
      //             <select class='select2_demo_1 form-control' id='id_leader_".$shift."'>
      //               <option value=''></option>";
      //   foreach ($ld as $ld) {
      //     if ($logbook->leader == $ld->id) {
      //       $tab .= "
      //                 <option value='".$ld->id."' selected='selected'>".$ld->name."</option>
      //               ";
      //     }else{
      //       $tab .= "
      //               <option value='".$ld->id."'>".$ld->name."</option>
      //             ";
      //     }
      //   };
      //   $tab .= "
      //             </select>
      //           </div>";
      // }else{
      //   $tab.=" ";
      // }

      // $tab .= "
      //         </div>
      //       </div>
      //     </div>
      //   </div>
      // ";

        $tab .= "
        <div class='col-lg-12'>
          <div class='m-t-md'>
            <div class='col-lg-12'>
              <div class='row'>
                <div class='form-group' style='width:100% !important'>
          ";
      if ($logbook->state == 'open') {
        $kolom = 'id,product_name';
        $tabel = 'mst_product';
        $where = '';
        $join  = '';
        $order = '';
        $prd = $this->LogModel->select_result2($tabel,$join,$where,$kolom,$order);
        // $tab.="
        //           <label class='font-noraml' style='font-weight:bold'>Produk :</label>
        //           <div class='input-group'>
        //             <select class='select2_demo_1 form-control' id='id_product_".$shift."'>
        //                 <option value=''></option>";
        //           foreach ($prd as $prd) {
        //             if ($logbook->product == $prd->id) {
        //               $tab .= "
        //                 <option value='".$prd->id."' selected='selected'>".$prd->product_name."</option>
        //               ";
        //             }else{
        //               $tab.="
        //                 <option value='".$prd->id."'>".$prd->product_name."</option>
        //               ";
        //             }
        //           }
        //           $tab.="
        //             </select>
        //           </div>";
                  // $tab .= "

                  // <label class='font-noraml' style='font-weight:bold'>Batch :</label>
                  // <div class='input-group'>
                  //   <input class='form-control' id='id_batch_".$shift."' name='id_batch_".$shift."' value='$logbook->product_batch'>
                  // </div>
                  // <label class='font-noraml' style='font-weight:bold'>Target OEE :</label>
                  // <div class='input-group'>
                  //   <input class='form-control' type='number' id='oee_target_".$shift."' name='oee_target_".$shift."' value='$logbook->oee_target'>
                  // </div>
                  // <label class='font-noraml' style='font-weight:bold'>Speed (tablet/menit) :</label>
                  // <div class='input-group'>
                  //   <input class='form-control' type='number' id='speed_".$shift."' name='speed_".$shift."' value='$logbook->speed'>
                  // </div>
                  // <label class='font-noraml' style='font-weight:bold'>Frequency Breakdown :</label>
                  // <div class='input-group'>
                  //   <input class='form-control' type='number' id='freq_bd_".$shift."' name='freq_bd_".$shift."' value='$logbook->freq_bd' placeholder='Input ketika proses sudah selesai!'>
                  // </div>
                  // <div class='col-lg-12'>
                  //   <div class='row'>
                  //     <div class='col-lg-6' style='padding:0; padding-right:5px;'>
                  //       <label class='font-noraml' style='font-weight:bold'>Baik :</label>
                  //       <input class='form-control' id='id_baik_".$shift."' name='id_baik_".$shift."' onkeypress='return hanyaAngka(event)' value='$logbook->product_good' placeholder='Input ketika proses sudah selesai!'>
                  //     </div>
                  //     <div class='col-lg-6' style='padding:0; padding-left:5px;'>
                  //       <label class='font-noraml' style='font-weight:bold'>Reject :</label>
                  //       <input class='form-control' id='id_reject_".$shift."' name='id_reject_".$shift."' onkeypress='return hanyaAngka(event)' value='$logbook->product_reject' placeholder='Input ketika proses sudah selesai!'>
                  //     </div>
                  //   </div>
                  // </div>
                  //   ";

                  $tab .= "
                  <label class='font-noraml' style='font-weight:bold'>Shift Leader ".$shift." :</label>";
                  if ($logbook->state == 'open') {
                    $tab.="
                            <div class='input-group'>
                              <select class='select2_demo_1 form-control' id='id_leader_".$shift."'>
                                <option value=''></option>";
                    foreach ($ld as $ld) {
                      if ($logbook->leader == $ld->id) {
                        $tab .= "
                                  <option value='".$ld->id."' selected='selected'>".$ld->name."</option>
                                ";
                      }else{
                        $tab .= "
                                <option value='".$ld->id."'>".$ld->name."</option>
                              ";
                      }
                    };
                    $tab .= "
                              </select>
                            </div>";
                  }else{
                    $tab.=" ";
                  }

                  $tab .= "

                  <label class='font-noraml' style='font-weight:bold'>Speed (tablet/menit) :</label>
                  <div class='input-group'>
                  <input class='form-control' type='number' id='speed_".$shift."' name='speed_".$shift."' value='$logbook->speed'>
                  </div>
                  <label class='font-noraml' style='font-weight:bold'>Frequency Breakdown :</label>
                  <div class='input-group'>
                  <input class='form-control' type='number' id='freq_bd_".$shift."' name='freq_bd_".$shift."' value='$logbook->freq_bd' readonly>
                  </div>
                  <label class='font-noraml' style='font-weight:bold'>Note :</label>
                  <div class='input-group'>
                    <input class='form-control' type='text' id='note_".$shift."' name='note_".$shift."' value='$logbook->note'>
                  </div>
                    ";
                  }       
                  $tab.="
                  
                </div>
              </div>
            </div>";
        if ($logbook->state == 'open') {
          $tab.="
            <div class='col-lg-12'>
              <div class='row'><br></div>
              <div class='row'>
                <div class='col-lg-6' style='padding:0; padding-right:5px;'>
                  <button type='button' class='btn btn-w-m btn-primary btn-block' onClick='save(\"".$logbook->id."\",\"".$shift."\")'><i class='fa fa-save'> Save</i></button>
                </div>
                <div class='col-lg-6' style='padding:0; padding-left:5px;'>
                  <button type='button' class='btn btn-w-m btn-warning btn-block' onClick='lock(\"".$logbook->id."\",\"".$shift."\")'><i class='fa fa-key'> Lock</i></button>
                </div>
              </div>
            </div>";
        }else{
          $tab.="
            <div class='col-lg-12'>
              <center><h2 style='font-weight:bold'>".$logbook->nm_leader."</h2></center>
              <button type='button' class='btn btn-w-m btn-warning btn-block' onClick='unlock(\"".$logbook->id."\",\"".$shift."\")'><i class='fa fa-key'> Unlock</i></button>
            </div>";
        }

        $tab.="
          </div>
        </div>

        <div class='col-lg-12'>
          <div class='m-t-md'>
            <div class='table-responsive'>
              <table class='table table-striped table-hover'>
                <thead>";
            if($this->update == 1){
              $tab.="
                  <tr>
                    <td colspan = '3'>
                      <button type='button' class='btn btn-success btn-block btn-block' onClick='modalUpdateRange(\"".$logbook->id."\",\"".$logbook->shift."\")'>
                        Range Time Input
                      </button>
                    </td>
                  </tr>";
            }
        $tab.="
                  <tr class='header'>
                    <th style='background-color: #404E67;color: white;'><div><center>Time</center></div></th>
                    <th style='background-color: #404E67;color: white;'><div><center>Code</center></div></th>
                    <th style='background-color: #404E67;color: white;'><div><center>Technician</center></div></th>
                  </tr>
                </thead>
                <tbody>
              ";

      $kolom = 'a.id,
                a.time,
                b.downtimeCode,
                a.technician,
                (CASE
                  WHEN b.downtimeCode = "1a" THEN "1"
                  ELSE b.downtimeCode
                END) as code
                ';
      $tabel = $this->tbl_lb_det_time.' a';
      $where = 'a.id_log_book='.$logbook->id;
      $join  = ' left join mst_downtime b on a.code = b.id';
      $order = 'order by a.id asc';

      $lb_det_time = $this->LogModel->select_result($tabel,$join,$where,$kolom,$order);
      $no = 1;
      foreach($lb_det_time as $det_time) {
        if ($logbook->state == 'open' && $this->update == 1) {
          $tab .= " 
                  <tr>
                    <td><center><b>".$det_time->time."</b></center></td>
                    <td>
                      <button type='button' class='btn btn-primary btn-rounded btn-block' onClick='modal_update_code(\"".$det_time->id."\",\"".$det_time->time."\",\"".$logbook->id."\",\"".$logbook->shift."\")'>
                        ".$det_time->code."
                      </button>
                    </td>
                    <td><center><b>".$det_time->technician."</b></center></td>
                  </tr>";
        }else{
          $tab .= " 
                  <tr>
                    <td><center>".$det_time->time."</center></td>
                    <td>
                      <button type='button' class='btn btn-primary btn-rounded btn-block'>
                        ".$det_time->code."
                      </button>
                    </td>
                    <td><center>".$det_time->technician."</center></td>
                  </tr>";
        }
      };
      $tab .= "
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>";
      $respone = "sukses";
    }else{
      $tab .= "<div></div>";
      $respone = "gagal";
    }

    
              
         
          
    //     $tab .= "
    //   </div>";
    // $tab .="<link href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css' rel='stylesheet' />";
    // $tab .="<script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js'></script>
    //     <script src='".base_url()."/assets/js/layouts.js'></script>
    //     ";

    // $respone = "sukses";
    $return = array('respone' => $respone, 'tab' => $tab, 'bulan_name'=>$bulan_name, 'table_id' => '#tabel_tab_'.$shift);
    echo json_encode($return);
  }

  // COUNT FREQUENCY BREAKDOWN --ir
  public function countFreqBd(){
    $id  = $this->input->post('id');
    $kolom = 'a.id,
                a.time,
                b.downtimeCode,
                b.downtimeGroup,
                a.technician,
                (CASE
                  WHEN b.downtimeCode = "1a" THEN "1"
                  ELSE b.downtimeCode
                END) as code
                ';
      $tabel = $this->tbl_lb_det_time.' a';
      $where = 'a.id_log_book='.$id;
      $join  = ' left join mst_downtime b on a.code = b.id';
      $order = 'order by a.id asc';

      // echo 
      $freqBd = $this->LogModel->select_result($tabel,$join,$where,$kolom,$order);

      $countFreqBd  = 0;
      $oldDt        = ''; 
      $newDt        = ''; 
      foreach ($freqBd as $freqBd) {
        $newDt  = $freqBd->downtimeCode;
        $dt     = substr($freqBd->downtimeCode,0);
        $dtg     = $freqBd->downtimeGroup;
        // echo $countFreqBd.' : '.$newDt.' : '.$dt.' <br/> ';
        
        #perbaikan perhitungan freq bd
        if ($newDt != '1a' && $dt != 2 && $dt != 4 && $newDt != $oldDt) {
        //if ($dtg == 'UDT') {

          $countFreqBd++;
        }
        $oldDt = $newDt;
      }
      // echo 'ddddd';exit();

      $data = array(
        'freq_bd' => $countFreqBd,
    );

    $upd = $this->LogModel->update($this->tbl_lb,$data,$id);
      if($freqBd){
        $respone = "sukses";
      }else{
        $respone = "gagal";
      }
      
      $return = array('respone' => $respone, 'freqBd' => $countFreqBd);
      echo json_encode($return);
  }

  // UPDATE DOWNTIME WITH RANGE TIME --ir
  public function updateDTRange(){
    $idLBRange  = $this->input->post('idLBRange');
    $id_down    = $this->input->post('id_down');
    $startTime  = $this->input->post('startTime');
    $endTime    = $this->input->post('endTime');
    $technician = $this->input->post('technician');

		$startTime  = explode(':',$startTime);
    $endTime    = explode(':',$endTime);

    $startTimeMinutes = ((int)($startTime[1]/5))*5;
    $endTimeMinutes   = ((int)($endTime[1]/5))*5;
    if($startTimeMinutes == 0) $startTimeMinutes = "00";
    if($endTimeMinutes == 0) $endTimeMinutes = "00";
    if($startTimeMinutes == 5) $startTimeMinutes = "05";
    if($endTimeMinutes == 5) $endTimeMinutes = "05";
    $startTime        = $startTime[0].":".$startTimeMinutes;
    $endTime          = $endTime[0].":".$endTimeMinutes;

    $time = $startTime;

    $diff             = (strtotime($endTime) - strtotime($startTime) ) / 60;
    $diff             = $diff / 5;


    for($i=0; $i < $diff+1; $i++){
      $hour  = date("H",strtotime($time));
      // echo $time."<br>";
      $minutes    = date('i', strtotime("+5 minutes", strtotime($time)));
      if($minutes == 00) {
        $hour     = date('H', strtotime("+1 hour", strtotime($time))); 
        $minutes  = date("i",strtotime($hour.":00"));
      }

      $where = array(
        'id_log_book' => $idLBRange,
        'time'        => $time,
      );

      $data = array(
        'code'        => $id_down,
        'technician' => $technician
      );

      $upd = $this->LogModel->updateRange($this->tbl_lb_det_time,$data,$where);

      $time = $hour.":".$minutes;
    }

    if($upd){
      $respone = "sukses";
    }else{
      $respone = "gagal";
    }
    
    $return = array('respone' => $respone, 'id' => $id_down);
    echo json_encode($return);
    // echo $id_down;exit();
  }

  public function update_time(){
    $id = $this->input->post('id_det_time');
    $id_down = $this->input->post('id_down');
    $technician = $this->input->post('technician');
    $data = array(
        'code' => $id_down,
        'technician' => $technician
    );

    $upd = $this->LogModel->update($this->tbl_lb_det_time,$data,$id);
    if($upd){
      $respone = "sukses";
    }else{
      $respone = "gagal";
    }
    
    $return = array('respone' => $respone, 'id' => $id_down);
    echo json_encode($return);
    // echo $id_down;exit();
  }

  // GET PRODUCTS --ir
  public function getProducts(){
    $shift  = $this->input->post('shift');
    $pr     = $this->LogModel->getProducts();
    $option = "";

    if($pr){
      foreach ($pr as $pr) {
        $option .= '<option value="'.$pr->id.'">'.$pr->product_name.'</option>';
      };
      $respone = "sukses";
    }else{
      $respone = "gagal";
    }
    
    $return = array('respone' => $respone, 'option' => $option);
    echo json_encode($return);
  }

  // ADD PRODUCTS --ir
  public function addProduct(){
    $id_lb         = $this->input->post('id_lb');
    $idProduct     = $this->input->post('idProduct');
    $productBatch  = $this->input->post('productBatch');
    $productGood   = $this->input->post('productGood');
    $productReject = $this->input->post('productReject');

    $where = 'id_log_book = '.$id_lb.' and product_batch = '.$productBatch.' ';
    $cek = $this->LogModel->count('log_book_det_product',$where);
    if($cek->jml <= 0){
      $data = array(
          'id_log_book'     => $id_lb,
          'id_product'      => $idProduct,
          'product_batch'   => $productBatch,
          'product_good'    => $productGood,
          'product_reject'  => $productReject,
      );
      $ins = $this->LogModel->insert_det('log_book_det_product',$data);
      $respone = "sukses";
    }else{
      $respone = "gagal";
    }
    
    $return = array('respone' => $respone);
    echo json_encode($return);
  }

  // DELETE PRODUCT --ir
  public function delProduct(){
    $id = $this->input->post('id');

    $data = array('id' => $id );
    $del = $this->LogModel->delete('log_book_det_product',$data);
    if($del){
      $respone = "sukses";
    }else{
      $respone = "gagal";
    }
    
    $return = array('respone' => $respone);
    echo json_encode($return);
  }

  public function get_operator(){
    $shift = $this->input->post('shift');
    $op = $this->LogModel->get_pic($shift,'Operator');
    $option = "";

    if($op){
      foreach ($op as $op) {
        $option .= '<option value="'.$op->id.'">'.$op->name.'</option>';
      };
      $respone = "sukses";
    }else{
      $respone = "gagal";
    }
    
    $return = array('respone' => $respone, 'option' => $option);
    echo json_encode($return);
  }


  public function tambah_op(){
    $id_lb = $this->input->post('id_lb');
    $id_op = $this->input->post('id_op');
    
    $where = 'id_log_book = '.$id_lb.' and id_pic = '.$id_op.' ';
    $cek = $this->LogModel->count('log_book_det_operator',$where);
    // echo $cek->jml;exit();
    if($cek->jml <= 0){
      $data = array(
          'id_log_book' => $id_lb,
          'id_pic' => $id_op,
      );
      $ins = $this->LogModel->insert_det('log_book_det_operator',$data);
      $respone = "sukses";
    }else{
      $respone = "gagal";
    }
    
    $return = array('respone' => $respone);
    echo json_encode($return);
  }

  public function hapus_hist_op(){
    $id = $this->input->post('id');

    $data = array('id' => $id );
    $del = $this->LogModel->delete('log_book_det_operator',$data);
    // echo $cek->jml;exit();
    if($del){
      $respone = "sukses";
    }else{
      $respone = "gagal";
    }
    
    $return = array('respone' => $respone);
    echo json_encode($return);
    // echo $id_down;exit();
  }

  // LOCK DATA SHIFT --ir
  public function lock_shift($act){
    $id = $this->input->post('id');
    if($act == 'unlock') $state = 'open'; else $state = 'lock';

    $data = array(
        'state' => $state,
        'user_locked' => $this->session->userdata('id_users'),
        'time_locked' => date('Y-m-d H:i')
    );

    $upd = $this->LogModel->update($this->tbl_lb,$data,$id);
    // echo $cek->jml;exit();
    if($upd){
      $respone = "sukses";
    }else{
      $respone = "gagal";
    }
    
    $return = array('respone' => $respone);
    echo json_encode($return);
    // echo $id_down;exit();
  }

  // SAVE DATA SHIFT 1,2,3 --ir
  public function save_shift(){
    $id = $this->input->post('id');
    $id_ldr = $this->input->post('id_ldr');
    $id_product = $this->input->post('id_product');
    $id_batch = $this->input->post('id_batch');
    $id_baik = $this->input->post('id_baik');
    $id_reject = $this->input->post('id_reject');
    $note = $this->input->post('note');
    $freq_bd = $this->input->post('freq_bd');
    $speed = $this->input->post('speed');

    $data = array(
        'leader' => $id_ldr,
        'product' => $id_product,
        'product_batch' => $id_batch,
        'product_good' => $id_baik,
        'product_reject' => $id_reject,
        'note' => $note,
        'freq_bd' => $freq_bd,
        'speed' => $speed,
    );

    $upd = $this->LogModel->update($this->tbl_lb,$data,$id);
    // echo $cek->jml;exit();
    if($upd){
      $respone = "sukses";
    }else{
      $respone = "gagal";
    }
    
    $return = array('respone' => $respone);
    echo json_encode($return);
    // echo $id_down;exit();
  }

  public function show_report(){
    $id_machine = $this->input->post('id_machine');
    $date = $this->input->post('date');
    date_default_timezone_set('Asia/Jakarta');
    $tgl = date("Y-m-d", strtotime($date));
    $return = array();
    $id_down = $this->input->post('id_down');

    // echo $tgl;exit();

    $hdr = '';
    $grp = '';
    if($id_down == 1){
      $grp = 'RT';
      $hdr = '1. Run Mesin';
    }elseif ($id_down == 2) {
      $grp = 'PDT';
      $hdr = '2. Planned Down Time';
    }elseif ($id_down == 3) {
      $grp = 'UDT';
      $hdr = '3. Unplanned Down Time';
    }elseif ($id_down == 4) {
      $grp = 'IT';
      $hdr = '4. Idle Time';
    }elseif ($id_down == 5) {
      $grp = 'UT';
      $hdr = '5. Utility';
    }elseif ($id_down == 6) {
      $grp = '';
      $hdr = '';
    }

    if($id_down==1){
      $return = $this->show_report_1($id_down,$tgl,$grp,$hdr,$id_machine);
    }elseif ($id_down>=2 && $id_down<=5) {
      $return = $this->show_report_2_5($id_down,$tgl,$grp,$hdr,$id_machine);
    }else{
      $return = $this->show_report_6($id_down,$tgl,$grp,$hdr,$id_machine);
    }
    echo json_encode($return);

  }

  public function show_report_1($id_down,$tgl,$grp,$hdr,$id_machine){
    $rpt='';

    $get_rpt = $this->LogModel->report_daily($tgl,$grp,$id_machine);
    $rpt.="
      <table class='table table-bordered'>
        <thead>
          <tr class='header'>
            <th rowspan='2' class='align-middle' style='background-color: #404E67;color: white;'><div><center>Legend Code</center></div></th>
            <th colspan='3' style='background-color: #404E67;color: white;'><div><center>Shift</center></div></th>
          </tr>
          <tr class='header'>
            <th style='background-color: #404E67;color: white;'><div><center>1</center></div></th>
            <th style='background-color: #404E67;color: white;'><div><center>2</center></div></th>
            <th style='background-color: #404E67;color: white;'><div><center>3</center></div></th>
          </tr>
        </thead>
        <tbody>";
    $t_shift1=0;
    $t_shift2=0;
    $t_shift3=0;
    foreach ($get_rpt as $get_rpt) {
      $rpt.="
          <tr>
            <td>".$hdr."</td>
            <td><center>".($get_rpt->shift1*5)."</center></td>
            <td><center>".($get_rpt->shift2*5)."</center></td>
            <td><center>".($get_rpt->shift3*5)."</center></td>
          </tr>";
      $t_shift1 +=($get_rpt->shift1*5);
      $t_shift2 +=($get_rpt->shift2*5);
      $t_shift3 +=($get_rpt->shift3*5);
    }

    $rpt.="
          <tr>
            <td><span class='pull-right'>SUB TOTAL</span></td>
            <td><center>".$t_shift1."</center></td>
            <td><center>".$t_shift2."</center></td>
            <td><center>".$t_shift3."</center></td>
          </tr>
        </tbody>
      </table>
    ";

    $respone = "sukses";
    $return = array('respone' => $respone,'rpt'=>$rpt,'id_report' => '#id_report_'.$id_down);
    return $return;
  }

  public function show_report_2_5($id_down,$tgl,$grp,$hdr,$id_machine){
    $rpt='';

    $get_rpt = $this->LogModel->report_daily($tgl,$grp,$id_machine);
    $rpt.="
      <table class='table table-bordered'>
        <thead>
          <tr class='header'>
            <th rowspan='2' class='align-middle' style='background-color: #404E67;color: white;'><div><center>Legend Code</center></div></th>
            <th colspan='3' style='background-color: #404E67;color: white;'><div><center>Shift</center></div></th>
          </tr>
          <tr class='header'>
            <th style='background-color: #404E67;color: white;'><div><center>1</center></div></th>
            <th style='background-color: #404E67;color: white;'><div><center>2</center></div></th>
            <th style='background-color: #404E67;color: white;'><div><center>3</center></div></th>
          </tr>
        </thead>
        <tbody>";
    $rpt.="
          <tr>
            <td>".$hdr."</td>
            <td><center></center></td>
            <td><center></center></td>
            <td><center></center></td>
          </tr>";

    $t_shift1=0;
    $t_shift2=0;
    $t_shift3=0;
    foreach ($get_rpt as $get_rpt) {
      $rpt.="
          <tr>
            <td>".$get_rpt->name."</td>
            <td><center>".($get_rpt->shift1*5)."</center></td>
            <td><center>".($get_rpt->shift2*5)."</center></td>
            <td><center>".($get_rpt->shift3*5)."</center></td>
          </tr>";
      $t_shift1+=($get_rpt->shift1*5);
      $t_shift2+=($get_rpt->shift2*5);
      $t_shift3+=($get_rpt->shift3*5);
    }

    $rpt.="
          <tr>
            <td><span class='pull-right'>SUB TOTAL</span></td>
            <td><center>".$t_shift1."</center></td>
            <td><center>".$t_shift2."</center></td>
            <td><center>".$t_shift3."</center></td>
          </tr>
        </tbody>
      </table>
    ";

    $respone = "sukses";
    $return = array('respone' => $respone,'rpt'=>$rpt,'id_report' => '#id_report_'.$id_down);
    return $return;
  }

  public function show_report_6($id_down,$tgl,$grp,$hdr,$id_machine){
    $get_rpt = $this->LogModel->report_result_daily($tgl,$grp,$id_machine);
    $rpt='';

    $rpt.="
      <table class='table table-bordered' id='id_report_6'>
        <thead>
          <tr class='header'>
            <th rowspan='2' class='align-middle' style='background-color: #404E67;color: white;'><div><center>Shift</center></div></th>
            <th rowspan='2' class='align-middle' style='background-color: #404E67;color: white;'><div><center>Produk</center></div></th>
            <th rowspan='2' class='align-middle' style='background-color: #404E67;color: white;'><div><center>No. Batch</center></div></th>
            <th colspan='2' style='background-color: #404E67;color: white;'><div><center>Jumlah Tablet</center></div></th>
          </tr>
          <tr class='header'>
            <th style='background-color: #404E67;color: white;'><div><center>Baik</center></div></th>
            <th style='background-color: #404E67;color: white;'><div><center>Reject</center></div></th>
          </tr>
        </thead>
        <tbody>";
        foreach ($get_rpt as $get_rpt) {
          $rpt.="
          <tr>
            <td><center>".$get_rpt->codeShift."</center></td>
            <td><center>".$get_rpt->product_name."</center></td>
            <td><center>".$get_rpt->product_batch."</center></td>
            <td><center>".$get_rpt->product_good."</center></td>
            <td><center>".$get_rpt->product_reject."</center></td>
          </tr>";
        }
    
    $rpt.="
        </tbody>
    </table>
    ";

    $respone = "sukses";
    $return = array('respone' => $respone,'rpt'=>$rpt,'id_report' => '#id_report_'.$id_down);
    return $return;
  }


}