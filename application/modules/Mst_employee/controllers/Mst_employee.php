<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mst_employee extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Mst_employeeModel');
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
		$data['dataUser'] = $this->Mst_employeeModel->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		$this->load->view('Mst_employee/templates/Header');
		$this->template->load('template','Mst_employee', $data);
		$this->load->view('Mst_employee/templates/Footer');
		$this->load->view('Mst_employee/_cjs');
		$this->load->view('Mst_employee/_mjs');
	}

	private function rules(){
		return[
			['field' => 'Nik', 'label' => 'Nik', 'rules'=>'required'],
			['field' => 'Nama', 'label' => 'Nama', 'rules'=>'required'],
			['field' => 'Email', 'label' => 'Email', 'rules'=>'required'],
			['field' => 'password', 'label' => 'Password', 'rules'=>'required'],
		   	['field' => 'idDept', 'label' => 'idDept', 'rules'=>'required'],
			['field' => 'status', 'status' => 'status', 'rules'=>'required'],
			['field' => 'wfh', 'status' => 'wfh', 'rules'=>'required']

		];
	}

	public function insert(){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['dept'] = $this->Mst_employeeModel->getDept();
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('Mst_employee/templates/Header');
			$this->template->load('template','CreateEmployee',$data);
			$this->load->view('Mst_employee/templates/Footer');
			$this->load->view('Mst_employee/_cjs');
			$this->load->view('Mst_employee/_mjs');
		}else{
			$password       = $this->input->post('password',TRUE);
            // $options        = array("cost"=>4);
			$hashPassword   = md5($password);
			//$data['id'] = $this->input->post('id');
			$data['nik'] = $this->input->post('Nik');
			$data['Nama'] = $this->input->post('Nama');
			$data['Email'] = $this->input->post('Email');
			$data['Password'] = $hashPassword;
			$data['idDept'] = $this->input->post('idDept');
			$data['status'] = $this->input->post('status');
			$data['wfh'] = $this->input->post('wfh');
			$this->Mst_employeeModel->insert($data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil disimpan")</script>');
			redirect(base_url('Mst_employee'));
		}
	}

	public function Ganti_pass($id){
		
		$this->form_validation->set_rules('new_password','New Password','required');
		$this->form_validation->set_rules('confirm_password','Confirm Password', 'required|matches[new_password]');
		if($this->form_validation->run()=== FALSE){
			//echo '11';exit();
			$data['dataUserLevel'] = $this->Mst_employeeModel->getDept();
			$data['dataUser'] = $this->Mst_employeeModel->getId($id);
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('Mst_employee/templates/Header');
			$this->template->load('template','Ganti_password', $data);
			$this->load->view('Mst_employee/templates/Footer');
			$this->load->view('Mst_employee/_cjs');
			$this->load->view('Mst_employee/_mjs');
		}else{
			$password       = $this->input->post('new_password',TRUE);
			$confirm_password = $this->input->post('confirm_password',TRUE);
			$options        = array("cost"=>4);
			$hashPassword   = md5($password);
			$data['Password'] = $hashPassword;
			//echo $hashPassword;
			//$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			//$this->Menu_employeeModel->edit($id,$data);
			$this->Mst_employeeModel->edit($id,$data);
			$this->session->set_flashdata('pesan', '<script>alert("Password berhasil diubah")</script>');
			redirect(base_url('Mst_employee'));
			
            
		}
	}

	public function edit($id){
		// $this->form_validation->set_rules($this->rules());
		$this->form_validation->set_rules('Nama','Full Name','required');
		$this->form_validation->set_rules('Email','Email', 'required');

		if($this->form_validation->run()=== FALSE){
			$data['dataUserLevel'] = $this->Mst_employeeModel->getDept();
			$data['dataUser'] = $this->Mst_employeeModel->getId($id);
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('Mst_employee/templates/Header');
			$this->template->load('template','EditEmployee', $data);
			$this->load->view('Mst_employee/templates/Footer');
			$this->load->view('Mst_employee/_cjs');
			$this->load->view('Mst_employee/_mjs');
		}else{
			$data['Nik'] = $this->input->post('Nik');
			$data['Nama'] = $this->input->post('Nama');
			$data['Email'] = $this->input->post('Email');
			$data['idDept'] = $this->input->post('idDept');
			$data['status'] = $this->input->post('status');
			$data['wfh'] = $this->input->post('wfh');
			// $data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->Mst_employeeModel->edit($id,$data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil diubah")</script>');
			redirect(base_url('Mst_employee'));
		}
	}
	public function delete($id){
		$this->Mst_employeeModel->delete($id);
		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil dihapus")</script>');
		redirect(base_url('Mst_employee'));
	}
}