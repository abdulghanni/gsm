
<script type="text/javascript">
    $(function() {
    	$("#kas").dropdownchecklist({emptyText: " - All -", maxDropHeight: 240, width: 180});
    });
</script>
<tr id="department"><td>Kas</td><td>:</td><td><select name="kas[]" multiple id="kas"><!--<option value="_all">All Department</option>--><?php foreach($listkas as $list){?><option value="<?php echo $list->id;?>"><?php echo $list->nama;?></option><?php }?></select></td></tr>