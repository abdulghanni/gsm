<table width="100%" border="0" cellspacing="0">
  <tr>
    <td width="25%">&nbsp;</td>
    <td width="50%"><div align="center"><strong>Laporan Jurnal </strong></div></td>
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
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="1" cellspacing="0">
  <tr class="theader">
    <td>Ref</td>
    <td>Post Tgl </td>
    <td>Doc Tgl </td>
    <td>Ket</td>
    <td>Job Number</td>
    <td>Rincian</td>
    <td>Akun</td>
    <td>Debit</td>
    <td>Kredit</td>
    <td>Real Value</td>
    <td>Real Currency</td>
    <td>Remark</td>
  </tr>
  <?php
	$totdeb=$totkred=$totrv=0;
  foreach($isi as $rin) {?>
  <tr>
    <td><?php echo $rin['ref']?></td>
    <td><?php echo tglindo($rin['post_tgl'])?></td>
    <td><?php echo tglindo($rin['doc_tgl'])?></td>
    <td><?php echo $rin['ket']?></td>
    <td><?php echo $rin['voucher']?></td>
    <td><?php echo $rin['rincian']?></td>
    <td><?php echo $rin['akun'].'-'.GetValue('name','sv_setup_coa',array('code'=>'where/'.$rin['akun']))?></td>
    <td><?php echo uang($rin['debit'])?></td>
    <td><?php echo uang($rin['kredit'])?></td>
    <td><?php echo uang($rin['rv'])?></td>
    <td><?php echo $a=(GetValue('code','master_currency',array('id'=>'where/'.$rin['rc']))=='0' ? '' : GetValue('code','master_currency',array('id'=>'where/'.$rin['rc'])))?></td>
    <td><?php echo $rin['remark']?></td>
  </tr><?php
	$totdeb+=$rin['debit'];
	$totkred+=$rin['kredit'];
//	$totrv+=$rin['rv'];
  } ?>
  <tr>
  <td colspan='7'><strong>TOTAL</strong></td>
  <td><strong><?php echo uang($totdeb)?></strong></td>
  <td><strong><?php echo uang($totkred)?></strong></td>
  <!--td><?php echo uang($totrv)?></td-->
  <td colspan='3'></td>
  </tr>
</table>
<p>&nbsp;</p>
