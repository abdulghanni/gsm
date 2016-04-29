
<h2>Summary Trucking</h2>
</center>
<span style="float:right;"><?php echo GetMonth((int)$periode[1]).' '.(int)$periode[0]?></span>

<body>
<table width="100%" border="1" cellspacing="0">
  <tr class="theader">
    <td>Date</td>
    <td>Jobsheet</td>
    <td>Customer</td>
    <td>District</td>
    <td>Vehicle No </td>
    <td>Type</td>
    <td>Vendor</td>
    <!--td>Trucking</td>
    <td>PPN 10%  </td-->
    <td>TOTAL SALES </td>
    <td>COST</td>
    <td>RENT</td>
    <!--td>OTHERS</td-->
    <td>TOTAL COST </td>
    <td>Profit</td>
  </tr><?php
	$allsal=$allcost=$allrent=$alltotcost=$allprofit=0;

	foreach($jo as $list){
	$totsum=$this->db->query("SELECT SUM(b_subtotal) as totsal, SUM(c_subtotal) as totcost FROM sv_ai WHERE job_order='".$list['number']."'")->row_array();
	
	$qrent="SELECT amount FROM sv_costing_truck_detail a LEFT JOIN sv_costing_truck b ON a.id_cos=b.id WHERE MONTH(b.period)='".$periode[1]."' AND  YEAR(b.period)='".$periode[0]."' AND b.vendor='$ven' ";
		
		if($ven=='1'){
			$qrent.="AND a.truck='".$list['vehicle_no']."'";
		}
	$rent=$this->db->query($qrent)->row_array();
	//lastq();
	$amount=$rent['amount'];
	if($ven!='1'){
			$amount=$rent['amount']/$alls;
		}
	else{
				$ct=$this->db->query("SELECT COUNT(vehicle_no) as vno FROM sv_trucking_order WHERE vehicle_no = '".$list['vehicle_no']."' AND MONTH(create_date)='".$periode[1]."' AND  YEAR(create_date)='".$periode[0]."'")->row_array();
			$amount=$rent['amount']/$ct['vno'];
	}
	$totcost=$totsum['totcost']+$amount;
	$profit=$totsum['totsal']-$totcost;
	
	$allsal+=$totsum['totsal'];
	$allcost+=$totsum['totcost'];
	$allrent+=$amount;
	$alltotcost+=$totcost;
	$allprofit+=$profit;
  ?>
  <tr>
    <td><?php echo tglindo($list['create_date']) ?></td>
    <td><?php echo $list['number']?></td>
    <td><?php echo GetValue('name','master_client',array('id'=>'where/'.$list['messers']))?></td>
    <td><?php echo $list['loading'].' - '.$list['unloading']?></td>
    <td><?php echo GetValue('code','master_truck',array('id'=>'where/'.$list['vehicle_no']))?></td>
    <td><?php echo GetValue('name','master_trucking',array('id'=>'where/'.$list['service']))?></td>
    <td><?php echo $vendor?></td>
    <!--td>&nbsp;</td>
    <td>&nbsp;</td-->
    <td><?php echo uang($totsum['totsal']) ?></td>
    <td><?php echo uang($totsum['totcost']) ?></td>
    <td><?php echo uang($amount)?></td>
    <!--td>&nbsp;</td-->
    <td><?php echo uang($totcost)?></td>
    <td><?php echo uang($profit)?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="7"><strong>TOTAL</strong></td>
    <!--td>&nbsp;</td>
    <td>&nbsp;</td-->
    <td><strong><?php echo uang($allsal)?></strong></td>
    <td><strong><?php echo uang($allcost)?></strong></td>
    <td><strong><?php echo uang($allrent)?></strong></td>
    <!--td>&nbsp;</td-->
    <td><strong><?php echo uang($alltotcost)?></strong></td>
    <td><strong><?php echo uang($allprofit)?></strong></td>
  </tr>
</table>
