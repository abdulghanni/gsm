<table width="100%" border="0" cellspacing="0">
  <tr>
    <td width="25%">&nbsp;</td>
    <td width="50%"><div align="center"><strong>Laporan Petty </strong></div></td>
    <td width="25%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Periode : <?php echo GetMonth((int)substr($periode,5,2)).' '.(int)substr($periode,0,4)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>From : <?php echo $this->input->post('from');?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="1" cellspacing="0">
  <tr class="theader">
    <!--td>Code </td-->
    <td rowspan='2'>Akun</td>
    <td rowspan='2'>Date</td>
    <td rowspan='2'>No. Voucher</td>
    <td rowspan='2'>Person</td>
    <td rowspan='2'>Remark</td>
    <td rowspan='2'>Job Number</td>
    <td colspan="2" align="center">Amount IDR</td>
    <td rowspan='2'>Saldo</td>
  </tr>
  <tr class="theader">
	<td align="center">In</td>
	<td align="center">Out</td>
  </tr>
  <?php 
  $totin=$totout=0;
  $idr_skrg=$sebelum_idr;
  foreach($isi_idr as $rin) {?>
  <tr>
    <!--td><?php echo $rin['number']?></td-->
    <td><?php echo $rin['coa'].'-'.GetValue('name','sv_setup_coa',array('code'=>'where/'.$rin['coa']))?></td>
    <td><?php echo tglindo($rin['dates'])?></td>
    <td><?php echo $rin['ref']?></td>
    <td><?php echo $rin['person']?></td>
    <td><?php echo $rin['remark']?></td>
    <td><?php echo $rin['job_number']?></td>
    <td><?php echo uang($in=($rin['save_type']=='in' ? $rin['amount'] : 0))?></td>
    <td><?php echo uang($out=($rin['save_type']=='out' ? $rin['amount'] : 0))?></td>
    <td><?php echo uang($idr_skrg=$idr_skrg+$in-$out);?></td>
  </tr><?php
	$totin+=$in;
	$totout+=$out;
  } ?>
  <tr>
  <td colspan="6"><strong>Total</strong></td>
  <td><strong><?php echo uang($totin)?></strong></td>
  <td><strong><?php echo uang($totout)?></strong></td>
  <td><strong><?php echo uang($idr_skrg)?></strong></td>
  </tr>
</table>
<p>&nbsp;</p>

<table width="100%" border="1" cellspacing="0">
  <tr class="theader">
    <!--td>Code </td-->
    <td rowspan='2'>Akun</td>
    <td rowspan='2'>Date</td>
    <td rowspan='2'>No. Voucher</td>
    <td rowspan='2'>Person</td>
    <td rowspan='2'>Remark</td>
    <td rowspan='2'>Job Number</td>
    <td colspan="2" align="center">Amount USD</td>
    <td rowspan='2'>Saldo</td>
  </tr>
  <tr class="theader">
	<td align="center">In</td>
	<td align="center">Out</td>
  </tr>
  <?php 
  $totin=$totout=0;
  $usd_skrg=$sebelum_usd;
  foreach($isi_usd as $rin) {?>
  <tr>
    <!--td><?php echo $rin['number']?></td-->
    <td><?php echo $rin['coa'].'-'.GetValue('name','sv_setup_coa',array('code'=>'where/'.$rin['coa']))?></td>
    <td><?php echo tglindo($rin['dates'])?></td>
    <td><?php echo $rin['ref']?></td>
    <td><?php echo $rin['person']?></td>
    <td><?php echo $rin['remark']?></td>
    <td><?php echo $rin['job_number']?></td>
    <td><?php echo Decimal($in=($rin['save_type']=='in' ? $rin['rv'] : 0))?></td>
    <td><?php echo Decimal($out=($rin['save_type']=='out' ? $rin['rv'] : 0))?></td>
    <td><?php echo Decimal($usd_skrg=$idr_skrg+$in-$out);?></td>
  </tr><?php
	$totin+=$in;
	$totout+=$out;
  } ?>
  <tr>
  <td colspan="6"><strong>Total</strong></td>
  <td><strong><?php echo Decimal($totin)?></strong></td>
  <td><strong><?php echo Decimal($totout)?></strong></td>
  <td><strong><?php echo Decimal($usd_skrg)?></strong></td>
  </tr>
</table>