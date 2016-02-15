
<script type="text/javascript">
    $(function() {
    	$("#supplier").dropdownchecklist({emptyText: " - All -", maxDropHeight: 240, width: 180});
    });
</script>

<tr id="department"><td>Supplier</td><td>:</td><td><select name="supplier[]" id="supplier" multiple='multiple'><!--<option value="_all">All Department</option>--><?php foreach($listsup as $list){?><option value="<?php echo $list->id;?>"><?php echo $list->nama;?></option><?php }?></select></td></tr>