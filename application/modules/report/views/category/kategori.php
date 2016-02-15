
<script type="text/javascript">
    $(document).ready(function() {
    	$("#kategori").dropdownchecklist({emptyText: " - All -", maxDropHeight: 240, width: 180});
    });
</script>
<tr id="department"><td>Kategori</td><td>:</td><td><select name="kategori[]" id="kategori" multiple><!--<option value="_all">All Department</option>--><?php foreach($listgrup_inventory as $list){?><option value="<?php echo $list->kode_group;?>"><?php echo $list->nama;?></option><?php }?></select></td></tr> 