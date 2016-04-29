<br><div id='title'><span style="margin-top:5%; font-family:Calibri; text-decoration:underline; ">Koreksi Stok</span><br><span style="margin:0 auto; font-family:Calibri;">PERIOD : <?php echo $period?></span><br>

</div>
<div id='dataarea'><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid black;">
<tr style="font-size:<?php echo $this->fonthead;?>; font-family:Comic Sans MS; font-weight:bold;" >
<th width="2%" style="border:1px double black;">No</th>
<th width="20%" style="border:1px double black;">Tanggal</th>
<th width="23%" style="border:1px double black;">Kode Barang</th>
<th width="23%" style="border:1px double black;">Nama Barang</th>
<th width="30%" style="border:1px double black;">Nama Penginput</th>

<th width="13%" style="border:1px double black;">Stok Sebelumnya</th>
<th width="12%" style="border:1px double black;">Stok Koreksi</th>
</tr>
<?php
$no=1; 
foreach($result as $hasil)
{
 	?>
<tr style="border:1px solid black; font-size:12; font-family:Comic Sans MS;">
<th valign="top" style="border:1px solid black;"><?php echo $no;?></th>
<th valign="top" align="center" style="border:1px solid black;"><?php echo $hasil->tgl?></th>
<th valign="top" style="border:1px solid black;"><?php echo $hasil->kode_barang?></th>
<th valign="top" style="border:1px solid black;"><?php echo GetValue('nama','tb_inventory',array('kode_barang'=>'where/'.$hasil->kode_barang))?></th>
<th valign="top" style="border:1px solid black;"><?php echo $hasil->masuk_oleh?></th>
<th valign="top" style="border:1px solid black;"><?php echo $hasil->stok?></th>
<th align="center" style="border:1px solid black;"><?php echo $hasil->jumlah?></th>
</tr>
<?php 
$no++;
}
  
  ?>
  
</table></div>