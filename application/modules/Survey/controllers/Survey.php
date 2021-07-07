<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('SurveyModel');
		// $this->load->model('MstSurveyModel');
		$this->load->model('MenuModel');
		$this->load->library('form_validation');
		$this->tableSurveys = 'do_surveys';
		$this->tables = array('do_surveys', 'do_pages', 'do_questions', 'do_answers', 'do_responses');
		date_default_timezone_set("Asia/Bangkok");
	}

	public function gps2Num($coordPart){
		$parts = explode('/', $coordPart);
		if(count($parts) <= 0) return 0;
		if(count($parts) == 1) return $parts[0];
		return floatval($parts[0]) / floatval($parts[1]);
	}

	public function get_image_location($image = ''){
		$exif = exif_read_data($image, 0, true);

		if($exif && isset($exif['GPS'])){
			$GPSLatitudeRef   = $exif['GPS']['GPSLatitudeRef'];
			$GPSLatitude      = $exif['GPS']['GPSLatitude'];
			$GPSLongitudeRef  = $exif['GPS']['GPSLongitudeRef'];
			$GPSLongitude     = $exif['GPS']['GPSLongitude'];
		
			$lat_degrees = count($GPSLatitude) > 0 ? $this->gps2Num($GPSLatitude[0]) : 0;
			$lat_minutes = count($GPSLatitude) > 1 ? $this->gps2Num($GPSLatitude[1]) : 0;
			$lat_seconds = count($GPSLatitude) > 2 ? $this->gps2Num($GPSLatitude[2]) : 0;
		
			$lon_degrees = count($GPSLongitude) > 0 ? $this->gps2Num($GPSLongitude[0]) : 0;
			$lon_minutes = count($GPSLongitude) > 1 ? $this->gps2Num($GPSLongitude[1]) : 0;
			$lon_seconds = count($GPSLongitude) > 2 ? $this->gps2Num($GPSLongitude[2]) : 0;
		
			$lat_direction = ($GPSLatitudeRef == 'W' or $GPSLatitudeRef == 'S') ? -1 : 1;
			$lon_direction = ($GPSLongitudeRef == 'W' or $GPSLongitudeRef == 'S') ? -1 : 1;
		
			$latitude = $lat_direction * ($lat_degrees + ($lat_minutes / 60) + ($lat_seconds / (60*60)));
			$longitude = $lon_direction * ($lon_degrees + ($lon_minutes / 60) + ($lon_seconds / (60*60)));
		
			return array('latitude'=>$latitude, 'longitude'=>$longitude);
		}else{
			return false;
		}
	}

	public function index() {
		if(!(isset($_GET['id']))) $id='';
		else $id = $_GET['id'];

		$data['id'] = $id;
		// $data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));
		// $data['akses'] = $this->MenuModel->akses_menu2("SurveyLists", $this->session->userdata('id_user_level'));
		$data['view'] = true;
		$this->load->view('Survey/templates/Header');
		$this->template->load('templateSurvey','Survey', $data);
		$this->load->view('Survey/templates/Footer');
	}

	public function sendSurvey(){
		// $idSurvey = '';
		$arr	= json_decode(($_POST['data']));
		$idRespone = $this->SurveyModel->countResponse()+1;
		foreach ($arr as $resp => $each) {
			$where 	= array();
			$data 	= array();
			foreach ($each as $key => $value) {
				if($key == "responseImg"){
					$filename = $_FILES[$key];
					var_dump($filename);
					// $test = $_FILES[$key]['name'];
					// var_dump($test);
				}else if($key == "survey"){
					$idSurvey = $value;
					$data[$key] = $value;
				}else{
					$data[$key] = $value;
				}
			}
			$data['idResponse'] = $idRespone;
			$data['timestamps'] = date('Y-m-d H:i:s');
			$this->SurveyModel->insert($this->tables[4], $data);
			$countTotResp = $this->SurveyModel->countTotResp($idSurvey);
			$this->SurveyModel->update($this->tables[0], array("lastResponse" => date('Y-m-d H:i:s'), "responses" => $countTotResp), array("id" => $idSurvey));
		}

		echo json_encode(true);
	}

	public function saveFiles(){
		foreach($_FILES as $Field => $Data){
			var_dump($Field);
			var_dump($_FILES[$Field]);
			var_dump($_FILES[$Field]['tmp_name']);
			$rand 		= rand();
  		$ekstensi = array('png','jpg','jpeg','gif');
  		$filename = $_FILES[$Field]['name'];
  		$ukuran 	= $_FILES[$Field]['size'];
			$ext 			= pathinfo($filename, PATHINFO_EXTENSION);
			
			$filename = $rand.'_'.$filename;
			move_uploaded_file($_FILES[$Field]['tmp_name'], './assets/img/'.$filename);
			
  	  //image file path
  	  $imageURL = base_url().'assets/img/'.$filename;
		
  	  //get location of image
  	  $imgLocation = $this->get_image_location($imageURL);
		
  	  //latitude & longitude
  	  $imgLat = $imgLocation['latitude'];
			$imgLng = $imgLocation['longitude'];
			
			$idRespone = $this->SurveyModel->countResponse();
			$image = explode("_",$Field);
			$data = array(
				'survey' 		=> $image[0],
				'page' 	 		=> $image[1],
				'question'  => $image[2],
				'answer' 	 	=> $image[3],
				'response'	=> $filename,
				'url'				=> $filename,
				'latitude'	=> $imgLat,
				'longitude'	=> $imgLng,
				'idResponse'=> $idRespone,
			);
			$data['timestamps'] = date('Y-m-d H:i:s');
			$this->SurveyModel->insert($this->tables[4], $data);
			$countTotResp = $this->SurveyModel->countTotResp($image[0]);
			$this->SurveyModel->update($this->tables[0], array("lastResponse" => date('Y-m-d H:i:s'), "responses" => $countTotResp), array("id" => $image[0]));
		}
		return true;
	}

	private function rules(){
		return[
			['field' => 'name', 'label' => 'name', 'rules'=>'required'],
			['field' => 'role', 'label' => 'role', 'rules'=>'required'],
			['field' => 'shift', 'label' => 'shift', 'rules'=>'required']
		];
	}
}