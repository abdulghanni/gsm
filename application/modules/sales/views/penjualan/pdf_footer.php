
<div style="float: right; width: 25%">
<table width="250">
<?php if(!empty($o->biaya_pengiriman)):?>
	<tr>
		<td width="100px">Transport Cost</td>
		<td width="10px">:</td>
		<td width="100px" align="right"><?=number_format($o->biaya_pengiriman, 2)?></td>
	</tr>
	<?php endif;?>
	<?php if($total_diskon != 0):?>
	<tr>
		<td width="100px">Discount</td>
		<td width="10px">:</td>
		<td width="100px" align="right"><?=number_format($total_diskon, 2)?></td>
	</tr>
	<?php endif;?>
	<tr>
		<td width="100px">Sub Total</td>
		<td width="10px">:</td>
		<td width="100px" align="right"><?=number_format($total, 2)?></td>
	</tr>
	<tr>
		<td width="100px">Tax</td>
		<td width="10px">:</td>
		<td width="100px" align="right"><?=number_format($total_pajak, 2)?></td>
	</tr>
	<tr>
		<td width="100px">Grand Total</td>
		<td width="10px">:</td>
		<td width="100px" align="right"><?=number_format($totalpluspajak, 2)?></td>
	</tr>
	<?php if($metode_pembayaran_id == 2) {?>
	<tr>
		<td width="100px">Down Payment</td>
		<td width="10px">:</td>
		<td width="100px" align="right"><?=number_format($dp, 2)?></td>
	</tr>
	<tr>
		<td width="100px">Saldo</td>
		<td width="10px">:</td>
		<td width="100px" align="right"><?=number_format($saldo, 2)?></td>
	</tr>
	<?php } ?>
</table>
</div>
<div style="float: left; width: 70%; font-size: 10px; text-align: left; ">
<?php $f = new NumberFormatter("en", NumberFormatter::SPELLOUT); ?>
		Amount in words : <?= ($o->currency_id == 2) ? dollarToWords($totalpluspajak) : $f->format($totalpluspajak)." Rupiah";?>
</div>
<div style="float: left; width: 70%; font-size: 10px; ">
<br/>
<table width="750">
<?php 
	if(!empty($o->catatan)){
		echo '<tr><td colspan="4">Notes :</td></tr>';
	$c = explode(PHP_EOL, $o->catatan);
		  foreach ($c as $key => $value) {
?>
	<tr>
		<td colspan="4" height="10"><?=$value?></td>
	</tr>
<?php }} ?>
		</table>
</div>
<div style="float: right; width: 30%; font-size: 10px; ">&nbsp;</div>
<div style="float: left; width: 70%; font-size: 10px; ">&nbsp;</div>
<div style="float: right; width: 25%">
	<br/>
	<br/>
	<br/>
	<table width="250">
	<tr>
		<td align="center">Jakarta, <?= date("d M Y", strtotime($o->created_on))?></td>
	</tr>
	<tr>
		<td align="center">PT. Gramaselindo Utama</td>
	</tr>
	<tr>
		<td align="center"></td>
	</tr>
	<tr>
		<td align="center"></td>
	</tr>
	<tr>
		<td align="center"></td>
	</tr>
	<tr>
		<td align="center">(Iriawan)</td>
	</tr>
	<tr>
		<td align="center">Direktur</td>
	</tr>
</table>
</div>
