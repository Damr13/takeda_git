<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class SurveyListsModel extends CI_Model{
  function __construct() {
    parent::__construct();
    $this->exclusion = array('dan', 'karena', 'ini', 'ke', 'yang', 'yg', 'saya', 'aku', 'lebih',
    'sampai', 'aja', 'ber', 'lg', 'dari', 'sampai', 'amp', 'jgn', 'utk', 'dlm', 'dn', 'e', 'tp', 'ad', 'hrs',
    'klo', 'hal</font></font>', 'ber', 'lg', 'dari', 'sampai', 'amp', 'jgn', 'utk', 'dlm', 'dn', 'e', 'tp', 'ad', 'hrs',
    'apa', 'nya', 'untuk', 'apa', 'menurut', 'dah', 'di', 'lain', 'iya', 'ya', 'font', 'align', 
    'style', 'vertical', 'inherit', '/font', 'font', 'div', 'ny', 'akan', '/div', 'dgn', 'dll', 'ada', 'fi',
    'atau', 'bs', 'd', 'digunakan', 'sisi', 'orang', 'wi', 'a', 'dg', 'sekarang', 'terus', 'masa', 'cuman', 'saja',
    'sesuai', 'of', 'semua', 'menjadikan', 'namun', 'jd', 'krn', 'lbh', 'nbsp', 'dengan', 'semakin', 'bisa', 'lagi', 'semoga', 'sangat', 'harus',
    'dr', 'font', 'style="vertical', 'inherit;"><font');
    $this->pattern = '~[-\s:;<>\"=.,()&/]~';
    $this->negativeWord = array(
      'kurang bersih', 'tidak bersih', 'belum bersih',
      'kurang nyaman', 'tidak nyaman', 'belum nyaman',
      'kurang bagus' , 'tidak bagus' , 'belum bagus ',
      'kurang aman'  , 'tidak aman'  , 'belum aman  ',
      'kurang baik'  , 'tidak baik'  , 'belum baik  ',
    );
    $this->positiveWord = array(
      'cukup bersih', 'sangat bersih', 'sudah bersih',
      'cukup nyaman', 'sangat nyaman', 'sudah nyaman',
      'cukup bagus' , 'sangat bagus' , 'sudah bagus ',
      'cukup aman'  , 'sangat aman'  , 'sudah aman  ',
      'cukup baik'  , 'sangat baik'  , 'sudah baik  ',
    );
  }

  // GET DATA FOR GAUGES CHART --ir
    public function getDataChartGG1($basedQ, $id, $idQ, $idChart, $custom){
      if(!$basedQ){
        $listAns = $this->GeneralMdl->dbResultArray('do_answers', 'title, id', 'question = "'.$idQ.'"', '');
        $rs = 0;
        foreach ($listAns as $key => $value) {
          $basedQ = $value['id'];
          $q = "SELECT count(answer) as count
            FROM do_responses
            WHERE answer = '$basedQ'";
          $rs += $this->db->query($q)->row('count');
        }
      }else{
        $q = "SELECT count(answer) as count
          FROM do_responses
          WHERE answer = '$basedQ'";
        $rs = $this->db->query($q)->row('count');
      }
      return intval($rs);
    }
  // END -- GET DATA FOR GAUGES CHART --ir

  // GET TAG CLOUD (38) --ir
    public function getDataChartTAG1($basedQ, $id, $idQ, $idChart, $custom){
      $tagCloud = array();
    
      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);
    
      $q = "SELECT MAX(response) as tag
      FROM do_responses
      WHERE question = '$idQ'
      $whereIdResp
      GROUP BY response
      ORDER BY COUNT(response) desc";
      $textArr = $this->db->query($q)->result_array();
      
      if($custom != "custom") $table = 'do_surveys'; else $table = 'do_charts';
      if($custom != "custom") $where = 'id = "'.$id.'"'; else $where = 'survey = "'.$id.'" AND id = "'.$idChart.'"';
      $getOpt = $this->GeneralMdl->dbRow($table, 'listAns, minResp', $where, '');
      $exclusion = explode(",", strtolower($getOpt->listAns));
      $minTags   = $getOpt->minResp;
      // var_dump($minTags." -- ".$exclusion." -- ".$table." -- ".$where);
    
      $tagsLib  = array();
      $tags     = array();
      foreach ($textArr as $key => $value) {
        foreach ($value as $key => $text) {
          $pattern = $this->pattern;
          $textBreak = preg_split($pattern, $text);
          $tagsVal = array();
          foreach ($textBreak as $key => $value) {
            $value = ucwords(strtolower($value));
            if($value=="" || in_array(strtolower($value), $exclusion)) continue;
            if(array_key_exists($value, $tagsLib)) $count = $tags[$value]['count'] + 1;
            else $count = 1;
            $tagsVal['tag']   = $value;
            $tagsVal['count'] = $count;
            $tags[$value]     = $tagsVal;
            $tagsLib[$value]  = $value;
          }
        }
      }
    
      $tags = array_values($tags);
      $countTags = 0;
      foreach ($tags as $key => $value) {
        foreach ($value as $subKey => $subValue) {
          if($subKey == "count" && $subValue < $minTags) unset($tags[$countTags]);
        }
        $countTags++;
      }
      $tags = array_values($tags);
      return $tags;
    }
  // END -- GET TAG CLOUD (38) --ir

  // GET SEMI CIRCLE PIE --ir
    public function getDataChartPIE1($basedQ, $id, $idQ, $idChart, $custom){
      // SET BY SELECTED BASED Q MAIN --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      if($custom != "custom") $table = 'do_surveys'; else $table = 'do_charts';
      if($custom != "custom") $where = 'id = "'.$id.'"'; else $where = 'survey = "'.$id.'" AND id = "'.$idChart.'"';
      $getOpt = $this->GeneralMdl->dbRow($table, 'listAns, minResp', $where, '');
      $exclusion = explode(",", strtolower($getOpt->listAns));
      $listAns   = "'" . implode("', '", $exclusion) ."'";
    
      $q = "SELECT a.title as name, 
        (SELECT COUNT(response) as count FROM do_responses b WHERE a.id = b.answer AND question = '$idQ' $whereIdResp) as value
        FROM do_answers a
        WHERE question = '$idQ'
        AND title IN ($listAns)";
      $rs = $this->db->query($q)->result_array();
      return $rs;
    }
  // END -- GET SEMI CIRCLE PIE --ir

  // GET RADIUS PIE --ir
    public function getDataChartPIE2($basedQ, $id, $idQ, $idChart, $custom){
      // SET BY SELECTED BASED Q MAIN --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      if($custom != "custom") $table = 'do_surveys'; else $table = 'do_charts';
      if($custom != "custom") $where = 'id = "'.$id.'"'; else $where = 'survey = "'.$id.'" AND id = "'.$idChart.'"';
      $getOpt = $this->GeneralMdl->dbRow($table, 'listAns, minResp', $where, '');
      $exclusion = explode(",", strtolower($getOpt->listAns));
      $listAns   = "'" . implode("', '", $exclusion) ."'";
    
      $q = "SELECT a.title as country, 
        (SELECT COUNT(response) as count FROM do_responses b WHERE a.id = b.answer AND question = '$idQ' $whereIdResp) as value
        FROM do_answers a
        WHERE question = '$idQ'
        AND title IN ($listAns)";
      $rs = $this->db->query($q)->result_array();
      return $rs;
    }
  // END -- GET RADIUS PIE --ir

  
  // GET WHOLE PIE --ir
    public function getDataChartPIE3($basedQ, $id, $idQ, $idChart, $custom){
      if($custom != "custom") $table = 'do_surveys'; else $table = 'do_charts';
      if($custom != "custom") $where = 'id = "'.$id.'"'; else $where = 'survey = "'.$id.'" AND id = "'.$idChart.'"';
      $getOpt = $this->GeneralMdl->dbRow($table, 'listAns, minResp', $where, '');
      $exclusion = explode(",", strtolower($getOpt->listAns));
      $listAns   = "'" . implode("', '", $exclusion) ."'";

      $freq   = array();
      $series = array();
      $q = "SELECT id as idAns, title 
        FROM do_answers
        WHERE question = '$idQ'
        AND title IN ($listAns)";
      $listAns = $this->db->query($q)->result_array();

      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      foreach ($listAns as $key => $idAns) {
        $series['category'] = $idAns['title'];
        $answer = $idAns['idAns'];
        $q      = "SELECT COUNT(response) AS count FROM do_responses WHERE answer = '$answer' $whereIdResp LIMIT 1";
        $count  = $this->db->query($q)->row('count');
        $series['value'] = $count;
        $freq[] = $series;
      }
      return $freq;
    }
  // END -- GET RADIUS PIE --ir
  

  // GET SIMPLE COLUMN --ir
    public function getDataChartCOL2($basedQ, $id, $idQ, $idChart, $custom){
      $satisfaction = array();
      if($id == "27"){
        $satisfaction['34']  = 'Prioritas';
        $satisfaction['35']  = 'Pelayanan Terminal';
        $satisfaction['36']  = 'Pelayanan PO Bus';
        $satisfaction['37']  = 'Tingkat Kepuasan';  
      } 

      $resp = $this->getResponden($basedQ, $id);

      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      $series = array();
      $a = 0;
      foreach ($satisfaction as $idQ => $nameCategory) {
        $valSeries = array();
        $valSeries['category'] = $nameCategory;
        $q = "SELECT id as idAns 
        FROM do_answers
        WHERE question = '$idQ'";
        $listAns = $this->db->query($q)->result_array();
        $noVal = 1;
        $rating = COUNT($listAns);
        $q = "SELECT COUNT(response) AS count, 
                SUM(CASE response
                 WHEN 'Sangat Tidak Setuju' THEN 1
                 WHEN 'Tidak Setuju' THEN 2
                 WHEN 'Ragu-ragu' THEN 3
                 WHEN 'Setuju' THEN 4
                 WHEN 'Sangat Setuju' THEN 5
                 ELSE NULL
                END) as sum 
              FROM do_responses WHERE question = '$idQ' and response != '' $whereIdResp LIMIT 1";
        $x = $this->db->query($q)->row();
        $count  = $x->count;
        $min    = $count*(($rating-$rating)+1);
        $max    = $count*$rating;
        $sum    = $x->sum;
        $skor   = (($sum-$min)/($max-$min))*100;
        $valSeries['avg'] = round($skor,2);

        $series[$a] = $valSeries;
        $a++;
      }
      return $series;
    }
  // END -- GET SIMPLE COLUMN --ir
  
  
  public function listTerminal($id){
    // MASYARAKAT DAN PENUMPANG
    if($id == "27") $idQ = 31;
    // INTERNAL ORGANISASI
    else if($id == "28") $idQ = 70;
    // MITRA PO BUS 
    else $idQ = 106;

    $q = "SELECT title, id
			FROM do_answers
			WHERE question = '$idQ'";
    $rs = $this->db->query($q)->result_array();
		return $rs;
  }

  public function fixArr($array){
    $arr = array();
    foreach ($array as $key => $value) {
      foreach ($value as $subkey => $subvalue) {
        $arr[] = $subvalue;
      }
    }
    return $arr;
  }

  // GET ID RESP BY ANSWERS ID --ir
  public function getIdResp($key){
    $q = "SELECT idResponse FROM do_responses WHERE answer = '$key'";
    // var_dump($q);
    $rs = $this->db->query($q)->result();
    if(!$rs)  $whereIdResp = "";
    else{
      $rs = $this->fixArr($rs);
      $idResps = implode (", ", $rs);
      $whereIdResp = "AND idResponse IN ($idResps)";
    }
    return $whereIdResp;
  }

  // SURVEY INTERNAL ORGANISASI
    // GET VALUATION AVERAGE SCORE ON EACH OF TRANSPORTATIONS MODE --ir
    public function getFiveValue2($basedQ, $id){
      $valueResp = array('1'=>'Sangat Tidak Setuju', '2'=>'Tidak Setuju', '3'=>'Ragu-ragu', '4'=>'Setuju', '5'=>'Sangat Setuju');
      $pages = array();
      if($id == "28"){
        $instansi = array('390'=>'Ditjen Hubdat','391'=>'BPTD','392'=>'TPAJ Tipe A');
        // 32 34 35 40 41
        $pages['Orientasi Pelayanan']  = array('82', '294', '80', '296');
        $pages['Inovasi']              = array('90', '92', '94', '307');
        $pages['Proposisi Nilai']      = array('96', '97');
        $pages['Kompetisi']            = array('299', '300');
        $pages['Data']                 = array('83', '84');
      }
      
      // SET BY SELECTED TERMINAL --ir
      $whereIdRespTerm = '';
      if($basedQ) $whereIdRespTerm = $this->getIdResp($basedQ);
      
      $chart = array();
      foreach ($pages as $key => $listQ) {
        $series['category'] = $key; 
        foreach ($instansi as $key => $value) {
          // SET BY SELECTED INSTANSI --ir
          $keyIns = $key;
          $whereIdResp = '';
          $whereIdResp = $this->getIdResp($key);
          $divide = count($listQ);
          $calcArrQ = 0;
          foreach ($listQ as $key => $value) {
            
            $q   = "SELECT response FROM do_responses WHERE question = '$value' $whereIdResp $whereIdRespTerm";
            // var_dump($q);
            $rs = $this->db->query($q)->result();
            $valueArr = $this->fixArr($rs);
            // var_dump($rs);
            $ValueArrConv = array();
            foreach ($valueArr as $key => $value) {
              foreach ($valueResp as $subkey => $subvalue) {
                if($value == $subvalue) $ValueArrConv[] = $subkey;
              }
            }
            $calcArrQ += round((array_sum($ValueArrConv) / count($ValueArrConv)),2);
            // var_dump($calcArrQ);
            // $avg = $this->db->query($q)->row('avg');
          }
          
          // var_dump("<br><br>");
          $series[$keyIns] = round(($calcArrQ / $divide),2);
          // var_dump(round(($calcArrQ / $divide),2));
        }
        $chart[] = $series;
        // var_dump($chart);
      }
      return $chart;
    }

    // GET VALUATION AVERAGE SCORE ON EACH OF TRANSPORTATIONS MODE --ir
    public function getFiveValue($basedQ, $id){
      $valueResp = array('1'=>'Sangat Tidak Setuju', '2'=>'Tidak Setuju', '3'=>'Ragu-ragu', '4'=>'Setuju', '5'=>'Sangat Setuju');
      $pages = array();
      if($id == "28"){
        $instansi = array('390'=>'Ditjen Hubdat','391'=>'BPTD','392'=>'TPAJ Tipe A');
        // 32 34 35 40 41
        $pages['Orientasi Pelayanan']  = array('82', '294', '80', '296');
        $pages['Inovasi']              = array('90', '92', '94', '307');
        $pages['Proposisi Nilai']      = array('96', '97');
        $pages['Kompetisi']            = array('299', '300');
        $pages['Data']                 = array('83', '84');
      }
      
      // SET BY SELECTED TERMINAL --ir
      $whereIdRespTerm = '';
      if($basedQ) $whereIdRespTerm = $this->getIdResp($basedQ);
      
      $chart = array();
      foreach ($pages as $key => $listQ) {
        $pagesName = $key;
        $series['category'] = $key; 
        foreach ($instansi as $key => $value) {
          $insName = $value;
          // SET BY SELECTED INSTANSI --ir
          $keyIns = $key;
          $whereIdResp = '';
          $whereIdResp = $this->getIdResp($key);
          if(!$whereIdResp) continue;
          // if($key == "390") var_dump($whereIdResp);
          $divide = count($listQ);
          $calcArrQ = 0;
          // $rating = COUNT($valueResp);

          $count  = 0;
          $min    = 0;
          $max    = 0;
          $sum    = 0;
          $skor   = 0;
          foreach ($listQ as $key => $value) {
            // $q   = "SELECT response FROM do_responses WHERE question = '$value' $whereIdResp $whereIdRespTerm";
            $q = "SELECT COUNT(id) AS id FROM do_answers WHERE question = '$value' LIMIT 1";
            $rating = $this->db->query($q)->row('id');
            $q = "SELECT COUNT(response) AS count, 
                    SUM(CASE response
                     WHEN 'Sangat Tidak Setuju' THEN 1
                     WHEN 'Tidak Setuju' THEN 2
                     WHEN 'Ragu-ragu' THEN 3
                     WHEN 'Setuju' THEN 4
                     WHEN 'Sangat Setuju' THEN 5
                     ELSE NULL
                    END) as sum 
                  FROM do_responses WHERE question = '$value' and response != '' $whereIdResp $whereIdRespTerm LIMIT 1";
            $q2 = "SELECT 
                    CASE response
                     WHEN 'Sangat Tidak Setuju' THEN 1
                     WHEN 'Tidak Setuju' THEN 2
                     WHEN 'Ragu-ragu' THEN 3
                     WHEN 'Setuju' THEN 4
                     WHEN 'Sangat Setuju' THEN 5
                     ELSE NULL
                    END as sum 
                  FROM do_responses WHERE question = '$value' and response != '' $whereIdResp $whereIdRespTerm";
            $x = $this->db->query($q)->row();
            $count  = $x->count;
            $min    = $count*(($rating-$rating)+1);
            $max    = $count*$rating;
            $sum    = $x->sum;
            $skor   += (($sum-$min)/($max-$min))*100;
            
            
            // var_dump($pagesName."--".$insName);
            // var_dump("<br>");
            // var_dump($q2);
            // var_dump("<br>");
            // var_dump($count."--".$sum."--".$min."--".$max."--".$skor."--".$rating);
            // var_dump("<br>");
            // $valSeries['avg'] = round($skor,2);
          }
          $skor = $skor/$divide;
          
          // var_dump("<br><br>");
          $series[$keyIns] = round($skor,2);
          // var_dump(round(($calcArrQ / $divide),2));
        }
        $chart[] = $series;
        // var_dump($chart);
      }

      // var_dump($chart);
      return $chart;
    }

    // GET VEHICLE --ir
    public function getVehicle($basedQ, $id){
      $vehicle = array();
      if($id == "28"){
        $listAns['402'] = '< 1.600';
        $listAns['403'] = '> 1.600 - 3.200';
        $listAns['404'] = '> 3.200';
      }
      
      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);
      $resp = $this->getResponden($basedQ, $id);
      
      foreach ($listAns as $key => $value) {
        $series = array();
        $q   = "SELECT response FROM do_responses WHERE answer = '$key' $whereIdResp";
        $rs = $this->db->query($q)->result();
        $valueArr = $this->fixArr($rs);
        // var_dump($valueArr);

        $series['category'] = $value;
        // $series['percentage'] = round(((count($valueArr) / $resp) * 100),2);
        $series['value'] = count($valueArr);
        $vehicle[] = $series;
      }
      // var_dump($vehicle);

      return $vehicle;
    }

    // GET ROUTE --ir
    public function getRoute($basedQ, $id){
      $route = array();
      if($id == "28"){
        $listAns['405'] = '< 210';
        $listAns['406'] = '> 210-420';
        $listAns['407'] = '> 420';
      }
      
      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);
      $resp = $this->getResponden($basedQ, $id);
      
      foreach ($listAns as $key => $value) {
        $series = array();
        $q   = "SELECT response FROM do_responses WHERE answer = '$key' $whereIdResp";
        $rs = $this->db->query($q)->result();
        $valueArr = $this->fixArr($rs);
        // var_dump($valueArr);

        $series['category'] = $value;
        // $series['percentage'] = round(((count($valueArr) / $resp) * 100),2);
        $series['value'] = count($valueArr);
        $route[] = $series;
      }

      return $route;
    }

    // GET REQUEST --ir
    public function getRequest($basedQ, $id){
      $request = array();
      if($id == "28"){
        $listAns['408'] = '< 500';
        $listAns['409'] = '> 500 - 1.500';
        $listAns['410'] = '> 1.500';
      }
      
      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);
      $resp = $this->getResponden($basedQ, $id);
      
      foreach ($listAns as $key => $value) {
        $series = array();
        $q   = "SELECT response FROM do_responses WHERE answer = '$key' $whereIdResp";
        $rs = $this->db->query($q)->result();
        $valueArr = $this->fixArr($rs);

        $series['category'] = $value;
        // $series['percentage'] = round(((count($valueArr) / $resp) * 100),2);
        $series['value'] = count($valueArr);
        $request[] = $series;
      }

      return $request;
    }
  // END SURVEY INTERNAL ORGANISASI --ir

  // SURVEY PENUMPANG DAN MASYARAKAT --ir
    // GET VALUATION AVERAGE SCORE ON EACH OF TRANSPORTATIONS MODE (AVG VALUE) --ir
    public function getRatingChart2($basedQ, $id){
      $rating = array();
      if($id == "27"){
        $rating['93']  = 'Tarif';               //Ketepatan
        $rating['99']  = 'Ketepatan Waktu';     //Ketepatan
        $rating['100'] = 'Durasi Perjalanan';   //durasi  
        $rating['101'] = 'Kemudahan Pemesanan'; //kemudahan
        $rating['102'] = 'Kualitas Pelayanan';  //kualitas
        $rating['103'] = 'Keamanan';            //keamanan
        $rating['104'] = 'Akses';               //akses
        $rating['105'] = 'Kenyamanan';          //kenyamanan
        $rating['106'] = 'Kebersihan';          //kebersihan
      } 

      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      $series = array();
      $a = 0;
      foreach ($rating as $idPage => $namePage) {
        $valSeries = array();
        $valSeries['category'] = $namePage;
        $q = "SELECT id as idQ 
        FROM do_questions
        WHERE page = '$idPage'";
        $listQ = $this->db->query($q)->result_array();
        $noVal = 1;
        foreach ($listQ as $key => $idQ) {
          foreach ($idQ as $key => $value) {
            $q   = "SELECT AVG(response) AS avg FROM do_responses WHERE question = '$value' $whereIdResp LIMIT 1";
            $avg = $this->db->query($q)->row('avg');
            $valSeries['value'.($noVal++)] = round($avg, 2);
          }
        }
        $series[$a] = $valSeries;
        $a++;
      }
      return $series;
    }

    // GET VALUATION AVERAGE SCORE ON EACH OF TRANSPORTATIONS MODE (CARDINAL PERCENTAGE VALUE) --ir
    public function getRatingChart($basedQ, $id){
      $rating = array();
      if($id == "27"){
        // ID PAGE FOR SERIES --ir
        $rating['93']  = 'Tarif';               //Ketepatan
        $rating['99']  = 'Ketepatan Waktu';     //Ketepatan
        $rating['100'] = 'Durasi Perjalanan';   //durasi  
        $rating['101'] = 'Kemudahan Pemesanan'; //kemudahan
        $rating['102'] = 'Kualitas Pelayanan';  //kualitas
        $rating['103'] = 'Keamanan';            //keamanan
        $rating['104'] = 'Akses';               //akses
        $rating['105'] = 'Kenyamanan';          //kenyamanan
        $rating['106'] = 'Kebersihan';          //kebersihan
      } 

      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      $series = array();
      $a = 0;
      foreach ($rating as $idPage => $namePage) {
        $valSeries = array();
        $valSeries['category'] = $namePage;
        $q = "SELECT id as idQ 
        FROM do_questions
        WHERE page = '$idPage'";
        $listQ = $this->db->query($q)->result_array();
        $noVal = 1;
        foreach ($listQ as $key => $idQ) {
          foreach ($idQ as $key => $value) {
            $q = "SELECT COUNT(id) AS id FROM do_answers WHERE question = '$value' LIMIT 1";
            $rating = $this->db->query($q)->row('id');
            $q = "SELECT COUNT(response) AS count, SUM(response) AS sum FROM do_responses WHERE question = '$value' and response != '' $whereIdResp LIMIT 1";
            $x = $this->db->query($q)->row();
            // var_dump($x->count."--".$namePage."--".$value);
            $min  = $x->count*(($rating-$rating)+1);
            $max  = $x->count*$rating;
            $skor = (($x->sum-$min)/($max-$min))*100;

            $valSeries['value'.($noVal++)] = round($skor,2);
          }
        }
        $series[$a] = $valSeries;
        $a++;
      }
      return $series;
    }

    // GET SATISFACTION (AVG VALUE) --ir 
    public function getSatisfaction2($basedQ, $id){
      $satisfaction = array();
      if($id == "27"){
        $satisfaction['34']  = 'Prioritas';
        $satisfaction['35']  = 'Pelayanan Terminal';
        $satisfaction['36']  = 'Pelayanan PO Bus';
        $satisfaction['37']  = 'Tingkat Kepuasan';  
      } 

      $series = array();
      $a = 0;
      foreach ($satisfaction as $idQ => $nameCategory) {
        $valSeries = array();
        $valSeries['category'] = $nameCategory;
        $q = "SELECT id as idAns 
        FROM do_answers
        WHERE question = '$idQ'";
        $listAns = $this->db->query($q)->result_array();
        $noVal = 1;
        foreach ($listAns as $key => $idAns) {
          foreach ($idAns as $key => $value) {
            $q   = "SELECT COUNT(response) AS count FROM do_responses WHERE answer = '$value' LIMIT 1";
            $count = $this->db->query($q)->row('count');
            $valSeries['value'.($noVal++)] = $count;
          }
        }
        $series[$a] = $valSeries;
        $a++;
      }
      // var_dump($series);
      return $series;
    }

    // GET SATISFACTION (CARDINAL PERCENTAGE VALUE) --ir
    public function getSatisfaction($basedQ, $id){
      $satisfaction = array();
      if($id == "27"){
        $satisfaction['34']  = 'Prioritas';
        $satisfaction['35']  = 'Pelayanan Terminal';
        $satisfaction['36']  = 'Pelayanan PO Bus';
        $satisfaction['37']  = 'Tingkat Kepuasan';  
      } 

      $resp = $this->getResponden($basedQ, $id);

      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      $series = array();
      $a = 0;
      foreach ($satisfaction as $idQ => $nameCategory) {
        $valSeries = array();
        $valSeries['category'] = $nameCategory;
        $q = "SELECT id as idAns 
        FROM do_answers
        WHERE question = '$idQ'";
        $listAns = $this->db->query($q)->result_array();
        $noVal = 1;
        $rating = COUNT($listAns);
        $q = "SELECT COUNT(response) AS count, 
                SUM(CASE response
                 WHEN 'Sangat Tidak Setuju' THEN 1
                 WHEN 'Tidak Setuju' THEN 2
                 WHEN 'Ragu-ragu' THEN 3
                 WHEN 'Setuju' THEN 4
                 WHEN 'Sangat Setuju' THEN 5
                 ELSE NULL
                END) as sum 
              FROM do_responses WHERE question = '$idQ' and response != '' $whereIdResp LIMIT 1";
        $x = $this->db->query($q)->row();
        $count  = $x->count;
        $min    = $count*(($rating-$rating)+1);
        $max    = $count*$rating;
        $sum    = $x->sum;
        $skor   = (($sum-$min)/($max-$min))*100;
        $valSeries['avg'] = round($skor,2);

        $series[$a] = $valSeries;
        $a++;
      }
      return $series;
    }

    // GET FREQUENTB OF USING ONLINE TRANSACTIONS --ir
    public function getFreqApp($basedQ, $id){
      $freq   = array();
      $series = array();
      $idQ  = "54"; 
      $q = "SELECT id as idAns, title 
        FROM do_answers
        WHERE question = '$idQ'";
      $listAns = $this->db->query($q)->result_array();

      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      foreach ($listAns as $key => $idAns) {
        $series['category'] = $idAns['title'];
        $answer = $idAns['idAns'];
        $q      = "SELECT COUNT(response) AS count FROM do_responses WHERE answer = '$answer' $whereIdResp LIMIT 1";
        $count  = $this->db->query($q)->row('count');
        $series['value'] = $count;
        $freq[] = $series;
      }
      return $freq;
    }

    // GET FREQUENTB OF USING ONLINE TRANSACTIONS --ir
    public function getmoneySpent($basedQ, $id){
      $freq   = array();
      $series = array();
      $idQ  = "53"; 
      $q = "SELECT id as idAns, title 
        FROM do_answers
        WHERE question = '$idQ'";
      $listAns = $this->db->query($q)->result_array();

      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      foreach ($listAns as $key => $idAns) {
        $series['category'] = $idAns['title'];
        $answer = $idAns['idAns'];
        $q      = "SELECT COUNT(response) AS count FROM do_responses WHERE answer = '$answer' $whereIdResp LIMIT 1";
        $count  = $this->db->query($q)->row('count');
        $series['value'] = $count;
        $freq[] = $series;
      }
      return $freq;
    }

    // GET TAG CLOUD (38) --ir
    public function getTagCloudHope($basedQ, $id){
      $tagCloud = array();
      if($id == "27"){
        $idQ  = '62';
      } 

      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      $q = "SELECT MAX(response) as tag
      FROM do_responses
      WHERE question = '$idQ'
      $whereIdResp
      GROUP BY response
      ORDER BY COUNT(response) desc";
      $textArr = $this->db->query($q)->result_array();
      // var_dump($textArr);

      $tagsLib  = array();
      $tags     = array();
      foreach ($textArr as $key => $value) {
        foreach ($value as $key => $text) {
          $pattern = $this->pattern;
          $textBreak = preg_split($pattern, $text);
          $tagsVal = array();
          foreach ($textBreak as $key => $value) {
            $value = ucwords(strtolower($value));
            if($value=="" || in_array(strtolower($value), $this->exclusion)) continue;
            if(array_key_exists($value, $tagsLib)) $count = $tags[$value]['count'] + 1;
            else $count = 1;
            $tagsVal['tag']   = $value;
            $tagsVal['count'] = $count;
            $tags[$value]     = $tagsVal;
            $tagsLib[$value]  = $value;
          }
        }
      }

      $tags = array_values($tags);
      $countTags = 0;
      foreach ($tags as $key => $value) {
        foreach ($value as $subKey => $subValue) {
          if($subKey == "count" && $subValue < 3) unset($tags[$countTags]);
        }
        $countTags++;
      }
      $tags = array_values($tags);
      return $tags;
    }

    // GET TAG CLOUD (38) --ir
    public function getTagCloudHope2($basedQ, $id){
      $tagCloud = array();
      if($id == "27"){
        $idQ  = '64';
      } 

      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      $q = "SELECT MAX(response) as tag
      FROM do_responses
      WHERE question = '$idQ'
      $whereIdResp
      GROUP BY response
      ORDER BY COUNT(response) desc";
      $textArr = $this->db->query($q)->result_array();
      // var_dump($textArr);

      $tagsLib  = array();
      $tags     = array();
      foreach ($textArr as $key => $value) {
        foreach ($value as $key => $text) {
          $pattern = $this->pattern;
          $textBreak = preg_split($pattern, $text);
          $tagsVal = array();
          foreach ($textBreak as $key => $value) {
            $value = ucwords(strtolower($value));
            if($value=="" || in_array(strtolower($value), $this->exclusion)) continue;
            if(array_key_exists($value, $tagsLib)) $count = $tags[$value]['count'] + 1;
            else $count = 1;
            $tagsVal['tag']   = $value;
            $tagsVal['count'] = $count;
            $tags[$value] = $tagsVal;
            $tagsLib[$value] = $value;
          }
        }
      }

      $tags = array_values($tags);
      $countTags = 0;
      foreach ($tags as $key => $value) {
        foreach ($value as $subKey => $subValue) {
          if($subKey == "count" && $subValue < 3) unset($tags[$countTags]);
        }
        $countTags++;
      }
      $tags = array_values($tags);
      return $tags;
    }

    // GET TAG CLOUD (38) --ir
    public function getTagCloudHope3($basedQ, $id){
      $tagCloud = array();
      if($id == "27"){
        $idQ  = '65';
      } 

      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      $q = "SELECT MAX(response) as tag
      FROM do_responses
      WHERE question = '$idQ'
      $whereIdResp
      GROUP BY response
      ORDER BY COUNT(response) desc";
      $textArr = $this->db->query($q)->result_array();
      // var_dump($textArr);

      $tagsLib  = array();
      $tags     = array();
      foreach ($textArr as $key => $value) {
        foreach ($value as $key => $text) {
          $pattern = $this->pattern;
          $textBreak = preg_split($pattern, $text);
          $tagsVal = array();
          foreach ($textBreak as $key => $value) {
            $value = ucwords(strtolower($value));
            if($value=="" || in_array(strtolower($value), $this->exclusion)) continue;
            if(array_key_exists($value, $tagsLib)) $count = $tags[$value]['count'] + 1;
            else $count = 1;
            $tagsVal['tag']   = $value;
            $tagsVal['count'] = $count;
            $tags[$value] = $tagsVal;
            $tagsLib[$value] = $value;
          }
        }
      }

      $tags = array_values($tags);
      $countTags = 0;
      foreach ($tags as $key => $value) {
        foreach ($value as $subKey => $subValue) {
          if($subKey == "count" && $subValue < 3) unset($tags[$countTags]);
          if($subValue == "Wifi") $tags[$countTags]['count'] = 18;
          if($subValue == "Teknologi") $tags[$countTags]['count'] = 27;
          if($subValue == "Tehnologi") unset($tags[$countTags]);
        }
        $countTags++;
      }
      $tags = array_values($tags);
      return $tags;
    }

    // GET TAG CLOUD (38) --ir
    public function getTagCloud($basedQ, $id){
      $tagCloud = array();
      if($id == "27"){
        $idQ  = '38';
      } 

      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      $q = "SELECT MAX(response) as tag
      FROM do_responses
      WHERE question = '$idQ'
      $whereIdResp
      GROUP BY response
      ORDER BY COUNT(response) desc";
      $textArr = $this->db->query($q)->result_array();
      // var_dump($textArr);

      $tagsLib  = array();
      $tags     = array();
      foreach ($textArr as $key => $value) {
        foreach ($value as $key => $text) {
          $pattern = $this->pattern;
          $textBreak = preg_split($pattern, $text);
          $tagsVal = array();
          foreach ($textBreak as $key => $value) {
            $value = ucwords(strtolower($value));
            if($value == "" || in_array(strtolower($value), $this->exclusion)) continue;
            if(array_key_exists($value, $tagsLib)) $count = $tags[$value]['count'] + 1;
            else $count = 1;
            $tagsVal['tag']   = $value;
            $tagsVal['count'] = $count;
            $tags[$value]     = $tagsVal;
            $tagsLib[$value]  = $value;
          }
        }
      }

      $tags = array_values($tags);
      $countTags = 0;
      foreach ($tags as $key => $value) {
        foreach ($value as $subKey => $subValue) {
          if($subKey == "count" && $subValue < 3) unset($tags[$countTags]);
        }
        $countTags++;
      }
      $tags = array_values($tags);
      
      return $tags;
    }

    // GET TAG CLOUD (39) --ir
    public function getTagCloud2($basedQ, $id){
      $tagCloud = array();
      if($id == "27"){
        $idQ  = '39';
      } 

      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);

      $q = "SELECT MAX(response) as tag
      FROM do_responses
      WHERE question = '$idQ'
      $whereIdResp
      GROUP BY response
      ORDER BY COUNT(response) desc";
      $textArr = $this->db->query($q)->result_array();
      // var_dump($textArr);

      $tagsLib  = array();
      $tags     = array();
      foreach ($textArr as $key => $value) {
        foreach ($value as $key => $text) {
          // var_dump($text);
          $tagsVal = array();
          // CHECK NEGATIVE SENTENCE --iir
          // foreach ($this->negativeWord as $value) {
          //   //if (strstr($string, $url)) { // mine version
          //     if (strpos(strtolower($text), $value) !== FALSE) { // Yoshi version
          //     // var_dump("<br><b>".$value."</b>");
          //     $value = ucwords(strtolower($value));
          //     if($value=="" || in_array(strtolower($value), $this->exclusion)) continue;
          //     if(array_key_exists($value, $tagsLib)) $count = $tags[$value]['c\ ount'] + 1;
          //     else $count = 1;
          //     $tagsVal['tag']   = $value;
          //     $tagsVal['count'] = $count;
          //     $tags[$value]     = $tagsVal;
          //     $tagsLib[$value]  = $value;
          //     $text = str_replace(strtolower($value), "", strtolower($text));
          //     // var_dump($tags);
          //   }
          // }
          // var_dump("<br>".$text);
          $pattern = $this->pattern;
          $textBreak = preg_split($pattern, $text);
          foreach ($textBreak as $key => $value) {
            $value = ucwords(strtolower($value));
            if($value=="" || in_array(strtolower($value), $this->exclusion)) continue;
            if(array_key_exists($value, $tagsLib)) $count = $tags[$value]['count'] + 1;
            else $count = 1;
            $tagsVal['tag']   = $value;
            $tagsVal['count'] = $count;
            $tags[$value]     = $tagsVal;
            $tagsLib[$value]  = $value;
          }
        }
      }

      $tags = array_values($tags);
      $countTags = 0;
      foreach ($tags as $key => $value) {
        foreach ($value as $subKey => $subValue) {
          if($subKey == "count" && $subValue < 3) unset($tags[$countTags]);
        }
        $countTags++;
      }
      $tags = array_values($tags);
      return $tags;
    }
  // END SURVEY PENUMPANG DAN MASYARAKAT --ir

  // SURVEY MITRA/PO BISNIS
    // GET STRATEGIC COMPETENCY --ir
    public function getFiveValuePO($basedQ, $id){
      $valueResp = array('1'=>'Sangat Tidak Setuju', '2'=>'Tidak Setuju', '3'=>'Ragu-ragu', '4'=>'Setuju', '5'=>'Sangat Setuju');
      $pages = array();
      if($id == "29"){
        $instansi = array('538'=>'ALBN','539'=>'AKAP','540'=>'AKDP','541'=>'BRT (Bus Rapid Transit)');
        // 32 34 35 40 41
        $pages['Orientasi Pelayanan']  = array('112', '113', '114', '116', '631', '633');
        $pages['Inovasi']              = array('127', '130', '131');
        $pages['Proposisi Nilai']      = array('132', '133');
        $pages['Kompetisi']            = array('118', '636');
        $pages['Data']                 = array('120', '121', '123', '124');
      }
      
      // SET BY SELECTED TERMINAL --ir
      $whereIdRespTerm = '';
      if($basedQ) $whereIdRespTerm = $this->getIdResp($basedQ);
      
      $chart = array();
      foreach ($pages as $key => $listQ) {
        $pagesName = $key;
        $series['category'] = $key; 
        foreach ($instansi as $key => $value) {
          $insName = $value;
          // SET BY SELECTED INSTANSI --ir
          $keyIns = $key;
          $whereIdResp = '';
          $whereIdResp = $this->getIdResp($key);
          // var_dump($whereIdResp);
          if(!$whereIdResp){
            $series[$keyIns] = '';
            continue;
          } 
          $divide = count($listQ);
          $calcArrQ = 0;
          // $rating = COUNT($valueResp);

          $count  = 0;
          $min    = 0;
          $max    = 0;
          $sum    = 0;
          $skor   = 0;
          foreach ($listQ as $key => $value) {
            // $q   = "SELECT response FROM do_responses WHERE question = '$value' $whereIdResp $whereIdRespTerm";
            $q = "SELECT COUNT(id) AS id FROM do_answers WHERE question = '$value' LIMIT 1";
            $rating = $this->db->query($q)->row('id');
            $q = "SELECT COUNT(response) AS count, 
                    SUM(CASE response
                     WHEN 'Sangat Tidak Setuju' THEN 1
                     WHEN 'Tidak Setuju' THEN 2
                     WHEN 'Ragu-ragu' THEN 3
                     WHEN 'Setuju' THEN 4
                     WHEN 'Sangat Setuju' THEN 5
                     ELSE NULL
                    END) as sum 
                  FROM do_responses WHERE question = '$value' and response != '' $whereIdResp $whereIdRespTerm LIMIT 1";
            $q2 = "SELECT 
                    CASE response
                     WHEN 'Sangat Tidak Setuju' THEN 1
                     WHEN 'Tidak Setuju' THEN 2
                     WHEN 'Ragu-ragu' THEN 3
                     WHEN 'Setuju' THEN 4
                     WHEN 'Sangat Setuju' THEN 5
                     ELSE NULL
                    END as sum 
                  FROM do_responses WHERE question = '$value' and response != '' $whereIdResp $whereIdRespTerm";
            $x = $this->db->query($q)->row();
            $count  = $x->count;
            $min    = $count*(($rating-$rating)+1);
            $max    = $count*$rating;
            $sum    = $x->sum;
            $skor   += (($sum-$min)/($max-$min))*100;

            // var_dump($pagesName."--".$insName);
            // var_dump("<br>");
            // var_dump($q2);
            // var_dump("<br>");
            // var_dump($count."--".$sum."--".$min."--".$max."--".$skor."--".$rating);
            // var_dump("<br>");
            // $valSeries['avg'] = round($skor,2);
          }
          $skor = $skor/$divide;
          
          // var_dump("<br><br>");
          $series[$keyIns] = round($skor,2);
          // var_dump(round(($calcArrQ / $divide),2));
        }
        $chart[] = $series;
      }
      // $series = array(
      //   'ideal' => 'ideal'
      // );
      return $chart;
    }

    // GET VEHICLE --ir
    public function getVehiclePO($basedQ, $id){
      $vehicle = array();
      if($id == "29"){
        $listAns['553'] = '<20';
        $listAns['554'] = '<20-50';
        $listAns['555'] = '>50-80';
        $listAns['556'] = '>80';
      }

      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);
      $resp = $this->getResponden($basedQ, $id);
      
      foreach ($listAns as $key => $value) {
        $series = array();
        $q   = "SELECT response FROM do_responses WHERE answer = '$key' $whereIdResp";
        $rs = $this->db->query($q)->result();
        $valueArr = $this->fixArr($rs);
        // var_dump($valueArr);

        $series['category'] = $value;
        // $series['percentage'] = round(((count($valueArr) / $resp) * 100),2);
        $series['value'] = count($valueArr);
        $vehicle[] = $series;
      }
      // var_dump($vehicle);

      return $vehicle;
    }

    // GET ROUTE --ir
    public function getRoutePO($basedQ, $id){
      $route = array();
      if($id == "29"){
        $listAns['557'] = '<10';
        $listAns['558'] = '<10-20';
        $listAns['559'] = '>20-30';
        $listAns['560'] = '>30';
      }
      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);
      $resp = $this->getResponden($basedQ, $id);
      
      foreach ($listAns as $key => $value) {
        $series = array();
        $q   = "SELECT response FROM do_responses WHERE answer = '$key' $whereIdResp";
        $rs = $this->db->query($q)->result();
        $valueArr = $this->fixArr($rs);
        // var_dump($valueArr);

        $series['category'] = $value;
        // $series['percentage'] = round(((count($valueArr) / $resp) * 100),2);
        $series['value'] = count($valueArr);
        $route[] = $series;
      }

      return $route;
    }

    // GET DEPARTURE --ir
    public function getDeparturePO($basedQ, $id){
      $request = array();
      if($id == "29"){
        $listAns['561'] = '<20';
        $listAns['562'] = '<20-50';
        $listAns['563'] = '>50-80';
        $listAns['564'] = '>80';
      }
      
      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);
      $resp = $this->getResponden($basedQ, $id);
      
      foreach ($listAns as $key => $value) {
        $series = array();
        $q   = "SELECT response FROM do_responses WHERE answer = '$key' $whereIdResp";
        $rs = $this->db->query($q)->result();
        $valueArr = $this->fixArr($rs);

        $series['category'] = $value;
        // $series['percentage'] = round(((count($valueArr) / $resp) * 100),2);
        $series['value'] = count($valueArr);
        $request[] = $series;
      }

      return $request;
    }

    // GET ARRIVAL --ir
    public function getArrivalPO($basedQ, $id){
      $request = array();
      if($id == "29"){
        $listAns['565'] = '<20';
        $listAns['566'] = '<20-50';
        $listAns['567'] = '>50-80';
        $listAns['568'] = '>80';
      }
      
      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);
      $resp = $this->getResponden($basedQ, $id);
      
      foreach ($listAns as $key => $value) {
        $series = array();
        $q   = "SELECT response FROM do_responses WHERE answer = '$key' $whereIdResp";
        $rs = $this->db->query($q)->result();
        $valueArr = $this->fixArr($rs);

        $series['category'] = $value;
        // $series['percentage'] = round(((count($valueArr) / $resp) * 100),2);
        $series['value'] = count($valueArr);
        $request[] = $series;
      }

      return $request;
    }
    
    // GET OCCUPANCY LEVEL --ir
    public function getOccupancyPO($basedQ, $id){
      $request = array();
      if($id == "29"){
        $listAns['1706'] = '<20%';
        $listAns['1707'] = '20-30%';
        $listAns['1708'] = '30-40%';
        $listAns['1709'] = '40-50%';
        $listAns['1710'] = '>50%';
      }
      
      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);
      $resp = $this->getResponden($basedQ, $id);
      
      foreach ($listAns as $key => $value) {
        $series = array();
        $q   = "SELECT response FROM do_responses WHERE answer = '$key' $whereIdResp";
        $rs = $this->db->query($q)->result();
        $valueArr = $this->fixArr($rs);

        $series['category'] = $value;
        // $series['percentage'] = round(((count($valueArr) / $resp) * 100),2);
        $series['value'] = count($valueArr);
        $request[] = $series;
      }

      return $request;
    }

    // GET DECREASE OF PASENGGERS --ir
    public function getDecreasePO($basedQ, $id){
      $request = array();
      if($id == "29"){
        $listAns['1714'] = '<10%';
        $listAns['1715'] = '10-20%';
        $listAns['1716'] = '20-30%';
        $listAns['1717'] = '30-40%';
        $listAns['1718'] = '>40%';
      }
      
      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);
      $resp = $this->getResponden($basedQ, $id);
      
      foreach ($listAns as $key => $value) {
        $series = array();
        $q   = "SELECT response FROM do_responses WHERE answer = '$key' $whereIdResp";
        $rs = $this->db->query($q)->result();
        $valueArr = $this->fixArr($rs);

        $series['category'] = $value;
        // $series['percentage'] = round(((count($valueArr) / $resp) * 100),2);
        $series['value'] = count($valueArr);
        $request[] = $series;
      }

      return $request;
    }

  // END SURVEY INTERNAL ORGANISASI --ir

  // PUBLIC GRAPH --ir
    // GET GRAPH AGE --ir
    public function getGraphAge($basedQ, $id){
      // MASYARAKAT DAN PENUMPANG
      if($id == "27") $idQ = 29;
      // INTERNAL ORGANISASI
      else if($id == "28") $idQ = 71;
      // MITRA PO BUS 
      else $idQ = 107;
    
      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);
    
      $q = "SELECT a.title as name, 
        (SELECT COUNT(response) as count FROM do_responses b WHERE a.id = b.answer AND question = '$idQ' $whereIdResp) as value
        FROM do_answers a
        WHERE question = '$idQ'";
      $rs = $this->db->query($q)->result_array();
      return $rs;
    }

    // GET TYPE OF RESP
    public function getTypeOfResp($basedQ, $id){
      // MASYARAKAT DAN PENUMPANG
      if($id == "27") $idQ = 33;
      // INTERNAL ORGANISASI
      // else if($id == "28") $idQ = 70;
      // MITRA PO BUS 
      // else $idQ = 106;
    
      // SET BY SELECTED TERMINAL --ir
      $whereIdResp = '';
      if($basedQ) $whereIdResp = $this->getIdResp($basedQ);
    
      $q = "SELECT a.title as country, 
        (SELECT COUNT(response) as count FROM do_responses b WHERE a.id = b.answer AND question = '$idQ' $whereIdResp) as value
        FROM do_answers a
        WHERE question = '$idQ'";
      $rs = $this->db->query($q)->result_array();
      return $rs;
    }

    // GET RESPONDEN FOR EACH TERMINAL --ir
    public function getResponden($basedQ, $id){
      if(!$basedQ){
        $listTerminal = $this->listTerminal($id);
        $rs = 0;
        foreach ($listTerminal as $key => $value) {
          $basedQ = $value['id'];
          $q = "SELECT count(answer) as count
            FROM do_responses
            WHERE answer = '$basedQ'";
          $rs += $this->db->query($q)->row('count');
        }
      }else{
        $q = "SELECT count(answer) as count
          FROM do_responses
          WHERE answer = '$basedQ'";
        $rs = $this->db->query($q)->row('count');
      }
      return $rs;
    }
  // END PUBLIC GRAPH --ir
}