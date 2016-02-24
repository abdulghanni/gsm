<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
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
  <img height="87" width="515px" style="text-align:center;margin-bottom: -45px;margin-left: 70px;margin-top:5px" src="<?php echo assets_url('images/logo-po.jpg')?>"/>
  <p>
  <br>
  <div style="text-align:center;font-size: 11px;font-weight:600;margin-bottom: 0px;">
  Jl. Utan Kayu Raya No. 1 Matraman, Jakarta Timur<br>
  Phone : +62 21 29821601<br>
  Fax : +62 21 85914371
  </div>
 <hr/>
  <h3 style="margin-bottom: -10px;margin-top: -10px;text-align: center">Invoice</h3>
<hr/>
<?php foreach ($pembelian->result() as $o) :?>
<table width="1000" border="0">
  <tbody>
    <tr>
      <td width="180">No. Invoice</td>
      <td width="20">:</td>
      <td width="300"><?=$o->no?></td>
      <td width="180">Kepada</td>
      <td width="20">:</td>
      <td width="300"><?=$o->kontak?></td>
    </tr>
    <tr>
      <td>No. PO</td>
      <td>:</td>
      <td><?=$o->po?></td>
      
      <td>Kontak Personal</td>
      <td>:</td>
      <td><?=$o->up?></td>
      
    </tr>

    <tr>
      <td width="180">Tanggal</td>
      <td width="20">:</td>
      <td width="300"><?=dateIndo($o->tanggal_transaksi)?></td>
      
      <td>Telepon</td>
      <td>:</td>
      <td><?=$phone?></td>
    </tr>
    <tr>

      <td width="180">Batas Pengiriman</td>
      <td width="20">:</td>
      <td width="300"><?=dateIndo($o->tanggal_pengiriman)?></td>

    </tr>
    <tr>


      <td>Mata Uang</td>
      <td>:</td>
      <td><?=$o->kurensi?></td>

      <td>Alamat</td>
      <td>:</td>
      <td><?=$o->alamat?></td>
    </tr>
    <tr>
      <td>Metode Pembayaran</td>
      <td>:</td><?php $l = ($o->metode_pembayaran_id == 2) ? ' - '.$o->lama_angsuran_1.' '.$o->lama_angsuran_2 : '';?>
      <td><?=$o->metode_pembayaran?><?php echo $l;?></td>
      <td>Proyek</td>
      <td>:</td>
      <td><?=$o->proyek?></td>
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
			<th>Pajak(%)</th>
			<hr style="width:100%">
    	</tr>
    </tr>
	<?php 
		$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo = 0;
		$i=1;foreach($pembelian_list->result() as $ol): ?>
	<tr>
	<?php 
		$diskon = $ol->diterima*$ol->harga*($ol->disc/100);
		$subtotal = $ol->diterima*$ol->harga-$diskon;
		$totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
		$total = $total + $subtotal;
		$total_diskon= $total_diskon + ($ol->diterima*$ol->harga * ($ol->disc/100));
	?>
		<td width="5%"><?=$i++?></td>
		<td width="15%"><?=$ol->kode_barang?></td>
		<td width="20%"><?=$ol->deskripsi?></td>
		<td width="5%" align="right"><?=$ol->diterima?> <?=$ol->satuan?></td>
		<td width="18%" align="right"><?= number_format($ol->harga, 2)?></td>
		<td width="5%" align="right"><?=$ol->disc?></td>
		<td width="20%" align="right"><?= number_format($subtotal, 2)?></td>
		<td width="5%" align="right"><?=$ol->pajak?></td>
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
		<!--
		<tr><td colspan="4">Keterangan :</td></tr>
		<tr><td colspan="4">- Semua Pengiriman Barang Disertakan Nota/Faktur</td></tr>
		<tr><td colspan="4">- Dokumen & Faktur ditujukan kepada finance PT. Gramaselindo Utama Diserahkan Melalui</td></tr>
		<tr><td colspan="4">  &nbsp;&nbsp;Receptionist Kami</td></tr>
		<tr><td colspan="4">- Barang akan dikembalikan bila tidak sesuai pesanan</td></tr>
		<tr><td colspan="9">- No PO Harus di Cantumkan dalam Nota/Faktur dan Surat jalan</td></tr>
	-->
	<tr><td colspan="9"></td></tr>
	<hr style="width:100%">
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td align="center"><!--Approved,--></td>
		<td align="center"><!--Order By,--></td>
		<td align="center"><!--ACC Vendor--></td>
		<td colspan="3">Total Pajak</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($totalpajak, 2)?></td>
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
		<td colspan="3">Diskon</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($total_diskon, 2)?></td>
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
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td colspan="3">Total + Pajak</td>
		<td align="right">:</td>
		<td align="right" colspan="2"><?=number_format($total+$o->biaya_pengiriman+$totalpajak, 2)?></td>
	</tr>

	
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3"><?php if($o->metode_pembayaran_id == 2):?>Dibayar<?php endif; ?></td>
		<td align="right"><?php if($o->metode_pembayaran_id == 2):?>:<?php endif; ?></td>
		<td align="right" colspan="2"><?php if($o->metode_pembayaran_id == 2):?><?=number_format($o->dibayar,2)?><?php endif; ?></td>
	</tr>

	<tr>
		<td align="center"><!--(<?=(!empty($o->user_app_id_lv4))?getFullName($o->user_app_id_lv4):'';?>)--></td>
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