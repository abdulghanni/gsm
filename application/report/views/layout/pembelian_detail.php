<br><div id='title'><span style="margin-top:5%; font-family:Calibri; text-decoration:underline; font-size:18px;  ">LAPORAN PEMBELIAN</span><br><span style="margin:0 auto; font-family:Calibri;">PERIOD : <?php echo $period?></span><br><br><span style="margin:0 auto; font-family:Calibri;">Tanggal Cetak : <?php echo date("d-m-Y")?></span><br>

</div>
<div id='dataarea'><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid black;">
<tr style="font-size:<?php echo $this->fonthead;?>; font-family:Comic Sans MS; font-weight:bold;" >
<th width="2%" style="border:1px double black;">No</th>
<th width="20%" style="border:1px double black;">Tanggal</th>
<th width="23%" style="border:1px double black;">Id Pembelian</th>
<th width="23%" style="border:1px double black;">KODE/NAMA Barang</th>
<th width="23%" style="border:1px double black;">Supplier</th>
<th width="23%" style="border:1px double black;">QTY</th>
<th width="23%" style="border:1px double black;">Harga Satuan</th>
<th width="12%" style="border:1px double black;">Rupiah</th>
</tr>
<?php
$semua=0;
$no=1; 
foreach($result as $hasil)
{
 	?>
<tr style="border:1px solid black; font-size:12; font-family:Comic Sans MS;">
<th valign="top" style="border:1px solid black;"><?php echo $no;?></th>
<th valign="top" align="center" style="border:1px solid black;"><?php echo $hasil->tanggal?></th>
<th valign="top" style="border:1px solid black;"><?php echo $hasil->id_beli?></th>
<th valign="top" style="border:1px solid black;"><?php echo $hasil->kode_barang?></th>
<th valign="top" style="border:1px solid black;"><?php echo $hasil->supplier?></th>
<th valign="top" style="border:1px solid black;"><?php echo $hasil->jumlah?></th>
<th valign="top" style="border:1px solid black;"><?php echo $hasil->satuan?></th>
<th valign="top" style="border:1px solid black;"><?php echo $hasil->total?></th>
</tr>
<?php 
$no++;
$semua+=$hasil->total;
}
  
  ?>
  <tr><th colspan="4">TOTAL</th>
  <th><?php echo $semua;?></th>
  </th>
  </tr>
</table></div>