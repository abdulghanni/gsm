<br><div id='title'><br><br><span style="margin:0 auto; font-family:Calibri;">PERIOD : <?php echo $period?></span><br><br><span style="margin:0 auto; font-family:Calibri;">Tanggal Cetak : <?php echo date("d-m-Y")?></span><br>
<?php error_reporting(0);// echo print_r($kolom); ?>
</div>
<div id='dataarea'><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid black;">
<tr style=" font-family:Comic Sans MS; font-weight:bold;" >
<th width="2%" style="border:1px double black;">No</th>
	<?php if($kolom['so']){ ?>
	<th width="20%" style="border:1px double black;">SO</th><?php }  ?>
	<?php if($kolom['kontak_id']){ ?>
		<th width="23%" style="border:1px double black;">Customer</th><?php }  ?>
		<?php if($kolom['tanggal_transaksi']){ ?>
			<th width="23%" style="border:1px double black;">Tanggal Pengiriman</th><?php }  ?>
			<?php if($kolom['metode_pembayaran']){ ?>
				<th width="12%" style="border:1px double black;">Metode Pembayaran</th><?php }  ?>
				<?php if($kolom['gudang_id']){ ?>
<th width="12%" style="border:1px double black;">Dikirim Dari</th><?php }  ?>
</tr>
<?php
$no=1; //print_mz($result);
$semua=0;
foreach($q as $hasil)
{
 	?>
<tr style="border:1px solid black; font-size:12; font-family:Comic Sans MS;">
	<th valign="top" style="border:1px solid black;"><?php echo $no;?></th>
	<?php if($kolom['so']){ ?>
	<th valign="top" align="center" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->so?></th><?php }  ?>
	<?php if($kolom['kontak_id']){ ?>
	<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.GetValue('title','customer',array('id'=>'where/'.$hasil->kontak_id))?></th><?php }  ?>
	<?php if($kolom['tanggal_transaksi']){ ?>
	<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->tanggal_transaksi?></th><?php }  ?>
	<?php if($kolom['metode_pembayaran']){ ?>
	<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.$hasil->metode_pembayaran_id?></th><?php }  ?>
	<?php if($kolom['gudang_id']){ ?>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.GetValue('title','gudang',array('id'=>'where/'.$hasil->gudang_id))?></th><?php }  ?>
</tr>
<?php 
$no++;
}
  
  ?>
</table></div>