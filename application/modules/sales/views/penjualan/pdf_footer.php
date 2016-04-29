<table width="1000" class="list">
	<?php if(!empty($o->biaya_pengiriman)):?>
	<tr>
		<td width="20%"></td>
		<td width="10%"></td>
		<td width="10%"></td>
		<td width="10%" align="right"></td>
		<td width="10%" align="right"></td>
		<td width="19%">Transport Cost</td>
		<td width="1%" align="right">:</td>
		<td width="20%" align="right"><?=number_format($o->biaya_pengiriman, 2)?></td>
	</tr>
	<?php endif;?>
	<?php if($total_diskon != 0):?>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td>Diskon</td>
		<td align="right">:</td>
		<td align="right"><?=number_format($total_diskon, 2)?></td>
	</tr>
	<?php endif;?>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td>Sub Total</td>
		<td align="right">:</td>
		<td align="right"><?=number_format($total, 2)?></td>
	</tr>

	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td>Tax</td>
		<td align="right">:</td>
		<td align="right"><?=number_format($total_pajak, 2)?></td>
	</tr>

	<tr>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td>Grand Total</td>
		<td align="right">:</td>
		<td align="right"><?=number_format($totalpluspajak, 2)?></td>
	</tr>

	<?php $dp = ($o->dibayar !=0) ? number_format($o->dibayar,2).' %':number_format($o->dibayar_nominal, 2);?>
	<tr>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td ><?php if($o->metode_pembayaran_id == 2):?>Down Payment<?php endif; ?></td>
		<td align="right"><?php if($o->metode_pembayaran_id == 2):?>:<?php endif; ?></td>
		<td align="right"><?php if($o->metode_pembayaran_id == 2):?><?=$dp?><?php endif; ?></td>
	</tr>
	<tr>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td><?php if($o->metode_pembayaran_id == 2):?>Saldo<?php endif; ?></td>
		<td align="right"><?php if($o->metode_pembayaran_id == 2):?>:<?php endif; ?></td>
		<td align="right"><?php if($o->metode_pembayaran_id == 2):?><?=number_format($saldo, 2)?><?php endif; ?></td>
	</tr> 
	<tr>
		<?php $f = new NumberFormatter("en", NumberFormatter::SPELLOUT); ?>
		<td align="left" colspan="7">Amount in words : <?= ($o->currency_id == 2) ? dollarToWords($totalpluspajak) : $f->format($totalpluspajak)." Rupiah";?> </td>
	</tr> 
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
	<tr>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td colspan="3" align="center">Jakarta, <?= date("d M Y", strtotime($o->created_on))?></td>
	</tr> 
	<tr>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td colspan="3" align="center">PT. Gramaselindo Utama</td>
	</tr> 
	<tr>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td colspan="3" align="center"></td>
	</tr> 
	<tr>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td colspan="3" align="center"></td>
	</tr> 
	<tr>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td colspan="3" align="center">(Iriawan)</td>
	</tr> 
	<tr>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td colspan="3" align="center">Direktur</td>
	</tr> 
</table>