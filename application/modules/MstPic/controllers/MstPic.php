<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MstPic extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MstPicModel');
		$this->load->model('MenuModel');
		$this->load->library('form_validation');
		if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

		$akses= $this->MenuModel->akses_menu2('MstPic',$this->session->userdata('id_user_level'));
		$this->create =  $akses->create;
		$this->update =  $akses->update;
		$this->delete =  $akses->delete;
	}

	public function index() {

		$data['dataPic'] = $this->MstPicModel->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		$this->load->view('MstPic/templates/Header');
		$this->template->load('template','MstPic', $data);
		$this->load->view('MstPic/templates/Footer');
		$this->load->view('MstPic/_cjs');
		$this->load->view('MstPic/_mjs');
	}

	private function rules(){
		return[
			['field' => 'name', 'label' => 'name', 'rules'=>'required'],
			['field' => 'role', 'label' => 'role', 'rules'=>'required'],
			['field' => 'shift', 'label' => 'shift', 'rules'=>'required']
		];
	}

	public function insert(){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('MstPic/templates/Header');
			$this->template->load('template','CreatePic', $data);
			$this->load->view('MstPic/templates/Footer');
			$this->load->view('MstPic/_cjs');
			$this->load->view('MstPic/_mjs');
		}else{
			$data['name'] = $this->input->post('name');
			$data['role'] = $this->input->post('role');
			$data['shift'] = $this->input->post('shift');
			$this->MstPicModel->insert($data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil disimpan")</script>');
			redirect(base_url('MstPic'));
		}
	}

	public function edit($id){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['mstPic'] = $this->MstPicModel->getId($id);
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('MstPic/templates/Header');
			$this->template->load('template','EditPic', $data);
			$this->load->view('MstPic/templates/Footer');
			$this->load->view('MstPic/_cjs');
			$this->load->view('MstPic/_mjs');
		}else{
			$data['name'] = $this->input->post('name');
			$data['role'] = $this->input->post('role');
			$data['shift'] = $this->input->post('shift');
			$this->MstPicModel->edit($id,$data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil diubah")</script>');
			redirect(base_url('MstPic'));
		}
	}
	public function delete($id){
		$this->MstPicModel->delete($id);
		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil dihapus")</script>');
		redirect(base_url('MstPic'));
	}
}