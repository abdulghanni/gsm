<tr id="periodmonth">
	<td>Period</td>
	<td>:</td>
	<td>
		<input name="start_date" class="tanggal span3">
	</td>
</tr><script>
$(function() 
{
	$('.tanggal').datepicker({
		dateFormat: 'yy-mm-dd', 
		changeMonth: true,
		changeYear: true
	});
});
</script>