<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardEhs extends CI_Controller {

	public function __construct(){
		parent::__construct();   
		date_default_timezone_set('Asia/Jakarta');
			$this->load->model('DashboardModelEhs');
			$this->load->model('MenuModel');
				$this->load->library('session');
				if ($this->session->userdata('id_users')) {
			$session_data       = $this->session->userdata('id_users');
		}else{
			redirect(base_url().'Login', 'refresh');
		}
	}

	function ribuan($angka){
		$hasil = number_format($angka,0,',','.');
		return $hasil;
	}

	function ribuan2($angka){
		$hasil = number_format($angka,2,',','.');
		return $hasil;
	}

	public function getWeekStartEnd($year){
		$week		= date("W", strtotime($year));
		$weekDate = new DateTime();
		$weekDate->setISODate($year, $week);
		$weekStart = $weekDate->format('Y-m-d');
		$weekDate->modify('+6 days');
		$weekEnd = $weekDate->format('Y-m-d');

		$week = array(
			'weekStart' 	=> $weekStart,
			'weekEnd' 		=> $weekEnd
		);
		return $week;
	}


	public function Index(){
		date_default_timezone_set('Asia/Jakarta');
		$bulan = date("Y-m");
		$tahun = date("y");
		$year = date("Y");
		$monthText = date("M", strtotime($bulan));
		$monthText = strtolower($monthText);
		
		$machineLists	= $this->DashboardModelEhs->machineLists();

		// YEARLY --ir
		$target = 0; $p_good	= 0; $p_reject	= 0; $tt_prd 	= 0; $run_hour = 0;
		for ($i=1; $i <= date('m'); $i++) { 
			// DYNAMICALLY CHANGE PERIODE --ir
			if($i < 10) $i = "0".$i;
			$monthText 	= date("M", strtotime($year."-".$i));
			$bulan			= date($year."-".$i);

			// GET ACCUMULATE TARGET FROM FIRST MONTH TO CURRENT MONTH --ir
			$getTarget			= $this->DashboardModelEhs->getTarget($monthText,$year);
			$target 				+= $getTarget->target;

			// GET ACCUMULATE TOTAL GOOD PRODUCTION FROM FIRST MONTH TO CURRENT MONTH --ir
			$tt_prod_good 	= $this->DashboardModelEhs->product_good($bulan);
			$p_good					+= $tt_prod_good->t_prod;

			// GET ACCUMULATE TOTAL NG PRODUCTION FROM FIRST MONTH TO CURRENT MONTH --ir
			$tt_prod_reject = $this->DashboardModelEhs->product_reject($bulan);
			$p_reject				+= $tt_prod_reject->t_prod;
			$tt_prd					+= $p_good + $p_reject;

			// GET ACCUMULATE TOTAL RUNNING HOUR FROM FIRST MONTH TO CURRENT MONTH --ir
			$rh							= $this->DashboardModelEhs->run_hour($bulan);
			$run_hour				+= $rh->jml_hour;
		}

		if($tt_prd < $target) $note = "Total production did not reched the target!";
		else if($tt_prd >= $target) $note = "Total production reched the target!";

		//If Zero total production then just declare zero --ir\
		if($tt_prd == 0){
			$percentageFGood		= 0;
			$percentageFGoodNG	= 0;
			$percentageTarget		= 0;
		}else{
			$percentageFGood		= ($p_good / $tt_prd) * 100;
			$percentageFGoodNG	= ($p_reject / $tt_prd) * 100;
			$percentageTarget		= ($tt_prd / $target) * 100;
		}

		$data = array(
			'note' 									=> $note,
			'target' 								=> $this->ribuan($target),
			'p_good' 								=> $this->ribuan($p_good),
			'p_reject' 							=> $this->ribuan($p_reject),
			'tt_prd' 								=> $this->ribuan($tt_prd),
			'bar_target' 						=> $target,
			'bar_p_good' 						=> $p_good,
			'bar_p_reject' 					=> $p_reject,
			'bar_tt_prd' 						=> $tt_prd,
			'percentageFGood' 			=> round($percentageFGood,2),
			'percentageFGoodNG'			=> round($percentageFGoodNG,2),
			'percentageTarget'			=> round($percentageTarget,2),
			'run_hour' 							=> $this->ribuan2($run_hour),
			'machine' 							=> $machineLists,
			'tahun'									=> $tahun
		 );
		$this->load->view('DashboardEhs/templates/Header');
		$this->template->load('templateDashboard','DashboardEhs',$data);
		$this->load->view('DashboardEhs/templates/Footer');
		$this->load->view('DashboardEhs/_cjs');
		$this->load->view('DashboardEhs/_mjs');
		$this->load->view('DashboardEhs/_data_js');
	}

	public function getTotProdCard(){
		// $act = $this->input->post('act');
		$periode = $this->input->post('periode');
		$checkBy = $this->input->post('checkBy');
		
		$bulan 	= date("Y-m");
		$tahun 	= date("y");
		$year 	= date("Y");
		$week		= $this->getWeekStartEnd($year);
		$monthText 	= date("M", strtotime($bulan));
		$monthText 	= strtolower($monthText);

		$target = 0; $p_good	= 0; $p_reject	= 0; $tt_prd 	= 0; $run_hour = 0;
		if($checkBy == "periode" && $periode == "year"){
			// YEARLY --ir
			for ($i=1; $i <= date('m'); $i++) { 
				// DYNAMICALLY CHANGE PERIODE --ir
				if($i < 10) $i = "0".$i;
				$monthText 	= date("M", strtotime($year."-".$i));
				$bulan			= date($year."-".$i);

				// GET ACCUMULATE TARGET FROM FIRST MONTH TO CURRENT MONTH --ir
				$getTarget			= $this->DashboardModelEhs->getTarget($monthText,$year);
				$target 				+= $getTarget->target;

				// GET ACCUMULATE TOTAL GOOD PRODUCTION FROM FIRST MONTH TO CURRENT MONTH --ir
				$tt_prod_good 	= $this->DashboardModelEhs->product_good($bulan);
				$p_good					+= $tt_prod_good->t_prod;

				// GET ACCUMULATE TOTAL NG PRODUCTION FROM FIRST MONTH TO CURRENT MONTH --ir
				$tt_prod_reject = $this->DashboardModelEhs->product_reject($bulan);
				$p_reject				+= $tt_prod_reject->t_prod;
				$tt_prd					+= $p_good + $p_reject;

				// GET ACCUMULATE TOTAL RUNNING HOUR FROM FIRST MONTH TO CURRENT MONTH --ir
				$rh							= $this->DashboardModelEhs->run_hour($bulan);
				$run_hour				+= $rh->jml_hour;
			}
		}else if($checkBy == "periode" && $periode == "month"){
			$getTarget			 		= $this->DashboardModelEhs->getTarget($monthText,$year);
			$target 						= $getTarget->target;
			$tt_prod_good 			= $this->DashboardModelEhs->product_good($bulan);
			$p_good							= $tt_prod_good->t_prod;
			$tt_prod_reject 		= $this->DashboardModelEhs->product_reject($bulan);
			$p_reject						= $tt_prod_reject->t_prod;
			$tt_prd							= $p_good + $p_reject;
			$rh	 								= $this->DashboardModelEhs->run_hour($bulan);
			$run_hour						= $rh->jml_hour;
		}else if($checkBy == "periode" && $periode == "week"){
			$getTarget			 		= $this->DashboardModelEhs->getTarget($monthText,$year);
			$target 						= $getTarget->target / 4;

			$tt_prod_good 			= $this->DashboardModelEhs->product_good_range($week['weekStart'],$week['weekEnd']);
			$p_good							= $tt_prod_good->t_prod;
			$tt_prod_reject 		= $this->DashboardModelEhs->product_reject_range($week['weekStart'],$week['weekEnd']);
			$p_reject						= $tt_prod_reject->t_prod;
			$tt_prd							= $p_good + $p_reject;
			$rh	 								= $this->DashboardModelEhs->run_hour_range($week['weekStart'],$week['weekEnd']);
			$run_hour						= $rh->jml_hour;
		}else if($checkBy == "date"){
			$getTarget			 		= $this->DashboardModelEhs->getTarget($monthText,$year);
			$target 						= $getTarget->target / 4;
			$periode						=	explode(".", $periode);

			$tt_prod_good 			= $this->DashboardModelEhs->product_good_range($periode[0],$periode[1]);
			$p_good							= $tt_prod_good->t_prod;
			$tt_prod_reject 		= $this->DashboardModelEhs->product_reject_range($periode[0],$periode[1]);
			$p_reject						= $tt_prod_reject->t_prod;
			$tt_prd							= $p_good + $p_reject;
			$rh	 								= $this->DashboardModelEhs->run_hour_range($periode[0],$periode[1]);
			$run_hour						= $rh->jml_hour;
		}

		if($tt_prd < $target) $note = "Total production did not reched the target!";
		else if($tt_prd >= $target) $note = "Total production reched the target!";

		//If Zero total production then just declare zero --ir\
		if($tt_prd == 0){
			$percentageFGood		= 0;
			$percentageFGoodNG	= 0;
			$percentageTarget		= 0;
		}else{
			$percentageFGood		= ($p_good / $tt_prd) * 100;
			$percentageFGoodNG	= ($p_reject / $tt_prd) * 100;
			$percentageTarget		= ($tt_prd / $target) * 100;
		}

		$data = array(
			'note' 									=> $note,
			'target' 								=> $this->ribuan($target),
			'p_good' 								=> $this->ribuan($p_good),
			'p_reject' 							=> $this->ribuan($p_reject),
			'tt_prd' 								=> $this->ribuan($tt_prd),
			'percentageFGood' 			=> round($percentageFGood,2),
			'percentageFGoodNG'			=> round($percentageFGoodNG,2),
			'percentageTarget'			=> round($percentageTarget,2),
			'run_hour' 							=> $this->ribuan2($run_hour),
			'tahun'									=> $tahun
		 );

		echo json_encode($data);
	}

	public function getMaValue(){
		$machine	= $_POST['machine'];
		$periode	= $_POST['periode'];
		$chart		= $_POST['chart'];
		$checkOn	= $_POST['checkBy'];

		$month 	= date("Y-m");
		$year 	= date("Y");
		$week		= $this->getWeekStartEnd($year);

		// GET START DATE AND END DATE BASED ON PERIODE (MONTHLY AND WEEKLY BY DATE AND YEARLY BY MONTH) --ir
		$endDate		= 0;
		$startDate 	= 1;
		if($checkOn == "periode" && $periode == "month") {
			$endDate		= cal_days_in_month(CAL_GREGORIAN,date('m'),date('y'));
		}else if($checkOn == "periode" && $periode == "week") {
			$startDate 	= date('d' ,strtotime($week['weekStart']))+0;
			$endDate	 	= date('d', strtotime($week['weekEnd']))+0;
		}else if($checkOn == "periode" && $periode == "year") {
			$startDate	= 1;
			$endDate		= date('m');
		}else if($checkOn == "date") {
			$periode		=	explode(".", $periode);
			$startDate	= new DateTime($periode[0]);
			$endDate		= new DateTime($periode[1]);
		}

		// GET MACHINE AVAILABILITY--ir
		$pot = 0; $pdt = 0; $udt = 0; $it = 0; $ut = 0; $dt = 0;
		if ($checkOn == "periode") {
			for ($i=$startDate; $i <= $endDate; $i++) {
				// IF MONTHLY OR WEEKLY GENERATE DATE, IF YEARLY GENERATE MONTH --ir
				if($periode == "month" || $periode == "week"){
					// PARSE DATE --ir
					if ($i < 10) $date = $month.'-0'.$i;
					else $date 	= $month."-".$i;
					$date 			= date("Y-m-d", strtotime($date));
					$checkBy		= "date";
				}else if ($periode == "year"){
					if($i < 10) $i = "0".$i;
					$date 			= $i;
					$checkBy		= "month";
				}
	
				for ($shift=1; $shift <= 3 ; $shift++) { 
					$check 	= $this->DashboardModelEhs->checkLogbook($shift,$date,$checkBy);
					if ($check->count > 0) {
						$countPot = $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'RT',$machine);
						$countPdt = $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'PDT',$machine);
						$countUdt = $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'UDT',$machine);
						$countIt 	= $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'IT',$machine);
						$countUt 	= $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'UT',$machine);
						$pot 			+=  $countPot->total;
						$pdt 			+=  $countPdt->total;
						$udt 			+=  $countUdt->total;
						$it  			+=  $countIt->total;
						$ut  			+=  $countUt->total;
					}else continue;
				}
			}
		}else{
			// if ($startDate == $endDate) $endDate = $endDate;
			// else $endDate = $endDate->modify("+1 days");
			$endDate = $endDate->modify("+1 days");
			$daterange = new DatePeriod($startDate, new DateInterval('P1D'), $endDate);
			// echo var_dump($endDate);
			foreach($daterange as $date){
				$date 		= $date->format("Y-m-d");
				$checkBy 	= "date"; 
				for ($shift=1; $shift <= 3 ; $shift++) { 
					$check 	= $this->DashboardModelEhs->checkLogbook($shift,$date,$checkBy);
					if ($check->count > 0) {
						$countPot = $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'RT',$machine);
						$countPdt = $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'PDT',$machine);
						$countUdt = $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'UDT',$machine);
						$countIt 	= $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'IT',$machine);
						$countUt 	= $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'UT',$machine);
						$pot 			+=  $countPot->total;
						$pdt 			+=  $countPdt->total;
						$udt 			+=  $countUdt->total;
						$it  			+=  $countIt->total;
						$ut  			+=  $countUt->total;
					}else continue;
				}
			}
		}

		if ($chart == "atPie") {
			$total			= $pot+$pdt+$udt+$it+$ut;
			$pot				= $pot-($pdt+$udt+$it);
			if ($pot == 0) 		$pot = 0;
			else $pot 			= round(($pot/$total) * 100, 2);
			if ($pdt == 0) 	 	$pdt = 0;
			else $pdt 			= round(($pdt/$total) * 100, 2);
			if ($udt == 0) 		$udt = 0;
			else $udt 			= round(($udt/$total) * 100, 2);
			if ($it == 0) 		$it = 0;
			else $it 				= round(($it/$total) * 100, 2);
			if ($ut == 0) 		$ut = 0;
			else $ut			 	= round(($ut/$total) * 100, 2);

			$return = array('respone' => 'sukses', 'pot' => $pot, 'pdt' => $pdt, 'udt' => $udt, 'it' => $it, 'ut' => $ut);
			echo json_encode($return);
		}else{
			$totalPot 	= $pot;
			$totalDt 		= $pdt+$udt+$it+$ut;
			$totalMot		= $totalPot - $totalDt;
			// DVISION BY ZERO --ir
			if ($totalMot <= 0) {
				$availMachine = 100;
			}else{
				$availMachine	= round(($totalMot/$totalPot)*100,2);
			}
			echo json_encode($availMachine);
		}
	}
	public function getMaValue2(){
		$machine	= $_POST['machine'];
		$periode	= $_POST['periode'];
		$chart		= $_POST['chart'];
		$checkOn	= $_POST['checkBy'];

		$month 	= date("Y-m");
		$year 	= date("Y");
		$week		= $this->getWeekStartEnd($year);

		// GET START DATE AND END DATE BASED ON PERIODE (MONTHLY AND WEEKLY BY DATE AND YEARLY BY MONTH) --ir
		$endDate		= 0;
		$startDate 	= 1;
		if($checkOn == "periode" && $periode == "month") {
			$endDate		= cal_days_in_month(CAL_GREGORIAN,date('m'),date('y'));
		}else if($checkOn == "periode" && $periode == "week") {
			$startDate 	= date('d' ,strtotime($week['weekStart']))+0;
			$endDate	 	= date('d', strtotime($week['weekEnd']))+0;
		}else if($checkOn == "periode" && $periode == "year") {
			$startDate	= 1;
			$endDate		= date('m');
		}else if($checkOn == "date") {
			$periode		=	explode(".", $periode);
			$startDate	= new DateTime($periode[0]);
			$endDate		= new DateTime($periode[1]);
		}

		// GET MACHINE AVAILABILITY--ir
		$pot = 0; $pdt = 0; $udt = 0; $it = 0; $ut = 0; $dt = 0;
		if ($checkOn == "periode") {
			for ($i=$startDate; $i <= $endDate; $i++) {
				// IF MONTHLY OR WEEKLY GENERATE DATE, IF YEARLY GENERATE MONTH --ir
				if($periode == "month" || $periode == "week"){
					// PARSE DATE --ir
					if ($i < 10) $date = $month.'-0'.$i;
					else $date 	= $month."-".$i;
					$date 			= date("Y-m-d", strtotime($date));
					$checkBy		= "date";
				}else if ($periode == "year"){
					if($i < 10) $i = "0".$i;
					$date 			= $i;
					$checkBy		= "month";
				}
	
				for ($shift=1; $shift <= 3 ; $shift++) { 
					$check 	= $this->DashboardModelEhs->checkLogbook($shift,$date,$checkBy);
					if ($check->count > 0) {
						$countPot = $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'RT',$machine);
						$countPdt = $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'PDT',$machine);
						$countUdt = $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'UDT',$machine);
						$countIt 	= $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'IT',$machine);
						$countUt 	= $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'UT',$machine);
						$pot 			+=  $countPot->total;
						$pdt 			+=  $countPdt->total;
						$udt 			+=  $countUdt->total;
						$it  			+=  $countIt->total;
						$ut  			+=  $countUt->total;
					}else continue;
				}
			}
		}else{
			// if ($startDate == $endDate) $endDate = $endDate;
			// else $endDate = $endDate->modify("+1 days");
			$endDate = $endDate->modify("+1 days");
			$daterange = new DatePeriod($startDate, new DateInterval('P1D'), $endDate);
			// echo var_dump($endDate);
			foreach($daterange as $date){
				$date 		= $date->format("Y-m-d");
				$checkBy 	= "date"; 
				for ($shift=1; $shift <= 3 ; $shift++) { 
					$check 	= $this->DashboardModelEhs->checkLogbook($shift,$date,$checkBy);
					if ($check->count > 0) {
						$countPot = $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'RT',$machine);
						$countPdt = $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'PDT',$machine);
						$countUdt = $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'UDT',$machine);
						$countIt 	= $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'IT',$machine);
						$countUt 	= $this->DashboardModelEhs->countDowntime($checkBy,$shift,$date,'UT',$machine);
						$pot 			+=  $countPot->total;
						$pdt 			+=  $countPdt->total;
						$udt 			+=  $countUdt->total;
						$it  			+=  $countIt->total;
						$ut  			+=  $countUt->total;
					}else continue;
				}
			}
		}

		if ($chart == "contractor") {
			$total			= $pot+$pdt+$udt+$it+$ut;
			$pot				= $pot-($pdt+$udt+$it);
			if ($pot == 0) 		$pot = 0;
			else $pot 			= round(($pot/$total) * 100, 2);
			if ($pdt == 0) 	 	$pdt = 0;
			else $pdt 			= round(($pdt/$total) * 100, 2);
			if ($udt == 0) 		$udt = 0;
			else $udt 			= round(($udt/$total) * 100, 2);
			if ($it == 0) 		$it = 0;
			else $it 				= round(($it/$total) * 100, 2);
			if ($ut == 0) 		$ut = 0;
			else $ut			 	= round(($ut/$total) * 100, 2);

			$return = array('respone' => 'sukses', 'pot' => $pot, 'pdt' => $pdt, 'udt' => $udt, 'it' => $it, 'ut' => $ut);
			echo json_encode($return);
		}else{
			$totalPot 	= $pot;
			$totalDt 		= $pdt+$udt+$it+$ut;
			$totalMot		= $totalPot - $totalDt;
			// DVISION BY ZERO --ir
			if ($totalMot <= 0) {
				$availMachine = 100;
			}else{
				$availMachine	= round(($totalMot/$totalPot)*100,2);
			}
			echo json_encode($availMachine);
		}
	}

	public function g_oee(){
	    $id_machine = $this->input->post('id_machine');
	    $periode = $this->input->post('periode');
	    $tahun = date("Y");
	    $month = date("Y-m");

	    // echo $month;exit();
	    if($periode == 'year'){
	    	$get   = $this->DashboardModelEhs->get_oee($id_machine,$tahun);
	    }else{
	    	$get   = $this->DashboardModelEhs->get_oee_month($id_machine,$month);
	    }
	    
	    
	    $respone = "sukses";
		
		$return = array('respone' => $respone,'oee' => $get, 'month' => $month, 'tahun' => $tahun);
		echo json_encode($return);
	}

	public function pm_cal(){
	    $periode 	= $this->input->post('periode');
			$type 		= $this->input->post('type');
			$checkBy	= $this->input->post('checkBy');
	    $tahun 		= date("Y");

	    $total = 0;
	    $act = 0;
	    $target = 0;
	    $get_cal   	= $this->DashboardModelEhs->get_cal($type,$tahun,$periode,$checkBy);
	    if($get_cal){
	    	// $total=$get_cal->target+$get_cal->actual;
				if($get_cal->target == 0 || $get_cal->actual == 0) $act = 0;
				else $act = ($get_cal->actual/$get_cal->target) * 100;
	    	if($act > 100){
	    		$act = 100;
	    	}
	    	$target = 100-$act;

	    }
	    $respone = "sukses";
		
		$return = array('respone' => $respone, 'act' => $act, 'tgt' => $target);
		echo json_encode($return);
	}

	public function capa(){
			$periode 	= $this->input->post('periode');
			$type 		= $this->input->post('type');
			$checkBy	= $this->input->post('checkBy');
			
	    $tahun 		= date("Y");

	    $total = 0;
	    $low = 0;
	    $medium = 0;
	    $moderate = 0;
	    $high = 0;
	    $veryhigh = 0;
	    $get_capa   = $this->DashboardModelEhs->get_capa($type,$tahun,$periode, $checkBy);
	    if($get_capa){
	    	$total 		= $get_capa->total;
	    	$low		= $get_capa->low;
	    	$medium	= $get_capa->medium;
	    	$moderate		= $get_capa->moderate;
	    	$high		= $get_capa->high;
	    	$veryhigh		= $get_capa->veryhigh;
	    }
	    $respone = "sukses";
		
		$return = array('respone' => $respone, 'total' => $total, 'low' => $low, 'medium' => $medium, 'moderate' => $moderate, 'high' => $high, 'veryhigh' => $veryhigh);
		echo json_encode($return);
	}

	public function consumption(){
			$periode 	= $this->input->post('periode');
			$type 		= $this->input->post('type');
			$checkBy	= $this->input->post('checkBy');
			
	    $tahun 		= date("Y");

	    $target = 0;
	    $actual = 0;
	    $get_cons   = $this->DashboardModelEhs->get_cons($type,$tahun,$periode, $checkBy);
	    if($get_cons){
	    	$target 	=$get_cons->target;
	    	$actual		=$get_cons->actual;
	    }
	    $respone = "sukses";
		
		$return = array('respone' => $respone, 'trg' => $target, 'act' => $actual);
		echo json_encode($return);
	}

	public function chart_budget(){
	    $tahun 	    = $this->input->post('tahun');
	    $compare 	= $this->input->post('compare');
	    $type 	= $this->input->post('type');
	    // $tahun 		= date("Y");

	    $total = 0;
	    $act = 0;
	    $target = 0;
	    $get  = $this->DashboardModelEhs->get_budget($tahun,$compare,$type);
	    if($get){
	    	// $total=$get_cal->target+$get_cal->actual;
			if($get->fyb == 0 || $get->tt_actual == 0) 
				$act = 0;
			else 
				$act = ($get->tt_actual/$get->fyb) * 100;
	    	if($act > 100){
	    		$act = 100;
	    	}
	    	$target = 100-$act;

	    }
	    $respone = "sukses";
		
		$return = array('respone' => $respone, 'act' => $act, 'tgt' => $target);
		echo json_encode($return);
	}
	
}
