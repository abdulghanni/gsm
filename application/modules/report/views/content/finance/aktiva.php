<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<table cellspacing="0" cellpadding="2">
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
    <td colspan="2">&nbsp;</td>
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
    <td rowspan="3">No.</td>
    <td rowspan="3">Jenis Harta</td>
    <td rowspan="3">Unit</td>
    <td rowspan="3">Thn</td>
    <td rowspan="3" width="100">Harga Perolehan</td>
    <td rowspan="3" width="101">Umur Ekonomis</td>
    <td rowspan="3" width="100">Penyusutan</td>
    <td rowspan="3" width="102">Akm. Penyusutan </td>
    <td rowspan="3" width="115">Nilai Buku</td>
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
  foreach($kantor as $ka){ ?>
  <tr>
    <td><?php echo $a;?></td>
    <td><?php echo $ka['title'];?> </td>
    <td><?php echo $ka['unit'];?></td>
    <td><?php echo date('d/m/Y',strtotime($ka['tgl_beli']));?></td>
    <td align="right"><?php echo $ka['harga_beli'];?></td>
    <td><?php echo $ka['umur_ekonomis'];?></td>
    <td align="right"><?php echo $ka['beban_perbulan'];?></td>
    <td align="right"><?php echo $ka['akumulasi'];?></td>
    <td align="right"><?php echo $ka['nilai_buku'];?></td>
  </tr>
  <?php $a++; }?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">723.031.095</td>
    <td>&nbsp;</td>
    <td align="right">137.199.354</td>
    <td align="right">176.274.410</td>
    <td align="right">546.756.685</td>
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
  foreach($kendaraan as $ka){ ?>
  <tr>
    <td><?php echo $a;?></td>
    <td><?php echo $ka['title'];?> </td>
    <td><?php echo $ka['unit'];?></td>
    <td><?php echo date('d/m/Y',strtotime($ka['tgl_beli']));?></td>
    <td align="right"><?php echo $ka['harga_beli'];?></td>
    <td><?php echo $ka['umur_ekonomis'];?></td>
    <td align="right"><?php echo $ka['beban_perbulan'];?></td>
    <td align="right"><?php echo $ka['akumulasi'];?></td>
    <td align="right"><?php echo $ka['nilai_buku'];?></td>
  </tr>
  <?php $a++; }?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">643.403.128</td>
    <td>&nbsp;</td>
    <td align="right">78.612.891</td>
    <td align="right">21.051.074</td>
    <td align="right">622.352.054</td>
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
  foreach($gedung as $ka){ ?>
  <tr>
    <td><?php echo $a;?></td>
    <td><?php echo $ka['title'];?> </td>
    <td><?php echo $ka['unit'];?></td>
    <td><?php echo date('d/m/Y',strtotime($ka['tgl_beli']));?></td>
    <td align="right"><?php echo $ka['harga_beli'];?></td>
    <td><?php echo $ka['umur_ekonomis'];?></td>
    <td align="right"><?php echo $ka['beban_perbulan'];?></td>
    <td align="right"><?php echo $ka['akumulasi'];?></td>
    <td align="right"><?php echo $ka['nilai_buku'];?></td>
  </tr>
  <?php $a++; }?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">5.277.317.515</td>
    <td>&nbsp;</td>
    <td align="right">180.949.209</td>
    <td align="right">15.079.101</td>
    <td align="right">3.662.238.414</td>
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
    <td align="right">6.643.751.738</td>
    <td>&nbsp;</td>
    <td align="right">396.761.454</td>
    <td align="right">212.404.585</td>
    <td align="right">4.831.347.153</td>
  </tr>
</table>
</body>
</html>