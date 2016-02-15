
<div id='title'><center><span style="margin:0 auto; font-family:Comic Sans MS;">MASTER LIST OF EMPLOYEE</span><br><span style="margin:0 auto; text-decoration:underline; font-family:Comic Sans MS;">PERIOD : <?php echo $period?></span></center><br>
<span style="font-family:Comic Sans MS; font-size:<?php echo $this->fonthead;?>;">Department : <?php echo $dep?></span>
</div>
<div id='dataarea'><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:<?php echo $this->fontcont;?>; border:1px solid black;">
  <tr style="text-align:center;">
    <td rowspan="2" style="border:1px solid black;" width="1%">No</td>
	<?php if(in_array(1,$selfield)){?>
    <td rowspan="2" style="border:1px solid black;" width="10%" id="1">Name</td><?php }?>
	<?php if(in_array(2,$selfield)){?>
    <td rowspan="2" style="border:1px solid black;" width="5.3%" id="2">ID Number</td><?php }?>
	<?php if(in_array(3,$selfield)){?>
    <td rowspan="2" style="border:1px solid black;" width="7%" id="3">Position</td><?php }?>
	<?php if(in_array(4,$selfield)){?>
    <td rowspan="2" style="border:1px solid black;" width="7%" id="4">Education (Graduated From)</td><?php }?>
	<?php if(in_array(5,$selfield)){?>
    <td rowspan="2" style="border:1px solid black;" width="6%" id="5">Date of Hire</td><?php }?>
	<?php if(in_array(6,$selfield)){?>
    <td rowspan="2" style="border:1px solid black;" width="2%" id="6">Mandiri Account No.</td><?php }?>
	<?php if(in_array(7,$selfield)){?>
    <td rowspan="2" style="border:1px solid black;" width="2%" id="7">Jamsostek Reg. No.</td><?php }?>
	<?php if(in_array(8,$selfield)){?>
    <td rowspan="2" style="border:1px solid black;" width="1%" id="8">Male/<br>Female</td><?php }?>
	<?php if(in_array(9,$selfield)){?>
    <td rowspan="2" style="border:1px solid black;" width="2%" id="9">Blood Type</td><?php }?>
	<?php if(in_array(10,$selfield)){?>
    <td rowspan="2" style="border:1px solid black;" width="2%" id="10">Marrital Status</td><?php }?>
	<?php if(in_array(11,$selfield)){?>
    <td rowspan="2" style="border:1px solid black;" width="2%" id="11">Employee Status</td><?php }?>
	<?php if(in_array(12,$selfield)){?>
    <td colspan="2" style="border:1px solid black;"  id="12">Period Of Contract</td><?php }?>
	<?php if(in_array(13,$selfield)){?>
    <td rowspan="2" style="border:1px solid black;" width="2%" id="13">Religion</td><?php }?>
	<?php if(in_array(14,$selfield)){?>
    <td colspan="2" style="border:1px solid black;"  id="ext14">Date of Birth</td><?php }?>
	<?php if(in_array(15,$selfield)){?>
    <td rowspan="2" style="border:1px solid black;" width="25%" id="15">Address</td><?php }?>
	<?php if(in_array(1,$selfield)){?>
  </tr>
  <tr>
	<?php if(in_array(12,$selfield)){?>
    <td style="border:1px solid black;" width="6%" id="12">Start</td>
    <td style="border:1px solid black;" width="6%" id="12">Finish</td><?php }?>
	<?php if(in_array(14,$selfield)){?>
    <td style="border:1px solid black;" width="6%" id="14">Place</td>
    <td style="border:1px solid black;" width="6%" id="14">Date</td><?php }?>
    </tr>
    <?php
	$urutan=1;
	 foreach($result as $hasil){
		 if($hasil->sex=='Laki-laki'){$sex='Male';}
		 else{$sex='Female';}
		 
		 if($hasil->date_start_contract!='0000-00-00'){ 
		 $startcontract=tgl_indo($hasil->date_start_contract);
		  $endcontract=tgl_indo($hasil->date_end_contract); }
		 else{$startcontract='-';
		 $endcontract='-';}
		 if($hasil->blood_type==NULL){$hasil->blood_type='-';}
		 ?>
  <tr style="text-align:center;">
    <td style="border:1px solid black;"><?php echo $urutan?></td>
	<?php if(in_array(1,$selfield)){?>
    <td style="border:1px solid black;" align="left" id="1"><?php echo $hasil->name?></td><?php }?>
	<?php if(in_array(2,$selfield)){?>
    <td style="border:1px solid black;" id="2"><?php echo $hasil->nik?></td><?php }?>
	<?php if(in_array(3,$selfield)){?>
    <td style="border:1px solid black;" align="left" id="3"><?php echo $hasil->posisi?></td><?php }?>
	<?php if(in_array(4,$selfield)){?>
    <td style="border:1px solid black;" align="left" id="4"><?php echo $hasil->education?></td><?php }?>
	<?php if(in_array(5,$selfield)){?>
    <td style="border:1px solid black;" id="5"><?php echo tgl_indo($hasil->date_hire_since)?></td><?php }?>
	<?php if(in_array(6,$selfield)){?>
    <td style="border:1px solid black;" id="6"><?php echo $hasil->rekening?></td><?php }?>
	<?php if(in_array(7,$selfield)){?>
    <td style="border:1px solid black;" id="7"><?php echo $hasil->jamsostek?></td><?php }?>
	<?php if(in_array(8,$selfield)){?>
    <td style="border:1px solid black;" id="8"><?php echo $sex ?></td><?php }?>
	<?php if(in_array(9,$selfield)){?>
    <td style="border:1px solid black;" id="9"><?php echo $hasil->blood_type?></td><?php }?>
	<?php if(in_array(10,$selfield)){?>
    <td style="border:1px solid black;" id="10"><?php echo $hasil->statusnikah?></td><?php }?>
	<?php if(in_array(11,$selfield)){?>
    <td style="border:1px solid black;" id="11"><?php echo $hasil->employe_status?></td><?php }?>
	<?php if(in_array(12,$selfield)){?>
    <td style="border:1px solid black;" id="12"><?php echo $startcontract?></td>
    <td style="border:1px solid black;" id="12"><?php echo $endcontract?></td> <?php }?>
	<?php if(in_array(13,$selfield)){?>
    <td style="border:1px solid black;" id="13"><?php echo $hasil->religion?></td><?php }?>
	<?php if(in_array(14,$selfield)){?>
    <td style="border:1px solid black;" id="14"><?php echo $hasil->place_of_birth?></td>
    <td style="border:1px solid black;" id="14"><?php echo tgl_indo($hasil->date_of_birth)?></td><?php }?>
	<?php if(in_array(15,$selfield)){?>
    <td style="border:1px solid black;" align="left" id="15"><?php echo $hasil->address?></td><?php }?>
  </tr><?php 
  $urutan++;
  } 
	}
  ?>
  <tr><td align="left" colspan="18" style="border:1px solid black;">
  <div style="float:left; width:20%;">Cilacap, <?php echo date('M d, Y')?><br/>Prepared By,<br /><br /><br /><br />
  <br />
  <span style="text-decoration:underline;"><?php echo GetHRDIntendent();?></span><br>
  HRD Superintendent
  </div>
  <div style="float:right; width:20%;"><br/>Checked By,<br /><br /><br /><br />
  <br />
  <span style="text-decoration:underline;"><?php echo GetHRDCoordinator();?></span><br>
  Admin & Personal Manager</div>
  </td></tr>
</table>
</div>
<!--<script>
<?php
if(isset($selfield)){
for($a=1;$a<=15;$a++){
	if(!in_array($a,$selfield)){
?>
document.getElementById("<?php echo $a?>").style.display="none";
<?php	
}}}
?>
</script>-->