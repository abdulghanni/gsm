<style>
@media print{
}
</style>
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
    .footer{
       position:relative;
       top:-20px; // this sets the footer -20px from the top of the next 
                  //header/page ... 20px above the bottom of target page
                  //so make sure it is more negative than your footer's height.

       height:10px;//notice that the top position subtracts 
                   //more than the assigned height of the footer
    }
#sepDiv{
	min-height:100px;
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
  <tr class="border_bottom">
    <td width="34%">To : <?php echo GetValue('name','master_client',array('id'=>'where/'.$joborder['shipper']));?><br>
    <?php echo GetValue('address','master_client',array('id'=>'where/'.$joborder['shipper']));?></td>
    <td width="34%">&nbsp;</td>
    <td width="32%">DEBIT NOTE<br />
    ORIGINAL
    <p>Invoice No. <?php echo $sum['number']?> </p>
    <p>Invoice Date. <?php echo tglindo($sum['create_date'])?> </p></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" class="invoices">
      <tr>
        <td width="33%">Shipper</td>
        <td width="3%">:</td>
        <td width="64%"><?php echo GetValue('name','master_client',array('id'=>'where/'.$joborder['shipper']));?></td>
      </tr>
      <tr>
        <td>Consignee</td>
        <td>:</td>
        <td><?php echo GetValue('name','master_client',array('id'=>'where/'.$joborder['consignee']));?></td>
      </tr>
      <tr>
        <td>BL. No. </td>
        <td>:</td>
        <td><?php echo $bl?></td>
      </tr>
      <tr>
        <td><?php echo $transport?></td>
        <td>:</td>
        <td><?php echo $transports?></td>
      </tr>
      <tr>
        <td>Volume</td>
        <td>:</td>
        <td><?php echo $joborder['packages'].' X '.GetValue('code','master_metric',array('id'=>'where/'.$joborder['packages_metric']))?></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" class="invoices">
      <tr>
        <td width="33%">Loading At </td>
        <td width="3%">:</td>
        <td width="64%"><?php echo $from?></td>
      </tr>
      <tr>
        <td>Discharge At </td>
        <td>:</td>
        <td><?php echo $to?></td>
      </tr>
      <tr>
        <td>ETD POD  </td>
        <td>:</td>
        <td><?php echo tglindo($joborder['etd'])?></td>
      </tr>
      <tr>
        <td>JO No. </td>
        <td>:</td>
        <td><?php echo $joborder['number']?></td>
      </tr>
      <tr>
        <td>Ref No. </td>
        <td>:</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0" align="center" cellspacing="0" class="invoices">
      <tr class="border_bottom border_top_bold">
        <td rowspan="2" align="center">DESCRIPTION</td>
        <td rowspan="2" align="center" class="borderkirikanan">QTY</td>
        <td colspan="2" align="center" class="borderkirikanan" style="border-right:3px solid black; border-left:3px solid black;">AMOUNT</td>
        <td rowspan="2" align="center" class="borderkirikanan">TOTAL AMOUNT </td>
      </tr>
      <tr class="border_bottom">
        <td align="center" class="borderkirikanan">USD</td>
        <td align="center" class="borderkirikanan">IDR</td>
        </tr><?php
		$toti=$totall=$totusd=$totrp=0;
		foreach($detail as $isi){ $toti++; ?>
      <tr>
        <td valign="top"><?php echo $isi['desc']?><?php echo $toti==count($detail)?'<div id="sepDiv"></div>':''; ?></td>
        <td align="right" valign="top" class="borderkirikanan"><?php echo $isi['qty'];?></td>
        <td align="right" valign="top" class="borderkirikanan"><?php echo uang($isi['usd'])?></td>
        <td align="right" valign="top" class="borderkirikanan"><?php echo uang($isi['idr'])?></td>
        <td align="right" valign="top" class="borderkirikanan"><?php echo uang($isi['total'])?></td>
      </tr>
		<?php
		$totrp+=$isi['idr'];
		$totusd+=$isi['usd'];
		$totall+=$isi['total'];
		} ?>
      <tr class="border_top_bold border_bottom">
        <td>TOTAL AMOUNT </td>
        <td>&nbsp;</td>
        <td align="right" class="borderkirikanan"><?php echo uang($totusd)?></td>
        <td align="right" class="borderkirikanan"><?php echo uang($totrp)?></td>
        <td align="right"  class="borderkirikanan"><?php echo uang($totall)?></td>
      </tr>
    </table></td>
  </tr>
</table>
<p>*Exchange rate subject to-date of payment</br>
*Our invoice are payable cash  in full amount to PT ECSI INDONESIA by the indicated due date</br>
*If any discrepency kindly contact us within 7 days in writing from the days of invoices</p>
<p>Account No.   </p>
<table width="70%" border="0" cellspacing="0" class="noatm">
  
  <tr>
    <td><p>BANK BCA MATRAMAN</p>    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr><tr>
    <td width="50%">PT. ECSI INDONESIA</td>
    <td width="25%">&nbsp;</td>
    <td width="13%">&nbsp;</td>
    <td width="15%">&nbsp;</td>
  </tr>
  <tr>
    <td><p>USD Account No </p>    </td>
    <td>342-3390-898</td>
    <td width="70%" >Swift Code </td>
    <td>CENAIDJA</td>
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
    <td colspan="2">BANK MANDIRI KCP LATUMENTEN </td>
  </tr>
  <tr>
    <td>PT. ECSI INDONESIA</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>USD Account No </td>
    <td>117-00-0623729-1</td>
    <td width="70%">Swift Code </td>
    <td>BMRIIDJA</td>
  </tr>
  <tr>
    <td>IDR Account No </td>
    <td>117-00-1422013-1</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p><div class="footer">
<table width="20%" border="0" cellspacing="0" style="float:right; bottom:0px;" class="footer">
  
  <tr class="border_top">
    <td align="center" style="font-size:11pt">Authorized Signature</td>
  </tr>
</table>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
