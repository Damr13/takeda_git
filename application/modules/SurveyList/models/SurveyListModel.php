<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class SurveyListModel extends CI_Model{

  public function Raw_data_visitor($kolom='',$tabel,$join='',$where='',$order=''){
    $q  = "SELECT ".$kolom." FROM ".$tabel." ".$join." ".$where." ".$order."";
    // echo $q;exit();
    $rs = $this->db->query($q)->result();
      // var_dump($q);
    return $rs;
  }
  public function Raw_data_contractor($kolom='',$tabel,$join='',$where='',$order=''){
    $q  = "SELECT ".$kolom." FROM ".$tabel." ".$join." ".$where." ".$order."";
    // echo $q;exit();
    $rs = $this->db->query($q)->result();
      // var_dump($q);
    return $rs;
  }
  public function Raw_data_employee($kolom='',$tabel,$join='',$where='',$order=''){
    $q  = "SELECT ".$kolom." FROM ".$tabel." ".$join." ".$where." ".$order."";
    // echo $q;exit();
    $rs = $this->db->query($q)->result();
      // var_dump($q);
    return $rs;
  }
  public function Raw_data_outsourcing($kolom='',$tabel,$join='',$where='',$order=''){
    $q  = "SELECT ".$kolom." FROM ".$tabel." ".$join." ".$where." ".$order."";
    // echo $q;exit();
    $rs = $this->db->query($q)->result();
      // var_dump($q);
    return $rs;
  }
  // public function selectVisitor() {
  //   $sql = "SELECT
  //             idResponse,
  //             tanggal as response_date,
  //             MAX( CASE WHEN idQuestion = 2680 THEN response END ) nama,
  //             MAX( CASE WHEN idQuestion = 2681 THEN response END ) perusahaan,
  //             MAX( CASE WHEN idQuestion = 2682 THEN response END ) alamat,
  //             MAX( CASE WHEN idQuestion = 2683 THEN response END ) tujuan,
  //             MAX( CASE WHEN idQuestion = 2685 THEN response END ) kasus,
  //             MAX( CASE WHEN idQuestion = 2686 THEN response END ) kapan_berkunjung,
  //             MAX( CASE WHEN idQuestion = 2687 THEN response END ) suhu,
  //             MAX( CASE WHEN idQuestion = 2688 THEN response END ) demam,
  //             MAX( CASE WHEN idQuestion = 3094 THEN response END ) pilek,
  //             MAX( CASE WHEN idQuestion = 2689 THEN response END ) batuk,
  //             MAX( CASE WHEN idQuestion = 2690 THEN response END ) kesulitan_bernafas,
  //             MAX( CASE WHEN idQuestion = 2691 THEN response END ) sakit_tenggorokan,
  //             MAX( CASE WHEN idQuestion = 2692 THEN response END ) menggigil,
  //             MAX( CASE WHEN idQuestion = 2693 THEN response END ) mual,
  //             MAX( CASE WHEN idQuestion = 2709 THEN response END ) kejang,
  //             MAX( CASE WHEN idQuestion = 2710 THEN response END ) sakit_kepala,
  //             MAX( CASE WHEN idQuestion = 2712 THEN response END ) hilang_perasa,
  //             MAX( CASE WHEN idQuestion = 2713 THEN response END ) hilang_penciuman,
  //             MAX( CASE WHEN idQuestion = 2714 THEN response END ) sakit_sendi,
  //             MAX( CASE WHEN idQuestion = 2715 THEN response END ) diare,
  //             MAX( CASE WHEN idQuestion = 2716 THEN response END ) ruam,
  //             MAX( CASE WHEN idQuestion = 2717 THEN response END ) lelah,
  //             MAX( CASE WHEN idQuestion = 2718 THEN response END ) konjungtivitis,
  //             MAX( CASE WHEN idQuestion = 2719 THEN response END ) hidung_berdarah,
  //             MAX( CASE WHEN idQuestion = 2720 THEN response END ) penururan_kesadaran,
  //             MAX( CASE WHEN idQuestion = 2721 THEN response END ) hilang_nafsu_makan,
  //             MAX( CASE WHEN idQuestion = 2722 THEN response END ) neurologis,
  //             MAX( CASE WHEN idQuestion = 2724 THEN response END ) keluar_kota,
  //             MAX( CASE WHEN idQuestion = 2725 THEN response END ) lokasi_kota,
  //             MAX( CASE WHEN idQuestion = 2727 THEN response END ) close_contact,
  //             MAX( CASE WHEN idQuestion = 3030 THEN response END ) hasil_test,
  //             MAX( CASE WHEN idQuestion = 3053 THEN response END ) gejala_lain,
  //             MAX( CASE WHEN idQuestion = 3054 THEN response END ) tanggal_perjalanan,
  //             MAX( CASE WHEN idQuestion = 3097 THEN response END ) keluarga_sakit,
  //             MAX( CASE WHEN idQuestion = 3098 THEN response END ) jelaskan_sakit,
  //             MAX( CASE WHEN idQuestion = 2707 THEN response END ) foto
  //           FROM
  //             responses
  //           WHERE
  //             survey = 86
  //           GROUP BY
  //             idResponse";

  //   $data = $this->db->query($sql);
  //   return $data->result();
  // }

  public function selectContractor() {
    $sql = "SELECT
              idResponse,
              -- survey,
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
              MAX( CASE WHEN idQuestion = 3057 THEN response END ) tanggal_perjalanan,
              MAX( CASE WHEN idQuestion = 2833 THEN response END ) foto
            FROM
              responses
            WHERE
              survey = 90
            GROUP BY
              idResponse";

    $data = $this->db->query($sql);

    return $data->result();
  }

  public function selectEmployee() {
    $todayDate = date("d-m-Y");
    $sql = "SELECT
              a.idResponse,
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
              MAX( CASE WHEN a.idQuestion = 3049 THEN response END ) lokasi_kerja,
              MAX( CASE WHEN a.idQuestion = 3002 THEN response END ) foto
            FROM
              responses a
              LEFT JOIN screening b ON a.idResponse = b.idResponse
            WHERE
              a.survey = 93 AND DATE_FORMAT(a.tanggal,'%d-%m-%Y') = '".$todayDate."'
            GROUP BY
              a.idResponse";

    $data = $this->db->query($sql);

    return $data->result();
  }

  public function selectOutsourcing() {
    $todayDate = date("d-m-Y");
    $sql = "SELECT
              a.idResponse,
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
              MAX( CASE WHEN a.idQuestion = 3052 THEN response END ) tanggal_perjalanan,
              MAX( CASE WHEN a.idQuestion = 2970 THEN response END ) foto
            FROM
              responses a
              LEFT JOIN screening b ON a.idResponse = b.idResponse
            WHERE
              a.survey = 92 AND DATE_FORMAT(a.tanggal,'%d-%m-%Y') = '".$todayDate."'
            GROUP BY
              a.idResponse";

    $data = $this->db->query($sql);

    return $data->result();
  }

}