<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MstMachine extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MstMachineModel');
		$this->load->model('MenuModel');
		$this->load->library('form_validation');
		if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

		$akses= $this->MenuModel->akses_menu2('MstMachine',$this->session->userdata('id_user_level'));
		$this->create =  $akses->create;
		$this->update =  $akses->update;
		$this->delete =  $akses->delete;
	}

	public function index() {
		$data['dataMachine'] = $this->MstMachineModel->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		$this->load->view('MstMachine/templates/Header');
		$this->template->load('template','MstMachine', $data);
		$this->load->view('MstMachine/templates/Footer');
		$this->load->view('MstMachine/_cjs');
		$this->load->view('MstMachine/_mjs');
	}

	private function rules(){
		return[
			['field' => 'machineCode', 'label' => 'machineCode', 'rules'=>'required'],
			['field' => 'machineName', 'label' => 'machineName', 'rules'=>'required'],
			['field' => 'lineId', 'label' => 'lineId', 'rules'=>'required']
		];
	}

	public function insert(){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$this->load->view('MstMachine/templates/Header');
			$this->template->load('template','CreateMachine');
			$this->load->view('MstMachine/templates/Footer');
			$this->load->view('MstMachine/_cjs');
			$this->load->view('MstMachine/_mjs');
		}else{
			$data['machineCode'] = $this->input->post('machineCode');
			$data['machineName'] = $this->input->post('machineName');
			$data['lineId'] = $this->input->post('lineId');
			$this->MstMachineModel->insert($data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil disimpan")</script>');
			redirect(base_url('MstMachine'));
		}
	}

	public function edit($id){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['mstMachine'] = $this->MstMachineModel->getId($id);
			$this->load->view('MstMachine/templates/Header');
			$this->template->load('template','EditMachine', $data);
			$this->load->view('MstMachine/templates/Footer');
			$this->load->view('MstMachine/_cjs');
			$this->load->view('MstMachine/_mjs');
		}else{
			$data['machineCode'] = $this->input->post('machineCode');
			$data['machineName'] = $this->input->post('machineName');
			$data['lineId'] = $this->input->post('lineId');
			$this->MstMachineModel->edit($id,$data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil diubah")</script>');
			redirect(base_url('MstMachine'));
		}
	}
	public function delete($id){
		$this->MstMachineModel->delete($id);
		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil dihapus")</script>');
		redirect(base_url('MstMachine'));
	}
}