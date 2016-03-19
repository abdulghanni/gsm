<br><div id='title'>
  <p><br>
    <br>
    <span style="margin:0 auto; font-family:Calibri;">PERIOD : <?php echo $period?></span><br><br>
    <span style="margin:0 auto; font-family:Calibri;">Tanggal Cetak : <?php echo date("d-m-Y")?></span><br>
   <?php if($this->input->post('gudang')){ ?>
    <span style="margin:0 auto; font-family:Calibri;">Gudang : <?php echo GetValue('title', 'gudang',array('id'=>'where/'.$this->input->post('gudang')))?></span><br>
   <?php } ?>
   <?php if($this->input->post('barang')){ ?>
    <span style="margin:0 auto; font-family:Calibri;">Barang : <?php echo GetValue('title', 'barang',array('id'=>'where/'.$this->input->post('barang'))) ?></span><br>
   <?php }?>
  <?php error_reporting(0);// echo print_r($kolom); ?>
  </p>
  <table width="100%" border="1" cellspacing="0" cellpadding="0" >
    <tbody>
      <tr align="center">
        <td>No</td>
        <td>Type</td>
        <td>No Transaksi</td>
        <td>Gudang</td>
        <td>Barang</td>
        <td>Masuk</td>
        <td>Keluar</td>
        <td>Satuan</td>
        <td>Tanggal Transaksi</td>
      </tr>
      <?php
      $no=1;
      foreach($q as $hasil){ ?>
      <tr align="center">
        <td><?php echo $no ?></td>
        <td><?php echo $hasil['source'] ?></td>
        <td><?php echo $hasil['no'] ?></td>
        <td><?php echo GetValue('title', 'gudang',array('id'=>'where/'.$hasil['gudang'])) ?></td>
        <td><?php echo GetValue('title', 'barang',array('id'=>'where/'.$hasil['barang'])) ?></td>
        <td><?php echo ($hasil['type']=='in' ? $hasil['qty'] : '') ?></td>
        <td><?php echo ($hasil['type']=='out' ? $hasil['qty'] : '') ?></td>
        <td><?php echo GetValue('title','satuan',array('id'=>'where/'.$hasil['satuan'])) ?></td>
        <td><?php echo date('d-m-Y',strtotime($hasil['tgl'])) ?></td>
      </tr>
      <?php $no++; }?>
    </tbody>
  </table>
  <p>&nbsp;</p>
</div>
<div id='dataarea'><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid black;">
<!--tr style=" font-family:Comic Sans MS; font-weight:bold;" class="theader" >
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
        <th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.GetValue('title', 'metode_pembayaran',array('id'=>'where/'.$hasil->metode_pembayaran_id))?></th><?php }  ?>
	<?php if($kolom['gudang_id']){ ?>
<th valign="top" style="border:1px solid black;"><?php echo '&nbsp;'.GetValue('title','gudang',array('id'=>'where/'.$hasil->gudang_id))?></th><?php }  ?>
</tr-->
<?php 
//$no++;
}
  ?>

</table></div>