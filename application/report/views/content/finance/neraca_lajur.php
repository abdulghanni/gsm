<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
    <?php // print_mz($sum) ?>
<table border="1" cellpadding="0" cellspacing="0">
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
    <td width="330"></td>
    <td width="33"></td>
    <td colspan="2" align="center">NSD</td>
    <td colspan="2" align="center">LABA RUGI</td>
    <td colspan="2" align="center">NERACA</td>
  </tr>
  <tr>
    <td colspan="2">NO    AKUN </td>
    <td></td>
    <td align="center">POS</td>
    <td width="105">DEBET </td>
    <td width="101">KREDIT</td>
    <td width="106">DEBET </td>
    <td width="105">KREDIT</td>
    <td width="100">DEBET </td>
    <td width="100">KREDIT</td>
  </tr>
  <tr>
    <td width="44" align="right">100</td>
    <td width="86">AKTIVA</td>
    <td></td>
    <td align="center"></td>
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
    <td>KAS </td>
    <td align="center">D</td>
    <td align="right"><?php echo (isset($sum['1']['debit'])? uang($sum['1']['debit']['debit']):'')?></td>
    <td><?php echo (isset($sum['1']['kredit']) ? uang($sum['1']['kredit']['kredit']):'')?></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>KAS KENARI LT 2 </td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>KAS KENARI LT 3 </td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>KAS BANDUNG</td>
    <td align="center">D</td>
    <td align="right"><?php echo (isset($sum['2']['debit'])? uang($sum['2']['debit']['debit']):'')?></td>
    <td><?php echo (isset($sum['2']['kredit']) ? uang($sum['2']['kredit']['kredit']):'')?></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>BANK CIMB NIAGA (USD)</td>
    <td align="center">D</td>
    <td align="right"><?php echo (isset($sum['3']['debit'])? uang($sum['3']['debit']['debit']):'')?></td>
    <td><?php echo (isset($sum['3']['kredit']) ? uang($sum['3']['kredit']['kredit']):'')?></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>BANK CIMB NIAGA (IDR)</td>
    <td align="center">D</td>
    <td align="right"><?php echo (isset($sum['4']['debit'])? uang($sum['3']['debit']['debit']):'')?></td>
    <td><?php echo (isset($sum['4']['kredit']) ? uang($sum['3']['kredit']['kredit']):'')?></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>BANK MANDIRI GIRO</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>BANK MANDIRI TABUNGAN</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>BANK BRI </td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PIUTANG USAHA</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PIUTANG KARYAWAN</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PERSEDIAAN </td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>INVENTARIS KANTOR</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>AKM. PENYUSUTAN INVENTARIS KANTOR</td>
    <td align="center">K</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>GEDUNG</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>AKM .PENYUSUTAN GEDUNG</td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>KENDARAAN</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>AKM. PENYUSUTAN KENDARAAN</td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">200</td>
    <td colspan="2">KEWAJIBAN</td>
    <td align="center"></td>
    <td></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG DAGANG</td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG LEASING B 9163 TCI</td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG LEASING B 9304 PDC (LUNAS)</td>
    <td align="center">K</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG BANK CIMB NIAGA I </td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG BANK CIMB NIAGA II</td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG TOKO KENARI 1</td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG TOKO KENARI 2</td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG TOKO KENARI 3 </td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG PPH 21 </td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG PPH 23 </td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG PPH 25</td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG PPH 29</td>
    <td align="center">K</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG PPN</td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PAJAK SPT TAHUNAN</td>
    <td align="center">K</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>HUTANG PEMEGANG SAHAM</td>
    <td align="center">K</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">300</td>
    <td>EKUITAS</td>
    <td></td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>MODAL </td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>LABA DITAHAN</td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">400</td>
    <td colspan="2">PENDAPATAN </td>
    <td align="center"></td>
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
    <td>PENDAPATAN</td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PENDAPATAN TELEKOMUNIKASI</td>
    <td align="center">K</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PENDAPATAN PATCHCORD</td>
    <td align="center">K</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PENDAPATAN PRODUKSI KABEL OPTIK </td>
    <td align="center">K</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PENDAPATAN RETAIL TK LT 2</td>
    <td align="center">K</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PENDAPATAN RETAIL TK LT 3</td>
    <td align="center">K</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PENDAPATAN RETAIL TK BANDUNG</td>
    <td align="center">K</td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PENDAPATAN BUNGA </td>
    <td align="center">K</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">500</td>
    <td colspan="2">HARGA POKOK PENJUALAN</td>
    <td align="center"></td>
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
    <td>HARGA POKOK PENJUALAN</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">600</td>
    <td colspan="2">BIAYA USAHA</td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">BIAYA ADMINISTRASI UMUM</td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>ADM BANK</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>BUKU CEK</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>BUNGA CIMB NIAGA</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>BIAYA PROFISI</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>GATHERING</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>KEPERLUAN KANTOR</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>KEPRLUAN TOKO</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>KEPERLUAN TK LT 2</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>KEPERLUAN TK LT 3</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>KEPERLUAN TK BANDUNG</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>SERAGAM</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>OPERASIONAL BANDUNG</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">BIAYA ENTERTAINT </td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>ENTERTAINT</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>ENTERTAINT TELEKOMUNIKASI</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>ENTERTAINT PATCHCORD</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>ENTERTAINT RETAIL</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>ENTERTAINT KABEL OPTIC</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">BIAYA JASA PROFESIONAL</td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>JASA KONSULTAN</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">BIAYA KOMUNIKASI</td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>IKLAN </td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>INTERNET</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>INTERNET RETAIL</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>TELEPON </td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>TELEPON TOKO</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">BIAYA LISTRIK &amp; AIR</td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>AIR</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>LISTRIK</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">BIAYA PENYUSUTAN </td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>GEDUNG</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>INVENTARIS KANTOR</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>KENDARAAN</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">BIAYA PERBAIKAN &amp; PEMELIHARAAN</td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>MAINTENANCE TOKO KENARI</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PERAWATAN KENDARAAN</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PERAWATAN PERALATAN KANTOR</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">BIAYA PERIJINAN </td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PERIJINAN KENDARAAN </td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PERIJINAN KEPERLUAN PERUSAHAAN</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">BIAYA PERLENGKAPAN DAN PERALATAN KANTOR</td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>ATK</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>FOTOCOPY </td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>IURAN KANTOR</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>KEBERSIHAN KANTOR</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>MATERAI</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">BIAYA SEWA</td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>SEWA</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>SEWA KENDARAAN</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>SEWA RUMAH (KONTRAKAN)</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">BIAYA TENAGA KERJA</td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>BPJS</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>GAJI </td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>JAMSOSTEK</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>KEAMANAN</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>OPERASIONAL KARYAWAN </td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>SUMBANGAN </td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>TRAINING</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>TUNJANGAN HARI RAYA / BONUS</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>TUNJANGAN PULSA KARYAWAN</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">BIAYA TRANSPORTASI</td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>ANGKUT</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>INSTALASI</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>INSTALASI RETAIL</td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PENGIRIMAN </td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PERJALANAN DINAS DOMESTIK</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>PERJALANAN DINAS LUAR NEGERI </td>
    <td align="center">D</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>TRANSPORTASI </td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">KERUGIAN SELISIH KURS</td>
    <td align="center"></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>RUGI/LABA SELISIH KURS</td>
    <td align="center">D</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td align="center"></td>
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
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
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
    <td></td>
    <td></td>
    <td></td>
    <td align="right">0</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>BUNGA</td>
    <td align="right">&nbsp;</td>
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
    <td>PAJAK</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</body>
</html>