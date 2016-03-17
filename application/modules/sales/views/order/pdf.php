<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sales Order</title>
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
  <img width="100%" src="<?php echo assets_url('images/logo-full.png')?>"/>
</div>
 <hr/>
  <h3 style="margin-bottom: -10px;margin-top: -10px;text-align: center">Sales Order</h3>
<hr/>
<?php foreach ($order->result() as $o) :
$pajak_komponen = explode(',', $o->pajak_komponen_id);
?>
<table width="1000" border="0">
  <tbody>
    <tr>
      <td width="180">SO Number</td>
      <td width="20">:</td>
      <td width="300"><?=$o->so?></td>
      <td width="180">To</td>
      <td width="20">:</td>
      <td width="300"><?=$o->kontak?></td>
    </tr>
    <tr>

      <td width="180">Date</td>
      <td width="20">:</td>
      <td width="300"><?=dateIndo($o->created_on)?></td>
      
      <td>Up</td>
      <td>:</td>
      <td><?=$o->up?></td>
      
    </tr>

    <tr>

      <td width="180">Delivery</td>
      <td width="20">:</td>
      <td width="300"><?=dateIndo($o->tanggal_transaksi)?></td>


      <td>Phone</td>
      <td>:</td>
      <td><?=$phone?></td>
    </tr>
    <tr>
    
      <td>Currency</td>
      <td>:</td>
      <td><?=$o->kurensi?></td>


      <td>Fax</td>
      <td>:</td>
      <td><?=$fax?></td>
    </tr>
    <tr>

      <td>Payment Method</td>
      <td>:</td><?php $l = ($o->metode_pembayaran_id == 2) ? ' - '.$o->lama_angsuran_1.' '.$o->lama_angsuran_2 : '';?>
      <td><?=$o->metode_pembayaran?><?php echo $l;?></td>
      <td>Email</td>
      <td>:</td>
      <td><?=$o->email?></td>
    </tr>
    <tr>
      <td>Project</td>
      <td>:</td>
      <td><?=$o->project?></td>
      
      <td>Address</td>
      <td>:</td>
      <td><?=$o->alamat?></td>
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
			<th>Disc(%)</th>
			<hr style="width:100%">
			<th>Sub Total</th>
			<hr style="width:100%">
    	</tr>
    </tr>
	<?php 
		$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo = 0;
		$i=1;foreach($order_list->result() as $ol): ?>
	<tr>
	<?php 
		$diskon = $ol->jumlah*$ol->harga*($ol->disc/100);
		$subtotal = $ol->jumlah*$ol->harga-$diskon;
		$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
		$total_diskon= $total_diskon + ($ol->jumlah*$ol->harga * ($ol->disc/100));
		$total = $total + $subtotal;
	?>
		<td width="5%"><?=$i++?></td>
		<td width="15%"><?=$ol->kode_barang?></td>
		<td width="20%"><?=$ol->deskripsi?></td>
		<td width="5%" align="right"><?=$ol->jumlah?> <?=$ol->satuan?></td>
		<td width="18%" align="right"><?= number_format($ol->harga, 2)?></td>
		<td width="5%" align="right"><?=$ol->disc?></td>
		<td width="20%" align="right"><?= number_format($subtotal, 2)?></td>
	</tr>

	<?php endforeach;		
		$total_pajak = $o->total_ppn + $o->total_pph22 + $o->total_pph23;
		$total = $total+$o->biaya_pengiriman;
		$totalpluspajak = $total+$total_pajak;
		$dp = $totalpluspajak * ($o->dibayar/100);
		$saldo = $totalpluspajak - $dp - $o->dibayar_nominal;
	?>
	
	</table>

<?php endforeach;?>
<br/>

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
		<tr><td colspan="4">Note :</td></tr>
		<?php if(!empty($o->catatan)){
		$c = explode(PHP_EOL, $o->catatan);
			  foreach ($c as $key => $value) {?>
			  <tr><td colspan="4">- <?=$value?></td></tr>
		<?php }} ?>
		<tr><td colspan="9"></td>
	</tr>
	<hr style="width:100%">
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<?php if(in_array(1, $pajak_komponen)){?>
		<td colspan="3">PPN</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?= number_format($o->total_ppn, 2)?></td>
	</tr>
	<?php } ?>
	<?php if(in_array(2, $pajak_komponen)){?>
	<tr>
		<td align="center"><!--Approved,--></td>
		<td align="center"><!--Order By,--></td>
		<td align="center"><!--ACC Vendor--></td>
		<td colspan="3">PPH 22</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($o->total_pph22, 2)?></td>
	</tr>
	<?php } ?>
	<?php if(in_array(3, $pajak_komponen)){?>
	<tr>
		<td align="center"><!--Approved,--></td>
		<td align="center"><!--Order By,--></td>
		<td align="center"><!--ACC Vendor--></td>
		<td colspan="3">PPH 23</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($o->total_pph23, 2)?></td>
	</tr>
	<?php } ?>
	<?php if(!empty($o->biaya_pengiriman)):?>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3">Delivery Cost</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($o->biaya_pengiriman, 2)?></td>
	</tr>
	<?php endif;?>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3">Discount</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($total_diskon, 2)?></td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3">Total</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($total, 2)?></td>
	</tr>

	<tr>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td colspan="3">Total + Tax</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($totalpluspajak, 2)?></td>
	</tr>

	
	<?php $dp = ($o->dibayar !=0) ? number_format($o->dibayar,2).' %':number_format($o->dibayar_nominal, 2);?>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3"><?php if($o->metode_pembayaran_id == 2):?>Dibayar<?php endif; ?></td>
		<td align="right"><?php if($o->metode_pembayaran_id == 2):?>:<?php endif; ?></td>
		<td align="right" colspan="2"><?php if($o->metode_pembayaran_id == 2):?><?=$dp?><?php endif; ?></td>
	</tr>

	<tr>
		<td align="center"><!--(<?=(!empty($o->user_app_id_lv4))?getFullName($o->user_app_id_lv4):'';?>)--></td>
		<td align="center"><!--(<?=getFullName($o->created_by)?>)--></td>
		<td align="center"><!--(Sign & Return by Fax)--></td>
		<td colspan="3"><?php if($o->metode_pembayaran_id == 2):?>Saldo<?php endif; ?></td>
		<td align="right"><?php if($o->metode_pembayaran_id == 2):?>:<?php endif; ?></td>
		<td align="right" colspan="2"><?php if($o->metode_pembayaran_id == 2):?><?=number_format($saldo, 2)?><?php endif; ?></td>
	</tr> 
</table>
</div>

</body>
</html>