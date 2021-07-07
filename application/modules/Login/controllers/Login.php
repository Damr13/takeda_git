<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('LoginModel');
	}

	public function index()
	{
		$session = $this->session->userdata('status');

		if ($session == '') {
			$this->load->view('templates/loginHeader');
			$this->load->view('Login');
			$this->load->view('templates/loginFooter');
		} else {
			redirect('Main');
		}
	}

	public function auth(){
		$this->form_validation->set_rules('full_name', 'Full Name', 'required|min_length[4]|max_length[15]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == TRUE) {
			$full_name      = $this->input->post('full_name');
	        //$password   = $this->input->post('password');
	        $password = $this->input->post('password',TRUE);
	        $hashPass = password_hash($password,PASSWORD_DEFAULT);
	        // $test     = password_verify($password, $hashPass);
	        // query chek users
	        $this->db->where('full_name',$full_name);
	        //$this->db->where('password',  $test);
	        $users       = $this->db->get('tbl_user');
	        if($users->num_rows()>0){
	            $user = $users->row_array();
	            // print_r($user);
	            // echo 'ddd'; exit();
	            if(password_verify($password,$user['password'])){
	                // retrive user data to session
	                $this->session->set_userdata($user);
	                
	                redirect('Main');
	            }else{
	            	$this->session->set_flashdata('error_msg', 'Password not match');
	            	redirect('Login');
	            }
			}else{
				$this->session->set_flashdata('error_msg', 'User not found');
	            redirect('Login');
			}
		}
		else{
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect('Login');
        }
    }

	public function logout() {
		$this->session->sess_destroy();
		redirect('Login');
	}
}
