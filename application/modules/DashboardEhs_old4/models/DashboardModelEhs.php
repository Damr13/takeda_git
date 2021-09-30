<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class DashboardModelEhs extends CI_Model{
 
  public function __construct(){
    parent::__construct();
    //Codeigniter : Write Less Do More
	}
	
    public function getJudgementVal($start,$finish){
        $q = "SELECT
	        ( SELECT count( judgement ) FROM screening WHERE judgement = 'VERY HIGH' ) very_high,
	        ( SELECT count( judgement ) FROM screening WHERE judgement = 'HIGH' ) high,
	        ( SELECT count( judgement ) FROM screening WHERE judgement = 'MODERATE' ) moderate,
	        ( SELECT count( judgement ) FROM screening WHERE judgement = 'LOW' ) low,
	        ( SELECT count( judgement ) FROM screening WHERE judgement = 'VERY LOW' ) very_low";
        $result = $this->db->query($q)->result();
        return $result;
    }
    
    public function getStatusByPeople($status,$people){
        $q = "SELECT * FROM screening WHERE judgement = '$status' AND category = '$people'";
        // echo $q;
        $result = $this->db->query($q)->result();
        return $result;
    }
    
    	
    public function getPieValue($col,$dateStart,$datefinish){
        $q = "SELECT
	( SELECT count( judgement ) FROM screening WHERE judgement = 'VERY HIGH'   and category='$col') very_high,
	( SELECT count( judgement ) FROM screening WHERE judgement = 'HIGH' and category='$col' ) high,
	( SELECT count( judgement ) FROM screening WHERE judgement = 'MODERATE' and category='$col' ) moderate,
	( SELECT count( judgement ) FROM screening WHERE judgement = 'LOW' and category='$col') low,
	( SELECT count( judgement ) FROM screening WHERE judgement = 'VERY LOW' and category='$col') very_low,
    (select count(*) as total from screening where category='$col') total";
        $result = $this->db->query($q)->result();
        return $result;
    }

	public function get_oee($id_machine,$tahun){
		$q = "SELECT c.*,(av*prf*qly) as dd,round((av*prf*qly)/10000,2) as overall_oee
				FROM
				(
				SELECT
					b.*,ifnull(round(((tt*100)/(data_i * speed)),2),0) as prf
				FROM
					(
						SELECT
							a.*, (rt -(pdt + udt + it)) AS data_i,
							round(((rt -(pdt + udt + it)) / rt)*100, 2) AS av,
							round(
								ifnull((product_good / tt)*100, 0),
								2
							) AS qly
						FROM
							(
								SELECT
									SUBSTR(date, 1, 4) AS thn,
									SUBSTR(date, 1, 7) AS bln,
									report_down (SUBSTR(date, 1, 7), 'RT',".$id_machine.") AS rt,
									report_down (SUBSTR(date, 1, 7), 'PDT',".$id_machine.") AS pdt,
									report_down (SUBSTR(date, 1, 7), 'UDT',".$id_machine.") AS udt,
									report_down (SUBSTR(date, 1, 7), 'IT',".$id_machine.") AS it,
									report_prd_good (SUBSTR(date, 1, 7), ".$id_machine.") AS product_good,
									report_prd_reject (SUBSTR(date, 1, 7), ".$id_machine.") AS product_reject,
									ifnull(sum(speed), 0) AS speed,
									report_prd_good (SUBSTR(date, 1, 7), ".$id_machine.") + report_prd_reject (SUBSTR(date, 1, 7), ".$id_machine.") AS tt
								FROM
									log_book
								WHERE
									SUBSTR(date, 1, 4) = '".$tahun."' and machine = ".$id_machine."
								GROUP BY
									SUBSTR(date, 1, 7)
								ORDER BY
									SUBSTR(date, 1, 7) ASC
							) a
					) b
				) c ";
		// echo $q;exit();
		$rs = $this->db->query($q)->result();
		return $rs;
	}

	public function get_oee_month($id_machine,$month){
		$q = "SELECT c.*,(av*prf*qly) as dd,round((av*prf*qly)/10000,2) as overall_oee
				FROM
				(
				SELECT
					b.*,ifnull(round(((tt*100)/(data_i * speed)),2),0) as prf
				FROM
					(
						SELECT
							a.*, (rt -(pdt + udt + it)) AS data_i,
							round(((rt -(pdt + udt + it)) / rt)*100, 2) AS av,
							round(
								ifnull((product_good / tt)*100, 0),
								2
							) AS qly
						FROM
							(
								SELECT
									SUBSTR(date, 1, 7) AS bln,
									date,
									report_down_month (date, 'RT', ".$id_machine.") AS rt,
									report_down_month (date, 'PDT', ".$id_machine.") AS pdt,
									report_down_month (date, 'UDT', ".$id_machine.") AS udt,
									report_down_month (date, 'IT', ".$id_machine.") AS it,
									report_prd_good_month (date, ".$id_machine.") AS product_good,
									report_prd_reject_month (date, ".$id_machine.") AS product_reject,
									ifnull(sum(speed), 0) AS speed,
									report_prd_good_month (date, ".$id_machine.") + report_prd_reject_month (date, ".$id_machine.") AS tt
								FROM
									log_book
								WHERE
									SUBSTR(date, 1, 7) = '".$month."'
								AND machine = ".$id_machine."
								GROUP BY
									date
								ORDER BY
									date ASC
							) a
					) b
				) c ";
		// echo $q;exit();
		$rs = $this->db->query($q)->result();
		return $rs;
	}

	public function get_cal($type,$tahun, $periode, $checkBy){
		if ($checkBy == "date") {
			$periode		=	explode(".", $periode);
			$dateStart 	= explode("-", $periode[0]); 
			$dateFinish	= explode("-", $periode[1]); 

			$dateStart 	= $dateStart[0] + 0; 			
			$dateFinish = $dateFinish[0] + 0; 			

			$periode	=	"(";
			for ($i=$dateStart; $i <= $dateFinish; $i++) { 
				if ($i < 10) $i = '0'.$i;
				$month = strtolower(date('M', strtotime($tahun."-".$i)));
				if ($month != "dec") $periode .= $month;
				else $periode .= "'".$month."'";
				if ($i < $dateFinish) $periode .= "+";
			}
			$periode	.= ")";
		}else{
			if ($periode == "year") $periode = '(apr+may+jun+jul+aug+sep+oct+nov+"dec"+jan+feb+mar)';
			else {
				$month = strtolower(date('M'));
				if ($month != "dec") $periode = $month;
				else $periode = "'".$month."'";
			}
		}
		
		$q = "SELECT id,type,tahun,
				(SELECT $periode FROM pm_cal a LEFT JOIN pm_cal_det b ON a.id = b.id_pm_cal WHERE type = '".$type."' AND tahun = '".$tahun."' AND b.type_pm_cal = 'Target' LIMIT 1) as target,
				(SELECT $periode FROM pm_cal a LEFT JOIN pm_cal_det b ON a.id = b.id_pm_cal WHERE type = '".$type."' AND tahun = '".$tahun."' AND b.type_pm_cal = 'Actual' LIMIT 1) as actual
			FROM pm_cal
			WHERE type = '".$type."' AND tahun = '".$tahun."' ";
		$rs = $this->db->query($q)->row();
		// echo var_dump($q);
		return $rs;
	}

	public function get_capa($type,$tahun,$periode, $checkBy){
		if ($checkBy == "date") {
			$periode		=	explode(".", $periode);
			$dateStart 	= explode("-", $periode[0]); 
			$dateFinish	= explode("-", $periode[1]); 

			$dateStart 	= $dateStart[0] + 0; 			
			$dateFinish = $dateFinish[0] + 0; 			

			$periode	=	"(";
			for ($i=$dateStart; $i <= $dateFinish; $i++) { 
				if ($i < 10) $i = '0'.$i;
				$month = strtolower(date('M', strtotime($tahun."-".$i)));
				if ($month != "dec") $periode .= $month;
				else $periode .= "'".$month."'";
				if ($i < $dateFinish) $periode .= "+";
			}
			$periode	.= ")";
		}else{
			if ($periode == "year") $periode = '(apr+may+jun+jul+aug+sep+oct+nov+"dec"+jan+feb+mar)';
			else {
				$month = strtolower(date('M'));
				if ($month != "dec") $periode = $month;
				else $periode = "'".$month."'";
			}
		}

		$q = "SELECT
				id,
				type,
				tahun,
				(SELECT $periode FROM capability a LEFT JOIN capability_det b ON a.id = b.id_capability WHERE type = '".$type."' AND tahun = '".$tahun."' AND b.type_capability = 'Total Capa' LIMIT 1) as total,
				(SELECT $periode FROM capability a LEFT JOIN capability_det b ON a.id = b.id_capability WHERE type = '".$type."' AND tahun = '".$tahun."' AND b.type_capability = 'Extain' LIMIT 1) as extain,
				(SELECT $periode FROM capability a LEFT JOIN capability_det b ON a.id = b.id_capability WHERE type = '".$type."' AND tahun = '".$tahun."' AND b.type_capability = 'Overdue' LIMIT 1) as overdue,
				(SELECT $periode FROM capability a LEFT JOIN capability_det b ON a.id = b.id_capability WHERE type = '".$type."' AND tahun = '".$tahun."' AND b.type_capability = 'Closed' LIMIT 1) as closed
			FROM
				capability
			WHERE type = '".$type."' AND tahun = '".$tahun."' ";
		// $q = "SELECT
		// 		id,
		// 		type,
		// 		tahun,
		// 		chart_capa(id,'Total Capa') as total,
		// 		chart_capa(id,'Extain') as extain,
		// 		chart_capa(id,'Overdue') as overdue,
		// 		chart_capa(id,'Closed') as closed
		// 	FROM
		// 		capability
		// 	WHERE type = '".$type."' AND tahun = '".$tahun."' ";
			// echo $q;exit();
		$rs = $this->db->query($q)->row();
		return $rs;
	}

	public function get_cons($type,$tahun,$periode, $checkBy){
		if ($checkBy == "date") {
			$periode		=	explode(".", $periode);
			$dateStart 	= explode("-", $periode[0]); 
			$dateFinish	= explode("-", $periode[1]); 

			$dateStart 	= $dateStart[0] + 0; 			
			$dateFinish = $dateFinish[0] + 0; 			

			$periode	=	"(";
			for ($i=$dateStart; $i <= $dateFinish; $i++) { 
				if ($i < 10) $i = '0'.$i;
				$month = strtolower(date('M', strtotime($tahun."-".$i)));
				if ($month != "dec") $periode .= $month;
				else $periode .= "'".$month."'";
				if ($i < $dateFinish) $periode .= "+";
			}
			$periode	.= ")";
		}else{
			if ($periode == "year") $periode = '(apr+may+jun+jul+aug+sep+oct+nov+"dec"+jan+feb+mar)';
			else {
				$month = strtolower(date('M'));
				if ($month != "dec") $periode = $month;
				else $periode = "'".$month."'";
			}
		}

		$q = "SELECT
				id,
				type,
				tahun,
				(SELECT $periode FROM consumption a LEFT JOIN consumption_det b ON a.id = b.id_consumption WHERE type = '".$type."' AND tahun = '".$tahun."' AND b.type_consumption = 'Target' LIMIT 1) as target,
				(SELECT $periode FROM consumption a LEFT JOIN consumption_det b ON a.id = b.id_consumption WHERE type = '".$type."' AND tahun = '".$tahun."' AND b.type_consumption = 'Actual' LIMIT 1) as actual
			FROM
				consumption
			WHERE type = '".$type."' AND tahun = '".$tahun."' ";
		// $q = "SELECT
		// 		id,
		// 		type,
		// 		tahun,
		// 		(SELECT $periode FROM consumption a LEFT JOIN consumption_det b ON a.id = b.id_consumption WHERE type = '".$type."' AND tahun = '".$tahun."' AND b.type_consumption = 'Target' LIMIT 1) as target,
		// 		(SELECT $periode FROM consumption a LEFT JOIN consumption_det b ON a.id = b.id_consumption WHERE type = '".$type."' AND tahun = '".$tahun."' AND b.type_consumption = 'Actual' LIMIT 1) as actual
		// 		chart_consumption(id,'Target') as target,
		// 		chart_consumption(id,'Actual') as actual
		// 	FROM
		// 		consumption
		// 	WHERE type = '".$type."' AND tahun = '".$tahun."' ";
			// echo $q;exit();
		$rs = $this->db->query($q)->row();
		return $rs;
	}

    public function getpercent_emp($periode){
        $periode =	explode(".", $periode);
		$q = "  SELECT a.judgement,count(a.judgement) as skor,b.total as responden,count(a.judgement)/b.total * 100 as percent
                from screening a,(select count(*) as total from screening where category='Karyawan') b 
                where a.category='Karyawan'
                group by a.category,a.judgement  ";
		$rs = $this->db->query($q)->result();
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


	// GET TARGET --ir
	public function getTarget($month,$tahun){
		$q = "SELECT ".$month." as target FROM mst_target WHERE year ='".$tahun."'";
		$rs = $this->db->query($q)->row();
		return $rs;
	}

	// MACHINE LISTS --ir
	public function machineLists(){
		$q = "SELECT * FROM mst_machine";
		$rs = $this->db->query($q)->result();
		return $rs;
	}

	// CHECK LOGBOOK --ir
	public function checkLogbook($shift, $date, $checkBy){
		if($checkBy == "date") $checkBy = 'date';
		else $checkBy = "LPAD(MONTH(date),2,'0')";

		$q	= "SELECT COUNT(id) as count, date FROM log_book WHERE $checkBy = '".$date."' AND shift = '".$shift."'";
		$rs = $this->db->query($q)->row();
		return $rs;
	}

	// COUNT PLAN OPERATING TIME, PLAN DOWNTIME, UNPLANNED DOWNTIME, IDLE TIME, AND UTILITY TIME --ir
	public function countDowntime($checkBy, $shift, $date, $type, $id_machine){
		if($checkBy == "date") $checkBy = 'a.date';
		else $checkBy = "LPAD(MONTH(a.date),2,'0')";

		$q	= "SELECT (COUNT(a.id)*5) as total FROM log_book a
			LEFT JOIN  log_book_det_time b ON b.id_log_book = a.id
			LEFT JOIN mst_downtime c ON b.code = c.id
			WHERE $checkBy = '".$date."' AND a.shift = '".$shift."' AND a.machine = '".$id_machine."' AND c.downtimeGroup = '".$type."'";
		$rs = $this->db->query($q)->row();
		return $rs;
	}

  public function product_good($bulan) {
		$q  = "SELECT
				IFNULL(SUM(a.product_good)*d.spq,0) as t_prod
			FROM
				log_book_det_product a
			LEFT JOIN 
				log_book b ON a.id_log_book = b.id
			LEFT JOIN 
				mst_machine c ON b.machine = c.id
			LEFT JOIN mst_product d ON a.id_product=d.id
			WHERE SUBSTR(date,1,7) = '".$bulan."' 
				AND c.machineName != 'Gemini'";
		// echo $q;exit();
		$rs = $this->db->query($q)->row();
    return $rs;
  }

  public function product_reject($bulan) {
		$q  = "SELECT
				IFNULL(SUM(a.product_reject),0) as t_prod
			FROM
				log_book_det_product a
			LEFT JOIN 
				log_book b ON a.id_log_book = b.id
			LEFT JOIN 
				mst_machine c ON b.machine = c.id
			WHERE SUBSTR(date,1,7) = '".$bulan."' 
				AND c.machineName != 'Gemini'";
		// echo $q;exit();
		$rs = $this->db->query($q)->row();
    return $rs;
	}
	
  public function run_hour($bulan) {
		$q  = "SELECT
					(COUNT(*)*5)/60 AS jml_hour
				FROM
					log_book a
				LEFT JOIN log_book_det_time b ON a.id = b.id_log_book
				LEFT JOIN mst_downtime c ON b.`code` = c.id
				LEFT JOIN mst_machine d ON a.machine = d.id
				WHERE 
					SUBSTR(date,1,7) = '".$bulan."' 
				AND d.machineName != 'Gemini'
				AND c.downtimeGroup = 'RT' ";
		// echo $q;exit();
		$rs = $this->db->query($q)->row();
    return $rs;
	}
	
  public function product_good_range($dateStart,$dateEnd) {
		$q  = "SELECT
				IFNULL(SUM(a.product_good)*d.spq,0) as t_prod
			FROM
				log_book_det_product a
			LEFT JOIN 
				log_book b ON a.id_log_book = b.id
			LEFT JOIN 
				mst_machine c ON b.machine = c.id
			LEFT JOIN mst_product d ON a.id_product=d.id
			WHERE 
				c.machineName != 'Gemini'
				AND date BETWEEN '".$dateStart."' AND '".$dateEnd."' ";
		// echo $q;exit();
		$rs = $this->db->query($q)->row();
    return $rs;
  }

  public function product_reject_range($dateStart,$dateEnd) {
		$q  = "SELECT
				IFNULL(SUM(a.product_reject),0) as t_prod
			FROM
				log_book_det_product a
			LEFT JOIN 
				log_book b ON a.id_log_book = b.id
			LEFT JOIN 
				mst_machine c ON b.machine = c.id
			WHERE 
				c.machineName != 'Gemini'
				AND date BETWEEN '".$dateStart."' AND '".$dateEnd."' ";
		// echo $q;exit();
		$rs = $this->db->query($q)->row();
    return $rs;
	}
	
  	public function run_hour_range($dateStart,$dateEnd) {
		$q  = "SELECT
					(COUNT(*)*5)/60 AS jml_hour
				FROM
					log_book a
				LEFT JOIN log_book_det_time b ON a.id = b.id_log_book
				LEFT JOIN mst_downtime c ON b.`code` = c.id
				LEFT JOIN mst_machine d ON a.machine = d.id
				WHERE 
					d.machineName != 'Gemini'
					AND date BETWEEN '".$dateStart."' AND '".$dateEnd."'
				AND c.downtimeGroup = 'RT' ";
		// echo $q;exit();
		$rs = $this->db->query($q)->row();
    	return $rs;
  	}

  	public function get_budget($tahun,$compare,$type){
		
		
		$q = "SELECT a.id,a.type,a.compare,a.tahun,a.fyb,sum(b.actual) as tt_actual
				FROM budget a
				LEFT JOIN budget_det b on a.id = b.id_budget
				WHERE a.type = '".$type."' AND a.compare = '".$compare."' AND a.tahun = '".$tahun."' ";
		$rs = $this->db->query($q)->row();
		// echo var_dump($q);
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