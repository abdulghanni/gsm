<link rel="stylesheet" href="<?php echo assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css'); ?>">
<script src="<?php echo assets_url('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
<script>
$(function() 
{
	$('.tanggal')
	.datepicker({
		todayHighlight: true,
		autoclose: true,
		format: "yyyy-mm-dd"
	});
});
</script>
<div id="periodmonth">
	<div class="row">
		<div class="col-md-4">
		Jatuh Tempo
		</div>
		<div class="col-md-1">
		:
		</div>
		<div class="col-md-7">
	       <input name="start_date" class="tanggal form-control" required>
			&nbsp;s / d&nbsp;
			<input name="end_date" class="tanggal form-control" required>
		</div>
	</div>
</div>