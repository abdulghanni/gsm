<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
    <?php // print_mz($sum) ?>
<table border="1" cellpadding="2" cellspacing="0">
  <col width="50">
  <col width="60">
  <col width="300">
  <col width="33">
  <col width="105">
  <col width="101">
  <col width="106">
  <col width="105">
  <col width="100" span="2">
  <tr>
    <td colspan="2">DAFTAR AKUN</td>
    <td width="320"></td>
    <td width="33"></td>
    <td colspan="2" align="center">NSD</td>
    <td colspan="2" align="center">LABA RUGI</td>
    <td colspan="2" align="center">NERACA</td>
  </tr>
  <tr>
    <td colspan="2">NO    AKUN </td>
    <td></td>
    <td align="center">POS</td>
    <td width="104">DEBET </td>
    <td width="104">KREDIT</td>
    <td width="98">DEBET </td>
    <td width="97">KREDIT</td>
    <td width="103">DEBET </td>
    <td width="109">KREDIT</td>
  </tr>
  <?php
  
	$totaldebitneraca=0;
	$totalkreditneraca=0;
   foreach($ref_coa as $ref){?>
  <tr>
    <td width="35" align="right"><?php echo $ref['code']?></td>
    <td colspan="2"><?php echo $ref['name']?></td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  	<?php $subklas=$this->db->query("SELECT * FROM sv_setup_coa WHERE SUBSTRING(code,1,1)='".$ref['id']."' ORDER BY code ASC")->result_array();
	foreach($subklas as $sk){
	?>
  	<tr>
    	<td></td>
    	<td><?php echo $sk['code'] ?></td>
    	<td><?php echo $sk['name'] ?></td>
    	<td align="center"><?php echo $sk['type'] ?></td>
    	<td align="right"><?php echo (isset($sum[$sk['id']]['debit']['debit'])? uang($sum[$sk['id']]['debit']['debit']):'')?></td>
    	<td><?php echo  (isset($sum[$sk['id']]['kredit']['kredit']) ? uang($sum[$sk['id']]['kredit']['kredit']):'')?></td>
    	<td></td>
    	<td></td>
    	<td align="right"><?php echo (isset($sum[$sk['id']]['debit']['debit'])? uang($sum[$sk['id']]['debit']['debit']):'')?></td>
    	<td><?php echo  (isset($sum[$sk['id']]['kredit']['kredit']) ? uang($sum[$sk['id']]['kredit']['kredit']):'')?></td>
  	</tr>
  	<?php
			$totaldebitneraca+=(isset($sum[$sk['id']]['debit']['debit'])? $sum[$sk['id']]['debit']['debit']:0);
			$totalkreditneraca+=(isset($sum[$sk['id']]['kredit']['kredit']) ? $sum[$sk['id']]['kredit']['kredit']:0);
	 }?>
  <?php } ?> 
 
  <tr>
    <td width="35">&nbsp;</td>
    <td width="131">&nbsp;</td>
    <td width="320">&nbsp;</td>
    <td width="33">&nbsp;</td>
    <td align="right" width="104">&nbsp;</td>
    <td align="right" width="104">&nbsp;</td>
    <td align="right" width="98">&nbsp;</td>
    <td align="right" width="97">&nbsp;</td>
    <td align="right" width="103">&nbsp;</td>
    <td align="right" width="109">&nbsp;</td>
  </tr>
  <tr>
    <td width="35"></td>
    <td width="131"></td>
    <td width="320"></td>
    <td width="33"></td>
    <td align="right" width="104">0<!--NSD debit--></td>
    <td align="right" width="104">0<!--NSD KRedit--></td>
    <td align="right" width="98">0<!-- Laba Rugi debit--></td>
    <td align="right" width="97">0<!-- Laba Rugi kredit--></td>
    <td align="right" width="103"><?php echo uang($totaldebitneraca) ?></td>
    <td align="right" width="109"><?php echo uang($totalkreditneraca) ?></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">0<!--Selisih NSD = NSD debit - NSD Kredit--></td>
    <td align="right">0<!--Selisih LR = Laba Rugi debit - Laba Rugi Kredit--></td>
    <td></td>
    <td></td>
    <td align="right">0<!--Selisih Neraca = Neraca debit - Neraca Kredit--></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">0<!--NSD debit--></td>
    <td align="right">0<!--NSD kredit - Selisih NSD--></td>
    <td align="right">0<!-- Laba Rugi debit - Selisih LR --></td>
    <td align="right">0<!-- Laba Rugi kredit--></td>
    <td align="right">0<!--Neraca debit--></td>
    <td align="right">0<!-- Neraca Kredit - Selisih Neraca--></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>BUNGA</td>
    <td>PAJAK</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>MANDIRI TAB</td>
    <td></td>
    <td></td>
    <td align="right">0</td>
    <td align="right">0</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>MANDIRI GIRO</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>CIMB USD</td>
    <td></td>
    <td></td>
    <td align="right">0</td>
    <td align="right">0</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">0<!--Total Bunga--></td>
    <td align="right">0<!--Total Pajak--></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>