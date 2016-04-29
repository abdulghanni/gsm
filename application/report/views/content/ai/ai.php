<style>
tr.border_bottom td {
  border-bottom:3px solid black;
}
tr.border_top td {
  border-top:1px solid black;
}
tr.border_top_bold td {
  border-top:3px solid black;
}
table.noborder td{
border:0px solid white!important;
}
</style>
<table width="100%" border="0" cellspacing="0" class="utama" colspan="0">
  <tr class="border_bottom">
    <td width="25%"><!--img style="width: 262px; height: 218px;" alt="ecsi_logo" src="<?php echo base_url()?>assets/img/cis.png"--><img style="width:80%; float:right;" alt="ecsi_logo" src="<?php echo base_url()?>assets/img/seahorse.png"></td>
    <td width="50%"><center><h2>JOBSHEET CUSTOMS <?php echo str_replace('_',' ',$title);?></h2></center> </td>
    <td width="25%"></td>
  </tr>
  <tr class="border_bottom">
    <td colspan="5" bordercolor="#000000">
	<table width="80%" border="0" class="noborder">
      <tr class="theader">
        <td width="9%">Order No </td>
        <td width="47%"><?php echo $job_order?></td><?php if($type!='trucking') {?>
        <td width="10%">Shipper</td>
        <td width="34%"><?php echo GetValue('name','master_client',array('id'=>'where/'.$detail['shipper']));?></td>
		<?php }else{?>
        <td width="10%">Messers</td>
        <td width="34%"><?php echo GetValue('name','master_client',array('id'=>'where/'.$detail['messers']));?></td>
		<?php }?>
	  </tr>
      <tr>
        <td>Date</td>
        <td><?php echo tglindo($detail['create_date']) ?></td><?php if($type!='trucking') {?>
        <td>Consignee</td>
        <td><?php echo GetValue('name','master_client',array('id'=>'where/'.$detail['consignee']));?></td><?php } ?>
      </tr>
      <tr>
        <td><?php echo strtoupper($mb)?></td>
        <td><?php echo $detail[$mb]?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><?php echo strtoupper($hb)?></td>
        <td><?php echo $detail[$hb]?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="5"><table width="100%" border="0">
      <tr>
        <td colspan="6">INCOME IDR </td>
        </tr>
      <tr class="border_bottom">
        <td>Description</td>
        <td>Item</td>
        <td>Metric</td>
        <td>Item Price</td>
        <td>Amount</td>
        <td>Tax</td>
      </tr>
	  <?php
	$in_idr=0;
	  foreach($income_idr as $o){ 
	  $in_idr+=$o['b_subtotal'];
	  ?>
      <tr>
        <td><?php echo $o['b_desc']?></td>
        <td><?php echo $o['b_item']?></td>
        <td><?php echo $o['b_metric']?></td>
        <td><?php echo uang($o['b_item_price'])?></td>
        <td><?php echo uang($o['b_subtotal'])?></td>
        <td>&nbsp;<?php echo $o['b_tax_amount']?></td>
      </tr>
	  <?php } ?>
	  
      <tr class="border_top">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong><?php echo uang($in_idr);?></strong></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="5"><table width="100%" border="0">
      <tr>
        <td colspan="6">COST - IDR </td>
      </tr>
      <tr class="border_bottom">
        <td>Description</td>
        <td>Item</td>
        <td>Metric</td>
        <td>Item Price</td>
        <td>Amount</td>
        <td>Tax</td>
      </tr>
	  <?php
	$cost_idr=0;
	//print_mz($cost_idr);
	  foreach($c_idr as $a){ 
	  $cost_idr+=$a['c_subtotal'];
	  ?>
      <tr>
        <td><?php echo $a['c_desc']?></td>
        <td><?php echo $a['c_item']?></td>
        <td><?php echo $a['c_metric']?></td>
        <td><?php echo $a['c_item_price']?></td>
        <td><?php echo $a['c_subtotal']?></td>
        <td>&nbsp;<?php echo $a['c_tax_amount']?></td>
      </tr>
	  <?php } ?>
      <tr class="border_top">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong><?php echo Decimal($cost_idr)?></strong></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr> <tr>
    <td colspan="5"><table width="100%" border="0">
      <tr>
        <td colspan="6">INCOME USD </td>
        </tr>
      <tr class="border_bottom">
        <td>Description</td>
        <td>Item</td>
        <td>Metric</td>
        <td>Item Price</td>
        <td>Amount</td>
        <td>Tax</td>
      </tr>
	  <?php
	$in_usd=0;
	  foreach($income_usd as $o){ 
	  $in_usd+=$o['b_subtotal'];
	  ?>
      <tr>
        <td><?php echo $o['b_desc']?></td>
        <td><?php echo $o['b_item']?></td>
        <td><?php echo $o['b_metric']?></td>
        <td><?php echo $o['b_item_price']?></td>
        <td><?php echo $o['b_subtotal']?></td>
        <td>&nbsp;<?php echo $o['b_tax_amount']?></td>
      </tr>
	  <?php } ?>
      <tr class="border_top">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong><?php echo Decimal($in_usd)?></strong></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="5"><table width="100%" border="0">
      <tr>
        <td colspan="6">COST - USD </td>
      </tr>
      <tr class="border_bottom">
        <td>Description</td>
        <td>Item</td>
        <td>Metric</td>
        <td>Item Price</td>
        <td>Amount</td>
        <td>Tax</td>
      </tr>
       <?php
	$cost_usd=0;
	  foreach($c_usd as $o){ 
	  $cost_usd+=$o['c_subtotal'];
	  ?>
      <tr>
        <td><?php echo $o['c_desc']?></td>
        <td><?php echo $o['c_item']?></td>
        <td><?php echo $o['c_metric']?></td>
        <td><?php echo $o['c_item_price']?></td>
        <td><?php echo $o['c_subtotal']?></td>
        <td>&nbsp;<?php echo $o['c_tax_amount']?></td>
      </tr>
	  <?php } ?>
      <tr class="border_top">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong><?php echo Decimal($cost_usd)?></strong></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr class="border_top_bold">
    <td colspan="5"><table width="40%" border="1" cellspacing="0" bordercolor="#000000" style="float:right;">
      <tr>
        <td>&nbsp;</td>
          <td>Income</td>
          <td>Cost</td>
          <td>Gross Profit</td>
        </tr>
      <tr>
        <td>IDR</td>
          <td><?php echo Decimal($in_idr)?></td>
          <td><?php echo Decimal($cost_idr)?></td>
          <td><?php echo Decimal($in_idr-$cost_idr)?></td>
        </tr>
      <tr>
        <td>USD</td>
          <td><?php echo Decimal($in_usd)?></td>
          <td><?php echo Decimal($cost_usd)?></td>
          <td><?php echo $in_usd-$cost_usd?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="14%" style="border-bottom:3px solid black;"><br/><br/><br/><br/><br/><br/><br/>SALES</td>
    <td width="21%">&nbsp;</td>
    <td width="14%" style="border-bottom:3px solid black;"><br/><br/><br/><br/><br/><br/><br/>APPROVED BY </td>
    <td width="9%">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
