<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MstDept extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MstDeptModel');
		$this->load->model('MenuModel');
		$this->load->library('form_validation');
		if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

		$akses= $this->MenuModel->akses_menu2('MstDept',$this->session->userdata('id_user_level'));
		$this->create =  $akses->create;
		$this->update =  $akses->update;
		$this->delete =  $akses->delete;
	}

	public function index() {

		$data['dataDept'] = $this->MstDeptModel->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		$this->load->view('MstDept/templates/Header');
		$this->template->load('template','MstDept', $data);
		$this->load->view('MstDept/templates/Footer');
		$this->load->view('MstDept/_cjs');
		$this->load->view('MstDept/_mjs');
	}

	private function rules(){
		return[
		    
			['field' => 'DeptCode', 'label' => 'DeptCode', 'rules'=>'required'],
			['field' => 'DeptName', 'label' => 'Departement', 'rules'=>'required'],
			['field' => 'DeptCategory', 'label' => 'Category']
		];
	}

	public function insert(){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('MstDept/templates/Header');
			$this->template->load('template','CreateDept', $data);
			$this->load->view('MstDept/templates/Footer');
			$this->load->view('MstDept/_cjs');
			$this->load->view('MstDept/_mjs');
		}else{
			$data['DeptCode'] = $this->input->post('DeptCode');
			$data['DeptName'] = $this->input->post('DeptName');
			$data['DeptCategory'] = $this->input->post('DeptCategory');
			$this->MstDeptModel->insert($data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil disimpan")</script>');
			redirect(base_url('MstDept'));
		}
	}

	public function edit($id){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['mstDept'] = $this->MstDeptModel->getId($id);
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('MstDept/templates/Header');
			$this->template->load('template','EditDept', $data);
			$this->load->view('MstDept/templates/Footer');
			$this->load->view('MstDept/_cjs');
			$this->load->view('MstDept/_mjs');
		}else{
			$data['DeptCode'] = $this->input->post('DeptCode');
			$data['DeptName'] = $this->input->post('DeptName');
			$data['DeptCategory'] = $this->input->post('DeptCategory');
			$this->MstDeptModel->edit($id,$data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil diubah")</script>');
			redirect(base_url('MstDept'));
		}
	}
	public function delete($id){
		$this->MstDeptModel->delete($id);
		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil dihapus")</script>');
		redirect(base_url('MstDept'));
	}
}