<?php
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Rachmadona');
$pdf->SetTitle($jdl.' '.$bulan_name);
$pdf->SetSubject('');
$pdf->SetKeywords('TCPDF, PDF, dn');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(0, 10, 0);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 10);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage('L','A3');
// $pdf->Cell(0, 0, 'A5 LANDSCAPE', 1, 1, 'C');
$pdf->setJPEGQuality(100);

// $pdf->Image($image, 20, 15, 20, 20, '', '', '', true, 100);

$pdf->setCellMargins(0, 0, 0, 0);

// $pdf->SetFont('helveticaB', 'I', 20);
// //$pdf->Cell(0, 1, 'Nama', 1, 0, 'L','','','','','','T');
// // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// $pdf->Cell(0, 0, 'PT. SURYA MULTINDO INDUSTRI', 0, 1, 'C', 0, '', 1);
// $pdf->SetFont('helvetica', 'B', 10);
// $pdf->Cell(0, 0, 'Jl. Jababeka IV Blok C2-A, B, C Kawasan Industri Cikarang, Cikarang', 0, 1, 'C', 0, '', 1);
// $pdf->Cell(0, 0, 'Bekasi - Indonesia 17550 Telp. 021-893-7850 (Hunting), Fax. 021-893-7851', 0, 1, 'C', 0, '', 1);
// // set font
$pdf->SetFont('helvetica', '', 5);


$pdf->Ln(5);
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 4, 'color' => array(255, 0, 0)));
$pdf->SetFillColor(255,255,128);

$html="";


$html .='
<div align="center"><b style="font-size: 150%;">'.$jdl.'</b></div>
<div align="center"><b style="font-size: 150%;">'.$bulan_name.'</b></div>
<br/>
<br/>
<table border="0">
   <tr>
      <td width="100%">
         <table border="1" cellmargin="0" cellpadding="5">
            <thead>
              <tr>
                <th><b>NO</b></th>
                <th><b>KATEGORI</b></th>
                <th><b>SATUAN</b></th>
                <th><b>KALKULASI</b></th>';

              for ($i=1; $i <= 31; $i++) { 
$html .='
                <th colspan="3"><center><b>'.$i.'</b></center></th>'; 
              }

$html .='   
                <th rowspan="2"><center><b>TOTAL</b></center></th>
              </tr>
            </thead>
            <tbody>
              '.$tabel.'   
            </tbody>          
         </table>
      </td>
   </tr>
</table>
';


// echo $html;exit();
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------    

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output($jdl.' '.$bulan_name.'.pdf', 'I');
?>        