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
    <td colspan="4"><strong>AKTIVA LANCAR : </strong></td>
  </tr><?php
$a=1;
$aktiva1=0;
  foreach ($profit1 as $untung){ 
  $l=$this->db->query("SELECT SUM(".$untung['transaksi'].") as untung FROM sv_jurnal_detail LEFT JOIN sv_jurnal ON sv_jurnal_detail.id_jur=sv_jurnal.id WHERE MONTH(sv_jurnal.post_tgl)='".$periode[1]."' AND  YEAR(sv_jurnal.post_tgl)='".$periode[0]."' AND sv_jurnal_detail.akun='".$untung['coa']."'   ")->row_array();
  $aktiva1=$l['untung'];
  $totaktiva1+=$aktiva1;
  ?>
  <tr>
    <td><?php echo $a?></td>
    <td><?php echo $untung['title'] ?></td>
    <td>&nbsp;</td>
    <td>Rp <?php echo uang($aktiva1);?></td>
  </tr><?php $a++; } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total</td>
    <td>Rp <?php echo uang($totaktiva1)?></td>
  </tr>
  <tr> <tr>
    <td colspan="4"><strong>AKTIVA TETAP : </strong></td>
  </tr><?php
$a=1;
$aktiva2=0;
  foreach ($profit2 as $untung){ 
  $l=$this->db->query("SELECT SUM(".$untung['transaksi'].") as untung FROM sv_jurnal_detail LEFT JOIN sv_jurnal ON sv_jurnal_detail.id_jur=sv_jurnal.id WHERE MONTH(sv_jurnal.post_tgl)='".$periode[1]."' AND  YEAR(sv_jurnal.post_tgl)='".$periode[0]."' AND sv_jurnal_detail.akun='".$untung['coa']."'   ")->row_array();
  $aktiva2=$l['untung'];
  $totaktiva2+=$aktiva2;
  ?>
  <tr>
    <td><?php echo $a?></td>
    <td><?php echo $untung['title'] ?></td>
    <td>&nbsp;</td>
    <td>Rp <?php echo uang($aktiva2);?></td>
  </tr><?php $a++; } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total</td>
    <td>Rp <?php echo uang($totaktiva2)?></td>
  </tr>
  <tr>
    <td colspan="4"><strong>KEWAJIBAN</strong></td>
  </tr><?php
 // print_mz($loss);
$b=1;
$totob1=0;
  foreach ($loss1 as $rugi){ 
  $l=$this->db->query("SELECT SUM(".$rugi['transaksi'].") as rugi FROM sv_jurnal_detail LEFT JOIN sv_jurnal ON sv_jurnal_detail.id_jur=sv_jurnal.id WHERE MONTH(sv_jurnal.post_tgl)='".$periode[1]."' AND  YEAR(sv_jurnal.post_tgl)='".$periode[0]."' AND sv_jurnal_detail.akun='".$rugi['coa']."'  ")->row_array();
  $ob=$l['rugi'];
  $totob1+=$ob;?>
  <tr>
    <td><?php echo $b?></td>
    <td><?php echo $rugi['title']?></td>
    <td>&nbsp;</td>
    <td>Rp <?php echo uang($ob);?></td>
  </tr><?php 
  $b++;}
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total</td>
    <td>Rp <?php echo uang($totob1);?></td>
  </tr>
  <tr>
    <td colspan="4"><strong>EKUITAS</strong></td>
  </tr><?php
 // print_mz($loss);
$b=1;
$totob2=0;
  foreach ($loss2 as $rugi){ 
  $l=$this->db->query("SELECT SUM(".$rugi['transaksi'].") as rugi FROM sv_jurnal_detail LEFT JOIN sv_jurnal ON sv_jurnal_detail.id_jur=sv_jurnal.id WHERE MONTH(sv_jurnal.post_tgl)='".$periode[1]."' AND  YEAR(sv_jurnal.post_tgl)='".$periode[0]."' AND sv_jurnal_detail.akun='".$rugi['coa']."'  ")->row_array();
  $ob2=$l['rugi'];
  $totob2+=$ob2;?>
  <tr>
    <td><?php echo $b?></td>
    <td><?php echo $rugi['title']?></td>
    <td>&nbsp;</td>
    <td>Rp <?php echo uang($ob2);?></td>
  </tr><?php 
  $b++;}
//$profit=$totun-$totrug;
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total</td>
    <td>Rp <?php echo uang($totob2);?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total Asset </td>
    <td>Rp <?php echo uang($totaktiva1+$totaktiva2)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total Obligation and Equity</td>
    <td><?php echo uang($totob1+$totob2)?> </td>
  </tr>
</table>
