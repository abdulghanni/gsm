<style>
body{
	font-size:8pt;
	margin-top:4.5cm;
}
.invoices{
	font-size:9.5pt;
}
tr.border_bottom td {
  border-bottom:3px solid black;
}
tr.border_top td {
  border-top:1px solid black;
}
tr.border_top_bold td {
  border-top:3px solid black;
}
table.noborder td{
border:0px solid white!important;
}
.borderkirikanan{
	border-left:2px solid black;
	border-right:2px solid black;
}
.noatm{
	font-size:11px;
}
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<?php //print_mz($joborder); ?><body>
<table width="100%" border="0" cellspacing="0" class="invoices">
  <tr>
    <td colspan="3"><div align="center"><h2><strong>INVOICE</strong></h2></div></td>
  </tr>
  <tr class="">
    <td width="34%"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <table width="100%" border="0" cellspacing="0" class="invoices">
        <tr>
          <td width="33%">To </td>
          <td width="67%"><?php echo $messers;?></td>
        </tr>
        <tr>
          <td>PIC </td>
          <td><?php echo $pic?></td>
        </tr>
        <tr>
          <td colspan="2"><?php echo $address;?></td>
        </tr>
      </table>
      <p> <br>
      </p>
    </td>
    <td width="34%">&nbsp;</td>
    <td width="32%"><p>&nbsp;</p></td>
  </tr>
  <tr class="border_top">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>DEBIT NOTE<br />
