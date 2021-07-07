<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MstProduct extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('MstProductModel');
		$this->load->model('MenuModel');
		$this->load->library('form_validation');
		if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

		$akses= $this->MenuModel->akses_menu2('MstProduct',$this->session->userdata('id_user_level'));
		// print_r($akses);exit();
		$this->create =  $akses->create;
		$this->update =  $akses->update;
		$this->delete =  $akses->delete;
	}

	public function index() {
		$data['dataProduct'] = $this->MstProductModel->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));


		$this->load->view('MstProduct/templates/Header');
		$this->template->load('template','MstProduct', $data);
		$this->load->view('MstProduct/templates/Footer');
		$this->load->view('MstProduct/_cjs');
		$this->load->view('MstProduct/_mjs');
	}

	private function rules(){
		return[
			['field' => 'product_name', 'label' => 'Product Name', 'rules'=>'required']
		];
	}

	public function insert(){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('MstProduct/templates/Header');
			$this->template->load('template','CreateProduct',$data);
			$this->load->view('MstProduct/templates/Footer');
			$this->load->view('MstProduct/_cjs');
			$this->load->view('MstProduct/_mjs');
		}else{
			$data['product_name'] = $this->input->post('product_name');
			$this->MstProductModel->insert($data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil disimpan")</script>');
			redirect(base_url('MstProduct'));
		}
	}

	public function edit($id){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['mstProduct'] = $this->MstProductModel->getId($id);
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('MstProduct/templates/Header');
			$this->template->load('template','EditProduct', $data);
			$this->load->view('MstProduct/templates/Footer');
			$this->load->view('MstProduct/_cjs');
			$this->load->view('MstProduct/_mjs');
		}else{
			$data['product_name'] = $this->input->post('product_name');
			$this->MstProductModel->edit($id,$data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil diubah")</script>');
			redirect(base_url('MstProduct'));
		}
	}
	public function delete($id){
		$this->MstProductModel->delete($id);
		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil dihapus")</script>');
		redirect(base_url('MstProduct'));
	}
}