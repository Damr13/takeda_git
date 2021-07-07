<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuditTrail extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('AuditTrailModel');
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
		$data['AuditTrail'] = $this->AuditTrailModel->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		$this->load->view('AuditTrail/templates/Header');
		$this->template->load('template','AuditTrail', $data);
		$this->load->view('AuditTrail/templates/Footer');
		$this->load->view('AuditTrail/_cjs');
		$this->load->view('AuditTrail/_mjs');
	}

	// private function rules(){
	// 	return[
	// 		['field' => 'date', 'label' => 'date', 'rules'=>'required'],
	// 		['field' => 'time', 'label' => 'time', 'rules'=>'required'],
	// 		['field' => 'full_name', 'label' => 'full_name', 'rules'=>'required'],
	// 		['field' => 'shift', 'label' => 'shift', 'rules'=>'required'],
	// 		['field' => 'downtimeCode', 'label' => 'downtimeCode', 'rules'=>'required'],
	// 		['field' => 'downtimeName', 'label' => 'downtimeName', 'rules'=>'required'],
	// 		['field' => 'downtimeGroup', 'label' => 'downtimeGroup', 'rules'=>'required']
	// 	];
	// }

	// public function insert(){
	// 	$this->form_validation->set_rules($this->rules());

	// 	if($this->form_validation->run()=== FALSE){
	// 		$data['dataUserLevel'] = $this->UserModel->getLevel();
	// 		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
	// 		$this->load->view('User/templates/Header');
	// 		$this->template->load('template','CreateUser',$data);
	// 		$this->load->view('User/templates/Footer');
	// 		$this->load->view('User/_cjs');
	// 		$this->load->view('User/_mjs');
	// 	}else{
	// 		$password       = $this->input->post('password',TRUE);
    //         $options        = array("cost"=>4);
	// 		$hashPassword   = password_hash($password,PASSWORD_BCRYPT,$options);
			
	// 		$data['full_name'] = $this->input->post('full_name');
	// 		$data['email'] = $this->input->post('email');
	// 		$data['password'] = $hashPassword;
	// 		$data['id_user_level'] = $this->input->post('id_user_level');
	// 		$data['is_aktif'] = $this->input->post('is_aktif');
	// 		$this->UserModel->insert($data);
	// 		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil disimpan")</script>');
	// 		redirect(base_url('User'));
	// 	}
	// }

	// public function Ganti_pass($id){
		
	// 	$this->form_validation->set_rules('new_password','New Password','required');
	// 	$this->form_validation->set_rules('confirm_password','Confirm Password', 'required|matches[new_password]');
	// 	if($this->form_validation->run()=== FALSE){
	// 		// echo '11';exit();
	// 		$data['dataUserLevel'] = $this->UserModel->getLevel();
	// 		$data['dataUser'] = $this->UserModel->getId($id);
	// 		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
	// 		$this->load->view('User/templates/Header');
	// 		$this->template->load('template','Ganti_password', $data);
	// 		$this->load->view('User/templates/Footer');
	// 		$this->load->view('User/_cjs');
	// 		$this->load->view('User/_mjs');
	// 	}else{
	// 		// echo $id;exit();
	// 		$password       = $this->input->post('new_password',TRUE);
	// 		$confirm_password       = $this->input->post('confirm_password',TRUE);

	// 		$options        = array("cost"=>4);
	// 		$hashPassword   = password_hash($password,PASSWORD_BCRYPT,$options);
	// 		$data['password'] = $hashPassword;
	// 		// $data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
	// 		$this->UserModel->edit($id,$data);
	// 		$this->session->set_flashdata('pesan', '<script>alert("Password berhasil diubah")</script>');
	// 		redirect(base_url('User'));
			
            
	// 	}
	// }

	// public function edit($id){
	// 	// $this->form_validation->set_rules($this->rules());
	// 	$this->form_validation->set_rules('full_name','Full Name','required');
	// 	$this->form_validation->set_rules('email','Email', 'required');

	// 	if($this->form_validation->run()=== FALSE){
	// 		$data['dataUserLevel'] = $this->UserModel->getLevel();
	// 		$data['dataUser'] = $this->UserModel->getId($id);
	// 		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
	// 		$this->load->view('User/templates/Header');
	// 		$this->template->load('template','EditUser', $data);
	// 		$this->load->view('User/templates/Footer');
	// 		$this->load->view('User/_cjs');
	// 		$this->load->view('User/_mjs');
	// 	}else{
	// 		$data['full_name'] = $this->input->post('full_name');
	// 		$data['email'] = $this->input->post('email');
	// 		$data['id_user_level'] = $this->input->post('id_user_level');
	// 		$data['is_aktif'] = $this->input->post('is_aktif');
	// 		// $data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
	// 		$this->UserModel->edit($id,$data);
	// 		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil diubah")</script>');
	// 		redirect(base_url('User'));
	// 	}
	// }
	// public function delete($id){
	// 	$this->UserModel->delete($id);
	// 	$this->session->set_flashdata('pesan', '<script>alert("Data berhasil dihapus")</script>');
	// 	redirect(base_url('User'));
	// }
}