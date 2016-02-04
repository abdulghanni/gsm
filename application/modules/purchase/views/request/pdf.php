<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
td{ height:30px;}
.catatan {font-family:Arial, sans-serif;font-size:10px;}
.list td{ height:40px;font-family:Arial, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.list th{height:40px; font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
</style>
</head>

<body>
<hr/>
<strong>PURCHASE Request </strong>
<hr/>
<?php foreach ($request->result() as $o) :?>
<table width="800" border="0">
  <tbody>
    <tr>
      <td width="180">No. P.R</td>
      <td width="20">:</td>
      <td width="200"><?=$o->no?></td>
      <td width="180">Tanggal Digunakan</td>
      <td width="20">:</td>
      <td width="200"><?=dateIndo($o->tanggal_digunakan)?></td>
    </tr>
    <tr>
      <td>Diajukan Kepada</td>
      <td>:</td>
      <td><?=getFullName($o->diajukan_ke)?></td>
      <td>Dikirim Ke</td>
      <td>:</td>
      <td><?=$o->gudang?></td>
    </tr>
    <tr>
      <td>Keperluan</td>
      <td>:</td>
      <td><?=$o->keperluan?></td>
    </tr>
   
  </tbody>
</table>

 <hr/>
<table width="800" class="list">
    <tr>
	    <th width="5%"> No. </th>
		<th width="15%"> Kode Barang </th>
		<th width="20%"> Nama Barang </th>
		<th width="5%">Quantity</th>
		<th width="10%"> Satuan </th>
		<th width="18%"> Harga </th>
		<th width="20%"> Sub Total </th>
		<th width="5%">Pajak(%)</th>
    </tr>
	<?php 
		$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo = 0;
		$i=1;foreach($request_list->result() as $ol): ?>
	<tr>
	<?php 
		$diskon = $ol->jumlah*$ol->harga*($ol->disc/100);
		$subtotal = $ol->jumlah*$ol->harga-$diskon;
		$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
		$total = $total + $subtotal;
	?>
		<td width="5%"><?=$i++?></td>
		<td width="15%"><?=$ol->kode_barang?></td>
		<td width="20%"><?=$ol->deskripsi?></td>
		<td width="5%"align="right"><?=$ol->jumlah?></td>
		<td width="10%"><?=$ol->satuan?></td>
		<td width="18%" align="right"><?= number_format($ol->harga, 2)?></td>
		<td width="20%" align="right"><?= number_format($subtotal, 2)?></td>
		<td width="5%" align="right"><?=$ol->pajak?></td>
	</tr>

	<?php endforeach;		
		$totalpluspajak = $total+$o->biaya_pengiriman+$totalpajak;
		$grandtotal = $totalpluspajak + $o->biaya_pengiriman - $o->dibayar;
		$bunga =  ($grandtotal) * ($o->bunga/100);
	?>
	
	</table>


	<hr/>
	<table table width="900" style="border:0">
	<tr>
		<th width="20%"></th>
		<th width="20%"></th>
		<th width="20%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="5%"></th>
		<th width="5%"></th>
		<th width="10%"></th>
		<th width="10%"></th>
	</tr>
	<tr>
		<td align="center">Approved,</td>
		<td align="center">Request By,</td>
		<td align="center">ACC Vendor</td>
		<td colspan="3">Total Pajak</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($totalpajak, 2)?></td>
	</tr>


	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3">Total</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($total+$o->biaya_pengiriman, 2)?></td>
	</tr>

	<tr>
		<td align="center"><?=(!empty($o->user_app_id_lv2))?getName($o->user_app_id_lv2):'';?></td>
		<td align="center"><?=getName($o->created_by)?></td>
		<td align="center"><?=$o->supplier?></td>
		<td colspan="3">Total + Pajak</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($total+$o->biaya_pengiriman+$totalpajak, 2)?></td>
	</tr>

	
	<?php if($o->metode_pembayaran_id == 2):?>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3">Dibayar</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($o->dibayar,2)?></td>
	</tr>

	<tr><td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3">Total+bunga Angsuran</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($grandtotal+$bunga,2)?></td>
	</tr>

	<tr><td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3">Biaya Angsuran</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format(($grandtotal+$bunga)/$o->lama_angsuran_1, 2)?>/<?=ucwords($o->lama_angsuran_2)?></td>
	</tr>

	<tr><td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3">Saldo</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($grandtotal, 2)?></td>
	</tr>

	<?php endif; ?>
	
	
</table>
<div class="catatan">
<?php endforeach;?>
<br/>
<?php if(!empty($o->catatan)):?>
Catatan :<br/>
<textarea class="catatan"><?=$o->catatan?></textarea>
<?php endif;?>
</div>
</body>
</html>
