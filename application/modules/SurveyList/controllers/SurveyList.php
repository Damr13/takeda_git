<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SurveyList extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('SurveyListModel','mdl');
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
		
		// $data['visitor'] = $this->mdl->selectVisitor();
		// $data['contractor'] = $this->mdl->selectContractor();
		// $data['employee'] = $this->mdl->selectEmployee();
		// $data['outsourcing'] = $this->mdl->selectOutsourcing();
		$data['menu'] = $this->MenuModel->akses_menu($this->session->userdata('id_user_level'));

		// $kolom = 'category';
	    // $tabel = 'category';
	    // $where = '';
	    // $join  = '';
	    // $order = '';
	    // $category = $this->mdl->select_result2($tabel,$where,$kolom,$order);
		// $data = array(	
		// 	'category'	=> $category,
		// 	'menu'		=> $this->MenuModel->akses_menu($this->session->userdata('id_user_level'))
	  	// );
		$this->load->view('SurveyList/templates/Header');
		$this->template->load('template','SurveyList', $data);
		$this->load->view('SurveyList/templates/Footer');
		$this->load->view('SurveyList/_cjs');
		$this->load->view('SurveyList/_mjs');
	}

	public function Raw_data_visitor($bulan){
		// $jdl='';
		$tabel="";

		$tabel.=$this->Raw_data_visitor2($bulan);
		
		$respone = "sukses";
		$return = array('respone' => $respone, 'tabel' => $tabel, 'bulan' => $bulan);
		echo json_encode($return);
	}

	public function Raw_data_visitor2($bulan){

		$tabel="";

			$kolom 		= 'idResponse,
									tanggal as response_date,
									MAX( CASE WHEN idQuestion = 2680 THEN response END ) nama,
									MAX( CASE WHEN idQuestion = 2681 THEN response END ) perusahaan,
									MAX( CASE WHEN idQuestion = 2682 THEN response END ) alamat,
									MAX( CASE WHEN idQuestion = 2683 THEN response END ) tujuan,
									MAX( CASE WHEN idQuestion = 2685 THEN response END ) kasus,
									MAX( CASE WHEN idQuestion = 2686 THEN response END ) kapan_berkunjung,
									MAX( CASE WHEN idQuestion = 2687 THEN response END ) suhu,
									MAX( CASE WHEN idQuestion = 2688 THEN response END ) demam,
									MAX( CASE WHEN idQuestion = 3094 THEN response END ) pilek,
									MAX( CASE WHEN idQuestion = 2689 THEN response END ) batuk,
									MAX( CASE WHEN idQuestion = 2690 THEN response END ) kesulitan_bernafas,
									MAX( CASE WHEN idQuestion = 2691 THEN response END ) sakit_tenggorokan,
									MAX( CASE WHEN idQuestion = 2692 THEN response END ) menggigil,
									MAX( CASE WHEN idQuestion = 2693 THEN response END ) mual,
									MAX( CASE WHEN idQuestion = 2709 THEN response END ) kejang,
									MAX( CASE WHEN idQuestion = 2710 THEN response END ) sakit_kepala,
									MAX( CASE WHEN idQuestion = 2712 THEN response END ) hilang_perasa,
									MAX( CASE WHEN idQuestion = 2713 THEN response END ) hilang_penciuman,
									MAX( CASE WHEN idQuestion = 2714 THEN response END ) sakit_sendi,
									MAX( CASE WHEN idQuestion = 2715 THEN response END ) diare,
									MAX( CASE WHEN idQuestion = 2716 THEN response END ) ruam,
									MAX( CASE WHEN idQuestion = 2717 THEN response END ) lelah,
									MAX( CASE WHEN idQuestion = 2718 THEN response END ) konjungtivitis,
									MAX( CASE WHEN idQuestion = 2719 THEN response END ) hidung_berdarah,
									MAX( CASE WHEN idQuestion = 2720 THEN response END ) penururan_kesadaran,
									MAX( CASE WHEN idQuestion = 2721 THEN response END ) hilang_nafsu_makan,
									MAX( CASE WHEN idQuestion = 2722 THEN response END ) neurologis,
									MAX( CASE WHEN idQuestion = 2724 THEN response END ) keluar_kota,
									MAX( CASE WHEN idQuestion = 2725 THEN response END ) lokasi_kota,
									MAX( CASE WHEN idQuestion = 2727 THEN response END ) close_contact,
									MAX( CASE WHEN idQuestion = 3030 THEN response END ) hasil_test,
									MAX( CASE WHEN idQuestion = 3053 THEN response END ) gejala_lain,
									MAX( CASE WHEN idQuestion = 3054 THEN response END ) tanggal_perjalanan,
									MAX( CASE WHEN idQuestion = 3097 THEN response END ) keluarga_sakit,
									MAX( CASE WHEN idQuestion = 3098 THEN response END ) jelaskan_sakit
									';
			$tbl 			= 'responses';
			$where 		= 'WHERE survey = 86 AND DATE_FORMAT(tanggal,"%d-%m-%Y") = "'.$bulan.'"';
			$join  		= '';
			$groupby 	= 'GROUP BY idResponse';
			$data 		= $this->mdl->Raw_data_visitor($kolom,$tbl,$join,$where,$groupby);
			$no 			= 1;
			foreach ($data as $data) {
					$tabel.= '
					<tr>
						<td><center>'.$no.'</center></td>
						<td>'.$data->response_date.'</td>
						<td><center>'.$data->nama.'</center></td>
						<td>'.$data->perusahaan.'</td>
						<td>'.$data->alamat.'</td>
						<td>'.$data->tujuan.'</td>
						<td>'.$data->kasus.'></td>
						<td>'.$data->kapan_berkunjung.'</td>
						<td>'.$data->suhu.'</td>
						<td>'.$data->demam.'</td>
						<td>'.$data->pilek.'</td>
						<td>'.$data->batuk.'</td>
						<td>'.$data->kesulitan_bernafas.'</td>
						<td>'.$data->sakit_tenggorokan.'</td>
						<td>'.$data->menggigil.'</td>
						<td>'.$data->mual.'</td>
						<td>'.$data->kejang.'</td>
						<td>'.$data->sakit_kepala.'</td>
						<td>'.$data->hilang_perasa.'</td>
						<td>'.$data->hilang_penciuman.'</td>
						<td>'.$data->sakit_sendi.'</td>
						<td>'.$data->diare.'</td>
						<td>'.$data->ruam.'</td>
						<td>'.$data->lelah.'</td>
						<td>'.$data->konjungtivitis.'</td>
						<td>'.$data->hidung_berdarah.'</td>
						<td>'.$data->penururan_kesadaran.'</td>
						<td>'.$data->hilang_nafsu_makan.'</td>
						<td>'.$data->neurologis.'</td>
						<td>'.$data->keluar_kota.'</td>
						<td>'.$data->lokasi_kota.'</td>
						<td>'.$data->close_contact.'</td>
						<td>'.$data->hasil_test.'</td>
						<td>'.$data->gejala_lain.'</td>
						<td>'.$data->tanggal_perjalanan.'</td>
						<td>'.$data->keluarga_sakit.'</td>
						<td>'.$data->jelaskan_sakit.'</td>
						<td>';
					
						$kolom_pic 	= 'idResponse,url';
						$tbl_pic 		= 'responses';
						$where_pic 	= 'WHERE idQuestion = 2707 
													AND DATE_FORMAT(tanggal,"%d-%m-%Y") = "'.$bulan.'" 
													AND idResponse =  '.$data->idResponse .' ';
						$join_pic  	= '';
						$order_pic 	= '';
						$data_pic 	= $this->mdl->Raw_data_visitor($kolom_pic,$tbl_pic,$join_pic,$where_pic,$order_pic);
						foreach ($data_pic as $key_pic) {
							$tabel.= '
							<span onclick="show_image('.$key_pic->idResponse.')">
								<img src="'.$key_pic->url.'" class="img-rounded" style="border: 3px solid #555;" width="50" height="50" >
							</span>';
							break;
						}
						

				$tabel.= '
						</td>
					</tr>
					';

					$no++;
				}

		return $tabel;
	}

	public function Raw_data_contractor($bulan){
		// $jdl='';
		$tabel="";

		$tabel.=$this->Raw_data_contractor2($bulan);
		
		$respone = "sukses";
		$return = array('respone' => $respone, 'tabel' => $tabel, 'bulan' => $bulan);
		echo json_encode($return);
	}

	public function Raw_data_contractor2($bulan){

		$tabel="";

			$kolom 		= 'idResponse,
									tanggal as response_date,
									MAX( CASE WHEN idQuestion = 2801 THEN response END ) nama,
									MAX( CASE WHEN idQuestion = 2802 THEN response END ) perusahaan,
									MAX( CASE WHEN idQuestion = 2803 THEN response END ) alamat,
									MAX( CASE WHEN idQuestion = 2805 THEN response END ) kasus,
									MAX( CASE WHEN idQuestion = 2807 THEN response END ) suhu,
									MAX( CASE WHEN idQuestion = 2808 THEN response END ) demam,
									MAX( CASE WHEN idQuestion = 3095 THEN response END ) pilek,
									MAX( CASE WHEN idQuestion = 2809 THEN response END ) batuk,
									MAX( CASE WHEN idQuestion = 2810 THEN response END ) kesulitan_bernafas,
									MAX( CASE WHEN idQuestion = 3031 THEN response END ) sakit_tenggorokan,
									MAX( CASE WHEN idQuestion = 3032 THEN response END ) menggigil,
									MAX( CASE WHEN idQuestion = 3033 THEN response END ) mual,
									MAX( CASE WHEN idQuestion = 3034 THEN response END ) kejang,
									MAX( CASE WHEN idQuestion = 3035 THEN response END ) sakit_kepala,
									MAX( CASE WHEN idQuestion = 3036 THEN response END ) hilang_perasa,
									MAX( CASE WHEN idQuestion = 3037 THEN response END ) hilang_penciuman,
									MAX( CASE WHEN idQuestion = 3038 THEN response END ) sakit_sendi,
									MAX( CASE WHEN idQuestion = 3039 THEN response END ) diare,
									MAX( CASE WHEN idQuestion = 3040 THEN response END ) ruam,
									MAX( CASE WHEN idQuestion = 3041 THEN response END ) lelah,
									MAX( CASE WHEN idQuestion = 3042 THEN response END ) konjungtivitis,
									MAX( CASE WHEN idQuestion = 3043 THEN response END ) hidung_berdarah,
									MAX( CASE WHEN idQuestion = 3044 THEN response END ) penururan_kesadaran,
									MAX( CASE WHEN idQuestion = 3045 THEN response END ) hilang_nafsu_makan,
									MAX( CASE WHEN idQuestion = 3046 THEN response END ) neurologis,
									MAX( CASE WHEN idQuestion = 3056 THEN response END ) gejala_lain,
									MAX( CASE WHEN idQuestion = 2834 THEN response END ) close_contact,
									MAX( CASE WHEN idQuestion = 2837 THEN response END ) hasil_test,
									MAX( CASE WHEN idQuestion = 3100 THEN response END ) keluarga_sakit,
									MAX( CASE WHEN idQuestion = 3099 THEN response END ) jelaskan_sakit,
									MAX( CASE WHEN idQuestion = 2835 THEN response END ) keluar_kota,
									MAX( CASE WHEN idQuestion = 2836 THEN response END ) lokasi_kota,
									MAX( CASE WHEN idQuestion = 3057 THEN response END ) tanggal_perjalanan
									';
			$tbl 			= 'responses';
			$where 		= 'WHERE survey = 90 AND DATE_FORMAT(tanggal,"%d-%m-%Y") = "'.$bulan.'"';
			$join  		= '';
			$groupby 	= 'GROUP BY idResponse';
			$data 		= $this->mdl->Raw_data_contractor($kolom,$tbl,$join,$where,$groupby);
			$no 			= 1;
			foreach ($data as $data) {
					$tabel.= '
					<tr>
						<td><center>'.$no.'</center></td>
						<td>'.$data->response_date.'</td>
						<td><center>'.$data->nama.'</center></td>
						<td>'.$data->perusahaan.'</td>
						<td>'.$data->alamat.'</td>
						<td>'.$data->kasus.'></td>
						<td>'.$data->suhu.'</td>
						<td>'.$data->demam.'</td>
						<td>'.$data->pilek.'</td>
						<td>'.$data->batuk.'</td>
						<td>'.$data->kesulitan_bernafas.'</td>
						<td>'.$data->sakit_tenggorokan.'</td>
						<td>'.$data->menggigil.'</td>
						<td>'.$data->mual.'</td>
						<td>'.$data->kejang.'</td>
						<td>'.$data->sakit_kepala.'</td>
						<td>'.$data->hilang_perasa.'</td>
						<td>'.$data->hilang_penciuman.'</td>
						<td>'.$data->sakit_sendi.'</td>
						<td>'.$data->diare.'</td>
						<td>'.$data->ruam.'</td>
						<td>'.$data->lelah.'</td>
						<td>'.$data->konjungtivitis.'</td>
						<td>'.$data->hidung_berdarah.'</td>
						<td>'.$data->penururan_kesadaran.'</td>
						<td>'.$data->hilang_nafsu_makan.'</td>
						<td>'.$data->neurologis.'</td>
						<td>'.$data->gejala_lain.'</td>
						<td>'.$data->close_contact.'</td>
						<td>'.$data->hasil_test.'</td>
						<td>'.$data->keluarga_sakit.'</td>
						<td>'.$data->jelaskan_sakit.'</td>
						<td>'.$data->keluar_kota.'</td>
						<td>'.$data->lokasi_kota.'</td>
						<td>'.$data->tanggal_perjalanan.'</td>
						<td>';
					
						$kolom_pic 	= 'idResponse,url';
						$tbl_pic 		= 'responses';
						$where_pic 	= 'WHERE idQuestion = 2833
													AND DATE_FORMAT(tanggal,"%d-%m-%Y") = "'.$bulan.'" 
													AND idResponse =  '.$data->idResponse .' ';
						$join_pic  	= '';
						$order_pic 	= '';
						$data_pic 	= $this->mdl->Raw_data_contractor($kolom_pic,$tbl_pic,$join_pic,$where_pic,$order_pic);
						foreach ($data_pic as $key_pic) {
							$tabel.= '
							<span onclick="show_image('.$key_pic->idResponse.')">
								<img src="'.$key_pic->url.'" class="img-rounded" style="border: 3px solid #555;" width="50" height="50" >
							</span>';
							break;
						}
						

				$tabel.= '
						</td>
					</tr>
					';

					$no++;
				}

		return $tabel;
	}
	public function Raw_data_employee($bulan){
		// $jdl='';
		$tabel="";

		$tabel.=$this->Raw_data_employee2($bulan);
		
		$respone = "sukses";
		$return = array('respone' => $respone, 'tabel' => $tabel, 'bulan' => $bulan);
		echo json_encode($return);
	}

	public function Raw_data_employee2($bulan){

		$tabel="";

			$kolom 		= 'a.idResponse,
									a.tanggal as response_date,
									b.nik as nik_emp,
									b.Nama as nama_emp,
									MAX( CASE WHEN a.idQuestion = 2976 THEN response END ) suhu,
									MAX( CASE WHEN a.idQuestion = 2977 THEN response END ) demam,
									MAX( CASE WHEN a.idQuestion = 3093 THEN response END ) pilek,
									MAX( CASE WHEN a.idQuestion = 2978 THEN response END ) batuk,
									MAX( CASE WHEN a.idQuestion = 2979 THEN response END ) kesulitan_bernafas,
									MAX( CASE WHEN a.idQuestion = 2980 THEN response END ) sakit_tenggorokan,
									MAX( CASE WHEN a.idQuestion = 2981 THEN response END ) menggigil,
									MAX( CASE WHEN a.idQuestion = 2982 THEN response END ) mual,
									MAX( CASE WHEN a.idQuestion = 2983 THEN response END ) kejang,
									MAX( CASE WHEN a.idQuestion = 2984 THEN response END ) sakit_kepala,
									MAX( CASE WHEN a.idQuestion = 2985 THEN response END ) hilang_perasa,
									MAX( CASE WHEN a.idQuestion = 2986 THEN response END ) hilang_penciuman,
									MAX( CASE WHEN a.idQuestion = 3021 THEN response END ) sakit_sendi,
									MAX( CASE WHEN a.idQuestion = 3022 THEN response END ) diare,
									MAX( CASE WHEN a.idQuestion = 3023 THEN response END ) ruam,
									MAX( CASE WHEN a.idQuestion = 3024 THEN response END ) lelah,
									MAX( CASE WHEN a.idQuestion = 3025 THEN response END ) konjungtivitis,
									MAX( CASE WHEN a.idQuestion = 3026 THEN response END ) hidung_berdarah,
									MAX( CASE WHEN a.idQuestion = 3027 THEN response END ) penururan_kesadaran,
									MAX( CASE WHEN a.idQuestion = 3028 THEN response END ) hilang_nafsu_makan,
									MAX( CASE WHEN a.idQuestion = 3029 THEN response END ) neurologis,
									MAX( CASE WHEN a.idQuestion = 2996 THEN response END ) gejala_lain,
									MAX( CASE WHEN a.idQuestion = 2997 THEN response END ) close_contact,
									MAX( CASE WHEN a.idQuestion = 2998 THEN response END ) keluarga_sakit,
									MAX( CASE WHEN a.idQuestion = 3001 THEN response END ) jelaskan_sakit,
									MAX( CASE WHEN a.idQuestion = 3050 THEN response END ) keluar_kota,
									MAX( CASE WHEN a.idQuestion = 2999 THEN response END ) lokasi_kota,
									MAX( CASE WHEN a.idQuestion = 3047 THEN response END ) tanggal_perjalanan,
									MAX( CASE WHEN a.idQuestion = 3049 THEN response END ) lokasi_kerja
									';
			$tbl 			= 'responses a';
			$where 		= 'WHERE a.survey = 93 AND DATE_FORMAT(a.tanggal,"%d-%m-%Y") = "'.$bulan.'"';
			$join  		= 'LEFT JOIN screening b ON a.idResponse = b.idResponse';
			$groupby 	= 'GROUP BY a.idResponse';
			$data 		= $this->mdl->Raw_data_employee($kolom,$tbl,$join,$where,$groupby);
			$no 			= 1;
			foreach ($data as $data) {
					$tabel.= '
					<tr>
						<td><center>'.$no.'</center></td>
						<td>'.$data->response_date.'</td>
						<td><center>'.$data->nik_emp.'</center></td>
						<td><center>'.$data->nama_emp.'</center></td>
						<td>'.$data->suhu.'</td>
						<td>'.$data->demam.'</td>
						<td>'.$data->pilek.'</td>
						<td>'.$data->batuk.'</td>
						<td>'.$data->kesulitan_bernafas.'</td>
						<td>'.$data->sakit_tenggorokan.'</td>
						<td>'.$data->menggigil.'</td>
						<td>'.$data->mual.'</td>
						<td>'.$data->kejang.'</td>
						<td>'.$data->sakit_kepala.'</td>
						<td>'.$data->hilang_perasa.'</td>
						<td>'.$data->hilang_penciuman.'</td>
						<td>'.$data->sakit_sendi.'</td>
						<td>'.$data->diare.'</td>
						<td>'.$data->ruam.'</td>
						<td>'.$data->lelah.'</td>
						<td>'.$data->konjungtivitis.'</td>
						<td>'.$data->hidung_berdarah.'</td>
						<td>'.$data->penururan_kesadaran.'</td>
						<td>'.$data->hilang_nafsu_makan.'</td>
						<td>'.$data->neurologis.'</td>
						<td>'.$data->gejala_lain.'</td>
						<td>'.$data->close_contact.'</td>
						<td>'.$data->keluarga_sakit.'</td>
						<td>'.$data->jelaskan_sakit.'</td>
						<td>'.$data->keluar_kota.'</td>
						<td>'.$data->lokasi_kota.'</td>
						<td>'.$data->tanggal_perjalanan.'</td>
						<td>'.$data->lokasi_kerja.'</td>
						<td>';
					
						$kolom_pic 	= 'idResponse,url';
						$tbl_pic 		= 'responses';
						$where_pic 	= 'WHERE idQuestion = 3002
													AND DATE_FORMAT(tanggal,"%d-%m-%Y") = "'.$bulan.'" 
													AND idResponse =  '.$data->idResponse .' ';
						$join_pic  	= '';
						$order_pic 	= '';
						$data_pic 	= $this->mdl->Raw_data_employee($kolom_pic,$tbl_pic,$join_pic,$where_pic,$order_pic);
						foreach ($data_pic as $key_pic) {
							$tabel.= '
							<span onclick="show_image('.$key_pic->idResponse.')">
								<img src="'.$key_pic->url.'" class="img-rounded" style="border: 3px solid #555;" width="50" height="50" >
							</span>';
							break;
						}
						

				$tabel.= '
						</td>
					</tr>
					';

					$no++;
				}

		return $tabel;
	}

	public function Raw_data_outsourcing($bulan){
		// $jdl='';
		$tabel="";

		$tabel.=$this->Raw_data_outsourcing2($bulan);
		
		$respone = "sukses";
		$return = array('respone' => $respone, 'tabel' => $tabel, 'bulan' => $bulan);
		echo json_encode($return);
	}

	public function Raw_data_outsourcing2($bulan){

		$tabel="";

			$kolom 		= 'a.idResponse,
									a.tanggal as response_date,
									b.nik as nik_out,
									b.Nama as nama_out,
									MAX( CASE WHEN a.idQuestion = 2944 THEN response END ) suhu,
									MAX( CASE WHEN a.idQuestion = 2945 THEN response END ) demam,
									MAX( CASE WHEN a.idQuestion = 3096 THEN response END ) pilek,
									MAX( CASE WHEN a.idQuestion = 2946 THEN response END ) batuk,
									MAX( CASE WHEN a.idQuestion = 2947 THEN response END ) kesulitan_bernafas,
									MAX( CASE WHEN a.idQuestion = 2948 THEN response END ) sakit_tenggorokan,
									MAX( CASE WHEN a.idQuestion = 2949 THEN response END ) menggigil,
									MAX( CASE WHEN a.idQuestion = 2950 THEN response END ) mual,
									MAX( CASE WHEN a.idQuestion = 2951 THEN response END ) kejang,
									MAX( CASE WHEN a.idQuestion = 2952 THEN response END ) sakit_kepala,
									MAX( CASE WHEN a.idQuestion = 2953 THEN response END ) hilang_perasa,
									MAX( CASE WHEN a.idQuestion = 2954 THEN response END ) hilang_penciuman,
									MAX( CASE WHEN a.idQuestion = 2955 THEN response END ) sakit_sendi,
									MAX( CASE WHEN a.idQuestion = 2956 THEN response END ) diare,
									MAX( CASE WHEN a.idQuestion = 2957 THEN response END ) ruam,
									MAX( CASE WHEN a.idQuestion = 2958 THEN response END ) lelah,
									MAX( CASE WHEN a.idQuestion = 2959 THEN response END ) konjungtivitis,
									MAX( CASE WHEN a.idQuestion = 2960 THEN response END ) hidung_berdarah,
									MAX( CASE WHEN a.idQuestion = 2961 THEN response END ) penururan_kesadaran,
									MAX( CASE WHEN a.idQuestion = 2962 THEN response END ) hilang_nafsu_makan,
									MAX( CASE WHEN a.idQuestion = 2963 THEN response END ) neurologis,
									MAX( CASE WHEN a.idQuestion = 2964 THEN response END ) gejala_lain,
									MAX( CASE WHEN a.idQuestion = 2965 THEN response END ) close_contact,
									MAX( CASE WHEN a.idQuestion = 2968 THEN response END ) keluarga_sakit,
									MAX( CASE WHEN a.idQuestion = 2969 THEN response END ) jelaskan_sakit,
									MAX( CASE WHEN a.idQuestion = 3051 THEN response END ) keluar_kota,
									MAX( CASE WHEN a.idQuestion = 2967 THEN response END ) lokasi_kota,
									MAX( CASE WHEN a.idQuestion = 3052 THEN response END ) tanggal_perjalanan
									';
			$tbl 			= 'responses a';
			$where 		= 'WHERE a.survey = 92 AND DATE_FORMAT(a.tanggal,"%d-%m-%Y") = "'.$bulan.'"';
			$join  		= 'LEFT JOIN screening b ON a.idResponse = b.idResponse';
			$groupby 	= 'GROUP BY a.idResponse';
			$data 		= $this->mdl->Raw_data_employee($kolom,$tbl,$join,$where,$groupby);
			$no 			= 1;
			foreach ($data as $data) {
					$tabel.= '
					<tr>
						<td><center>'.$no.'</center></td>
						<td>'.$data->response_date.'</td>
						<td><center>'.$data->nik_out.'</center></td>
						<td><center>'.$data->nama_out.'</center></td>
						<td>'.$data->suhu.'</td>
						<td>'.$data->demam.'</td>
						<td>'.$data->pilek.'</td>
						<td>'.$data->batuk.'</td>
						<td>'.$data->kesulitan_bernafas.'</td>
						<td>'.$data->sakit_tenggorokan.'</td>
						<td>'.$data->menggigil.'</td>
						<td>'.$data->mual.'</td>
						<td>'.$data->kejang.'</td>
						<td>'.$data->sakit_kepala.'</td>
						<td>'.$data->hilang_perasa.'</td>
						<td>'.$data->hilang_penciuman.'</td>
						<td>'.$data->sakit_sendi.'</td>
						<td>'.$data->diare.'</td>
						<td>'.$data->ruam.'</td>
						<td>'.$data->lelah.'</td>
						<td>'.$data->konjungtivitis.'</td>
						<td>'.$data->hidung_berdarah.'</td>
						<td>'.$data->penururan_kesadaran.'</td>
						<td>'.$data->hilang_nafsu_makan.'</td>
						<td>'.$data->neurologis.'</td>
						<td>'.$data->gejala_lain.'</td>
						<td>'.$data->close_contact.'</td>
						<td>'.$data->keluarga_sakit.'</td>
						<td>'.$data->jelaskan_sakit.'</td>
						<td>'.$data->keluar_kota.'</td>
						<td>'.$data->lokasi_kota.'</td>
						<td>'.$data->tanggal_perjalanan.'</td>
						<td>';
					
						$kolom_pic 	= 'idResponse,url';
						$tbl_pic 		= 'responses';
						$where_pic 	= 'WHERE idQuestion = 2970
													AND DATE_FORMAT(tanggal,"%d-%m-%Y") = "'.$bulan.'" 
													AND idResponse =  '.$data->idResponse .' ';
						$join_pic  	= '';
						$order_pic 	= '';
						$data_pic 	= $this->mdl->Raw_data_employee($kolom_pic,$tbl_pic,$join_pic,$where_pic,$order_pic);
						foreach ($data_pic as $key_pic) {
							$tabel.= '
							<span onclick="show_image('.$key_pic->idResponse.')">
								<img src="'.$key_pic->url.'" class="img-rounded" style="border: 3px solid #555;" width="50" height="50" >
							</span>';
							break;
						}
						

				$tabel.= '
						</td>
					</tr>
					';

					$no++;
				}

		return $tabel;
	}

	public function parse_bln($bulan,$tahun){
		date_default_timezone_set('Asia/Jakarta');
		$bln = '';
		if ($bulan < 10) {
			$bln = $tahun.'-0'.$bulan;
		}else{
			$bln = $tahun.'-'.$bulan;
		}
		return $bln;
	}

	public function download(){
		$data['data'] = $this->mdl->selectAll();
		// $tabel="";

		// $tabel.=$this->$data;
		$this->load->view('SurveyList', $data);
		
		return $data;
	}

	public function excel(){
		// $bulan = $_REQUEST["bulan"];
		// $bulan = $this->input->get('bulan', TRUE);
		// // echo $bulan;exit();
		// if ($bulan){
		// 	$bulan_cari = \DateTime::createFromFormat("m-Y", $bulan)->format("Y-m");
		// }else{
		// 	$bulan_cari = date('Y-m');
		// }
		// $bulan_name = date("F Y", strtotime($bulan_cari));

		// echo $bulan.' '.$bulan_name;exit();

		$jdl = 'REPORT SCREENING';
		
		$data = array(
					'jdl'=>$jdl,
					// 'bulan_name'=>$bulan_name,
					'tabel' => $this->download()
					);

		// echo $type.' '.$tahun;exit();
		$filename =$jdl.".xls";
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		$this->load->view('SurveyList/SurveyList_excel',$data);
		
		
	}
	
}