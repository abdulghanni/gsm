<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$title?></title>
<style type="text/css">
td{ height:30px;}
.catatan {font-family:Arial, sans-serif;font-size:10px;}
.list td{ height:40px;font-family:Arial, sans-serif;font-size:14px;padding:12px 16px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.list th{height:40px; font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:12px 16px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
</style>
</head>

<body>
<hr/>
<strong>Surat Jalan </strong>
<hr/>
<?php foreach ($delivery->result() as $o) :?>
<table width="800" border="0">
  <tbody>
    <tr>
      <td width="180">No. Surat Jalan</td>
      <td width="20">:</td>
      <td width="200"><?=$o->no?></td>
      <td width="180">Customer</td>
      <td width="20">:</td>
      <td width="200"><?=$o->customer?></td>
    </tr>
    <tr>
      <td>Tanggal Kirim</td>
      <td>:</td>
      <td><?=$o->tanggal_pengantaran?></td>
      <td>No. SO</td>
      <td>:</td>
      <td><?=$o->so?></td>
    </tr>
    <tr>
      <td>Kendaraan</td>
      <td>:</td>
      <td><?=$o->kendaraan?></td>
    </tr>
    
  </tbody>
</table>

 <hr/>
<table width="800" class="list">
    <tr>
	    <th width="5%"> No. </th>
		<th width="20%"> Kode </th>
		<th width="30%"> Nama Barang </th>
		<th width="10%">Jumlah</th>
		<th width="30%">Keterangan</th>
    </tr>
	<?php 
		$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo = 0;
		$i=1;foreach($delivery_list->result() as $ol): ?>
	<tr>
		<td><?=$i++?></td>
		<td><?=$ol->kode_barang?></td>
		<td><?=$ol->deskripsi?></td>
		<td class="text-right"><?=$ol->jumlah?></td>
		<td><?=$ol->keterangan?></td>
	</tr>

	<?php endforeach;
	?>
	</table>


	<hr/>
	

<div class="catatan">
<br/><?php if(!empty($o->catatan)):?>
Catatan :<br/>
<textarea class="catatan"><?=$o->catatan?></textarea>
<?php endif;?>
</div>
<br/>
<br/>
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
		<td align="center">Penerima</td>
		<td align="center"><!--Order By,--></td>
		<td align="center"></td>
		<td colspan="3"></td>
		<td align="right"></td>
		<td align="" colspan="2">Hormat Kami</td>
	</tr>

	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3">&nbsp;</td>
		<td align="right">&nbsp;</td>
		<td align="right" colspan="2">&nbsp;</td>
	</tr>

	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td colspan="3">&nbsp;</td>
		<td align="right">&nbsp;</td>
		<td align="right" colspan="2">&nbsp;</td>
	</tr>

	<tr>
		<td align="center"><!--<?=(!empty($o->user_app_id_lv2))?getName($o->user_app_id_lv2):'';?>--></td>
		<td align="center"><!--<?=getName($o->created_by)?>--></td>
		<td align="center"><!--<?=$o->customer?>--></td>
		<td colspan="3">&nbsp;</td>
		<td align="right">&nbsp;</td>
		<td align="right" colspan="2">&nbsp;</td>
	</tr>

	
</table>
<?php endforeach;?>
</body>
</html>
