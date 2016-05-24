<div id="periodmonth">
	<div class="row">
		<div class="col-md-4">
		Period
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

<!--<link rel="Stylesheet" type="text/css" href="<?php echo base_url();?>assets/style/smoothness/jquery-ui-1.7.1.custom.css"  />-->
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