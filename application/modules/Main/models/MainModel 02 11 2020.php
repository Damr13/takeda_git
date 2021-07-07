<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class MainModel extends CI_Model{
 
  public function __construct(){
    parent::__construct();
    //Codeigniter : Write Less Do More
	}

	public function parse_tgl($i,$bulan){
		$tgl = '';
		if ($i<10) {
			$tgl = '0'.$i.'-'.$bulan;
		}else{
			$tgl = $i.'-'.$bulan;
		}
		$tgl = date("Y-m-d", strtotime($tgl));
		return $tgl;
	}

	public function hist_down($tgl,$shift,$id_machine,$dg){
		$kolom_dt = ' ';
	    $tabel_dt = 'log_book a';
	    $join_dt  = '	LEFT JOIN log_book_det_time b ON a.id = b.id_log_book
					LEFT JOIN mst_downtime c on b.code = c.id ';
	    $where_dt = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.' 
	    			AND c.downtimeGroup = "'.$dg.'" ';
	    $order_dt = '';
	    $cek_lb_dt= $this->select_count($tabel_dt,$join_dt,$where_dt,$kolom_dt,$order_dt);

	    return $cek_lb_dt->jml;
	}

	public function plan_down_t($tgl,$shift,$id_machine){
		$kolom_dt = ' ';
	    $tabel_dt = 'log_book a';
	    $join_dt  = '	LEFT JOIN log_book_det_time b ON a.id = b.id_log_book
					LEFT JOIN mst_downtime c on b.code = c.id ';
	    // $where_dt = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.' 
	    // 			AND c.downtimeGroup = "'.$dg.'" ';
	    $where_dt = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.' 
			    			AND (c.downtimeGroup = "RT" or c.downtimeGroup = "PDT" or c.downtimeGroup = "UDT" or c.downtimeGroup = "IT" or c.downtimeGroup = "UT") ';
	    $order_dt = '';
	    $cek_lb_dt= $this->select_count($tabel_dt,$join_dt,$where_dt,$kolom_dt,$order_dt);

	    return $cek_lb_dt->jml;
	}

	public function select_row($tabel,$join='',$where='',$kolom='',$order=''){
	    $q  = "SELECT ".$kolom." FROM ".$tabel." ".$join." ".$where." ".$order."";
	    // echo $q;exit();
	    $rs = $this->db->query($q)->row();

	    return $rs;
	}

	public function select_count($tabel,$join='',$where='',$kolom='',$order=''){
	    $q  = "SELECT count(*) as jml FROM ".$tabel." ".$join." ".$where." ".$order."";
	    // echo $q;exit();
	    $rs = $this->db->query($q)->row();

	    return $rs;
	}

	public function parse_bln_name($bln){
		if($bln=='01'){
			$val = 'jan';
		}elseif ($bln=='02') {
			$val = 'feb';
		}elseif ($bln=='03') {
			$val = 'mar';
		}elseif ($bln=='04') {
			$val = 'apr';
		}elseif ($bln=='05') {
			$val = 'may';
		}elseif ($bln=='06') {
			$val = 'jun';
		}elseif ($bln=='07') {
			$val = 'jul';
		}elseif ($bln=='08') {
			$val = 'aug';
		}elseif ($bln=='09') {
			$val = 'sep';
		}elseif ($bln=='10') {
			$val = 'oct';
		}elseif ($bln=='11') {
			$val = 'nov';
		}elseif ($bln=='12') {
			$val = 'dec';
		}

		return $val;
	}

	public function parse_target_oee($bulan){
		// echo $bulan;exit();
		$thn = substr($bulan, 3,4);
		$bln_name = $this->parse_bln_name(substr($bulan, 0,2)); 
		// echo $bln_name;exit();

		$kolom = 'ifnull(a.'.$bln_name.',0) as oee_target';
	    $tabel_db = 'mst_target_oee a';
	    $join  = '';
	    $where = 'where a.year = "'.$thn.'" ';
	    $order = '';
	    // echo 'SELECT '.$kolom.' from '.$tabel_db.' '.$join.' '.$where;exit();
	    $cek = $this->select_row($tabel_db,$join,$where,$kolom,$order);
	    return $cek->oee_target;
	}

	public function overall_oee($bulan,$id_machine){
		$bulan1 = substr($bulan,5,2).'-'.substr($bulan,0,4);
		$tot = 0;
		$j=0;
		for ($i=1; $i <= 31 ; $i++) { 
			$mot = 0;
			$tgl = $this->parse_tgl($i,$bulan1);
			// echo $tgl;
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(SUM(c.product_good*d.spq),0) as product_good,ifnull(SUM(c.product_reject),0) as product_reject,ifnull(a.speed,0) as speed';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id LEFT JOIN log_book_det_product c ON c.id_log_book = a.id
			    			LEFT JOIN mst_product d ON c.id_product=d.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    	// $rt = $this->hist_down($tgl,$shift,$id_machine,'RT');
			    	$rt = $this->plan_down_t($tgl,$shift,$id_machine);
				    $pdt = $this->hist_down($tgl,$shift,$id_machine,'PDT');
				    $udt = $this->hist_down($tgl,$shift,$id_machine,'UDT');
				    $it = $this->hist_down($tgl,$shift,$id_machine,'IT');
				    $data_i = ($rt-($pdt+$udt+$it))*5;
			    	// $av = (round(($data_i/($rt*5))*100,2));
			    	if($rt<=0){
				    	$av = 0;
				    }else{
				    	$av = (round(($data_i/($rt*5))*100,2)); /*bug fixing default by zero*/
				    }

			    	if($lb->speed > 0){
				    	$prf = (round(((($lb->product_good + $lb->product_reject)*100)/($data_i * $lb->speed)),2));
				    }else{
				    	$prf = 0;
				    }

			    	$tt = $lb->product_good+$lb->product_reject;
			    	if($tt <= 0){
			    		$qly = 0;
			    	}else{
			    		$qly = (round(($lb->product_good / $tt)*100,2));
			    	}


				    $dd = $av*$prf*$qly;
				    $mot = $dd/10000;

					$tot += $mot;
					if($mot>0){
						$j+=1;
					}
				}else{
					$tot += 0;
				}
				
			}
			
		}

		// echo $j.' vvv';;
		$target = (float)$this->parse_target_oee($bulan1);
		// echo $target;
		
		if ($j <= 0){

			$return=array('bln' => $bulan,'overall_oee'=>0,'target_oee'=>$target);
		}else{
			// $return=(round(($tot/$j),2));
			$return=array('bln' => $bulan,'overall_oee'=>(round(($tot/$j),2)), 'target_oee'=>$target);
		}
		return $return;
	}

	public function get_oee2($id_machine,$tahun){
		$q = "
			SELECT DISTINCT SUBSTR(date,1,7) as bulan FROM
			log_book
			WHERE SUBSTR(date,1,4)='".$tahun."'
		";
		// echo $q;exit();
		$cek_bln = $this->db->query($q)->result();
		$data= array();
		foreach ($cek_bln as $key) {
			
			// echo $bulan;
			// echo $key->bulan;
			$oee = $this->overall_oee($key->bulan,$id_machine);
			// echo $oee;
			// $data[]['bln']= $bulan;
			$data[]= $oee;
		}

		// print_r($data);

		// exit();
		return $data;



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

	public function overall_oee_month($tgl,$id_machine){
		$bulan1 = substr($tgl,5,2).'-'.substr($tgl,0,4);
		$tot = 0;
		$j=0;
		// for ($i=1; $i <= 31 ; $i++) { 
			$mot = 0;
			// $tgl = $this->parse_tgl($i,$bulan1);
			// echo $tgl;
			for ($shift=1; $shift <=3 ; $shift++) { 
				$kolom = 'a.id,a.date,a.shift,a.machine,b.machineName as name_machine,ifnull(SUM(c.product_good*d.spq),0) as product_good,ifnull(SUM(c.product_reject),0) as product_reject,ifnull(a.speed,0) as speed';
			    $tabel_db = 'log_book a';
			    $join  = 'left join mst_machine b on a.machine = b.id LEFT JOIN log_book_det_product c ON c.id_log_book = a.id
			    			LEFT JOIN mst_product d ON c.id_product=d.id';
			    $where = 'where a.date = "'.$tgl.'" and a.shift = '.$shift.' and a.machine = '.$id_machine.'';
			    $order = '';
			    $cek_lb= $this->select_count($tabel_db,$join,$where,$kolom,$order);
			    $lb = $this->select_row($tabel_db,$join,$where,$kolom,$order);
			    if($cek_lb->jml >= 1){
			    	// $rt = $this->hist_down($tgl,$shift,$id_machine,'RT');
			    	$rt = $this->plan_down_t($tgl,$shift,$id_machine);
				    $pdt = $this->hist_down($tgl,$shift,$id_machine,'PDT');
				    $udt = $this->hist_down($tgl,$shift,$id_machine,'UDT');
				    $it = $this->hist_down($tgl,$shift,$id_machine,'IT');
				    $data_i = ($rt-($pdt+$udt+$it))*5;

				    if($rt<=0){
				    	$av = 0;
				    }else{
				    	// $av = (round(($data_i/($rt*5))*100,2));
				    	$av = (round(($data_i/($rt*5))*100,2)); /*bug fixing default by zero*/
				    }

			    	// $av = (round(($data_i/($rt*5))*100,2));
			    	if($lb->speed > 0){
				    	$prf = (round(((($lb->product_good + $lb->product_reject)*100)/($data_i * $lb->speed)),2));
				    }else{
				    	$prf = 0;
				    }

			    	$tt = $lb->product_good+$lb->product_reject;
			    	if($tt <= 0){
			    		$qly = 0;
			    	}else{
			    		$qly = (round(($lb->product_good / $tt)*100,2));
			    	}


				    $dd = $av*$prf*$qly;
				    $mot = $dd/10000;

					$tot += $mot;
					if($mot>0){
						$j+=1;
					}
				}else{
					$tot += 0;
				}
				
			}
			
		// }

		// echo $j.' vvv '.$tgl.' '.$tot;exit();
		$target = (float)$this->parse_target_oee($bulan1);
		// echo $target;
		
		if ($j <= 0){

			$return=array('date' => $tgl,'overall_oee'=>0,'target_oee'=>$target);
		}else{
			// $return=(round(($tot/$j),2));
			// $return=array('date' => $tgl,'overall_oee'=>(round(($tot/$j),2)), 'target_oee'=>$target);
			$return=array('date' => $tgl,'overall_oee'=>(round(($tot/3),2)), 'target_oee'=>$target);
		}
		return $return;
	}

	public function get_oee_month2($id_machine,$month){
		// echo $month;exit();
		$q = "
			SELECT DISTINCT date as tgl FROM
			log_book
			WHERE SUBSTR(date,1,7)='".$month."'
		";
		// echo $q;exit();
		$cek_bln = $this->db->query($q)->result();
		$data= array();
		foreach ($cek_bln as $key) {
			
			// echo $bulan;
			// echo $key->bulan;
			$oee = $this->overall_oee_month($key->tgl,$id_machine);
			// echo $oee;
			// $data[]['bln']= $bulan;
			$data[]= $oee;
		}

		// print_r($data);

		// exit();
		return $data;



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

}