<?php 
		$totalpajak = $total = $biaya_angsuran = $totalplusbunga = $saldo =$exc = $total_diskon= 0;
		$i=1;foreach($order_list->result() as $ol): 
    $diskon = $ol->jumlah*$ol->harga*($ol->disc/100);
    $subtotal = $ol->jumlah*$ol->harga-$diskon;
    $totalpajak = $totalpajak + ($subtotal * ($ol->pajak/100));
    $exc = ($ol->inc_ppn != 0) ? 0 : $exc + ($subtotal * (10/100));
    $total_diskon= $total_diskon + ($ol->jumlah*$ol->harga * ($ol->disc/100));
    $total = $total + $subtotal;
    ?>
<?php endforeach;
  $total_pajak = $o->total_ppn + $o->total_pph22 + $o->total_pph23;
  $total = $total+$o->biaya_pengiriman-$total_pajak+$exc;
  $totalpluspajak = $total+$total_pajak;
  $dp = $totalpluspajak * ($o->dibayar/100);
  $saldo = $totalpluspajak - $dp - $o->dibayar_nominal;
?>
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
    <td width="100px" align="right"><?=number_format($total+$total_pajak, 2)?></td>
  </tr>
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

<div style="float: right; width: 25%">
  <br/>
  <br/>
  <br/>
  <table width="250">
  <tr>
    <td align="center">Jakarta, <?= date("d F Y", strtotime($o->created_on))?></td>
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