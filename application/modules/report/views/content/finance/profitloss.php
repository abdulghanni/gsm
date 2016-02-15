<center>
<h2>Profit and Loss</h2>
</center>
<span style="float:right;"><?php echo GetMonth((int)$periode[1]).' '.(int)$periode[0]?></span>
<table width="100%" border="1" cellspacing="0">
  <tr class="theader">
    <td width="9%">No</td>
    <td width="61%">Account</td>
    <td width="14%">&nbsp;</td>
    <td width="16%">Saldo</td>
  </tr>
  <tr>
    <td colspan="4"><strong>INCOME</strong></td>
  </tr><?php
$a=1;
$totun=0;
  foreach ($profit as $untung){ 
  if($divisi!=NULL || $divisi != ''){$where2="AND sv_jurnal.ref LIKE '%$divisi%' ";}
  else{$where2='';}
  $l=$this->db->query("SELECT SUM(".$untung['transaksi'].") as untung FROM sv_jurnal_detail LEFT JOIN sv_jurnal ON sv_jurnal_detail.id_jur=sv_jurnal.id WHERE MONTH(sv_jurnal.post_tgl)='".$periode[1]."' AND  YEAR(sv_jurnal.post_tgl)='".$periode[0]."' AND sv_jurnal_detail.akun='".$untung['coa']."'   ".$where2)->row_array();
  $laba=$l['untung'];
  $totun+=$laba;
  ?>
  <tr>
    <td><?php echo $a?></td>
    <td><?php echo $untung['title'] ?></td>
    <td>&nbsp;</td>
    <td>Rp <?php echo uang($laba);?></td>
  </tr><?php $a++; } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total</td>
    <td>Rp <?php echo uang($totun)?></td>
  </tr>
  <tr>
    <td colspan="4"><strong>EXPENSE</strong></td>
  </tr><?php
 // print_mz($loss);
$b=1;
$totrug=0;
  foreach ($loss as $rugi){ 
  if($divisi!=NULL || $divisi != ''){$where2="AND  sv_jurnal.ref LIKE '%$divisi%' ";}
  else{$where2='';}
  $l=$this->db->query("SELECT SUM(".$rugi['transaksi'].") as rugi FROM sv_jurnal_detail LEFT JOIN sv_jurnal ON sv_jurnal_detail.id_jur=sv_jurnal.id WHERE MONTH(sv_jurnal.post_tgl)='".$periode[1]."' AND  YEAR(sv_jurnal.post_tgl)='".$periode[0]."' AND sv_jurnal_detail.akun='".$rugi['coa']."' ".$where2)->row_array();
  $rugis=$l['rugi'];
  $totrug+=$rugis;?>
  <tr>
    <td><?php echo $b?></td>
    <td><?php echo $rugi['title']?></td>
    <td>&nbsp;</td>
    <td>Rp <?php echo uang($rugis);?></td>
  </tr><?php 
  $b++;}
$profit=$totun-$totrug;
$percentage=round(($profit/$totun)*100);
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total</td>
    <td>Rp <?php echo uang($totrug);?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total Profit </td>
    <td>Rp <?php echo uang($profit)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total Profit Percent </td>
    <td><?php echo $percentage?> %</td>
  </tr>
</table>
