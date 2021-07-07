<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MstTargetOEE extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MstTargetOEEModel');
		$this->load->model('MenuModel');
		$this->load->library('form_validation');
		if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

		$akses= $this->MenuModel->akses_menu2('MstTargetOEE',$this->session->userdata('id_user_level'));
		$this->create =  $akses->create;
		$this->update =  $akses->update;
		$this->delete =  $akses->delete;
	}

	public function index() {
		$data['dataTarget'] = $this->MstTargetOEEModel->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		$this->load->view('MstTargetOEE/templates/Header');
		$this->template->load('template','MstTargetOEE', $data);
		$this->load->view('MstTargetOEE/templates/Footer');
		$this->load->view('MstTargetOEE/_cjs');
		$this->load->view('MstTargetOEE/_mjs');
	}

	// ADD YEAR TARGET --ir
	public function addYear(){
		$checkYear = $this->MstTargetOEEModel->checkYear();
		$nextYear	 = $checkYear->prevYear + 1;
		$data = array('year' => $nextYear );

		$add = $this->MstTargetOEEModel->add('mst_target_oee',$data);
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

    $upd = $this->MstTargetOEEModel->update("mst_target_oee",$data,$id);
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
			$this->load->view('MstTargetOEE/templates/Header');
			$this->template->load('template','CreateDowntime');
			$this->load->view('MstTargetOEE/templates/Footer');
			$this->load->view('MstTargetOEE/_cjs');
			$this->load->view('MstTargetOEE/_mjs');
		}else{
			$data['downtimeCode'] = $this->input->post('downtimeCode');
			$data['downtimeName'] = $this->input->post('downtimeName');
			$data['downtimeGroup'] = $this->input->post('downtimeGroup');
			$this->MstTargetOEEModel->insert($data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil disimpan")</script>');
			redirect(base_url('MstTargetOEE'));
		}
	}

	public function edit($id){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['MstTargetOEE'] = $this->MstTargetOEEModel->getId($id);
			$this->load->view('MstTargetOEE/templates/Header');
			$this->template->load('template','EditDowntime', $data);
			$this->load->view('MstTargetOEE/templates/Footer');
			$this->load->view('MstTargetOEE/_cjs');
			$this->load->view('MstTargetOEE/_mjs');
		}else{
			$data['downtimeCode'] = $this->input->post('downtimeCode');
			$data['downtimeName'] = $this->input->post('downtimeName');
			$data['downtimeGroup'] = $this->input->post('downtimeGroup');
			$this->MstTargetOEEModel->edit($id,$data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil diubah")</script>');
			redirect(base_url('MstTargetOEE'));
		}
	}
	public function delete($id){
		$this->MstTargetOEEModel->delete($id);
		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil dihapus")</script>');
		redirect(base_url('MstTargetOE'));
	}
}