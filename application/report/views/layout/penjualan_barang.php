<br><div id='title'><span style="margin-top:5%; font-family:Calibri; text-decoration:underline; ">PRICE LIST BARANG</span><br><span style="margin:0 auto; font-family:Calibri;">PERIOD : <?php echo $period?></span><br>

</div>
<div id='dataarea'><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid black;">
<tr style="font-size:<?php echo $this->fonthead;?>; font-family:Comic Sans MS; font-weight:bold;" >
<th width="4%" style="border:1px double black;">No</th>
<th width="46%" style="border:1px double black;">Kode Barang</th>
<th width="33%" style="border:1px double black;">Nama Barang</th>
<th width="33%" style="border:1px double black;">KATEGORI</th>
<th width="33%" style="border:1px double black;">SUBKATEGORI</th>

<th width="17%" style="border:1px double black;">JUMLAH</th>
</tr>
<?php
$no=1; 
foreach($result as $hasil)
{
 	?>
<tr style="border:1px solid black; font-size:12; font-family:Comic Sans MS;">
<th valign="top" style="border:1px solid black;"><?php echo $no;?></th><th valign="top" align="center" style="border:1px solid black;" align="left"><?php echo $hasil->kode_barang?></th><th valign="top" style="border:1px solid black;"><?php echo $hasil->nama?></th><th valign="top" style="border:1px solid black;"><?php echo GetValue('nama','tb_group_inventory',array('kode_group'=>'where/'.$hasil->kode_group))?></th><th valign="top" style="border:1px solid black;"><?php echo str_replace('none','&nbsp;',GetValue('kode_group_parent','tb_group_inventory',array('kode_group'=>'where/'.$hasil->kode_group)))?></th>
<th align="left" style="border:1px solid black;"><?php echo str_replace('','&nbsp;',GetTerjual($hasil->kode_barang,$this->input->post('start_date'),$this->input->post('end_date')))?></th>
</tr>
<?php 
$no++;
}
  
  ?>
  
</table></div>