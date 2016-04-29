
<script type="text/javascript">
    $(function() {
    	$("#kasir").dropdownchecklist({emptyText: " - All -", maxDropHeight: 240, width: 180});
    });
</script>
<tr id="department"><td>Kasir</td><td>:</td><td><select name="kasir[]" multiple id="kasir"><!--<option value="_all">All Department</option>--><?php foreach($listkasir as $list){?><option value="<?php echo $list->username;?>"><?php echo $list->username;?></option><?php }?></select></td></tr>