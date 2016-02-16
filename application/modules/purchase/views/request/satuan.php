<select name="satuan" class="form-control">
	<?php foreach ($satuan as $s) {?>
		<option value="<?= $s->id?>"><?=$s->satuan?></option>
	<?php } ?>
</select>
<script type="text/javascript"> $(document).find("select.select2").select2();</script>