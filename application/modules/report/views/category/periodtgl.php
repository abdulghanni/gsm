<tr id="periodmonth">
	<td>Period</td>
	<td>:</td>
	<td>
		<input name="start_date" class="tanggal span3">
		&nbsp;s / d&nbsp;
		<input name="end_date" class="tanggal span3">
	</td>
</tr>
<!--<link rel="Stylesheet" type="text/css" href="<?php echo base_url();?>assets/style/smoothness/jquery-ui-1.7.1.custom.css"  />-->
<script>
$(function() 
{
	$('.tanggal').datepicker({
		dateFormat: 'yy-mm-dd', 
		changeMonth: true,
		changeYear: true
	});
});
</script>