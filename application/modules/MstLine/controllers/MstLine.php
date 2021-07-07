<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MstLine extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MstLineModel');
		$this->load->model('MenuModel');
		$this->load->library('form_validation');
		if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

		$akses= $this->MenuModel->akses_menu2('MstLine',$this->session->userdata('id_user_level'));
		$this->create =  $akses->create;
		$this->update =  $akses->update;
		$this->delete =  $akses->delete;
	}

	public function index() {
		$data['dataLine'] = $this->MstLineModel->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		$this->load->view('MstLine/templates/Header');
		$this->template->load('template','MstLine', $data);
		$this->load->view('MstLine/templates/Footer');
		$this->load->view('MstLine/_cjs');
		$this->load->view('MstLine/_mjs');
	}

	private function rules(){
		return[
			['field' => 'lineId', 'label' => 'lineId', 'rules'=>'required'],
			['field' => 'lineName', 'label' => 'lineName', 'rules'=>'required']
		];
	}

	public function insert(){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('MstLine/templates/Header');
			$this->template->load('template','CreateLine',$data);
			$this->load->view('MstLine/templates/Footer');
			$this->load->view('MstLine/_cjs');
			$this->load->view('MstLine/_mjs');
		}else{
			$data['lineId'] = $this->input->post('lineId');
			$data['lineName'] = $this->input->post('lineName');
			$this->MstLineModel->insert($data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil disimpan")</script>');
			redirect(base_url('MstLine'));
		}
	}

	public function edit($id){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['mstLine'] = $this->MstLineModel->getId($id);
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('MstLine/templates/Header');
			$this->template->load('template','EditLine', $data);
			$this->load->view('MstLine/templates/Footer');
			$this->load->view('MstLine/_cjs');
			$this->load->view('MstLine/_mjs');
		}else{
			$data['lineId'] = $this->input->post('lineId');
			$data['lineName'] = $this->input->post('lineName');
			$this->MstLineModel->edit($id,$data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil diubah")</script>');
			redirect(base_url('MstLine'));
		}
	}
	public function delete($id){
		$this->MstLineModel->delete($id);
		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil dihapus")</script>');
		redirect(base_url('MstLine'));
	}
}