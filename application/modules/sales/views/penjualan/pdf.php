<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice</title>
<style type="text/css">
td{ height:30px;}
.catatan {font-family:Arial, sans-serif;font-size:10px;}
.list td{ height:30px;font-family:sans, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.list th{height:43px; font-family:sans, sans-serif;font-size:14px;font-weight:normal;padding:12px 16px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
</style>
</head>
<body>
<div style="text-align: center;">
  <!--<img height="100px" width="100px" src="<?php echo assets_url('images/logo-gsm.png')?>"/>-->
  <img width="100%" src="<?php echo assets_url('images/logo-full.png')?>"/>
</div>
 <hr/>
  <h3 style="margin-bottom: -10px;margin-top: -10px;text-align: center">Invoice</h3>
<hr/>
<table width="1000" border="0">
  <tbody>
    <tr>
      <td width="180">Charged To</td>
      <td width="20">:</td>
      <td width="300"><?=$o->kontak?></td>
      <td width="10"></td>
      <td width="180">Invoice No.</td>
      <td width="20">:</td>
      <td width="300"><?=$o->no?></td>
    </tr>
    <tr>
      <td width="180">&nbsp;</td>
      <td width="20">&nbsp;</td>
      <td width="300"><?=$o->alamat?></td>
      <td width="30"></td>
      <td>Invoice Date</td>
      <td>:</td>
      <td><?=dateIndo($o->tanggal_transaksi)?></td>
    </tr>

    <tr>
   	  <td width="180">Attn</td>
      <td width="20">:</td>
      <td width="300">Finance</td>
      <td width="10"></td>
      <td>Due Date</td>
      <td>:</td>
      <td><?=dateIndo($o->tanggal_pengantaran)?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td>:</td>
      <td><?=$o->email?></td>
      <td width="10"></td>
      <td>PO No.</td>
      <td>:</td>
      <td><?=$o->so?></td>
    </tr>

    <tr>
      <td>Project</td>
      <td>:</td>
      <td><?=$o->proyek?></td>
      <td width="10"></td>
      <td>Currency</td>
      <td>:</td>
      <td><?=$o->kurensi?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="10"></td>
      <td>Payment Term</td>
      <td>:</td><?php $l = ($o->metode_pembayaran_id == 2) ? ' - '.$o->lama_angsuran_1.' '.$o->lama_angsuran_2 : '';?>
      <td><?=$o->metode_pembayaran?><?php echo $l;?></td>
    </tr>
  </tbody>
</table>

<hr style="font-weight:800" />
<table width="1000" class="list">
    <tr>
	    <tr>
	      <th>No</th>
			<hr style="width:100%">
	      <th>Barcode</th>
			<hr style="width:100%">
		   <th>Description</th>
			<hr style="width:100%">
			<th>Quantity</th>
			<hr style="width:100%">
			<th>Unit Price</th>
			<?php if($total_diskon > 0):?>
			<hr style="width:100%">
			<th>Disc(%)</th>
			<?php endif;?>
			<hr style="width:100%">
			<th>Sub Total</th>
			<hr style="width:100%">
    	</tr>
    </tr>
	<?php 
		$i=1;foreach($penjualan_list->result() as $ol): ?>
	<tr>
		<td width="5%"><?=$i++?></td>
		<td width="15%"><?=$ol->kode_barang?></td>
		<td width="20%"><?=$ol->deskripsi?></td>
		<td width="5%" align="right"><?=$ol->diterima?> <?=$ol->satuan?></td>
		<td width="18%" align="right"><?= number_format($ol->harga, 2)?></td>
		<?php if($total_diskon > 0):?><td width="5%" align="right"><?=$ol->disc?></td><?php endif;?>
		<td width="20%" align="right"><?= number_format($subtotal, 2)?></td>
	</tr>
	<?php endforeach;?>
	</table>
<br/>
</body>
</html>