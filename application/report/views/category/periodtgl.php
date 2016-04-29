<table>
<tr id="periodmonth">
	<td>Period</td>
	<td>:</td>
	<td>
            <input name="start_date" class="tanggal span3" required>
		&nbsp;s / d&nbsp;
		<input name="end_date" class="tanggal span3" required>
	</td>
</tr>
</table>
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