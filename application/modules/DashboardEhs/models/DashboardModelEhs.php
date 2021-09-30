<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class DashboardModelEhs extends CI_Model{
 
  public function __construct(){
    parent::__construct();
    //Codeigniter : Write Less Do More
	}
		// Judgement
    public function getJudgementVal($startDate,$endDate){
			$todayDate = date("d-m-Y");
			if($startDate!='' AND $endDate!=''){
				$and_date = "AND (DATE_FORMAT(tgl, '%Y-%m-%d') BETWEEN '".$startDate."' AND '".$endDate."')";
			}else{
				$and_date = "AND DATE_FORMAT(tgl, '%d-%m-%Y') = ('".$todayDate."') ";
			}
			$q = "SELECT
				( SELECT IFNULL(count(DISTINCT Nama), judgement) FROM screening WHERE judgement = 'VERY HIGH' AND Nama IS NOT NULL AND Nama != '' ".$and_date." ) very_high,
				( SELECT IFNULL(count(DISTINCT Nama), judgement) FROM screening WHERE judgement = 'HIGH' AND Nama IS NOT NULL AND Nama != '' ".$and_date." ) high,
				( SELECT IFNULL(count(DISTINCT Nama), judgement) FROM screening WHERE judgement = 'MODERATE' AND Nama IS NOT NULL AND Nama != '' ".$and_date." ) moderate,
				( SELECT IFNULL(count(DISTINCT Nama), judgement) FROM screening WHERE judgement = 'LOW' AND Nama IS NOT NULL AND Nama != '' ".$and_date." ) low,
				( SELECT IFNULL(count(DISTINCT Nama), judgement) FROM screening WHERE judgement = 'VERY LOW' AND Nama IS NOT NULL AND Nama != '' ".$and_date." ) very_low";
			$result = $this->db->query($q)->result();
			return $result;
    }
		// Departement
    public function getDeptValue($startDate,$endDate){
			$todayDate = date("d-m-Y");
			if($startDate!='' AND $endDate!=''){
				$and_date = "AND (DATE_FORMAT(tgl, '%Y-%m-%d') BETWEEN '".$startDate."' AND '".$endDate."')";
			}else{
				$and_date = "AND DATE_FORMAT(tgl, '%d-%m-%Y') = ('01-01-2021') ";
			}
			$q = "SELECT 

					(SELECT COUNT( a.Nama ) FROM mstemployee a LEFT JOIN mstdept b ON a.idDept = b.id WHERE b.DeptName = 'Business excellence' AND a.Nama != 'doit') be_fe,
					(SELECT COUNT( a.Nama ) FROM mstemployee a LEFT JOIN mstdept b ON a.idDept = b.id WHERE b.DeptName = 'Engineering/EHS') eng_fe,
					(SELECT COUNT( a.Nama ) FROM mstemployee a LEFT JOIN mstdept b ON a.idDept = b.id WHERE b.DeptName = 'Finance') fnc_fe,
					(SELECT COUNT( a.Nama ) FROM mstemployee a LEFT JOIN mstdept b ON a.idDept = b.id WHERE b.DeptName = 'Human Resources') hr_fe,
					(SELECT COUNT( a.Nama ) FROM mstemployee a LEFT JOIN mstdept b ON a.idDept = b.id WHERE b.DeptName = 'Manufacturing Science') ms_fe,
					(SELECT COUNT( a.Nama ) FROM mstemployee a LEFT JOIN mstdept b ON a.idDept = b.id WHERE b.DeptName LIKE 'Packing %') pack_fe,
					(SELECT COUNT( a.Nama ) FROM mstemployee a LEFT JOIN mstdept b ON a.idDept = b.id WHERE b.DeptName = 'Plant Director') plant_fe,
					(SELECT COUNT( a.Nama ) FROM mstemployee a LEFT JOIN mstdept b ON a.idDept = b.id WHERE b.DeptName = 'Production') p2_fe,
					(SELECT COUNT( a.Nama ) FROM mstemployee a LEFT JOIN mstdept b ON a.idDept = b.id WHERE b.DeptName = 'Quality Assurance') qa_fe,
					(SELECT COUNT( a.Nama ) FROM mstemployee a LEFT JOIN mstdept b ON a.idDept = b.id WHERE b.DeptName = 'Quality Control') qc_fe,
					(SELECT COUNT( a.Nama ) FROM mstemployee a LEFT JOIN mstdept b ON a.idDept = b.id WHERE b.DeptName = 'Security') sc_fe,
										
					(SELECT COUNT(b.Nama) FROM mstemployee a LEFT JOIN screening b ON a.Nik = b.nik LEFT JOIN mstdept c ON a.idDept = c.id WHERE a.Nik = b.nik AND c.DeptName = 'Business excellence' ".$and_date." ) be_fs,
					(SELECT COUNT(b.Nama) FROM mstemployee a LEFT JOIN screening b ON a.Nik = b.nik LEFT JOIN mstdept c ON a.idDept = c.id WHERE a.Nik = b.nik AND c.DeptName = 'Engineering/EHS' ".$and_date." ) eng_fs,
					(SELECT COUNT(b.Nama) FROM mstemployee a LEFT JOIN screening b ON a.Nik = b.nik LEFT JOIN mstdept c ON a.idDept = c.id WHERE a.Nik = b.nik	AND c.DeptName = 'Finance' ".$and_date." ) fnc_fs,
					(SELECT COUNT(b.Nama) FROM mstemployee a LEFT JOIN screening b ON a.Nik = b.nik LEFT JOIN mstdept c ON a.idDept = c.id WHERE a.Nik = b.nik AND c.DeptName = 'Human Resources' ".$and_date." ) hr_fs,
					(SELECT COUNT(b.Nama) FROM mstemployee a LEFT JOIN screening b ON a.Nik = b.nik LEFT JOIN mstdept c ON a.idDept = c.id WHERE a.Nik = b.nik AND c.DeptName = 'Manufacturing Science' ".$and_date." ) ms_fs,
					(SELECT COUNT(b.Nama) FROM mstemployee a LEFT JOIN screening b ON a.Nik = b.nik LEFT JOIN mstdept c ON a.idDept = c.id WHERE a.Nik = b.nik AND c.DeptName LIKE 'Packing %' ".$and_date." ) pack_fs,
					(SELECT COUNT(b.Nama) FROM mstemployee a LEFT JOIN screening b ON a.Nik = b.nik LEFT JOIN mstdept c ON a.idDept = c.id WHERE a.Nik = b.nik AND c.DeptName = 'Plant Director' ".$and_date." ) plant_fs,
					(SELECT COUNT(b.Nama) FROM mstemployee a LEFT JOIN screening b ON a.Nik = b.nik LEFT JOIN mstdept c ON a.idDept = c.id WHERE a.Nik = b.nik AND c.DeptName = 'Production' ".$and_date." ) p2_fs,
					(SELECT COUNT(b.Nama) FROM mstemployee a LEFT JOIN screening b ON a.Nik = b.nik LEFT JOIN mstdept c ON a.idDept = c.id WHERE a.Nik = b.nik AND c.DeptName = 'Quality Assurance' ".$and_date." ) qa_fs,
					(SELECT COUNT(b.Nama) FROM mstemployee a LEFT JOIN screening b ON a.Nik = b.nik LEFT JOIN mstdept c ON a.idDept = c.id WHERE a.Nik = b.nik AND c.DeptName = 'Quality Control' ".$and_date." ) qc_fs,
					(SELECT COUNT(b.Nama) FROM mstemployee a LEFT JOIN screening b ON a.Nik = b.nik LEFT JOIN mstdept c ON a.idDept = c.id WHERE a.Nik = b.nik AND c.DeptName = 'Security' ".$and_date." ) sc_fs
			
				 ";
			// echo $q;exit();
			$result = $this->db->query($q)->result();
			return $result;
    }
    // List People by Judgement
    public function getStatusByPeople($status,$people,$startDate,$endDate){
			$todayDate = date("d-m-Y");
			if($startDate!='' AND $endDate!=''){
				$and_date = "AND (DATE_FORMAT(tgl, '%Y-%m-%d') BETWEEN '".$startDate."' AND '".$endDate."')";
			}else{
				$and_date = "AND DATE_FORMAT(tgl, '%d-%m-%Y') = ('".$todayDate."') ";
			}
			$q = "SELECT * 
						FROM screening 
						WHERE judgement = '$status' 
						AND category = '$people' 
						AND Nama IS NOT NULL 
						AND Nama != '' 
						".$and_date."
						";
			$result = $this->db->query($q)->result();
			return $result;
    }
		// List People filled out the form
    public function get_check($statuss,$peoples){
			$todayDate = date("d-m-Y");
			$q = "SELECT
							Nik, nama_mst as Nama, DeptName
						FROM
							last_cek
						WHERE
							category = '$peoples' AND DATE_FORMAT(last_cek, '%d-%m-%Y') = '".$todayDate."'
						";
			// echo $q;
			$result = $this->db->query($q)->result();
			return $result;
    }
		// List People not filled out the form
    public function get_uncheck($statuss,$peoples){
			$todayDate = date("d-m-Y");
			$q = "SELECT
						Nik, nama_mst as Nama, DeptName
					FROM
						last_cek
					WHERE
						category = '$peoples' AND DATE_FORMAT(last_cek, '%d-%m-%Y') != '".$todayDate."'
						";
			// echo $q;exit();
			$result = $this->db->query($q)->result();
			return $result;
    }
    // Pie Value List People
    public function getPieValue($col,$startDate,$endDate){
			$todayDate = date("d-m-Y");
			if($startDate!='' AND $endDate!=''){
					$and_date = "AND (DATE_FORMAT(tgl, '%Y-%m-%d') BETWEEN '".$startDate."' AND '".$endDate."')";
			}else{
					$and_date = "AND DATE_FORMAT(tgl, '%d-%m-%Y') = ('".$todayDate."') ";
			}
      $q = "SELECT
				(SELECT IFNULL(count(Nama), judgement) FROM screening WHERE judgement = 'VERY HIGH' and category='$col' AND Nama IS NOT NULL AND Nama != '' ".$and_date." ) very_high,
				(SELECT IFNULL(count(Nama), judgement) FROM screening WHERE judgement = 'HIGH' and category='$col' AND Nama IS NOT NULL AND Nama != '' ".$and_date." ) high,
				(SELECT IFNULL(count(Nama), judgement) FROM screening WHERE judgement = 'MODERATE' and category='$col' AND Nama IS NOT NULL AND Nama != '' ".$and_date." ) moderate,
				(SELECT IFNULL(count(Nama), judgement) FROM screening WHERE judgement = 'LOW' and category='$col' AND Nama IS NOT NULL AND Nama != '' ".$and_date." ) low,
				(SELECT IFNULL(count(Nama), judgement) FROM screening WHERE judgement = 'VERY LOW' and category='$col' AND Nama IS NOT NULL AND Nama != '' ".$and_date." ) very_low,
    		(SELECT IFNULL(count(Nama), 0) AS total FROM screening WHERE category='$col' AND Nama IS NOT NULL AND Nama != '' ".$and_date." ) total";
			$result = $this->db->query($q)->result();
      return $result;
    }
		// Pie Value uncheck
		public function getPieValueUncheck($cols){
			$todayDate = date("d-m-Y");
			$q = "SELECT
				(SELECT IFNULL( count( Nik ), category ) FROM last_cek WHERE category = '$cols' AND DATE_FORMAT(last_cek, '%d-%m-%Y') = '".$todayDate."') tot_check,
				(SELECT IFNULL( count( Nik ), category ) FROM last_cek WHERE category = '$cols' AND DATE_FORMAT(last_cek, '%d-%m-%Y') != '".$todayDate."') tot_uncheck,
				(SELECT count(category) FROM last_cek WHERE category = '$cols' ) total";
			// echo $q;exit();
			$result = $this->db->query($q)->result();
			return $result;
    }
		// Get count all Employee
		public function getCountEmp($kolom,$tbl,$join,$where){
			$q  = "SELECT ".$kolom." FROM ".$tbl." ".$join." ".$where."";
			// echo $q;exit();
			$rs = $this->db->query($q)->result();
			// var_dump($q);
			return $rs;
		}
		// Get count all outsourcing
		public function getCountOut($kolom,$tbl,$join,$where){
			$q  = "SELECT ".$kolom." FROM ".$tbl." ".$join." ".$where."";
			// echo $q;exit();
			$rs = $this->db->query($q)->result();
			// var_dump($q);
			return $rs;
		}
		// Get Employee
		public function getemployee($kolom,$tbl,$where,$order){
			$q  = "SELECT ".$kolom." FROM ".$tbl." ".$where." ".$order."";
			// echo $q;exit();
			$rs = $this->db->query($q)->result();
			// var_dump($q);
			return $rs;
		}
		// Get Contractor
		public function getcontractor($kolom,$tbl,$where,$order){
			$q  = "SELECT ".$kolom." FROM ".$tbl." ".$where." ".$order."";
			// echo $q;exit();
			$rs = $this->db->query($q)->result();
			// var_dump($q);
			return $rs;
		}
		// Get Tamu
		public function getvisitor($kolom,$tbl,$where,$order){
			$q  = "SELECT ".$kolom." FROM ".$tbl." ".$where." ".$order."";
			// echo $q;exit();
			$rs = $this->db->query($q)->result();
			// var_dump($q);
			return $rs;
		}
		// Get Outsourcing
		public function getoutsourcing($kolom,$tbl,$where,$order){
			$q  = "SELECT ".$kolom." FROM ".$tbl." ".$where." ".$order."";
			// echo $q;exit();
			$rs = $this->db->query($q)->result();
			// var_dump($q);
			return $rs;
		}

		public function select_result($kolom,$tbl,$where,$order){
			$q  = "SELECT ".$kolom." FROM ".$tbl." ".$where." ".$order."";
			// echo $q;exit();
			$rs = $this->db->query($q)->result();
			// var_dump($q);
			return $rs;
		}

}