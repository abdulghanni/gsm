<table width="100%" border="1" align="center" cellspacing="0">
<h2>Marketing Fee</h2>
</center>
<span style="float:right;"><?php echo GetMonth((int)$periode[1]).' '.(int)$periode[0]?></span>
  <tr align="center" class="theader">
    <td rowspan="2">No</td>
    <td rowspan="2">Marketing</td>
    <td colspan="3">Jumlah</td>
    <td rowspan="2">Sales Value </td>
    <td rowspan="2">Cost Value </td>
    <td rowspan="2">Profit</td>
    <td rowspan="2">Marketing Fee </td>
  </tr>
  <tr align="center">
    <td style="background-color:yellow;">On Progress </td>
    <td style="background-color:green;">Win</td>
    <td style="background-color:red;">Loss</td>
  </tr><?php
$a=1;
$allpro=$alllos=$alltot=$allfee=0;
  foreach($marketing as $sales){
	  $on=$win=$loss=0;
	  $pros=array();
	  $jo=array();
$prog=$this->db->query("SELECT * FROM sv_marketing_form_prospect WHERE marketing='".$sales['id']."' AND MONTH(create_date)='".$periode[1]."' AND  YEAR(create_date)='".$periode[0]."' ");
	if($prog->num_rows()>0){
			foreach($prog->result_array() as $forms){
				if($forms['status']=='ONGOING'){
					$on++;
				}
				if($forms['status']=='WIN'){
					$win++;
					$pros[]="'".$forms['id']."'";
				}
				if($forms['status']=='LOOSE'){
					$loss++;
				}
			}
			$pp=implode(',',$pros);
			
	$ex1=$this->db->query("SELECT * FROM sv_export_sea_job WHERE prospek IN($pp) ")->result_array();
	foreach($ex1 as $x1){
		$jo[]="'".$x1['number']."'";
	}
	$ex2=$this->db->query("SELECT * FROM sv_export_air_job WHERE prospek IN($pp) ")->result_array();
	foreach($ex2 as $x2){
		$jo[]="'".$x2['number']."'";
	}
	$im1=$this->db->query("SELECT * FROM sv_import_sea_job WHERE prospek IN($pp) ")->result_array();
	foreach($im1 as $x2){
		$jo[]="'".$x2['number']."'";
	}
	$im2=$this->db->query("SELECT * FROM sv_import_air_job WHERE prospek IN($pp) ")->result_array();
	foreach($im2 as $x2){
		$jo[]="'".$x2['number']."'";
	}
	$tr=$this->db->query("SELECT * FROM sv_trucking_order WHERE prospek IN($pp) ")->result_array();
	foreach($tr as $x2){
		$jo[]="'".$x2['number']."'";
	}
	$jo=implode(',',$jo);
	$cp=$this->db->query("SELECT SUM(b_subtotal) as profit, SUM(c_subtotal) as loss FROM sv_ai WHERE job_order IN($jo) ")->row_array();
	$tot=$cp['profit']-$cp['loss'];
	$fee=$tot*(20/100);
	}
	else{
		$cp['profit']=$cp['loss']=$tot=$fee=0;
	}
  ?>
  <tr>
    <td><?php echo $a;?></td>
    <td><?php echo $sales['name']?></td>
    <td align="center"><?php echo $on?></td>
    <td align="center"><?php echo $win?></td>
    <td align="center"><?php echo $loss?></td>
    <td><?php echo uang($cp['profit'])?></td>
    <td><?php echo uang($cp['loss'])?></td>
    <td><?php echo uang($tot)?></td>
    <td><?php echo uang($fee)?></td>
  </tr><?php 
  $a++;
  $allpro+=$cp['profit'];
  $alllos+=$cp['loss'];
  $alltot+=$tot;
  $allfee+=$fee;
  } ?>
  <tr><td colspan='5'><strong>Total</strong></td><td><strong><?php echo uang($allpro)?></strong></td><td><strong><?php echo uang($alllos)?></strong></td><td><strong><?php echo uang($alltot)?></strong></td><td><strong><?php echo uang($allfee)?></strong></td></tr>
</table>