ORIGINAL
  <p>Invoice No. <?php echo $sum['number']?> </p>
  <p>Invoice Date. <?php echo tglindo($sum['create_date'])?> </p></td>
  </tr>
  <tr class="border_top">
    <td colspan="3">Payment for Domestic Delivery on <?php echo GetMonthFull(substr($sum['create_date'],5,2)).' '.substr($sum['create_date'],0,4)?></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0" align="center" cellspacing="0" class="invoices">
      <tr class="border_bottom border_top_bold">
        <td rowspan="2" align="center" class="borderkirikanan"><span class="">Date</span></td>
        <td rowspan="2" align="center" class="borderkirikanan"><span class="">Vehicle No</span></td>
        <td rowspan="2" align="center" class="borderkirikanan"><span class="">J/O No</span></td>
        <td rowspan="2" align="center" class="borderkirikanan"><span class="">Delivery</span></td>
        <td width="12%" rowspan="2" align="center" class="borderkirikanan">Type</td>
        <td colspan="4" align="center" class="borderkirikanan" style="border-right:3px solid black; border-left:3px solid black;">AMOUNT</td>
        <td width="14%" rowspan="2" align="center" class="borderkirikanan">TOTAL AMOUNT </td>
      </tr>
      <tr class="border_bottom">
        <td width="11%" align="center" class="borderkirikanan">Trucking Charge</td>
        <td width="11%" align="center" class="borderkirikanan">Overnight</td>
        <td width="11%" align="center" class="borderkirikanan">BI Bongkar</td>
        <td width="11%" align="center" class="borderkirikanan">Doc Charge</td>
        
	   	</tr><?php
	  $atch=$aov=$abong=$adc=$alls=0;
		$totrp=0;
		$totusd=0;
		$all=0;
		$jo='';
		foreach($detail as $isi){
			if($jo!=$isi['jo']){
				$qdetail=$this->db->query("SELECT * FROM sv_trucking_order WHERE number='".$isi['jo']."'")->row_array();
				//$tch=$this->db->query("SELECT total FROM sv_invoice_detail WHERE id_invoice='".$isi['jo']."'")->row_array();
				if($isi['desc']=='Trucking Charge'){$tch=$isi['total'];}
				else{$tch=0;}
				if($isi['desc']=='Biaya Bongkar'){$bong=$isi['total'];}
				else{$bong=0;}
				if($isi['desc']=='Dokument'){$dc=$isi['total'];}
				else{$dc=0;}
				if($isi['desc']=='Overnight Trucking'){$ov=$isi['total'];}
				else{$ov=0;}
				
				$aone=$tch+$bong+dc+ov;
				
				$vno=(GetValue('code','master_truck',array('id'=>'where/'.$qdetail['vehicle_no']))=='0' ? $qdetail['vehicle_no'] : GetValue('code','master_truck',array('id'=>'where/'.$qdetail['vehicle_no'])));
				$vname=(GetValue('name','master_truck',array('id'=>'where/'.$qdetail['vehicle_no']))=='0' ? $qdetail['vehicle_no'] : GetValue('name','master_truck',array('id'=>'where/'.$qdetail['vehicle_no'])));
			}
		?><?php 
			if($jo!=$isi['jo']){ ?>
      <tr>
        <td align="center" class="borderkirikanan"><span class=""><?php echo tglindo($qdetail['create_date']);?></span></td>
        <td align="center" class="borderkirikanan"><span class=""><?php echo $vno?></span></td>
        <td align="center" class="borderkirikanan"><span class=""><?php echo $isi['jo']?></span></td>
        <td class="borderkirikanan"><?php echo $qdetail['loading'].' - '.$qdetail['unloading']?></div></td>
        <td align="left" class="borderkirikanan"><?php echo $vname?></td>
        <td align="right" class="borderkirikanan"><?php echo uang($tch)?></td>
        <td align="right" class="borderkirikanan"><?php echo uang($ov)?></td>
        <td align="right" class="borderkirikanan"><?php echo uang($bong)?></td>
        <td align="right" class="borderkirikanan"><?php echo uang($dc)?></td>
        <td align="right" class="borderkirikanan"><?php echo uang($aone);?></td>
      </tr>
			<?php
		$atch+=$tch;
		$aov+=$ov;
		$abong+=$bong;
		$adc+=$dc;
		$alls+=$aone;
		
		} ?>
      <!--tr>
        <td colspan="4" ><div align="left"><span class="">&nbsp;&nbsp;-<?php echo $isi['desc']?></span></div></td>
        <td align="right" class="borderkirikanan">&nbsp;</td>
        <td align="right" class="borderkirikanan"><?php echo uang($isi['usd'])?></td>
        <td align="right" class="borderkirikanan"><?php echo uang($isi['idr'])?></td>
        <td align="right" class="borderkirikanan"><?php echo uang($isi['total'])?></td>
      </tr-->
		<?php
		$totrp+=$isi['idr'];
		$totusd+=$isi['usd'];
		$jo=$isi['jo'];
		$all+=$isi['total'];
		} ?>
		<tr class="border_top_bold border_bottom">
        <td width="13%">TRUCKING CHARGE</td>
        <td colspan="8">&nbsp;</td>
        <td align="right" class="borderkirikanan"><?php echo uang($atch)?></td>
      </tr>
	  <tr class="border_bottom">
        <td width="13%">OVERNIGHT CHARGE</td>
        <td colspan="8">&nbsp;</td>
        <td align="right" class="borderkirikanan"><?php echo uang($aov)?></td>
      </tr>
	  <tr class="border_bottom">
        <td width="13%">BIAYA BONGKAR</td>
        <td colspan="8">&nbsp;</td>
        <td align="right" class="borderkirikanan"><?php echo uang($abong)?></td>
      </tr>
	  <tr class="border_bottom">
        <td width="13%">BIAYA DOCUMENT</td>
        <td colspan="8">&nbsp;</td>
        <td align="right" class="borderkirikanan"><?php echo uang($adc)?></td>
      </tr>
	  <tr class="border_bottom">
        <td width="13%">SUBTOTAL</td>
        <td colspan="8">&nbsp;</td>
        <td align="right" class="borderkirikanan"><?php echo uang($alls)?></td>
      </tr>
      <tr class="border_bottom">
        <td width="13%">TAX 10%</td>
        <td colspan="8">&nbsp;</td>
        <td align="right" class="borderkirikanan"><?php echo uang($pajek=$alls*(10/100))?></td>
      </tr>
      <tr class="border_bottom">
        <td width="13%">TOTAL AMOUNT </td>
        <td colspan="8">&nbsp;</td>
        <td align="right" class="borderkirikanan"><?php echo uang($alls+$pajek)?></td>
      </tr>
    </table></td>
  </tr>
</table>
<p>*Exchange rate subject to-date of payment</p>
<p>*Our invoice are payable cash  in full amount to PT ECSI INDONESIA by the indicated due date</p>
<p>*If any discrepency kindly contact us within 7 days in writing from the days of invoices</p>
<p>Account No.   </p>
<table width="40%" border="0" cellspacing="0" class="noatm">
  <tr>
    <td>PT. ECSI INDONESIA</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>BANK BCA MATRAMAN</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>IDR Account No </td>
    <td>342-3409-009</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>PT. ECSI INDONESIA</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">BANK MANDIRI KCP LATUMENTEN </td>
  </tr>
  <tr>
    <td>IDR Account No </td>
    <td>117-00-1422013-1</td>
  </tr>
</table>
<table width="20%" border="0" cellspacing="0" style="float:right;">
  
  <tr class="border_top">
    <td align="center">Authorized Signature</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
