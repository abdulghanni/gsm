<br><div id='title'><br><br><span style="margin:0 auto; font-family:Calibri;">PERIOD : <?php echo $period?></span><br><br><span style="margin:0 auto; font-family:Calibri;">Tanggal Cetak : <?php echo date("d-m-Y")?></span><br>

</div>
<div id='dataarea'><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid black;">
<tr style="font-size:<?php echo $this->fonthead;?>; font-family:Comic Sans MS; font-weight:bold;" >
<th width="2%" style="border:1px double black;">No</th>
<th width="20%" style="border:1px double black;">Tanggal</th>
<th width="23%" style="border:1px double black;">No. Faktur</th>
<th width="23%" style="border:1px double black;">Pelanggan</th>
<th width="12%" style="border:1px double black;">Operator</th>
<th width="12%" style="border:1px double black;">Pembayaran</th>
<th width="12%" style="border:1px double black;">Jumlah</th>
</tr>
<?php
$no=1; //print_mz($result);
$semua=0;
foreach($result as $hasil)
{
 	?>
<tr style="border:1px solid black; font-size:12; font-family:Comic Sans MS;">
<th valign="top" style="border:1px solid black;"><?php echo $no;?></th>
<th valign="top" align="center" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->tanggal?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->id_penjualan?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.str_replace('0','',GetValue('nama','tb_karyawan',array('nik'=>'where/'.$hasil->id_karyawan)))?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->kasir?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->tipe_pembayaran?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->total?></th>
</tr>
<?php 
$no++;
$semua+=$hasil->total;
}
  
  ?>
  <tr><th colspan="6">TOTAL</th>
  <th><?php echo $semua;?></th>
  </th>
  </tr>
</table></div>