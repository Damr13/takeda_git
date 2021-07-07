<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('ArticleModel');
		$this->load->model('MenuModel');
		$this->load->library('form_validation');
		if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}

		$akses= $this->MenuModel->akses_menu2('Article',$this->session->userdata('id_user_level'));
		$this->create =  $akses->create;
		$this->update =  $akses->update;
		$this->delete =  $akses->delete;
	}

	public function index() {

		$data['dataPic'] = $this->ArticleModel->selectAll();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		$this->load->view('Article/templates/Header');
		$this->template->load('template','Article', $data);
		$this->load->view('Article/templates/Footer');
		$this->load->view('Article/_cjs');
		$this->load->view('Article/_mjs');
	}

	private function rules(){
		return[
			['field' => 'judul', 'label' => 'judul', 'rules'=>'required'],
			// ['field' => 'gambar', 'label' => 'gambar', 'rules'=>'required'],
			['field' => 'isi', 'label' => 'isi', 'rules'=>'required']
		];
	}

	public function insert(){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('Article/templates/Header');
			$this->template->load('template','CreateArticle', $data);
			$this->load->view('Article/templates/Footer');
			$this->load->view('Article/_cjs');
			$this->load->view('Article/_mjs');
		}else{
			$config['upload_path']         = 'assets/article/';  // folder upload 
            $config['allowed_types']        = 'gif|jpg|png'; // jenis file
            $config['encrypt_name'] = TRUE;
			$filename = rand().'_'.$_FILES["gambar"]['name'];
			$config['file_name'] = $filename;
            // $config['max_size']             = 3000;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if($this->upload->do_upload('gambar')){
            	// $this->upload->do_upload('gambar');
	            $file = $this->upload->data();
	            $gambar = $file['file_name'];
	            $gambar_location = base_url().'assets/article/'.$gambar;
            }else{
            	$gambar_location =null;
            }
            

            // echo $gambar_location.' ; ';exit();
 
            $data['judul'] = $this->input->post('judul');
			$data['gambar'] = $gambar_location;
			$data['isi'] = $this->input->post('isi');
			$data['status'] = $this->input->post('status');
			$this->ArticleModel->insert($data);
			
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil disimpan")</script>');
			redirect(base_url('Article'));
		}
	}

	public function edit($id){
		$this->form_validation->set_rules($this->rules());

		if($this->form_validation->run()=== FALSE){
			$data['mstArticle'] = $this->ArticleModel->getId($id);
			$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
			$this->load->view('Article/templates/Header');
			$this->template->load('template','EditArticle', $data);
			$this->load->view('Article/templates/Footer');
			$this->load->view('Article/_cjs');
			$this->load->view('Article/_mjs');
		}else{
			$config['upload_path']         = 'assets/article/';  // folder upload 
            $config['allowed_types']        = 'gif|jpg|png'; // jenis file
            $config['encrypt_name'] = TRUE;
			$filename = rand().'_'.$_FILES["gambar"]['name'];
			$config['file_name'] = $filename;
            // $config['max_size']             = 3000;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if($this->upload->do_upload('gambar')){
            	// $this->upload->do_upload('gambar');
	            $file = $this->upload->data();
	            $gambar = $file['file_name'];
	            $gambar_location = base_url().'assets/article/'.$gambar;
	            $data['gambar'] = $gambar_location;
            }
            // echo $gambar_location.' ; ';exit();
 
            $data['judul'] = $this->input->post('judul');
			$data['isi'] = $this->input->post('isi');
			$data['status'] = $this->input->post('status');
			$this->ArticleModel->edit($id,$data);
			$this->session->set_flashdata('pesan', '<script>alert("Data berhasil diubah")</script>');
			redirect(base_url('Article'));
		}
	}
	public function delete($id){
		$this->ArticleModel->delete($id);
		$this->session->set_flashdata('pesan', '<script>alert("Data berhasil dihapus")</script>');
		redirect(base_url('Article'));
	}
}