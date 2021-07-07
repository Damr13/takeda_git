<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MstShift extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MstShiftModel');
		$this->load->model('MenuModel');
		$this->load->library('form_validation');
		if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

		$akses= $this->MenuModel->akses_menu2('MstShift',$this->session->userdata('id_user_level'));
		$this->create =  $akses->create;
		$this->update =  $akses->update;
		$this->delete =  $akses->delete;
	}

	public function index() {
		$data['dataShift'] = $this->MstShiftModel->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		$this->load->view('MstShift/templates/Header');
		$this->template->load('template','MstShift', $data);
		$this->load->view('MstShift/templates/Footer');
		$this->load->view('MstShift/_cjs');
		$this->load->view('MstShift/_mjs');
	}

	private function rules(){
		return[
			['field' => 'codeShift', 'label' => 'codeShift', 'rules'=>'required'],
			['field' => 'startShift', 'label' => 'startShift', 'rules'=>'required'],
			['field' => 'endShift', 'label' => 'endShift', 'rules'=>'required']
		];
	}

	public function insert(){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('MstShift/templates/Header');
			$this->template->load('template','CreateShift',$data);
			$this->load->view('MstShift/templates/Footer');
			$this->load->view('MstShift/_cjs');
			$this->load->view('MstShift/_mjs');
		}else{
			$data['codeShift'] = $this->input->post('codeShift');
			$data['startShift'] = $this->input->post('startShift');
			$data['endShift'] = $this->input->post('endtShift');
			$this->MstShiftModel->insert($data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil disimpan")</script>');
			redirect(base_url('MstShift'));
		}
	}

	public function edit($id){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['mstShift'] = $this->MstShiftModel->getId($id);
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('MstShift/templates/Header');
			$this->template->load('template','EditShift', $data);
			$this->load->view('MstShift/templates/Footer');
			$this->load->view('MstShift/_cjs');
			$this->load->view('MstShift/_mjs');
		}else{
			$data['codeShift'] = $this->input->post('codeShift');
			$data['startShift'] = $this->input->post('startShift');
			$data['endShift'] = $this->input->post('endShift');
			$this->MstShiftModel->edit($id,$data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil diubah")</script>');
			redirect(base_url('MstShift'));
		}
	}
	public function delete($id){
		$this->MstShiftModel->delete($id);
		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil dihapus")</script>');
		redirect(base_url('MstShift'));
	}
}