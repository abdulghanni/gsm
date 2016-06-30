<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php 

		//$beli=$_POST['tanggal_beli'];
		$perhitungan=date('Y-m-d',strtotime('last day of last month'));
		
	
	?>
<body>
<table cellspacing="0" cellpadding="2" width="100%">
  <col width="28">
  <col width="284">
  <col width="33">
  <col width="62">
  <col width="100">
  <col width="101">
  <col width="100">
  <col width="102">
  <col width="115">
  <tr>
    <td colspan="2" width="312">PT. GRAMASELINDO UTAMA</td>
    <td width="33"></td>
    <td width="62"></td>
    <td width="100"></td>
    <td width="101"></td>
    <td width="100"></td>
    <td width="102"></td>
    <td width="115">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">DAFTAR    RINCIAN AKTIVA TETAP</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2">Terhitung Tanggal <?php echo date('d/m/Y',strtotime($perhitungan));?></td>
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
    <td width="284"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td rowspan="3" align="center">No.</td>
    <td rowspan="3" align="center">Jenis Harta</td>
    <td rowspan="3" align="center">Unit</td>
    <td rowspan="3" align="center">Thn</td>
    <td width="100" rowspan="3" align="center">Harga Perolehan</td>
    <td width="101" rowspan="3" align="center">Umur Ekonomis</td>
    <td width="100" rowspan="3" align="center">Penyusutan</td>
    <td width="102" rowspan="3" align="center">Akm. Penyusutan </td>
    <td width="115" rowspan="3" align="center">Nilai Buku</td>
  </tr>
  <tr> </tr>
  <tr> </tr>
  <tr>
    <td>&nbsp;</td>
    <td>INVENTARIS KANTOR</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php $a=1;
  $perolehan=$beban=$akumulasi=$nilai_buku=0;
  foreach($kantor as $ka){
	  $s=strtotime($perhitungan)-strtotime($ka['tgl_beli']);
	  $terhitung=floor($s/(30*24*60*60));
	  if($terhitung==0 || $terhitung<0)$terhitung=1;
	  $sat_beban=($ka['harga_beli']-$ka['nilai_residu'])/$ka['umur_ekonomis'];
	  $sat_akumulasi=$sat_beban*$terhitung;
	  if($sat_akumulasi>$ka['harga_beli'])$sat_akumulasi=$ka['harga_beli'];
	  $sat_buku=$ka['harga_beli']-$sat_akumulasi;
	  if($sat_buku<0)$sat_buku=0;
	   ?>
  <tr>
    <td><?php echo $a;?></td>
    <td><?php echo $ka['title'];?> </td>
    <td><?php echo $ka['unit'];?></td>
    <td><?php echo date('d/m/Y',strtotime($ka['tgl_beli']));?></td>
    <td align="right"><?php echo uang($ka['harga_beli']);?></td>
    <td align="center"><?php echo $ka['umur_ekonomis'];?></td>
    <td align="right"><?php echo uang($sat_beban);?></td>
    <td align="right"><?php echo  uang($sat_akumulasi);?></td>
    <td align="right"><?php echo uang($sat_buku);?></td>
  </tr>
  <?php $a++;
  		$perolehan+=$ka['harga_beli'];
		$beban+=$sat_beban;
		$akumulasi+=$sat_akumulasi;
		$nilai_buku+=$sat_buku;
		
   }?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><?php echo uang($perolehan)?></td>
    <td>&nbsp;</td>
    <td align="right"><?php echo uang($beban)?></td>
    <td align="right"><?php echo uang($akumulasi)?></td>
    <td align="right"><?php echo uang($nilai_buku)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>KENDARAAN</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php $a=1;
  $kperolehan=$kbeban=$kakumulasi=$knilai_buku=0;
  foreach($kendaraan as $ka){
	  
	  $s=strtotime($perhitungan)-strtotime($ka['tgl_beli']);
	  $terhitung=floor($s/(30*24*60*60));
	  if($terhitung==0 || $terhitung<0)$terhitung=1;
	  $sat_beban=($ka['harga_beli']-$ka['nilai_residu'])/$ka['umur_ekonomis'];
	  $sat_akumulasi=$sat_beban*$terhitung;
	  if($sat_akumulasi>$ka['harga_beli'])$sat_akumulasi=$ka['harga_beli'];
	  $sat_buku=$ka['harga_beli']-$sat_akumulasi;
	  if($sat_buku<0)$sat_buku=0;
	  
	   ?>
  <tr>
    <td><?php echo $a;?></td>
    <td><?php echo $ka['title'];?> </td>
    <td><?php echo $ka['unit'];?></td>
    <td><?php echo date('d/m/Y',strtotime($ka['tgl_beli']));?></td>
    <td align="right"><?php echo uang($ka['harga_beli']);?></td>
    <td align="center"><?php echo $ka['umur_ekonomis'];?></td>
    <td align="right"><?php echo uang($sat_beban);?></td>
    <td align="right"><?php echo  uang($sat_akumulasi);?></td>
    <td align="right"><?php echo uang($sat_buku);?></td>
  </tr>
  <?php $a++;
  		$kperolehan+=$ka['harga_beli'];
		$kbeban+=$sat_beban;
		$kakumulasi+=$sat_akumulasi;
		$knilai_buku+=$sat_buku;
   }?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><?php echo uang($kperolehan)?></td>
    <td>&nbsp;</td>
    <td align="right"><?php echo uang($kbeban)?></td>
    <td align="right"><?php echo uang($kakumulasi)?></td>
    <td align="right"><?php echo uang($knilai_buku)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>RENOVASI GEDUNG</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php $a=1;
  $gperolehan=$gbeban=$gakumulasi=$gnilai_buku=0;
  foreach($gedung as $ka){
	  $s=strtotime($perhitungan)-strtotime($ka['tgl_beli']);
	  $terhitung=floor($s/(30*24*60*60));
	  if($terhitung==0 || $terhitung<0)$terhitung=1;
	  $sat_beban=($ka['harga_beli']-$ka['nilai_residu'])/$ka['umur_ekonomis'];
	  $sat_akumulasi=$sat_beban*$terhitung;
	  if($sat_akumulasi>$ka['harga_beli'])$sat_akumulasi=$ka['harga_beli'];
	  $sat_buku=$ka['harga_beli']-$sat_akumulasi;
	  if($sat_buku<0)$sat_buku=0; ?>
  <tr>
    <td><?php echo $a;?></td>
    <td><?php echo $ka['title'];?> </td>
    <td><?php echo $ka['unit'];?></td>
    <td><?php echo date('d/m/Y',strtotime($ka['tgl_beli']));?></td>
    <td align="right"><?php echo uang($ka['harga_beli']);?></td>
    <td align="center"><?php echo $ka['umur_ekonomis'];?></td>
    <td align="right"><?php echo uang($sat_beban);?></td>
    <td align="right"><?php echo  uang($sat_akumulasi);?></td>
    <td align="right"><?php echo uang($sat_buku);?></td>
  </tr>
  <?php $a++;
  		$gperolehan+=$ka['harga_beli'];
		$gbeban+=$sat_beban;
		$gakumulasi+=$sat_akumulasi;
		$gnilai_buku+=$sat_buku;
   }?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><?php echo uang($gperolehan)?></td>
    <td>&nbsp;</td>
    <td align="right"><?php echo uang($gbeban)?></td>
    <td align="right"><?php echo uang($gakumulasi)?></td>
    <td align="right"><?php echo uang($gnilai_buku)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">TOTAL</td>
    <td align="right"><?php echo uang($perolehan+$kperolehan+$gperolehan);?></td>
    <td>&nbsp;</td>
    <td align="right"><?php echo uang($beban+$kbeban+$gbeban);?></td>
    <td align="right"><?php echo uang($akumulasi+$kakumulasi+$gakumulasi);?></td>
    <td align="right"><?php echo uang($nilai_buku+$knilai_buku+$gnilai_buku);?></td>
  </tr>
</table>
</body>
</html>