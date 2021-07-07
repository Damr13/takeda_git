<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_akses extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Menu_aksesModel','mdl');
		$this->load->model('MenuModel');
		$this->load->library('session');
        if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}
	}

	public function index(){	
		$kolom = 'id_user_level,nama_level';
	    $tabel = 'tbl_user_level';
	    $join  = '';
	    $where = '';
	    $order = '';
	    $user_level = $this->mdl->select_result($tabel,$join,$where,$kolom,$order);

		$data = array(		
      		'menu'		=> $this->MenuModel->akses_menu($this->session->userdata('id_user_level')),
      		'user_level'=> $user_level
		);
		$this->load->view('templates/Header');
		$this->template->load('template','Menu_akses',$data);
		$this->load->view('templates/Footer');
		$this->load->view('templates/_data_js');
	}


	public function table(){
		$id_level = $this->input->post('id_level');

		$kolom = 'a.id as id_akses,a.id_menu,a.id_level,a.create,a.update,a.delete,b.title_menu,b.icon_menu,
		b.link,b.parentID,b.id_status';
	    $tabel = '_level_menu a';
	    $join  = 'LEFT JOIN _menu b on a.id_menu = b.id_menu';
	    $where = 'WHERE b.parentID = 0 and a.id_level = '.$id_level.' and b.id_status = 1';
	    $order = 'ORDER BY a.id_menu ASC';
	    $data = $this->mdl->select_result($tabel,$join,$where,$kolom,$order);

	    $tabel="";
	    $no = 1;
		foreach ($data as $data) {

			$btn_sub_menu = '<button type="button" class="btn btn-outline btn-success btn-xs" onclick="add_submenu_akses(\''.$data->id_menu.'\')"><i class="fa fa-plus"></i> Sub Menu Akses</button>';
			$btn_hps = '<button type="button" class="btn btn-outline btn-danger btn-xs" onclick="hapus_menu_akses(\''.$data->id_akses.'\')"><i class="fa fa-trash"></i></button>';
			// $cr= $upd = $del = 'NO';
			// if($data->create == 1){
			// 	$cr = 'YES';
			// }

			// if($data->update == 1){
			// 	$upd = 'YES';
			// }

			// if($data->delete == 1){
			// 	$del = 'YES';
			// }

			$tabel.= '
				<tr>
					<td><center>'.$no.'</center></td>
					<td>'.$data->title_menu.'</td>
					<td colspan="3"></td>
					<td><center>'.$btn_hps.' '.$btn_sub_menu.'</center></td>
				</tr>
			';

			$kolom_sub = 'a.id as id_akses,a.id_menu,a.id_level,a.create,a.update,a.delete,b.title_menu,b.icon_menu,
			b.link,b.parentID,b.id_status';
		    $tabel_sub = '_level_menu a';
		    $join_sub  = 'LEFT JOIN _menu b on a.id_menu = b.id_menu ';
		    $where_sub = 'WHERE b.parentID = '.$data->id_menu.' and a.id_level = '.$id_level.' and b.id_status = 1';
		    $order_sub = 'ORDER BY b.id_menu ASC';
		    $data_sub = $this->mdl->select_result($tabel_sub,$join_sub,$where_sub,$kolom_sub,$order_sub);
		    foreach ($data_sub as $data_sub) {
		    	$btn_hps = '<button type="button" class="btn btn-outline btn-danger btn-xs" onclick="hapus_menu_akses(\''.$data_sub->id_akses.'\')"><i class="fa fa-trash"></i></button>';

		    	$cr= $upd = $del = 'NO';
				if($data_sub->create == 1){
					$cr = 'YES';
				}

				if($data_sub->update == 1){
					$upd = 'YES';
				}

				if($data_sub->delete == 1){
					$del = 'YES';
				}

		    	$tabel.= '
					<tr>
						<td></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;'.$data_sub->title_menu.'</td>
						<td><center>'.$cr.'</center></td>
						<td><center>'.$upd.'</center></td>
						<td><center>'.$del.'</center></td>
						<td><center>'.$btn_hps.'</center></td>
					</tr>
				';
		    }
			
			$no++;
		}
		
		$respone = "sukses";
		$return = array('respone' => $respone, 'tabel' => $tabel);
		echo json_encode($return);
	}


	public function add_menu_akses(){
		$id_level = $this->input->post('id_level');

		$kolom = 'id_user_level,nama_level';
	    $tabel = 'tbl_user_level';
	    $join  = '';
	    $where = 'WHERE id_user_level = '.$id_level.' ';
	    $order = '';
	    $level = $this->mdl->select_row($tabel,$join,$where,$kolom,$order);


	    $kolom = 'id_menu,title_menu,parentID,id_status';
	    $tabel = '_menu';
	    $join  = '';
	    $where = 'WHERE parentID = 0 AND id_status = 1
					and id_menu NOT IN 
						(SELECT id_menu
						from _level_menu
						WHERE id_level = '.$id_level.') ';
	    $order = 'ORDER BY id_menu ASC';
	    $menu = $this->mdl->select_result($tabel,$join,$where,$kolom,$order);
	    $option = "";

	    if($menu){
	    	$option .='<select class="select2_demo_1 form-control">';
	    	foreach ($menu as $menu) {
	    		$option .='<option value='.$menu->id_menu.'>'.$menu->title_menu.'</option>';
	    	}
	    	$option .='</select>';
	      $respone = "sukses";
	    }else{
	      $respone = "gagal";
	    }

	    
	    $return = array('respone' => $respone,'nama_level' => $level->nama_level,'option' => $option);
	    echo json_encode($return);
	}

	public function add_menu(){
		$id_level = $this->input->post('id_level');
		$id_menu = $this->input->post('id_menu');
		// $create = $this->input->post('create');
		// $update = $this->input->post('update');
		// $delete = $this->input->post('deletee');

		$data = array(
			'id_level' => $id_level,
	        'id_menu' => $id_menu,
	        // 'create' => $create,
	        // 'update' => $update,
	        // 'delete' => $delete,
	    );

	    $insert = $this->mdl->insert_det('_level_menu',$data); 
	    // echo $cek->jml;exit();
	    if($insert){
	      $respone = "sukses";
	    }else{
	      $respone = "gagal";
	    }
	    
	    $return = array('respone' => $respone);
	    echo json_encode($return);
	}

	public function add_submenu(){
		$id_level = $this->input->post('id_level');
		$id_menu = $this->input->post('id_menu');
		$create = $this->input->post('create');
		$update = $this->input->post('update');
		$delete = $this->input->post('deletee');

		$data = array(
			'id_level' => $id_level,
	        'id_menu' => $id_menu,
	        'create' => $create,
	        'update' => $update,
	        'delete' => $delete,
	    );

	    $insert = $this->mdl->insert_det('_level_menu',$data); 
	    // echo $cek->jml;exit();
	    if($insert){
	      $respone = "sukses";
	    }else{
	      $respone = "gagal";
	    }
	    
	    $return = array('respone' => $respone);
	    echo json_encode($return);
	}


	public function add_submenu_akses(){
		$id_level = $this->input->post('id_level');
		$parent = $this->input->post('parent');

		$kolom = 'id_user_level,nama_level';
	    $tabel = 'tbl_user_level';
	    $join  = '';
	    $where = 'WHERE id_user_level = '.$id_level.' ';
	    $order = '';
	    $level = $this->mdl->select_row($tabel,$join,$where,$kolom,$order);


	    $kolom = 'id_menu,title_menu,parentID,id_status';
	    $tabel = '_menu';
	    $join  = '';
	    $where = 'WHERE parentID = '.$parent.' AND id_status = 1
					and id_menu NOT IN 
						(SELECT id_menu
						from _level_menu
						WHERE id_level = '.$id_level.') ';
	    $order = 'ORDER BY id_menu ASC';
	    $menu = $this->mdl->select_result($tabel,$join,$where,$kolom,$order);
	    $option = "";

	    if($menu){
	    	$option .='<select class="select2_demo_1 form-control">';
	    	foreach ($menu as $menu) {
	    		$option .='<option value='.$menu->id_menu.'>'.$menu->title_menu.'</option>';
	    	}
	    	$option .='</select>';
	      $respone = "sukses";
	    }else{
	      $respone = "gagal";
	    }

	    
	    $return = array('respone' => $respone,'nama_level' => $level->nama_level,'option' => $option);
	    echo json_encode($return);
	}

	public function hapus_menu_akses(){
		$id = $this->input->post('id');

		$data = array('id' => $id );
    	$del = $this->mdl->delete('_level_menu',$data);

    	if($del){
	      $respone = "sukses";
	    }else{
	      $respone = "gagal";
	    }
	    
	    $return = array('respone' => $respone);
	    echo json_encode($return);
	}

}