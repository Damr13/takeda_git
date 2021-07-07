<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css" media="all">	
#borderAll {
    border: 1px solid #000;	  	    
}
.p_spacing{
    margin-top:4px;
    margin-bottom:4px;
}
table.tablereport {	
    border: 1px solid #000;	
    border-collapse:collapse;
    margin:5px 0pt 10px;		
    font-size: 9pt;
	width:1120px;
}
table.tablereport thead tr th{		
    border: 1px solid #000;		
    font-size: 9pt;		
    padding: 4px;
    vertical-align:middle;
}	
table.tablereport tbody tr td {
    border: 1px solid #000;		
    font-size: 9pt;		
    padding: 4px;
    vertical-align:top;
}
table.tablereport tfoot tr td {
    border: 1px solid #000;		
    font-size: 9pt;		
    padding: 4px;
    vertical-align:top;
}
.borderall{
    border:1px #000 solid !important;
}
.noborder{
    border:1px #FFF solid !important;
}
.nobordertlr{
	border-top:hidden !important;
    border-left:hidden !important;
    border-right:hidden !important;    
	border-bottom:1px solid #000 !important;
}

.noborderlrb{
    border-left:hidden !important;
    border-right:hidden !important;
    border-bottom:hidden !important;
}
.nobordertr{
    border-top:hidden !important;
    border-right:hidden !important;
}
.nobordert{
    border-top:hidden !important;	
}
.noborderright{
    border-right:hidden !important;
}
.noborderbtm{
    border-bottom:hidden !important;
}
.noborderrb{
    border-right:hidden !important;
    border-bottom:hidden !important;
}	
</style>
</head>

<body>
  <h5><?php echo $jdl; ?><br>TAHUN : <?php echo $tahun; ?> </h5>
  <table cellpadding="1" cellspacing="0" class="tablereport">
    <thead>
      <tr>
        <th border="1" width="20%"><center><b>Info</b></center></th>
        <th border="1" width="6%"><center><b>Apr</b></center></th> 
        <th border="1" width="6%"><center><b>May</b></center></th> 
        <th border="1" width="6%"><center><b>Jun</b></center></th> 
        <th border="1" width="6%"><center><b>Jul</b></center></th> 
        <th border="1" width="6%"><center><b>Aug</b></center></th>
        <th border="1" width="6%"><center><b>Sep</b></center></th> 
        <th border="1" width="6%"><center><b>Oct</b></center></th> 
        <th border="1" width="6%"><center><b>Nov</b></center></th> 
        <th border="1" width="6%"><center><b>Des</b></center></th> 
        <th border="1" width="6%"><center><b>Jan</b></center></th>
        <th border="1" width="6%"><center><b>Feb</b></center></th> 
        <th border="1" width="6%"><center><b>Mar</b></center></th>
        <th border="1" width="8%"><b>TOTAL</b></th>
      </tr>
    </thead>
    <tbody id="t_body">
      <?php echo $tabel; ?>             
    </tbody>            
  </table>
</body>
</html>