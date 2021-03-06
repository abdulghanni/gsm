
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Purchase Request</title>
<style type="text/css">
td{ height:30px;}
.catatan {font-family:Arial, sans-serif;font-size:10px;}
.list td{ height:40px;font-family:sans, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.list th{height:40px; font-family:sans, sans-serif;font-size:14px;font-weight:normal;padding:12px 16px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.myfixed1 { position: absolute; 
	overflow: visible; 
	left: 0; 
	bottom: 0; 
	padding: 1.5em; 
	font-family:sans; 
	margin: 0;
}
</style>
</head>
<body>
  <div style="text-align: center;">
  <!--<img height="100px" width="100px" src="<?php echo assets_url('images/logo-gsm.png')?>"/>-->
  <img width="100%" src="<?php echo assets_url('images/logo-po.png')?>"/>
</div>
 <hr/>
  <h3 style="margin-bottom: -10px;margin-top: -10px;text-align: center">Purchase Request</h3>
<hr/>
<?php foreach ($request->result() as $o) :?>
<table width="1000" border="0">
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
    	<td>Keperluan</td>
      <td>:</td>
      <td><?=$o->keperluan?></td>
      <td>Dikirim Ke</td>
      <td>:</td>
      <td><?=$o->gudang?></td>
    </tr>

    <tr>
    	<td>Mata Uang</td>
      <td>:</td>
      <td><?=$o->kurensi?></td>
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
			<hr style="width:100%">
			<th>Sub Total</th>
			<hr style="width:100%">
			<!--<th>Pajak(%)</th>
			<hr style="width:100%">-->
    	</tr>
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
		<td width="5%" align="right"><?=$ol->jumlah?> <?=$ol->satuan?></td>
		<td width="18%" align="right"><?= number_format($ol->harga, 2)?></td>
		<td width="20%" align="right"><?= number_format($subtotal, 2)?></td>
	</tr>

	<?php endforeach;		
		$totalpluspajak = $total+$o->biaya_pengiriman+$totalpajak;
		$grandtotal = $totalpluspajak + $o->biaya_pengiriman - $o->dibayar;
		$bunga =  ($grandtotal) * ($o->bunga/100);
	?>
	
	</table>

<?php endforeach;?>
<br/>
<!--

<div class="catatan">
<?php if(!empty($o->catatan)):?>
Catatan :<br/>
<textarea class="catatan"><?=$o->catatan?></textarea>
<?php endif;?>
</div>

-->


<div class="myfixed1">
	<table table width="1000" style="border:0">
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
	<?php 
		if(!empty($o->catatan)){
			echo '<tr><td colspan="4">Notes :</td></tr>';
		$c = explode(PHP_EOL, $o->catatan);
			  foreach ($c as $key => $value) {?>
			  <tr><td colspan="4"><?=$value?></td></tr>
		<?php }} ?>
	<tr><td colspan="9"></td></tr>
	<hr style="width:100%">
	<tr><td align="center">Jakarta, <?=date('d M Y', strtotime($o->created_on))?></td></tr>
	<tr>
		<td align="center">Created By,</td>
		<td align="center"><!--Order By,--></td>
		<td align="center"><!--ACC Vendor--></td>
		<td colspan="3">Total</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($total+$o->biaya_pengiriman, 2)?></td>
	</tr>
	<?php if(!empty($o->biaya_pengiriman)):?>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3">Biaya Pengiriman</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($o->biaya_pengiriman, 2)?></td>
	</tr>
	<?php endif;?>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3"><!--Diskon--></td>
		<td align="right"><!--:--></td>
		<td align="right" colspan="2"><!--<?=number_format($total_diskon, 2)?>--></td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3"><!--Total Pajak--></td>
		<td align="right"><!--:--></td>
		<td align="right" colspan="2"><!--<?=number_format($totalpajak, 2)?>--></td>
	</tr>

	<tr>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td colspan="3"><!--Total + Pajak--></td>
		<td align="right"><!--:--></td>
		<td align="right" colspan="2"><!--<?=number_format($total+$o->biaya_pengiriman+$totalpajak, 2)?>--></td>
	</tr>

	
	<tr>
		<td align="center"><?=getFullName($o->created_by)?></td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3"><?php if($o->metode_pembayaran_id == 2):?>Dibayar<?php endif; ?></td>
		<td align="right"><?php if($o->metode_pembayaran_id == 2):?>:<?php endif; ?></td>
		<td align="right" colspan="2"><?php if($o->metode_pembayaran_id == 2):?><?=number_format($o->dibayar,2)?><?php endif; ?></td>
	</tr>

	<tr>
		<td align="center">(<?=getUserGroup($o->created_by)?>)</td>
		<td align="center"><!--(<?=getFullName($o->created_by)?>)--></td>
		<td align="center"><!--(Sign & Return by Fax)--></td>
		<td colspan="3"><?php if($o->metode_pembayaran_id == 2):?>Saldo<?php endif; ?></td>
		<td align="right"><?php if($o->metode_pembayaran_id == 2):?>:<?php endif; ?></td>
		<td align="right" colspan="2"><?php if($o->metode_pembayaran_id == 2):?><?=number_format($grandtotal, 2)?><?php endif; ?></td>
	</tr>
</table>
</div>

</body>
</html>
