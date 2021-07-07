<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MstDowntime extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MstDowntimeModel');
		$this->load->model('MenuModel');
		$this->load->library('form_validation');
		if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

		$akses= $this->MenuModel->akses_menu2('MstDowntime',$this->session->userdata('id_user_level'));
		$this->create =  $akses->create;
		$this->update =  $akses->update;
		$this->delete =  $akses->delete;
	}

	public function index() {
		$data['dataDowntime'] = $this->MstDowntimeModel->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		$this->load->view('MstDowntime/templates/Header');
		$this->template->load('template','MstDowntime', $data);
		$this->load->view('MstDowntime/templates/Footer');
		$this->load->view('MstDowntime/_cjs');
		$this->load->view('MstDowntime/_mjs');
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
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('MstDowntime/templates/Header');
			$this->template->load('template','CreateDowntime',$data);
			$this->load->view('MstDowntime/templates/Footer');
			$this->load->view('MstDowntime/_cjs');
			$this->load->view('MstDowntime/_mjs');
		}else{
			$data['downtimeCode'] = $this->input->post('downtimeCode');
			$data['downtimeName'] = $this->input->post('downtimeName');
			$data['downtimeGroup'] = $this->input->post('downtimeGroup');
			$this->MstDowntimeModel->insert($data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil disimpan")</script>');
			redirect(base_url('MstDowntime'));
		}
	}

	public function edit($id){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['mstDowntime'] = $this->MstDowntimeModel->getId($id);
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('MstDowntime/templates/Header');
			$this->template->load('template','EditDowntime', $data);
			$this->load->view('MstDowntime/templates/Footer');
			$this->load->view('MstDowntime/_cjs');
			$this->load->view('MstDowntime/_mjs');
		}else{
			$data['downtimeCode'] = $this->input->post('downtimeCode');
			$data['downtimeName'] = $this->input->post('downtimeName');
			$data['downtimeGroup'] = $this->input->post('downtimeGroup');
			$this->MstDowntimeModel->edit($id,$data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil diubah")</script>');
			redirect(base_url('MstDowntime'));
		}
	}
	public function delete($id){
		$this->MstDowntimeModel->delete($id);
		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil dihapus")</script>');
		redirect(base_url('MstDowntime'));
	}
}