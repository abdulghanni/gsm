<table width="100%" border="1" align="center" cellspacing="0">
<tr>
<center><h2>Report Outstanding Invoice Payable</h2>
</center>
</tr>
<tr><span style="float:left;"><?php echo GetValue('name','master_client',array('id'=>'where/'.$this->input->post('client')));?></span>
</tr>
<tr><span style="float:right;"><?php echo GetMonth((int)$periode[1]).' '.(int)$periode[0]?></span>
</tr>
  <tr align="center" class="theader">
    <td>No</td>
    <td>Vendor</td>
    <td>Job Order / Trucking Order</td>
    <td>Paid Status</td>
    <td>Total Amount Invoice</td>
    <td>Total Count Paid </td>
    <td>Total Paid </td>
    <td>Total Outstanding</td>
  </tr><?php
  $a=1;
  $rowspan=1;
  $vs='';
  foreach($inv as $voic){
	  //$inv=$this->db->query("SELECT * FROM sv_trucking_order WHERE number='".$voic['jo']."' ")->row_array();
	  $v=GetValue('name','master_vendor',array('id'=>'where/'.GetValue('vendor','sv_invoice',array('id'=>'where/'.$voic['id_invoice']))));
	  $rowspan=$this->db->query("SELECT id FROM sv_invoice_detail WHERE id_invoice='".$voic['id_invoice']."'")->num_rows();
	  //if($vs==$v){$rowspan+=1;}else{$rowspan=1;}
	  $totbayar=$this->db->query("SELECT * FROM sv_payment WHERE invoice = '".$voic['id_invoice']."'")->num_rows();
	  $totpay=$this->db->query("SELECT SUM(amount) as bayar FROM sv_payment WHERE invoice = '".$voic['id_invoice']."'")->row_array();
	  $terakhir=$this->db->query("SELECT * FROM sv_payment WHERE  invoice = '".$voic['id_invoice']."' ORDER BY id DESC ")->row_array();
	    //if($v != $vs){ echo 'sama';}
  ?>
  <tr>
    <td><?php echo $a;?></td>
	<?php  if($v != $vs){ ?>
    <td rowspan="<?php echo $rowspan;?>"><?php echo $v;?></td>
    <?php  } ?>
	<td><?php echo $voic['jo']?></td>
    <td><?php echo str_replace('N','NotPaid',str_replace('Y','PAID',$voic['status']))?></td>
	<?php  if($v != $vs){ ?>
    <td rowspan="<?php echo $rowspan;?>"><?php echo uang($totpay['bayar']+$terakhir['sisa'])?></td>
    <td rowspan="<?php echo $rowspan;?>"><?php echo $totbayar?></td>
    <td rowspan="<?php echo $rowspan;?>"><?php echo uang($totpay['bayar'])?></td>
    <td rowspan="<?php echo $rowspan;?>"><?php echo uang($terakhir['sisa'])?></td><?php } ?>
  </tr><?php 
  $a++;
  $vs=$v;
  } ?>
  <!--tr><td colspan='3'><strong>Total</strong></td><td><strong><?php echo uang($allpro)?></strong></td><td><strong><?php echo uang($alllos)?></strong></td><td><strong><?php echo uang($alltot)?></strong></td><td><strong><?php echo uang($allfee)?></strong></td></tr-->
</table>
