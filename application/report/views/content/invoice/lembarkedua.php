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
    <td colspan="3"><div align="center"><h2><strong>PROFORMA INVOICE ECSI INDONESIA, PT </strong></h2></div></td>
  </tr>
  <tr>
    <td width="34%">&nbsp;</td>
    <td width="34%">&nbsp;</td>
    <td width="32%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0" align="center" cellspacing="0" class="invoices">
      <tr class="border_bottom border_top_bold">
        <td width="9%" align="center">Request Date Arrival </td>
        <td width="9%" align="center">Shipper</td>
        <td width="9%" align="center">Location </td>
        <td width="7%" align="center">Vehicle Type  </td>
        <td width="4%" align="center" class="borderkirikanan">#of Truck </td>
        <td width="7%" align="center" class="borderkirikanan">Booking Confirmation No </td>
        <td width="9%" align="center" class="borderkirikanan">Week</td>
        <td width="8%" align="center" class="borderkirikanan" style="border-right:3px solid black; border-left:3px solid black;">Subcont</td>
        <td width="8%" align="center" class="borderkirikanan" style="border-right:3px solid black; border-left:3px solid black;">Vehicle # </td>
        <td width="5%" align="center" class="borderkirikanan">Trucking Charge  </td>
        <td width="5%" align="center" class="borderkirikanan">Overtime Charge </td>
        <td width="5%" align="center" class="borderkirikanan">Overnight Charge </td>
        <td width="4%" align="center" class="borderkirikanan">Total Charge </td>
        <td width="11%" align="center" class="borderkirikanan">Remark</td>
      </tr>
      <?php
		$totrp=0;
		$totusd=0;
		$all=0;
		$jo='';
		foreach($detail as $isi){
			if($jo!=$isi['jo']){
				$qdetail=$this->db->query("SELECT * FROM sv_trucking_order WHERE number='".$isi['jo']."'")->row_array();
				$vno=(GetValue('code','master_truck',array('id'=>'where/'.$qdetail['vehicle_no']))=='0' ? $qdetail['vehicle_no'] : GetValue('code','master_truck',array('id'=>'where/'.$qdetail['vehicle_no'])));
			$charging=$this->db->query("SELECT SUM(idr) as idr FROM sv_invoice_detail WHERE jo='".$isi['jo']."' AND invoice='".$sum['number']."' ")->row_array();
			//lastq();
		?>
      <tr>
        <td ><?php echo tglindo($qdetail['request_date'])?></td>
        <td class="borderkirikanan" ><?php echo GetValue('name','sv_master_client',array('id'=>'where/'.$qdetail['messers']))?></td>
        <td class="borderkirikanan" ><?php echo $qdetail['unloading']?></td>
        <td align="left" class="borderkirikanan"><?php echo GetValue('name','sv_master_trucking',array('id'=>'where/'.$qdetail['service']))?></td>
        <td align="right" class="borderkirikanan">1</td>
        <td align="right" class="borderkirikanan"></td>
        <td align="right" class="borderkirikanan"></td>
        <td align="right" class="borderkirikanan"></td>
        <td align="right" class="borderkirikanan"><?php echo $vno;?></td>
        <td align="right" class="borderkirikanan"><?php echo uang($charging['idr'])?></td>
        <td align="right" class="borderkirikanan">0</td>
        <td align="right" class="borderkirikanan">0</td>
        <td align="right" class="borderkirikanan"><?php echo uang($charging['idr'])?></td>
        <td align="right" class="borderkirikanan">&nbsp;</td>
      </tr>
		<?php
		
		$totrp+=$charging['idr'];

		} ?>
		<?php
		$totusd+=$isi['usd'];
		$jo=$isi['jo'];
		$all+=$isi['total'];
		} ?>
      <tr class="border_top_bold border_bottom">
        <td colspan="3">TOTAL AMOUNT </td>
        <td colspan="4">&nbsp;</td>
        <td align="right" class="borderkirikanan"></td>
        <td align="right" class="borderkirikanan"></td>
        <td align="right" class="borderkirikanan"><?php echo uang($totrp)?></td>
        <td align="right" class="borderkirikanan">0</td>
        <td align="right" class="borderkirikanan">0</td>
        <td align="right" class="borderkirikanan"><?php echo uang($all)?></td>
        <td align="right" class="borderkirikanan">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="20%" border="0" cellspacing="0" style="float:right;">
  
  <tr class="border_top">
    <td align="center">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
