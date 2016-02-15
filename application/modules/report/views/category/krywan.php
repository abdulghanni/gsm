
<script type="text/javascript">
    $(function() {
    	$("#karyawan").dropdownchecklist({emptyText: " - All -", maxDropHeight: 240, width: 180});
    });
</script>
<tr id="department"><td>Karyawan</td><td>:</td><td><select name="karyawan[]" multiple id="karyawan"><!--<option value="_all">All Department</option>--><?php foreach($listkaryawan as $list){?><option value="<?php echo $list->id;?>"><?php echo $list->nik.' - '.$list->nama;?></option><?php }?></select></td></tr>