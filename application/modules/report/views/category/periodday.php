<tr id="periodday"><td>Period</td><td>:</td><td><select name="d" style="width:50px;">
<?php for($a=1;$a<=31;$a++){
	if(strlen($a)==1){$b='0'.$a;};
	?><option value="<?php echo $b;?>" <?php if($a==date("d")){echo "Selected";}?>><?php echo $a;?></option><?php }?>
</select>-<select name="m" style="width:100px;"><option value="">-Bulan-</option><?php
foreach(array_keys($bulan) as $id){
?>
<option value="<?php echo $id;?>" <?php if($id==date("m")){ echo "Selected";}?>><?php echo $bulan[$id]?></option>
<?php	
}
?></select> - 
<select name="Y" style="width:100px;"><option value="">-Tahun-</option><?php for($a=2000;$a<=date("Y")+1;$a++){?><option value="<?php echo $a;?>" <?php if($a==date("Y")) echo "Selected";?>><?php echo $a;?></option><?php }?></select></td>