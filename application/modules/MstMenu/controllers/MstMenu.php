<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MstMenu extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MstMenuModel','mdl');
		$this->load->model('MenuModel');
		$this->load->library('session');
        if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}
	}

	public function index(){	
		$data = array(		
      		'menu'		=> $this->MenuModel->akses_menu($this->session->userdata('id_user_level'))
		);
		$this->load->view('templates/Header');
		$this->template->load('template','MstMenu',$data);
		$this->load->view('templates/Footer');
		$this->load->view('templates/_data_js');
	}


	public function table(){
		

		$kolom = 'a.id_menu,a.title_menu,a.icon_menu,a.link,a.parentID,a.id_status';
	    $tabel = '_menu a';
	    $join  = '';
	    $where = 'WHERE a.parentID = 0';
	    $order = 'ORDER BY a.id_menu ASC';
	    $data = $this->mdl->select_result($tabel,$join,$where,$kolom,$order);

	    $tabel="";
	    $no = 1;
		foreach ($data as $data) {
			if($data->id_status == 1){
				$btn_sts = '<button type="button" class="btn btn-outline btn-primary btn-xs" onclick="update_status(\''.$data->id_menu.'\',\'0\')"><i class="fa fa-check"></i></button>';
			}else{
				$btn_sts = '<button type="button" class="btn btn-outline btn-danger btn-xs" onclick="update_status(\''.$data->id_menu.'\',\'1\')"><i class="fa fa-times"></i></button>';
			}

			$btn_sub_menu = '<button type="button" class="btn btn-outline btn-success btn-xs" onclick="add_submenu(\''.$data->id_menu.'\')"><i class="fa fa-plus"></i> Sub Menu</button>';
			$btn_edit = '<button type="button" class="btn btn-outline btn-warning btn-xs" onclick="modal_update_menu(\''.$data->id_menu.'\',\''.$data->title_menu.'\',\''.$data->icon_menu.'\')"><i class="fa fa-pencil"></i></button>';

			$tabel.= '
				<tr>
					<td><center>'.$no.'</center></td>
					<td>'.$data->title_menu.'</td>
					<td>'.$data->icon_menu.'</td>
					<td>'.$data->link.'</td>
					<td><center>'.$btn_sts.' '.$btn_edit.' '.$btn_sub_menu.'</center></td>
				</tr>
			';

			$kolom_sub = 'a.id_menu,a.title_menu,a.icon_menu,a.link,a.parentID,a.id_status';
		    $tabel_sub = '_menu a';
		    $join_sub  = '';
		    $where_sub = 'WHERE a.parentID = '.$data->id_menu.'';
		    $order_sub = 'ORDER BY a.id_menu ASC';
		    $data_sub = $this->mdl->select_result($tabel_sub,$join_sub,$where_sub,$kolom_sub,$order_sub);
		    foreach ($data_sub as $data_sub) {
		    	if($data_sub->id_status == 1){
					$btn_sts_sub = '<button type="button" class="btn btn-outline btn-primary btn-xs" onclick="update_status(\''.$data_sub->id_menu.'\',\'0\')"><i class="fa fa-check"></i></button>';
				}else{
					$btn_sts_sub = '<button type="button" class="btn btn-outline btn-danger btn-xs" onclick="update_status(\''.$data_sub->id_menu.'\',\'1\')"><i class="fa fa-times"></i></button>';
				}

				$btn_edit_sub = '<button type="button" class="btn btn-outline btn-warning btn-xs" onclick="modal_update_submenu(\''.$data_sub->id_menu.'\',\''.$data_sub->title_menu.'\',\''.$data_sub->link.'\')"><i class="fa fa-pencil"></i></button>';
		    	$tabel.= '
					<tr>
						<td></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;'.$data_sub->title_menu.'</td>
						<td>'.$data_sub->icon_menu.'</td>
						<td>'.$data_sub->link.'</td>
						<td><center>'.$btn_sts_sub.' '.$btn_edit_sub.'</center></td>
					</tr>
				';
		    }
			
			$no++;
		}

		// $tabel.= '
		// 		<tr>
		// 			<td class="fixed-side">&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</td>
		// 			<td style="text-align:right !important">'.$this->format_angkat($total_plan).'</td>
		// 			<td style="text-align:right !important">'.$this->format_angkat($total_actual).'</td>
		// 			<td colspan="8"></td>
		// 		</tr>
		// 	';

		// print_r($grp);exit();


		// $tabel.= '
  //        <script>

  //           $(document).ready(function() {
  //               jQuery(".main-table").clone(true).appendTo(".table-scroll").addClass("clone"); 
  //           });
  //        </script>
		// ';
		

		
		$respone = "sukses";
		$return = array('respone' => $respone, 'tabel' => $tabel);
		echo json_encode($return);
	}


	public function update_status(){
		$id_menu = $this->input->post('id_menu');
		$sts = $this->input->post('sts');

		$param = array('id_menu' => $id_menu);

		$data = array(
	        'id_status' => $sts,
	    );

	    $upd = $this->mdl->update_2('_menu',$data,$param);
	    // echo $cek->jml;exit();
	    if($upd){
	      $respone = "sukses";
	    }else{
	      $respone = "gagal";
	    }
	    
	    $return = array('respone' => $respone);
	    echo json_encode($return);
	}


	public function update_menu(){
		$id_menu = $this->input->post('id');
		$title_menu = $this->input->post('val');
		$icon_menu = $this->input->post('icon');

		$param = array('id_menu' => $id_menu);

		$data = array(
	        'title_menu' => $title_menu,
	        'icon_menu' => $icon_menu,
	    );

	    $upd = $this->mdl->update_2('_menu',$data,$param);
	    // echo $cek->jml;exit();
	    if($upd){
	      $respone = "sukses";
	    }else{
	      $respone = "gagal";
	    }
	    
	    $return = array('respone' => $respone);
	    echo json_encode($return);
	}

	public function update_submenu(){
		$id_menu = $this->input->post('id');
		$title_menu = $this->input->post('val');
		$link = $this->input->post('link');

		$param = array('id_menu' => $id_menu);

		$data = array(
	        'title_menu' => $title_menu,
	        'link' => $link,
	    );

	    $upd = $this->mdl->update_2('_menu',$data,$param);
	    // echo $cek->jml;exit();
	    if($upd){
	      $respone = "sukses";
	    }else{
	      $respone = "gagal";
	    }
	    
	    $return = array('respone' => $respone);
	    echo json_encode($return);
	}


	public function tambah_submenu(){
		$parentID = $this->input->post('id_parent');
		$title_menu = $this->input->post('nama_submenu');
		$link = $this->input->post('link_submenu');

		$data = array(
			'parentID' => $parentID,
	        'title_menu' => $title_menu,
	        'link' => $link,
	        'id_Status' => 1,
	        'icon_menu' => 'menu-item'
	    );

	    $insert = $this->mdl->insert_det('_menu',$data); 
	    // echo $cek->jml;exit();
	    if($insert){
	      $respone = "sukses";
	    }else{
	      $respone = "gagal";
	    }
	    
	    $return = array('respone' => $respone);
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
		if($rm_budget == 0){
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

		// echo $month;exit();

		$data = array(
	        $f_det => $val,
	    );

	    $upd = $this->mdl->update('budget_det',$data,$id);
	    // echo $cek->jml;exit();
	    if($upd){
	      $respone = "sukses";
	    }else{
	      $respone = "gagal";
	    }
	    
	    $return = array('respone' => $respone);
	    echo json_encode($return);
	}

	public function update_fyb(){
		$tahun = $this->input->post('tahun');
		$type = 'CAPEX';
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
}