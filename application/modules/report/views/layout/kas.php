<br><div id='title'><span style="margin-top:5%; font-family:Calibri; text-decoration:underline; font-size:18px;  "><center>LAPORAN KAS / BANK</center></span><br><span style="margin:0 auto; font-family:Calibri;">Nama Kas : <?php echo $kas?></span><br><span style="margin:0 auto; font-family:Calibri;">PERIOD : <?php echo $period?></span><br><br><span style="margin:0 auto; font-family:Calibri;">Tanggal Cetak : <?php echo date("d-m-Y")?></span><br>

</div>
<div id='dataarea'><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid black;">
<tr style="font-size:<?php echo $this->fonthead;?>; font-family:Comic Sans MS; font-weight:bold;" >
<th width="2%" style="border:1px double black;">No</th>
<th width="20%" style="border:1px double black;">Tanggal</th>
<th width="23%" style="border:1px double black;">No. Ref</th>
<th width="23%" style="border:1px double black;">Keterangan</th>
<th width="12%" style="border:1px double black;">Debit</th>
<th width="12%" style="border:1px double black;">Kredit</th>
<th width="12%" style="border:1px double black;">Saldo</th>
</tr>
<?php
$no=1; 
foreach($result as $hasil)
{
 	?>
<tr style="border:1px solid black; font-size:12; font-family:Comic Sans MS;">
<th valign="top" style="border:1px solid black;"><?php echo $no;?></th>
<th valign="top" align="center" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->tgl?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->id_transaksi?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->tipe_transaksi?></th>
<th valign="top" style="border:1px solid black;"><?php echo '-'.$hasil->debit?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->kredit?></th>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->saldo?></th>
</tr>
<?php 
$no++;
}
  
  ?>
</table></div>