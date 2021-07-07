<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserLevel extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('UserLevelModel');
		$this->load->model('MenuModel');
		$this->load->library('form_validation');
		$this->load->library('session');
        if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}
	}

	public function index() {
		$data['dataUserLevel'] = $this->UserLevelModel->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		$this->load->view('UserLevel/templates/Header');
		$this->template->load('template','UserLevel', $data);
		$this->load->view('UserLevel/templates/Footer');
		$this->load->view('UserLevel/_cjs');
		$this->load->view('UserLevel/_mjs');
	}

	private function rules(){
		return[
			['field' => 'nama_level', 'label' => 'nama_level', 'rules'=>'required'],
		];
	}

	public function insert(){
		$this->form_validation->set_rules($this->rules());

		// print_r($this->form_validation->run());exit();

		if($this->form_validation->run()=== FALSE){
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('UserLevel/templates/Header');
			$this->template->load('template','CreateUserLevel',$data);
			$this->load->view('UserLevel/templates/Footer');
			$this->load->view('UserLevel/_cjs');
			$this->load->view('UserLevel/_mjs');
		}else{
			$data['nama_level'] = $this->input->post('nama_level');
			// $data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->UserLevelModel->insert($data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil disimpan")</script>');
			redirect(base_url('UserLevel'));
		}
	}

	public function edit($id){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['dataUserLevel'] = $this->UserLevelModel->getId($id);
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('User/templates/Header');
			$this->template->load('template','EditUserLevel', $data);
			$this->load->view('User/templates/Footer');
			$this->load->view('User/_cjs');
			$this->load->view('User/_mjs');
		}else{
			$data['nama_level'] = $this->input->post('nama_level');
			$this->UserLevelModel->edit($id,$data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil diubah")</script>');
			redirect(base_url('UserLevel'));
		}
	}
	public function delete($id){
		$this->UserLevelModel->delete($id);
		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil dihapus")</script>');
		redirect(base_url('UserLevel'));
	}
}