<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MstTarget extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MstTargetModel');
		$this->load->model('MenuModel');
		$this->load->library('form_validation');
		if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

		$akses= $this->MenuModel->akses_menu2('MstTarget',$this->session->userdata('id_user_level'));
		$this->create =  $akses->create;
		$this->update =  $akses->update;
		$this->delete =  $akses->delete;
	}

	public function index() {
		$data['dataTarget'] = $this->MstTargetModel->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		$this->load->view('MstTarget/templates/Header');
		$this->template->load('template','MstTarget', $data);
		$this->load->view('MstTarget/templates/Footer');
		$this->load->view('MstTarget/_cjs');
		$this->load->view('MstTarget/_mjs');
	}

	// ADD YEAR TARGET --ir
	public function addYear(){
		$checkYear = $this->MstTargetModel->checkYear();
		$nextYear	 = $checkYear->prevYear + 1;
		$data = array('year' => $nextYear );

		$add = $this->MstTargetModel->add('mst_target',$data);
		if($del){
			$respone = "sukses";
		}else{
			$respone = "gagal";
		}
		
		$return = array('respone' => $respone);
		echo json_encode($return);
	}

	// UPDATE TARGET --ir
  public function updateTarget(){
    $id 			= $this->input->post('idTarget');
		$year 		= $this->input->post('year');
		$jan			= $this->input->post('jan');
		$feb			= $this->input->post('feb');
		$mar			= $this->input->post('mar');
		$apr			= $this->input->post('apr');
		$may			= $this->input->post('may');
		$jun			= $this->input->post('jun');
		$jul			= $this->input->post('jul');
		$aug			= $this->input->post('aug');
		$sep			= $this->input->post('sep');
		$oct			= $this->input->post('oct');
		$nov			= $this->input->post('nov');
		$dec			= $this->input->post('dec');
		
    $data = array(
			'jan'	=> $jan,
			'feb'	=> $feb,
			'mar'	=> $mar,
			'apr'	=> $apr,
			'may'	=> $may,
			'jun'	=> $jun,
			'jul'	=> $jul,
			'aug'	=> $aug,
			'sep'	=> $sep,
			'oct'	=> $oct,
			'nov'	=> $nov,
			'dec'	=> $dec,
    );

    $upd = $this->MstTargetModel->update("mst_target",$data,$id);
    if($upd){
      $respone = "sukses";
    }else{
      $respone = "gagal";
    }
    
    $return = array('respone' => $respone, 'id' => $id);
    echo json_encode($return);
    // echo $id_down;exit();
  }

	private function rules(){
		return[
			['field' => 'downtimeCode', 'label' => 'downtimeCode', 'rules'=>'required'],
			['field' => 'downtimeName', 'label' => 'downtimeName', 'rules'=>'required'],
			['field' => 'downtimeGroup', 'label' => 'downtimeGroup', 'rules'=>'required']
		];
	}

	public function insert(){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$this->load->view('MstTarget/templates/Header');
			$this->template->load('template','CreateDowntime');
			$this->load->view('MstTarget/templates/Footer');
			$this->load->view('MstTarget/_cjs');
			$this->load->view('MstTarget/_mjs');
		}else{
			$data['downtimeCode'] = $this->input->post('downtimeCode');
			$data['downtimeName'] = $this->input->post('downtimeName');
			$data['downtimeGroup'] = $this->input->post('downtimeGroup');
			$this->MstTargetModel->insert($data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil disimpan")</script>');
			redirect(base_url('MstTarget'));
		}
	}

	public function edit($id){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['MstTarget'] = $this->MstTargetModel->getId($id);
			$this->load->view('MstTarget/templates/Header');
			$this->template->load('template','EditDowntime', $data);
			$this->load->view('MstTarget/templates/Footer');
			$this->load->view('MstTarget/_cjs');
			$this->load->view('MstTarget/_mjs');
		}else{
			$data['downtimeCode'] = $this->input->post('downtimeCode');
			$data['downtimeName'] = $this->input->post('downtimeName');
			$data['downtimeGroup'] = $this->input->post('downtimeGroup');
			$this->MstTargetModel->edit($id,$data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil diubah")</script>');
			redirect(base_url('MstTarget'));
		}
	}
	public function delete($id){
		$this->MstTargetModel->delete($id);
		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil dihapus")</script>');
		redirect(base_url('MstTarget'));
	}
}