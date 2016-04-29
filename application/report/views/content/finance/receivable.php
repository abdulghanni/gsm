<table width="100%" border="1" align="center" cellspacing="0">
<tr>
<center><h2>Report Outstanding Invoice Receivable</h2>
</center>
</tr>
<tr><span style="float:left;"><?php echo GetValue('name','master_client',array('id'=>'where/'.$this->input->post('client')));?></span>
</tr>
<tr><span style="float:right;"><?php echo GetMonth((int)$periode[1]).' '.(int)$periode[0]?></span>
</tr>
  <tr align="center" class="theader">
    <td>No</td>
    <td>Job Order / Trucking Order</td>
    <td>Total Amount Invoice</td>
    <td>Total Count Paid </td>
    <td>Total Paid </td>
    <td>Total Outstanding</td>
  </tr><?php
  $a=1;
  foreach($inv as $voic){
	  $totbayar=$this->db->query("SELECT * FROM sv_payment WHERE invoice = '".$voic['id']."'")->num_rows();
	  $totpay=$this->db->query("SELECT SUM(amount) as bayar FROM sv_payment WHERE invoice = '".$voic['id']."'")->row_array();
  ?>
  <tr>
    <td><?php echo $a;?></td>
    <td><?php echo $voic['number']?></td>
    <td><?php echo uang($voic['total'])?></td>
    <td><?php echo $totbayar?></td>
    <td><?php echo uang($totpay['bayar'])?></td>
    <td><?php echo uang($voic['total']-$totpay['bayar'])?></td>
  </tr><?php 
  $a++;
  } ?>
  <!--tr><td colspan='3'><strong>Total</strong></td><td><strong><?php echo uang($allpro)?></strong></td><td><strong><?php echo uang($alllos)?></strong></td><td><strong><?php echo uang($alltot)?></strong></td><td><strong><?php echo uang($allfee)?></strong></td></tr-->
</table>
